<?php
/**
 * Minimal Footer Template
 *
 * @package DigiNova_Plus
 */
?>
<footer class="site-footer footer-minimal py-4 bg-white border-top">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
					echo '<h4 class="mb-0"><a href="' . esc_url( home_url( '/' ) ) . '" class="text-dark">' . get_bloginfo( 'name' ) . '</a></h4>';
				}
				?>
			</div>
			<div class="col-md-6 text-center text-md-end">
				<p class="mb-0 copyright-text text-muted">
					&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'diginovaplus' ); ?>
				</p>
			</div>
		</div>
	</div>
</footer>
