<?php
/**
 * Newsletter Section
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$newsletter_title       = jubari_get_option( 'newsletter_title', esc_html__( 'اشترك في نشرتنا الإخبارية', 'jubari-theme' ) );
$newsletter_text        = jubari_get_option( 'newsletter_text', esc_html__( 'احصل على أحدث العروض والوجهات مباشرة في بريدك الإلكتروني', 'jubari-theme' ) );
$newsletter_placeholder = jubari_get_option( 'newsletter_placeholder', esc_html__( 'أدخل بريدك الإلكتروني', 'jubari-theme' ) );
$newsletter_button_text = jubari_get_option( 'newsletter_button_text', esc_html__( 'اشترك الآن', 'jubari-theme' ) );
$newsletter_shortcode   = jubari_get_option( 'newsletter_form_shortcode' );
?>

<section class="jt-newsletter">
	<div class="jt-container">
		<div class="jt-newsletter__inner">
			<div class="jt-newsletter__text">
				<h3><?php echo esc_html( $newsletter_title ); ?></h3>
				<p><?php echo esc_html( $newsletter_text ); ?></p>
			</div>

			<div class="jt-newsletter__form-wrap">
				<?php if ( $newsletter_shortcode ) : ?>
					<?php echo do_shortcode( wp_kses_post( $newsletter_shortcode ) ); ?>
				<?php else : ?>
					<form class="jt-newsletter__form" action="#" method="post">
						<label class="screen-reader-text" for="jt-newsletter-email">
							<?php esc_html_e( 'البريد الإلكتروني', 'jubari-theme' ); ?>
						</label>

						<input
							type="email"
							id="jt-newsletter-email"
							name="newsletter_email"
							class="jt-newsletter__input"
							placeholder="<?php echo esc_attr( $newsletter_placeholder ); ?>"
							required
						>

						<button type="submit" class="jt-btn jt-btn--secondary">
							<?php echo esc_html( $newsletter_button_text ); ?>
						</button>
					</form>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>