<?php
/* Content consistency checks (audit 2026-11-12 F-C10, F-C11, F-C12). Run: php tools/tests/content-tests.php */
if ( PHP_SAPI !== 'cli' ) { exit; } // the theme folder is web-served: never run from a browser
define( 'ABSPATH', 1 ); define( 'RBS_URI', '/t' ); define( 'RBS_DIR', dirname( __DIR__, 2 ) );
function add_shortcode() {} function add_action() {} function add_filter() {}
function esc_html( $s ) { return htmlspecialchars( (string) $s ); } function esc_attr( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES ); } function esc_url( $s ) { return $s; }
function home_url( $p = '/' ) { return 'https://ringbanglesizer.com' . $p; }
require RBS_DIR . '/inc/sizes.php';
require RBS_DIR . '/inc/pages.php';

$fail = 0;
function check( $ok, $msg ) { global $fail; if ( ! $ok ) { $fail++; echo "FAIL $msg\n"; } }

$pages = rbs_all_pages();
$texts = array();
foreach ( $pages as $k => $p ) {
	$t = $p['content'];
	foreach ( (array) ( $p['faq'] ?? array() ) as $qa ) { $t .= "\n" . $qa[0] . "\n" . $qa[1]; }
	$texts[ $k ] = $t;
	check( false === strpos( $t, '{{' ), "$k: unreplaced content token" );
}
$all = implode( "\n", $texts );

// F-C12: hand ranges must match the calculator rule (rbs_bangle_hand_range).
$min = array(); $max = array();
foreach ( rbs_bangle_sizes() as $b ) {
	$r = rbs_bangle_hand_range( $b['label'] );
	if ( null !== $r['min_cm'] ) { $min[ number_format( $r['min_cm'], 1 ) ] = $b['label']; }
	$max[ number_format( $r['max_cm'], 1 ) ] = $b['label'];
}
check( '17.0' === number_format( rbs_bangle_hand_range( '2.4' )['min_cm'], 1 ) && '17.9' === number_format( rbs_bangle_hand_range( '2.4' )['max_cm'], 1 ), '2.4 hand range is 17.0–17.9 cm' );
check( '21.9' === number_format( rbs_bangle_hand_range( '2.12' )['max_cm'], 1 ), '2.12 hand range ends at 21.9 cm' );
$n = 0;
foreach ( $texts as $k => $t ) {
	if ( ! preg_match_all( '/(\d\d\.\d)\s*(?:–|-| – | to )\s*(\d\d\.\d)\s*cm/u', $t, $m, PREG_SET_ORDER ) ) { continue; }
	foreach ( $m as $x ) {
		if ( ! isset( $min[ $x[1] ] ) || (float) $x[1] < 13 ) { continue; } // only ranges that start on a bangle edge
		$n++;
		check( isset( $max[ $x[2] ] ), "$k: hand range {$x[1]}–{$x[2]} cm does not end on a bangle edge (x.9)" );
	}
}
check( $n > 30, "found $n hand ranges (expected the bangle tables)" );

// F-C10: one wording for the most common bangle sizes.
check( false === stripos( $all, 'most sold' ), '"most sold" wording is gone' );
check( ! preg_match( '/the most common adult size(?!s)/i', $all ), 'no single "most common adult size"' );
foreach ( rbs_bangle_sizes() as $b ) { check( false === stripos( $b['fit'], 'most common' ), "fit label {$b['label']} has no (most common)" ); }

// F-C11: UK averages are half letters everywhere; US 7 = N½.
check( false === strpos( $all, 'L to N' ) && false === strpos( $all, 'L and N' ), 'no whole-letter women\'s average (L to N)' );
check( false === strpos( $all, 'N½–O' ), 'home FAQ says US 7 is UK N½' );
check( false !== strpos( $all, 'L½ to N½ (US 6 to 7, 16.5 to 17.3 mm)' ), 'UK average sentence from rbs_content_tokens()' );

echo $fail ? "$fail content check(s) failed\n" : "content checks ok ($n hand ranges)\n";
exit( $fail ? 1 : 0 );
