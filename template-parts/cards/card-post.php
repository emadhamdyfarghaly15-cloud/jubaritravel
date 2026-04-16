<?php
/**
 * Blog Post Card Component
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id   = get_the_ID();
$image_url = jubari_get_post_thumbnail_url_fallback( $post_id, 'jubari-card' );
$title     = get_the_title( $post_id );
$excerpt   = get_the_excerpt();
$date_iso  = get_the_date( 'c', $post_id );
$date      = get_the_date( '', $post_id );
$categories = get_the_category( $post_id );
?>

<article class="jt-card jt-card--post" itemscope itemtype="https://schema.org/BlogPosting">
	<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="jt-card__link" itemprop="url">
		<div class="jt-card__image-wrap">
			<img
				src="<?php echo esc_url( $image_url ); ?>"
				alt="<?php echo esc_attr( $title ); ?>"
				class="jt-card__image"
				loading="lazy"
				itemprop="image"
			>

			<div class="jt-card__overlay"></div>
		</div>

		<div class="jt-card__body">
			<?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
				<span class="jt-card__category"><?php echo esc_html( $categories[0]->name ); ?></span>
			<?php endif; ?>

			<h3 class="jt-card__title" itemprop="headline">
				<?php echo esc_html( wp_trim_words( $title, 8, '...' ) ); ?>
			</h3>

			<?php if ( $excerpt ) : ?>
				<p class="jt-card__excerpt" itemprop="description">
					<?php echo esc_html( wp_trim_words( wp_strip_all_tags( $excerpt ), 15, '...' ) ); ?>
				</p>
			<?php endif; ?>

			<div class="jt-card__meta">
				<span class="jt-card--post__date">
					<?php echo jubari_get_icon( 'calendar', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<time datetime="<?php echo esc_attr( $date_iso ); ?>" itemprop="datePublished">
						<?php echo esc_html( $date ); ?>
					</time>
				</span>

				<span class="jt-card--post__read-more">
					<?php esc_html_e( 'اقرأ المزيد', 'jubari-theme' ); ?> &larr;
				</span>
			</div>
		</div>
	</a>
</article>