<?php
/**
 * Vendor Dashboard - Sales Tab
 *
 * @package DigiNova_Plus
 */
?>
<div class="dashboard-sales">
	<h2 class="h4 fw-bold mb-4"><?php esc_html_e( 'Sales & Earnings', 'diginovaplus' ); ?></h2>

	<!-- Filters -->
	<div class="bg-white rounded-4 shadow-sm p-4 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
		<form class="d-flex gap-2">
			<select class="form-select form-select-sm" style="width: auto;">
				<option value="this_month"><?php esc_html_e( 'This Month', 'diginovaplus' ); ?></option>
				<option value="last_month"><?php esc_html_e( 'Last Month', 'diginovaplus' ); ?></option>
				<option value="this_year"><?php esc_html_e( 'This Year', 'diginovaplus' ); ?></option>
				<option value="all_time"><?php esc_html_e( 'All Time', 'diginovaplus' ); ?></option>
			</select>
			<button class="btn btn-sm btn-primary"><?php esc_html_e( 'Apply', 'diginovaplus' ); ?></button>
		</form>
		
		<button class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
			<?php esc_html_e( 'Download CSV', 'diginovaplus' ); ?>
		</button>
	</div>

	<!-- Summary -->
	<div class="row g-4 mb-4">
		<div class="col-md-4">
			<div class="bg-primary bg-opacity-10 rounded-4 p-4 text-center h-100 border border-primary border-opacity-25">
				<div class="text-primary fw-medium mb-1"><?php esc_html_e( 'Gross Sales', 'diginovaplus' ); ?></div>
				<div class="fs-2 fw-bold text-dark">$14,500.00</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="bg-danger bg-opacity-10 rounded-4 p-4 text-center h-100 border border-danger border-opacity-25">
				<div class="text-danger fw-medium mb-1"><?php esc_html_e( 'Marketplace Fees', 'diginovaplus' ); ?></div>
				<div class="fs-2 fw-bold text-dark">-$2,049.50</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="bg-success bg-opacity-10 rounded-4 p-4 text-center h-100 border border-success border-opacity-25">
				<div class="text-success fw-medium mb-1"><?php esc_html_e( 'Net Earnings', 'diginovaplus' ); ?></div>
				<div class="fs-2 fw-bold text-dark">$12,450.50</div>
			</div>
		</div>
	</div>

	<!-- Sales List -->
	<div class="bg-white rounded-4 shadow-sm p-4">
		<div class="table-responsive">
			<table class="table table-hover align-middle mb-0">
				<thead class="table-light text-muted small text-uppercase tracking-wide">
					<tr>
						<th><?php esc_html_e( 'Date', 'diginovaplus' ); ?></th>
						<th><?php esc_html_e( 'Order ID', 'diginovaplus' ); ?></th>
						<th><?php esc_html_e( 'Item', 'diginovaplus' ); ?></th>
						<th><?php esc_html_e( 'License', 'diginovaplus' ); ?></th>
						<th><?php esc_html_e( 'Price', 'diginovaplus' ); ?></th>
						<th><?php esc_html_e( 'Fee', 'diginovaplus' ); ?></th>
						<th class="text-end"><?php esc_html_e( 'Net Earning', 'diginovaplus' ); ?></th>
					</tr>
				</thead>
				<tbody class="border-top-0">
					<!-- Simulated Data -->
					<?php for($i=1; $i<=5; $i++) : ?>
					<tr>
						<td class="text-muted small">May <?php echo 20 - $i; ?>, 2026</td>
						<td class="fw-medium text-dark">#<?php echo 10245 - $i; ?></td>
						<td>Premium WordPress Theme</td>
						<td><span class="badge bg-light text-dark border">Regular</span></td>
						<td>$59.00</td>
						<td class="text-danger">-$17.70</td>
						<td class="text-end fw-bold text-success">$41.30</td>
					</tr>
					<?php endfor; ?>
				</tbody>
			</table>
		</div>
		
		<!-- Pagination -->
		<nav class="mt-4 d-flex justify-content-center">
			<ul class="pagination pagination-sm">
				<li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
				<li class="page-item active"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
			</ul>
		</nav>
	</div>
</div>
