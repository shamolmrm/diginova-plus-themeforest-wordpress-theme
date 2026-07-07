<?php
/**
 * Transparent Header Template
 *
 * @package DigiNova_Plus
 */
?>
<header id="masthead" class="site-header header-transparent position-absolute w-100 z-3">
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-dark">
			<!-- Same content as header-default but with navbar-dark class and absolute positioning -->
			<div class="site-branding">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="text-white"><?php bloginfo( 'name' ); ?></a></h1>
				<?php } ?>
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
				
				<!-- Header Actions (simplified for transparent header) -->
				<div class="header-actions">
					<button class="search-toggle text-white" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="<?php esc_attr_e( 'Search', 'diginovaplus' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
					</button>
				</div>
			</div>
		</nav>
	</div>
</header>
