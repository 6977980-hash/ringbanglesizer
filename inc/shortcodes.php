<?php
/**
 * Shortcodes.
 *
 * [rbs_sizer mode="ring|bangle|bracelet" method="mm" name="…"] – the interactive tool
 *   method="mm" opens the ring tool on "I know the diameter / circumference";
 *   name overrides the WebApplication name in the schema.
 * [rbs_ring_table]                           – server-rendered ring conversion chart
 * [rbs_bangle_table]                         – server-rendered bangle chart
 * [rbs_cta mode="ring|bangle|bracelet"]      – link box to the tool page
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rbs_tool_url( $mode ) {
	$map = array(
		'ring'     => home_url( '/' ), // ring-sizer page is set as the front page
		'bangle'   => home_url( '/bangle-size-calculator/' ),
		'bracelet' => home_url( '/bracelet-size-calculator/' ),
	);
	return isset( $map[ $mode ] ) ? $map[ $mode ] : home_url( '/' );
}

/* ---------------------------------------------------------------- tool */

function rbs_sizer_shortcode( $atts ) {
	$atts   = shortcode_atts( array( 'mode' => 'ring', 'method' => '', 'name' => '', 'side' => '1' ), $atts, 'rbs_sizer' );
	$mode   = in_array( $atts['mode'], array( 'ring', 'bangle', 'bracelet' ), true ) ? $atts['mode'] : 'ring';
	$method = 'mm' === $atts['method'] ? 'mm' : '';

	wp_enqueue_style( 'rbs-sizer' );
	wp_enqueue_script( 'rbs-sizer' );

	// Flag for schema output.
	$GLOBALS['rbs_tool_on_page'] = $mode;
	if ( '' !== $atts['name'] ) {
		$GLOBALS['rbs_tool_name'] = sanitize_text_field( $atts['name'] );
	}

	$side = '0' !== $atts['side'];

	ob_start();
	if ( $side ) {
		echo '<div class="rbs-layout">';
	}
	?>
	<div class="rbs" data-mode="<?php echo esc_attr( $mode ); ?>"<?php echo $method ? ' data-method="' . esc_attr( $method ) . '"' : ''; ?>>
		<noscript><p><strong>This tool needs JavaScript.</strong> Use the size chart below instead.</p></noscript>
		<div class="rbs-tabs" role="tablist">
			<button type="button" class="rbs-tab" data-tab="ring" role="tab"><?php echo rbs_tab_icon( 'ring' ); // phpcs:ignore ?>Ring</button>
			<button type="button" class="rbs-tab" data-tab="bangle" role="tab"><?php echo rbs_tab_icon( 'bangle' ); // phpcs:ignore ?>Bangle</button>
			<button type="button" class="rbs-tab" data-tab="bracelet" role="tab"><?php echo rbs_tab_icon( 'bracelet' ); // phpcs:ignore ?>Bracelet</button>
		</div>
		<?php // Server-rendered steps + reserved body height (rbs-pending, sizer.css) so the tool does not push the page down when sizer.js fills it (audit F-P01). ?>
		<ol class="rbs-steps<?php echo 'bracelet' === $mode ? ' rbs-hidden' : ''; ?>"><li class="current" aria-current="step">Calibrate</li><li>Match</li><li>Your size</li></ol>
		<div class="rbs-body rbs-pending">
			<p class="rbs-loading">Loading sizer…</p>
		</div>
		<p class="rbs-trust">Free · No sign-up · Works on any phone · No photos or personal details needed · <a href="<?php echo esc_url( home_url( '/how-we-measure/#5-how-accurate-is-it' ) ); ?>">How accurate is it?</a></p>
	</div>
	<?php
	if ( $side ) {
		echo rbs_side_guide( $mode ) . '</div>'; // phpcs:ignore -- static markup
	}
	return ob_get_clean();
}

/**
 * Small icons for the Ring / Bangle / Bracelet tabs (same set as the tool cards, rbs_icon() in inc/site.php).
 */
function rbs_tab_icon( $kind ) {
	return str_replace( '<svg width="24" height="24"', '<svg class="rbs-tab-ico" width="18" height="18"', rbs_icon( $kind ) );
}

/**
 * Desktop-only "how to measure" panel next to the tool (hidden below 1100 px).
 */
