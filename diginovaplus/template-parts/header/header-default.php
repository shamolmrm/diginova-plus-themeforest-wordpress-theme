<?php
/**
 * Default Header Template
 *
 * @package DigiNova_Plus
 */
?>
<header id="masthead" class="site-header header-default">
	<div class="container">
		<nav class="navbar navbar-expand-lg">
			<div class="site-branding">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					$diginovaplus_description = get_bloginfo( 'description', 'display' );
					if ( $diginovaplus_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $diginovaplus_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif;
				}
				?>
			</div><!-- .site-branding -->

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primary-menu-wrap" aria-controls="primary-menu-wrap" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'diginovaplus' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="primary-menu-wrap">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'menu_id'         => 'primary-menu',
						'menu_class'      => 'navbar-nav mx-auto',
						'container'       => false,
						'fallback_cb'     => '__return_false',
						'walker'          => new DigiNova_Plus_Bootstrap_Navwalker(),
					)
				);
				?>

				<div class="header-actions">
					<!-- Dark Mode Toggle -->
					<button class="dark-mode-toggle" aria-label="<?php esc_attr_e( 'Toggle Dark Mode', 'diginovaplus' ); ?>">
						<svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
					</button>

					<!-- Search Icon -->
					<button class="search-toggle" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="<?php esc_attr_e( 'Search', 'diginovaplus' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
					</button>

					<!-- Cart Icon -->
					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart-icon" aria-label="<?php esc_attr_e( 'View your shopping cart', 'diginovaplus' ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
							<span class="cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
						</a>
					<?php endif; ?>

					<!-- User Account -->
					<div class="user-account dropdown">
						<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'User Account', 'diginovaplus' ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<?php if ( is_user_logged_in() ) : ?>
								<li><a class="dropdown-item" href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>"><?php esc_html_e( 'Dashboard', 'diginovaplus' ); ?></a></li>
								<li><a class="dropdown-item" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>"><?php esc_html_e( 'Logout', 'diginovaplus' ); ?></a></li>
							<?php else : ?>
								<li><a class="dropdown-item" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'Login / Register', 'diginovaplus' ); ?></a></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</div>
</header>
