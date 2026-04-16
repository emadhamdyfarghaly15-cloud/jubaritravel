<?php
/**
 * Theme Header
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$company_phone = jubari_get_option( 'company_phone', jubari_get_option( 'contact_phone' ) );
$company_email = jubari_get_option( 'company_email', jubari_get_option( 'contact_email' ) );

$social_links = array(
	'social_facebook'  => array(
		'label' => 'Facebook',
		'icon'  => 'star',
	),
	'social_instagram' => array(
		'label' => 'Instagram',
		'icon'  => 'star',
	),
	'social_twitter'   => array(
		'label' => 'Twitter',
		'icon'  => 'star',
	),
	'social_youtube'   => array(
		'label' => 'YouTube',
		'icon'  => 'star',
	),
);

$booking_page_url = home_url( '/booking/' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="<?php echo esc_attr( is_rtl() ? 'rtl' : 'ltr' ); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main-content">
	<?php esc_html_e( 'الانتقال إلى المحتوى', 'jubari-theme' ); ?>
</a>

<div class="jt-topbar">
	<div class="jt-container">
		<div class="jt-topbar__inner">
			<div class="jt-topbar__contact">
				<?php if ( $company_phone ) : ?>
					<a href="<?php echo esc_url( jubari_get_phone_link( $company_phone ) ); ?>" class="jt-topbar__item">
						<?php echo jubari_get_icon( 'phone', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span><?php echo esc_html( $company_phone ); ?></span>
					</a>
				<?php endif; ?>

				<?php if ( $company_email ) : ?>
					<a href="mailto:<?php echo antispambot( esc_attr( $company_email ) ); ?>" class="jt-topbar__item">
						<?php echo jubari_get_icon( 'mail', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span><?php echo esc_html( antispambot( $company_email ) ); ?></span>
					</a>
				<?php endif; ?>
			</div>

			<div class="jt-topbar__end">
				<div class="jt-topbar__social">
					<?php foreach ( $social_links as $field_name => $social_data ) : ?>
						<?php $url = jubari_get_option( $field_name ); ?>
						<?php if ( $url ) : ?>
							<a
								href="<?php echo esc_url( $url ); ?>"
								target="_blank"
								rel="noopener noreferrer"
								aria-label="<?php echo esc_attr( $social_data['label'] ); ?>"
							>
								<?php echo jubari_get_icon( $social_data['icon'], 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</a>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>

				<?php if ( function_exists( 'pll_the_languages' ) ) : ?>
					<div class="jt-topbar__lang">
						<?php
						pll_the_languages(
							array(
								'show_flags' => 1,
								'show_names' => 1,
								'dropdown'   => 0,
							)
						);
						?>
					</div>
				<?php elseif ( function_exists( 'icl_get_languages' ) ) : ?>
					<div class="jt-topbar__lang">
						<?php
						$languages = icl_get_languages( 'skip_missing=0' );

						if ( ! empty( $languages ) ) :
							foreach ( $languages as $lang ) :
								?>
								<a
									href="<?php echo esc_url( $lang['url'] ); ?>"
									class="<?php echo ! empty( $lang['active'] ) ? 'active' : ''; ?>"
								>
									<?php echo esc_html( $lang['native_name'] ); ?>
								</a>
								<?php
							endforeach;
						endif;
						?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<header class="jt-header" id="site-header" role="banner">
	<div class="jt-container">
		<div class="jt-header__inner">
			<div class="jt-header__logo">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="jt-header__site-title" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				<?php endif; ?>
			</div>

			<nav class="jt-nav" id="site-navigation" aria-label="<?php esc_attr_e( 'القائمة الرئيسية', 'jubari-theme' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_class'     => 'jt-nav__list',
						'container'      => false,
						'fallback_cb'    => false,
						'depth'          => 3,
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'walker'         => class_exists( 'Jubari_Walker_Nav_Primary' ) ? new Jubari_Walker_Nav_Primary() : null,
					)
				);
				?>
			</nav>

			<div class="jt-header__actions">
				<a href="<?php echo esc_url( $booking_page_url ); ?>" class="jt-btn jt-btn--primary jt-btn--sm">
					<?php esc_html_e( 'احجز رحلتك', 'jubari-theme' ); ?>
				</a>

				<button
					class="jt-header__menu-toggle"
					id="menu-toggle"
					type="button"
					aria-controls="mobile-menu"
					aria-expanded="false"
					aria-label="<?php esc_attr_e( 'فتح القائمة', 'jubari-theme' ); ?>"
				>
					<span class="jt-hamburger" aria-hidden="true">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</button>
			</div>
		</div>
	</div>
</header>

<div class="jt-mobile-menu" id="mobile-menu" aria-hidden="true" hidden>
	<div class="jt-mobile-menu__overlay" data-close-menu></div>

	<div class="jt-mobile-menu__panel">
		<div class="jt-mobile-menu__header">
			<div class="jt-mobile-menu__branding">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<span class="jt-mobile-menu__title"><?php bloginfo( 'name' ); ?></span>
				<?php endif; ?>
			</div>

			<button
				class="jt-mobile-menu__close"
				type="button"
				data-close-menu
				aria-label="<?php esc_attr_e( 'إغلاق القائمة', 'jubari-theme' ); ?>"
			>
				&times;
			</button>
		</div>

		<nav class="jt-mobile-menu__nav" aria-label="<?php esc_attr_e( 'قائمة الجوال', 'jubari-theme' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => has_nav_menu( 'mobile' ) ? 'mobile' : 'primary',
					'menu_class'     => 'jt-mobile-menu__list',
					'container'      => false,
					'fallback_cb'    => 'wp_page_menu',
					'depth'          => 2,
				)
			);
			?>
		</nav>

		<div class="jt-mobile-menu__cta">
			<a href="<?php echo esc_url( $booking_page_url ); ?>" class="jt-btn jt-btn--primary jt-btn--block">
				<?php esc_html_e( 'احجز رحلتك', 'jubari-theme' ); ?>
			</a>
		</div>
	</div>
</div>

<main id="main-content" class="jt-main" role="main">