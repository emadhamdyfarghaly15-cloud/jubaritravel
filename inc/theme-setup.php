<?php
/**
 * Theme Setup — supports, menus, sidebars, image sizes
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sets the content width in pixels.
 */
function jubari_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jubari_content_width', 1200 );
}
add_action( 'after_setup_theme', 'jubari_content_width', 0 );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function jubari_theme_setup() {

	// Make theme available for translation.
	load_theme_textdomain( 'jubari-theme', JUBARI_THEME_DIR . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable featured images.
	add_theme_support( 'post-thumbnails' );

	// Default thumbnail sizes for relevant post types.
	set_post_thumbnail_size( 800, 600, true );

	// Custom logo support.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// HTML5 markup support.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	// Gutenberg / block editor support.
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );

	// Optional extras.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Editor stylesheet.
	if ( file_exists( JUBARI_THEME_DIR . '/assets/css/editor-style.css' ) ) {
		add_editor_style( 'assets/css/editor-style.css' );
	}

	// Custom image sizes.
	add_image_size( 'jubari-hero', 1920, 800, true );
	add_image_size( 'jubari-card', 600, 400, true );
	add_image_size( 'jubari-card-wide', 800, 450, true );
	add_image_size( 'jubari-gallery', 800, 600, true );
	add_image_size( 'jubari-gallery-thumb', 300, 225, true );
	add_image_size( 'jubari-thumbnail-sm', 150, 150, true );

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'القائمة الرئيسية', 'jubari-theme' ),
			'footer'  => esc_html__( 'قائمة الفوتر', 'jubari-theme' ),
			'mobile'  => esc_html__( 'قائمة الجوال', 'jubari-theme' ),
			'topbar'  => esc_html__( 'قائمة الشريط العلوي', 'jubari-theme' ),
		)
	);
}
add_action( 'after_setup_theme', 'jubari_theme_setup' );

/**
 * Register widget areas / sidebars.
 */
function jubari_widgets_init() {

	// Blog sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'الشريط الجانبي للمدونة', 'jubari-theme' ),
			'id'            => 'sidebar-blog',
			'description'   => esc_html__( 'الودجات المعروضة بجانب مقالات المدونة', 'jubari-theme' ),
			'before_widget' => '<section id="%1$s" class="jt-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="jt-widget__title">',
			'after_title'   => '</h3>',
		)
	);

	// Trip sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'الشريط الجانبي للرحلات', 'jubari-theme' ),
			'id'            => 'sidebar-trip',
			'description'   => esc_html__( 'الودجات المعروضة بجانب صفحات الرحلات', 'jubari-theme' ),
			'before_widget' => '<section id="%1$s" class="jt-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="jt-widget__title">',
			'after_title'   => '</h3>',
		)
	);

	// Generic page sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'الشريط الجانبي للصفحات', 'jubari-theme' ),
			'id'            => 'sidebar-page',
			'description'   => esc_html__( 'الودجات المعروضة بجانب الصفحات الداخلية', 'jubari-theme' ),
			'before_widget' => '<section id="%1$s" class="jt-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="jt-widget__title">',
			'after_title'   => '</h3>',
		)
	);

	// Footer widgets (4 columns).
	for ( $i = 1; $i <= 4; $i++ ) {
		register_sidebar(
			array(
				'name'          => sprintf( esc_html__( 'الفوتر - العمود %d', 'jubari-theme' ), $i ),
				'id'            => 'footer-' . $i,
				'description'   => sprintf( esc_html__( 'ودجات العمود %d في الفوتر', 'jubari-theme' ), $i ),
				'before_widget' => '<section id="%1$s" class="jt-footer-widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h4 class="jt-footer-widget__title">',
				'after_title'   => '</h4>',
			)
		);
	}

	// Register custom widgets if available.
	if ( class_exists( 'Jubari_Widget_Destinations' ) ) {
		register_widget( 'Jubari_Widget_Destinations' );
	}

	if ( class_exists( 'Jubari_Widget_Recent_Trips' ) ) {
		register_widget( 'Jubari_Widget_Recent_Trips' );
	}
}
add_action( 'widgets_init', 'jubari_widgets_init' );

/**
 * Add custom image sizes to media selector in admin.
 *
 * @param array $sizes Existing image sizes.
 * @return array
 */
function jubari_custom_image_sizes( $sizes ) {
	return array_merge(
		$sizes,
		array(
			'jubari-hero'          => esc_html__( 'Jubari Hero', 'jubari-theme' ),
			'jubari-card'          => esc_html__( 'Jubari Card', 'jubari-theme' ),
			'jubari-card-wide'     => esc_html__( 'Jubari Card Wide', 'jubari-theme' ),
			'jubari-gallery'       => esc_html__( 'Jubari Gallery', 'jubari-theme' ),
			'jubari-gallery-thumb' => esc_html__( 'Jubari Gallery Thumb', 'jubari-theme' ),
			'jubari-thumbnail-sm'  => esc_html__( 'Jubari Small Thumbnail', 'jubari-theme' ),
		)
	);
}
add_filter( 'image_size_names_choose', 'jubari_custom_image_sizes' );