<?php
/**
 * Phase 4 (authority pages): chart shortcodes and the embeddable widget.
 *
 * [rbs_uk_ring_table]      – UK letters (whole and half) → US, mm, circumference, EU
 * [rbs_us_quarter_table]   – US sizes 3–13 in quarter steps with mm and inches
 * [rbs_india_ring_table]   – Indian / Pakistani number sizes → mm, circumference, nearest US/UK
 * [rbs_embed_code]         – copy-paste iframe code for the widget + live preview
 *
 * Widget endpoint: /embed/ring/, /embed/bangle/, /embed/bracelet/
 * A bare page with only the sizer and a credit line, sent with noindex.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 5.25 → "5¼", 5.5 → "5½", 5.75 → "5¾".
 */
function rbs_us_fraction( $us ) {
	$whole = (int) floor( $us );
	$q     = (int) round( ( $us - $whole ) * 4 );
	$map   = array( 1 => '¼', 2 => '½', 3 => '¾' );
	return $whole . ( isset( $map[ $q ] ) ? $map[ $q ] : '' );
}

/**
 * UK rows: the half letters from the size data plus the whole letters between them.
 *
 * @return array<int, array{uk:string, us:float, mm:float, exact:bool}>
 */
function rbs_uk_ring_rows() {
	$all  = rbs_ring_sizes();
	$rows = array();
	$prev = null;
	foreach ( $all as $r ) {
		if ( 0 === strpos( $r['uk'], 'Z+' ) ) {
			break; // Z+1 … are not real UK letters; the UK page stops at Z.
		}
		if ( $prev ) {
			$la     = mb_substr( $prev['uk'], 0, 1 );
			$lb     = mb_substr( $r['uk'], 0, 1 );
			$b_half = false !== mb_strpos( $r['uk'], '½' );
			$insert = '';
			if ( $b_half && $prev['uk'] !== $lb ) {
				$insert = $lb;
			} elseif ( ! $b_half && ord( $lb ) - ord( $la ) === 2 ) {
				$insert = chr( ord( $la ) + 1 );
			}
			if ( $insert ) {
				$rows[] = array(
					'uk'    => $insert,
					'us'    => ( $prev['us'] + $r['us'] ) / 2,
					'mm'    => ( $prev['mm'] + $r['mm'] ) / 2,
					'exact' => false,
				);
			}
		}
		$rows[] = array( 'uk' => $r['uk'], 'us' => $r['us'], 'mm' => $r['mm'], 'exact' => true );
		$prev   = $r;
	}
	return $rows;
}

function rbs_uk_ring_table_shortcode() {
	$html = '<div class="rbs-table-wrap"><table class="rbs-table"><thead><tr><th>UK / Australia</th><th>US / Canada</th><th>EU / ISO</th><th>Inner diameter</th><th>Inner circumference</th></tr></thead><tbody>';
	foreach ( rbs_uk_ring_rows() as $r ) {
		$d   = rbs_ring_derived( $r['mm'] );
		$us  = $r['exact'] ? rbs_us_link( $r['us'] ) : esc_html( rbs_us_fraction( $r['us'] ) );
		$html .= '<tr><td><strong>' . esc_html( $r['uk'] ) . '</strong></td><td>' . $us . '</td><td>' . esc_html( $d['eu'] ) . '</td><td>' . esc_html( number_format( $r['mm'], 1 ) ) . ' mm</td><td>' . esc_html( number_format( $d['circ_mm'], 1 ) ) . ' mm</td></tr>';
	}
	return $html . '</tbody></table></div>';
}
add_shortcode( 'rbs_uk_ring_table', 'rbs_uk_ring_table_shortcode' );

