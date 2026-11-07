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

define( 'RBS_VERSION', '0.16.3' );
define( 'RBS_DIR', get_stylesheet_directory() );
define( 'RBS_URI', get_stylesheet_directory_uri() );

require_once RBS_DIR . '/inc/sizes.php';
require_once RBS_DIR . '/inc/shortcodes.php';
require_once RBS_DIR . '/inc/tools.php';
require_once RBS_DIR . '/inc/authority.php';
require_once RBS_DIR . '/inc/schema.php';
require_once RBS_DIR . '/inc/site.php';
require_once RBS_DIR . '/inc/growth.php';
require_once RBS_DIR . '/inc/aeo.php';
require_once RBS_DIR . '/inc/engage.php';
require_once RBS_DIR . '/inc/pages.php';
require_once RBS_DIR . '/inc/security.php';

/**
 * Styles: parent, then child.
 */
function rbs_enqueue_styles() {
	// GeneratePress's own style.css is only a theme header comment (its CSS is main.min.css),
	// so it is not loaded: one render-blocking request less on every page.
	// Load after GeneratePress main.min.css so child rules win (same order as GP's own child stylesheet).
	wp_enqueue_style( 'rbs-child', RBS_URI . '/style.css', array( 'generate-style' ), RBS_VERSION );
}
add_action( 'wp_enqueue_scripts', 'rbs_enqueue_styles' );

// GeneratePress also enqueues the child style.css itself ("generate-child"); we already load it above.
add_filter( 'generate_load_child_theme_stylesheet', '__return_false' );

/**
 * Register (not enqueue) the tool assets. Shortcode enqueues them on demand.
 */
function rbs_register_tool_assets() {
	wp_register_style( 'rbs-sizer', RBS_URI . '/assets/css/sizer.css', array(), RBS_VERSION );
	wp_register_script( 'rbs-sizer', RBS_URI . '/assets/js/sizer.js', array(), RBS_VERSION, array( 'strategy' => 'defer', 'in_footer' => true ) );

	wp_register_script( 'rbs-widgets', RBS_URI . '/assets/js/widgets.js', array(), RBS_VERSION, array( 'strategy' => 'defer', 'in_footer' => true ) );

	wp_localize_script( 'rbs-sizer', 'RBS_DATA', array(
		'rings'   => rbs_ring_rows_for_js(),
		'uk'      => rbs_uk_rows_for_js(),
		'bangles' => rbs_bangle_sizes(),
		'home'    => untrailingslashit( home_url() ),
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
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );
remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
add_filter( 'the_generator', '__return_empty_string' );

/**
 * Keep GeneratePress from loading its dashicons on the front end.
 */
add_filter( 'generate_load_dashicons', '__return_false' );

/**
 * Purge the LiteSpeed page cache once after each theme release, so cached
 * pages stop pointing at the previous ?ver= of the tool scripts and styles.
 */
add_action( 'init', function () {
	if ( get_option( 'rbs_purged_version' ) === RBS_VERSION ) {
		return;
	}
	update_option( 'rbs_purged_version', RBS_VERSION );
	do_action( 'litespeed_purge_all' );
}, 30 );