function rbs_side_guide( $mode ) {
	$steps = array(
		'ring'     => array(
			'Hold any bank card on the screen and match the outline once. No card? Use a coin.',
			'Lay a ring that fits flat on the circle and match its <strong>inside</strong> edge.',
			'Read your size, then tap Save so this device remembers it.',
		),
		'bangle'   => array(
			'Calibrate once with a bank card or a coin.',
			'Lay a bangle that fits flat on the circle and match its <strong>inside</strong> edge. No bangle? Enter your hand size.',
			'Read your Indian size, then tap Save.',
		),
		'bracelet' => array(
			'Wrap a string or paper strip around your wrist, just below the bone.',
			'Mark where it meets and measure it on a ruler.',
			'Enter it and pick snug, comfortable or loose.',
		),
	);
	$tips = array(
		'ring'     => array( 'Measure in the evening: fingers are smallest in the morning.', 'Between two sizes? Choose the larger one.' ),
		'bangle'   => array( 'A rigid bangle must pass your folded hand, not just your wrist.', 'Between two sizes? Choose the larger one.' ),
		'bracelet' => array( 'Keep the string snug but not tight.', 'Measure the wrist you wear jewellery on.' ),
	);
	$links = array(
		'ring'     => array( array( '/how-to-measure-ring-size-at-home/', 'No ring? 5 ways to measure' ), array( '/blog/find-ring-size-secretly/', 'Buying a surprise? Find their size' ) ),
		'bangle'   => array( array( '/how-to-measure-bangle-size/', 'No bangle? Measure your hand' ), array( '/blog/find-ring-size-secretly/', 'Buying a gift? Find their size' ) ),
		'bracelet' => array( array( '/wrist-size-chart/', 'Wrist size chart' ) ),
	);
	$html = '<aside class="rbs-side" aria-label="How to measure"><p class="rbs-side-t">How to measure in 30 seconds</p><ol>';
	foreach ( $steps[ $mode ] as $s ) {
		$html .= '<li>' . $s . '</li>';
	}
	$html .= '</ol><ul class="rbs-side-tips">';
	foreach ( $tips[ $mode ] as $t ) {
		$html .= '<li>' . esc_html( $t ) . '</li>';
	}
	$html .= '</ul><p class="rbs-side-links">';
	foreach ( $links[ $mode ] as $l ) {
		$html .= '<a href="' . esc_url( home_url( $l[0] ) ) . '">' . esc_html( $l[1] ) . ' →</a>';
	}
	return $html . '</p></aside>';
}
add_shortcode( 'rbs_sizer', 'rbs_sizer_shortcode' );

/* ------------------------------------------------------------- tables */

function rbs_ring_table_shortcode() {
	$rows = rbs_ring_sizes();
	ob_start();
	?>
	<div class="rbs-table-wrap">
	<table class="rbs-table rbs-ring-table">
		<thead>
			<tr>
				<th>US / Canada</th>
				<th>UK / Australia</th>
				<th>EU / ISO</th>
				<th>India / Pakistan</th>
				<th>Diameter (mm)</th>
				<th>Diameter (in)</th>
				<th>Circumference (mm)</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ( $rows as $r ) : $d = rbs_ring_derived( $r['mm'] ); ?>
			<tr>
				<td><?php echo esc_html( $r['us'] ); ?></td>
				<td><?php echo esc_html( $r['uk'] ); ?></td>
				<td><?php echo esc_html( $d['eu'] ); ?></td>
				<td><?php echo esc_html( $d['india'] ); ?></td>
				<td><?php echo esc_html( number_format( $r['mm'], 1 ) ); ?></td>
				<td><?php echo esc_html( number_format( $d['inch'], 2 ) ); ?></td>
				<td><?php echo esc_html( number_format( $d['circ_mm'], 1 ) ); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'rbs_ring_table', 'rbs_ring_table_shortcode' );

function rbs_bangle_table_shortcode() {
	$rows = rbs_bangle_sizes();
	ob_start();
	?>
	<div class="rbs-table-wrap">
	<table class="rbs-table rbs-bangle-table">
		<thead>
			<tr>
				<th>Indian size</th>
				<th>Inner diameter (in)</th>
				<th>Inner diameter (mm)</th>
				<th>Inner diameter (cm)</th>
				<th>Circumference (mm)</th>
				<th>Typical fit</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ( $rows as $b ) : ?>
			<tr>
				<td><?php echo esc_html( $b['label'] ); ?></td>
				<td><?php echo esc_html( number_format( $b['inch'], 3 ) ); ?></td>
				<td><?php echo esc_html( number_format( $b['mm'], 1 ) ); ?></td>
				<td><?php echo esc_html( number_format( $b['mm'] / 10, 2 ) ); ?></td>
				<td><?php echo esc_html( number_format( $b['mm'] * M_PI, 1 ) ); ?></td>
				<td><?php echo esc_html( $b['fit'] ); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'rbs_bangle_table', 'rbs_bangle_table_shortcode' );

