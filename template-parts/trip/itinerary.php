<?php
/**
 * Trip Itinerary (Day-by-Day Accordion)
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id    = get_the_ID();
$itinerary  = function_exists( 'get_field' ) ? get_field( 'trip_itinerary', $post_id ) : array();

if ( empty( $itinerary ) || ! is_array( $itinerary ) ) {
	return;
}
?>

<div class="jt-itinerary" id="trip-itinerary">
	<h2 class="jt-itinerary__heading">
		<?php echo jubari_get_icon( 'location', 24 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php esc_html_e( 'برنامج الرحلة اليومي', 'jubari-theme' ); ?>
	</h2>

	<div class="jt-itinerary__timeline">
		<?php foreach ( $itinerary as $index => $day ) : ?>
			<?php
			$day_num         = $index + 1;
			$is_first        = 0 === $index;
			$day_title       = ! empty( $day['day_title'] ) ? $day['day_title'] : sprintf( __( 'اليوم %s', 'jubari-theme' ), $day_num );
			$day_description = ! empty( $day['day_description'] ) ? $day['day_description'] : '';
			$day_image       = ! empty( $day['day_image'] ) && is_array( $day['day_image'] ) ? $day['day_image'] : array();
			$meals           = ! empty( $day['meals'] ) && is_array( $day['meals'] ) ? $day['meals'] : array();
			$content_id      = 'itinerary-day-content-' . $day_num;
			$button_id       = 'itinerary-day-button-' . $day_num;

			$meal_labels = array(
				'breakfast' => esc_html__( 'فطور', 'jubari-theme' ),
				'lunch'     => esc_html__( 'غداء', 'jubari-theme' ),
				'dinner'    => esc_html__( 'عشاء', 'jubari-theme' ),
			);

			$image_url = '';
			$image_alt = '';

			if ( ! empty( $day_image['sizes']['jubari-card'] ) ) {
				$image_url = $day_image['sizes']['jubari-card'];
			} elseif ( ! empty( $day_image['url'] ) ) {
				$image_url = $day_image['url'];
			}

			if ( ! empty( $day_image['alt'] ) ) {
				$image_alt = $day_image['alt'];
			} else {
				$image_alt = $day_title;
			}
			?>

			<div class="jt-itinerary__day <?php echo $is_first ? 'is-open' : ''; ?>" data-day="<?php echo esc_attr( $day_num ); ?>">
				<div class="jt-itinerary__day-marker">
					<span class="jt-itinerary__day-number"><?php echo esc_html( $day_num ); ?></span>
				</div>

				<button
					class="jt-itinerary__day-header"
					id="<?php echo esc_attr( $button_id ); ?>"
					type="button"
					aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
					aria-controls="<?php echo esc_attr( $content_id ); ?>"
				>
					<div class="jt-itinerary__day-header-text">
						<span class="jt-itinerary__day-label">
							<?php printf( esc_html__( 'اليوم %s', 'jubari-theme' ), esc_html( $day_num ) ); ?>
						</span>

						<span class="jt-itinerary__day-title">
							<?php echo esc_html( $day_title ); ?>
						</span>
					</div>

					<?php if ( ! empty( $meals ) ) : ?>
						<div class="jt-itinerary__meals">
							<?php foreach ( $meals as $meal ) : ?>
								<?php $meal_label = isset( $meal_labels[ $meal ] ) ? $meal_labels[ $meal ] : $meal; ?>
								<span class="jt-itinerary__meal-badge" title="<?php echo esc_attr( $meal_label ); ?>">
									<?php echo esc_html( $meal_label ); ?>
								</span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<span class="jt-itinerary__toggle-icon" aria-hidden="true">
						<svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" focusable="false">
							<polyline points="6 9 12 15 18 9"></polyline>
						</svg>
					</span>
				</button>

				<div
					class="jt-itinerary__day-content"
					id="<?php echo esc_attr( $content_id ); ?>"
					role="region"
					aria-labelledby="<?php echo esc_attr( $button_id ); ?>"
					<?php echo ! $is_first ? 'hidden' : ''; ?>
				>
					<div class="jt-itinerary__day-body">
						<?php if ( $image_url ) : ?>
							<div class="jt-itinerary__day-image">
								<img
									src="<?php echo esc_url( $image_url ); ?>"
									alt="<?php echo esc_attr( $image_alt ); ?>"
									loading="lazy"
								>
							</div>
						<?php endif; ?>

						<?php if ( $day_description ) : ?>
							<div class="jt-itinerary__day-description jt-prose">
								<?php echo wp_kses_post( $day_description ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>