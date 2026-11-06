<?php
/**
 * Creates / updates the core pages from inc/page-content.php.
 *
 * Runs once per RBS_PAGES_VERSION (on admin or front-end init), so merging a
 * content change and bumping the version republishes the pages without touching
 * WP admin. Pages are matched by slug; manual edits in WP admin are overwritten
 * when the version is bumped, so edit content in the repo.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'RBS_PAGES_VERSION', '1' );

require_once RBS_DIR . '/inc/page-content.php';

function rbs_render_faq_html( $faq ) {
	if ( empty( $faq ) ) {
		return '';
	}
	$html = "\n<h2>Frequently asked questions</h2>\n";
	foreach ( $faq as $qa ) {
		$html .= '<h3>' . esc_html( $qa[0] ) . "</h3>\n<p>" . wp_kses_post( $qa[1] ) . "</p>\n";
	}
	return $html;
}

function rbs_sync_pages() {
	if ( get_option( 'rbs_pages_version' ) === RBS_PAGES_VERSION ) {
		return;
	}
	if ( ! function_exists( 'wp_insert_post' ) ) {
		return;
	}

	$ids = array();
	foreach ( rbs_core_pages() as $key => $p ) {
		$content  = trim( $p['content'] ) . "\n" . rbs_render_faq_html( $p['faq'] );
		$existing = get_page_by_path( $p['slug'], OBJECT, 'page' );

		$postarr = array(
			'post_title'     => $p['title'],
			'post_name'      => $p['slug'],
			'post_content'   => $content,
			'post_status'    => 'publish',
			'post_type'      => 'page',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		);
		if ( $existing ) {
			$postarr['ID'] = $existing->ID;
			$id            = wp_update_post( $postarr, true );
		} else {
			$id = wp_insert_post( $postarr, true );
		}
		if ( is_wp_error( $id ) || ! $id ) {
			continue;
		}
		$ids[ $key ] = $id;

		update_post_meta( $id, 'rbs_faq', $p['faq'] );
		update_post_meta( $id, 'rbs_mode', $p['mode'] ? $p['mode'] : '' );
		// Rank Math reads these meta keys.
		update_post_meta( $id, 'rank_math_title', $p['seo_title'] );
		update_post_meta( $id, 'rank_math_description', $p['seo_desc'] );
		// Tell Rank Math we output FAQ schema ourselves (avoid duplicate).
		update_post_meta( $id, 'rank_math_rich_snippet', 'off' );
	}

	if ( ! empty( $ids['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
	}

	update_option( 'rbs_pages_version', RBS_PAGES_VERSION );
	flush_rewrite_rules( false );
}
add_action( 'init', 'rbs_sync_pages', 20 );

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
