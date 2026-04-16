<?php
/**
 * Template Name: About Page
 *
 * @package JubariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$about_intro_title   = function_exists( 'get_field' ) ? get_field( 'about_intro_title' ) : '';
$about_intro_text    = function_exists( 'get_field' ) ? get_field( 'about_intro_text' ) : '';
$about_vision_title  = function_exists( 'get_field' ) ? get_field( 'about_vision_title' ) : '';
$about_vision_text   = function_exists( 'get_field' ) ? get_field( 'about_vision_text' ) : '';
$about_mission_title = function_exists( 'get_field' ) ? get_field( 'about_mission_title' ) : '';
$about_mission_text  = function_exists( 'get_field' ) ? get_field( 'about_mission_text' ) : '';
$about_values        = function_exists( 'get_field' ) ? get_field( 'about_values' ) : array();
?>

<main id="primary" class="site-main page-about">
	<section class="page-hero page-hero--inner">
		<div class="container">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</section>

	<section class="about-intro section-space">
		<div class="container">
			<div class="section-heading">
				<h2><?php echo esc_html( $about_intro_title ? $about_intro_title : get_the_title() ); ?></h2>
			</div>

			<div class="section-content">
				<?php if ( $about_intro_text ) : ?>
					<p><?php echo wp_kses_post( $about_intro_text ); ?></p>
				<?php else : ?>
					<?php
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
					?>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="about-grid section-space section-muted">
		<div class="container">
			<div class="about-grid__columns">
				<div class="about-card">
					<h3><?php echo esc_html( $about_vision_title ? $about_vision_title : __( 'رؤيتنا', 'jubari-theme' ) ); ?></h3>
					<p><?php echo wp_kses_post( $about_vision_text ? $about_vision_text : __( 'نطمح لتقديم تجربة سفر متميزة وآمنة ومريحة لعملائنا في كل وجهة.', 'jubari-theme' ) ); ?></p>
				</div>

				<div class="about-card">
					<h3><?php echo esc_html( $about_mission_title ? $about_mission_title : __( 'رسالتنا', 'jubari-theme' ) ); ?></h3>
					<p><?php echo wp_kses_post( $about_mission_text ? $about_mission_text : __( 'نقدم خدمات سياحية متكاملة تجمع بين الجودة، الاحترافية، والاهتمام بالتفاصيل.', 'jubari-theme' ) ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<?php if ( ! empty( $about_values ) && is_array( $about_values ) ) : ?>
		<section class="about-values section-space">
			<div class="container">
				<div class="section-heading">
					<h2><?php esc_html_e( 'قيمنا', 'jubari-theme' ); ?></h2>
				</div>

				<div class="about-values__grid">
					<?php foreach ( $about_values as $value ) : ?>
						<div class="value-card">
							<?php if ( ! empty( $value['title'] ) ) : ?>
								<h3><?php echo esc_html( $value['title'] ); ?></h3>
							<?php endif; ?>

							<?php if ( ! empty( $value['text'] ) ) : ?>
								<p><?php echo wp_kses_post( $value['text'] ); ?></p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/sections/testimonials' ); ?>
	<?php get_template_part( 'template-parts/sections/cta', 'banner' ); ?>
</main>

<?php
get_footer();