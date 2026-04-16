<?php
/**
 * Testimonials Section
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$testimonials = new WP_Query(
	array(
		'post_type'      => 'testimonial',
		'posts_per_page' => 6,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => true,
	)
);

if ( ! $testimonials->have_posts() ) {
	wp_reset_postdata();
	return;
}
?>

<section class="jt-testimonials">
	<div class="jt-container">
		<div class="jt-section-header">
			<span class="jt-section-header__subtitle"><?php esc_html_e( 'آراء عملائنا', 'jubari-theme' ); ?></span>
			<h2 class="jt-section-header__title"><?php esc_html_e( 'ماذا يقول عملاؤنا', 'jubari-theme' ); ?></h2>
		</div>

		<div class="swiper jt-testimonials__slider">
			<div class="swiper-wrapper">
				<?php while ( $testimonials->have_posts() ) : ?>
					<?php
					$testimonials->the_post();

					$post_id     = get_the_ID();
					$rating      = function_exists( 'get_field' ) ? get_field( 'rating', $post_id ) : 5;
					$client_name = function_exists( 'get_field' ) ? get_field( 'client_name', $post_id ) : '';
					$client_trip = function_exists( 'get_field' ) ? get_field( 'client_trip', $post_id ) : '';

					$rating = max( 1, min( 5, absint( $rating ) ) );
					if ( ! $client_name ) {
						$client_name = get_the_title( $post_id );
					}

					$avatar_url = get_the_post_thumbnail_url( $post_id, 'jubari-thumbnail-sm' );
					?>
					<div class="swiper-slide">
						<div class="jt-testimonial-card">
							<div class="jt-testimonial-card__stars">
								<?php jubari_star_rating( $rating ); ?>
							</div>

							<div class="jt-testimonial-card__text">
								<?php echo wp_kses_post( wpautop( get_the_content() ) ); ?>
							</div>

							<div class="jt-testimonial-card__author">
								<?php if ( $avatar_url ) : ?>
									<img
										src="<?php echo esc_url( $avatar_url ); ?>"
										alt="<?php echo esc_attr( $client_name ); ?>"
										class="jt-testimonial-card__avatar"
										loading="lazy"
									>
								<?php else : ?>
									<div class="jt-testimonial-card__avatar" style="background: var(--jt-primary); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 1.25rem;">
										<?php echo esc_html( mb_substr( $client_name, 0, 1 ) ); ?>
									</div>
								<?php endif; ?>

								<div>
									<div class="jt-testimonial-card__name"><?php echo esc_html( $client_name ); ?></div>

									<?php if ( $client_trip ) : ?>
										<div class="jt-testimonial-card__trip"><?php echo esc_html( $client_trip ); ?></div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>

			<div class="jt-testimonials__pagination swiper-pagination"></div>
		</div>
	</div>
</section>

<?php wp_reset_postdata(); ?>