<?php
/**
 * Template Name: Home Creative
 *
 * @package DigiNova_Plus
 */

get_header(); ?>

<div id="content" class="site-content">
	<!-- Creative Hero -->
	<div class="hero-creative bg-dark text-white py-6 position-relative overflow-hidden">
		<!-- Abstract Background shapes -->
		<div class="position-absolute top-0 start-0 w-100 h-100 opacity-25" style="background: radial-gradient(circle at 80% 20%, var(--bs-primary) 0%, transparent 40%);"></div>
		
		<div class="container py-5 py-md-6 position-relative z-2">
			<div class="row justify-content-center text-center">
				<div class="col-lg-9 col-xl-8">
					<div class="badge bg-white text-dark rounded-pill px-3 py-2 fw-medium mb-4 animate-on-scroll" data-animation="animate-fade-in-up">
						✨ <?php esc_html_e( 'The Ultimate Digital Canvas', 'diginovaplus' ); ?>
					</div>
					<h1 class="display-3 fw-bold mb-4 animate-on-scroll delay-100" data-animation="animate-fade-in-up">
						<?php esc_html_e( 'Empower Your Creative Journey.', 'diginovaplus' ); ?>
					</h1>
					<p class="lead mb-5 text-white-50 px-md-5 animate-on-scroll delay-200" data-animation="animate-fade-in-up">
						<?php esc_html_e( 'Discover thousands of premium UI kits, graphics, fonts, and themes crafted by world-class creators.', 'diginovaplus' ); ?>
					</p>
					
					<div class="d-flex flex-wrap justify-content-center gap-3 animate-on-scroll delay-300" data-animation="animate-fade-in-up">
						<a href="<?php echo esc_url( get_post_type_archive_link( 'diginovaplus_products' ) ); ?>" class="btn btn-primary btn-lg rounded-pill px-5 fw-medium shadow-lg hover-lift">
							<?php esc_html_e( 'Explore Assets', 'diginovaplus' ); ?>
						</a>
						<a href="#" class="btn btn-outline-light btn-lg rounded-pill px-5 fw-medium hover-lift">
							<?php esc_html_e( 'Become an Author', 'diginovaplus' ); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Main Page Content (Elementor compatible) -->
	<div class="container py-5 my-4">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>
</div>

<?php get_footer(); ?>
