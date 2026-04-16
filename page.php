<?php
/**
 * Generic Page Template
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$hero_image = jubari_get_post_thumbnail_url_fallback( get_the_ID(), 'jubari-hero' );
	?>

	<section class="jt-page-hero jt-page-hero--archive" style="background-image: url('<?php echo esc_url( $hero_image ); ?>');">
		<div class="jt-page-hero__overlay"></div>

		<div class="jt-container">
			<div class="jt-page-hero__content">
				<h1 class="jt-page-hero__title"><?php the_title(); ?></h1>
				<?php jubari_breadcrumbs(); ?>
			</div>
		</div>
	</section>

	<section class="jt-section">
		<div class="jt-container">
			<div class="jt-prose" style="max-width: 800px; margin-inline: auto;">
				<?php the_content(); ?>
			</div>

			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'الصفحات:', 'jubari-theme' ),
					'after'  => '</div>',
				)
			);
			?>
		</div>
	</section>

<?php endwhile; ?>

<?php
get_footer();