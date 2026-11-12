<?php
/**
 * Single source of truth for size data.
 * Used by the PHP table shortcodes (SEO, server-rendered) and passed to sizer.js.
 *
 * Inner diameters for each size, matching ISO 8653 (which defines size by inner
 * circumference) and common US jeweller charts.
 * UK letters are the usual US→UK mapping (half sizes shown with ½).
 * EU/ISO = inner circumference in mm. India (and Pakistan) numbers = inner circumference − 40 mm,
 * the scale Tanishq and BlueStone print (India 22 = 19.8 mm).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @return array<int, array{us:float, uk:string, mm:float}>
 */
function rbs_ring_sizes() {
	return array(
		array( 'us' => 3,    'uk' => 'F',   'mm' => 14.1 ),
		array( 'us' => 3.5,  'uk' => 'G',   'mm' => 14.5 ),
		array( 'us' => 4,    'uk' => 'H',   'mm' => 14.9 ),
		array( 'us' => 4.5,  'uk' => 'I',   'mm' => 15.3 ),
		array( 'us' => 5,    'uk' => 'J½',  'mm' => 15.7 ),
		array( 'us' => 5.5,  'uk' => 'K½',  'mm' => 16.1 ),
		array( 'us' => 6,    'uk' => 'L½',  'mm' => 16.5 ),
		array( 'us' => 6.5,  'uk' => 'M½',  'mm' => 16.9 ),
		array( 'us' => 7,    'uk' => 'N½',  'mm' => 17.3 ),
		array( 'us' => 7.5,  'uk' => 'O½',  'mm' => 17.7 ),
		array( 'us' => 8,    'uk' => 'P½',  'mm' => 18.1 ),
		array( 'us' => 8.5,  'uk' => 'Q½',  'mm' => 18.5 ),
		array( 'us' => 9,    'uk' => 'R½',  'mm' => 19.0 ),
		array( 'us' => 9.5,  'uk' => 'S½',  'mm' => 19.4 ),
		array( 'us' => 10,   'uk' => 'T½',  'mm' => 19.8 ),
		array( 'us' => 10.5, 'uk' => 'U½',  'mm' => 20.2 ),
		array( 'us' => 11,   'uk' => 'V½',  'mm' => 20.6 ),
		array( 'us' => 11.5, 'uk' => 'W½',  'mm' => 21.0 ),
		array( 'us' => 12,   'uk' => 'X½',  'mm' => 21.4 ),
		array( 'us' => 12.5, 'uk' => 'Z',   'mm' => 21.8 ),
		array( 'us' => 13,   'uk' => 'Z+1', 'mm' => 22.2 ),
		array( 'us' => 13.5, 'uk' => 'Z+2', 'mm' => 22.6 ),
		array( 'us' => 14,   'uk' => 'Z+3', 'mm' => 23.0 ),
		array( 'us' => 14.5, 'uk' => 'Z+4', 'mm' => 23.4 ),
		array( 'us' => 15,   'uk' => 'Z+5', 'mm' => 23.8 ),
	);
}

/**
 * Indian bangle sizes. Label "2.4" means 2 4/16 inch inner diameter.
 *
 * @return array<int, array{label:string, inch:float, mm:float, fit:string}>
 */
function rbs_bangle_sizes() {
	return array(
		array( 'label' => '1.10', 'inch' => 1.625, 'mm' => 41.3, 'fit' => 'Baby (0–1 yr)' ),
		array( 'label' => '1.12', 'inch' => 1.75,  'mm' => 44.5, 'fit' => 'Toddler (1–2 yr)' ),
		array( 'label' => '1.14', 'inch' => 1.875, 'mm' => 47.6, 'fit' => 'Child (2–4 yr)' ),
		array( 'label' => '2.0',  'inch' => 2.0,   'mm' => 50.8, 'fit' => 'Child (4–7 yr)' ),
		array( 'label' => '2.2',  'inch' => 2.125, 'mm' => 54.0, 'fit' => 'Petite / teen' ),
		array( 'label' => '2.4',  'inch' => 2.25,  'mm' => 57.2, 'fit' => 'Small' ),
		array( 'label' => '2.6',  'inch' => 2.375, 'mm' => 60.3, 'fit' => 'Medium' ),
		array( 'label' => '2.8',  'inch' => 2.5,   'mm' => 63.5, 'fit' => 'Large' ),
		array( 'label' => '2.10', 'inch' => 2.625, 'mm' => 66.7, 'fit' => 'Extra large' ),
		array( 'label' => '2.12', 'inch' => 2.75,  'mm' => 69.9, 'fit' => 'XXL' ),
		array( 'label' => '2.14', 'inch' => 2.875, 'mm' => 73.0, 'fit' => 'XXXL' ),
		array( 'label' => '3.0',  'inch' => 3.0,   'mm' => 76.2, 'fit' => 'Men / kada' ),
		array( 'label' => '3.2',  'inch' => 3.125, 'mm' => 79.4, 'fit' => 'Large men\'s kada' ),
		array( 'label' => '3.4',  'inch' => 3.25,  'mm' => 82.6, 'fit' => 'Extra-large men\'s kada' ),
	);
}

