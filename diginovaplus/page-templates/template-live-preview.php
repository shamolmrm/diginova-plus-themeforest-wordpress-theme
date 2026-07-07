<?php
/**
 * Template Name: Live Preview Frame
 *
 * @package DigiNova_Plus
 */

$demo_url = isset( $_GET['demo_url'] ) ? esc_url_raw( wp_unslash( $_GET['demo_url'] ) ) : '';
$product_id = isset( $_GET['id'] ) ? absint( wp_unslash( $_GET['id'] ) ) : 0;

if ( empty( $demo_url ) ) {
	wp_redirect( home_url() );
	exit;
}

// Ensure the page doesn't index
add_filter( 'wp_robots', 'wp_robots_noindex_nofollow' );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php esc_html_e( 'Live Preview', 'diginovaplus' ); ?> - <?php echo $product_id ? esc_html( get_the_title( $product_id ) ) : bloginfo( 'name' ); ?></title>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo esc_url( DIGINOVAPLUS_URI . 'assets/css/live-preview.css' ); ?>">
</head>
<body class="live-preview-mode overflow-hidden m-0 p-0 vw-100 vh-100 d-flex flex-column">
	
	<!-- Top Bar -->
	<header class="preview-top-bar bg-dark text-white p-3 d-flex justify-content-between align-items-center z-3 shadow flex-shrink-0">
		<div class="d-flex align-items-center gap-4">
			<a href="<?php echo esc_url( home_url() ); ?>" class="text-white text-decoration-none fw-bold fs-5 d-flex align-items-center gap-2">
				<?php if ( has_custom_logo() ) : ?>
					<img src="<?php echo esc_url( wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' ) ); ?>" height="30" alt="Logo">
				<?php else : ?>
					<?php bloginfo( 'name' ); ?>
				<?php endif; ?>
			</a>

			<!-- Responsive Toggles -->
			<div class="device-toggles bg-white bg-opacity-10 rounded-pill p-1 d-none d-md-flex">
				<button class="btn btn-sm btn-dark rounded-pill active" data-device="desktop" title="Desktop">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
				</button>
				<button class="btn btn-sm btn-dark rounded-pill" data-device="tablet" title="Tablet">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
				</button>
				<button class="btn btn-sm btn-dark rounded-pill" data-device="mobile" title="Mobile">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
				</button>
			</div>
		</div>

		<div class="d-flex align-items-center gap-3">
			<?php if ( $product_id ) : ?>
				<a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" class="btn btn-outline-light btn-sm rounded-pill px-3 fw-medium d-none d-sm-inline-block">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path d="M19 12H5"></path><polyline points="12 19 5 12 12 5"></polyline></svg>
					<?php esc_html_e( 'Back to Item', 'diginovaplus' ); ?>
				</a>
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<a href="<?php echo esc_url( get_permalink( $product_id ) . '?add-to-cart=' . $product_id ); ?>" class="btn btn-success btn-sm rounded-pill px-4 fw-bold">
						<?php esc_html_e( 'Buy Now', 'diginovaplus' ); ?>
					</a>
				<?php endif; ?>
			<?php endif; ?>
			<button class="btn btn-link text-white-50 hover-text-white p-0 remove-frame-btn" title="<?php esc_attr_e( 'Remove Frame', 'diginovaplus' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
			</button>
		</div>
	</header>

	<!-- Iframe Container -->
	<div class="iframe-wrapper flex-grow-1 position-relative bg-secondary bg-opacity-25 d-flex justify-content-center align-items-center transition-all">
		<iframe id="preview-frame" src="<?php echo esc_url( $demo_url ); ?>" frameborder="0" class="w-100 h-100 bg-white transition-all shadow-lg" sandbox="allow-scripts allow-same-origin allow-forms allow-popups"></iframe>
	</div>

	<?php wp_footer(); ?>
	
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const frame = document.getElementById('preview-frame');
			const toggles = document.querySelectorAll('.device-toggles button');
			
			toggles.forEach(btn => {
				btn.addEventListener('click', function() {
					toggles.forEach(b => {
						b.classList.remove('active');
						b.classList.add('bg-transparent');
					});
					this.classList.add('active');
					this.classList.remove('bg-transparent');
					
					const device = this.dataset.device;
					if (device === 'desktop') {
						frame.style.width = '100%';
						frame.style.height = '100%';
						frame.classList.remove('rounded-4', 'my-4');
					} else if (device === 'tablet') {
						frame.style.width = '768px';
						frame.style.height = 'calc(100% - 40px)';
						frame.classList.add('rounded-4', 'my-4');
					} else if (device === 'mobile') {
						frame.style.width = '375px';
						frame.style.height = 'calc(100% - 40px)';
						frame.classList.add('rounded-4', 'my-4');
					}
				});
			});

			document.querySelector('.remove-frame-btn').addEventListener('click', function() {
				window.location.href = frame.src;
			});
		});
	</script>
</body>
</html>
