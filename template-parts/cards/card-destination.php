<?php
/**
 * Destination Card Component
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id    = get_the_ID();
$trip_count = function_exists( 'get_field' ) ? get_field( 'destination_trip_count', $post_id ) : 0;
$trip_count = absint( $trip_count );
$regions    = get_the_terms( $post_id, 'destination_region' );
$image_url  = jubari_get_post_thumbnail_url_fallback( $post_id, 'jubari-card' );
$excerpt    = get_the_excerpt();
?>

<article class="jt-card jt-card--destination" itemscope itemtype="https://schema.org/TouristDestination">
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

			<?php if ( $regions && ! is_wp_error( $regions ) && ! empty( $regions[0] ) ) : ?>
				<span class="jt-card__badge"><?php echo esc_html( $regions[0]->name ); ?></span>
			<?php endif; ?>
		</div>

		<div class="jt-card__body">
			<h3 class="jt-card__title" itemprop="name"><?php echo esc_html( get_the_title( $post_id ) ); ?></h3>

			<?php if ( $excerpt ) : ?>
				<p class="jt-card__excerpt" itemprop="description">
					<?php echo esc_html( wp_trim_words( wp_strip_all_tags( $excerpt ), 15, '...' ) ); ?>
				</p>
			<?php endif; ?>

			<div class="jt-card__meta">
				<?php if ( $trip_count > 0 ) : ?>
					<span class="jt-card__trip-count">
						<?php echo jubari_get_icon( 'location', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php
						printf(
							esc_html( _n( '%s رحلة', '%s رحلات', $trip_count, 'jubari-theme' ) ),
							esc_html( number_format_i18n( $trip_count ) )
						);
						?>
					</span>
				<?php endif; ?>

				<span class="jt-card__arrow" aria-hidden="true">
					<?php esc_html_e( 'اكتشف المزيد', 'jubari-theme' ); ?> &larr;
				</span>
			</div>
		</div>
	</a>
</article>