<?php
/**
 * Template Name: Vendor Dashboard
 *
 * @package DigiNova_Plus
 */

if ( ! is_user_logged_in() ) {
	wp_redirect( wp_login_url( get_permalink() ) );
	exit;
}

get_header();

$current_user = wp_get_current_user();
// Check if user is vendor. For simplicity, we check if they can publish posts or have a specific role
$is_vendor = in_array( 'author', (array) $current_user->roles ) || in_array( 'administrator', (array) $current_user->roles );

$current_tab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'overview';
?>

<div class="vendor-dashboard-page bg-light min-vh-100 py-5">
	<div class="container">
		<?php if ( ! $is_vendor ) : ?>
			<div class="text-center bg-white p-5 rounded-4 shadow-sm">
				<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-warning mb-4"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
				<h2 class="h3 fw-bold mb-3"><?php esc_html_e( 'Access Denied', 'diginovaplus' ); ?></h2>
				<p class="text-muted mb-4"><?php esc_html_e( 'You need to be registered as an author/vendor to access this dashboard.', 'diginovaplus' ); ?></p>
				<a href="#" class="btn btn-primary rounded-pill px-4"><?php esc_html_e( 'Apply to become an Author', 'diginovaplus' ); ?></a>
			</div>
		<?php else : ?>
			<div class="row g-4">
				<!-- Sidebar -->
				<div class="col-lg-3">
					<div class="dashboard-sidebar bg-white rounded-4 shadow-sm p-4 sticky-top" style="top: 100px;">
						<div class="user-profile text-center border-bottom pb-4 mb-4">
							<?php echo get_avatar( $current_user->ID, 80, '', '', array( 'class' => 'rounded-circle mb-3 border border-3 border-light shadow-sm' ) ); ?>
							<h3 class="h5 fw-bold mb-1"><?php echo esc_html( $current_user->display_name ); ?></h3>
							<span class="badge bg-success bg-opacity-10 text-success fw-medium"><?php esc_html_e( 'Verified Author', 'diginovaplus' ); ?></span>
						</div>
						
						<nav class="dashboard-nav flex-column nav nav-pills gap-2">
							<a class="nav-link text-start rounded-3 px-3 py-2 <?php echo ( 'overview' === $current_tab ) ? 'active fw-medium bg-primary' : 'text-muted hover-bg-light'; ?>" href="?tab=overview">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
								<?php esc_html_e( 'Overview', 'diginovaplus' ); ?>
							</a>
							<a class="nav-link text-start rounded-3 px-3 py-2 <?php echo ( 'products' === $current_tab ) ? 'active fw-medium bg-primary' : 'text-muted hover-bg-light'; ?>" href="?tab=products">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
								<?php esc_html_e( 'My Products', 'diginovaplus' ); ?>
							</a>
							<a class="nav-link text-start rounded-3 px-3 py-2 <?php echo ( 'sales' === $current_tab ) ? 'active fw-medium bg-primary' : 'text-muted hover-bg-light'; ?>" href="?tab=sales">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
								<?php esc_html_e( 'Sales & Earnings', 'diginovaplus' ); ?>
							</a>
							<a class="nav-link text-start rounded-3 px-3 py-2 <?php echo ( 'settings' === $current_tab ) ? 'active fw-medium bg-primary' : 'text-muted hover-bg-light'; ?>" href="?tab=settings">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
								<?php esc_html_e( 'Settings', 'diginovaplus' ); ?>
							</a>
						</nav>
					</div>
				</div>

				<!-- Main Content -->
				<div class="col-lg-9">
					<?php
					$valid_tabs = array( 'overview', 'products', 'sales', 'settings' );
					if ( in_array( $current_tab, $valid_tabs ) ) {
						get_template_part( 'template-parts/vendor/dashboard', $current_tab );
					} else {
						get_template_part( 'template-parts/vendor/dashboard', 'overview' );
					}
					?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>
