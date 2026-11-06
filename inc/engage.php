<?php
/**
 * Content engagement (UI/UX batch D):
 * - "On this page" table of contents and anchor ids on H2s
 * - chart tables: sticky first column, swipe hint, tap-to-highlight, "find your size" box
 * - "Your saved sizes" strip for returning visitors (from the sizer's saved sizes)
 * - [rbs_diagram] inline SVG diagrams for the measuring guides
 * The FAQ accordion markup is in rbs_render_faq_html() (inc/pages.php).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* --------------------------------------------- headings: ids + contents */

/**
 * Give every H2 an id, and put a collapsible "On this page" list in front of
 * the first H2 on pages with four or more sections.
 */
function rbs_toc( $content ) {
	if ( ! is_singular( 'page' ) || ! in_the_loop() || ! is_main_query() || false === strpos( $content, '<h2' ) ) {
		return $content;
	}
	$items = array();
	$used  = array();
	$content = preg_replace_callback(
		'#<h2(\s[^>]*)?>(.*?)</h2>#s',
		function ( $m ) use ( &$items, &$used ) {
			$attrs = isset( $m[1] ) ? $m[1] : '';
			$text  = trim( wp_strip_all_tags( $m[2] ) );
			if ( preg_match( '/\sid="([^"]+)"/', $attrs, $idm ) ) {
				$id = $idm[1];
			} else {
				$id   = sanitize_title( $text );
				$base = $id ? $id : 'section';
				$id   = $base;
				for ( $n = 2; isset( $used[ $id ] ); $n++ ) {
					$id = $base . '-' . $n;
				}
				$attrs .= ' id="' . esc_attr( $id ) . '"';
			}
			$used[ $id ] = true;
			$items[]     = array( $id, $text );
			return '<h2' . $attrs . '>' . $m[2] . '</h2>';
		},
		$content
	);
	if ( count( $items ) < 4 ) {
		return $content;
	}
	$toc = '<details class="rbs-toc"><summary>On this page <span>(' . count( $items ) . ' sections)</span></summary><ol>';
	foreach ( $items as $it ) {
		$toc .= '<li><a href="#' . esc_attr( $it[0] ) . '">' . esc_html( preg_replace( '/^\d+\.\s*/', '', $it[1] ) ) . '</a></li>';
	}
	$toc .= '</ol></details>';
	$pos = strpos( $content, '<h2' );
	return substr( $content, 0, $pos ) . $toc . "\n" . substr( $content, $pos );
}
add_filter( 'the_content', 'rbs_toc', 18 ); // after rbs_tool_cards (16), which matches a plain <h2>

/* ---------------------------------------------------------- chart tables */

/**
 * Long charts get a "find your size" box, a sticky first column and a swipe hint.
 * Markup is added on the server so nothing moves when the script runs.
 */
function rbs_table_tools( $content ) {
	if ( ! is_singular( 'page' ) || false === strpos( $content, 'rbs-table-wrap' ) ) {
		return $content;
	}
	return preg_replace_callback(
		'#<div class="rbs-table-wrap">\s*(<table\b[^>]*>.*?</table>)\s*</div>#s',
		function ( $m ) {
			$table = $m[1];
			if ( preg_match( '/^<table[^>]*class="[^"]*rbs-kv/', $table ) ) {
				return $m[0];
			}
			$GLOBALS['rbs_content_js'] = true;
			$rows = preg_match( '#<tbody>(.*?)</tbody>#s', $table, $b ) ? substr_count( $b[1], '<tr' ) : 0;
			$find = '';
			if ( $rows >= 8 ) {
				$bangle = (bool) preg_match( '/rbs-bangle-table|Bangle size|Indian size/i', $table );
				$find   = '<div class="rbs-find"><label>Find your size <input type="text" class="rbs-find-in" placeholder="' . ( $bangle ? 'e.g. 2.6 or 60.3' : 'e.g. 7, N½ or 17.3' ) . '" autocomplete="off" enterkeyhint="search"></label><span class="rbs-find-msg" aria-live="polite"></span></div>';
			}
			return '<div class="rbs-tw">' . $find . '<div class="rbs-table-wrap">' . $table . '</div><span class="rbs-swipe" aria-hidden="true">Swipe →</span></div>';
		},
		$content
	);
}
add_filter( 'the_content', 'rbs_table_tools', 17 );

/**
 * Small script for the table tools, printed inline (no extra request) only
 * on pages that have such a table.
 */
