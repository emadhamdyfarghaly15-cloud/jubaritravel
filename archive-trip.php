<?php
/**
 * Trip archive template
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$regions = get_terms(
	array(
		'taxonomy'   => 'destination_region',
		'hide_empty' => true,
	)
);

$trip_types = get_terms(
	array(
		'taxonomy'   => 'trip_type',
		'hide_empty' => true,
	)
);
?>

<section class="jt-page-hero jt-page-hero--archive">
	<div class="jt-page-hero__overlay"></div>

	<div class="jt-container">
		<div class="jt-page-hero__content">
			<h1 class="jt-page-hero__title"><?php post_type_archive_title(); ?></h1>
			<p class="jt-page-hero__desc"><?php esc_html_e( 'تصفح أحدث الرحلات والبرامج السياحية المناسبة لك.', 'jubari-theme' ); ?></p>

			<?php jubari_breadcrumbs(); ?>
		</div>
	</div>
</section>

<section class="jt-filter-bar">
	<div class="jt-container">
		<form class="jt-search-bar__form" method="get" action="<?php echo esc_url( get_post_type_archive_link( 'trip' ) ); ?>">
			<div class="jt-search-bar__fields">
				<div class="jt-search-bar__field">
					<label for="trip-region-filter"><?php esc_html_e( 'المنطقة', 'jubari-theme' ); ?></label>
					<select name="region" id="trip-region-filter" class="jt-search-bar__select">
						<option value=""><?php esc_html_e( 'كل المناطق', 'jubari-theme' ); ?></option>
						<?php if ( $regions && ! is_wp_error( $regions ) ) : ?>
							<?php foreach ( $regions as $region ) : ?>
								<option value="<?php echo esc_attr( $region->slug ); ?>" <?php selected( isset( $_GET['region'] ) ? wp_unslash( $_GET['region'] ) : '', $region->slug ); ?>>
									<?php echo esc_html( $region->name ); ?>
								</option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>

				<div class="jt-search-bar__field">
					<label for="trip-type-filter"><?php esc_html_e( 'نوع الرحلة', 'jubari-theme' ); ?></label>
					<select name="trip_type" id="trip-type-filter" class="jt-search-bar__select">
						<option value=""><?php esc_html_e( 'كل الأنواع', 'jubari-theme' ); ?></option>
						<?php if ( $trip_types && ! is_wp_error( $trip_types ) ) : ?>
							<?php foreach ( $trip_types as $type ) : ?>
								<option value="<?php echo esc_attr( $type->slug ); ?>" <?php selected( isset( $_GET['trip_type'] ) ? wp_unslash( $_GET['trip_type'] ) : '', $type->slug ); ?>>
									<?php echo esc_html( $type->name ); ?>
								</option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>

				<div class="jt-search-bar__submit">
					<button type="submit" class="jt-btn jt-btn--secondary">
						<?php esc_html_e( 'تصفية', 'jubari-theme' ); ?>
					</button>
				</div>
			</div>
		</form>
	</div>
</section>

<section class="jt-section archive-trips">
	<div class="jt-container">
		<?php if ( have_posts() ) : ?>
			<div class="jt-grid jt-grid--3">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/cards/card', 'trip' );
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
						'screen_reader_text' => esc_html__( 'تصفح الرحلات', 'jubari-theme' ),
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