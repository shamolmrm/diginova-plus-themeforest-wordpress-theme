<?php
/**
 * Hero Section - SaaS Showcase
 *
 * @package DigiNova_Plus
 */
?>
<section class="hero-section hero-saas d-flex align-items-center position-relative overflow-hidden bg-primary text-white">
	<div class="container z-2 position-relative">
		<div class="row align-items-center">
			<div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
				<h1 class="display-4 fw-bold mb-4 text-white"><?php esc_html_e( 'The #1 Marketplace for Digital Products', 'diginovaplus' ); ?></h1>
				<p class="lead mb-5 opacity-75"><?php esc_html_e( 'Discover premium WordPress themes, plugins, mobile apps, and SaaS templates crafted by world-class developers.', 'diginovaplus' ); ?></p>
				
				<div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start mb-5">
					<a href="<?php echo esc_url( get_post_type_archive_link( 'diginovaplus_products' ) ); ?>" class="btn btn-light btn-lg px-4 py-3 fw-semibold text-primary">
						<?php esc_html_e( 'Browse Products', 'diginovaplus' ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/vendor-dashboard' ) ); ?>" class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold">
						<?php esc_html_e( 'Sell Your Products', 'diginovaplus' ); ?>
					</a>
				</div>

				<div class="hero-stats row text-center text-lg-start">
					<div class="col-sm-4 mb-3 mb-sm-0">
						<h3 class="h2 fw-bold mb-1">10k+</h3>
						<span class="text-white-50 small text-uppercase tracking-wide"><?php esc_html_e( 'Products', 'diginovaplus' ); ?></span>
					</div>
					<div class="col-sm-4 mb-3 mb-sm-0 border-start border-white-10">
						<h3 class="h2 fw-bold mb-1">50k+</h3>
						<span class="text-white-50 small text-uppercase tracking-wide"><?php esc_html_e( 'Happy Buyers', 'diginovaplus' ); ?></span>
					</div>
					<div class="col-sm-4 border-start border-white-10">
						<h3 class="h2 fw-bold mb-1">5k+</h3>
						<span class="text-white-50 small text-uppercase tracking-wide"><?php esc_html_e( 'Sellers', 'diginovaplus' ); ?></span>
					</div>
				</div>
			</div>
			
			<div class="col-lg-6 position-relative">
				<div class="hero-image-wrapper">
					<!-- SVG Placeholder for Hero Mockup -->
					<svg class="img-fluid w-100 rounded-4 shadow-lg bg-white" viewBox="0 0 800 600" xmlns="http://www.w3.org/2000/svg">
						<rect width="800" height="600" fill="#f8f9fa"/>
						<rect x="0" y="0" width="800" height="40" fill="#e9ecef"/>
						<circle cx="20" cy="20" r="6" fill="#ff5f56"/>
						<circle cx="40" cy="20" r="6" fill="#ffbd2e"/>
						<circle cx="60" cy="20" r="6" fill="#27c93f"/>
						<text x="400" y="300" font-family="sans-serif" font-size="24" fill="#adb5bd" text-anchor="middle">Software/SaaS Interface Mockup Placeholder</text>
					</svg>
				</div>
			</div>
		</div>
	</div>

	<!-- Background Decoration -->
	<div class="position-absolute top-0 end-0 w-100 h-100 overflow-hidden z-1" style="pointer-events: none;">
		<div class="position-absolute rounded-circle" style="width: 600px; height: 600px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%); top: -200px; right: -100px;"></div>
		<div class="position-absolute rounded-circle" style="width: 400px; height: 400px; background: radial-gradient(circle, rgba(255,107,107,0.2) 0%, rgba(255,107,107,0) 70%); bottom: -100px; left: -100px;"></div>
	</div>
</section>
