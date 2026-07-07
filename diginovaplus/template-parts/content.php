<?php
/**
 * Template part for displaying posts
 *
 * @package DigiNova_Plus
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card mb-4 shadow-sm border-0 rounded-4 overflow-hidden' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid w-100' ) ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="card-body p-4 p-lg-5">
		<header class="entry-header mb-3">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title fw-bold">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title h3 fw-bold"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="text-dark text-decoration-none">', '</a></h2>' );
			endif;
			?>

			<div class="entry-meta text-muted small mt-2">
				<?php
				echo esc_html( get_the_date() ) . ' / ';
				echo esc_html__( 'By ', 'diginovaplus' ) . esc_html( get_the_author() );
				?>
			</div>
		</header>

		<div class="entry-content text-muted">
			<?php
			if ( is_singular() ) {
				the_content();
				wp_link_pages( array(
					'before' => '<div class="page-links mt-3"><strong>' . esc_html__( 'Pages:', 'diginovaplus' ) . '</strong> ',
					'after'  => '</div>',
				) );
			} else {
				the_excerpt();
			}
			?>
		</div>

		<?php if ( ! is_singular() ) : ?>
			<footer class="entry-footer mt-4">
				<a href="<?php the_permalink(); ?>" class="btn btn-outline-primary rounded-pill px-4"><?php esc_html_e( 'Read More', 'diginovaplus' ); ?></a>
			</footer>
		<?php endif; ?>
	</div>
</article>
