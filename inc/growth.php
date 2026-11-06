<?php
/**
 * Growth helpers (phase 5):
 * - Share image per page (assets/img/og/<key>.png, made by tools/og/render.js).
 * - IndexNow: tells Bing/Yandex/Seznam/Naver about every page after a content release,
 *   so new and updated pages are crawled within hours instead of weeks.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* --------------------------------------------------------- share images */

/**
 * Share image for a page: its own PNG when one exists, else the site default.
 *
 * @return array{url:string, w:int, h:int}
 */
function rbs_og_image( $id ) {
	$key  = (int) get_option( 'page_on_front' ) === (int) $id ? 'home' : str_replace( '/', '-', get_page_uri( $id ) );
	$file = '/assets/img/og/' . sanitize_file_name( $key ) . '.png';
	if ( ! file_exists( RBS_DIR . $file ) ) {
		$file = '/assets/img/og/default.png';
	}
	return array(
		'url' => RBS_URI . $file . '?v=' . RBS_VERSION,
		'w'   => 1200,
		'h'   => 630,
	);
}

/* ------------------------------------------------------------- IndexNow */

define( 'RBS_INDEXNOW_KEY', '9706dcc20f3be1daffc8c0fbafd2e9cd' );

/**
 * Serve the key file at /<key>.txt (the site root, so the key covers every URL).
 */
add_action( 'parse_request', function () {
	$path = wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '', PHP_URL_PATH );
	if ( '/' . RBS_INDEXNOW_KEY . '.txt' !== $path ) {
		return;
	}
	status_header( 200 );
	header( 'Content-Type: text/plain; charset=utf-8' );
	header( 'X-Robots-Tag: noindex' );
	echo RBS_INDEXNOW_KEY; // phpcs:ignore WordPress.Security.EscapeOutput
	exit;
}, 0 );

/**
 * Every indexable published page (what the sitemap lists).
 *
 * @return string[]
 */
function rbs_indexnow_urls() {
	$ids = get_posts( array(
		'post_type'      => 'page',
		'post_status'    => 'publish',
		'posts_per_page' => 500,
		'fields'         => 'ids',
		'meta_query'     => array(
			'relation' => 'OR',
			array( 'key' => 'rbs_noindex', 'compare' => 'NOT EXISTS' ),
			array( 'key' => 'rbs_noindex', 'value' => '1', 'compare' => '!=' ),
		),
	) );
	return array_values( array_filter( array_map( 'get_permalink', $ids ) ) );
}

/**
 * Submit URLs to IndexNow (one call reaches all participating engines).
 * Production host only, so local test installs never ping.
 */
function rbs_indexnow_submit( $urls ) {
	$host = wp_parse_url( home_url(), PHP_URL_HOST );
	if ( 'ringbanglesizer.com' !== $host || empty( $urls ) ) {
		return false;
	}
	$res = wp_remote_post( 'https://api.indexnow.org/indexnow', array(
		'timeout' => 10,
		'headers' => array( 'Content-Type' => 'application/json; charset=utf-8' ),
		'body'    => wp_json_encode( array(
			'host'        => $host,
			'key'         => RBS_INDEXNOW_KEY,
			'keyLocation' => home_url( '/' . RBS_INDEXNOW_KEY . '.txt' ),
			'urlList'     => array_slice( array_values( $urls ), 0, 10000 ),
		) ),
	) );
	$code = is_wp_error( $res ) ? $res->get_error_message() : wp_remote_retrieve_response_code( $res );
	update_option( 'rbs_indexnow_last', array( 'time' => time(), 'urls' => count( $urls ), 'result' => $code ), false );
	return $code;
}

/**
 * After each content release (RBS_PAGES_VERSION bump, which also re-syncs the pages
 * at init priority 20), submit every page once. Runs on shutdown, after the response is
 * flushed, so a visitor never waits for it.
 */
add_action( 'init', function () {
	if ( get_option( 'rbs_indexnow_version' ) === RBS_PAGES_VERSION ) {
		return;
	}
	update_option( 'rbs_indexnow_version', RBS_PAGES_VERSION );
	add_action( 'shutdown', function () {
		if ( function_exists( 'litespeed_finish_request' ) ) {
			litespeed_finish_request();
		} elseif ( function_exists( 'fastcgi_finish_request' ) ) {
			fastcgi_finish_request();
		}
		rbs_indexnow_submit( rbs_indexnow_urls() );
	} );
}, 40 );