function rbs_us_quarter_table_shortcode() {
	$all  = array_values( array_filter( rbs_ring_sizes(), function ( $r ) {
		return $r['us'] <= 13;
	} ) );
	$html = '<div class="rbs-table-wrap"><table class="rbs-table"><thead><tr><th>US size</th><th>Inner diameter</th><th>Diameter (in)</th><th>Circumference</th><th>Circumference (in)</th><th>UK</th></tr></thead><tbody>';
	$n    = count( $all );
	foreach ( $all as $i => $r ) {
		$rows = array( array( $r['us'], $r['mm'], $r['uk'], true ) );
		if ( $i < $n - 1 ) {
			$rows[] = array( $r['us'] + 0.25, ( $r['mm'] + $all[ $i + 1 ]['mm'] ) / 2, '', false );
		}
		foreach ( $rows as $row ) {
			list( $us, $mm, $uk, $exact ) = $row;
			$circ  = $mm * M_PI;
			$html .= '<tr><td>' . ( $exact ? rbs_us_link( $us ) : esc_html( rbs_us_fraction( $us ) ) ) . '</td><td>' . esc_html( number_format( $mm, 1 ) ) . ' mm</td><td>' . esc_html( number_format( $mm / 25.4, 3 ) ) . '</td><td>' . esc_html( number_format( $circ, 1 ) ) . ' mm</td><td>' . esc_html( number_format( $circ / 25.4, 2 ) ) . '</td><td>' . esc_html( $uk ? $uk : '–' ) . '</td></tr>';
		}
	}
	return $html . '</tbody></table></div>';
}
add_shortcode( 'rbs_us_quarter_table', 'rbs_us_quarter_table_shortcode' );

function rbs_india_ring_table_shortcode() {
	$html = '<div class="rbs-table-wrap"><table class="rbs-table"><thead><tr><th>Indian size</th><th>Inner diameter</th><th>Inner circumference</th><th>Nearest US</th><th>Nearest UK</th></tr></thead><tbody>';
	for ( $n = 4; $n <= 35; $n++ ) {
		$mm    = rbs_india_mm( $n );
		$near  = rbs_nearest_ring( $mm );
		$html .= '<tr><td><strong>' . esc_html( $n ) . '</strong></td><td>' . esc_html( number_format( $mm, 1 ) ) . ' mm</td><td>' . esc_html( number_format( $mm * M_PI, 1 ) ) . ' mm</td><td>' . rbs_us_link( $near['us'] ) . '</td><td>' . esc_html( $near['uk'] ) . '</td></tr>';
	}
	return $html . '</tbody></table></div>';
}
add_shortcode( 'rbs_india_ring_table', 'rbs_india_ring_table_shortcode' );

/* ------------------------------------------------------------- widget */

function rbs_embed_modes() {
	return array(
		'ring'     => array( 'Ring sizer', 640 ),
		'bangle'   => array( 'Bangle size calculator', 640 ),
		'bracelet' => array( 'Bracelet size calculator', 460 ),
	);
}

add_action( 'init', function () {
	add_rewrite_rule( '^embed/(ring|bangle|bracelet)/?$', 'index.php?rbs_embed=$matches[1]', 'top' );
}, 5 );

add_filter( 'query_vars', function ( $vars ) {
	$vars[] = 'rbs_embed';
	return $vars;
} );

// Keep WordPress from "fixing" the embed URL with a canonical redirect.
add_filter( 'redirect_canonical', function ( $url ) {
	return get_query_var( 'rbs_embed' ) ? false : $url;
} );

