<?php
/**
 * Destinations Archive
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$destination_archive_url = get_post_type_archive_link( 'destination' );
$regions = get_terms(
	array(
		'taxonomy'   => 'destination_region',
		'hide_empty' => true,
	)
);
?>

<section class="jt-page-hero jt-page-hero--archive">
	<div class="jt-page-hero__overlay"></div>

	<div class="jt-container">
		<div class="jt-page-hero__content">
			<h1 class="jt-page-hero__title"><?php esc_html_e( 'استكشف وجهاتنا', 'jubari-theme' ); ?></h1>
			<p class="jt-page-hero__desc"><?php esc_html_e( 'اكتشف أجمل الوجهات السياحية حول العالم مع رحلاتنا المميزة', 'jubari-theme' ); ?></p>

			<?php jubari_breadcrumbs(); ?>
		</div>
	</div>
</section>

<section class="jt-filter-bar">
	<div class="jt-container">
		<div class="jt-filter-bar__inner">
			<span class="jt-filter-bar__label"><?php esc_html_e( 'تصفية حسب المنطقة:', 'jubari-theme' ); ?></span>

			<ul class="jt-filter-bar__list">
				<?php if ( $destination_archive_url ) : ?>
					<li>
						<a
							href="<?php echo esc_url( $destination_archive_url ); ?>"
							class="jt-filter-bar__link <?php echo ! is_tax( 'destination_region' ) ? 'is-active' : ''; ?>"
						>
							<?php esc_html_e( 'الكل', 'jubari-theme' ); ?>
						</a>
					</li>
				<?php endif; ?>

				<?php if ( $regions && ! is_wp_error( $regions ) ) : ?>
					<?php foreach ( $regions as $region ) : ?>
						<li>
							<a
								href="<?php echo esc_url( get_term_link( $region ) ); ?>"
								class="jt-filter-bar__link <?php echo is_tax( 'destination_region', $region->slug ) ? 'is-active' : ''; ?>"
							>
								<?php echo esc_html( $region->name ); ?>
								<span class="jt-filter-bar__count">(<?php echo esc_html( number_format_i18n( $region->count ) ); ?>)</span>
							</a>
						</li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</section>

<section class="jt-section">
	<div class="jt-container">
		<?php if ( have_posts() ) : ?>
			<div class="jt-grid jt-grid--3" id="destinations-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/cards/card', 'destination' );
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
						'screen_reader_text' => esc_html__( 'تصفح الوجهات', 'jubari-theme' ),
					)
				);
				?>
			</div>
		<?php else : ?>
			<div class="jt-no-results">
				<h2><?php esc_html_e( 'لم يتم العثور على وجهات', 'jubari-theme' ); ?></h2>
				<p><?php esc_html_e( 'يرجى المحاولة مرة أخرى لاحقاً أو تصفح الأقسام الأخرى.', 'jubari-theme' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();