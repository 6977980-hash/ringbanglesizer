<?php
/**
 * Site-wide basics: layout, breadcrumbs, editorial box, footer, contact,
 * Organization schema, and an SEO fallback while Rank Math is not installed.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'RBS_SITE_NAME', 'Ring Bangle Sizer' );
define( 'RBS_EDITOR_NAME', 'Ring Bangle Sizer Editorial Team' );
define( 'RBS_CONTACT_EMAIL', 'contact@ringbanglesizer.com' );
define( 'RBS_FOUNDER_NAME', 'Ali Ahmad' );
define( 'RBS_FOUNDER_URL', 'https://www.linkedin.com/in/ali-ahmad-chaudhry-12777486/' );

function rbs_founder_entity() {
	return array(
		'@type'    => 'Person',
		'@id'      => home_url( '/#founder' ),
		'name'     => RBS_FOUNDER_NAME,
		'jobTitle' => 'Founder',
		'url'      => home_url( '/about/' ),
		'sameAs'   => array( RBS_FOUNDER_URL ),
		'image'    => RBS_URI . '/assets/img/ali-ahmad.webp',
	);
}

/**
 * Official social profiles (Organization sameAs). Add full URLs when created.
 */
function rbs_same_as() {
	return array(
		// 'https://www.pinterest.com/ringbanglesizer/',
		// 'https://www.youtube.com/@ringbanglesizer',
		// 'https://www.instagram.com/ringbanglesizer/',
		// 'https://x.com/ringbanglesizer',
		// 'https://www.facebook.com/ringbanglesizer',
	);
}

function rbs_rank_math_active() {
	return defined( 'RANK_MATH_VERSION' ) || class_exists( 'RankMath' );
}

/* -------------------------------------------------------------- layout */

// Full-width content: the tool and the tables need the room, and the sidebar was empty.
add_filter( 'generate_sidebar_layout', function () {
	return 'no-sidebar';
} );

/* --------------------------------------------------------- breadcrumbs */

/**
 * Trail for the current page: Home › parent › … › current.
 *
 * @return array<int, array{0:string,1:string}> [label, url]
 */
function rbs_breadcrumb_trail() {
	$post  = get_post();
	$trail = array( array( 'Home', home_url( '/' ) ) );
	foreach ( array_reverse( get_post_ancestors( $post ) ) as $aid ) {
		$trail[] = array( rbs_short_title( $aid ), get_permalink( $aid ) );
	}
	$trail[] = array( rbs_short_title( $post->ID ), get_permalink( $post ) );
	return $trail;
}

/**
 * Page title up to the dash ("Bangle Size 2.4 – …" → "Bangle Size 2.4").
 */
function rbs_short_title( $id ) {
	$t     = get_the_title( $id );
	$t     = html_entity_decode( $t, ENT_QUOTES, 'UTF-8' );
	$parts = preg_split( '/\s[–:-]\s/u', $t );
	return trim( $parts[0] );
}

function rbs_breadcrumbs() {
	if ( ! is_singular( 'page' ) || is_front_page() ) {
		return;
	}
	if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
		echo '<div class="rbs-crumbs">';
		rank_math_the_breadcrumbs();
		echo '</div>';
		return;
	}
	$trail = rbs_breadcrumb_trail();
	$html  = array();
	$last  = count( $trail ) - 1;
	foreach ( $trail as $i => $c ) {
		$html[] = $i === $last
			? '<span aria-current="page">' . esc_html( $c[0] ) . '</span>'
			: '<a href="' . esc_url( $c[1] ) . '">' . esc_html( $c[0] ) . '</a>';
	}
	echo '<nav class="rbs-crumbs" aria-label="Breadcrumb">' . implode( ' <span class="sep">›</span> ', $html ) . '</nav>';
}
add_action( 'generate_before_main_content', 'rbs_breadcrumbs', 5 );

/* ---------------------------------------------------- author box */

/**
 * Founder photo, if one has been added to the theme (WebP, square, ~128 px).
 * Until then the box shows the founder's initials.
 */
function rbs_founder_photo_uri() {
	$rel = '/assets/img/ali-ahmad.webp';
	return file_exists( RBS_DIR . $rel ) ? RBS_URI . $rel . '?v=' . RBS_VERSION : '';
}

