<?php
/**
 * Trip gallery
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = get_the_ID();
$gallery = function_exists( 'get_field' ) ? get_field( 'trip_gallery', $post_id ) : array();

if ( empty( $gallery ) || ! is_array( $gallery ) ) {
	$featured_image = jubari_get_post_thumbnail_url_fallback( $post_id, 'jubari-gallery' );

	if ( $featured_image ) :
		?>
		<section class="trip-gallery section-space-sm">
			<div class="jt-container">
				<div class="trip-gallery__single">
					<img
						src="<?php echo esc_url( $featured_image ); ?>"
						alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>"
						loading="lazy"
					>
				</div>
			</div>
		</section>
		<?php
	endif;

	return;
}
?>

<section class="trip-gallery section-space-sm">
	<div class="jt-container">
		<div class="trip-gallery__grid">
			<?php foreach ( $gallery as $image ) : ?>
				<?php
				$image_url   = isset( $image['url'] ) ? $image['url'] : '';
				$image_alt   = isset( $image['alt'] ) && $image['alt'] ? $image['alt'] : get_the_title( $post_id );
				$image_sizes = isset( $image['sizes'] ) && is_array( $image['sizes'] ) ? $image['sizes'] : array();
				$image_src   = isset( $image_sizes['jubari-gallery'] ) ? $image_sizes['jubari-gallery'] : $image_url;
				?>

				<?php if ( $image_url && $image_src ) : ?>
					<a href="<?php echo esc_url( $image_url ); ?>" class="trip-gallery__item" data-gallery>
						<img
							src="<?php echo esc_url( $image_src ); ?>"
							alt="<?php echo esc_attr( $image_alt ); ?>"
							loading="lazy"
						>
					</a>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>