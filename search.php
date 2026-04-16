<?php
/**
 * Search Results
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$search_query = get_search_query();
?>

<section class="jt-page-hero jt-page-hero--archive">
	<div class="jt-page-hero__overlay"></div>

	<div class="jt-container">
		<div class="jt-page-hero__content">
			<h1 class="jt-page-hero__title">
				<?php
				printf(
					esc_html__( 'نتائج البحث عن: %s', 'jubari-theme' ),
					'<span>"' . esc_html( $search_query ) . '"</span>'
				);
				?>
			</h1>

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
						'screen_reader_text' => esc_html__( 'نتائج البحث', 'jubari-theme' ),
					)
				);
				?>
			</div>
		<?php else : ?>
			<div class="jt-no-results">
				<h2><?php esc_html_e( 'لم يتم العثور على نتائج', 'jubari-theme' ); ?></h2>
				<p><?php esc_html_e( 'جرب البحث بكلمات مختلفة.', 'jubari-theme' ); ?></p>

				<div class="jt-search-form">
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();