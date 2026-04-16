<?php
/**
 * Single post content template
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-single-template' ); ?>>
	<div class="container">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<div class="entry-meta">
				<span><?php echo esc_html( get_the_date() ); ?></span>
				<span><?php echo esc_html( get_the_author() ); ?></span>
			</div>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>
</article>