<?php
/**
 * The template for displaying all single posts
 *
 * @package DigiNova_Plus
 */

get_header(); ?>

<div id="primary" class="content-area py-5 bg-light">
	<main id="main" class="site-main">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_format() );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</div>
				<div class="col-lg-4">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</main>
</div>

<?php get_footer(); ?>
