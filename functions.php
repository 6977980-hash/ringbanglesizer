<?php
/**
 * Ring Bangle Sizer – GeneratePress child theme.
 *
 * - Enqueues parent + child styles.
 * - Registers [rbs_sizer], [rbs_ring_table], [rbs_bangle_table], [rbs_cta] shortcodes.
 * - Loads the sizer tool JS/CSS only on pages that use the shortcode.
 * - Outputs WebApplication schema on tool pages.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'RBS_VERSION', '0.1.0' );
define( 'RBS_DIR', get_stylesheet_directory() );
define( 'RBS_URI', get_stylesheet_directory_uri() );

require_once RBS_DIR . '/inc/sizes.php';
require_once RBS_DIR . '/inc/shortcodes.php';
require_once RBS_DIR . '/inc/schema.php';
require_once RBS_DIR . '/inc/pages.php';

/**
 * Styles: parent, then child.
 */
function rbs_enqueue_styles() {
	wp_enqueue_style( 'generatepress-parent', get_template_directory_uri() . '/style.css', array(), wp_get_theme( 'generatepress' )->get( 'Version' ) );
	wp_enqueue_style( 'rbs-child', RBS_URI . '/style.css', array( 'generatepress-parent' ), RBS_VERSION );
}
add_action( 'wp_enqueue_scripts', 'rbs_enqueue_styles' );

/**
 * Register (not enqueue) the tool assets. Shortcode enqueues them on demand.
 */
function rbs_register_tool_assets() {
	wp_register_style( 'rbs-sizer', RBS_URI . '/assets/css/sizer.css', array(), RBS_VERSION );
	wp_register_script( 'rbs-sizer', RBS_URI . '/assets/js/sizer.js', array(), RBS_VERSION, array( 'strategy' => 'defer', 'in_footer' => true ) );

	$rings = array();
	foreach ( rbs_ring_sizes() as $r ) {
		$d       = rbs_ring_derived( $r['mm'] );
		$rings[] = array(
			'us'   => $r['us'],
			'uk'   => $r['uk'],
			'mm'   => $r['mm'],
			'circ' => $d['circ_mm'],
			'eu'   => $d['eu'],
			'jp'   => $d['jp'],
		);
	}
	wp_localize_script( 'rbs-sizer', 'RBS_DATA', array(
		'rings'   => $rings,
		'bangles' => rbs_bangle_sizes(),
	) );
}
add_action( 'wp_enqueue_scripts', 'rbs_register_tool_assets' );

/**
 * Small performance / hygiene tweaks.
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
add_filter( 'the_generator', '__return_empty_string' );

/**
 * Keep GeneratePress from loading its dashicons on the front end.
 */
add_filter( 'generate_load_dashicons', '__return_false' );
