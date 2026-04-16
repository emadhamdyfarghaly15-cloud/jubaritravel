<?php
/**
 * ACF Field Groups — Programmatic Registration
 * Requires: Advanced Custom Fields PRO
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register ACF field groups via PHP (version-controlled, no DB dependency)
 */
function jubari_register_acf_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    // ─── Destination Fields ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_destination_details',
        'title'    => 'تفاصيل الوجهة',
        'fields'   => [
            [
                'key'   => 'field_dest_subtitle',
                'label' => 'العنوان الفرعي',
                'name'  => 'destination_subtitle',
                'type'  => 'text',
            ],
            [
                'key'           => 'field_dest_gallery',
                'label'         => 'معرض الصور',
                'name'          => 'destination_gallery',
                'type'          => 'gallery',
                'return_format' => 'array',
                'preview_size'  => 'jubari-gallery-thumb',
                'min'           => 0,
                'max'           => 20,
            ],
            [
                'key'   => 'field_dest_map_lat',
                'label' => 'خط العرض',
                'name'  => 'destination_latitude',
                'type'  => 'number',
                'step'  => 'any',
            ],
            [
                'key'   => 'field_dest_map_lng',
                'label' => 'خط الطول',
                'name'  => 'destination_longitude',
                'type'  => 'number',
                'step'  => 'any',
            ],
            [
                'key'   => 'field_dest_best_time',
                'label' => 'أفضل وقت للزيارة',
                'name'  => 'destination_best_time',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_dest_language',
                'label' => 'اللغة الرسمية',
                'name'  => 'destination_language',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_dest_currency',
                'label' => 'العملة',
                'name'  => 'destination_currency',
                'type'  => 'text',
            ],
            [
                'key'           => 'field_dest_highlights',
                'label'         => 'أبرز المعالم',
                'name'          => 'destination_highlights',
                'type'          => 'repeater',
                'layout'        => 'table',
                'sub_fields'    => [
                    [
                        'key'   => 'field_highlight_title',
                        'label' => 'العنوان',
                        'name'  => 'title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_highlight_icon',
                        'label' => 'الأيقونة',
                        'name'  => 'icon',
                        'type'  => 'text',
                        'instructions' => 'اسم أيقونة SVG مثل: mosque, beach, mountain',
                    ],
                ],
            ],
            [
                'key'   => 'field_dest_trip_count',
                'label' => 'عدد الرحلات المتوفرة',
                'name'  => 'destination_trip_count',
                'type'  => 'number',
                'default_value' => 0,
            ],
        ],
        'location' => [
            [
                [ 'param' => 'post_type', 'operator' => '==', 'value' => 'destination' ],
            ],
        ],
        'menu_order' => 0,
        'position'   => 'normal',
        'style'      => 'default',
    ] );

    // ─── Trip Fields ─────────────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_trip_details',
        'title'    => 'تفاصيل الرحلة',
        'fields'   => [
            // Pricing Tab
            [
                'key'   => 'field_trip_tab_pricing',
                'label' => 'التسعير',
                'type'  => 'tab',
            ],
            [
                'key'   => 'field_trip_price',
                'label' => 'السعر (بالدولار)',
                'name'  => 'trip_price',
                'type'  => 'number',
                'prepend' => '$',
            ],
            [
                'key'   => 'field_trip_sale_price',
                'label' => 'سعر العرض',
                'name'  => 'trip_sale_price',
                'type'  => 'number',
                'prepend' => '$',
            ],
            [
                'key'   => 'field_trip_price_note',
                'label' => 'ملاحظة السعر',
                'name'  => 'trip_price_note',
                'type'  => 'text',
                'placeholder' => 'مثال: للشخص الواحد',
            ],

            // Details Tab
            [
                'key'   => 'field_trip_tab_details',
                'label' => 'التفاصيل',
                'type'  => 'tab',
            ],
            [
                'key'   => 'field_trip_duration',
                'label' => 'المدة (بالأيام)',
                'name'  => 'trip_duration',
                'type'  => 'number',
                'min'   => 1,
            ],
            [
                'key'   => 'field_trip_group_size',
                'label' => 'حجم المجموعة',
                'name'  => 'trip_group_size',
                'type'  => 'text',
                'placeholder' => 'مثال: 10-15 شخص',
            ],
            [
                'key'     => 'field_trip_difficulty',
                'label'   => 'مستوى الصعوبة',
                'name'    => 'trip_difficulty',
                'type'    => 'select',
                'choices' => [
                    'easy'     => 'سهل',
                    'moderate' => 'متوسط',
                    'hard'     => 'صعب',
                ],
                'default_value' => 'moderate',
            ],
            [
                'key'           => 'field_trip_destination',
                'label'         => 'الوجهة المرتبطة',
                'name'          => 'trip_destination',
                'type'          => 'post_object',
                'post_type'     => [ 'destination' ],
                'return_format' => 'id',
                'allow_null'    => true,
            ],
            [
                'key'   => 'field_trip_start_dates',
                'label' => 'تواريخ الانطلاق',
                'name'  => 'trip_start_dates',
                'type'  => 'repeater',
                'layout' => 'table',
                'sub_fields' => [
                    [
                        'key'            => 'field_start_date',
                        'label'          => 'التاريخ',
                        'name'           => 'date',
                        'type'           => 'date_picker',
                        'display_format' => 'd/m/Y',
                        'return_format'  => 'Y-m-d',
                    ],
                    [
                        'key'   => 'field_start_availability',
                        'label' => 'المتاح',
                        'name'  => 'availability',
                        'type'  => 'number',
                    ],
                ],
            ],

            // Gallery Tab
            [
                'key'   => 'field_trip_tab_gallery',
                'label' => 'المعرض',
                'type'  => 'tab',
            ],
            [
                'key'           => 'field_trip_gallery',
                'label'         => 'معرض الصور',
                'name'          => 'trip_gallery',
                'type'          => 'gallery',
                'return_format' => 'array',
                'preview_size'  => 'jubari-gallery-thumb',
            ],

            // Itinerary Tab
            [
                'key'   => 'field_trip_tab_itinerary',
                'label' => 'برنامج الرحلة',
                'type'  => 'tab',
            ],
            [
                'key'        => 'field_trip_itinerary',
                'label'      => 'برنامج الرحلة اليومي',
                'name'       => 'trip_itinerary',
                'type'       => 'repeater',
                'layout'     => 'block',
                'button_label' => 'إضافة يوم',
                'sub_fields' => [
                    [
                        'key'   => 'field_itin_day_title',
                        'label' => 'عنوان اليوم',
                        'name'  => 'day_title',
                        'type'  => 'text',
                        'placeholder' => 'مثال: الوصول والتعرف على المدينة',
                    ],
                    [
                        'key'   => 'field_itin_day_desc',
                        'label' => 'وصف اليوم',
                        'name'  => 'day_description',
                        'type'  => 'wysiwyg',
                        'media_upload' => false,
                        'tabs'  => 'visual',
                    ],
                    [
                        'key'           => 'field_itin_day_image',
                        'label'         => 'صورة اليوم',
                        'name'          => 'day_image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'thumbnail',
                    ],
                    [
                        'key'   => 'field_itin_meals',
                        'label' => 'الوجبات المشمولة',
                        'name'  => 'meals',
                        'type'  => 'checkbox',
                        'choices' => [
                            'breakfast' => 'فطور',
                            'lunch'     => 'غداء',
                            'dinner'    => 'عشاء',
                        ],
                        'layout' => 'horizontal',
                    ],
                ],
            ],

            // Includes/Excludes Tab
            [
                'key'   => 'field_trip_tab_includes',
                'label' => 'الشمول والاستثناءات',
                'type'  => 'tab',
            ],
            [
                'key'   => 'field_trip_includes',
                'label' => 'الرحلة تشمل',
                'name'  => 'trip_includes',
                'type'  => 'repeater',
                'layout' => 'table',
                'sub_fields' => [
                    [
                        'key'   => 'field_include_item',
                        'label' => 'البند',
                        'name'  => 'item',
                        'type'  => 'text',
                    ],
                ],
            ],
            [
                'key'   => 'field_trip_excludes',
                'label' => 'الرحلة لا تشمل',
                'name'  => 'trip_excludes',
                'type'  => 'repeater',
                'layout' => 'table',
                'sub_fields' => [
                    [
                        'key'   => 'field_exclude_item',
                        'label' => 'البند',
                        'name'  => 'item',
                        'type'  => 'text',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [ 'param' => 'post_type', 'operator' => '==', 'value' => 'trip' ],
            ],
        ],
        'menu_order' => 0,
        'position'   => 'normal',
        'style'      => 'default',
    ] );

    // ─── Testimonial Fields ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_testimonial_details',
        'title'  => 'تفاصيل الشهادة',
        'fields' => [
            [
                'key'   => 'field_testimonial_name',
                'label' => 'اسم العميل',
                'name'  => 'client_name',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_testimonial_trip',
                'label' => 'الرحلة',
                'name'  => 'client_trip',
                'type'  => 'text',
            ],
            [
                'key'     => 'field_testimonial_rating',
                'label'   => 'التقييم',
                'name'    => 'rating',
                'type'    => 'number',
                'min'     => 1,
                'max'     => 5,
                'default_value' => 5,
            ],
        ],
        'location' => [
            [
                [ 'param' => 'post_type', 'operator' => '==', 'value' => 'testimonial' ],
            ],
        ],
    ] );

    // ─── Homepage Sections (Theme Options Page) ──────────────────
    if ( function_exists( 'acf_add_options_page' ) ) {
        acf_add_options_page( [
            'page_title' => 'إعدادات القالب',
            'menu_title' => 'إعدادات Jubari',
            'menu_slug'  => 'jubari-theme-options',
            'capability' => 'manage_options',
            'icon_url'   => 'dashicons-admin-customizer',
            'position'   => 2,
        ] );

        acf_add_options_sub_page( [
            'page_title'  => 'إعدادات الهيدر والفوتر',
            'menu_title'  => 'الهيدر والفوتر',
            'parent_slug' => 'jubari-theme-options',
        ] );

        acf_add_options_sub_page( [
            'page_title'  => 'إعدادات التواصل',
            'menu_title'  => 'معلومات التواصل',
            'parent_slug' => 'jubari-theme-options',
        ] );

        // Theme Options fields
        acf_add_local_field_group( [
            'key'    => 'group_theme_options',
            'title'  => 'إعدادات التواصل',
            'fields' => [
                [
                    'key'   => 'field_opt_phone',
                    'label' => 'رقم الهاتف',
                    'name'  => 'company_phone',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_opt_whatsapp',
                    'label' => 'رقم الواتساب',
                    'name'  => 'company_whatsapp',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_opt_email',
                    'label' => 'البريد الإلكتروني',
                    'name'  => 'company_email',
                    'type'  => 'email',
                ],
                [
                    'key'   => 'field_opt_address',
                    'label' => 'العنوان',
                    'name'  => 'company_address',
                    'type'  => 'textarea',
                    'rows'  => 2,
                ],
                [
                    'key'   => 'field_opt_facebook',
                    'label' => 'Facebook',
                    'name'  => 'social_facebook',
                    'type'  => 'url',
                ],
                [
                    'key'   => 'field_opt_instagram',
                    'label' => 'Instagram',
                    'name'  => 'social_instagram',
                    'type'  => 'url',
                ],
                [
                    'key'   => 'field_opt_twitter',
                    'label' => 'Twitter / X',
                    'name'  => 'social_twitter',
                    'type'  => 'url',
                ],
                [
                    'key'   => 'field_opt_youtube',
                    'label' => 'YouTube',
                    'name'  => 'social_youtube',
                    'type'  => 'url',
                ],
            ],
            'location' => [
                [
                    [ 'param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-معلومات-التواصل' ],
                ],
            ],
        ] );
    }
}
add_action( 'acf/init', 'jubari_register_acf_fields' );