/* ---------------------------------------------------------------- cta */

function rbs_cta_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'mode' => 'ring' ), $atts, 'rbs_cta' );
	$mode = in_array( $atts['mode'], array( 'ring', 'bangle', 'bracelet' ), true ) ? $atts['mode'] : 'ring';
	$text = array(
		'ring'     => 'Not sure of your ring size? Measure it on your phone screen in 30 seconds.',
		'bangle'   => 'Find your bangle size on screen – no tape, no guesswork.',
		'bracelet' => 'Get your bracelet length from your wrist measurement.',
	);
	return sprintf(
		'<div class="rbs-cta"><p>%s</p><a class="button" href="%s">Open the free %s sizer →</a></div>',
		esc_html( $text[ $mode ] ),
		esc_url( rbs_tool_url( $mode ) ),
		esc_html( $mode )
	);
}
add_shortcode( 'rbs_cta', 'rbs_cta_shortcode' );

/* ------------------------------------------------------ size detail */

/**
 * Pages that exist for a single size (used for neighbour links).
 */
function rbs_bangle_size_page_slugs() {
	return array( '2.2', '2.4', '2.6', '2.8', '2.10', '2.12' );
}
function rbs_ring_size_page_sizes() {
	return array( 5, 5.5, 6, 6.5, 7, 7.5, 8, 9, 10 );
}

function rbs_bangle_size_url( $label ) {
	if ( in_array( $label, rbs_bangle_size_page_slugs(), true ) ) {
		return home_url( '/bangle-size/' . str_replace( '.', '-', $label ) . '/' );
	}
	return home_url( '/bangle-size-chart/' );
}

function rbs_ring_size_url( $us ) {
	foreach ( rbs_ring_size_page_sizes() as $s ) {
		if ( abs( $s - $us ) < 0.01 ) {
			return home_url( '/ring-size-in-mm/size-' . str_replace( '.', '-', (string) $s ) . '/' );
		}
	}
	return home_url( '/ring-size-in-mm/' );
}

/**
 * "2.4" → "2 4/16 in (2¼ in)".
 */
function rbs_bangle_fraction( $label ) {
	$parts = explode( '.', $label );
	$whole = (int) $parts[0];
	$six   = isset( $parts[1] ) ? (int) $parts[1] : 0;
	$simple = array( 0 => '', 2 => '⅛', 4 => '¼', 6 => '⅜', 8 => '½', 10 => '⅝', 12 => '¾', 14 => '⅞' );
	if ( 0 === $six ) {
		return $whole . ' in';
	}
	return $whole . ' ' . $six . '/16 in (' . $whole . ( isset( $simple[ $six ] ) ? $simple[ $six ] : '' ) . ' in)';
}

/**
 * [rbs_bangle_size size="2.4"] – one bangle size in every unit, with the hand range it fits.
 */
function rbs_bangle_size_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'size' => '2.4' ), $atts, 'rbs_bangle_size' );
	$all  = rbs_bangle_sizes();
	$idx  = null;
	foreach ( $all as $i => $b ) {
		if ( $b['label'] === $atts['size'] ) {
			$idx = $i;
		}
	}
	if ( null === $idx ) {
		return '';
	}
	$b        = $all[ $idx ];
	$prev     = $idx > 0 ? $all[ $idx - 1 ] : null;
	$next     = isset( $all[ $idx + 1 ] ) ? $all[ $idx + 1 ] : null;
	$circ     = $b['mm'] * M_PI;
	$hand_min = $prev ? $prev['mm'] * M_PI : 0;
	$rows     = array(
		array( 'Indian bangle size', esc_html( $b['label'] ) ),
		array( 'Inner diameter (inches)', esc_html( rbs_bangle_fraction( $b['label'] ) . ' = ' . number_format( $b['inch'], 3 ) . ' in' ) ),
		array( 'Inner diameter (mm)', esc_html( number_format( $b['mm'], 1 ) . ' mm' ) ),
		array( 'Inner diameter (cm)', esc_html( number_format( $b['mm'] / 10, 2 ) . ' cm' ) ),
		array( 'Inner circumference', esc_html( number_format( $circ, 1 ) . ' mm = ' . number_format( $circ / 10, 1 ) . ' cm = ' . number_format( $circ / 25.4, 2 ) . ' in' ) ),
		array( 'Fits a hand circumference of', esc_html( ( $prev ? 'over ' . number_format( $hand_min / 10, 1 ) . ' cm up to ' : 'up to ' ) . number_format( $circ / 10, 1 ) . ' cm (' . ( $prev ? number_format( $hand_min / 25.4, 2 ) . '–' : 'up to ' ) . number_format( $circ / 25.4, 2 ) . ' in)' ) ),
		array( 'Typical wearer', esc_html( $b['fit'] ) ),
	);
	if ( $prev ) {
		$rows[] = array( 'One size smaller', '<a href="' . esc_url( rbs_bangle_size_url( $prev['label'] ) ) . '">' . esc_html( $prev['label'] ) . '</a> (' . esc_html( number_format( $prev['mm'], 1 ) ) . ' mm)' );
	}
	if ( $next ) {
		$rows[] = array( 'One size larger', '<a href="' . esc_url( rbs_bangle_size_url( $next['label'] ) ) . '">' . esc_html( $next['label'] ) . '</a> (' . esc_html( number_format( $next['mm'], 1 ) ) . ' mm)' );
	}
	return rbs_true_size_box( $b['mm'], $b['label'], 'bangle' ) . rbs_kv_table( $rows, 'Bangle size ' . $b['label'] . ' measurements' );
}
add_shortcode( 'rbs_bangle_size', 'rbs_bangle_size_shortcode' );

