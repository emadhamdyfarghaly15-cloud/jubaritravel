<?php
/**
 * 404 Page
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="jt-page-hero jt-page-hero--archive">
	<div class="jt-page-hero__overlay"></div>

	<div class="jt-container">
		<div class="jt-page-hero__content">
			<h1 class="jt-page-hero__title"><?php esc_html_e( 'الصفحة غير موجودة', 'jubari-theme' ); ?></h1>
			<?php jubari_breadcrumbs(); ?>
		</div>
	</div>
</section>

<section class="jt-section" style="text-align: center; padding-block: 8rem;">
	<div class="jt-container">
		<div style="font-size: 8rem; font-weight: 800; color: var(--jt-light-gray); line-height: 1; margin-bottom: 1rem;">404</div>

		<h2 style="font-size: 2rem; margin-bottom: 1rem;">
			<?php esc_html_e( 'عذراً، الصفحة التي تبحث عنها غير موجودة', 'jubari-theme' ); ?>
		</h2>

		<p style="color: var(--jt-mid-gray); font-size: 1.1rem; max-width: 500px; margin-inline: auto; margin-bottom: 2rem;">
			<?php esc_html_e( 'ربما تم حذف الصفحة أو تغيير الرابط. يمكنك العودة للرئيسية أو استخدام البحث.', 'jubari-theme' ); ?>
		</p>

		<div style="max-width: 480px; margin: 0 auto 2rem;">
			<?php get_search_form(); ?>
		</div>

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="jt-btn jt-btn--primary">
			<?php esc_html_e( 'العودة إلى الصفحة الرئيسية', 'jubari-theme' ); ?>
		</a>
	</div>
</section>

<?php
get_footer();