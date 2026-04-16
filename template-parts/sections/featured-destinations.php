<?php
/**
 * Featured Destinations Section (Homepage)
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$destination_archive_url = get_post_type_archive_link( 'destination' );

$destinations = new WP_Query(
	array(
		'post_type'      => 'destination',
		'posts_per_page' => 6,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => true,
	)
);

if ( ! $destinations->have_posts() ) {
	wp_reset_postdata();
	return;
}
?>

<section class="jt-section jt-section--gray">
	<div class="jt-container">
		<div class="jt-section-header">
			<span class="jt-section-header__subtitle"><?php esc_html_e( 'وجهاتنا', 'jubari-theme' ); ?></span>
			<h2 class="jt-section-header__title"><?php esc_html_e( 'استكشف أجمل الوجهات', 'jubari-theme' ); ?></h2>
		</div>

		<div class="jt-grid jt-grid--3">
			<?php
			while ( $destinations->have_posts() ) :
				$destinations->the_post();
				get_template_part( 'template-parts/cards/card', 'destination' );
			endwhile;
			?>
		</div>

		<?php wp_reset_postdata(); ?>

		<?php if ( $destination_archive_url ) : ?>
			<div class="jt-section__more">
				<a href="<?php echo esc_url( $destination_archive_url ); ?>" class="jt-btn jt-btn--outline">
					<?php esc_html_e( 'عرض جميع الوجهات', 'jubari-theme' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>