<?php
/**
 * The header for our theme
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="screen-reader-text skip-link" href="#primary"><?php esc_html_e( 'Skip to content', 'diginovaplus' ); ?></a>

<?php
// Get header style from customizer (default to 'default')
$header_style = get_theme_mod( 'diginovaplus_header_style', 'default' );

// Load the appropriate header template
get_template_part( 'template-parts/header/header', $header_style );
?>

<main id="primary" class="site-main">
