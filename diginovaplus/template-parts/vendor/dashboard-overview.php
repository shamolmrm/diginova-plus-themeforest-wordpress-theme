<?php
/**
 * Vendor Dashboard - Overview Tab
 *
 * @package DigiNova_Plus
 */

// Simulated Data
$total_earnings = 12450.50;
$sales_count = 342;
$products_count = 12;
$avg_rating = 4.8;
?>

<div class="dashboard-overview">
	<h2 class="h4 fw-bold mb-4"><?php esc_html_e( 'Dashboard Overview', 'diginovaplus' ); ?></h2>
	
	<!-- Stats Cards -->
	<div class="row g-4 mb-5">
		<div class="col-sm-6 col-lg-3">
			<div class="stat-card bg-white rounded-4 shadow-sm p-4 h-100 border-start border-4 border-primary">
				<div class="text-muted small fw-medium mb-2 text-uppercase tracking-wide"><?php esc_html_e( 'Total Earnings', 'diginovaplus' ); ?></div>
				<div class="fs-3 fw-bold text-dark mb-2">$<?php echo number_format( $total_earnings, 2 ); ?></div>
				<div class="text-success small d-flex align-items-center gap-1">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
					+12.5% <?php esc_html_e( 'this month', 'diginovaplus' ); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="stat-card bg-white rounded-4 shadow-sm p-4 h-100 border-start border-4 border-success">
				<div class="text-muted small fw-medium mb-2 text-uppercase tracking-wide"><?php esc_html_e( 'Total Sales', 'diginovaplus' ); ?></div>
				<div class="fs-3 fw-bold text-dark mb-2"><?php echo esc_html( $sales_count ); ?></div>
				<div class="text-success small d-flex align-items-center gap-1">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
					+8.2% <?php esc_html_e( 'this month', 'diginovaplus' ); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="stat-card bg-white rounded-4 shadow-sm p-4 h-100 border-start border-4 border-info">
				<div class="text-muted small fw-medium mb-2 text-uppercase tracking-wide"><?php esc_html_e( 'Active Products', 'diginovaplus' ); ?></div>
				<div class="fs-3 fw-bold text-dark mb-2"><?php echo esc_html( $products_count ); ?></div>
				<a href="?tab=products" class="text-primary small text-decoration-none fw-medium"><?php esc_html_e( 'Manage Products &rarr;', 'diginovaplus' ); ?></a>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="stat-card bg-white rounded-4 shadow-sm p-4 h-100 border-start border-4 border-warning">
				<div class="text-muted small fw-medium mb-2 text-uppercase tracking-wide"><?php esc_html_e( 'Author Rating', 'diginovaplus' ); ?></div>
				<div class="fs-3 fw-bold text-dark mb-2"><?php echo esc_html( $avg_rating ); ?></div>
				<div class="text-warning small d-flex align-items-center gap-1">
					★★★★★
				</div>
			</div>
		</div>
	</div>

	<!-- Sales Chart -->
	<div class="bg-white rounded-4 shadow-sm p-4 mb-5">
		<h3 class="h6 fw-bold mb-4"><?php esc_html_e( 'Earnings Overview (Last 7 Days)', 'diginovaplus' ); ?></h3>
		<div class="chart-container" style="position: relative; height:300px; width:100%">
			<canvas id="earningsChart"></canvas>
		</div>
	</div>

	<!-- Recent Sales Table -->
	<div class="bg-white rounded-4 shadow-sm p-4">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h3 class="h6 fw-bold mb-0"><?php esc_html_e( 'Recent Sales', 'diginovaplus' ); ?></h3>
			<a href="?tab=sales" class="btn btn-sm btn-outline-primary rounded-pill px-3"><?php esc_html_e( 'View All', 'diginovaplus' ); ?></a>
		</div>
		<div class="table-responsive">
			<table class="table table-hover align-middle mb-0">
				<thead class="table-light text-muted small text-uppercase tracking-wide">
					<tr>
						<th><?php esc_html_e( 'Order ID', 'diginovaplus' ); ?></th>
						<th><?php esc_html_e( 'Item', 'diginovaplus' ); ?></th>
						<th><?php esc_html_e( 'Date', 'diginovaplus' ); ?></th>
						<th><?php esc_html_e( 'Price', 'diginovaplus' ); ?></th>
						<th><?php esc_html_e( 'Earning', 'diginovaplus' ); ?></th>
					</tr>
				</thead>
				<tbody class="border-top-0">
					<!-- Simulated Data -->
					<tr>
						<td class="fw-medium text-dark">#10245</td>
						<td>Premium WordPress Theme</td>
						<td class="text-muted">Today, 10:23 AM</td>
						<td>$59.00</td>
						<td class="fw-medium text-success">$41.30</td>
					</tr>
					<tr>
						<td class="fw-medium text-dark">#10244</td>
						<td>React Admin Dashboard</td>
						<td class="text-muted">Yesterday, 14:45 PM</td>
						<td>$39.00</td>
						<td class="fw-medium text-success">$27.30</td>
					</tr>
					<tr>
						<td class="fw-medium text-dark">#10243</td>
						<td>UI Kit Pro</td>
						<td class="text-muted">May 15, 2026</td>
						<td>$49.00</td>
						<td class="fw-medium text-success">$34.30</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
