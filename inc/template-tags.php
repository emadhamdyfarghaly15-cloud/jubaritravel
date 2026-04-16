<?php
/**
 * Custom template tags for the theme
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return trip price HTML.
 *
 * @param int|null $post_id Post ID.
 * @return string
 */
function jubari_get_trip_price( $post_id = null ) {
	$post_id = $post_id ? absint( $post_id ) : get_the_ID();

	if ( ! $post_id || ! function_exists( 'get_field' ) ) {
		return '';
	}

	$price      = get_field( 'trip_price', $post_id );
	$sale_price = get_field( 'trip_sale_price', $post_id );
	$note       = get_field( 'trip_price_note', $post_id );
	$currency   = get_field( 'trip_currency', $post_id );

	if ( ! $currency ) {
		$currency = '$';
	}

	if ( '' === $price || null === $price ) {
		return '';
	}

	$price      = is_numeric( $price ) ? (float) $price : $price;
	$sale_price = is_numeric( $sale_price ) ? (float) $sale_price : $sale_price;

	ob_start();
	?>
	<div class="jt-price">
		<?php if ( $sale_price && is_numeric( $sale_price ) && is_numeric( $price ) && $sale_price < $price ) : ?>
			<span class="jt-price__old">
				<del><?php echo esc_html( $currency . number_format_i18n( $price ) ); ?></del>
			</span>
			<span class="jt-price__current"><?php echo esc_html( $currency . number_format_i18n( $sale_price ) ); ?></span>
		<?php else : ?>
			<span class="jt-price__current">
				<?php echo esc_html( is_numeric( $price ) ? $currency . number_format_i18n( $price ) : $price ); ?>
			</span>
		<?php endif; ?>

		<?php if ( $note ) : ?>
			<span class="jt-price__note"> / <?php echo esc_html( $note ); ?></span>
		<?php endif; ?>
	</div>
	<?php
	return ob_get_clean();
}

/**
 * Echo trip price HTML.
 *
 * @param int|null $post_id Post ID.
 * @return void
 */
