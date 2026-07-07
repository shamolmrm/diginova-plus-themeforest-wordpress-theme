<?php
/**
 * The main template file
 *
 * @package DigiNova_Plus
 */

get_header(); ?>

<div id="primary" class="content-area py-5 bg-light">
	<main id="main" class="site-main">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<?php if ( have_posts() ) : ?>
						<div class="posts-wrapper">
							<?php
							while ( have_posts() ) :
								the_post();
								get_template_part( 'template-parts/content', get_post_format() );
							endwhile;

							the_posts_pagination( array(
								'mid_size'  => 2,
								'prev_text' => esc_html__( 'Previous', 'diginovaplus' ),
								'next_text' => esc_html__( 'Next', 'diginovaplus' ),
							) );
							?>
						</div>
					<?php else : ?>
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
					<?php endif; ?>
				</div>
				<div class="col-lg-4">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</main>
</div>

<?php get_footer(); ?>
