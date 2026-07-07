<?php
/**
 * Hero Section - Marketplace
 *
 * @package DigiNova_Plus
 */
?>
<section class="hero-section hero-marketplace py-5 bg-light position-relative">
	<div class="container text-center pt-5 pb-4 z-2 position-relative">
		<h1 class="display-3 fw-bold mb-3"><?php esc_html_e( 'Find the perfect digital product', 'diginovaplus' ); ?></h1>
		<p class="lead text-muted mb-5 max-w-75 mx-auto"><?php esc_html_e( 'Over 10,000 premium templates, plugins, and scripts ready for your next project.', 'diginovaplus' ); ?></p>
		
		<div class="search-form-wrapper mx-auto mb-4" style="max-width: 800px;">
			<form role="search" method="get" class="search-form bg-white rounded-pill p-2 shadow-lg d-flex align-items-center" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="dropdown category-dropdown border-end pe-2 d-none d-md-block">
					<select name="diginovaplus_category" class="form-select border-0 bg-transparent text-muted fw-medium" aria-label="<?php esc_attr_e( 'Select Category', 'diginovaplus' ); ?>">
						<option value=""><?php esc_html_e( 'All Categories', 'diginovaplus' ); ?></option>
						<?php
						$categories = get_terms( array(
							'taxonomy'   => 'diginovaplus_category',
							'hide_empty' => false,
						) );
						if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
							foreach ( $categories as $cat ) {
								echo '<option value="' . esc_attr( $cat->slug ) . '">' . esc_html( $cat->name ) . '</option>';
							}
						}
						?>
					</select>
				</div>
				<input type="search" class="form-control border-0 bg-transparent px-4 py-3 focus-ring-0 shadow-none fs-5" placeholder="<?php esc_attr_e( 'Search for templates, plugins, themes...', 'diginovaplus' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
				<input type="hidden" name="post_type" value="diginovaplus_products" />
				<button type="submit" class="btn btn-primary rounded-pill px-4 py-3 text-white fw-bold d-flex align-items-center gap-2">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
					<span class="d-none d-sm-inline"><?php esc_html_e( 'Search', 'diginovaplus' ); ?></span>
				</button>
			</form>
		</div>

		<div class="popular-searches small text-muted">
			<span class="fw-semibold me-2"><?php esc_html_e( 'Popular:', 'diginovaplus' ); ?></span>
			<a href="#" class="text-decoration-none me-2 text-primary">WordPress Plugin</a>, 
			<a href="#" class="text-decoration-none me-2 text-primary">React Template</a>, 
			<a href="#" class="text-decoration-none text-primary">Landing Page</a>
		</div>
	</div>

	<!-- Background Decoration -->
	<div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden z-1 bg-gradient-light" style="pointer-events: none;"></div>
</section>
