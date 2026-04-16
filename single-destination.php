<?php
/**
 * Single Destination Template
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$post_id = get_the_ID();

	// ACF fields.
	$subtitle   = function_exists( 'get_field' ) ? get_field( 'destination_subtitle', $post_id ) : '';
	$gallery    = function_exists( 'get_field' ) ? get_field( 'destination_gallery', $post_id ) : array();
	$best_time  = function_exists( 'get_field' ) ? get_field( 'destination_best_time', $post_id ) : '';
	$language   = function_exists( 'get_field' ) ? get_field( 'destination_language', $post_id ) : '';
	$currency   = function_exists( 'get_field' ) ? get_field( 'destination_currency', $post_id ) : '';
	$highlights = function_exists( 'get_field' ) ? get_field( 'destination_highlights', $post_id ) : array();
	$lat        = function_exists( 'get_field' ) ? get_field( 'destination_latitude', $post_id ) : '';
	$lng        = function_exists( 'get_field' ) ? get_field( 'destination_longitude', $post_id ) : '';

	$hero_image = jubari_get_post_thumbnail_url_fallback( $post_id, 'jubari-hero' );
	?>

	<section class="jt-page-hero" style="background-image: url('<?php echo esc_url( $hero_image ); ?>');">
		<div class="jt-page-hero__overlay"></div>

		<div class="jt-container">
			<div class="jt-page-hero__content">
				<?php if ( $subtitle ) : ?>
					<span class="jt-page-hero__subtitle"><?php echo esc_html( $subtitle ); ?></span>
				<?php endif; ?>

				<h1 class="jt-page-hero__title"><?php the_title(); ?></h1>

				<?php jubari_breadcrumbs(); ?>
			</div>
		</div>
	</section>

	<?php if ( $best_time || $language || $currency ) : ?>
		<section class="jt-dest-info-bar">
			<div class="jt-container">
				<div class="jt-dest-info-bar__grid">
					<?php if ( $best_time ) : ?>
						<div class="jt-dest-info-bar__item">
							<?php echo jubari_get_icon( 'calendar', 24 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div>
								<span class="jt-dest-info-bar__label"><?php esc_html_e( 'أفضل وقت للزيارة', 'jubari-theme' ); ?></span>
								<span class="jt-dest-info-bar__value"><?php echo esc_html( $best_time ); ?></span>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( $language ) : ?>
						<div class="jt-dest-info-bar__item">
							<?php echo jubari_get_icon( 'users', 24 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div>
								<span class="jt-dest-info-bar__label"><?php esc_html_e( 'اللغة', 'jubari-theme' ); ?></span>
								<span class="jt-dest-info-bar__value"><?php echo esc_html( $language ); ?></span>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( $currency ) : ?>
						<div class="jt-dest-info-bar__item">
							<?php echo jubari_get_icon( 'star', 24 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<div>
								<span class="jt-dest-info-bar__label"><?php esc_html_e( 'العملة', 'jubari-theme' ); ?></span>
								<span class="jt-dest-info-bar__value"><?php echo esc_html( $currency ); ?></span>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="jt-section">
		<div class="jt-container">
			<div class="jt-dest-content">
				<div class="jt-dest-content__text jt-prose">
					<?php the_content(); ?>
				</div>

				<?php if ( ! empty( $highlights ) && is_array( $highlights ) ) : ?>
					<div class="jt-dest-highlights">
						<h2><?php esc_html_e( 'أبرز المعالم', 'jubari-theme' ); ?></h2>

						<div class="jt-grid jt-grid--3">
							<?php foreach ( $highlights as $highlight ) : ?>
								<?php
								$highlight_title = ! empty( $highlight['title'] ) ? $highlight['title'] : '';
								$highlight_icon  = ! empty( $highlight['icon'] ) ? sanitize_html_class( $highlight['icon'] ) : '';
								?>
								<?php if ( $highlight_title ) : ?>
									<div class="jt-dest-highlight-card">
										<?php if ( $highlight_icon ) : ?>
											<div class="jt-dest-highlight-card__icon">
												<?php echo jubari_get_icon( $highlight_icon, 32 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											</div>
										<?php endif; ?>

										<h3 class="jt-dest-highlight-card__title"><?php echo esc_html( $highlight_title ); ?></h3>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $gallery ) && is_array( $gallery ) ) : ?>
					<div class="jt-dest-gallery">
						<h2><?php esc_html_e( 'معرض الصور', 'jubari-theme' ); ?></h2>

						<div class="jt-gallery-grid">
							<?php foreach ( $gallery as $image ) : ?>
								<?php
								$image_url      = isset( $image['url'] ) ? $image['url'] : '';
								$image_caption  = isset( $image['caption'] ) ? $image['caption'] : '';
								$image_alt      = isset( $image['alt'] ) && $image['alt'] ? $image['alt'] : get_the_title( $post_id );
								$image_sizes    = isset( $image['sizes'] ) && is_array( $image['sizes'] ) ? $image['sizes'] : array();
								$image_src      = isset( $image_sizes['jubari-gallery'] ) ? $image_sizes['jubari-gallery'] : $image_url;
								$image_width    = isset( $image_sizes['jubari-gallery-width'] ) ? $image_sizes['jubari-gallery-width'] : '';
								$image_height   = isset( $image_sizes['jubari-gallery-height'] ) ? $image_sizes['jubari-gallery-height'] : '';
								?>

								<?php if ( $image_url && $image_src ) : ?>
									<a
										href="<?php echo esc_url( $image_url ); ?>"
										class="jt-gallery-grid__item"
										data-gallery
										data-caption="<?php echo esc_attr( $image_caption ); ?>"
									>
										<img
											src="<?php echo esc_url( $image_src ); ?>"
											alt="<?php echo esc_attr( $image_alt ); ?>"
											<?php if ( $image_width ) : ?>width="<?php echo esc_attr( $image_width ); ?>"<?php endif; ?>
											<?php if ( $image_height ) : ?>height="<?php echo esc_attr( $image_height ); ?>"<?php endif; ?>
											loading="lazy"
										>
									</a>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php
				$related_trips = new WP_Query(
					array(
						'post_type'      => 'trip',
						'posts_per_page' => 3,
						'post_status'    => 'publish',
						'no_found_rows'  => true,
						'meta_query'     => array(
							array(
								'key'     => 'trip_destination',
								'value'   => '"' . $post_id . '"',
								'compare' => 'LIKE',
							),
						),
					)
				);

				if ( $related_trips->have_posts() ) :
					?>
					<div class="jt-dest-related-trips">
						<h2><?php esc_html_e( 'رحلات متاحة في هذه الوجهة', 'jubari-theme' ); ?></h2>

						<div class="jt-grid jt-grid--3">
							<?php
							while ( $related_trips->have_posts() ) :
								$related_trips->the_post();
								get_template_part( 'template-parts/cards/card', 'trip' );
							endwhile;
							?>
						</div>
					</div>
					<?php
				endif;

				wp_reset_postdata();
				?>

				<?php if ( $lat && $lng ) : ?>
					<div class="jt-dest-map">
						<h2><?php esc_html_e( 'موقع الوجهة', 'jubari-theme' ); ?></h2>
						<div class="jt-dest-map__embed">
							<iframe
								src="<?php echo esc_url( 'https://www.google.com/maps?q=' . rawurlencode( $lat . ',' . $lng ) . '&z=10&output=embed' ); ?>"
								width="100%"
								height="450"
								style="border:0;"
								allowfullscreen=""
								loading="lazy"
								referrerpolicy="no-referrer-when-downgrade"
								title="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"
							></iframe>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

<?php endwhile; ?>

<?php
get_footer();