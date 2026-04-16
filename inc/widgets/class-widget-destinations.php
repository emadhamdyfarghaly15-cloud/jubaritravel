<?php
/**
 * Destinations widget
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Jubari_Widget_Destinations extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'jubari_widget_destinations',
			__( 'Jubari Destinations', 'jubari-theme' ),
			array(
				'description' => __( 'Displays recent destinations.', 'jubari-theme' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'وجهات سياحية', 'jubari-theme' );

		echo $args['before_widget'];
		echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

		$query = new WP_Query(
			array(
				'post_type'      => 'destination',
				'posts_per_page' => 5,
			)
		);

		if ( $query->have_posts() ) {
			echo '<ul class="jubari-widget-list">';

			while ( $query->have_posts() ) {
				$query->the_post();
				echo '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
			}

			echo '</ul>';
			wp_reset_postdata();
		}

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'jubari-theme' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
		return $instance;
	}
}