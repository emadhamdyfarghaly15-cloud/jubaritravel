<?php
/**
 * Template Name: Booking Page
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main page-booking">
	<section class="page-hero page-hero--inner">
		<div class="container">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</section>

	<section class="booking-section section-space">
		<div class="container">
			<div class="booking-layout">
				<div class="booking-content">
					<?php
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
					?>
				</div>

				<div class="booking-form-wrap">
					<form class="jubari-booking-form" method="post" action="#">
						<div class="form-row">
							<label for="booking-name"><?php esc_html_e( 'الاسم الكامل', 'jubari-theme' ); ?></label>
							<input type="text" id="booking-name" name="booking_name" required>
						</div>

						<div class="form-row">
							<label for="booking-phone"><?php esc_html_e( 'رقم الهاتف', 'jubari-theme' ); ?></label>
							<input type="text" id="booking-phone" name="booking_phone" required>
						</div>

						<div class="form-row">
							<label for="booking-email"><?php esc_html_e( 'البريد الإلكتروني', 'jubari-theme' ); ?></label>
							<input type="email" id="booking-email" name="booking_email">
						</div>

						<div class="form-row">
							<label for="booking-destination"><?php esc_html_e( 'الوجهة', 'jubari-theme' ); ?></label>
							<input type="text" id="booking-destination" name="booking_destination">
						</div>

						<div class="form-row">
							<label for="booking-date"><?php esc_html_e( 'تاريخ السفر', 'jubari-theme' ); ?></label>
							<input type="date" id="booking-date" name="booking_date">
						</div>

						<div class="form-row">
							<label for="booking-notes"><?php esc_html_e( 'ملاحظات', 'jubari-theme' ); ?></label>
							<textarea id="booking-notes" name="booking_notes" rows="5"></textarea>
						</div>

						<div class="form-row">
							<button type="submit"><?php esc_html_e( 'إرسال الطلب', 'jubari-theme' ); ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();