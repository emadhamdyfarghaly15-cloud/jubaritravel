<?php
/**
 * CTA Banner Section
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$whatsapp        = jubari_get_option( 'company_whatsapp', jubari_get_option( 'contact_whatsapp' ) );
$whatsapp_text   = jubari_get_option( 'whatsapp_message', esc_html__( 'مرحباً، أريد الاستفسار عن الرحلات.', 'jubari-theme' ) );
$whatsapp_url    = $whatsapp ? jubari_get_whatsapp_link( $whatsapp, $whatsapp_text ) : '';
$booking_url     = home_url( '/booking/' );
$cta_title       = jubari_get_option( 'cta_banner_title', esc_html__( 'هل أنت مستعد لمغامرتك القادمة؟', 'jubari-theme' ) );
$cta_text        = jubari_get_option( 'cta_banner_text', esc_html__( 'تواصل معنا اليوم ودعنا نساعدك في تخطيط رحلة أحلامك. فريقنا المتخصص جاهز لتقديم أفضل تجربة سفر لك.', 'jubari-theme' ) );
$cta_button_text = jubari_get_option( 'cta_banner_button_text', esc_html__( 'احجز رحلتك الآن', 'jubari-theme' ) );
$cta_bg_image    = jubari_get_option( 'cta_banner_background' );
$background_url  = JUBARI_THEME_URI . '/assets/images/placeholder.jpg';

if ( is_array( $cta_bg_image ) && ! empty( $cta_bg_image['url'] ) ) {
	$background_url = $cta_bg_image['url'];
} elseif ( is_string( $cta_bg_image ) && ! empty( $cta_bg_image ) ) {
	$background_url = $cta_bg_image;
}
?>

<section class="jt-cta-banner" style="background-image: url('<?php echo esc_url( $background_url ); ?>');">
	<div class="jt-cta-banner__overlay"></div>

	<div class="jt-container">
		<div class="jt-cta-banner__content">
			<h2 class="jt-cta-banner__title"><?php echo esc_html( $cta_title ); ?></h2>

			<p class="jt-cta-banner__text">
				<?php echo esc_html( $cta_text ); ?>
			</p>

			<div class="jt-cta-banner__actions">
				<a href="<?php echo esc_url( $booking_url ); ?>" class="jt-btn jt-btn--secondary jt-btn--lg">
					<?php echo esc_html( $cta_button_text ); ?>
				</a>

				<?php if ( $whatsapp_url ) : ?>
					<a
						href="<?php echo esc_url( $whatsapp_url ); ?>"
						target="_blank"
						rel="noopener noreferrer"
						class="jt-btn jt-btn--whatsapp jt-btn--lg"
					>
						<?php esc_html_e( 'تواصل عبر واتساب', 'jubari-theme' ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>