/**
 * [rbs_ring_size us="7"] – one ring size in every system.
 */
function rbs_ring_size_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'us' => '7' ), $atts, 'rbs_ring_size' );
	$us   = (float) $atts['us'];
	$all  = rbs_ring_sizes();
	$idx  = null;
	foreach ( $all as $i => $r ) {
		if ( abs( $r['us'] - $us ) < 0.01 ) {
			$idx = $i;
		}
	}
	if ( null === $idx ) {
		return '';
	}
	$r    = $all[ $idx ];
	$d    = rbs_ring_derived( $r['mm'] );
	$prev = $idx > 0 ? $all[ $idx - 1 ] : null;
	$next = isset( $all[ $idx + 1 ] ) ? $all[ $idx + 1 ] : null;
	$rows = array(
		array( 'US / Canada size', esc_html( $r['us'] ) ),
		array( 'Inner diameter', esc_html( number_format( $r['mm'], 1 ) . ' mm = ' . number_format( $d['inch'], 3 ) . ' in' ) ),
		array( 'Inner circumference', esc_html( number_format( $d['circ_mm'], 1 ) . ' mm = ' . number_format( $d['circ_mm'] / 25.4, 2 ) . ' in' ) ),
		array( 'UK / Australia', esc_html( $r['uk'] ) ),
		array( 'EU / ISO / Germany', esc_html( $d['eu'] ) ),
		array( 'India / Pakistan', esc_html( $d['india'] ) ),
		array( 'Italy / Spain / Switzerland', esc_html( $d['eu'] - 40 ) ),
	);
	if ( $prev ) {
		$rows[] = array( 'Half size smaller', '<a href="' . esc_url( rbs_ring_size_url( $prev['us'] ) ) . '">US ' . esc_html( $prev['us'] ) . '</a> (' . esc_html( number_format( $prev['mm'], 1 ) ) . ' mm)' );
	}
	if ( $next ) {
		$rows[] = array( 'Half size larger', '<a href="' . esc_url( rbs_ring_size_url( $next['us'] ) ) . '">US ' . esc_html( $next['us'] ) . '</a> (' . esc_html( number_format( $next['mm'], 1 ) ) . ' mm)' );
	}
	return rbs_true_size_box( $r['mm'], 'US ' . $r['us'], 'ring' ) . rbs_kv_table( $rows, 'Ring size ' . $r['us'] . ' measurements' );
}
add_shortcode( 'rbs_ring_size', 'rbs_ring_size_shortcode' );

/**
 * Real-size circle at the top of a size page, drawn by widgets.js with the
 * visitor's saved calibration (rbs_ppm_v1), so the page doubles as a sizer.
 */
function rbs_true_size_box( $mm, $label, $kind ) {
	wp_enqueue_script( 'rbs-widgets' );
	return sprintf(
		'<div class="rbs-true" data-mm="%1$s" data-label="%2$s" data-kind="%3$s" data-tool="%4$s" style="--mm:%1$s"><noscript><p>Turn on JavaScript to see this size drawn at real size.</p></noscript></div>',
		esc_attr( number_format( $mm, 2, '.', '' ) ),
		esc_attr( $label ),
		esc_attr( $kind ),
		esc_url( rbs_tool_url( 'bangle' === $kind ? 'bangle' : 'ring' ) )
	);
}