function rbs_author_box( $content ) {
	if ( ! is_singular( 'page' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	if ( '1' !== get_post_meta( get_the_ID(), 'rbs_author_box', true ) ) {
		return $content;
	}
	$photo  = rbs_founder_photo_uri();
	$avatar = $photo
		? '<img class="rbs-author-pic" src="' . esc_url( $photo ) . '" width="64" height="64" loading="lazy" decoding="async" alt="' . esc_attr( RBS_FOUNDER_NAME ) . '">'
		: '<span class="rbs-author-pic rbs-author-initials" aria-hidden="true">AA</span>';
	$box = sprintf(
		'<aside class="rbs-author">%8$s<div class="rbs-author-body"><p class="rbs-author-name"><strong>Written and checked by <a href="%9$s">%7$s</a></strong>, founder of Ring Bangle Sizer · <a class="rbs-author-in" href="%6$s" rel="noopener" target="_blank">LinkedIn</a></p><p class="rbs-author-meta">Page last updated <time datetime="%2$s">%3$s</time> · sizes checked against published sizing standards</p><p>We build free sizing tools for rings, bangles and bracelets. Every size on this site comes from published standards (ISO 8653 for rings, the Indian inch-and-sixteenths system for bangles), and we show the maths so you can check it yourself. Read <a href="%4$s">how we measure</a> or <a href="%5$s">contact us</a> if something looks wrong.</p></div></aside>',
		'',
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date( 'F j, Y' ) ),
		esc_url( home_url( '/how-we-measure/' ) ),
		esc_url( home_url( '/contact/' ) ),
		esc_url( RBS_FOUNDER_URL ),
		esc_html( RBS_FOUNDER_NAME ),
		$avatar,
		esc_url( home_url( '/about/' ) )
	);
	return $content . $box;
}
add_filter( 'the_content', 'rbs_author_box', 20 );

/* ------------------------------------------------------------ footer */

/**
 * Three-column footer above the legal links: about, ring tools, bangle tools.
 * Columns are <details> so they fold into an accordion on phones.
 */
function rbs_footer_columns() {
	$cols = array(
		'Ring tools'               => array(
			'/'                                 => 'Online ring sizer',
			'/ring-size-calculator/'            => 'Ring size calculator',
			'/ring-size-converter/'             => 'Ring size converter',
			'/ring-size-chart/'                 => 'Ring size chart',
			'/ring-size-in-mm/'                 => 'Ring size in mm',
			'/printable-ring-sizer/'            => 'Printable ring sizer',
			'/how-to-measure-ring-size-at-home/' => 'How to measure ring size',
		),
		'Bangle & bracelet tools' => array(
			'/bangle-size-calculator/'    => 'Bangle size calculator',
			'/bangle-size-chart/'         => 'Bangle size chart',
			'/bangle-size-chart/in-cm/'   => 'Bangle size in cm',
			'/kids-bangle-size-chart/'    => 'Kids bangle sizes',
			'/how-to-measure-bangle-size/' => 'How to measure bangle size',
			'/bracelet-size-calculator/'  => 'Bracelet size calculator',
			'/wrist-size-chart/'          => 'Wrist size chart',
		),
		'Ring size by country'    => array(
			'/ring-size-chart/us/'       => 'US ring size chart',
			'/ring-size-chart/uk/'       => 'UK ring size chart',
			'/ring-size-chart/india/'    => 'Indian ring size chart',
			'/ring-size-chart/pakistan/' => 'Pakistan ring size chart',
			'/ring-size-chart/mens/'     => 'Men\'s ring sizes',
			'/ring-size-chart/womens/'   => 'Women\'s ring sizes',
		),
	);
	$html  = '<div class="rbs-footer"><div class="rbs-footer-in">';
	$html .= '<div class="rbs-fcol rbs-fabout"><a class="rbs-flogo" href="' . esc_url( home_url( '/' ) ) . '">' . rbs_logo_svg( 28 ) . '<span class="rbs-wordmark">Ring Bangle <span>Sizer</span></span></a>';
	$html .= '<p>Free on-screen sizers for rings, bangles and bracelets. Sizes follow ISO 8653 and the Indian bangle system, and nothing you measure leaves your phone.</p>';
	$html .= '<p>Made by <a href="' . esc_url( home_url( '/about/' ) ) . '">' . esc_html( RBS_FOUNDER_NAME ) . '</a> · ' . rbs_email_shortcode() . '</p></div>';
	foreach ( $cols as $title => $links ) {
		$html .= '<details class="rbs-fcol" open><summary>' . esc_html( $title ) . '</summary><ul>';
		foreach ( $links as $path => $label ) {
			$html .= '<li><a href="' . esc_url( home_url( $path ) ) . '">' . esc_html( $label ) . '</a></li>';
		}
		$html .= '</ul></details>';
	}
	$html .= '</div></div>';
	// Phones: start folded (accordion). Desktop keeps them open and the summary is a plain heading.
	$html .= '<script>if(window.matchMedia&&matchMedia("(max-width:767px)").matches){document.querySelectorAll(".rbs-fcol[open]").forEach(function(d){d.removeAttribute("open")})}</script>';
	echo $html; // phpcs:ignore WordPress.Security.EscapeOutput -- built from escaped parts above.
}
add_action( 'generate_before_footer_content', 'rbs_footer_columns' );

function rbs_footer_menu() {
	if ( ! has_nav_menu( 'rbs-footer' ) ) {
		return;
	}
	wp_nav_menu( array(
		'theme_location'  => 'rbs-footer',
		'container'       => 'nav',
		'container_class' => 'rbs-footer-nav',
		'container_aria_label' => 'Footer',
		'depth'           => 1,
		'fallback_cb'     => false,
	) );
}
add_action( 'generate_before_copyright', 'rbs_footer_menu' );

add_filter( 'generate_copyright', function () {
	return sprintf(
		'&copy; %1$s %2$s · Sizes are estimates, see our <a href="%3$s">disclaimer</a>.',
		esc_html( gmdate( 'Y' ) ),
		esc_html( RBS_SITE_NAME ),
		esc_url( home_url( '/disclaimer/' ) )
	);
} );

/* -------------------------------------------------------- tool cards */

/**
 * "Other free sizing tools" / "More sizing tools" lists become a grid of
 * icon cards. Done on output, so the page content itself stays the same.
 */
function rbs_tool_card_info() {
	return array(
		'/'                                  => array( 'ring', 'Online ring sizer', 'Match a ring on your phone screen' ),
		'/ring-size-calculator/'             => array( 'calc', 'Ring size calculator', 'From a measurement in mm or inches' ),
		'/ring-size-converter/'              => array( 'swap', 'Ring size converter', 'US, UK, EU and India sizes' ),
		'/ring-size-chart/'                  => array( 'chart', 'Ring size chart', 'Every system in one table' ),
		'/printable-ring-sizer/'             => array( 'print', 'Printable ring sizer', 'Free PDF, print at 100%' ),
		'/how-to-measure-ring-size-at-home/' => array( 'guide', 'Measure ring size at home', 'Four ways, no tools needed' ),
		'/bangle-size-calculator/'           => array( 'bangle', 'Bangle size calculator', 'Indian sizes 1.10 to 3.4 on screen' ),
		'/bangle-size-chart/'                => array( 'chart', 'Bangle size chart', 'Diameter in inches, mm and cm' ),
		'/how-to-measure-bangle-size/'       => array( 'guide', 'Measure bangle size', 'With a string or an old bangle' ),
		'/bracelet-size-calculator/'         => array( 'bracelet', 'Bracelet size calculator', 'Length from your wrist size' ),
		'/wrist-size-chart/'                 => array( 'chart', 'Wrist size chart', 'Bracelet length for every wrist' ),
	);
}

function rbs_icon( $name ) {
	$paths = array(
		'ring'     => '<circle cx="12" cy="14" r="7"/><path d="M9 4h6l-3 3z"/>',
		'bangle'   => '<ellipse cx="12" cy="12" rx="9" ry="5"/><ellipse cx="12" cy="12" rx="6" ry="2.6"/>',
		'bracelet' => '<circle cx="6" cy="12" r="3"/><circle cx="12" cy="12" r="3"/><circle cx="18" cy="12" r="3"/>',
		'chart'    => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M3 14h18M10 4v16"/>',
		'calc'     => '<rect x="5" y="3" width="14" height="18" rx="2"/><path d="M8 7h8M8 12h2M14 12h2M8 16h2M14 16h2"/>',
		'swap'     => '<path d="M4 8h14l-3-3M20 16H6l3 3"/>',
		'print'    => '<path d="M7 9V4h10v5"/><rect x="3" y="9" width="18" height="8" rx="2"/><path d="M7 14h10v6H7z"/>',
		'guide'    => '<path d="M3 17 17 3l4 4L7 21z"/><path d="M7 13l2 2M10 10l2 2M13 7l2 2"/>',
	);
	$p = isset( $paths[ $name ] ) ? $paths[ $name ] : $paths['ring'];
	return '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $p . '</svg>';
}

function rbs_tool_cards( $content ) {
	if ( ! is_singular( 'page' ) || false === strpos( $content, 'sizing tools</h2>' ) ) {
		return $content;
	}
	return preg_replace_callback(
		'#(<h2>(?:Other free sizing tools|More sizing tools)</h2>)\s*<ul>(.*?)</ul>#s',
		function ( $m ) {
			$info = rbs_tool_card_info();
			preg_match_all( '#<a href="([^"]+)"[^>]*>(.*?)</a>#s', $m[2], $links, PREG_SET_ORDER );
			$seen  = array();
			$cards = '';
			foreach ( $links as $l ) {
				$path = wp_parse_url( $l[1], PHP_URL_PATH );
				$path = $path ? $path : '/';
				if ( isset( $seen[ $path ] ) ) {
					continue;
				}
				$seen[ $path ] = true;
				$i      = isset( $info[ $path ] ) ? $info[ $path ] : array( 'guide', wp_strip_all_tags( $l[2] ), '' );
				$cards .= '<a class="rbs-tcard" href="' . esc_url( $l[1] ) . '"><span class="rbs-tico">' . rbs_icon( $i[0] ) . '</span><span class="rbs-ttxt"><strong>' . esc_html( $i[1] ) . '</strong>' . ( $i[2] ? '<small>' . esc_html( $i[2] ) . '</small>' : '' ) . '</span></a>';
			}
			return $m[1] . '<nav class="rbs-tcards" aria-label="More sizing tools">' . $cards . '</nav>';
		},
		$content
	);
}
add_filter( 'the_content', 'rbs_tool_cards', 16 );

/* ----------------------------------------------------------- contact */

function rbs_email_shortcode() {
	$e = antispambot( RBS_CONTACT_EMAIL );
	return '<a href="mailto:' . $e . '">' . $e . '</a>';
}
add_shortcode( 'rbs_email', 'rbs_email_shortcode' );

/**
 * [rbs_contact] – shows the first Contact Form 7 or WPForms form if one of
 * those plugins is active, otherwise the e-mail address.
 */
function rbs_contact_shortcode() {
	if ( shortcode_exists( 'contact-form-7' ) ) {
		$f = get_posts( array( 'post_type' => 'wpcf7_contact_form', 'numberposts' => 1, 'orderby' => 'ID', 'order' => 'ASC' ) );
		if ( $f ) {
			return do_shortcode( '[contact-form-7 id="' . (int) $f[0]->ID . '"]' );
		}
	}
	if ( shortcode_exists( 'wpforms' ) ) {
		$f = get_posts( array( 'post_type' => 'wpforms', 'numberposts' => 1, 'orderby' => 'ID', 'order' => 'ASC' ) );
		if ( $f ) {
			return do_shortcode( '[wpforms id="' . (int) $f[0]->ID . '"]' );
		}
	}
	return '<p class="rbs-contact-mail">E-mail: ' . rbs_email_shortcode() . '</p>';
}
add_shortcode( 'rbs_contact', 'rbs_contact_shortcode' );

/* ---------------------------------------------------------- schema */

function rbs_org_entity() {
	$org = array(
		'@type' => 'Organization',
		'@id'   => home_url( '/#organization' ),
		'name'  => RBS_SITE_NAME,
		'url'   => home_url( '/' ),
		'email' => RBS_CONTACT_EMAIL,
		'founder' => rbs_founder_entity(),
	);
	$logo = get_site_icon_url( 512 );
	if ( ! $logo ) {
		$logo = RBS_URI . '/assets/img/logo-512.png';
	}
	if ( $logo ) {
		$org['logo'] = $logo;
	}
	if ( rbs_same_as() ) {
		$org['sameAs'] = rbs_same_as();
	}
	return $org;
}

function rbs_editor_entity() {
	return array(
		'@type'    => 'Organization',
		'name'     => RBS_EDITOR_NAME,
		'url'      => home_url( '/about/' ),
		'parentOrganization' => array( '@id' => home_url( '/#organization' ) ),
	);
}

/**
 * With Rank Math: add sameAs to its Organization and credit pages to the founder (matches the author box).
 */
add_filter( 'rank_math/json_ld', function ( $data ) {
	if ( ! is_array( $data ) ) {
		return $data;
	}
	foreach ( $data as $k => $entity ) {
		if ( ! is_array( $entity ) || empty( $entity['@type'] ) ) {
			continue;
		}
		$types = (array) $entity['@type'];
		if ( in_array( 'Organization', $types, true ) ) {
			if ( rbs_same_as() ) {
				$data[ $k ]['sameAs'] = rbs_same_as();
			}
			$data[ $k ]['founder'] = rbs_founder_entity();
		}
		if ( is_singular( 'page' ) ) {
			if ( isset( $entity['author'] ) ) {
				$data[ $k ]['author'] = rbs_founder_entity();
			}
			if ( in_array( 'Person', $types, true ) ) {
				unset( $data[ $k ] ); // WP admin user; pages are credited to the founder.
			}
		}
	}
	return $data;
}, 99 );

/**
 * Without Rank Math: Organization, WebSite and BreadcrumbList.
 */
function rbs_fallback_schema() {
	if ( rbs_rank_math_active() ) {
		return;
	}
	$graph = array(
		rbs_org_entity(),
		array(
			'@type'     => 'WebSite',
			'@id'       => home_url( '/#website' ),
			'name'      => RBS_SITE_NAME,
			'url'       => home_url( '/' ),
			'publisher' => array( '@id' => home_url( '/#organization' ) ),
		),
	);
	if ( is_singular( 'page' ) && '1' !== get_post_meta( get_queried_object_id(), 'rbs_noindex', true ) ) {
		// WebPage: dates, author and sources for answer engines and AI search.
		$id      = get_queried_object_id();
		$url     = get_permalink( $id );
		$webpage = array(
			'@type'         => 'WebPage',
			'@id'           => $url . '#webpage',
			'url'           => $url,
			'name'          => wp_strip_all_tags( get_the_title( $id ) ),
			'description'   => (string) get_post_meta( $id, 'rank_math_description', true ),
			'isPartOf'      => array( '@id' => home_url( '/#website' ) ),
			'datePublished' => get_the_date( 'c', $id ),
			'dateModified'  => get_the_modified_date( 'c', $id ),
			'author'        => array( '@id' => home_url( '/#founder' ) ),
			'publisher'     => array( '@id' => home_url( '/#organization' ) ),
			'inLanguage'    => 'en',
		);
		if ( ! is_front_page() ) {
			$webpage['breadcrumb'] = array( '@id' => $url . '#breadcrumb' );
		}
		$cites = function_exists( 'rbs_page_citations' ) ? rbs_page_citations( $id ) : array();
		if ( $cites ) {
			$webpage['citation'] = $cites;
		}
		$graph[] = $webpage;
	}
	if ( is_singular( 'page' ) && ! is_front_page() ) {
		$items = array();
		foreach ( rbs_breadcrumb_trail() as $i => $c ) {
			$items[] = array(
				'@type'    => 'ListItem',
				'position' => $i + 1,
				'name'     => $c[0],
				'item'     => $c[1],
			);
		}
		$graph[] = array( '@type' => 'BreadcrumbList', '@id' => get_permalink( get_queried_object_id() ) . '#breadcrumb', 'itemListElement' => $items );

		// Guides under /blog/ are articles. The byline matches the visible author box.
		$id     = get_queried_object_id();
		$parent = (int) wp_get_post_parent_id( $id );
		if ( $parent && 'blog' === get_post_field( 'post_name', $parent ) ) {
			$img     = rbs_og_image( $id );
			$graph[] = array(
				'@type'            => 'Article',
				'@id'              => get_permalink( $id ) . '#article',
				'headline'         => wp_strip_all_tags( get_the_title( $id ) ),
				'description'      => (string) get_post_meta( $id, 'rank_math_description', true ),
				'image'            => array( '@type' => 'ImageObject', 'url' => $img['url'], 'width' => $img['w'], 'height' => $img['h'] ),
				'datePublished'    => get_the_date( 'c', $id ),
				'dateModified'     => get_the_modified_date( 'c', $id ),
				'author'           => rbs_founder_entity(),
				'publisher'        => array( '@id' => home_url( '/#organization' ) ),
				'mainEntityOfPage' => get_permalink( $id ),
				'inLanguage'       => 'en',
			);
		}
	}
	echo '<script type="application/ld+json">' . wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $graph ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_footer', 'rbs_fallback_schema', 7 );

/* ------------------------------------------- SEO fallback (no Rank Math) */

add_filter( 'pre_get_document_title', function ( $title ) {
	if ( rbs_rank_math_active() || ! is_singular( 'page' ) ) {
		return $title;
	}
	$t = get_post_meta( get_the_ID(), 'rank_math_title', true );
	return $t ? $t : $title;
}, 20 );

add_action( 'wp_head', function () {
	if ( rbs_rank_math_active() || ! is_singular( 'page' ) ) {
		return;
	}
	$d = get_post_meta( get_the_ID(), 'rank_math_description', true );
	if ( $d ) {
		echo '<meta name="description" content="' . esc_attr( $d ) . '">' . "\n";
	}
}, 1 );

add_filter( 'wp_robots', function ( $robots ) {
	if ( rbs_rank_math_active() || ! is_singular( 'page' ) ) {
		return $robots;
	}
	if ( '1' === get_post_meta( get_queried_object_id(), 'rbs_noindex', true ) ) {
		$robots['noindex'] = true;
		$robots['follow']  = true;
		unset( $robots['max-image-preview'] );
	}
	return $robots;
} );

/* --------------------------------------------- no-plugin SEO extras */

/**
 * Open Graph / Twitter tags (Rank Math is not used on this site).
 */
add_action( 'wp_head', function () {
	if ( rbs_rank_math_active() || ! is_singular( 'page' ) ) {
		return;
	}
	$id    = get_queried_object_id();
	$title = get_post_meta( $id, 'rank_math_title', true );
	$desc  = get_post_meta( $id, 'rank_math_description', true );
	$tags  = array(
		'og:type'        => is_front_page() ? 'website' : 'article',
		'og:site_name'   => RBS_SITE_NAME,
		'og:title'       => $title ? $title : get_the_title( $id ),
		'og:description' => $desc,
		'og:url'         => get_permalink( $id ),
		'og:locale'      => 'en_US',
	);
	$img  = rbs_og_image( $id );
	$tags = array_merge( $tags, array(
		'og:image'        => $img['url'],
		'og:image:width'  => $img['w'],
		'og:image:height' => $img['h'],
		'og:image:alt'    => get_the_title( $id ),
	) );
	foreach ( $tags as $p => $v ) {
		if ( $v ) {
			echo '<meta property="' . esc_attr( $p ) . '" content="' . esc_attr( $v ) . '">' . "\n";
		}
	}
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}, 2 );

/**
 * Core sitemap (/wp-sitemap.xml): pages only, without noindex pages, and no
 * users sitemap (it would expose the admin login name).
 */
add_filter( 'wp_sitemaps_add_provider', function ( $provider, $name ) {
	return 'users' === $name ? false : $provider;
}, 10, 2 );

add_filter( 'wp_sitemaps_post_types', function ( $types ) {
	return array_intersect_key( $types, array( 'page' => true ) );
} );

add_filter( 'wp_sitemaps_taxonomies', '__return_empty_array' );

add_filter( 'wp_sitemaps_posts_query_args', function ( $args, $post_type ) {
	if ( 'page' !== $post_type ) {
		return $args;
	}
	$args['meta_query'] = array(
		'relation' => 'OR',
		array( 'key' => 'rbs_noindex', 'compare' => 'NOT EXISTS' ),
		array( 'key' => 'rbs_noindex', 'value' => '1', 'compare' => '!=' ),
	);
	return $args;
}, 10, 2 );

/**
 * Old or mistyped paths that once appeared in links: 301 to the real page (F-S01).
 */
add_action( 'template_redirect', function () {
	if ( ! is_404() ) {
		return;
	}
	$map  = array(
		'bangle-size-chart-in-cm' => '/bangle-size-chart/in-cm/',
	);
	$path = trim( (string) wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '', PHP_URL_PATH ), '/' ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	if ( isset( $map[ $path ] ) ) {
		wp_safe_redirect( home_url( $map[ $path ] ), 301 );
		exit;
	}
}, 1 );

/**
 * No blog posts or comments, so the feeds are empty: drop the head links (F-S03)
 * and send any feed request to the home page.
 */
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
add_action( 'template_redirect', function () {
	if ( is_feed() ) {
		wp_safe_redirect( home_url( '/' ), 301 );
		exit;
	}
}, 1 );

/**
 * Author archives are thin and expose the login name: send them home.
 */
add_action( 'template_redirect', function () {
	if ( is_author() ) {
		wp_safe_redirect( home_url( '/' ), 301 );
		exit;
	}
} );

/**
 * Search engine verification tags (Google Search Console, Bing Webmaster).
 */
add_action( 'wp_head', function () {
	if ( ! is_front_page() ) {
		return;
	}
	echo '<meta name="google-site-verification" content="T07U_TvOgPRCg3jNwhmYO_Ui8VniA4LaTNXJe4YaZvs" />' . "\n";
}, 1 );

/**
 * Google Tag Manager (container GTM-55J58VQK). The loader script is async,
 * so it does not block rendering; the noscript iframe goes right after <body>.
 * Skipped in the Customizer preview so editing does not send fake hits.
 */
define( 'RBS_GTM_ID', 'GTM-55J58VQK' );

add_action( 'wp_head', function () {
	if ( is_customize_preview() ) {
		return;
	}
	echo "<!-- Google Tag Manager -->\n";
	echo "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','" . esc_js( RBS_GTM_ID ) . "');</script>\n";
	echo "<!-- End Google Tag Manager -->\n";
}, 2 );

add_action( 'wp_body_open', function () {
	if ( is_customize_preview() ) {
		return;
	}
	echo '<!-- Google Tag Manager (noscript) --><noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . esc_attr( RBS_GTM_ID ) . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript><!-- End Google Tag Manager (noscript) -->' . "\n";
}, 1 );

/**
 * Favicon from the theme while no Site Icon is set in WP admin
 * (avoids the /favicon.ico 404 and gives Google a search-result icon).
 */
add_action( 'wp_head', function () {
	if ( has_site_icon() ) {
		return;
	}
	echo '<link rel="icon" href="' . esc_url( RBS_URI . '/assets/img/icon.svg' ) . '" type="image/svg+xml">' . "\n";
	echo '<link rel="icon" href="' . esc_url( RBS_URI . '/assets/img/icon-32.png' ) . '" sizes="32x32" type="image/png">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url( RBS_URI . '/assets/img/apple-touch-icon.png' ) . '">' . "\n";
}, 3 );

/**
 * Wrap every content table that is not already in .rbs-table-wrap, so wide
 * tables scroll inside their own box on phones instead of widening the page.
 */
function rbs_wrap_tables( $content ) {
	if ( false === strpos( $content, '<table' ) ) {
		return $content;
	}
	return preg_replace_callback(
		'#(<div class="rbs-table-wrap">\s*)?<table\b.*?</table>#s',
		function ( $m ) {
			return ! empty( $m[1] ) ? $m[0] : '<div class="rbs-table-wrap">' . $m[0] . '</div>';
		},
		$content
	);
}
add_filter( 'the_content', 'rbs_wrap_tables', 15 );

/**
 * Logo mark (ring + bangle) in front of the site title, and "Sizer" in blue.
 * Inline SVG: no extra request.
 */
function rbs_logo_svg( $size = 34 ) {
	return '<svg class="rbs-logo" width="' . (int) $size . '" height="' . (int) $size . '" viewBox="0 0 40 40" aria-hidden="true" focusable="false"><circle cx="16" cy="20" r="12" fill="none" stroke="#1d4ed8" stroke-width="4"/><circle cx="28" cy="22" r="7.5" fill="none" stroke="#d4a017" stroke-width="4"/></svg>';
}
add_filter( 'generate_site_title_output', function ( $output ) {
	$name = get_bloginfo( 'name' );
	if ( 'Ring Bangle Sizer' !== $name || false === strpos( $output, $name . '</a>' ) ) {
		return $output;
	}
	return str_replace( $name . '</a>', rbs_logo_svg() . '<span class="rbs-wordmark">Ring Bangle <span>Sizer</span></span></a>', $output );
} );

