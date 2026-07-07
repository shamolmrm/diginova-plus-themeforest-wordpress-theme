<?php
/**
 * Single Product Template
 *
 * @package DigiNova_Plus
 */

get_header(); ?>

<div id="content" class="site-content bg-light pb-5">
	<?php
	while ( have_posts() ) :
		the_post();

		// Get layout style from customizer or post meta
		$layout = get_post_meta( get_the_ID(), '_diginovaplus_product_layout', true );
		if ( empty( $layout ) ) {
			$layout = get_theme_mod( 'diginovaplus_single_product_layout', '1' );
		}

		get_template_part( 'template-parts/product/single-layout', $layout );

	endwhile; // End of the loop.
	?>
</div><!-- #content -->

<?php get_footer(); ?>
