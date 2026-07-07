<?php
/**
 * Template Name: Home - SaaS Showcase
 *
 * @package DigiNova_Plus
 */

get_header(); ?>

<div id="content" class="site-content">
	<!-- Hero Section -->
	<?php get_template_part( 'template-parts/hero/hero', 'saas' ); ?>

	<!-- Featured Categories Section -->
	<section class="section-categories py-5 my-5">
		<div class="container text-center">
			<h2 class="mb-5"><?php esc_html_e( 'Browse by Category', 'diginovaplus' ); ?></h2>
			<div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4">
				<?php
				$categories = array(
					'WordPress' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mb-3 text-primary"><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zM5.352 17.29a9.664 9.664 0 0 1-1.28-4.646c0-1.895.545-3.664 1.487-5.163l4.316 11.968a9.652 9.652 0 0 1-4.523-2.16zM18.665 17.27a9.673 9.673 0 0 1-4.708 2.37V8.583L18.665 17.27zM11.666 4.086c-1.238 0-2.398.28-3.433.774l2.56 7.153L13.78 4.62c-.675-.345-1.428-.534-2.215-.534z"></path></svg>',
					'HTML' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mb-3 text-primary"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>',
					'Mobile' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mb-3 text-primary"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>',
					'Scripts' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mb-3 text-primary"><polyline points="4 7 4 4 20 4 20 7"></polyline><line x1="9" y1="20" x2="15" y2="20"></line><line x1="12" y1="4" x2="12" y2="20"></line></svg>',
					'Graphics' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mb-3 text-primary"><circle cx="12" cy="12" r="10"></circle><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path><path d="M2 12h20"></path></svg>',
					'SaaS' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mb-3 text-primary"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path></svg>',
				);
				foreach ( $categories as $name => $icon ) : ?>
					<div class="col">
						<a href="#" class="d-block p-4 rounded-4 bg-light text-decoration-none text-dark hover-lift transition-all">
							<?php echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<h6 class="mb-0 fw-semibold"><?php echo esc_html( $name ); ?></h6>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Placeholder for Featured Products Grid, How it Works, etc. -->
	<!-- We will flesh out the product loop in the Elementor widgets later, for now we add structure -->
	
	<section class="section-featured-products py-5 bg-light">
		<div class="container">
			<div class="d-flex justify-content-between align-items-end mb-5">
				<div>
					<h2 class="mb-2"><?php esc_html_e( 'Featured Products', 'diginovaplus' ); ?></h2>
					<p class="text-muted mb-0"><?php esc_html_e( 'Handpicked by our staff for exceptional quality.', 'diginovaplus' ); ?></p>
				</div>
				<a href="#" class="btn btn-outline-primary d-none d-md-inline-block"><?php esc_html_e( 'View All', 'diginovaplus' ); ?></a>
			</div>
			<!-- Grid will be injected here via Elementor / Widget -->
			<div class="text-center py-5 border border-dashed rounded-4">
				<p class="text-muted mb-0">[ Elementor Product Grid Widget Placeholder ]</p>
			</div>
		</div>
	</section>

	<!-- CTA Banner -->
	<section class="section-cta py-5 my-5">
		<div class="container">
			<div class="bg-primary text-white rounded-5 p-5 text-center position-relative overflow-hidden">
				<div class="position-relative z-2">
					<h2 class="display-5 fw-bold mb-3"><?php esc_html_e( 'Start Selling Today', 'diginovaplus' ); ?></h2>
					<p class="lead mb-4 opacity-75 max-w-75 mx-auto"><?php esc_html_e( 'Join 5,000+ authors making a living by selling digital products on our marketplace.', 'diginovaplus' ); ?></p>
					<a href="#" class="btn btn-light btn-lg px-5 py-3 fw-bold text-primary rounded-pill"><?php esc_html_e( 'Become an Author', 'diginovaplus' ); ?></a>
				</div>
				<!-- Deco circles -->
				<div class="position-absolute rounded-circle bg-white opacity-10" style="width: 300px; height: 300px; top: -100px; right: -50px;"></div>
				<div class="position-absolute rounded-circle bg-white opacity-10" style="width: 200px; height: 200px; bottom: -50px; left: 50px;"></div>
			</div>
		</div>
	</section>
</div><!-- #content -->

<?php get_footer(); ?>
