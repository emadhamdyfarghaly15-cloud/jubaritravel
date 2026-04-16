<?php
/**
 * Footer bottom
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="site-footer-bottom">
	<div class="container">
		<p>
			&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
			<?php bloginfo( 'name' ); ?>
			<?php esc_html_e( '. جميع الحقوق محفوظة.', 'jubari-theme' ); ?>
		</p>
	</div>
</div>