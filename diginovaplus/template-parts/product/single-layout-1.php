<?php
/**
 * Single Product Layout 1 (Standard)
 *
 * @package DigiNova_Plus
 */

$product_id = get_the_ID();
$price = get_post_meta( $product_id, '_diginovaplus_regular_price', true );
$sales = get_post_meta( $product_id, '_diginovaplus_sales_count', true );
$rating = get_post_meta( $product_id, '_diginovaplus_average_rating', true );
$review_count = get_post_meta( $product_id, '_diginovaplus_review_count', true );
$demo_url = get_post_meta( $product_id, '_diginovaplus_demo_url', true );
$version = get_post_meta( $product_id, '_diginovaplus_version', true );
$last_update = get_post_meta( $product_id, '_diginovaplus_last_update', true );
?>

<!-- Product Header -->
<div class="product-header bg-white border-bottom py-4 py-md-5 mb-5">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-8">
				<?php
				$categories = get_the_terms( $product_id, 'diginovaplus_category' );
				if ( $categories && ! is_wp_error( $categories ) ) {
					echo '<div class="product-categories mb-3">';
					foreach ( $categories as $cat ) {
						echo '<a href="' . esc_url( get_term_link( $cat ) ) . '" class="badge bg-light text-dark border text-decoration-none me-2">' . esc_html( $cat->name ) . '</a>';
					}
					echo '</div>';
				}
				?>
				<h1 class="display-5 fw-bold mb-3"><?php the_title(); ?></h1>
				<div class="product-meta d-flex flex-wrap align-items-center gap-4 text-muted">
					<div class="author-meta d-flex align-items-center gap-2">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 32, '', '', array( 'class' => 'rounded-circle' ) ); ?>
						<span><?php esc_html_e( 'by', 'diginovaplus' ); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="text-dark fw-medium text-decoration-none hover-text-primary"><?php the_author(); ?></a></span>
					</div>
					
					<div class="rating-meta d-flex align-items-center gap-2" title="<?php echo esc_attr( $rating ? $rating . '/5' : __( 'No ratings yet', 'diginovaplus' ) ); ?>">
						<div class="text-warning">
							<?php
							$rating_val = $rating ? floatval( $rating ) : 0;
							for ( $i = 1; $i <= 5; $i++ ) {
								if ( $i <= $rating_val ) echo '★';
								elseif ( $i - 0.5 <= $rating_val ) echo '⯨'; // Half star roughly
								else echo '☆';
							}
							?>
						</div>
						<span>(<?php echo esc_html( $review_count ? $review_count : 0 ); ?> <?php esc_html_e( 'Reviews', 'diginovaplus' ); ?>)</span>
					</div>

					<div class="sales-meta d-flex align-items-center gap-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
						<span><?php echo esc_html( $sales ? number_format_i18n( $sales ) : 0 ); ?> <?php esc_html_e( 'Sales', 'diginovaplus' ); ?></span>
					</div>
				</div>
			</div>
			
			<div class="col-lg-4 mt-4 mt-lg-0 text-lg-end">
				<?php if ( $price ) : ?>
					<div class="display-6 fw-bold text-primary mb-3">$<?php echo esc_html( $price ); ?></div>
				<?php else : ?>
					<div class="display-6 fw-bold text-success mb-3"><?php esc_html_e( 'Free', 'diginovaplus' ); ?></div>
				<?php endif; ?>

				<div class="d-flex flex-column flex-sm-row gap-2 justify-content-lg-end">
					<?php if ( $demo_url ) : ?>
						<a href="<?php echo esc_url( home_url( '/live-preview/?demo_url=' . urlencode( $demo_url ) . '&id=' . $product_id ) ); ?>" target="_blank" class="btn btn-outline-secondary btn-lg fw-semibold rounded-pill px-4">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
							<?php esc_html_e( 'Live Preview', 'diginovaplus' ); ?>
						</a>
					<?php endif; ?>
					
					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						<a href="?add-to-cart=<?php echo absint( $product_id ); ?>" class="btn btn-primary btn-lg fw-semibold rounded-pill px-4 d-flex align-items-center justify-content-center">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
							<?php esc_html_e( 'Add to Cart', 'diginovaplus' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<!-- Main Content Area -->
		<div class="col-lg-8">
			<!-- Product Gallery / Image -->
			<div class="product-gallery mb-5 rounded-4 overflow-hidden shadow-sm bg-white">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid w-100' ) ); ?>
				<?php else : ?>
					<div class="ratio ratio-16x9 bg-light d-flex align-items-center justify-content-center text-muted">
						<span><?php esc_html_e( 'No Image Available', 'diginovaplus' ); ?></span>
					</div>
				<?php endif; ?>
			</div>

			<!-- Product Tabs -->
			<div class="product-tabs bg-white rounded-4 shadow-sm p-4 p-md-5 mb-5 mb-lg-0">
				<ul class="nav nav-tabs nav-tabs-custom mb-4 border-bottom-0 gap-2" id="productTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active rounded-pill fw-medium px-4 py-2" id="description-tab" data-bs-toggle="tab" data-bs-target="#description-tab-pane" type="button" role="tab" aria-controls="description-tab-pane" aria-selected="true"><?php esc_html_e( 'Item Details', 'diginovaplus' ); ?></button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link rounded-pill fw-medium px-4 py-2" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-tab-pane" type="button" role="tab" aria-controls="reviews-tab-pane" aria-selected="false"><?php esc_html_e( 'Reviews', 'diginovaplus' ); ?> <span class="badge bg-secondary ms-1"><?php echo esc_html( $review_count ? $review_count : 0 ); ?></span></button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link rounded-pill fw-medium px-4 py-2" id="changelog-tab" data-bs-toggle="tab" data-bs-target="#changelog-tab-pane" type="button" role="tab" aria-controls="changelog-tab-pane" aria-selected="false"><?php esc_html_e( 'Changelog', 'diginovaplus' ); ?></button>
					</li>
				</ul>
				<div class="tab-content" id="productTabContent">
					<div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel" aria-labelledby="description-tab" tabindex="0">
						<?php get_template_part( 'template-parts/product/tabs/description' ); ?>
					</div>
					<div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">
						<?php get_template_part( 'template-parts/product/tabs/reviews' ); ?>
					</div>
					<div class="tab-pane fade" id="changelog-tab-pane" role="tabpanel" aria-labelledby="changelog-tab" tabindex="0">
						<?php get_template_part( 'template-parts/product/tabs/changelog' ); ?>
					</div>
				</div>
			</div>
		</div>

		<!-- Sidebar Area -->
		<div class="col-lg-4">
			<aside class="product-sidebar sticky-top" style="top: 100px; z-index: 1;">
				
				<!-- Purchase Widget (Desktop) -->
				<div class="widget purchase-widget bg-white rounded-4 shadow-sm p-4 mb-4 d-none d-lg-block border border-primary border-opacity-10">
					<h3 class="h5 fw-bold border-bottom pb-3 mb-4"><?php esc_html_e( 'License', 'diginovaplus' ); ?></h3>
					
					<div class="license-type mb-4">
						<div class="form-check custom-radio mb-3 p-3 border rounded-3 border-primary bg-primary bg-opacity-10 cursor-pointer">
							<input class="form-check-input ms-0 mt-1" type="radio" name="license" id="regular-license" checked>
							<label class="form-check-label ms-2 w-100 cursor-pointer" for="regular-license">
								<div class="d-flex justify-content-between align-items-center mb-1">
									<span class="fw-bold text-dark"><?php esc_html_e( 'Regular License', 'diginovaplus' ); ?></span>
									<span class="fs-5 fw-bold text-primary">$<?php echo esc_html( $price ); ?></span>
								</div>
								<div class="small text-muted"><?php esc_html_e( 'Use, by you or one client, in a single end product which end users are not charged for.', 'diginovaplus' ); ?></div>
							</label>
						</div>
					</div>

					<ul class="list-unstyled mb-4 small text-muted">
						<li class="mb-2 d-flex gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-success flex-shrink-0 mt-1"><polyline points="20 6 9 17 4 12"></polyline></svg> <?php esc_html_e( 'Quality checked by Envato', 'diginovaplus' ); ?></li>
						<li class="mb-2 d-flex gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-success flex-shrink-0 mt-1"><polyline points="20 6 9 17 4 12"></polyline></svg> <?php esc_html_e( 'Future updates', 'diginovaplus' ); ?></li>
						<li class="mb-2 d-flex gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-success flex-shrink-0 mt-1"><polyline points="20 6 9 17 4 12"></polyline></svg> <?php esc_html_e( '6 months support from author', 'diginovaplus' ); ?></li>
					</ul>

					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						<a href="?add-to-cart=<?php echo absint( $product_id ); ?>" class="btn btn-primary btn-lg w-100 fw-semibold rounded-pill d-flex align-items-center justify-content-center mb-3 shadow-sm hover-lift">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
							<?php esc_html_e( 'Add to Cart', 'diginovaplus' ); ?>
						</a>
					<?php endif; ?>

					<button class="btn btn-outline-secondary w-100 fw-medium rounded-pill d-flex align-items-center justify-content-center">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
						<?php esc_html_e( 'Add to Wishlist', 'diginovaplus' ); ?>
					</button>
				</div>

				<!-- Item Info Widget -->
				<div class="widget item-info-widget bg-white rounded-4 shadow-sm p-4 mb-4">
					<h3 class="h6 fw-bold border-bottom pb-3 mb-3"><?php esc_html_e( 'Item Information', 'diginovaplus' ); ?></h3>
					<ul class="list-unstyled mb-0 item-meta-list small">
						<?php if ( $last_update ) : ?>
						<li class="d-flex justify-content-between py-2 border-bottom border-light">
							<span class="text-muted"><?php esc_html_e( 'Last Update', 'diginovaplus' ); ?></span>
							<span class="fw-medium text-dark"><?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $last_update ) ) ); ?></span>
						</li>
						<?php endif; ?>
						
						<li class="d-flex justify-content-between py-2 border-bottom border-light">
							<span class="text-muted"><?php esc_html_e( 'Published', 'diginovaplus' ); ?></span>
							<span class="fw-medium text-dark"><?php echo esc_html( get_the_date() ); ?></span>
						</li>
						
						<?php if ( $version ) : ?>
						<li class="d-flex justify-content-between py-2 border-bottom border-light">
							<span class="text-muted"><?php esc_html_e( 'Version', 'diginovaplus' ); ?></span>
							<span class="fw-medium text-dark"><?php echo esc_html( $version ); ?></span>
						</li>
						<?php endif; ?>
						
						<li class="py-3 mt-2">
							<span class="d-block text-muted mb-2"><?php esc_html_e( 'Tags', 'diginovaplus' ); ?></span>
							<div class="d-flex flex-wrap gap-1">
								<?php
								$tags = get_the_terms( $product_id, 'diginovaplus_tag' );
								if ( $tags && ! is_wp_error( $tags ) ) {
									foreach ( $tags as $tag ) {
										echo '<a href="' . esc_url( get_term_link( $tag ) ) . '" class="badge bg-light text-muted border text-decoration-none fw-normal hover-bg-primary hover-text-white transition-all">' . esc_html( $tag->name ) . '</a>';
									}
								} else {
									echo '<span class="text-muted small">' . esc_html__( 'No tags', 'diginovaplus' ) . '</span>';
								}
								?>
							</div>
						</li>
					</ul>
				</div>
			</aside>
		</div>
	</div>
</div>
