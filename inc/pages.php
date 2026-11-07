<?php
/**
 * Creates / updates every site page from the content files, plus the menus.
 *
 * Runs once per RBS_PAGES_VERSION (on admin or front-end init), so merging a
 * content change and bumping the version republishes the pages without touching
 * WP admin. Pages are matched by full path (parent/slug); manual edits in WP
 * admin are overwritten when the version is bumped, so edit content in the repo.
 *
 * Page entry keys:
 *   slug, title, seo_title, seo_desc, content, faq   (required)
 *   mode      tool mode or null
 *   parent    key of the parent page (must exist in the same list)
 *   noindex   true → noindex,follow (Rank Math meta + core wp_robots fallback)
 *   author_box false → hide the editorial box (legal pages)
 *   menu_order int, used for sibling ordering
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'RBS_PAGES_VERSION', '14' );

require_once RBS_DIR . '/inc/page-content.php';
require_once RBS_DIR . '/inc/content/legal.php';
require_once RBS_DIR . '/inc/content/bangle.php';
require_once RBS_DIR . '/inc/content/ring-mm.php';
require_once RBS_DIR . '/inc/content/ring-tools.php';
require_once RBS_DIR . '/inc/content/authority.php';

/**
 * All pages, keyed by a stable key. Parents are listed before their children.
 */
function rbs_all_pages() {
	return array_merge( rbs_core_pages(), rbs_legal_pages(), rbs_bangle_pages(), rbs_ring_mm_pages(), rbs_ring_tool_pages(), rbs_authority_pages() );
}

/**
 * Full path of a page ("bangle-size/2-4") from its key.
 */
function rbs_page_path( $key, $pages = null ) {
	$pages = $pages ? $pages : rbs_all_pages();
	if ( empty( $pages[ $key ] ) ) {
		return '';
	}
	$p = $pages[ $key ];
	if ( ! empty( $p['parent'] ) ) {
		return rbs_page_path( $p['parent'], $pages ) . '/' . $p['slug'];
	}
	return $p['slug'];
}

function rbs_render_faq_html( $faq ) {
	if ( empty( $faq ) ) {
		return '';
	}
	// Accordion: questions stay visible (and in the FAQ schema), answers open on tap.
	$html = "\n<h2>Frequently asked questions</h2>\n<div class=\"rbs-faq\">\n";
	foreach ( $faq as $qa ) {
		$html .= "<details>\n<summary><h3>" . esc_html( $qa[0] ) . "</h3></summary>\n<p>" . wp_kses_post( $qa[1] ) . "</p>\n</details>\n";
	}
	return $html . "</div>\n";
}

