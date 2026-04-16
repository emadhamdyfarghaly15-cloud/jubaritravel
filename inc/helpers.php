<?php
/**
 * Helper / Utility Functions
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get theme option from ACF options page with fallback.
 *
 * @param string $field_name Field name.
 * @param mixed  $default    Default value.
 * @return mixed
 */
function jubari_get_option( $field_name, $default = '' ) {
	if ( empty( $field_name ) ) {
		return $default;
	}

	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $field_name, 'option' );

		if ( null !== $value && '' !== $value && false !== $value ) {
			return $value;
		}
	}

	return $default;
}

/**
 * Check if ACF is available.
 *
 * @return bool
 */
function jubari_has_acf() {
	return function_exists( 'get_field' );
}

/**
 * Truncate text with multibyte support and Arabic-friendly word boundary.
 *
 * @param string $text   Text to truncate.
 * @param int    $length Character length.
 * @param string $append Ending string.
 * @return string
 */
function jubari_truncate( $text, $length = 100, $append = '...' ) {
	$text   = wp_strip_all_tags( (string) $text );
	$length = absint( $length );

	if ( 0 === $length ) {
		return '';
	}

	if ( mb_strlen( $text ) <= $length ) {
		return $text;
	}

	$text       = mb_substr( $text, 0, $length );
	$last_space = mb_strrpos( $text, ' ' );

	if ( false !== $last_space ) {
		$text = mb_substr( $text, 0, $last_space );
	}

	return trim( $text ) . $append;
}

/**
 * Return sprite icon markup.
 *
 * @param string $name Icon symbol ID without prefix.
 * @param int    $size Width/height.
 * @param string $class Optional additional class.
 * @return string
 */
function jubari_get_icon( $name, $size = 24, $class = '' ) {
	$name = sanitize_html_class( $name );
	$size = absint( $size );

	if ( empty( $name ) ) {
		return '';
	}

	if ( 0 === $size ) {
		$size = 24;
	}

	$classes = trim( 'jt-icon ' . $class );

	return sprintf(
		'<svg class="%1$s" width="%2$d" height="%2$d" aria-hidden="true" focusable="false"><use href="%3$s/assets/images/icons/sprite.svg#icon-%4$s" xlink:href="%3$s/assets/images/icons/sprite.svg#icon-%4$s"></use></svg>',
		esc_attr( $classes ),
		$size,
		esc_url( JUBARI_THEME_URI ),
		esc_attr( $name )
	);
}

/**
 * Echo sprite icon markup.
 *
 * @param string $name  Icon symbol ID without prefix.
 * @param int    $size  Width/height.
 * @param string $class Optional additional class.
 * @return void
 */
function jubari_icon( $name, $size = 24, $class = '' ) {
	echo jubari_get_icon( $name, $size, $class ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Get image URL with placeholder fallback.
 *
 * @param int    $post_id Post ID.
 * @param string $size    Image size.
 * @return string
 */
function jubari_get_post_thumbnail_url_fallback( $post_id = 0, $size = 'full' ) {
	$post_id = $post_id ? absint( $post_id ) : get_the_ID();

	if ( has_post_thumbnail( $post_id ) ) {
		$image_url = get_the_post_thumbnail_url( $post_id, $size );

		if ( $image_url ) {
			return $image_url;
		}
	}

	return esc_url( JUBARI_THEME_URI . '/assets/images/placeholder.jpg' );
}

/**
 * Get post excerpt with fallback to trimmed content.
 *
 * @param int $post_id Post ID.
 * @param int $length  Excerpt length.
 * @return string
 */
function jubari_get_excerpt( $post_id = 0, $length = 20 ) {
	$post_id = $post_id ? absint( $post_id ) : get_the_ID();
	$post    = get_post( $post_id );

	if ( ! $post ) {
		return '';
	}

	if ( has_excerpt( $post_id ) ) {
		return wp_strip_all_tags( get_the_excerpt( $post_id ) );
	}

	return wp_trim_words( wp_strip_all_tags( $post->post_content ), $length, '...' );
}

/**
 * Get sanitized phone number link.
 *
 * @param string $phone Phone number.
 * @return string
 */
function jubari_get_phone_link( $phone ) {
	$phone = (string) $phone;
	$phone = preg_replace( '/[^0-9\+]/', '', $phone );

	return $phone ? 'tel:' . $phone : '';
}

/**
 * Get WhatsApp link from phone number.
 *
 * @param string $phone   Phone number.
 * @param string $message Optional prefilled message.
 * @return string
 */
function jubari_get_whatsapp_link( $phone, $message = '' ) {
	$phone = preg_replace( '/[^0-9]/', '', (string) $phone );

	if ( empty( $phone ) ) {
		return '';
	}

	$url = 'https://wa.me/' . $phone;

	if ( '' !== $message ) {
		$url .= '?text=' . rawurlencode( $message );
	}

	return esc_url( $url );
}

/**
 * Check whether current language direction is RTL.
 *
 * @return bool
 */
function jubari_is_rtl_language() {
	return is_rtl();
}