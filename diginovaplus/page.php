<?php
/**
 * The template for displaying all pages
 *
 * @package DigiNova_Plus
 */

get_header(); ?>

<div id="primary" class="content-area py-5 bg-light">
	<main id="main" class="site-main">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white p-4 p-md-5 rounded-4 shadow-sm' ); ?>>
							<header class="entry-header mb-4">
								<?php the_title( '<h1 class="entry-title fw-bold">', '</h1>' ); ?>
							</header>

							<div class="entry-content">
								<?php
								the_content();
								wp_link_pages( array(
									'before' => '<div class="page-links mt-3"><strong>' . esc_html__( 'Pages:', 'diginovaplus' ) . '</strong> ',
									'after'  => '</div>',
								) );
								?>
							</div>
						</article>
						<?php
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</div>
			</div>
		</div>
	</main>
</div>

<?php get_footer(); ?>
