<?php
/**
 * Plugin Name: DigiNova Plus Core
 * Plugin URI:  https://example.com/
 * Description: Companion plugin for DigiNova Plus Theme. Adds Elementor widgets, Custom Post Types, and Support System.
 * Version:     1.0.0
 * Author:      Shamol Murmu
 * Author URI:  https://example.com/
 * Text Domain: diginovaplus-core
 *
 * @package DigiNovaPlusCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DIGINOVAPLUS_CORE_VERSION', '1.0.0' );
define( 'DIGINOVAPLUS_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'DIGINOVAPLUS_CORE_URL', plugin_dir_url( __FILE__ ) );

final class DigiNova_Plus_Core {

	private static $instance = null;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->includes();
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
	}

	private function includes() {
		// Include Post Types
		require_once DIGINOVAPLUS_CORE_PATH . 'inc/class-post-types.php';
		new DigiNova_Plus_Core_Post_Types();

		// Include Support System
		require_once DIGINOVAPLUS_CORE_PATH . 'inc/class-support-system.php';

		// Include Elementor Initialization
		require_once DIGINOVAPLUS_CORE_PATH . 'inc/elementor/class-elementor-init.php';
	}

	public function load_textdomain() {
		load_plugin_textdomain( 'diginovaplus-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
}

function diginovaplus_core_init() {
	return DigiNova_Plus_Core::get_instance();
}

// Initialize the plugin.
diginovaplus_core_init();
