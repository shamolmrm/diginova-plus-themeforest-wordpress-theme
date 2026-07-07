<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package DigiNova_Plus
 */
?>
<section class="no-results not-found bg-white p-5 rounded-4 shadow-sm text-center">
	<header class="page-header mb-4">
		<h1 class="page-title fw-bold"><?php esc_html_e( 'Nothing Found', 'diginovaplus' ); ?></h1>
	</header>
	<div class="page-content">
		<p class="lead text-muted"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'diginovaplus' ); ?></p>
		<div class="mt-4 max-w-sm mx-auto" style="max-width: 400px; margin: 0 auto;">
			<?php get_search_form(); ?>
		</div>
	</div>
</section>
