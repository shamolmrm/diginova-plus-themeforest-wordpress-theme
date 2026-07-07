<?php
/**
 * Default Footer Template
 *
 * @package DigiNova_Plus
 */
?>
<footer class="site-footer footer-default">
	<div class="footer-widgets pt-5 pb-4">
		<div class="container">
			<div class="row">
				<!-- Footer Widget Area 1 -->
				<div class="col-lg-3 col-md-6 mb-4">
					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<?php dynamic_sidebar( 'footer-1' ); ?>
					<?php else : ?>
						<div class="widget">
							<?php
							if ( has_custom_logo() ) {
								the_custom_logo();
							} else {
								echo '<h2 class="widget-title"><a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a></h2>';
							}
							?>
							<p class="mt-3"><?php esc_html_e( 'Premium Digital Products & SaaS Marketplace WordPress Theme. Built for selling software, apps, HTML templates, and plugins.', 'diginovaplus' ); ?></p>
							
							<div class="social-icons mt-4">
								<a href="#" aria-label="Facebook"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
								<a href="#" aria-label="Twitter"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></a>
								<a href="#" aria-label="LinkedIn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg></a>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<!-- Footer Widget Area 2 -->
				<div class="col-lg-3 col-md-6 mb-4">
					<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
						<?php dynamic_sidebar( 'footer-2' ); ?>
					<?php else : ?>
						<div class="widget">
							<h4 class="widget-title"><?php esc_html_e( 'Quick Links', 'diginovaplus' ); ?></h4>
							<?php
							wp_nav_menu( array(
								'theme_location' => 'footer-1',
								'fallback_cb'    => false,
							) );
							?>
						</div>
					<?php endif; ?>
				</div>

				<!-- Footer Widget Area 3 -->
				<div class="col-lg-3 col-md-6 mb-4">
					<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
						<?php dynamic_sidebar( 'footer-3' ); ?>
					<?php else : ?>
						<div class="widget">
							<h4 class="widget-title"><?php esc_html_e( 'Categories', 'diginovaplus' ); ?></h4>
							<?php
							wp_nav_menu( array(
								'theme_location' => 'footer-2',
								'fallback_cb'    => false,
							) );
							?>
						</div>
					<?php endif; ?>
				</div>

				<!-- Footer Widget Area 4 -->
				<div class="col-lg-3 col-md-6 mb-4">
					<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
						<?php dynamic_sidebar( 'footer-4' ); ?>
					<?php else : ?>
						<div class="widget">
							<h4 class="widget-title"><?php esc_html_e( 'Newsletter', 'diginovaplus' ); ?></h4>
							<p><?php esc_html_e( 'Subscribe to get the latest news, updates, and special offers.', 'diginovaplus' ); ?></p>
							<form class="newsletter-form mt-3">
								<div class="input-group">
									<input type="email" class="form-control" placeholder="<?php esc_attr_e( 'Your email address', 'diginovaplus' ); ?>" required>
									<button class="btn btn-primary" type="submit"><?php esc_html_e( 'Subscribe', 'diginovaplus' ); ?></button>
								</div>
							</form>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-bottom py-3 border-top">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 text-center text-md-start">
					<p class="mb-0 copyright-text">
						&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'diginovaplus' ); ?>
					</p>
				</div>
				<div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-3',
						'menu_class'     => 'footer-bottom-menu list-inline mb-0',
						'fallback_cb'    => false,
						'depth'          => 1,
					) );
					?>
				</div>
			</div>
		</div>
	</div>
</footer>
