<?php
/**
 * Homepage Hero Slider
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$trip_archive_url = get_post_type_archive_link( 'trip' );
if ( ! $trip_archive_url ) {
	$trip_archive_url = home_url( '/' );
}

$hero_destinations = new WP_Query(
	array(
		'post_type'      => 'destination',
		'posts_per_page' => 5,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => true,
	)
);
?>

<?php if ( $hero_destinations->have_posts() ) : ?>
	<section class="jt-hero" aria-label="<?php esc_attr_e( 'عرض الوجهات المميزة', 'jubari-theme' ); ?>">
		<div class="swiper jt-hero__slider" dir="<?php echo esc_attr( is_rtl() ? 'rtl' : 'ltr' ); ?>">
			<div class="swiper-wrapper">
				<?php while ( $hero_destinations->have_posts() ) : ?>
					<?php $hero_destinations->the_post(); ?>

					<?php
					$background_url = jubari_get_post_thumbnail_url_fallback( get_the_ID(), 'jubari-hero' );
					?>

					<div class="swiper-slide jt-hero__slide">
						<div
							class="jt-hero__slide-bg"
							style="background-image: url('<?php echo esc_url( $background_url ); ?>');"
							role="img"
							aria-label="<?php echo esc_attr( get_the_title() ); ?>"
						></div>

						<div class="jt-hero__slide-overlay"></div>

						<div class="jt-container">
							<div class="jt-hero__slide-content">
								<span class="jt-hero__slide-subtitle" data-swiper-parallax="-100">
									<?php esc_html_e( 'اكتشف', 'jubari-theme' ); ?>
								</span>

								<h2 class="jt-hero__slide-title" data-swiper-parallax="-200">
									<?php the_title(); ?>
								</h2>

								<?php
								$excerpt = get_the_excerpt();
								if ( $excerpt ) :
									?>
									<p class="jt-hero__slide-desc" data-swiper-parallax="-300">
										<?php echo esc_html( wp_trim_words( wp_strip_all_tags( $excerpt ), 20, '...' ) ); ?>
									</p>
								<?php endif; ?>

								<div class="jt-hero__slide-actions" data-swiper-parallax="-400">
									<a href="<?php echo esc_url( get_permalink() ); ?>" class="jt-btn jt-btn--primary">
										<?php esc_html_e( 'اكتشف الوجهة', 'jubari-theme' ); ?>
									</a>

									<a href="<?php echo esc_url( $trip_archive_url ); ?>" class="jt-btn jt-btn--outline jt-btn--light">
										<?php esc_html_e( 'تصفح الرحلات', 'jubari-theme' ); ?>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>

			<div class="jt-hero__controls">
				<div class="swiper-button-next jt-hero__arrow" aria-hidden="true"></div>
				<div class="swiper-button-prev jt-hero__arrow" aria-hidden="true"></div>
			</div>

			<div class="swiper-pagination jt-hero__pagination"></div>
		</div>
	</section>

	<?php wp_reset_postdata(); ?>
<?php else : ?>
	<section class="jt-hero jt-hero--placeholder">
		<div class="jt-container">
			<div class="jt-hero__slide-content" style="padding-block: 6rem; text-align: center; max-width: 100%;">
				<span class="jt-hero__slide-subtitle"><?php esc_html_e( 'مرحباً بكم', 'jubari-theme' ); ?></span>

				<h1 class="jt-hero__slide-title" style="font-size: 3rem;">
					<?php bloginfo( 'name' ); ?>
				</h1>

				<?php if ( get_bloginfo( 'description' ) ) : ?>
					<p class="jt-hero__slide-desc" style="margin-inline: auto;">
						<?php bloginfo( 'description' ); ?>
					</p>
				<?php endif; ?>

				<div class="jt-hero__slide-actions" style="justify-content: center;">
					<?php if ( current_user_can( 'edit_posts' ) ) : ?>
						<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=destination' ) ); ?>" class="jt-btn jt-btn--secondary">
							<?php esc_html_e( 'أضف أول وجهة', 'jubari-theme' ); ?>
						</a>
					<?php else : ?>
						<a href="<?php echo esc_url( $trip_archive_url ); ?>" class="jt-btn jt-btn--secondary">
							<?php esc_html_e( 'تصفح الرحلات', 'jubari-theme' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>