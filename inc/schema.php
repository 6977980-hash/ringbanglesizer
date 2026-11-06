<?php
/**
 * JSON-LD for tool pages (WebApplication + HowTo).
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
	$steps = array(
		'ring' => array(
			'Place a credit or debit card on the screen and drag the slider until the outline matches the card.',
			'Put your ring on the screen and move the size slider until the circle matches the inside edge of the ring.',
			'Read your size in US, UK, EU, India and mm.',
		),
		'bangle' => array(
			'Calibrate the screen with a credit card.',
			'Place a bangle that fits you on the screen and match the circle, or enter your hand circumference.',
			'Read your Indian bangle size and the diameter in mm and inches.',
		),
		'bracelet' => array(
			'Measure your wrist circumference with a string or tape.',
			'Enter it in inches or cm.',
			'Read the snug, comfortable and loose bracelet lengths.',
		),
	);

	$how_to = array();
	foreach ( $steps[ $mode ] as $i => $t ) {
		$how_to[] = array(
			'@type'    => 'HowToStep',
			'position' => $i + 1,
			'text'     => $t,
		);
	}

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
			array(
				'@type' => 'HowTo',
				'name'  => 'How to use the ' . strtolower( ! empty( $GLOBALS['rbs_tool_name'] ) ? $GLOBALS['rbs_tool_name'] : $names[ $mode ] ),
				'step'  => $how_to,
			),
		),
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_footer', 'rbs_tool_schema', 5 );
