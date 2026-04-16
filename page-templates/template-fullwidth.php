<?php
/**
 * Template Name: Full Width
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main page-fullwidth">
	<?php
	while ( have_posts() ) :
		the_post();

		if ( get_template_part( 'template-parts/content/content', 'page' ) === false ) :
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-content-wrapper' ); ?>>
				<div class="container">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</div>
			</article>
			<?php
		endif;

	endwhile;
	?>
</main>

<?php
get_footer();