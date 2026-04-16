<?php
/**
 * Trip Card Component
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id    = get_the_ID();
$price      = function_exists( 'get_field' ) ? get_field( 'trip_price', $post_id ) : '';
$sale_price = function_exists( 'get_field' ) ? get_field( 'trip_sale_price', $post_id ) : '';
$duration   = function_exists( 'get_field' ) ? get_field( 'trip_duration', $post_id ) : '';
$difficulty = function_exists( 'get_field' ) ? get_field( 'trip_difficulty', $post_id ) : '';
$group_size = function_exists( 'get_field' ) ? get_field( 'trip_group_size', $post_id ) : '';
$currency   = function_exists( 'get_field' ) ? get_field( 'trip_currency', $post_id ) : 'USD';
$trip_types = get_the_terms( $post_id, 'trip_type' );
$image_url  = jubari_get_post_thumbnail_url_fallback( $post_id, 'jubari-card' );
$excerpt    = get_the_excerpt();

$difficulty_labels = array(
	'easy'     => esc_html__( 'سهل', 'jubari-theme' ),
	'moderate' => esc_html__( 'متوسط', 'jubari-theme' ),
	'hard'     => esc_html__( 'صعب', 'jubari-theme' ),
);

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

$has_sale = false;
if ( '' !== $price && '' !== $sale_price && is_numeric( $price ) && is_numeric( $sale_price ) ) {
	$has_sale = (float) $sale_price < (float) $price;
}
?>

<article class="jt-card jt-card--trip" itemscope itemtype="https://schema.org/TouristTrip">
	<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="jt-card__link" itemprop="url">
		<div class="jt-card__image-wrap">
			<img
				src="<?php echo esc_url( $image_url ); ?>"
				alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"
				class="jt-card__image"
				loading="lazy"
				itemprop="image"
			>

			<div class="jt-card__overlay"></div>

			<?php if ( $has_sale ) : ?>
				<span class="jt-card__badge jt-card__badge--sale">
					<?php esc_html_e( 'عرض', 'jubari-theme' ); ?>
				</span>
			<?php endif; ?>

			<?php if ( $duration ) : ?>
				<span class="jt-card__duration">
					<?php echo jubari_get_icon( 'calendar', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php
					printf(
						esc_html( _n( '%s يوم', '%s أيام', (int) $duration, 'jubari-theme' ) ),
						esc_html( number_format_i18n( $duration ) )
					);
					?>
				</span>
			<?php endif; ?>
		</div>

		<div class="jt-card__body">
			<?php if ( $trip_types && ! is_wp_error( $trip_types ) && ! empty( $trip_types[0] ) ) : ?>
				<span class="jt-card__category"><?php echo esc_html( $trip_types[0]->name ); ?></span>
			<?php endif; ?>

			<h3 class="jt-card__title" itemprop="name"><?php echo esc_html( get_the_title( $post_id ) ); ?></h3>

			<?php if ( $excerpt ) : ?>
				<p class="jt-card__excerpt" itemprop="description">
					<?php echo esc_html( wp_trim_words( wp_strip_all_tags( $excerpt ), 12, '...' ) ); ?>
				</p>
			<?php endif; ?>

			<div class="jt-card__details">
				<?php if ( $group_size ) : ?>
					<span class="jt-card__detail-item">
						<?php echo jubari_get_icon( 'users', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php echo esc_html( $group_size ); ?>
					</span>
				<?php endif; ?>

				<?php if ( $difficulty ) : ?>
					<span class="jt-card__detail-item jt-card__detail-item--<?php echo esc_attr( sanitize_html_class( $difficulty ) ); ?>">
						<?php echo esc_html( isset( $difficulty_labels[ $difficulty ] ) ? $difficulty_labels[ $difficulty ] : $difficulty ); ?>
					</span>
				<?php endif; ?>
			</div>

			<div class="jt-card__footer">
				<div class="jt-card__price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
					<?php if ( $has_sale ) : ?>
						<span class="jt-card__price-old">
							<del><?php echo esc_html( $display_currency . number_format_i18n( $price ) ); ?></del>
						</span>

						<span class="jt-card__price-current" itemprop="price" content="<?php echo esc_attr( $sale_price ); ?>">
							<?php echo esc_html( $display_currency . number_format_i18n( $sale_price ) ); ?>
						</span>
					<?php elseif ( '' !== $price && null !== $price ) : ?>
						<span class="jt-card__price-current" itemprop="price" content="<?php echo esc_attr( $price ); ?>">
							<?php echo esc_html( is_numeric( $price ) ? $display_currency . number_format_i18n( $price ) : $price ); ?>
						</span>
					<?php endif; ?>

					<meta itemprop="priceCurrency" content="<?php echo esc_attr( $currency ? $currency : 'USD' ); ?>">
					<span class="jt-card__price-label"><?php esc_html_e( 'للشخص', 'jubari-theme' ); ?></span>
				</div>

				<span class="jt-card__cta">
					<?php esc_html_e( 'التفاصيل', 'jubari-theme' ); ?>
					<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false">
						<polyline points="10 6 4 12 10 18"></polyline>
					</svg>
				</span>
			</div>
		</div>
	</a>
</article>