<?php
/**
 * Security headers and small hardening (audit 2026-11-07, Phase 5: F-X02, F-X03).
 *
 * Headers are sent for every front-end response. The widget at /embed/{ring,bangle,bracelet}/
 * is meant to sit in other sites' iframes, so it skips the framing rules.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'send_headers', function ( $wp ) {
	if ( headers_sent() ) {
		return;
	}
	header( 'Strict-Transport-Security: max-age=31536000' );
	header( 'X-Content-Type-Options: nosniff' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	header( 'Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=()' );

	$is_embed = ! empty( $wp->query_vars['rbs_embed'] );
	if ( ! $is_embed ) {
		header( 'X-Frame-Options: SAMEORIGIN' );
		// Added as a second policy; the host's "upgrade-insecure-requests" policy stays as it is.
		header( "Content-Security-Policy: frame-ancestors 'self'", false );
	}
} );

/**
 * F-X03: /readme.html shows the WordPress version. Remove it once per theme release
 * (a core update puts it back, and the next theme release removes it again).
 */
add_action( 'init', function () {
	if ( get_option( 'rbs_readme_check' ) === RBS_VERSION ) {
		return;
	}
	update_option( 'rbs_readme_check', RBS_VERSION );
	$file = ABSPATH . 'readme.html';
	if ( file_exists( $file ) && is_writable( $file ) ) {
		@unlink( $file ); // phpcs:ignore -- best effort, nothing else depends on this file
	}
}, 31 );
