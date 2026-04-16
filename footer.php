<?php
/**
 * Theme Footer
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$whatsapp_number  = jubari_get_option( 'company_whatsapp', jubari_get_option( 'contact_whatsapp' ) );
$whatsapp_message = jubari_get_option( 'whatsapp_message', esc_html__( 'مرحباً، أريد الاستفسار عن الرحلات.', 'jubari-theme' ) );
$whatsapp_url     = $whatsapp_number ? jubari_get_whatsapp_link( $whatsapp_number, $whatsapp_message ) : '';
?>

</main><!-- #main-content -->

<footer class="jt-footer" role="contentinfo">
	<div class="jt-footer__widgets">
		<div class="jt-container">
			<div class="jt-grid jt-grid--4">
				<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
					<div class="jt-footer__col">
						<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
							<?php dynamic_sidebar( 'footer-' . $i ); ?>
						<?php endif; ?>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	</div>

	<div class="jt-footer__bottom">
		<div class="jt-container">
			<div class="jt-footer__bottom-inner">
				<p class="jt-footer__copyright">
					&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
					<?php bloginfo( 'name' ); ?>.
					<?php esc_html_e( 'جميع الحقوق محفوظة.', 'jubari-theme' ); ?>
				</p>

				<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<nav class="jt-footer__menu" aria-label="<?php esc_attr_e( 'قائمة الفوتر', 'jubari-theme' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'menu_class'     => 'jt-footer__nav',
								'container'      => false,
								'depth'          => 1,
								'fallback_cb'    => false,
							)
						);
						?>
					</nav>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer>

<?php if ( $whatsapp_url ) : ?>
	<a
		href="<?php echo esc_url( $whatsapp_url ); ?>"
		class="jt-whatsapp-float"
		target="_blank"
		rel="noopener noreferrer"
		aria-label="<?php esc_attr_e( 'تواصل معنا عبر واتساب', 'jubari-theme' ); ?>"
	>
		<img
			src="<?php echo esc_url( JUBARI_THEME_URI . '/assets/images/icons/whatsapp.svg' ); ?>"
			alt="<?php esc_attr_e( 'واتساب', 'jubari-theme' ); ?>"
			width="28"
			height="28"
		>
	</a>
<?php endif; ?>

<button
	class="jt-back-to-top"
	id="back-to-top"
	type="button"
	aria-label="<?php esc_attr_e( 'العودة للأعلى', 'jubari-theme' ); ?>"
>
	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false">
		<polyline points="18 15 12 9 6 15"></polyline>
	</svg>
</button>

<?php wp_footer(); ?>
</body>
</html>