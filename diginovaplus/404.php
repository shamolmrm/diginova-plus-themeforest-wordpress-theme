<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package DigiNova_Plus
 */

get_header(); ?>

<div id="primary" class="content-area py-6 bg-light text-center min-vh-100 d-flex align-items-center">
	<main id="main" class="site-main w-100">
		<div class="container">
			<section class="error-404 not-found bg-white p-5 rounded-4 shadow-sm mx-auto" style="max-width: 600px;">
				<header class="page-header mb-4">
					<h1 class="page-title display-1 fw-bold text-primary">404</h1>
					<h2 class="h3 fw-bold mt-3"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'diginovaplus' ); ?></h2>
				</header>

				<div class="page-content">
					<p class="lead text-muted mb-5"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'diginovaplus' ); ?></p>
					
					<div class="search-form-wrap mb-5">
						<?php get_search_form(); ?>
					</div>

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary rounded-pill px-4 btn-lg">
						<?php esc_html_e( 'Return Home', 'diginovaplus' ); ?>
					</a>
				</div>
			</section>
		</div>
	</main>
</div>

<?php get_footer(); ?>
