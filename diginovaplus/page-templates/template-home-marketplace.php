<?php
/**
 * Template Name: Home - Marketplace
 *
 * @package DigiNova_Plus
 */

get_header(); ?>

<div id="content" class="site-content">
	<!-- Marketplace Hero -->
	<?php get_template_part( 'template-parts/hero/hero', 'marketplace' ); ?>

	<!-- Trending Categories Horizontal Scroll Placeholder -->
	<section class="section-trending border-bottom py-4 bg-white">
		<div class="container">
			<div class="d-flex align-items-center justify-content-between overflow-auto text-nowrap pb-2 gap-4 hide-scrollbar">
				<span class="fw-bold text-dark pe-3 border-end"><?php esc_html_e( 'Trending Now:', 'diginovaplus' ); ?></span>
				<a href="#" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Admin Dashboards</a>
				<a href="#" class="btn btn-sm btn-outline-secondary rounded-pill px-3">WooCommerce Themes</a>
				<a href="#" class="btn btn-sm btn-outline-secondary rounded-pill px-3">UI Kits</a>
				<a href="#" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Elementor Templates</a>
				<a href="#" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Laravel Scripts</a>
			</div>
		</div>
	</section>

	<section class="section-new-arrivals py-5 mt-4">
		<div class="container">
			<h2 class="mb-4 text-center"><?php esc_html_e( 'New Arrivals', 'diginovaplus' ); ?></h2>
			<!-- Grid will be injected here via Elementor / Widget -->
			<div class="text-center py-5 border border-dashed rounded-4 bg-light">
				<p class="text-muted mb-0">[ Elementor Product Grid Widget Placeholder - 8 items, 4 cols ]</p>
			</div>
		</div>
	</section>

	<section class="section-flash-sale py-5 my-5 bg-dark text-white">
		<div class="container text-center">
			<span class="badge bg-danger mb-3 px-3 py-2 fs-6 rounded-pill text-uppercase tracking-wide"><?php esc_html_e( 'Flash Sale', 'diginovaplus' ); ?></span>
			<h2 class="display-5 fw-bold mb-3"><?php esc_html_e( '50% Off Top Premium Themes', 'diginovaplus' ); ?></h2>
			<p class="lead text-white-50 mb-5"><?php esc_html_e( 'Offer ends in:', 'diginovaplus' ); ?></p>
			
			<div class="countdown-timer d-flex justify-content-center gap-3 gap-md-4 mb-5">
				<div class="bg-white bg-opacity-10 rounded-3 p-3 min-w-100 text-center">
					<h3 class="display-4 fw-bold mb-0">02</h3>
					<span class="text-white-50 text-uppercase small">Days</span>
				</div>
				<div class="bg-white bg-opacity-10 rounded-3 p-3 min-w-100 text-center">
					<h3 class="display-4 fw-bold mb-0">15</h3>
					<span class="text-white-50 text-uppercase small">Hours</span>
				</div>
				<div class="bg-white bg-opacity-10 rounded-3 p-3 min-w-100 text-center">
					<h3 class="display-4 fw-bold mb-0">45</h3>
					<span class="text-white-50 text-uppercase small">Mins</span>
				</div>
			</div>
			
			<a href="#" class="btn btn-light btn-lg px-5 py-3 fw-bold text-dark rounded-pill"><?php esc_html_e( 'Shop the Sale', 'diginovaplus' ); ?></a>
		</div>
	</section>

</div><!-- #content -->

<?php get_footer(); ?>
