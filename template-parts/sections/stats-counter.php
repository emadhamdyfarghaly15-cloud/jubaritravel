<?php
/**
 * Stats Counter Section
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$dest_count = wp_count_posts( 'destination' );
$trip_count = wp_count_posts( 'trip' );

$destinations_total = isset( $dest_count->publish ) ? absint( $dest_count->publish ) : 0;
$trips_total        = isset( $trip_count->publish ) ? absint( $trip_count->publish ) : 0;

// Optional ACF option overrides.
$happy_clients    = jubari_get_option( 'stats_happy_clients', 1500 );
$positive_reviews = jubari_get_option( 'stats_positive_reviews', 4800 );

$happy_clients    = absint( $happy_clients );
$positive_reviews = absint( $positive_reviews );

if ( 0 === $happy_clients ) {
	$happy_clients = 1500;
}

if ( 0 === $positive_reviews ) {
	$positive_reviews = 4800;
}
?>

<section class="jt-stats">
	<div class="jt-container">
		<div class="jt-stats__grid">
			<div class="jt-stats__item">
				<div class="jt-stats__icon">
					<?php echo jubari_get_icon( 'location', 40 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>

				<div class="jt-stats__number" data-counter="<?php echo esc_attr( $destinations_total ); ?>">
					0
				</div>

				<div class="jt-stats__label"><?php esc_html_e( 'وجهة سياحية', 'jubari-theme' ); ?></div>
			</div>

			<div class="jt-stats__item">
				<div class="jt-stats__icon">
					<?php echo jubari_get_icon( 'calendar', 40 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>

				<div class="jt-stats__number" data-counter="<?php echo esc_attr( $trips_total ); ?>">
					0
				</div>

				<div class="jt-stats__label"><?php esc_html_e( 'رحلة متاحة', 'jubari-theme' ); ?></div>
			</div>

			<div class="jt-stats__item">
				<div class="jt-stats__icon">
					<?php echo jubari_get_icon( 'users', 40 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>

				<div class="jt-stats__number" data-counter="<?php echo esc_attr( $happy_clients ); ?>">
					0
				</div>

				<div class="jt-stats__label"><?php esc_html_e( 'عميل سعيد', 'jubari-theme' ); ?></div>
			</div>

			<div class="jt-stats__item">
				<div class="jt-stats__icon">
					<?php echo jubari_get_icon( 'star', 40 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>

				<div class="jt-stats__number" data-counter="<?php echo esc_attr( $positive_reviews ); ?>">
					0
				</div>

				<div class="jt-stats__label"><?php esc_html_e( 'تقييم إيجابي', 'jubari-theme' ); ?></div>
			</div>
		</div>
	</div>
</section>