<?php
/**
 * Mobile menu
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="mobile-menu" id="mobile-menu" hidden>
	<button class="mobile-menu__close" type="button" aria-controls="mobile-menu" aria-expanded="false">
		<?php esc_html_e( 'إغلاق', 'jubari-theme' ); ?>
	</button>

	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'menu_id'        => 'mobile-primary-menu',
			'container'      => false,
			'fallback_cb'    => false,
		)
	);
	?>
</div>