<?php
/**
 * Theme Customizer
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function jubari_customize_register( $wp_customize ) {

	$wp_customize->add_setting(
		'jubari_primary_color',
		array(
			'default'           => '#1B5E3B',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jubari_primary_color',
			array(
				'label'   => esc_html__( 'اللون الرئيسي', 'jubari-theme' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'jubari_secondary_color',
		array(
			'default'           => '#D4A843',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'jubari_secondary_color',
			array(
				'label'   => esc_html__( 'اللون الثانوي', 'jubari-theme' ),
				'section' => 'colors',
			)
		)
	);
}
add_action( 'customize_register', 'jubari_customize_register' );

/**
 * Output customizer CSS variables.
 *
 * @return void
 */
function jubari_customizer_css() {
	$primary   = get_theme_mod( 'jubari_primary_color', '#1B5E3B' );
	$secondary = get_theme_mod( 'jubari_secondary_color', '#D4A843' );

	if ( '#1B5E3B' === $primary && '#D4A843' === $secondary ) {
		return;
	}

	$css = ':root{';

	if ( $primary && '#1B5E3B' !== $primary ) {
		$css .= '--jt-primary:' . sanitize_hex_color( $primary ) . ';';
	}

	if ( $secondary && '#D4A843' !== $secondary ) {
		$css .= '--jt-secondary:' . sanitize_hex_color( $secondary ) . ';';
	}

	$css .= '}';

	wp_add_inline_style( 'jubari-style', $css );
}
add_action( 'wp_enqueue_scripts', 'jubari_customizer_css', 20 );