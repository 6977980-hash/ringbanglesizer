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

/* ---------------------------------------------------- editorial box */

function rbs_author_box( $content ) {
	if ( ! is_singular( 'page' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	if ( '1' !== get_post_meta( get_the_ID(), 'rbs_author_box', true ) ) {
		return $content;
	}
	$box = sprintf(
		'<aside class="rbs-author"><p class="rbs-author-name"><strong>Written and checked by the %1$s</strong> · Updated <time datetime="%2$s">%3$s</time></p><p>Ring Bangle Sizer was founded by <a href="%6$s" rel="noopener" target="_blank">%7$s</a>. We build free sizing tools for rings, bangles and bracelets. Every size on this site comes from published standards (ISO 8653 for rings, the Indian inch-and-sixteenths system for bangles), and we show the maths so you can check it yourself. Read <a href="%4$s">how we measure</a> or <a href="%5$s">contact us</a> if something looks wrong.</p></aside>',
		esc_html( RBS_EDITOR_NAME ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date( 'F j, Y' ) ),
		esc_url( home_url( '/how-we-measure/' ) ),
		esc_url( home_url( '/contact/' ) ),
		esc_url( RBS_FOUNDER_URL ),
		esc_html( RBS_FOUNDER_NAME )
	);
	return $content . $box;
}
add_filter( 'the_content', 'rbs_author_box', 20 );

/* ------------------------------------------------------------ footer */

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
 * With Rank Math: add sameAs to its Organization and credit pages to the editorial team.
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
				$data[ $k ]['author'] = rbs_editor_entity();
			}
			if ( in_array( 'Person', $types, true ) ) {
				unset( $data[ $k ] ); // WP admin user; pages are credited to the team.
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
		$graph[] = array( '@type' => 'BreadcrumbList', 'itemListElement' => $items );
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
 * Favicon from the theme while no Site Icon is set in WP admin
 * (avoids the /favicon.ico 404 and gives Google a search-result icon).
 */
add_action( 'wp_head', function () {
	if ( has_site_icon() ) {
		return;
	}
	echo '<link rel="icon" href="' . esc_url( RBS_URI . '/assets/img/icon.svg' ) . '" type="image/svg+xml">' . "\n";
}, 3 );