function rbs_sync_pages() {
	if ( get_option( 'rbs_pages_version' ) === RBS_PAGES_VERSION ) {
		return;
	}
	if ( ! function_exists( 'wp_insert_post' ) ) {
		return;
	}
	// Avoid two requests running the sync at the same time. add_option() is an
	// INSERT on a unique key, so only one request can take the lock (a transient
	// check-then-set let two requests through and doubled the menu, 0.12.0).
	$lock = get_option( 'rbs_pages_lock' );
	if ( $lock && time() - (int) $lock > 120 ) {
		delete_option( 'rbs_pages_lock' ); // stale lock from a request that died
	}
	if ( ! add_option( 'rbs_pages_lock', time(), '', 'no' ) ) {
		return;
	}

	$pages = rbs_all_pages();
	$ids   = array();

	foreach ( $pages as $key => $p ) {
		$parent_id = 0;
		if ( ! empty( $p['parent'] ) ) {
			if ( empty( $ids[ $p['parent'] ] ) ) {
				continue; // Parent failed; skip child rather than create it at the root.
			}
			$parent_id = $ids[ $p['parent'] ];
		}

		$content  = trim( $p['content'] ) . "\n" . rbs_render_faq_html( $p['faq'] );
		$existing = get_page_by_path( rbs_page_path( $key, $pages ), OBJECT, 'page' );

		$postarr = array(
			'post_title'     => $p['title'],
			'post_name'      => $p['slug'],
			'post_content'   => $content,
			'post_status'    => 'publish',
			'post_type'      => 'page',
			'post_parent'    => $parent_id,
			'menu_order'     => isset( $p['menu_order'] ) ? (int) $p['menu_order'] : 0,
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		);
		// Only touch pages whose source changed, so "Updated" dates and dateModified stay honest.
		$hash = md5( wp_json_encode( array( $p['title'], $p['slug'], $content, $parent_id, $postarr['menu_order'] ) ) );
		if ( $existing && 'publish' === $existing->post_status && get_post_meta( $existing->ID, 'rbs_src_hash', true ) === $hash ) {
			$id = $existing->ID;
		} elseif ( $existing ) {
			$postarr['ID'] = $existing->ID;
			$id            = wp_update_post( $postarr, true );
		} else {
			$id = wp_insert_post( $postarr, true );
		}
		if ( is_wp_error( $id ) || ! $id ) {
			continue;
		}
		$ids[ $key ] = $id;
		update_post_meta( $id, 'rbs_src_hash', $hash );

		update_post_meta( $id, 'rbs_key', $key );
		update_post_meta( $id, 'rbs_faq', $p['faq'] );
		update_post_meta( $id, 'rbs_mode', ! empty( $p['mode'] ) ? $p['mode'] : '' );
		update_post_meta( $id, 'rbs_author_box', isset( $p['author_box'] ) && ! $p['author_box'] ? '0' : '1' );
		update_post_meta( $id, 'rbs_noindex', ! empty( $p['noindex'] ) ? '1' : '0' );
		// Rank Math reads these meta keys.
		update_post_meta( $id, 'rank_math_title', $p['seo_title'] );
		update_post_meta( $id, 'rank_math_description', $p['seo_desc'] );
		update_post_meta( $id, 'rank_math_robots', ! empty( $p['noindex'] ) ? array( 'noindex' ) : array( 'index' ) );
		// Tell Rank Math we output FAQ schema ourselves (avoid duplicate).
		update_post_meta( $id, 'rank_math_rich_snippet', 'off' );
	}

	if ( ! empty( $ids['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
	}
	if ( ! empty( $ids['privacy'] ) ) {
		update_option( 'wp_page_for_privacy_policy', $ids['privacy'] );
	}

	rbs_unpublish_wp_samples();
	rbs_sync_menus( $ids );
	rbs_enable_rank_math_breadcrumbs();

	update_option( 'rbs_pages_version', RBS_PAGES_VERSION );
	delete_option( 'rbs_pages_lock' );
	flush_rewrite_rules( false );
}
add_action( 'init', 'rbs_sync_pages', 20 );

/**
 * WordPress ships "Sample Page" and "Hello world!" – thin content we do not want indexed.
 * Moved to draft (not deleted) and only while they still hold the default content.
 */
function rbs_unpublish_wp_samples() {
	$sample = get_page_by_path( 'sample-page', OBJECT, 'page' );
	if ( $sample && 'publish' === $sample->post_status && false !== strpos( $sample->post_content, 'This is an example page' ) ) {
		wp_update_post( array( 'ID' => $sample->ID, 'post_status' => 'draft' ) );
	}
	$hello = get_page_by_path( 'hello-world', OBJECT, 'post' );
	if ( $hello && 'publish' === $hello->post_status && false !== strpos( $hello->post_content, 'Welcome to WordPress' ) ) {
		wp_update_post( array( 'ID' => $hello->ID, 'post_status' => 'draft' ) );
	}
}

/* ---------------------------------------------------------------- menus */

/**
 * Menu structure. Items are page keys; nested arrays are sub-menus.
 */
function rbs_menu_structure() {
	return array(
		'primary' => array(
			'name'  => 'RBS Primary',
			'items' => array(
				array( 'key' => 'home', 'label' => 'Ring Sizer', 'children' => array(
					array( 'key' => 'ring-calc', 'label' => 'Ring Size Calculator' ),
					array( 'key' => 'ring-converter', 'label' => 'Ring Size Converter' ),
					array( 'key' => 'ring-chart', 'label' => 'Ring Size Chart' ),
					array( 'key' => 'average-ring', 'label' => 'Average Ring Size' ),
					array( 'key' => 'ring-mm', 'label' => 'Ring Size in mm' ),
					array( 'key' => 'ring-diameter', 'label' => 'Ring Size by Diameter' ),
					array( 'key' => 'ring-circ', 'label' => 'Ring Size by Circumference' ),
					array( 'key' => 'printable', 'label' => 'Printable Ring Sizer' ),
					array( 'key' => 'ring-measure', 'label' => 'How to Measure' ),
					array( 'key' => 'ring-chart-pk', 'label' => 'Ring Size Chart Pakistan' ),
				) ),
				array( 'key' => 'bangle', 'label' => 'Bangle Size', 'children' => array(
					array( 'key' => 'bangle', 'label' => 'Bangle Size Calculator' ),
					array( 'key' => 'bangle-chart', 'label' => 'Bangle Size Chart' ),
					array( 'key' => 'bangle-chart-india', 'label' => 'Bangle Size Chart India' ),
					array( 'key' => 'bangle-cm', 'label' => 'Bangle Size in cm' ),
					array( 'key' => 'bangle-sizes', 'label' => 'All Bangle Sizes' ),
					array( 'key' => 'bangle-measure', 'label' => 'How to Measure' ),
					array( 'key' => 'bangle-kids', 'label' => 'Kids Bangle Sizes' ),
					array( 'key' => 'chudi', 'label' => 'Chudi & Kada Sizes' ),
				) ),
				array( 'key' => 'bracelet', 'label' => 'Bracelet Size', 'children' => array(
					array( 'key' => 'bracelet', 'label' => 'Bracelet Size Calculator' ),
					array( 'key' => 'wrist-chart', 'label' => 'Wrist Size Chart' ),
				) ),
				array( 'key' => 'blog', 'label' => 'Guides', 'children' => array(
					array( 'key' => 'blog-ring-fit', 'label' => 'How Should a Ring Fit?' ),
					array( 'key' => 'blog-resize', 'label' => 'Can You Resize a Ring?' ),
					array( 'key' => 'blog-bridal-bangle', 'label' => 'Bridal Bangle Sizes' ),
					array( 'key' => 'blog-gift-size', 'label' => 'Find a Ring Size Secretly' ),
				) ),
				array( 'key' => 'about', 'label' => 'About' ),
			),
		),
		'rbs-footer' => array(
			'name'  => 'RBS Footer',
			'items' => array(
				array( 'key' => 'about', 'label' => 'About' ),
				array( 'key' => 'method', 'label' => 'How We Measure' ),
				array( 'key' => 'contact', 'label' => 'Contact' ),
				array( 'key' => 'widget', 'label' => 'Free Sizer Widget' ),
				array( 'key' => 'privacy', 'label' => 'Privacy Policy' ),
				array( 'key' => 'terms', 'label' => 'Terms' ),
				array( 'key' => 'disclaimer', 'label' => 'Disclaimer' ),
				array( 'key' => 'affiliate', 'label' => 'Affiliate Disclosure' ),
			),
		),
	);
}

function rbs_register_menus() {
	register_nav_menus( array( 'rbs-footer' => 'Footer menu (Ring Bangle Sizer)' ) );
}
add_action( 'after_setup_theme', 'rbs_register_menus' );

function rbs_sync_menus( $ids ) {
	if ( ! function_exists( 'wp_create_nav_menu' ) ) {
		require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
	}
	$locations = get_theme_mod( 'nav_menu_locations', array() );

	foreach ( rbs_menu_structure() as $location => $menu ) {
		$obj     = wp_get_nav_menu_object( $menu['name'] );
		$menu_id = $obj ? (int) $obj->term_id : wp_create_nav_menu( $menu['name'] );
		if ( is_wp_error( $menu_id ) || ! $menu_id ) {
			continue;
		}
		// Rebuild from scratch so the code stays the source of truth.
		foreach ( (array) wp_get_nav_menu_items( $menu_id ) as $item ) {
			if ( $item ) {
				wp_delete_post( $item->ID, true );
			}
		}
		$pos = 0;
		rbs_add_menu_items( $menu_id, $menu['items'], 0, $ids, $pos );
		$locations[ $location ] = $menu_id;
	}
	set_theme_mod( 'nav_menu_locations', $locations );
}

function rbs_add_menu_items( $menu_id, $items, $parent_item, $ids, &$pos ) {
	foreach ( $items as $it ) {
		if ( empty( $ids[ $it['key'] ] ) ) {
			continue;
		}
		$pos++;
		$item_id = wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'     => $it['label'],
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $ids[ $it['key'] ],
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			'menu-item-parent-id' => $parent_item,
			'menu-item-position'  => $pos,
		) );
		if ( ! is_wp_error( $item_id ) && ! empty( $it['children'] ) ) {
			rbs_add_menu_items( $menu_id, $it['children'], $item_id, $ids, $pos );
		}
	}
}