/**
 * The "most common ring size" ranges, built from the size table so every page
 * quotes the same letters and mm (women US 6–7, men US 9–10).
 */
function rbs_avg_ring_range( $who ) {
	list( $lo, $hi ) = 'men' === $who ? array( 9, 10 ) : array( 6, 7 );
	$rows = array();
	foreach ( rbs_ring_sizes() as $r ) {
		$rows[ (string) $r['us'] ] = $r;
	}
	$a = $rows[ (string) $lo ];
	$b = $rows[ (string) $hi ];
	return array(
		'us' => 'US ' . $lo . ' to ' . $hi,
		'uk' => $a['uk'] . ' to ' . $b['uk'],
		'mm' => number_format( $a['mm'], 1 ) . ' to ' . number_format( $b['mm'], 1 ) . ' mm',
	);
}

/**
 * Tokens page content may use; replaced in rbs_all_pages() before pages are synced,
 * so the numbers come from the size table and cannot drift between pages.
 *
 * @return array<string, string>
 */
function rbs_content_tokens() {
	$w = rbs_avg_ring_range( 'women' );
	$m = rbs_avg_ring_range( 'men' );
	return array(
		'{{avg_w}}'    => $w['us'] . ' (UK ' . $w['uk'] . ', ' . $w['mm'] . ')',
		'{{avg_m}}'    => $m['us'] . ' (UK ' . $m['uk'] . ', ' . $m['mm'] . ')',
		'{{avg_w_uk}}' => $w['uk'] . ' (' . $w['us'] . ', ' . $w['mm'] . ')',
		'{{avg_m_uk}}' => $m['uk'] . ' (' . $m['us'] . ', ' . $m['mm'] . ')',
	);
}

/**
 * Hand circumference range one bangle size fits, at 0.1 cm / 0.1 in steps.
 * Same rule as the calculator (sizer.js nearestBangleUp): the first size whose
 * inner diameter is at least hand / π (0.05 mm absorbs rounding). The upper
 * bound is floored so a typed value on the edge gives this size, not the next.
 *
 * @return array{min_cm:?float, max_cm:float, min_in:?float, max_in:float}|null
 */
function rbs_bangle_hand_range( $label ) {
	$prev_up = null;
	foreach ( rbs_bangle_sizes() as $b ) {
		$up = ( $b['mm'] + 0.05 ) * M_PI; // mm of hand circumference.
		if ( $b['label'] === $label ) {
			return array(
				'min_cm' => null === $prev_up ? null : ( floor( $prev_up ) + 1 ) / 10,
				'max_cm' => floor( $up ) / 10,
				'min_in' => null === $prev_up ? null : ( floor( $prev_up / 2.54 ) + 1 ) / 10,
				'max_in' => floor( $up / 2.54 ) / 10,
			);
		}
		$prev_up = $up;
	}
	return null;
}

/**
 * Derived values for one ring size row.
 */
function rbs_ring_derived( $mm ) {
	$circ  = $mm * M_PI;
	return array(
		'circ_mm' => round( $circ, 1 ),
		'eu'      => (int) round( $circ ),            // EU / ISO size = circumference in mm
		'india'   => rbs_india_size( $mm ),           // India / Pakistan number
		'inch'    => round( $mm / 25.4, 3 ),
	);
}

/**
 * Indian / Pakistani ring number for an inner diameter: circumference − 40 mm, rounded.
 */
function rbs_india_size( $mm ) {
	return max( 1, (int) round( $mm * M_PI - 40 ) );
}

/**
 * Inner diameter (mm) of Indian ring number $n.
 */
function rbs_india_mm( $n ) {
	return ( $n + 40 ) / M_PI;
}

/**
 * Ring rows with every system, as passed to the front-end scripts.
 */
function rbs_ring_rows_for_js() {
	$rings = array();
	foreach ( rbs_ring_sizes() as $r ) {
		$d       = rbs_ring_derived( $r['mm'] );
		$rings[] = array(
			'us'   => $r['us'],
			'uk'   => $r['uk'],
			'mm'   => $r['mm'],
			'circ' => $d['circ_mm'],
			'eu'   => $d['eu'],
			'india' => $d['india'],
		);
	}
	return $rings;
}

/**
 * UK letters (whole and half, F … Z) with their inner diameter, for the
 * "Will it fit?" reader and the converter, so they match the UK chart.
 */
function rbs_uk_rows_for_js() {
	$out = array();
	foreach ( rbs_uk_ring_rows() as $r ) {
		$out[] = array( 'uk' => $r['uk'], 'mm' => round( $r['mm'], 2 ) );
	}
	return $out;
}
