<?php
/**
 * Destination Region taxonomy archive
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$term = get_queried_object();
?>

<main id="primary" class="site-main taxonomy-destination-region-page">
	<section class="page-hero page-hero--inner">
		<div class="container">
			<h1 class="page-title"><?php echo esc_html( single_term_title( '', false ) ); ?></h1>

			<?php if ( ! empty( $term->description ) ) : ?>
				<div class="term-description">
					<?php echo wp_kses_post( wpautop( $term->description ) ); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<section class="taxonomy-results section-space">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<div class="cards-grid cards-grid--destinations">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/cards/card', 'destination' );
					endwhile;
					?>
				</div>

				<div class="pagination-wrap">
					<?php the_posts_pagination(); ?>
				</div>
			<?php else : ?>
				<p><?php esc_html_e( 'لا توجد عناصر في هذا التصنيف حالياً.', 'jubari-theme' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();