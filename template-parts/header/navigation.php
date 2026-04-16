<?php
/**
 * Primary navigation
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'jubari-theme' ); ?>">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'menu_id'        => 'primary-menu',
			'container'      => false,
			'fallback_cb'    => false,
			'depth'          => 2,
			'walker'         => class_exists( 'Jubari_Walker_Nav_Primary' ) ? new Jubari_Walker_Nav_Primary() : null,
		)
	);
	?>
</nav>