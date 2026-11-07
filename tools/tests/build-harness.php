<?php
/* Builds tool.html + tables.html (in this folder, git-ignored) for tool-tests.js. Run: php tools/tests/build-harness.php && node tools/tests/tool-tests.js */
if ( PHP_SAPI !== 'cli' ) { exit; } // the theme folder is web-served: never run from a browser
define('ABSPATH',1); define('RBS_URI','/t'); define('RBS_VERSION','x'); define('RBS_DIR',dirname(__DIR__,2));
function add_shortcode(){} function add_action(){} function add_filter(){} function wp_enqueue_script(){} function wp_enqueue_style(){} function wp_register_script(){}
function esc_html($s){return htmlspecialchars((string)$s);} function esc_attr($s){return htmlspecialchars((string)$s, ENT_QUOTES);} function esc_url($s){return $s;}
function home_url($p='/'){return 'https://ringbanglesizer.com'.$p;} function untrailingslashit($s){return rtrim($s,'/');}
function wp_json_encode($d,$f=0){return json_encode($d,$f);} function shortcode_atts($a,$b){return array_merge($a,(array)$b);}
function rbs_icon(){return '';}
require RBS_DIR.'/inc/sizes.php'; require RBS_DIR.'/inc/shortcodes.php'; require RBS_DIR.'/inc/tools.php'; require RBS_DIR.'/inc/authority.php';
$data=['rings'=>rbs_ring_rows_for_js(),'uk'=>rbs_uk_rows_for_js(),'bangles'=>rbs_bangle_sizes(),'home'=>'https://ringbanglesizer.com'];
$sizer=rbs_sizer_shortcode(['mode'=>'ring','side'=>'0']);
$bangle=rbs_sizer_shortcode(['mode'=>'bangle','side'=>'0']);
$brace=rbs_sizer_shortcode(['mode'=>'bracelet','side'=>'0']);
$conv=rbs_ring_converter_shortcode();
$J=file_get_contents(RBS_DIR.'/assets/js/sizer.js'); $C=file_get_contents(RBS_DIR.'/assets/js/converter.js');
$W=file_get_contents(RBS_DIR.'/assets/js/widgets.js');
file_put_contents(__DIR__.'/tool.html',"<!doctype html><html><body><div id=r>$sizer</div><div id=b>$bangle</div><div id=br>$brace</div><div id=c>$conv</div><div class='rbs-widget rbs-growth'></div><script>var RBS_DATA=".json_encode($data).";</script><script>$J</script><script>$C</script><script>$W</script></body></html>");
// server tables
file_put_contents(__DIR__.'/tables.html', rbs_ring_table_shortcode().rbs_india_ring_table_shortcode().rbs_diameter_ranges_shortcode().rbs_mm_lookup_shortcode());
echo "ok\n";
