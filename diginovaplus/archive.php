<?php
/**
 * The template for displaying archive pages
 *
 * @package DigiNova_Plus
 */

get_header(); ?>

<div id="primary" class="content-area py-5 bg-light">
	<main id="main" class="site-main">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<header class="page-header mb-5 text-center">
					<?php
					the_archive_title( '<h1 class="page-title display-5 fw-bold">', '</h1>' );
					the_archive_description( '<div class="archive-description lead text-muted mt-3">', '</div>' );
					?>
				</header>
			<?php endif; ?>

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
