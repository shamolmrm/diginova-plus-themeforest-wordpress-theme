<?php
/**
 * Product Card - List View
 *
 * @package DigiNova_Plus
 */

$product_id = get_the_ID();
$price = get_post_meta( $product_id, '_diginovaplus_regular_price', true );
$sales = get_post_meta( $product_id, '_diginovaplus_sales_count', true );
$rating = get_post_meta( $product_id, '_diginovaplus_average_rating', true );
$review_count = get_post_meta( $product_id, '_diginovaplus_review_count', true );
$demo_url = get_post_meta( $product_id, '_diginovaplus_demo_url', true );

$categories = get_the_terms( $product_id, 'diginovaplus_category' );
$primary_cat = ( $categories && ! is_wp_error( $categories ) ) ? $categories[0]->name : '';

$badges = array();
if ( $sales > 1000 ) $badges[] = array( 'label' => 'Trending', 'class' => 'bg-warning text-dark' );
elseif ( get_the_date('U') > strtotime('-30 days') ) $badges[] = array( 'label' => 'New', 'class' => 'bg-success' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'product-card-list card border-0 shadow-sm rounded-4 overflow-hidden mb-3 transition-all hover-lift' ); ?>>
	<div class="row g-0">
		<div class="col-md-4 col-lg-3 position-relative">
			<div class="h-100 bg-light position-relative overflow-hidden ratio ratio-16x9 ratio-md-1x1">
				<a href="<?php the_permalink(); ?>" class="d-block w-100 h-100">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'diginovaplus-product-thumb', array( 'class' => 'object-fit-cover w-100 h-100' ) ); ?>
					<?php else : ?>
						<div class="d-flex align-items-center justify-content-center h-100 w-100 bg-secondary bg-opacity-10 text-muted">
							<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
						</div>
					<?php endif; ?>
				</a>
				
				<?php if ( $primary_cat ) : ?>
					<div class="position-absolute bottom-0 start-0 p-2 z-2">
						<span class="badge bg-dark bg-opacity-75 text-white backdrop-blur"><?php echo esc_html( $primary_cat ); ?></span>
					</div>
				<?php endif; ?>
			</div>
		</div>
		
		<div class="col-md-8 col-lg-9">
			<div class="card-body p-4 d-flex flex-column h-100">
				<div class="d-flex justify-content-between align-items-start mb-2">
					<div>
						<div class="d-flex align-items-center mb-1 gap-2">
							<span class="text-muted small"><?php esc_html_e( 'by', 'diginovaplus' ); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="text-dark fw-medium text-decoration-none hover-text-primary"><?php the_author(); ?></a></span>
							<?php foreach ( $badges as $badge ) : ?>
								<span class="badge <?php echo esc_attr( $badge['class'] ); ?> shadow-sm lh-1 py-1 px-2"><?php echo esc_html( $badge['label'] ); ?></span>
							<?php endforeach; ?>
						</div>
						<h3 class="card-title h4 fw-bold mb-2">
							<a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-text-primary"><?php the_title(); ?></a>
						</h3>
					</div>
					
					<div class="text-end ms-3">
						<?php if ( $price ) : ?>
							<span class="fs-4 fw-bold text-primary">$<?php echo esc_html( $price ); ?></span>
						<?php else : ?>
							<span class="fs-5 fw-bold text-success"><?php esc_html_e( 'Free', 'diginovaplus' ); ?></span>
						<?php endif; ?>
					</div>
				</div>

				<div class="product-excerpt text-muted mb-3 line-clamp-2 d-none d-md-block">
					<?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
				</div>

				<div class="d-flex justify-content-between align-items-end mt-auto pt-3 border-top">
					<div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4">
						<div class="product-rating text-warning small" title="<?php echo esc_attr( $rating ? $rating . '/5' : __( 'No ratings yet', 'diginovaplus' ) ); ?>">
							<?php
							$rating_val = $rating ? floatval( $rating ) : 0;
							for ( $i = 1; $i <= 5; $i++ ) {
								if ( $i <= $rating_val ) echo '★';
								elseif ( $i - 0.5 <= $rating_val ) echo '⯨'; // Half star roughly
								else echo '☆';
							}
							?>
							<span class="text-muted ms-1">(<?php echo esc_html( $review_count ? $review_count : 0 ); ?> <?php esc_html_e( 'Reviews', 'diginovaplus' ); ?>)</span>
						</div>
						<div class="product-sales text-muted small d-flex align-items-center gap-1">
							<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
							<?php echo esc_html( $sales ? number_format_i18n( $sales ) : 0 ); ?> <?php esc_html_e( 'Sales', 'diginovaplus' ); ?>
						</div>
					</div>

					<div class="d-flex gap-2">
						<?php if ( $demo_url ) : ?>
							<a href="<?php echo esc_url( home_url( '/live-preview/?demo_url=' . urlencode( $demo_url ) . '&id=' . $product_id ) ); ?>" target="_blank" class="btn btn-outline-secondary btn-sm fw-semibold rounded-pill px-3 d-none d-lg-inline-block">
								<?php esc_html_e( 'Live Preview', 'diginovaplus' ); ?>
							</a>
						<?php endif; ?>
						<?php if ( class_exists( 'WooCommerce' ) ) : ?>
							<!-- Simple add to cart for demo -->
							<a href="?add-to-cart=<?php echo absint( $product_id ); ?>" class="btn btn-primary btn-sm fw-semibold rounded-pill px-3 d-flex align-items-center gap-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
								<span class="d-none d-sm-inline"><?php esc_html_e( 'Add to Cart', 'diginovaplus' ); ?></span>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
