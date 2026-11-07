<?php
/**
 * Answer-engine and AI-search helpers (AEO / GEO):
 * - /llms.txt: a plain-text map of the site plus the core size tables, for AI assistants.
 * - "Sources and standards" box on sizing pages (also listed as citation in the WebPage schema).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'RBS_LLMS_MARKER', '<!-- rbs-llms -->' );

/* ------------------------------------------------------------ sources */

/**
 * Published references behind the numbers on the site.
 *
 * @return array<string, array{name:string, url:string, note:string}>
 */
function rbs_sources() {
	return array(
		'iso8653' => array(
			'name' => 'ISO 8653:2016 – Jewellery – Ring-sizes – Definition, measurement and designation',
			'url'  => 'https://www.iso.org/standard/65408.html',
			'note' => 'defines ring size as the inner circumference in mm (EU sizes).',
		),
		'bs6820' => array(
			'name' => 'BS 6820 – British Standard for UK ring sizes',
			'url'  => '',
			'note' => 'defines the UK / Australian letter scale.',
		),
		'iso7810' => array(
			'name' => 'ISO/IEC 7810:2019 – Identification cards – Physical characteristics',
			'url'  => 'https://www.iso.org/standard/70483.html',
			'note' => 'ID-1 bank cards are 85.60 × 53.98 mm; we use this to calibrate the screen.',
		),
		'nist' => array(
			'name' => 'NIST – SI units: length',
			'url'  => 'https://www.nist.gov/pml/owm/si-units-length',
			'note' => '1 inch = 25.4 mm exactly, used for every inch-to-mm conversion.',
		),
		'bangle' => array(
			'name' => 'Indian bangle size convention',
			'url'  => '',
			'note' => 'sizes are inner diameter in inches and sixteenths (2.4 = 2 4/16 in). It is a trade convention, not a published standard, so makers can differ by about 1 mm.',
		),
	);
}

/**
 * Source keys for a page, from its key in the content files. Empty = no box.
 */
function rbs_page_source_keys( $id ) {
	$key  = (string) get_post_meta( $id, 'rbs_key', true );
	$mode = (string) get_post_meta( $id, 'rbs_mode', true );
	if ( '' === $key ) {
		return array();
	}
	$keys = array();
	if ( '1' === get_post_meta( $id, 'rbs_noindex', true ) || in_array( $key, array( 'about', 'contact', 'blog', 'widget' ), true ) ) {
		return array();
	}
	$is_ring   = 0 === strpos( $key, 'ring' ) || in_array( $key, array( 'home', 'average-ring', 'printable', 'blog-ring-fit', 'blog-resize', 'blog-gift-size', 'method' ), true );
	$is_bangle = 0 === strpos( $key, 'bangle' ) || in_array( $key, array( 'chudi', 'blog-bridal-bangle', 'blog-gift-size', 'method' ), true );
	if ( $is_ring ) {
		$keys[] = 'iso8653';
		$keys[] = 'bs6820';
	}
	if ( $is_bangle ) {
		$keys[] = 'bangle';
	}
	if ( $mode || in_array( $key, array( 'home', 'printable', 'method' ), true ) ) {
		$keys[] = 'iso7810';
	}
	if ( $keys || in_array( $key, array( 'bracelet', 'wrist-chart' ), true ) ) {
		$keys[] = 'nist';
	}
	return array_values( array_unique( $keys ) );
}

