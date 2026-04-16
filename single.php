<?php
/**
 * Single Blog Post
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$post_id    = get_the_ID();
	$hero_image = jubari_get_post_thumbnail_url_fallback( $post_id, 'jubari-hero' );
	$categories = get_the_category( $post_id );
	?>

	<section class="jt-page-hero" style="background-image: url('<?php echo esc_url( $hero_image ); ?>');">
		<div class="jt-page-hero__overlay"></div>

		<div class="jt-container">
			<div class="jt-page-hero__content">
				<?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
					<span class="jt-page-hero__subtitle"><?php echo esc_html( $categories[0]->name ); ?></span>
				<?php endif; ?>

				<h1 class="jt-page-hero__title"><?php the_title(); ?></h1>

				<div class="jt-page-hero__meta" style="margin-top: 0.75rem; font-size: 0.875rem; opacity: 0.8;">
					<time datetime="<?php echo esc_attr( get_the_date( 'c', $post_id ) ); ?>">
						<?php echo esc_html( get_the_date( '', $post_id ) ); ?>
					</time>

					<span style="margin-inline: 0.5rem;">•</span>

					<span><?php jubari_reading_time( $post_id ); ?></span>
				</div>

				<?php jubari_breadcrumbs(); ?>
			</div>
		</div>
	</section>

	<section class="jt-section">
		<div class="jt-container">
			<article class="jt-prose" style="max-width: 800px; margin-inline: auto;">
				<?php the_content(); ?>

				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'الصفحات:', 'jubari-theme' ),
						'after'  => '</div>',
					)
				);
				?>
			</article>

			<?php
			the_post_navigation(
				array(
					'prev_text' => '<span class="jt-btn jt-btn--outline jt-btn--sm">' . esc_html__( 'المقال السابق', 'jubari-theme' ) . '</span>',
					'next_text' => '<span class="jt-btn jt-btn--outline jt-btn--sm">' . esc_html__( 'المقال التالي', 'jubari-theme' ) . '</span>',
				)
			);
			?>
		</div>
	</section>

<?php endwhile; ?>

<?php
get_footer();