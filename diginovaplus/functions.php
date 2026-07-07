<?php
/**
 * DigiNova Plus functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define theme constants.
define( 'DIGINOVAPLUS_VERSION', '1.0.0' );
define( 'DIGINOVAPLUS_DIR', trailingslashit( get_template_directory() ) );
define( 'DIGINOVAPLUS_URI', trailingslashit( get_template_directory_uri() ) );

/**
 * Require core theme classes.
 */
require_once DIGINOVAPLUS_DIR . 'inc/class-theme-setup.php';
require_once DIGINOVAPLUS_DIR . 'inc/class-assets.php';
require_once DIGINOVAPLUS_DIR . 'inc/class-ajax-handler.php';
require_once DIGINOVAPLUS_DIR . 'inc/class-customizer.php';
require_once DIGINOVAPLUS_DIR . 'inc/class-demo-import.php';
require_once DIGINOVAPLUS_DIR . 'inc/class-woocommerce.php';
require_once DIGINOVAPLUS_DIR . 'inc/class-plugins-loader.php';
require_once DIGINOVAPLUS_DIR . 'inc/class-bootstrap-navwalker.php';

// Initialize core classes.
DigiNova_Plus_Theme_Setup::get_instance();
DigiNova_Plus_Assets::get_instance();

/**
 * Include TGMPA Plugin Activation.
 * Assuming TGM-Plugin-Activation library is included or will be added.
 */
// require_once DIGINOVAPLUS_DIR . 'inc/tgmpa/class-tgm-plugin-activation.php';



// Ensure theme support for Title Tag
add_theme_support( 'title-tag' );
