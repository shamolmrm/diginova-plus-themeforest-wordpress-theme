<?php
/**
 * Template Name: Products Directory
 *
 * @package DigiNova_Plus
 */

get_header(); ?>

<div class="products-directory-page py-5 bg-light min-vh-100">
	<div class="container">
		
		<div class="page-header mb-5 text-center text-md-start">
			<h1 class="display-5 fw-bold mb-3"><?php the_title(); ?></h1>
			<div class="lead text-muted max-w-75">
				<?php the_content(); ?>
			</div>
		</div>

		<div class="row">
			<!-- Sidebar Filters -->
			<div class="col-lg-3 mb-5 mb-lg-0">
				<aside class="products-sidebar sticky-top" style="top: 100px; z-index: 1;">
					<div class="filter-widget bg-white rounded-4 shadow-sm p-4 mb-4">
						<div class="d-flex justify-content-between align-items-center mb-4">
							<h4 class="mb-0 fs-5 fw-bold"><?php esc_html_e( 'Filters', 'diginovaplus' ); ?></h4>
							<button type="button" class="btn btn-link btn-sm text-muted text-decoration-none p-0 clear-all-filters"><?php esc_html_e( 'Clear All', 'diginovaplus' ); ?></button>
						</div>

						<form id="products-filter-form" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
							<?php wp_nonce_field( 'diginovaplus-nonce', 'security' ); ?>
							<input type="hidden" name="action" value="diginovaplus_filter_products">
							<input type="hidden" name="paged" id="filter-paged" value="1">
							<input type="hidden" name="view_mode" id="filter-view-mode" value="grid">
							
							<!-- Search -->
							<div class="filter-group mb-4">
								<div class="input-group">
									<input type="text" name="search" class="form-control" placeholder="<?php esc_attr_e( 'Search products...', 'diginovaplus' ); ?>">
									<button class="btn btn-outline-secondary" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
								</div>
							</div>

							<!-- Category Filter -->
							<div class="filter-group mb-4">
								<h5 class="filter-title fs-6 fw-semibold mb-3"><?php esc_html_e( 'Category', 'diginovaplus' ); ?></h5>
								<div class="filter-options max-h-200 overflow-auto pe-2 custom-scrollbar">
									<?php
									$categories = get_terms( array( 'taxonomy' => 'diginovaplus_category', 'hide_empty' => false ) );
									if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
										foreach ( $categories as $cat ) {
											echo '<div class="form-check mb-2">';
											echo '<input class="form-check-input filter-checkbox" type="checkbox" name="categories[]" value="' . esc_attr( $cat->slug ) . '" id="cat-' . esc_attr( $cat->term_id ) . '">';
											echo '<label class="form-check-label text-muted" for="cat-' . esc_attr( $cat->term_id ) . '">' . esc_html( $cat->name ) . ' <span class="small opacity-50">(' . esc_html( $cat->count ) . ')</span></label>';
											echo '</div>';
										}
									}
									?>
								</div>
							</div>

							<!-- Software Type Filter -->
							<div class="filter-group mb-4">
								<h5 class="filter-title fs-6 fw-semibold mb-3"><?php esc_html_e( 'Software Type', 'diginovaplus' ); ?></h5>
								<div class="filter-options">
									<?php
									$types = get_terms( array( 'taxonomy' => 'diginovaplus_software_type', 'hide_empty' => false ) );
									if ( ! is_wp_error( $types ) && ! empty( $types ) ) {
										foreach ( $types as $type ) {
											echo '<div class="form-check mb-2">';
											echo '<input class="form-check-input filter-checkbox" type="checkbox" name="types[]" value="' . esc_attr( $type->slug ) . '" id="type-' . esc_attr( $type->term_id ) . '">';
											echo '<label class="form-check-label text-muted" for="type-' . esc_attr( $type->term_id ) . '">' . esc_html( $type->name ) . '</label>';
											echo '</div>';
										}
									}
									?>
								</div>
							</div>

							<!-- Price Range Filter (Placeholder for UI, actual slider needs JS library like noUiSlider) -->
							<div class="filter-group mb-4">
								<h5 class="filter-title fs-6 fw-semibold mb-3"><?php esc_html_e( 'Price Range', 'diginovaplus' ); ?></h5>
								<div class="d-flex align-items-center gap-2">
									<input type="number" class="form-control form-control-sm price-input" name="min_price" placeholder="Min $">
									<span class="text-muted">-</span>
									<input type="number" class="form-control form-control-sm price-input" name="max_price" placeholder="Max $">
								</div>
							</div>

							<!-- Rating Filter -->
							<div class="filter-group mb-0">
								<h5 class="filter-title fs-6 fw-semibold mb-3"><?php esc_html_e( 'Rating', 'diginovaplus' ); ?></h5>
								<div class="form-check mb-2">
									<input class="form-check-input filter-radio" type="radio" name="rating" value="4" id="rating-4">
									<label class="form-check-label text-warning" for="rating-4">
										★ ★ ★ ★ ☆ <span class="text-muted small">& Up</span>
									</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input filter-radio" type="radio" name="rating" value="3" id="rating-3">
									<label class="form-check-label text-warning" for="rating-3">
										★ ★ ★ ☆ ☆ <span class="text-muted small">& Up</span>
									</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input filter-radio" type="radio" name="rating" value="" id="rating-any" checked>
									<label class="form-check-label text-muted" for="rating-any"><?php esc_html_e( 'Any Rating', 'diginovaplus' ); ?></label>
								</div>
							</div>
						</form>
					</div>
				</aside>
			</div>

			<!-- Main Content -->
			<div class="col-lg-9">
				<div class="products-toolbar d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom">
					<div class="results-count text-muted mb-3 mb-md-0">
						<?php esc_html_e( 'Loading products...', 'diginovaplus' ); ?>
					</div>
					
					<div class="toolbar-actions d-flex align-items-center gap-3">
						<div class="sort-by d-flex align-items-center gap-2">
							<label for="sort-dropdown" class="text-muted text-nowrap mb-0 small fw-medium"><?php esc_html_e( 'Sort by:', 'diginovaplus' ); ?></label>
							<select id="sort-dropdown" class="form-select form-select-sm border-0 bg-white shadow-sm fw-medium" form="products-filter-form" name="orderby">
								<option value="newest"><?php esc_html_e( 'Newest First', 'diginovaplus' ); ?></option>
								<option value="popular"><?php esc_html_e( 'Best Selling', 'diginovaplus' ); ?></option>
								<option value="rating"><?php esc_html_e( 'Top Rated', 'diginovaplus' ); ?></option>
								<option value="price_low"><?php esc_html_e( 'Price: Low to High', 'diginovaplus' ); ?></option>
								<option value="price_high"><?php esc_html_e( 'Price: High to Low', 'diginovaplus' ); ?></option>
							</select>
						</div>

						<div class="view-toggle bg-white rounded-2 shadow-sm p-1 d-none d-md-flex">
							<button type="button" class="btn btn-sm btn-light active view-btn" data-view="grid" aria-label="<?php esc_attr_e( 'Grid View', 'diginovaplus' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
							</button>
							<button type="button" class="btn btn-sm btn-white view-btn text-muted" data-view="list" aria-label="<?php esc_attr_e( 'List View', 'diginovaplus' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
							</button>
						</div>
					</div>
				</div>

				<div class="products-archive-wrapper position-relative">
					<div class="ajax-loading-overlay position-absolute w-100 h-100 bg-light bg-opacity-75 z-2 d-none justify-content-center pt-5">
						<div class="spinner-border text-primary" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>

					<div id="products-grid" class="row g-4 view-grid">
						<!-- AJAX Products will be loaded here -->
					</div>

					<div class="pagination-wrapper mt-5 text-center">
						<button id="load-more-products" class="btn btn-primary rounded-pill px-5 py-2 fw-semibold d-none">
							<?php esc_html_e( 'Load More Products', 'diginovaplus' ); ?>
						</button>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
