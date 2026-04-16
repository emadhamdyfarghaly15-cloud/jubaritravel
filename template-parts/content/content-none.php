<?php
/**
 * No content template
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="jt-no-results not-found">
	<div class="jt-container">
		<h2><?php esc_html_e( 'لا توجد نتائج', 'jubari-theme' ); ?></h2>
		<p><?php esc_html_e( 'لم يتم العثور على أي محتوى مطابق.', 'jubari-theme' ); ?></p>

		<div class="jt-search-form">
			<?php get_search_form(); ?>
		</div>
	</div>
</section>