/**
 * Two-column table. Values are already escaped by the caller.
 */
function rbs_kv_table( $rows, $caption ) {
	$html = '<div class="rbs-table-wrap"><table class="rbs-table rbs-kv"><caption>' . esc_html( $caption ) . '</caption><tbody>';
	foreach ( $rows as $row ) {
		$html .= '<tr><th scope="row">' . esc_html( $row[0] ) . '</th><td>' . $row[1] . '</td></tr>';
	}
	return $html . '</tbody></table></div>';
}

/**
 * [rbs_bangle_cm_table] – bangle sizes in cm with the hand circumference each one clears.
 */
function rbs_bangle_cm_table_shortcode() {
	$all  = rbs_bangle_sizes();
	$html = '<div class="rbs-table-wrap"><table class="rbs-table"><thead><tr><th>Bangle size</th><th>Diameter (cm)</th><th>Circumference (cm)</th><th>Hand circumference it clears (cm)</th><th>Diameter (in)</th></tr></thead><tbody>';
	foreach ( $all as $i => $b ) {
		$min   = $i > 0 ? $all[ $i - 1 ]['mm'] * M_PI / 10 : 0;
		$max   = $b['mm'] * M_PI / 10;
		$range = $i > 0 ? number_format( $min, 1 ) . '–' . number_format( $max, 1 ) : 'up to ' . number_format( $max, 1 );
		$label = in_array( $b['label'], rbs_bangle_size_page_slugs(), true )
			? '<a href="' . esc_url( rbs_bangle_size_url( $b['label'] ) ) . '">' . esc_html( $b['label'] ) . '</a>'
			: esc_html( $b['label'] );
		$html .= '<tr><td>' . $label . '</td><td>' . esc_html( number_format( $b['mm'] / 10, 2 ) ) . '</td><td>' . esc_html( number_format( $max, 1 ) ) . '</td><td>' . esc_html( $range ) . '</td><td>' . esc_html( number_format( $b['inch'], 3 ) ) . '</td></tr>';
	}
	return $html . '</tbody></table></div>';
}
add_shortcode( 'rbs_bangle_cm_table', 'rbs_bangle_cm_table_shortcode' );

/**
 * [rbs_mm_lookup] – measured diameter (every 0.5 mm) → nearest ring size.
 */
function rbs_mm_lookup_shortcode() {
	$html = '<div class="rbs-table-wrap"><table class="rbs-table"><thead><tr><th>You measured (mm)</th><th>Circumference (mm)</th><th>Nearest US</th><th>Nearest UK</th><th>EU</th></tr></thead><tbody>';
	for ( $mm = 14.0; $mm <= 23.01; $mm += 0.5 ) {
		$best = rbs_nearest_ring( $mm );
		$us = in_array( (float) $best['us'], array_map( 'floatval', rbs_ring_size_page_sizes() ), true )
			? '<a href="' . esc_url( rbs_ring_size_url( $best['us'] ) ) . '">' . esc_html( $best['us'] ) . '</a>'
			: esc_html( $best['us'] );
		$html .= '<tr><td>' . esc_html( number_format( $mm, 1 ) ) . '</td><td>' . esc_html( number_format( $mm * M_PI, 1 ) ) . '</td><td>' . $us . '</td><td>' . esc_html( $best['uk'] ) . '</td><td>' . esc_html( (int) round( $mm * M_PI ) ) . '</td></tr>';
	}
	return $html . '</tbody></table></div>';
}
add_shortcode( 'rbs_mm_lookup', 'rbs_mm_lookup_shortcode' );

/* ------------------------------------------------------- guide widgets */

/**
 * [rbs_fit_quiz] – 30-second "is my ring too tight or too loose?" quiz.
 */
function rbs_fit_quiz_shortcode() {
	wp_enqueue_script( 'rbs-widgets' );
	return '<div class="rbs-widget rbs-quiz"><noscript><p>Use the three-point fit test below.</p></noscript></div>';
}
add_shortcode( 'rbs_fit_quiz', 'rbs_fit_quiz_shortcode' );

/**
 * [rbs_kids_growth] – estimate a child's bangle size over the next three years.
 */
function rbs_kids_growth_shortcode() {
	wp_enqueue_script( 'rbs-widgets' );
	return '<div class="rbs-widget rbs-growth"><noscript><p>Use the chart by age above.</p></noscript></div>';
}
add_shortcode( 'rbs_kids_growth', 'rbs_kids_growth_shortcode' );
