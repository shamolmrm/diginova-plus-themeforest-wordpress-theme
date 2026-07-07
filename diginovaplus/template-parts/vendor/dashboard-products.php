<?php
/**
 * Vendor Dashboard - Products Tab
 *
 * @package DigiNova_Plus
 */
?>
<div class="dashboard-products">
	<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
		<h2 class="h4 fw-bold mb-0"><?php esc_html_e( 'My Products', 'diginovaplus' ); ?></h2>
		<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=diginovaplus_products' ) ); ?>" class="btn btn-primary rounded-pill px-4 fw-medium d-flex align-items-center gap-2">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
			<?php esc_html_e( 'Add New Product', 'diginovaplus' ); ?>
		</a>
	</div>

	<div class="bg-white rounded-4 shadow-sm p-4">
		<?php
		$current_user = wp_get_current_user();
		$args = array(
			'post_type'      => 'diginovaplus_products',
			'post_status'    => array( 'publish', 'pending', 'draft' ),
			'author'         => $current_user->ID,
			'posts_per_page' => -1,
		);
		$products_query = new WP_Query( $args );

		if ( $products_query->have_posts() ) :
		?>
			<div class="table-responsive">
				<table class="table table-hover align-middle mb-0">
					<thead class="table-light text-muted small text-uppercase tracking-wide">
						<tr>
							<th><?php esc_html_e( 'Product', 'diginovaplus' ); ?></th>
							<th><?php esc_html_e( 'Status', 'diginovaplus' ); ?></th>
							<th><?php esc_html_e( 'Price', 'diginovaplus' ); ?></th>
							<th><?php esc_html_e( 'Sales', 'diginovaplus' ); ?></th>
							<th class="text-end"><?php esc_html_e( 'Actions', 'diginovaplus' ); ?></th>
						</tr>
					</thead>
					<tbody class="border-top-0">
						<?php while ( $products_query->have_posts() ) : $products_query->the_post(); 
							$status = get_post_status();
							$status_class = 'bg-secondary';
							$status_label = 'Draft';
							if ( 'publish' === $status ) {
								$status_class = 'bg-success';
								$status_label = 'Active';
							} elseif ( 'pending' === $status ) {
								$status_class = 'bg-warning text-dark';
								$status_label = 'Pending Review';
							}
							
							$price = get_post_meta( get_the_ID(), '_diginovaplus_regular_price', true );
							$sales = get_post_meta( get_the_ID(), '_diginovaplus_sales_count', true );
						?>
						<tr>
							<td>
								<div class="d-flex align-items-center gap-3">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'rounded-3', 'style' => 'width: 48px; height: 48px; object-fit: cover;' ) ); ?>
									<?php else : ?>
										<div class="bg-light rounded-3 d-flex justify-content-center align-items-center text-muted" style="width: 48px; height: 48px;">
											<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
										</div>
									<?php endif; ?>
									<div>
										<a href="<?php echo esc_url( get_edit_post_link() ); ?>" class="fw-bold text-dark text-decoration-none hover-text-primary"><?php the_title(); ?></a>
										<div class="small text-muted"><?php echo esc_html( get_the_date() ); ?></div>
									</div>
								</div>
							</td>
							<td><span class="badge <?php echo esc_attr( $status_class ); ?>"><?php echo esc_html( $status_label ); ?></span></td>
							<td class="fw-medium text-dark"><?php echo $price ? '$' . esc_html( $price ) : '-'; ?></td>
							<td><?php echo esc_html( $sales ? $sales : 0 ); ?></td>
							<td class="text-end">
								<a href="<?php echo esc_url( get_edit_post_link() ); ?>" class="btn btn-sm btn-light rounded-pill px-3"><?php esc_html_e( 'Edit', 'diginovaplus' ); ?></a>
								<?php if ( 'publish' === $status ) : ?>
									<a href="<?php the_permalink(); ?>" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3"><?php esc_html_e( 'View', 'diginovaplus' ); ?></a>
								<?php endif; ?>
							</td>
						</tr>
						<?php endwhile; wp_reset_postdata(); ?>
					</tbody>
				</table>
			</div>
		<?php else : ?>
			<div class="text-center py-5 text-muted">
				<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mb-3 opacity-50"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
				<p class="fs-5 mb-0"><?php esc_html_e( 'You haven\'t uploaded any products yet.', 'diginovaplus' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</div>
