<?php
/**
 * Trip booking sidebar
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id    = get_the_ID();
$price      = function_exists( 'get_field' ) ? get_field( 'trip_price', $post_id ) : '';
$duration   = function_exists( 'get_field' ) ? get_field( 'trip_duration', $post_id ) : '';
$start_date = function_exists( 'get_field' ) ? get_field( 'trip_start_date', $post_id ) : '';
$currency   = function_exists( 'get_field' ) ? get_field( 'trip_currency', $post_id ) : 'USD';

$display_currency = '$';
if ( 'EUR' === $currency ) {
	$display_currency = '€';
} elseif ( 'GBP' === $currency ) {
	$display_currency = '£';
} elseif ( 'SAR' === $currency ) {
	$display_currency = 'ر.س';
} elseif ( 'AED' === $currency ) {
	$display_currency = 'د.إ';
}

$booking_url = home_url( '/booking/' );
?>

<div class="trip-booking-sidebar">
	<div class="trip-booking-card">
		<h3><?php esc_html_e( 'احجز هذه الرحلة', 'jubari-theme' ); ?></h3>

		<ul class="trip-booking-meta">
			<?php if ( '' !== $price && null !== $price ) : ?>
				<li>
					<strong><?php esc_html_e( 'السعر:', 'jubari-theme' ); ?></strong>
					<?php echo esc_html( is_numeric( $price ) ? $display_currency . number_format_i18n( $price ) : $price ); ?>
				</li>
			<?php endif; ?>

			<?php if ( $duration ) : ?>
				<li>
					<strong><?php esc_html_e( 'المدة:', 'jubari-theme' ); ?></strong>
					<?php
					printf(
						esc_html( _n( '%s يوم', '%s أيام', (int) $duration, 'jubari-theme' ) ),
						esc_html( number_format_i18n( $duration ) )
					);
					?>
				</li>
			<?php endif; ?>

			<?php if ( $start_date ) : ?>
				<li>
					<strong><?php esc_html_e( 'تاريخ الانطلاق:', 'jubari-theme' ); ?></strong>
					<?php echo esc_html( $start_date ); ?>
				</li>
			<?php endif; ?>
		</ul>

		<a class="jt-btn jt-btn--primary jt-btn--block" href="<?php echo esc_url( $booking_url ); ?>">
			<?php esc_html_e( 'ابدأ الحجز', 'jubari-theme' ); ?>
		</a>
	</div>
</div>