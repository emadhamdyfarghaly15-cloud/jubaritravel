<?php
/**
 * Trip pricing table
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id       = get_the_ID();
$pricing_rows  = function_exists( 'get_field' ) ? get_field( 'trip_pricing_rows', $post_id ) : array();
$currency_code = function_exists( 'get_field' ) ? get_field( 'trip_currency', $post_id ) : 'USD';

$display_currency = '$';
if ( 'EUR' === $currency_code ) {
	$display_currency = '€';
} elseif ( 'GBP' === $currency_code ) {
	$display_currency = '£';
} elseif ( 'SAR' === $currency_code ) {
	$display_currency = 'ر.س';
} elseif ( 'AED' === $currency_code ) {
	$display_currency = 'د.إ';
}

if ( empty( $pricing_rows ) || ! is_array( $pricing_rows ) ) {
	return;
}
?>

<section class="trip-pricing section-space-sm">
	<h2 class="section-title"><?php esc_html_e( 'الأسعار', 'jubari-theme' ); ?></h2>

	<div class="table-responsive">
		<table class="trip-pricing-table">
			<thead>
				<tr>
					<th><?php esc_html_e( 'الخيار', 'jubari-theme' ); ?></th>
					<th><?php esc_html_e( 'السعر', 'jubari-theme' ); ?></th>
					<th><?php esc_html_e( 'ملاحظات', 'jubari-theme' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $pricing_rows as $row ) : ?>
					<?php
					$label = ! empty( $row['label'] ) ? $row['label'] : '';
					$price = isset( $row['price'] ) ? $row['price'] : '';
					$notes = ! empty( $row['notes'] ) ? $row['notes'] : '';
					?>
					<tr>
						<td><?php echo esc_html( $label ); ?></td>
						<td>
							<?php
							if ( '' !== $price && null !== $price ) {
								echo esc_html( is_numeric( $price ) ? $display_currency . number_format_i18n( $price ) : $price );
							}
							?>
						</td>
						<td><?php echo esc_html( $notes ); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</section>