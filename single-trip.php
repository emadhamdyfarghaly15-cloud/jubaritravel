<?php
/**
 * Single Trip template
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$post_id   = get_the_ID();
	$price     = function_exists( 'get_field' ) ? get_field( 'trip_price', $post_id ) : '';
	$duration  = function_exists( 'get_field' ) ? get_field( 'trip_duration', $post_id ) : '';
	$location  = function_exists( 'get_field' ) ? get_field( 'trip_location', $post_id ) : '';
	$currency  = function_exists( 'get_field' ) ? get_field( 'trip_currency', $post_id ) : 'USD';
	$hero_image = jubari_get_post_thumbnail_url_fallback( $post_id, 'jubari-hero' );

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
	?>

	<section class="trip-hero section-space-sm" style="background-image: url('<?php echo esc_url( $hero_image ); ?>');">
		<div class="trip-hero__overlay"></div>

		<div class="container">
			<div class="trip-hero__content">
				<?php jubari_breadcrumbs(); ?>

				<h1 class="trip-title"><?php the_title(); ?></h1>

				<div class="trip-meta">
					<?php if ( $location ) : ?>
						<span class="trip-meta__item">
							<?php echo jubari_get_icon( 'location', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php echo esc_html( $location ); ?>
						</span>
					<?php endif; ?>

					<?php if ( $duration ) : ?>
						<span class="trip-meta__item">
							<?php echo jubari_get_icon( 'calendar', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php
							printf(
								esc_html( _n( '%s يوم', '%s أيام', (int) $duration, 'jubari-theme' ) ),
								esc_html( number_format_i18n( $duration ) )
							);
							?>
						</span>
					<?php endif; ?>

					<?php if ( '' !== $price && null !== $price ) : ?>
						<span class="trip-meta__item">
							<?php echo jubari_get_icon( 'star', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php echo esc_html( is_numeric( $price ) ? $display_currency . number_format_i18n( $price ) : $price ); ?>
						</span>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/trip/gallery' ); ?>

	<section class="single-trip-content section-space">
		<div class="container">
			<div class="single-trip-layout">
				<div class="single-trip-main">
					<div class="entry-content">
						<?php the_content(); ?>
					</div>

					<?php get_template_part( 'template-parts/trip/itinerary' ); ?>
					<?php get_template_part( 'template-parts/trip/pricing', 'table' ); ?>
				</div>

				<aside class="single-trip-sidebar">
					<?php get_template_part( 'template-parts/trip/booking', 'sidebar' ); ?>
				</aside>
			</div>
		</div>
	</section>

<?php endwhile; ?>

<?php
get_footer();