add_action( 'template_redirect', function () {
	$mode  = get_query_var( 'rbs_embed' );
	$modes = rbs_embed_modes();
	if ( ! $mode || ! isset( $modes[ $mode ] ) ) {
		return;
	}
	status_header( 200 );
	header( 'Content-Type: text/html; charset=utf-8' );
	header( 'X-Robots-Tag: noindex, follow' );
	header( 'Cache-Control: public, max-age=3600' );

	$data = array(
		'rings'   => rbs_ring_rows_for_js(),
		'uk'      => rbs_uk_rows_for_js(),
		'bangles' => rbs_bangle_sizes(),
		'home'    => untrailingslashit( home_url() ),
	);
	$tool = rbs_sizer_shortcode( array( 'mode' => $mode, 'side' => '0' ) );
	$home = add_query_arg( array( 'utm_source' => 'widget', 'utm_medium' => 'embed' ), rbs_tool_url( $mode ) );
	?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, follow">
<title><?php echo esc_html( $modes[ $mode ][0] . ' – ' . RBS_SITE_NAME ); ?></title>
<link rel="canonical" href="<?php echo esc_url( rbs_tool_url( $mode ) ); ?>">
<link rel="stylesheet" href="<?php echo esc_url( RBS_URI . '/assets/css/sizer.css?ver=' . RBS_VERSION ); ?>">
<style>
body{margin:0;padding:8px;font-family:system-ui,-apple-system,"Segoe UI",Roboto,sans-serif;background:#fff;color:#111827}
.rbs-embed-credit{margin:8px 0 0;font-size:13px;color:#4b5563;text-align:center}
.rbs-embed-credit a{color:#1d4ed8}
</style>
</head>
<body>
<?php echo $tool; // phpcs:ignore WordPress.Security.EscapeOutput -- shortcode output is escaped ?>
<p class="rbs-embed-credit">Free <?php echo esc_html( strtolower( $modes[ $mode ][0] ) ); ?> by <a href="<?php echo esc_url( $home ); ?>" target="_blank" rel="noopener">Ring Bangle Sizer</a> · sizes are estimates, confirm with your jeweller</p>
<script>var RBS_DATA = <?php echo wp_json_encode( $data ); ?>;</script>
<script src="<?php echo esc_url( RBS_URI . '/assets/js/sizer.js?ver=' . RBS_VERSION ); ?>" defer></script>
<script>
(function () {
	if (window.parent === window || !window.ResizeObserver) { return; }
	var last = 0;
	new ResizeObserver(function () {
		var h = document.documentElement.scrollHeight;
		if (h !== last) { last = h; window.parent.postMessage({ rbsEmbedHeight: h }, '*'); }
	}).observe(document.body);
})();
</script>
</body>
</html>
	<?php
	exit;
}, 0 );

/**
 * [rbs_embed_code] – iframe snippets for site owners, one per mode, plus a live preview.
 */
function rbs_embed_code_shortcode() {
	$html = '';
	foreach ( rbs_embed_modes() as $mode => $m ) {
		$src     = home_url( '/embed/' . $mode . '/' );
		$snippet = '<iframe src="' . $src . '" title="' . $m[0] . '" width="100%" height="' . $m[1] . '" style="border:0;max-width:640px" loading="lazy"></iframe>';
		$html   .= '<h3>' . esc_html( ucfirst( $m[0] ) ) . '</h3>';
		$html   .= '<textarea class="rbs-embed-snippet" readonly rows="3" aria-label="' . esc_attr( 'Embed code: ' . $m[0] ) . '" onclick="this.select()">' . esc_textarea( $snippet ) . '</textarea>';
	}
	$html .= '<h3>Optional: auto-height</h3>';
	$html .= '<p>The widget reports its height, so the frame can grow and shrink with the tool. Add this once, anywhere after the iframe:</p>';
	$resize = '<script>window.addEventListener("message",function(e){if(e.origin!=="' . untrailingslashit( home_url() ) . '"||!e.data||!e.data.rbsEmbedHeight)return;document.querySelectorAll(\'iframe[src^="' . home_url( '/embed/' ) . '"]\').forEach(function(f){if(f.contentWindow===e.source)f.style.height=e.data.rbsEmbedHeight+"px";});});</script>';
	$html  .= '<textarea class="rbs-embed-snippet" readonly rows="4" aria-label="Auto-height script" onclick="this.select()">' . esc_textarea( $resize ) . '</textarea>';
	$html  .= '<h2>Live preview</h2>';
	$html  .= '<iframe src="' . esc_url( home_url( '/embed/ring/' ) ) . '" title="Ring sizer widget preview" width="100%" height="640" style="border:1px solid #e5e7eb;border-radius:12px;max-width:640px" loading="lazy"></iframe>';
	return $html;
}
add_shortcode( 'rbs_embed_code', 'rbs_embed_code_shortcode' );
