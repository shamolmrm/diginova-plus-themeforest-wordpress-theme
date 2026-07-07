<?php
/**
 * Product Card - Grid View
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

// Simulated Badges
$badges = array();
if ( $sales > 1000 ) $badges[] = array( 'label' => 'Trending', 'class' => 'bg-warning text-dark' );
elseif ( get_the_date('U') > strtotime('-30 days') ) $badges[] = array( 'label' => 'New', 'class' => 'bg-success' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'product-card card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-all hover-lift' ); ?>>
	
	<div class="card-img-top position-relative overflow-hidden bg-light ratio ratio-4x3">
		<a href="<?php the_permalink(); ?>" class="d-block w-100 h-100">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'diginovaplus-product-thumb', array( 'class' => 'object-fit-cover w-100 h-100' ) ); ?>
			<?php else : ?>
				<div class="d-flex align-items-center justify-content-center h-100 w-100 bg-secondary bg-opacity-10 text-muted">
					<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
				</div>
			<?php endif; ?>
		</a>

		<!-- Badges -->
		<div class="position-absolute top-0 start-0 p-3 d-flex flex-column gap-2 z-2">
			<?php foreach ( $badges as $badge ) : ?>
				<span class="badge <?php echo esc_attr( $badge['class'] ); ?> shadow-sm"><?php echo esc_html( $badge['label'] ); ?></span>
			<?php endforeach; ?>
		</div>

		<!-- Category Label -->
		<?php if ( $primary_cat ) : ?>
			<div class="position-absolute bottom-0 start-0 p-3 z-2">
				<span class="badge bg-dark bg-opacity-75 text-white backdrop-blur"><?php echo esc_html( $primary_cat ); ?></span>
			</div>
		<?php endif; ?>

		<!-- Wishlist Heart -->
		<div class="position-absolute top-0 end-0 p-3 z-2">
			<button class="btn btn-light btn-sm rounded-circle shadow-sm wh-32 p-0 d-flex align-items-center justify-content-center text-muted hover-text-danger" aria-label="<?php esc_attr_e( 'Add to Wishlist', 'diginovaplus' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
			</button>
		</div>

		<!-- Quick Preview Overlay -->
		<div class="card-img-overlay d-flex align-items-center justify-content-center bg-dark bg-opacity-50 opacity-0 transition-opacity z-1 product-hover-overlay">
			<?php if ( $demo_url ) : ?>
				<a href="<?php echo esc_url( home_url( '/live-preview/?demo_url=' . urlencode( $demo_url ) . '&id=' . $product_id ) ); ?>" target="_blank" class="btn btn-light rounded-pill fw-semibold px-4 shadow">
					<?php esc_html_e( 'Live Preview', 'diginovaplus' ); ?>
				</a>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>" class="btn btn-light rounded-pill fw-semibold px-4 shadow">
					<?php esc_html_e( 'View Details', 'diginovaplus' ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>

	<div class="card-body p-4 d-flex flex-column">
		<!-- Author -->
		<div class="d-flex align-items-center mb-2">
			<span class="text-muted small"><?php esc_html_e( 'by', 'diginovaplus' ); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="text-dark fw-medium text-decoration-none hover-text-primary"><?php the_author(); ?></a></span>
		</div>

		<!-- Title -->
		<h3 class="card-title h5 fw-bold mb-3 line-clamp-2">
			<a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-text-primary"><?php the_title(); ?></a>
		</h3>

		<!-- Meta row -->
		<div class="d-flex justify-content-between align-items-center mb-4 mt-auto">
			<div class="d-flex flex-column">
				<div class="product-rating text-warning small mb-1" title="<?php echo esc_attr( $rating ? $rating . '/5' : __( 'No ratings yet', 'diginovaplus' ) ); ?>">
					<?php
					$rating_val = $rating ? floatval( $rating ) : 0;
					for ( $i = 1; $i <= 5; $i++ ) {
						if ( $i <= $rating_val ) echo '★';
						elseif ( $i - 0.5 <= $rating_val ) echo '⯨'; // Half star roughly
						else echo '☆';
					}
					?>
					<span class="text-muted ms-1">(<?php echo esc_html( $review_count ? $review_count : 0 ); ?>)</span>
				</div>
				<div class="product-sales text-muted small d-flex align-items-center gap-1">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
					<?php echo esc_html( $sales ? number_format_i18n( $sales ) : 0 ); ?> <?php esc_html_e( 'Sales', 'diginovaplus' ); ?>
				</div>
			</div>
			
			<div class="product-price text-end">
				<?php if ( $price ) : ?>
					<span class="fs-5 fw-bold text-primary">$<?php echo esc_html( $price ); ?></span>
				<?php else : ?>
					<span class="fs-6 fw-bold text-success"><?php esc_html_e( 'Free', 'diginovaplus' ); ?></span>
				<?php endif; ?>
			</div>
		</div>
	</div>
</article>
