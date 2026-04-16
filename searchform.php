<?php
/**
 * Custom search form
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<form role="search" method="get" class="jubari-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="jubari-search-field">
		<?php esc_html_e( 'Search for:', 'jubari-theme' ); ?>
	</label>

	<div class="jubari-search-form__inner">
		<input
			type="search"
			id="jubari-search-field"
			class="jubari-search-form__field"
			placeholder="<?php echo esc_attr_x( 'ابحث هنا...', 'placeholder', 'jubari-theme' ); ?>"
			value="<?php echo esc_attr( get_search_query() ); ?>"
			name="s"
		/>

		<button type="submit" class="jubari-search-form__button">
			<?php esc_html_e( 'بحث', 'jubari-theme' ); ?>
		</button>
	</div>
</form>