add_action( 'wp_footer', function () {
	if ( empty( $GLOBALS['rbs_content_js'] ) ) {
		return;
	}
	$js = file_get_contents( RBS_DIR . '/assets/js/content.js' ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	if ( $js ) {
		echo '<script>' . $js . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput -- our own file
	}
}, 20 );

/* ----------------------------------------------- returning visitor strip */

/**
 * "Your saved sizes" strip under the header, filled from the sizes people
 * saved in the sizer (localStorage, this device only). The script runs inline
 * before the page content is parsed, so the strip never pushes content down
 * after it is painted. Not shown on the tool pages, which list saved sizes themselves.
 */
add_action( 'generate_after_header', function () {
	if ( ! is_singular( 'page' ) || get_post_meta( get_queried_object_id(), 'rbs_mode', true ) ) {
		return;
	}
	$ring_pages = array();
	foreach ( rbs_ring_size_page_sizes() as $s ) {
		$ring_pages[] = (string) $s;
	}
	$cfg = array(
		'r'  => $ring_pages,
		'b'  => rbs_bangle_size_page_slugs(),
		'h'  => untrailingslashit( home_url() ),
	);
	?>
<div class="rbs-me" id="rbs-me" hidden></div>
<script>
(function () {
	var c = <?php echo wp_json_encode( $cfg ); ?>, box = document.getElementById('rbs-me'), list = null;
	try {
		if (sessionStorage.getItem('rbs_me_x')) { return; }
		list = JSON.parse(localStorage.getItem('rbs_people_v1') || 'null');
		if (!list) {
			var o = JSON.parse(localStorage.getItem('rbs_my_size_v1') || 'null');
			list = o && o.label ? [{ name: 'Me', kind: o.kind, label: o.label }] : [];
		}
	} catch (e) { return; }
	if (!list || !list.length) { return; }
	function esc(t) { return String(t).replace(/[&<>"']/g, function (x) { return '&#' + x.charCodeAt(0) + ';'; }); }
	var items = list.slice(-3).reverse().map(function (p) {
		var v = String(p.label || ''), url;
		if (p.kind === 'bangle') {
			var b = v.replace(/^Size\s*/, '');
			url = c.b.indexOf(b) > -1 ? '/bangle-size/' + b.replace('.', '-') + '/' : '/bangle-size-chart/';
			v = 'bangle ' + b;
		} else {
			var r = v.replace(/^US\s*/, '');
			url = c.r.indexOf(r) > -1 ? '/ring-size-in-mm/size-' + r.replace('.', '-') + '/' : '/ring-size-chart/';
		}
		return '<a href="' + c.h + url + '"><strong>' + esc(p.name || 'Me') + '</strong> ' + esc(v) + '</a>';
	});
	box.innerHTML = '<span>Your saved sizes:</span> ' + items.join(' · ') + '<button type="button" aria-label="Hide saved sizes">×</button>';
	box.hidden = false;
	box.querySelector('button').addEventListener('click', function () {
		box.hidden = true;
		try { sessionStorage.setItem('rbs_me_x', '1'); } catch (e) {}
	});
})();
</script>
	<?php
}, 5 );

/* ------------------------------------------------------------- diagrams */

/**
 * [rbs_diagram name="ring-inner|paper-strip|bangle-hand"] – small inline SVG
 * diagrams for the measuring guides (no image files, 1–2 KB each).
 */
function rbs_diagram_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'name' => '' ), $atts, 'rbs_diagram' );
	$defs = '<defs><marker id="rbs-ag" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto-start-reverse"><path d="M0 0L10 5L0 10z" fill="#047857"/></marker><marker id="rbs-ar" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto-start-reverse"><path d="M0 0L10 5L0 10z" fill="#b91c1c"/></marker><marker id="rbs-ab" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto-start-reverse"><path d="M0 0L10 5L0 10z" fill="#1d4ed8"/></marker></defs>';

	$d = array(
		'ring-inner'  => array(
			'Measure the inside of the ring, from inner edge to inner edge. The outside edge gives a size that is too big.',
			'0 0 480 230',
			'<circle cx="120" cy="105" r="70" fill="none" stroke="#d4a017" stroke-width="16"/>'
			. '<line x1="64" y1="105" x2="176" y2="105" stroke="#047857" stroke-width="4" marker-start="url(#rbs-ag)" marker-end="url(#rbs-ag)"/>'
			. '<text x="120" y="96" text-anchor="middle" font-size="15" font-weight="700" fill="#047857">17.3 mm</text>'
			. '<text x="120" y="210" text-anchor="middle" font-size="17" font-weight="700" fill="#047857">✓ Inside edge</text>'
			. '<circle cx="360" cy="105" r="70" fill="none" stroke="#d4a017" stroke-width="16"/>'
			. '<line x1="282" y1="105" x2="438" y2="105" stroke="#b91c1c" stroke-width="4" stroke-dasharray="7 5" marker-start="url(#rbs-ar)" marker-end="url(#rbs-ar)"/>'
			. '<text x="360" y="96" text-anchor="middle" font-size="15" font-weight="700" fill="#b91c1c">21.3 mm</text>'
			. '<text x="360" y="210" text-anchor="middle" font-size="17" font-weight="700" fill="#b91c1c">✗ Outside edge</text>',
		),
		'paper-strip' => array(
			'Wrap a paper strip around the base of the finger, mark the overlap, then measure the strip flat on a ruler. Divide by 3.14 for the diameter.',
			'0 0 480 230',
			'<rect x="62" y="14" width="72" height="170" rx="36" fill="#fde7d4" stroke="#c48b5c" stroke-width="2"/>'
			. '<path d="M86 40q12-10 24 0" fill="none" stroke="#c48b5c" stroke-width="2"/>'
			. '<rect x="54" y="112" width="88" height="18" rx="3" fill="#fff" stroke="#1d4ed8" stroke-width="2.5"/>'
			. '<path d="M142 112v18" stroke="#b91c1c" stroke-width="3"/>'
			. '<text x="98" y="214" text-anchor="middle" font-size="16" font-weight="700" fill="#111827">1. Wrap and mark</text>'
			. '<rect x="190" y="118" width="276" height="42" rx="4" fill="#fef3c7" stroke="#b8860b" stroke-width="2"/>'
			. rbs_ruler_ticks( 200, 118, 26 )
			. '<rect x="200" y="98" width="240" height="16" rx="3" fill="#fff" stroke="#1d4ed8" stroke-width="2.5"/>'
			. '<path d="M440 92v28" stroke="#b91c1c" stroke-width="3"/>'
			. '<line x1="200" y1="80" x2="438" y2="80" stroke="#1d4ed8" stroke-width="2" marker-start="url(#rbs-ab)" marker-end="url(#rbs-ab)"/>'
			. '<text x="320" y="72" text-anchor="middle" font-size="15" font-weight="700" fill="#1d4ed8">59.5 mm around</text>'
			. '<text x="328" y="196" text-anchor="middle" font-size="16" font-weight="700" fill="#111827">2. Measure to the mark</text>'
			. '<text x="328" y="218" text-anchor="middle" font-size="14" fill="#374151">59.5 ÷ 3.14 = 18.9 mm → US 9</text>',
		),
		'bangle-hand' => array(
			'For a bangle, measure around the widest part of the folded hand (thumb tucked in, fingers together), not the wrist.',
			'0 0 480 250',
			'<path d="M78 236V150q-6-30 4-62V40q0-14 14-14t14 14v-6q0-14 14-14t14 14v4q0-14 14-14t14 14v12q0-12 13-12t13 12v100q4 40-4 70V236z" fill="#fde7d4" stroke="#c48b5c" stroke-width="2"/>'
			. '<path d="M110 34v62M138 38v58M166 44v54" stroke="#c48b5c" stroke-width="1.5"/>'
			. '<path d="M84 150q24-22 50-6" fill="none" stroke="#c48b5c" stroke-width="2"/>'
			. '<ellipse cx="132" cy="148" rx="66" ry="13" fill="none" stroke="#1d4ed8" stroke-width="3" stroke-dasharray="8 5"/>'
			. '<line x1="132" y1="186" x2="132" y2="166" stroke="#1d4ed8" stroke-width="2" marker-end="url(#rbs-ab)"/>'
			. '<text x="132" y="204" text-anchor="middle" font-size="15" font-weight="700" fill="#1d4ed8">Thread here: 18.4 cm</text>'
			. '<text x="132" y="224" text-anchor="middle" font-size="13" fill="#374151">thumb tucked in</text>'
			. '<circle cx="360" cy="108" r="74" fill="none" stroke="#d4a017" stroke-width="14"/>'
			. '<line x1="293" y1="108" x2="427" y2="108" stroke="#047857" stroke-width="4" marker-start="url(#rbs-ag)" marker-end="url(#rbs-ag)"/>'
			. '<text x="360" y="99" text-anchor="middle" font-size="15" font-weight="700" fill="#047857">6.03 cm</text>'
			. '<text x="360" y="212" text-anchor="middle" font-size="15" font-weight="700" fill="#111827">18.4 ÷ 3.14 = 5.86 cm</text>'
			. '<text x="360" y="234" text-anchor="middle" font-size="14" fill="#374151">next size up: 2.6 (6.03 cm)</text>',
		),
	);
	if ( empty( $d[ $atts['name'] ] ) ) {
		return '';
	}
	$x = $d[ $atts['name'] ];
	return '<figure class="rbs-fig"><svg viewBox="' . $x[1] . '" role="img" aria-label="' . esc_attr( $x[0] ) . '" font-family="system-ui,-apple-system,Segoe UI,Roboto,sans-serif">' . $defs . $x[2] . '</svg><figcaption>' . esc_html( $x[0] ) . '</figcaption></figure>';
}
add_shortcode( 'rbs_diagram', 'rbs_diagram_shortcode' );

function rbs_ruler_ticks( $x0, $y, $n ) {
	$out = '';
	for ( $i = 0; $i <= $n; $i++ ) {
		$x    = $x0 + $i * 10;
		$len  = 0 === $i % 5 ? 16 : 9;
		$out .= '<path d="M' . $x . ' ' . $y . 'v' . $len . '" stroke="#8a6d1d" stroke-width="1.5"/>';
	}
	return $out;
}