/**
 * Turn on Rank Math breadcrumbs once Rank Math is installed (its own setting).
 */
function rbs_enable_rank_math_breadcrumbs() {
	$opt = get_option( 'rank-math-options-general' );
	if ( is_array( $opt ) && ( empty( $opt['breadcrumbs'] ) || 'on' !== $opt['breadcrumbs'] ) ) {
		$opt['breadcrumbs'] = 'on';
		update_option( 'rank-math-options-general', $opt );
	}
}
// Rank Math may be installed after the pages were synced: check in admin too.
add_action( 'admin_init', function () {
	if ( defined( 'RANK_MATH_VERSION' ) && ! get_option( 'rbs_rm_breadcrumbs_done' ) ) {
		rbs_enable_rank_math_breadcrumbs();
		update_option( 'rbs_rm_breadcrumbs_done', 1 );
	}
} );

/* ------------------------------------------------------------ FAQ schema */

/**
 * FAQPage JSON-LD from the page's stored FAQ.
 */
function rbs_faq_schema() {
	if ( ! is_singular( 'page' ) ) {
		return;
	}
	$faq = get_post_meta( get_the_ID(), 'rbs_faq', true );
	if ( empty( $faq ) || ! is_array( $faq ) ) {
		return;
	}
	$main = array();
	foreach ( $faq as $qa ) {
		$main[] = array(
			'@type'          => 'Question',
			'name'           => $qa[0],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => wp_strip_all_tags( $qa[1] ),
			),
		);
	}
	$data = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $main,
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_footer', 'rbs_faq_schema', 6 );
