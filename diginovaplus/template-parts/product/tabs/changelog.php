<?php
/**
 * Tab Content: Changelog
 *
 * @package DigiNova_Plus
 */

$changelog = get_post_meta( get_the_ID(), '_diginovaplus_changelog', true );
?>
<div class="product-changelog-content format-content">
	<?php if ( ! empty( $changelog ) ) : ?>
		<?php echo wp_kses_post( wpautop( $changelog ) ); ?>
	<?php else : ?>
		<p class="text-muted italic"><?php esc_html_e( 'No changelog available for this product yet.', 'diginovaplus' ); ?></p>
	<?php endif; ?>
</div>
