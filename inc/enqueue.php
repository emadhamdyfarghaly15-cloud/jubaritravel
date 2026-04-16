<?php
/**
 * Enqueue scripts and styles
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns asset version based on file modification time when available.
 *
 * @param string $relative_path Relative path from theme root.
 * @return string
 */
function jubari_asset_version( $relative_path ) {
	$file_path = JUBARI_THEME_DIR . $relative_path;

	if ( file_exists( $file_path ) ) {
		return (string) filemtime( $file_path );
	}

	return JUBARI_THEME_VERSION;
}

/**
 * Enqueue frontend styles and scripts.
 */
function jubari_enqueue_assets() {

	// Google Fonts: Cairo + Tajawal.
	wp_enqueue_style(
		'jubari-google-fonts',
		'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&family=Tajawal:wght@400;500;700;800&display=swap',
		array(),
		null
	);

	// Swiper CSS.
	wp_enqueue_style(
		'swiper',
		'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
		array(),
		'11.0.0'
	);

	// Main compiled CSS.
	if ( file_exists( JUBARI_THEME_DIR . '/assets/css/main.css' ) ) {
		wp_enqueue_style(
			'jubari-main',
			JUBARI_THEME_URI . '/assets/css/main.css',
			array( 'jubari-google-fonts', 'swiper' ),
			jubari_asset_version( '/assets/css/main.css' )
		);
	}

	// Theme stylesheet.
	wp_enqueue_style(
		'jubari-style',
		get_stylesheet_uri(),
		file_exists( JUBARI_THEME_DIR . '/assets/css/main.css' ) ? array( 'jubari-main' ) : array( 'jubari-google-fonts', 'swiper' ),
		jubari_asset_version( '/style.css' )
	);

	// Explicit RTL overrides if file exists.
	if ( is_rtl() && file_exists( JUBARI_THEME_DIR . '/assets/css/rtl-overrides.css' ) ) {
		wp_enqueue_style(
			'jubari-rtl-overrides',
			JUBARI_THEME_URI . '/assets/css/rtl-overrides.css',
			array( 'jubari-style' ),
			jubari_asset_version( '/assets/css/rtl-overrides.css' )
		);
	}

	// Swiper JS.
	wp_enqueue_script(
		'swiper',
		'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
		array(),
		'11.0.0',
		true
	);

	// Navigation script.
	if ( file_exists( JUBARI_THEME_DIR . '/assets/js/navigation.js' ) ) {
		wp_enqueue_script(
			'jubari-navigation',
			JUBARI_THEME_URI . '/assets/js/navigation.js',
			array(),
			jubari_asset_version( '/assets/js/navigation.js' ),
			true
		);
	}

	// Front page hero slider.
	if ( is_front_page() && file_exists( JUBARI_THEME_DIR . '/assets/js/hero-slider.js' ) ) {
		wp_enqueue_script(
			'jubari-hero-slider',
			JUBARI_THEME_URI . '/assets/js/hero-slider.js',
			array( 'swiper' ),
			jubari_asset_version( '/assets/js/hero-slider.js' ),
			true
		);
	}

	// Main theme JS.
	if ( file_exists( JUBARI_THEME_DIR . '/assets/js/main.js' ) ) {
		wp_enqueue_script(
			'jubari-main',
			JUBARI_THEME_URI . '/assets/js/main.js',
			array( 'swiper' ),
			jubari_asset_version( '/assets/js/main.js' ),
			true
		);

		wp_localize_script(
			'jubari-main',
			'jubariData',
			array(
				'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'jubari_nonce' ),
				'isRTL'    => is_rtl(),
				'siteUrl'  => home_url( '/' ),
				'themeUrl' => JUBARI_THEME_URI,
				'strings'  => array(
					'loading'   => esc_html__( 'جاري التحميل...', 'jubari-theme' ),
					'noResults' => esc_html__( 'لا توجد نتائج', 'jubari-theme' ),
					'error'     => esc_html__( 'حدث خطأ، يرجى المحاولة مرة أخرى', 'jubari-theme' ),
					'bookNow'   => esc_html__( 'احجز الآن', 'jubari-theme' ),
				),
			)
		);
	}

	// Single trip pages.
	if ( is_singular( 'trip' ) ) {

		if ( file_exists( JUBARI_THEME_DIR . '/assets/js/gallery.js' ) ) {
			wp_enqueue_script(
				'jubari-gallery',
				JUBARI_THEME_URI . '/assets/js/gallery.js',
				array( 'swiper' ),
				jubari_asset_version( '/assets/js/gallery.js' ),
				true
			);
		}

		if ( file_exists( JUBARI_THEME_DIR . '/assets/js/itinerary.js' ) ) {
			wp_enqueue_script(
				'jubari-itinerary',
				JUBARI_THEME_URI . '/assets/js/itinerary.js',
				array(),
				jubari_asset_version( '/assets/js/itinerary.js' ),
				true
			);
		}

		if ( file_exists( JUBARI_THEME_DIR . '/assets/js/booking-form.js' ) ) {
			wp_enqueue_script(
				'jubari-booking-form',
				JUBARI_THEME_URI . '/assets/js/booking-form.js',
				array(),
				jubari_asset_version( '/assets/js/booking-form.js' ),
				true
			);
		}
	}

	// Booking page.
	if ( is_page_template( 'page-templates/template-booking.php' ) && file_exists( JUBARI_THEME_DIR . '/assets/js/booking-form.js' ) ) {
		wp_enqueue_script(
			'jubari-booking-form',
			JUBARI_THEME_URI . '/assets/js/booking-form.js',
			array(),
			jubari_asset_version( '/assets/js/booking-form.js' ),
			true
		);
	}

	// Comment reply.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jubari_enqueue_assets' );

/**
 * Add resource hints for Google Fonts.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type Relation type.
 * @return array
 */
function jubari_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href'        => 'https://fonts.googleapis.com',
			'crossorigin' => '',
		);

		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'jubari_resource_hints', 10, 2 );

/**
 * Add defer/async attributes to selected scripts.
 *
 * @param string $tag    The script tag.
 * @param string $handle Script handle.
 * @param string $src    Script source.
 * @return string
 */
function jubari_script_attributes( $tag, $handle, $src ) {
	$defer_scripts = array(
		'jubari-navigation',
		'jubari-gallery',
		'jubari-itinerary',
		'jubari-booking-form',
	);

	$async_scripts = array();

	if ( in_array( $handle, $defer_scripts, true ) ) {
		return str_replace( ' src=', ' defer src=', $tag );
	}

	if ( in_array( $handle, $async_scripts, true ) ) {
		return str_replace( ' src=', ' async src=', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'jubari_script_attributes', 10, 3 );