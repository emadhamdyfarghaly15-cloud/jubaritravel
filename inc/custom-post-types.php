<?php
/**
 * Custom Post Types: Destinations, Trips, Testimonials
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Custom Post Types.
 *
 * @return void
 */
function jubari_register_post_types() {

	// Destination CPT.
	$destination_labels = array(
		'name'                  => _x( 'الوجهات', 'Post Type General Name', 'jubari-theme' ),
		'singular_name'         => _x( 'وجهة', 'Post Type Singular Name', 'jubari-theme' ),
		'menu_name'             => esc_html__( 'الوجهات', 'jubari-theme' ),
		'name_admin_bar'        => esc_html__( 'وجهة', 'jubari-theme' ),
		'all_items'             => esc_html__( 'جميع الوجهات', 'jubari-theme' ),
		'add_new_item'          => esc_html__( 'إضافة وجهة جديدة', 'jubari-theme' ),
		'add_new'               => esc_html__( 'إضافة جديدة', 'jubari-theme' ),
		'new_item'              => esc_html__( 'وجهة جديدة', 'jubari-theme' ),
		'edit_item'             => esc_html__( 'تعديل الوجهة', 'jubari-theme' ),
		'update_item'           => esc_html__( 'تحديث الوجهة', 'jubari-theme' ),
		'view_item'             => esc_html__( 'عرض الوجهة', 'jubari-theme' ),
		'view_items'            => esc_html__( 'عرض الوجهات', 'jubari-theme' ),
		'search_items'          => esc_html__( 'بحث في الوجهات', 'jubari-theme' ),
		'not_found'             => esc_html__( 'لم يتم العثور على وجهات', 'jubari-theme' ),
		'not_found_in_trash'    => esc_html__( 'لم يتم العثور على وجهات في سلة المهملات', 'jubari-theme' ),
		'featured_image'        => esc_html__( 'صورة الوجهة الرئيسية', 'jubari-theme' ),
		'set_featured_image'    => esc_html__( 'تعيين صورة الوجهة', 'jubari-theme' ),
		'remove_featured_image' => esc_html__( 'إزالة الصورة', 'jubari-theme' ),
		'use_featured_image'    => esc_html__( 'استخدام كصورة للوجهة', 'jubari-theme' ),
		'archives'              => esc_html__( 'أرشيف الوجهات', 'jubari-theme' ),
		'insert_into_item'      => esc_html__( 'إدراج داخل الوجهة', 'jubari-theme' ),
		'uploaded_to_this_item' => esc_html__( 'المرفوع إلى هذه الوجهة', 'jubari-theme' ),
		'items_list'            => esc_html__( 'قائمة الوجهات', 'jubari-theme' ),
		'items_list_navigation' => esc_html__( 'تصفح قائمة الوجهات', 'jubari-theme' ),
		'filter_items_list'     => esc_html__( 'تصفية قائمة الوجهات', 'jubari-theme' ),
	);

	$destination_args = array(
		'label'               => esc_html__( 'وجهة', 'jubari-theme' ),
		'labels'              => $destination_labels,
		'description'         => esc_html__( 'الوجهات السياحية', 'jubari-theme' ),
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
		'taxonomies'          => array( 'destination_region' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'show_in_rest'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-location-alt',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'             => array(
			'slug'       => 'destinations',
			'with_front' => false,
		),
	);

	register_post_type( 'destination', $destination_args );

	// Trip CPT.
	$trip_labels = array(
		'name'                  => _x( 'الرحلات', 'Post Type General Name', 'jubari-theme' ),
		'singular_name'         => _x( 'رحلة', 'Post Type Singular Name', 'jubari-theme' ),
		'menu_name'             => esc_html__( 'الرحلات', 'jubari-theme' ),
		'name_admin_bar'        => esc_html__( 'رحلة', 'jubari-theme' ),
		'all_items'             => esc_html__( 'جميع الرحلات', 'jubari-theme' ),
		'add_new_item'          => esc_html__( 'إضافة رحلة جديدة', 'jubari-theme' ),
		'add_new'               => esc_html__( 'إضافة جديدة', 'jubari-theme' ),
		'new_item'              => esc_html__( 'رحلة جديدة', 'jubari-theme' ),
		'edit_item'             => esc_html__( 'تعديل الرحلة', 'jubari-theme' ),
		'update_item'           => esc_html__( 'تحديث الرحلة', 'jubari-theme' ),
		'view_item'             => esc_html__( 'عرض الرحلة', 'jubari-theme' ),
		'view_items'            => esc_html__( 'عرض الرحلات', 'jubari-theme' ),
		'search_items'          => esc_html__( 'بحث في الرحلات', 'jubari-theme' ),
		'not_found'             => esc_html__( 'لم يتم العثور على رحلات', 'jubari-theme' ),
		'not_found_in_trash'    => esc_html__( 'لم يتم العثور على رحلات في سلة المهملات', 'jubari-theme' ),
		'featured_image'        => esc_html__( 'صورة الرحلة', 'jubari-theme' ),
		'set_featured_image'    => esc_html__( 'تعيين صورة الرحلة', 'jubari-theme' ),
		'remove_featured_image' => esc_html__( 'إزالة الصورة', 'jubari-theme' ),
		'use_featured_image'    => esc_html__( 'استخدام كصورة للرحلة', 'jubari-theme' ),
		'archives'              => esc_html__( 'أرشيف الرحلات', 'jubari-theme' ),
		'insert_into_item'      => esc_html__( 'إدراج داخل الرحلة', 'jubari-theme' ),
		'uploaded_to_this_item' => esc_html__( 'المرفوع إلى هذه الرحلة', 'jubari-theme' ),
		'items_list'            => esc_html__( 'قائمة الرحلات', 'jubari-theme' ),
		'items_list_navigation' => esc_html__( 'تصفح قائمة الرحلات', 'jubari-theme' ),
		'filter_items_list'     => esc_html__( 'تصفية قائمة الرحلات', 'jubari-theme' ),
	);

	$trip_args = array(
		'label'               => esc_html__( 'رحلة', 'jubari-theme' ),
		'labels'              => $trip_labels,
		'description'         => esc_html__( 'الرحلات والبرامج السياحية', 'jubari-theme' ),
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
		'taxonomies'          => array( 'trip_type', 'destination_region' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'show_in_rest'        => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-palmtree',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'             => array(
			'slug'       => 'trips',
			'with_front' => false,
		),
	);

	register_post_type( 'trip', $trip_args );

	// Testimonial CPT.
	$testimonial_labels = array(
		'name'                  => _x( 'آراء العملاء', 'Post Type General Name', 'jubari-theme' ),
		'singular_name'         => _x( 'رأي عميل', 'Post Type Singular Name', 'jubari-theme' ),
		'menu_name'             => esc_html__( 'آراء العملاء', 'jubari-theme' ),
		'name_admin_bar'        => esc_html__( 'رأي عميل', 'jubari-theme' ),
		'all_items'             => esc_html__( 'جميع الآراء', 'jubari-theme' ),
		'add_new_item'          => esc_html__( 'إضافة رأي جديد', 'jubari-theme' ),
		'add_new'               => esc_html__( 'إضافة جديدة', 'jubari-theme' ),
		'new_item'              => esc_html__( 'رأي جديد', 'jubari-theme' ),
		'edit_item'             => esc_html__( 'تعديل الرأي', 'jubari-theme' ),
		'update_item'           => esc_html__( 'تحديث الرأي', 'jubari-theme' ),
		'view_item'             => esc_html__( 'عرض الرأي', 'jubari-theme' ),
		'view_items'            => esc_html__( 'عرض الآراء', 'jubari-theme' ),
		'search_items'          => esc_html__( 'بحث في الآراء', 'jubari-theme' ),
		'not_found'             => esc_html__( 'لم يتم العثور على آراء', 'jubari-theme' ),
		'not_found_in_trash'    => esc_html__( 'لم يتم العثور على آراء في سلة المهملات', 'jubari-theme' ),
		'featured_image'        => esc_html__( 'صورة العميل', 'jubari-theme' ),
		'set_featured_image'    => esc_html__( 'تعيين صورة العميل', 'jubari-theme' ),
		'remove_featured_image' => esc_html__( 'إزالة الصورة', 'jubari-theme' ),
		'use_featured_image'    => esc_html__( 'استخدام كصورة للعميل', 'jubari-theme' ),
		'items_list'            => esc_html__( 'قائمة الآراء', 'jubari-theme' ),
		'items_list_navigation' => esc_html__( 'تصفح قائمة الآراء', 'jubari-theme' ),
		'filter_items_list'     => esc_html__( 'تصفية قائمة الآراء', 'jubari-theme' ),
	);

	$testimonial_args = array(
		'label'               => esc_html__( 'رأي عميل', 'jubari-theme' ),
		'labels'              => $testimonial_labels,
		'description'         => esc_html__( 'آراء العملاء وتقييماتهم', 'jubari-theme' ),
		'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'revisions' ),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => false,
		'show_in_nav_menus'   => false,
		'show_in_rest'        => true,
		'menu_position'       => 7,
		'menu_icon'           => 'dashicons-format-quote',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'post',
		'rewrite'             => false,
	);

	register_post_type( 'testimonial', $testimonial_args );
}
add_action( 'init', 'jubari_register_post_types' );

/**
 * Flush rewrite rules on theme activation.
 *
 * @return void
 */
function jubari_rewrite_flush() {
	jubari_register_post_types();

	if ( function_exists( 'jubari_register_taxonomies' ) ) {
		jubari_register_taxonomies();
	}

	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'jubari_rewrite_flush' );