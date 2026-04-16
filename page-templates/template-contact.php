<?php
/**
 * Template Name: Contact Page
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$phone     = function_exists( 'get_field' ) ? get_field( 'contact_phone' ) : '';
$email     = function_exists( 'get_field' ) ? get_field( 'contact_email' ) : '';
$address   = function_exists( 'get_field' ) ? get_field( 'contact_address' ) : '';
$map_embed = function_exists( 'get_field' ) ? get_field( 'contact_map_embed' ) : '';
$form_code = function_exists( 'get_field' ) ? get_field( 'contact_form_shortcode' ) : '';
?>

<main id="primary" class="site-main page-contact">
	<section class="page-hero page-hero--inner">
		<div class="container">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</section>

	<section class="contact-section section-space">
		<div class="container">
			<div class="contact-grid">
				<div class="contact-details">
					<h2><?php esc_html_e( 'تواصل معنا', 'jubari-theme' ); ?></h2>

					<?php if ( $phone ) : ?>
						<p><strong><?php esc_html_e( 'الهاتف:', 'jubari-theme' ); ?></strong> <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></p>
					<?php endif; ?>

					<?php if ( $email ) : ?>
						<p><strong><?php esc_html_e( 'البريد الإلكتروني:', 'jubari-theme' ); ?></strong> <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
					<?php endif; ?>

					<?php if ( $address ) : ?>
						<p><strong><?php esc_html_e( 'العنوان:', 'jubari-theme' ); ?></strong> <?php echo esc_html( $address ); ?></p>
					<?php endif; ?>

					<div class="contact-page-content">
						<?php
						while ( have_posts() ) :
							the_post();
							the_content();
						endwhile;
						?>
					</div>
				</div>

				<div class="contact-form-wrap">
					<?php if ( $form_code ) : ?>
						<?php echo do_shortcode( wp_kses_post( $form_code ) ); ?>
					<?php else : ?>
						<form class="jubari-contact-form" method="post" action="#">
							<p>
								<label for="jubari-name"><?php esc_html_e( 'الاسم', 'jubari-theme' ); ?></label>
								<input type="text" id="jubari-name" name="jubari_name">
							</p>

							<p>
								<label for="jubari-email"><?php esc_html_e( 'البريد الإلكتروني', 'jubari-theme' ); ?></label>
								<input type="email" id="jubari-email" name="jubari_email">
							</p>

							<p>
								<label for="jubari-message"><?php esc_html_e( 'رسالتك', 'jubari-theme' ); ?></label>
								<textarea id="jubari-message" name="jubari_message" rows="6"></textarea>
							</p>

							<p>
								<button type="submit"><?php esc_html_e( 'إرسال', 'jubari-theme' ); ?></button>
							</p>
						</form>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php if ( $map_embed ) : ?>
		<section class="contact-map">
			<div class="container">
				<div class="contact-map__embed">
					<?php echo $map_embed; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
</main>

<?php
get_footer();