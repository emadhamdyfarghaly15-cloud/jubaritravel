<?php
/**
 * Header topbar
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$phone   = function_exists( 'get_field' ) ? get_field( 'contact_phone', 'option' ) : '';
$email   = function_exists( 'get_field' ) ? get_field( 'contact_email', 'option' ) : '';
$facebook = function_exists( 'get_field' ) ? get_field( 'facebook_url', 'option' ) : '';
$instagram = function_exists( 'get_field' ) ? get_field( 'instagram_url', 'option' ) : '';
?>

<div class="site-topbar">
	<div class="container">
		<div class="site-topbar__inner">
			<div class="site-topbar__contact">
				<?php if ( $phone ) : ?>
					<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
				<?php endif; ?>

				<?php if ( $email ) : ?>
					<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
				<?php endif; ?>
			</div>

			<div class="site-topbar__social">
				<?php if ( $facebook ) : ?>
					<a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer">Facebook</a>
				<?php endif; ?>

				<?php if ( $instagram ) : ?>
					<a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener noreferrer">Instagram</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>