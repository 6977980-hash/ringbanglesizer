<?php
/**
 * Phase 3 tool shortcodes (ring tool cluster).
 *
 * [rbs_ring_converter]          – US/UK/EU/India/mm converter (small JS, server table as fallback)
 * [rbs_circ_lookup]             – finger circumference (mm) → ring size
 * [rbs_inch_lookup]             – ring inner diameter (inches) → ring size
 * [rbs_printable_sizer]         – PDF download buttons + true-size circle preview
 * [rbs_wrist_table]             – wrist size → bracelet lengths
 * [rbs_diameter_ranges]         – diameter band (mm / in) → ring size
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rbs_register_phase3_assets() {
	wp_register_script( 'rbs-converter', RBS_URI . '/assets/js/converter.js', array(), RBS_VERSION, array( 'strategy' => 'defer', 'in_footer' => true ) );
}
add_action( 'wp_enqueue_scripts', 'rbs_register_phase3_assets' );

/**
 * Nearest ring row to an inner diameter in mm.
 */
function rbs_nearest_ring( $mm ) {
	$all  = rbs_ring_sizes();
	$best = $all[0];
	foreach ( $all as $r ) {
		// "<=" with a small margin: a measurement exactly between two sizes gets the larger one.
		if ( abs( $r['mm'] - $mm ) <= abs( $best['mm'] - $mm ) + 1e-9 ) {
			$best = $r;
		}
	}
	return $best;
}

/**
 * US size, linked to its own page when one exists.
 */
function rbs_us_link( $us ) {
	$has_page = in_array( (float) $us, array_map( 'floatval', rbs_ring_size_page_sizes() ), true );
	return $has_page
		? '<a href="' . esc_url( rbs_ring_size_url( $us ) ) . '">' . esc_html( $us ) . '</a>'
		: esc_html( $us );
}

/* ------------------------------------------------------------ converter */

