<?php
/**
 * Jubari Theme functions and definitions
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme constants.
 */
if ( ! defined( 'JUBARI_THEME_VERSION' ) ) {
	define( 'JUBARI_THEME_VERSION', '1.0.0' );
}

if ( ! defined( 'JUBARI_THEME_DIR' ) ) {
	define( 'JUBARI_THEME_DIR', get_template_directory() );
}

if ( ! defined( 'JUBARI_THEME_URI' ) ) {
	define( 'JUBARI_THEME_URI', get_template_directory_uri() );
}

/**
 * Load required theme files.
 */
$jubari_required_files = array(
	'/inc/helpers.php',
	'/inc/theme-setup.php',
	'/inc/enqueue.php',
	'/inc/template-tags.php',
	'/inc/hooks.php',
	'/inc/custom-post-types.php',
	'/inc/taxonomies.php',
	'/inc/customizer.php',
);

foreach ( $jubari_required_files as $jubari_file ) {
	$jubari_path = JUBARI_THEME_DIR . $jubari_file;

	if ( file_exists( $jubari_path ) ) {
		require_once $jubari_path;
	}
}

/**
 * Load optional theme files.
 */
$jubari_optional_files = array(
	'/inc/acf-fields.php',
	'/inc/widgets/class-widget-destinations.php',
	'/inc/widgets/class-widget-recent-trips.php',
	'/inc/walker/class-walker-nav-primary.php',
);

foreach ( $jubari_optional_files as $jubari_file ) {
	$jubari_path = JUBARI_THEME_DIR . $jubari_file;

	if ( file_exists( $jubari_path ) ) {
		require_once $jubari_path;
	}
}