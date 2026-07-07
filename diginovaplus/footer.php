<?php
/**
 * The template for displaying the footer
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

</main><!-- #primary -->

<?php
// Get footer style from customizer (default to 'default')
$footer_style = get_theme_mod( 'diginovaplus_footer_style', 'default' );

// Load the appropriate footer template
get_template_part( 'template-parts/footer/footer', $footer_style );
?>

<button id="back-to-top" class="back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'diginovaplus' ); ?>">
	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 15l-6-6-6 6"/></svg>
</button>

<?php wp_footer(); ?>
</body>
</html>