function rbs_sources_box( $content ) {
	if ( ! is_singular( 'page' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	$keys = rbs_page_source_keys( get_the_ID() );
	if ( ! $keys ) {
		return $content;
	}
	$all   = rbs_sources();
	$items = '';
	foreach ( $keys as $k ) {
		$s     = $all[ $k ];
		$name  = $s['url'] ? '<a href="' . esc_url( $s['url'] ) . '" rel="noopener" target="_blank">' . esc_html( $s['name'] ) . '</a>' : esc_html( $s['name'] );
		$items .= '<li>' . $name . ': ' . esc_html( $s['note'] ) . '</li>';
	}
	$box = '<section class="rbs-sources" aria-labelledby="rbs-sources-h"><h2 id="rbs-sources-h">Sources and standards</h2><ul>' . $items . '</ul><p>The formulas and rounding rules are on our <a href="' . esc_url( home_url( '/how-we-measure/' ) ) . '">how we measure</a> page.</p></section>';
	return $content . $box;
}
add_filter( 'the_content', 'rbs_sources_box', 19 );

/**
 * Sources as schema.org citations (used in the WebPage node, inc/site.php).
 */
function rbs_page_citations( $id ) {
	$all = rbs_sources();
	$out = array();
	foreach ( rbs_page_source_keys( $id ) as $k ) {
		$c = array( '@type' => 'CreativeWork', 'name' => $all[ $k ]['name'] );
		if ( $all[ $k ]['url'] ) {
			$c['url'] = $all[ $k ]['url'];
		}
		$out[] = $c;
	}
	return $out;
}

/* ------------------------------------------------------------ llms.txt */

/**
 * Which llms.txt section a page belongs to.
 */
function rbs_llms_section( $key, $p ) {
	if ( ! empty( $p['mode'] ) || in_array( $key, array( 'ring-calc', 'ring-converter', 'printable' ), true ) ) {
		return 'Tools';
	}
	if ( 0 === strpos( $key, 'blog' ) ) {
		return 'Guides';
	}
	if ( in_array( $key, array( 'about', 'method', 'contact' ), true ) ) {
		return 'About';
	}
	if ( 'widget' === $key ) {
		return 'Optional';
	}
	if ( 0 === strpos( $key, 'ring' ) || 'average-ring' === $key ) {
		return 'Ring sizes';
	}
	return 'Bangle and bracelet sizes';
}

function rbs_llms_txt() {
	$sections = array(
		'Tools'                     => array(),
		'Ring sizes'                => array(),
		'Bangle and bracelet sizes' => array(),
		'Guides'                    => array(),
		'About'                     => array(),
		'Optional'                  => array(),
	);
	$pages = rbs_all_pages();
	foreach ( $pages as $key => $p ) {
		if ( ! empty( $p['noindex'] ) ) {
			continue;
		}
		$url   = 'home' === $key ? home_url( '/' ) : home_url( '/' . rbs_page_path( $key, $pages ) . '/' );
		$title = trim( preg_replace( '/\s+/', ' ', $p['title'] ) );
		$sections[ rbs_llms_section( $key, $p ) ][] = '- [' . $title . '](' . $url . '): ' . trim( $p['seo_desc'] );
	}

	$ring_rows = array( '| US / Canada | UK / Australia | EU / ISO | India / Japan | Inner diameter (mm) | Inner circumference (mm) |', '|---|---|---|---|---|---|' );
	foreach ( rbs_ring_sizes() as $r ) {
		if ( $r['us'] > 13 ) {
			continue;
		}
		$d           = rbs_ring_derived( $r['mm'] );
		$ring_rows[] = '| ' . $r['us'] . ' | ' . $r['uk'] . ' | ' . $d['eu'] . ' | ' . $d['jp'] . ' | ' . number_format( $r['mm'], 1 ) . ' | ' . number_format( $d['circ_mm'], 1 ) . ' |';
	}
	$bangle_rows = array( '| Indian size | Inner diameter (in) | Inner diameter (mm) | Typical fit |', '|---|---|---|---|' );
	foreach ( rbs_bangle_sizes() as $b ) {
		$bangle_rows[] = '| ' . $b['label'] . ' | ' . rtrim( rtrim( number_format( $b['inch'], 3 ), '0' ), '.' ) . ' | ' . number_format( $b['mm'], 1 ) . ' | ' . $b['fit'] . ' |';
	}

	$out   = array();
	$out[] = '# ' . RBS_SITE_NAME;
	$out[] = '';
	$out[] = '> Free tools that measure ring, bangle and bracelet size on a phone or computer screen. The screen is calibrated with a bank card (ISO/IEC 7810 ID-1, 85.60 mm wide), then a true-size circle is matched to a ring or bangle the visitor already owns. Results are given in US, UK, EU/ISO, Indian/Japanese ring sizes, Indian bangle sizes, and mm/inches. No sign-up; measurements stay on the device.';
	$out[] = '';
	$out[] = 'Founded by ' . RBS_FOUNDER_NAME . ' (' . RBS_FOUNDER_URL . '). Contact: ' . RBS_CONTACT_EMAIL . '. Ring sizes follow ISO 8653 (inner circumference in mm); Indian bangle sizes are inner diameter in inches and sixteenths (2.4 = 2 4/16 in = 57.2 mm). Method and accuracy: ' . home_url( '/how-we-measure/' );
	$out[] = '';
	$out[] = 'Key facts:';
	$out[] = '- Average ring size: women US 6–7 (16.5–17.3 mm inner diameter), men US 9–10 (19.0–19.8 mm).';
	$out[] = '- Each whole US ring size adds about 0.81 mm of inner diameter (2.55 mm of circumference).';
	$out[] = '- Most common adult bangle sizes are 2.4 and 2.6; 2.10 is larger than 2.8 (sixteenths, not decimals).';
	$out[] = '- On-screen accuracy after card calibration: about ±¼ US ring size, one bangle size.';
	foreach ( $sections as $name => $lines ) {
		if ( ! $lines ) {
			continue;
		}
		$out[] = '';
		$out[] = '## ' . $name;
		$out[] = '';
		$out   = array_merge( $out, $lines );
	}
	$out[] = '';
	$out[] = '## Ring size chart (ISO 8653 inner sizes)';
	$out[] = '';
	$out   = array_merge( $out, $ring_rows );
	$out[] = '';
	$out[] = '## Indian bangle size chart';
	$out[] = '';
	$out   = array_merge( $out, $bangle_rows );
	$out[] = '';
	$out[] = 'Last updated: ' . gmdate( 'Y-m-d' );
	$out[] = '';
	$out[] = RBS_LLMS_MARKER;
	return implode( "\n", $out ) . "\n";
}

/**
 * Write /llms.txt in the site root (a real file, so it is served without PHP).
 * Hostinger's "Hostinger Tools" plugin writes its own file there; ours replaces it
 * after each theme release and is re-checked twice a day in case it was overwritten.
 */
function rbs_write_llms_txt() {
	// Only from the real domain: Hostinger's temporary *.hostingersite.com host would put its URLs in the file.
	if ( 'ringbanglesizer.com' !== wp_parse_url( home_url(), PHP_URL_HOST ) ) {
		return;
	}
	$file = ABSPATH . 'llms.txt';
	$body = rbs_llms_txt();
	if ( false !== @file_put_contents( $file, $body ) ) { // phpcs:ignore WordPress.PHP.NoSilencedErrors, WordPress.WP.AlternativeFunctions
		update_option( 'rbs_llms_version', RBS_VERSION . '/' . RBS_PAGES_VERSION, false );
	}
}

add_action( 'init', function () {
	if ( 'ringbanglesizer.com' !== wp_parse_url( home_url(), PHP_URL_HOST ) ) {
		return;
	}
	$due = get_option( 'rbs_llms_version' ) !== RBS_VERSION . '/' . RBS_PAGES_VERSION;
	if ( ! $due && ! get_transient( 'rbs_llms_checked' ) ) {
		set_transient( 'rbs_llms_checked', 1, 12 * HOUR_IN_SECONDS );
		$cur = @file_get_contents( ABSPATH . 'llms.txt' ); // phpcs:ignore WordPress.PHP.NoSilencedErrors, WordPress.WP.AlternativeFunctions
		$due = false === $cur || false === strpos( $cur, RBS_LLMS_MARKER ) || false !== strpos( $cur, 'hostingersite.com' );
	}
	if ( $due ) {
		// After the page sync (init 20) and after the response is sent.
		add_action( 'shutdown', 'rbs_write_llms_txt' );
	}
}, 45 );

/**
 * Fallback when the file is missing (e.g. a plugin deleted it): serve it from PHP.
 */
add_action( 'parse_request', function () {
	$path = wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '', PHP_URL_PATH );
	if ( '/llms.txt' !== $path ) {
		return;
	}
	status_header( 200 );
	header( 'Content-Type: text/plain; charset=utf-8' );
	echo rbs_llms_txt(); // phpcs:ignore WordPress.Security.EscapeOutput
	exit;
}, 0 );