function rbs_ring_converter_shortcode() {
	wp_enqueue_script( 'rbs-converter' );

	$rows = rbs_ring_rows_for_js();
	foreach ( $rows as $i => $r ) {
		$url             = rbs_ring_size_url( $r['us'] );
		$rows[ $i ]['url'] = false !== strpos( $url, '/size-' ) ? $url : '';
	}
	$json = wp_json_encode( $rows, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

	ob_start();
	?>
	<div class="rbs-conv" data-rings="<?php echo esc_attr( $json ); ?>" data-uk="<?php echo esc_attr( wp_json_encode( rbs_uk_rows_for_js(), JSON_UNESCAPED_UNICODE ) ); ?>">
		<div class="rbs-conv-fields">
			<label>Convert from
				<select class="rbs-conv-from">
					<option value="us">US / Canada size</option>
					<option value="uk">UK / Australia size</option>
					<option value="eu">EU / ISO size</option>
					<option value="india">India / Pakistan size</option>
					<option value="mm">Inner diameter (mm)</option>
					<option value="circ">Inner circumference (mm)</option>
					<option value="in">Inner diameter (inches)</option>
				</select>
			</label>
			<label>Size
				<select class="rbs-conv-size"></select>
				<input class="rbs-conv-num" type="number" step="0.1" min="0.4" max="80" hidden>
			</label>
		</div>
		<div class="rbs-conv-out" aria-live="polite">
			<noscript><p>The converter needs JavaScript. Use the chart below instead.</p></noscript>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'rbs_ring_converter', 'rbs_ring_converter_shortcode' );

/* -------------------------------------------------------------- lookups */

function rbs_circ_lookup_shortcode() {
	$html = '<div class="rbs-table-wrap"><table class="rbs-table"><thead><tr><th>Finger circumference (mm)</th><th>In inches</th><th>Diameter (mm)</th><th>Nearest US</th><th>Nearest UK</th><th>EU</th></tr></thead><tbody>';
	for ( $c = 44; $c <= 75; $c++ ) {
		$d    = $c / M_PI;
		$best = rbs_nearest_ring( $d );
		$html .= '<tr><td>' . esc_html( $c ) . '</td><td>' . esc_html( number_format( $c / 25.4, 2 ) ) . '</td><td>' . esc_html( number_format( $d, 1 ) ) . '</td><td>' . rbs_us_link( $best['us'] ) . '</td><td>' . esc_html( $best['uk'] ) . '</td><td>' . esc_html( $c ) . '</td></tr>';
	}
	return $html . '</tbody></table></div>';
}
add_shortcode( 'rbs_circ_lookup', 'rbs_circ_lookup_shortcode' );

function rbs_inch_lookup_shortcode() {
	$html = '<div class="rbs-table-wrap"><table class="rbs-table"><thead><tr><th>Diameter (in)</th><th>Diameter (mm)</th><th>Nearest US</th><th>Nearest UK</th><th>EU</th></tr></thead><tbody>';
	for ( $i = 56; $i <= 94; $i += 2 ) {
		$in   = $i / 100;
		$mm   = $in * 25.4;
		$best = rbs_nearest_ring( $mm );
		$html .= '<tr><td>' . esc_html( number_format( $in, 2 ) ) . '</td><td>' . esc_html( number_format( $mm, 1 ) ) . '</td><td>' . rbs_us_link( $best['us'] ) . '</td><td>' . esc_html( $best['uk'] ) . '</td><td>' . esc_html( (int) round( $mm * M_PI ) ) . '</td></tr>';
	}
	return $html . '</tbody></table></div>';
}
add_shortcode( 'rbs_inch_lookup', 'rbs_inch_lookup_shortcode' );

/* ------------------------------------------------------------ printable */

function rbs_printable_sizer_shortcode() {
	$a4     = RBS_URI . '/assets/printable/ring-sizer-a4.pdf';
	$letter = RBS_URI . '/assets/printable/ring-sizer-letter.pdf';

	// True-size preview: SVG in mm units, printed at 100% it matches the PDF circles.
	$circles = array();
	foreach ( rbs_ring_sizes() as $r ) {
		if ( $r['us'] >= 5 && $r['us'] <= 10 && floor( $r['us'] ) == $r['us'] ) { // phpcs:ignore Universal.Operators.StrictComparisons
			$circles[] = $r;
		}
	}
	$cell = 30;
	$w    = $cell * count( $circles );
	$svg  = '<svg class="rbs-print-preview" width="' . $w . 'mm" height="34mm" viewBox="0 0 ' . $w . ' 34" role="img" aria-label="True-size ring circles for US sizes 5 to 10">';
	foreach ( $circles as $i => $r ) {
		$cx   = $cell * $i + $cell / 2;
		$svg .= '<circle cx="' . $cx . '" cy="13" r="' . ( $r['mm'] / 2 ) . '" fill="none" stroke="#1d4ed8" stroke-width="0.3"/>';
		$svg .= '<text x="' . $cx . '" y="31" text-anchor="middle" font-size="3.4" font-family="sans-serif" fill="#111827">US ' . esc_html( $r['us'] ) . ' · ' . esc_html( number_format( $r['mm'], 1 ) ) . '</text>';
	}
	$svg .= '</svg>';

	return '<div class="rbs-printable">'
		. '<p class="rbs-printable-buttons">'
		. '<a class="button" href="' . esc_url( $letter ) . '" download>Download PDF – US Letter</a> '
		. '<a class="button" href="' . esc_url( $a4 ) . '" download>Download PDF – A4</a>'
		. '</p>'
		. '<p class="rbs-muted">One page, free, no sign-up. Print at <strong>100% / Actual size</strong>.</p>'
		. '<div class="rbs-table-wrap">' . $svg . '</div>'
		. '</div>';
}
add_shortcode( 'rbs_printable_sizer', 'rbs_printable_sizer_shortcode' );

/* ---------------------------------------------------------- wrist table */

function rbs_wrist_table_shortcode() {
	$html = '<div class="rbs-table-wrap"><table class="rbs-table"><thead><tr><th>Wrist (in)</th><th>Wrist (cm)</th><th>Snug chain bracelet</th><th>Comfortable chain bracelet</th><th>Loose chain bracelet</th><th>Watch / wrist size</th></tr></thead><tbody>';
	for ( $q = 20; $q <= 36; $q++ ) {
		$in = $q / 4; // 5.00 … 9.00 in quarter inches
		if ( $in < 5.5 ) {
			$label = 'Extra small / child';
		} elseif ( $in < 6 ) {
			$label = 'Small';
		} elseif ( $in < 7 ) {
			$label = 'Medium';
		} elseif ( $in < 8 ) {
			$label = 'Large';
		} else {
			$label = 'Extra large';
		}
		$cell = function ( $x ) {
			return number_format( $x, 2 ) . ' in / ' . number_format( $x * 2.54, 1 ) . ' cm';
		};
		$html .= '<tr><td>' . esc_html( number_format( $in, 2 ) ) . '</td><td>' . esc_html( number_format( $in * 2.54, 1 ) ) . '</td><td>' . esc_html( $cell( $in + 0.5 ) ) . '</td><td>' . esc_html( $cell( $in + 0.75 ) ) . '</td><td>' . esc_html( $cell( $in + 1.25 ) ) . '</td><td>' . esc_html( $label ) . '</td></tr>';
	}
	return $html . '</tbody></table></div>';
}
add_shortcode( 'rbs_wrist_table', 'rbs_wrist_table_shortcode' );

/**
 * [rbs_diameter_ranges] – for each US size, the band of measured diameters that rounds to it.
 */
function rbs_diameter_ranges_shortcode() {
	$all  = rbs_ring_sizes();
	$html = '<div class="rbs-table-wrap"><table class="rbs-table"><thead><tr><th>Measured inner diameter</th><th>In inches</th><th>US size</th><th>UK size</th><th>EU size</th></tr></thead><tbody>';
	$n    = count( $all );
	foreach ( $all as $i => $r ) {
		$lo = $i > 0 ? ( $all[ $i - 1 ]['mm'] + $r['mm'] ) / 2 : $r['mm'] - 0.2;
		$hi = $i < $n - 1 ? ( $all[ $i + 1 ]['mm'] + $r['mm'] ) / 2 : $r['mm'] + 0.2;
		$d  = rbs_ring_derived( $r['mm'] );
		// Bands are half-open [lo, hi): a reading exactly on the midpoint belongs to the larger size.
		$top = $i < $n - 1 ? $hi - 0.01 : $hi;
		$html .= '<tr><td>' . esc_html( number_format( $lo, 2 ) . '–' . number_format( $top, 2 ) . ' mm' ) . '</td><td>' . esc_html( number_format( $lo / 25.4, 3 ) . '–' . number_format( $top / 25.4, 3 ) ) . '</td><td>' . rbs_us_link( $r['us'] ) . '</td><td>' . esc_html( $r['uk'] ) . '</td><td>' . esc_html( $d['eu'] ) . '</td></tr>';
	}
	return $html . '</tbody></table></div>';
}
add_shortcode( 'rbs_diameter_ranges', 'rbs_diameter_ranges_shortcode' );
