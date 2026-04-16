<?php
/**
 * Custom Action and Filter Hooks
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add custom body classes.
 *
 * @param array $classes Body classes.
 * @return array
 */
function jubari_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'is-front-page';
	}

	if ( is_home() ) {
		$classes[] = 'is-blog-home';
	}

	if ( is_rtl() ) {
		$classes[] = 'is-rtl';
	}

	if ( is_singular( 'trip' ) ) {
		$classes[] = 'single-trip-page';
	}

	if ( is_singular( 'destination' ) ) {
		$classes[] = 'single-destination-page';
	}

	if ( is_page_template( 'page-templates/template-about.php' ) ) {
		$classes[] = 'template-about-page';
	}

	if ( is_page_template( 'page-templates/template-contact.php' ) ) {
		$classes[] = 'template-contact-page';
	}

	if ( is_page_template( 'page-templates/template-booking.php' ) ) {
		$classes[] = 'template-booking-page';
	}

	// Blog sidebar.
	if ( ( is_singular( 'post' ) || is_archive() || is_home() || is_search() ) && is_active_sidebar( 'sidebar-blog' ) ) {
		$classes[] = 'has-sidebar';
		$classes[] = 'has-blog-sidebar';
	}

	// Trip sidebar.
	if ( is_singular( 'trip' ) && is_active_sidebar( 'sidebar-trip' ) ) {
		$classes[] = 'has-trip-sidebar';
	}

	// Generic page sidebar.
	if ( is_page() && ! is_page_template( 'page-templates/template-fullwidth.php' ) && is_active_sidebar( 'sidebar-page' ) ) {
		$classes[] = 'has-page-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'jubari_body_classes' );

/**
 * Modify the excerpt length.
 *
 * @param int $length Excerpt length.
 * @return int
 */
function jubari_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}

	return 20;
}
add_filter( 'excerpt_length', 'jubari_excerpt_length', 999 );

/**
 * Modify the excerpt more text.
 *
 * @param string $more More text.
 * @return string
 */
function jubari_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	return '...';
}
add_filter( 'excerpt_more', 'jubari_excerpt_more' );

/**
 * Filter archive title and remove generic prefixes.
 *
 * @param string $title Archive title.
 * @return string
 */
function jubari_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_search() ) {
		$title = sprintf(
			esc_html__( 'نتائج البحث عن: %s', 'jubari-theme' ),
			get_search_query()
		);
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'jubari_archive_title' );

/**
 * Print Schema.org structured data for single trip pages.
 *
 * @return void
 */
function jubari_schema_org() {
	if ( ! is_singular( 'trip' ) ) {
		return;
	}

	$post_id = get_the_ID();

	if ( ! $post_id ) {
		return;
	}

	$price         = function_exists( 'get_field' ) ? get_field( 'trip_price', $post_id ) : '';
	$currency      = function_exists( 'get_field' ) ? get_field( 'trip_currency', $post_id ) : 'USD';
	$duration      = function_exists( 'get_field' ) ? get_field( 'trip_duration', $post_id ) : '';
	$location      = function_exists( 'get_field' ) ? get_field( 'trip_location', $post_id ) : '';
	$excerpt       = get_the_excerpt( $post_id );
	$image         = get_the_post_thumbnail_url( $post_id, 'large' );
	$schema        = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'TouristTrip',
		'name'        => get_the_title( $post_id ),
		'description' => wp_strip_all_tags( $excerpt ? $excerpt : wp_trim_words( get_post_field( 'post_content', $post_id ), 30, '' ) ),
		'url'         => get_permalink( $post_id ),
	);

	if ( $image ) {
		$schema['image'] = $image;
	}

	if ( $duration && is_numeric( $duration ) ) {
		$schema['duration'] = 'P' . absint( $duration ) . 'D';
	}

	if ( $location ) {
		$schema['itinerary'] = array(
			'@type' => 'Place',
			'name'  => $location,
		);
	}

	if ( '' !== $price && null !== $price ) {
		$schema['offers'] = array(
			'@type'         => 'Offer',
			'price'         => is_numeric( $price ) ? (string) $price : $price,
			'priceCurrency' => $currency ? $currency : 'USD',
			'availability'  => 'https://schema.org/InStock',
			'url'           => get_permalink( $post_id ),
		);
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'jubari_schema_org' );

/**
 * Add pingback URL for singular posts, pages, and attachments if pings are open.
 *
 * @return void
 */
function jubari_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		echo "\n";
	}
}
add_action( 'wp_head', 'jubari_pingback_header' );


function jubari_filter_trip_archive_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( is_post_type_archive( 'trip' ) ) {
		$tax_query = array();

		if ( ! empty( $_GET['region'] ) ) {
			$tax_query[] = array(
				'taxonomy' => 'destination_region',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( wp_unslash( $_GET['region'] ) ),
			);
		}

		if ( ! empty( $_GET['trip_type'] ) ) {
			$tax_query[] = array(
				'taxonomy' => 'trip_type',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( wp_unslash( $_GET['trip_type'] ) ),
			);
		}

		if ( ! empty( $tax_query ) ) {
			$query->set( 'tax_query', $tax_query );
		}
	}
}
add_action( 'pre_get_posts', 'jubari_filter_trip_archive_query' );