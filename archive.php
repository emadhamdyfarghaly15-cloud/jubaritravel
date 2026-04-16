<?php
/**
 * Generic Archive (Blog)
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="jt-page-hero jt-page-hero--archive">
	<div class="jt-page-hero__overlay"></div>

	<div class="jt-container">
		<div class="jt-page-hero__content">
			<h1 class="jt-page-hero__title"><?php the_archive_title(); ?></h1>

			<?php the_archive_description( '<p class="jt-page-hero__desc">', '</p>' ); ?>

			<?php jubari_breadcrumbs(); ?>
		</div>
	</div>
</section>

<section class="jt-section">
	<div class="jt-container">
		<?php if ( have_posts() ) : ?>
			<div class="jt-grid jt-grid--3">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/cards/card', 'post' );
				endwhile;
				?>
			</div>

			<div class="jt-pagination">
				<?php
				the_posts_pagination(
					array(
						'mid_size'           => 2,
						'prev_text'          => '<span aria-hidden="true">&rarr;</span> ' . esc_html__( 'السابق', 'jubari-theme' ),
						'next_text'          => esc_html__( 'التالي', 'jubari-theme' ) . ' <span aria-hidden="true">&larr;</span>',
						'screen_reader_text' => esc_html__( 'تصفح الأرشيف', 'jubari-theme' ),
					)
				);
				?>
			</div>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();