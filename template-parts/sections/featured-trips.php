<?php
/**
 * Featured Trips Section (Homepage)
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$trip_archive_url = get_post_type_archive_link( 'trip' );

$trips = new WP_Query(
	array(
		'post_type'      => 'trip',
		'posts_per_page' => 6,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => true,
	)
);

if ( ! $trips->have_posts() ) {
	wp_reset_postdata();
	return;
}
?>

<section class="jt-section">
	<div class="jt-container">
		<div class="jt-section-header">
			<span class="jt-section-header__subtitle"><?php esc_html_e( 'رحلاتنا', 'jubari-theme' ); ?></span>
			<h2 class="jt-section-header__title"><?php esc_html_e( 'أحدث الرحلات والعروض', 'jubari-theme' ); ?></h2>
		</div>

		<div class="jt-grid jt-grid--3">
			<?php
			while ( $trips->have_posts() ) :
				$trips->the_post();
				get_template_part( 'template-parts/cards/card', 'trip' );
			endwhile;
			?>
		</div>

		<?php wp_reset_postdata(); ?>

		<?php if ( $trip_archive_url ) : ?>
			<div class="jt-section__more">
				<a href="<?php echo esc_url( $trip_archive_url ); ?>" class="jt-btn jt-btn--outline">
					<?php esc_html_e( 'عرض جميع الرحلات', 'jubari-theme' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>