function jubari_trip_price( $post_id = null ) {
	echo jubari_get_trip_price( $post_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Return trip meta HTML.
 *
 * @param int|null $post_id Post ID.
 * @return string
 */
function jubari_get_trip_meta( $post_id = null ) {
	$post_id = $post_id ? absint( $post_id ) : get_the_ID();

	if ( ! $post_id || ! function_exists( 'get_field' ) ) {
		return '';
	}

	$duration   = get_field( 'trip_duration', $post_id );
	$group_size = get_field( 'trip_group_size', $post_id );
	$difficulty = get_field( 'trip_difficulty', $post_id );

	$difficulty_labels = array(
		'easy'     => esc_html__( 'سهل', 'jubari-theme' ),
		'moderate' => esc_html__( 'متوسط', 'jubari-theme' ),
		'hard'     => esc_html__( 'صعب', 'jubari-theme' ),
	);

	if ( ! $duration && ! $group_size && ! $difficulty ) {
		return '';
	}

	ob_start();
	?>
	<div class="jt-trip-meta">
		<?php if ( $duration ) : ?>
			<div class="jt-trip-meta__item">
				<?php echo jubari_get_icon( 'calendar', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span>
					<?php
					printf(
						esc_html( _n( '%s يوم', '%s أيام', (int) $duration, 'jubari-theme' ) ),
						esc_html( $duration )
					);
					?>
				</span>
			</div>
		<?php endif; ?>

		<?php if ( $group_size ) : ?>
			<div class="jt-trip-meta__item">
				<?php echo jubari_get_icon( 'users', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php echo esc_html( $group_size ); ?></span>
			</div>
		<?php endif; ?>

		<?php if ( $difficulty && isset( $difficulty_labels[ $difficulty ] ) ) : ?>
			<div class="jt-trip-meta__item">
				<?php echo jubari_get_icon( 'star', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php echo esc_html( $difficulty_labels[ $difficulty ] ); ?></span>
			</div>
		<?php endif; ?>
	</div>
	<?php
	return ob_get_clean();
}

/**
 * Echo trip meta HTML.
 *
 * @param int|null $post_id Post ID.
 * @return void
 */
function jubari_trip_meta( $post_id = null ) {
	echo jubari_get_trip_meta( $post_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Return star rating HTML.
 *
 * @param int $rating Rating from 1 to 5.
 * @return string
 */
function jubari_get_star_rating( $rating = 5 ) {
	$rating = max( 0, min( 5, absint( $rating ) ) );

	ob_start();
	?>
	<div class="jt-stars" aria-label="<?php echo esc_attr( sprintf( __( 'التقييم: %s من 5', 'jubari-theme' ), $rating ) ); ?>">
		<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
			<span class="jt-stars__item<?php echo $i <= $rating ? ' is-filled' : ''; ?>">
				<?php echo jubari_get_icon( 'star', 18, 'jt-star' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</span>
		<?php endfor; ?>
	</div>
	<?php
	return ob_get_clean();
}

/**
 * Echo star rating HTML.
 *
 * @param int $rating Rating from 1 to 5.
 * @return void
 */
function jubari_star_rating( $rating = 5 ) {
	echo jubari_get_star_rating( $rating ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Return breadcrumbs HTML.
 *
 * @return string
 */
function jubari_get_breadcrumbs() {
	if ( is_front_page() ) {
		return '';
	}

	ob_start();
	?>
	<nav class="jt-breadcrumb" aria-label="<?php esc_attr_e( 'مسار التصفح', 'jubari-theme' ); ?>">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'الرئيسية', 'jubari-theme' ); ?></a>

		<?php if ( is_home() ) : ?>
			<span class="jt-breadcrumb__separator" aria-hidden="true">›</span>
			<span aria-current="page"><?php esc_html_e( 'المدونة', 'jubari-theme' ); ?></span>

		<?php elseif ( is_singular( 'destination' ) ) : ?>
			<span class="jt-breadcrumb__separator" aria-hidden="true">›</span>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'destination' ) ); ?>"><?php esc_html_e( 'الوجهات', 'jubari-theme' ); ?></a>
			<span class="jt-breadcrumb__separator" aria-hidden="true">›</span>
			<span aria-current="page"><?php echo esc_html( get_the_title() ); ?></span>

		<?php elseif ( is_singular( 'trip' ) ) : ?>
			<span class="jt-breadcrumb__separator" aria-hidden="true">›</span>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'trip' ) ); ?>"><?php esc_html_e( 'الرحلات', 'jubari-theme' ); ?></a>
			<span class="jt-breadcrumb__separator" aria-hidden="true">›</span>
			<span aria-current="page"><?php echo esc_html( get_the_title() ); ?></span>

		<?php elseif ( is_page() || is_single() ) : ?>
			<span class="jt-breadcrumb__separator" aria-hidden="true">›</span>
			<span aria-current="page"><?php echo esc_html( get_the_title() ); ?></span>

		<?php elseif ( is_post_type_archive() ) : ?>
			<span class="jt-breadcrumb__separator" aria-hidden="true">›</span>
			<span aria-current="page"><?php echo esc_html( post_type_archive_title( '', false ) ); ?></span>

		<?php elseif ( is_category() || is_tag() || is_tax() || is_archive() ) : ?>
			<span class="jt-breadcrumb__separator" aria-hidden="true">›</span>
			<span aria-current="page"><?php echo esc_html( get_the_archive_title() ); ?></span>

		<?php elseif ( is_search() ) : ?>
			<span class="jt-breadcrumb__separator" aria-hidden="true">›</span>
			<span aria-current="page">
				<?php
				printf(
					esc_html__( 'نتائج البحث عن: %s', 'jubari-theme' ),
					esc_html( get_search_query() )
				);
				?>
			</span>

		<?php elseif ( is_404() ) : ?>
			<span class="jt-breadcrumb__separator" aria-hidden="true">›</span>
			<span aria-current="page"><?php esc_html_e( 'الصفحة غير موجودة', 'jubari-theme' ); ?></span>
		<?php endif; ?>
	</nav>
	<?php
	return ob_get_clean();
}

/**
 * Echo breadcrumbs HTML.
 *
 * @return void
 */
function jubari_breadcrumbs() {
	echo jubari_get_breadcrumbs(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Return post reading time estimate.
 *
 * @param int|null $post_id Post ID.
 * @return string
 */
function jubari_get_reading_time( $post_id = null ) {
	$post_id = $post_id ? absint( $post_id ) : get_the_ID();
	$content = get_post_field( 'post_content', $post_id );

	if ( ! $content ) {
		return '';
	}

	$content    = wp_strip_all_tags( $content );
	$word_count = str_word_count( $content );
	$minutes    = max( 1, (int) ceil( $word_count / 200 ) );

	return sprintf(
		esc_html( _n( '%s دقيقة للقراءة', '%s دقائق للقراءة', $minutes, 'jubari-theme' ) ),
		number_format_i18n( $minutes )
	);
}

/**
 * Echo post reading time estimate.
 *
 * @param int|null $post_id Post ID.
 * @return void
 */
function jubari_reading_time( $post_id = null ) {
	echo esc_html( jubari_get_reading_time( $post_id ) );
}