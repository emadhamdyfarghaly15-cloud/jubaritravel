<?php
/**
 * Custom Taxonomies
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register custom taxonomies.
 *
 * @return void
 */
function jubari_register_taxonomies() {

	// Destination Region taxonomy.
	$destination_region_labels = array(
		'name'                       => _x( 'المناطق', 'Taxonomy General Name', 'jubari-theme' ),
		'singular_name'              => _x( 'منطقة', 'Taxonomy Singular Name', 'jubari-theme' ),
		'menu_name'                  => esc_html__( 'المناطق', 'jubari-theme' ),
		'all_items'                  => esc_html__( 'جميع المناطق', 'jubari-theme' ),
		'parent_item'                => esc_html__( 'المنطقة الرئيسية', 'jubari-theme' ),
		'parent_item_colon'          => esc_html__( 'المنطقة الرئيسية:', 'jubari-theme' ),
		'new_item_name'              => esc_html__( 'اسم المنطقة الجديدة', 'jubari-theme' ),
		'add_new_item'               => esc_html__( 'إضافة منطقة جديدة', 'jubari-theme' ),
		'edit_item'                  => esc_html__( 'تعديل المنطقة', 'jubari-theme' ),
		'update_item'                => esc_html__( 'تحديث المنطقة', 'jubari-theme' ),
		'view_item'                  => esc_html__( 'عرض المنطقة', 'jubari-theme' ),
		'separate_items_with_commas' => esc_html__( 'افصل المناطق بفواصل', 'jubari-theme' ),
		'add_or_remove_items'        => esc_html__( 'إضافة أو إزالة مناطق', 'jubari-theme' ),
		'choose_from_most_used'      => esc_html__( 'اختر من الأكثر استخداماً', 'jubari-theme' ),
		'popular_items'              => esc_html__( 'المناطق الشائعة', 'jubari-theme' ),
		'search_items'               => esc_html__( 'بحث في المناطق', 'jubari-theme' ),
		'not_found'                  => esc_html__( 'لم يتم العثور على مناطق', 'jubari-theme' ),
		'no_terms'                   => esc_html__( 'لا توجد مناطق', 'jubari-theme' ),
		'items_list'                 => esc_html__( 'قائمة المناطق', 'jubari-theme' ),
		'items_list_navigation'      => esc_html__( 'تصفح قائمة المناطق', 'jubari-theme' ),
	);

	$destination_region_args = array(
		'labels'            => $destination_region_labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'         => 'region',
			'with_front'   => false,
			'hierarchical' => true,
		),
	);

	register_taxonomy( 'destination_region', array( 'destination', 'trip' ), $destination_region_args );

	// Trip Type taxonomy.
	$trip_type_labels = array(
		'name'                       => _x( 'أنواع الرحلات', 'Taxonomy General Name', 'jubari-theme' ),
		'singular_name'              => _x( 'نوع الرحلة', 'Taxonomy Singular Name', 'jubari-theme' ),
		'menu_name'                  => esc_html__( 'أنواع الرحلات', 'jubari-theme' ),
		'all_items'                  => esc_html__( 'جميع الأنواع', 'jubari-theme' ),
		'parent_item'                => esc_html__( 'النوع الرئيسي', 'jubari-theme' ),
		'parent_item_colon'          => esc_html__( 'النوع الرئيسي:', 'jubari-theme' ),
		'new_item_name'              => esc_html__( 'اسم النوع الجديد', 'jubari-theme' ),
		'add_new_item'               => esc_html__( 'إضافة نوع جديد', 'jubari-theme' ),
		'edit_item'                  => esc_html__( 'تعديل النوع', 'jubari-theme' ),
		'update_item'                => esc_html__( 'تحديث النوع', 'jubari-theme' ),
		'view_item'                  => esc_html__( 'عرض النوع', 'jubari-theme' ),
		'separate_items_with_commas' => esc_html__( 'افصل الأنواع بفواصل', 'jubari-theme' ),
		'add_or_remove_items'        => esc_html__( 'إضافة أو إزالة أنواع', 'jubari-theme' ),
		'choose_from_most_used'      => esc_html__( 'اختر من الأكثر استخداماً', 'jubari-theme' ),
		'popular_items'              => esc_html__( 'الأنواع الشائعة', 'jubari-theme' ),
		'search_items'               => esc_html__( 'بحث في أنواع الرحلات', 'jubari-theme' ),
		'not_found'                  => esc_html__( 'لم يتم العثور على أنواع', 'jubari-theme' ),
		'no_terms'                   => esc_html__( 'لا توجد أنواع', 'jubari-theme' ),
		'items_list'                 => esc_html__( 'قائمة الأنواع', 'jubari-theme' ),
		'items_list_navigation'      => esc_html__( 'تصفح قائمة الأنواع', 'jubari-theme' ),
	);

	$trip_type_args = array(
		'labels'            => $trip_type_labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'         => 'trip-type',
			'with_front'   => false,
			'hierarchical' => true,
		),
	);

	register_taxonomy( 'trip_type', array( 'trip' ), $trip_type_args );
}
add_action( 'init', 'jubari_register_taxonomies' );