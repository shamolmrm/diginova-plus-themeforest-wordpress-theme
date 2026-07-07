<?php
/**
 * Tab Content: Reviews
 *
 * @package DigiNova_Plus
 */
?>
<div class="product-reviews-content">
	<!-- We'll integrate the AJAX Review system here -->
	<h3 class="h5 fw-bold mb-4"><?php esc_html_e( 'Customer Reviews', 'diginovaplus' ); ?></h3>
	
	<?php
	// Load WordPress Comments Template (styled for reviews)
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	?>
</div>
