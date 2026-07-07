<?php
/**
 * The template for displaying comments
 *
 * @package DigiNova_Plus
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area mt-5 bg-white p-4 p-md-5 rounded-4 shadow-sm">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title h4 fw-bold mb-4">
			<?php
			$diginovaplus_comment_count = get_comments_number();
			if ( '1' === $diginovaplus_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'diginovaplus' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $diginovaplus_comment_count, 'comments title', 'diginovaplus' ) ),
					number_format_i18n( $diginovaplus_comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list list-unstyled">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 60,
			) );
			?>
		</ol>

		<?php
		the_comments_navigation();

		if ( ! comments_open() ) :
			?>
			<p class="no-comments alert alert-warning mt-3"><?php esc_html_e( 'Comments are closed.', 'diginovaplus' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form( array(
		'class_submit'  => 'btn btn-primary rounded-pill px-4',
		'title_reply'   => '<span class="h4 fw-bold">' . esc_html__( 'Leave a Reply', 'diginovaplus' ) . '</span>',
	) );
	?>

</div>
