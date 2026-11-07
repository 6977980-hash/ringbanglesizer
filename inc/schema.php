<?php
/**
 * JSON-LD for tool pages (WebApplication).
 * HowTo was dropped (audit F-O02): Google no longer shows HowTo rich results.
 * Organization, Breadcrumb and Article (guides) are in inc/site.php; FAQ comes with the page content.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rbs_tool_schema() {
	if ( empty( $GLOBALS['rbs_tool_on_page'] ) || ! is_singular() ) {
		return;
	}
	$mode  = $GLOBALS['rbs_tool_on_page'];
	$names = array(
		'ring'     => 'Online Ring Sizer',
		'bangle'   => 'Online Bangle Size Calculator',
		'bracelet' => 'Bracelet Size Calculator',
	);
	$data = array(
		'@context' => 'https://schema.org',
		'@graph'   => array(
			array(
				'@type'               => 'WebApplication',
				'name'                => ! empty( $GLOBALS['rbs_tool_name'] ) ? $GLOBALS['rbs_tool_name'] : $names[ $mode ],
				'url'                 => get_permalink(),
				'applicationCategory' => 'UtilitiesApplication',
				'operatingSystem'     => 'Any',
				'browserRequirements' => 'Requires JavaScript',
				'offers'              => array(
					'@type'         => 'Offer',
					'price'         => '0',
					'priceCurrency' => 'USD',
				),
			),
		),
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_footer', 'rbs_tool_schema', 5 );
