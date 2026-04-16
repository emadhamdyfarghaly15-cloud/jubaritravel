<?php
/**
 * Page content template
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-page-template' ); ?>>
	<div class="container">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>
</article>