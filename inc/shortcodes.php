<?php
/**
 * Shortcodes.
 *
 * [rbs_sizer mode="ring|bangle|bracelet"]   – the interactive tool
 * [rbs_ring_table]                           – server-rendered ring conversion chart
 * [rbs_bangle_table]                         – server-rendered bangle chart
 * [rbs_cta mode="ring|bangle|bracelet"]      – link box to the tool page
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rbs_tool_url( $mode ) {
	$map = array(
		'ring'     => home_url( '/' ),
		'bangle'   => home_url( '/bangle-size-calculator/' ),
		'bracelet' => home_url( '/bracelet-size-calculator/' ),
	);
	return isset( $map[ $mode ] ) ? $map[ $mode ] : home_url( '/' );
}

/* ---------------------------------------------------------------- tool */

function rbs_sizer_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'mode' => 'ring' ), $atts, 'rbs_sizer' );
	$mode = in_array( $atts['mode'], array( 'ring', 'bangle', 'bracelet' ), true ) ? $atts['mode'] : 'ring';

	wp_enqueue_style( 'rbs-sizer' );
	wp_enqueue_script( 'rbs-sizer' );

	// Flag for schema output.
	$GLOBALS['rbs_tool_on_page'] = $mode;

	ob_start();
	?>
	<div class="rbs" data-mode="<?php echo esc_attr( $mode ); ?>">
		<noscript><p><strong>This tool needs JavaScript.</strong> Use the size chart below instead.</p></noscript>
		<div class="rbs-tabs" role="tablist">
			<button type="button" class="rbs-tab" data-tab="ring" role="tab">Ring</button>
			<button type="button" class="rbs-tab" data-tab="bangle" role="tab">Bangle</button>
			<button type="button" class="rbs-tab" data-tab="bracelet" role="tab">Bracelet</button>
		</div>
		<div class="rbs-body">
			<p class="rbs-loading">Loading sizer…</p>
		</div>
	</div>
	<?php
	return ob_get_clean();
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
				<th>India / Japan</th>
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
				<td><?php echo esc_html( $d['jp'] ); ?></td>
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
