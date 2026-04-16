<?php
/**
 * Homepage Template
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$trip_archive_url = get_post_type_archive_link( 'trip' );
if ( ! $trip_archive_url ) {
	$trip_archive_url = home_url( '/' );
}

$regions = get_terms(
	array(
		'taxonomy'   => 'destination_region',
		'hide_empty' => false,
	)
);

$trip_types = get_terms(
	array(
		'taxonomy'   => 'trip_type',
		'hide_empty' => false,
	)
);
?>

<?php get_template_part( 'template-parts/hero/hero', 'home' ); ?>

<section class="jt-search-bar">
	<div class="jt-container">
		<form class="jt-search-bar__form" action="<?php echo esc_url( $trip_archive_url ); ?>" method="get">
			<div class="jt-search-bar__fields">
				<div class="jt-search-bar__field">
					<label for="search-destination"><?php esc_html_e( 'الوجهة', 'jubari-theme' ); ?></label>

					<select name="region" id="search-destination" class="jt-search-bar__select">
						<option value=""><?php esc_html_e( 'جميع الوجهات', 'jubari-theme' ); ?></option>

						<?php if ( ! is_wp_error( $regions ) && ! empty( $regions ) ) : ?>
							<?php foreach ( $regions as $region ) : ?>
								<option value="<?php echo esc_attr( $region->slug ); ?>">
									<?php echo esc_html( $region->name ); ?>
								</option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>

				<div class="jt-search-bar__field">
					<label for="search-type"><?php esc_html_e( 'نوع الرحلة', 'jubari-theme' ); ?></label>

					<select name="trip_type" id="search-type" class="jt-search-bar__select">
						<option value=""><?php esc_html_e( 'جميع الأنواع', 'jubari-theme' ); ?></option>

						<?php if ( ! is_wp_error( $trip_types ) && ! empty( $trip_types ) ) : ?>
							<?php foreach ( $trip_types as $type ) : ?>
								<option value="<?php echo esc_attr( $type->slug ); ?>">
									<?php echo esc_html( $type->name ); ?>
								</option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>

				<div class="jt-search-bar__field">
					<label for="search-duration"><?php esc_html_e( 'المدة', 'jubari-theme' ); ?></label>

					<select name="duration" id="search-duration" class="jt-search-bar__select">
						<option value=""><?php esc_html_e( 'أي مدة', 'jubari-theme' ); ?></option>
						<option value="1-3"><?php esc_html_e( '1-3 أيام', 'jubari-theme' ); ?></option>
						<option value="4-7"><?php esc_html_e( '4-7 أيام', 'jubari-theme' ); ?></option>
						<option value="8-14"><?php esc_html_e( '8-14 يوماً', 'jubari-theme' ); ?></option>
						<option value="15+"><?php esc_html_e( '15+ يوماً', 'jubari-theme' ); ?></option>
					</select>
				</div>

				<div class="jt-search-bar__submit">
					<button type="submit" class="jt-btn jt-btn--secondary">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false">
							<circle cx="11" cy="11" r="8"></circle>
							<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
						</svg>
						<?php esc_html_e( 'ابحث', 'jubari-theme' ); ?>
					</button>
				</div>
			</div>
		</form>
	</div>
</section>

<?php get_template_part( 'template-parts/sections/featured', 'destinations' ); ?>
<?php get_template_part( 'template-parts/sections/featured', 'trips' ); ?>
<?php get_template_part( 'template-parts/sections/stats', 'counter' ); ?>
<?php get_template_part( 'template-parts/sections/testimonials' ); ?>
<?php get_template_part( 'template-parts/sections/cta', 'banner' ); ?>

<section class="jt-section jt-section--blog">
	<div class="jt-container">
		<div class="jt-section-header">
			<span class="jt-section-header__subtitle"><?php esc_html_e( 'المدونة', 'jubari-theme' ); ?></span>
			<h2 class="jt-section-header__title"><?php esc_html_e( 'آخر المقالات والأخبار', 'jubari-theme' ); ?></h2>
		</div>

		<div class="jt-grid jt-grid--3">
			<?php
			$blog_query = new WP_Query(
				array(
					'post_type'           => 'post',
					'posts_per_page'      => 3,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				)
			);

			if ( $blog_query->have_posts() ) :
				while ( $blog_query->have_posts() ) :
					$blog_query->the_post();
					get_template_part( 'template-parts/cards/card', 'post' );
				endwhile;
				wp_reset_postdata();
			else :
				?>
				<div class="jt-no-content">
					<p><?php esc_html_e( 'لا توجد مقالات حالياً. أضف بعض المقالات من لوحة التحكم.', 'jubari-theme' ); ?></p>
				</div>
			<?php endif; ?>
		</div>

		<?php
		$posts_page_id = (int) get_option( 'page_for_posts' );
		$blog_page_url = $posts_page_id ? get_permalink( $posts_page_id ) : get_post_type_archive_link( 'post' );
		?>

		<?php if ( $blog_page_url ) : ?>
			<div class="jt-section__more">
				<a href="<?php echo esc_url( $blog_page_url ); ?>" class="jt-btn jt-btn--outline">
					<?php esc_html_e( 'عرض جميع المقالات', 'jubari-theme' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php get_template_part( 'template-parts/sections/newsletter' ); ?>

<?php
get_footer();