<?php
/**
 * Elementor Integration Init
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class DigiNova_Plus_Elementor_Init {

	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';
	const MINIMUM_PHP_VERSION = '7.3';

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}

		add_action( 'elementor/init', array( $this, 'init' ) );
	}

	public function init() {
		// Check if Elementor meets version requirements
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check if PHP meets version requirements
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		// Register Widgets
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );

		// Register Custom Category
		add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_categories' ) );
	}

	public function add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'diginovaplus-elements',
			array(
				'title' => __( 'DigiNova Plus Elements', 'diginovaplus' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}

	public function register_widgets( $widgets_manager ) {
		require_once DIGINOVAPLUS_DIR . 'inc/elementor/widgets/class-widget-hero.php';
		require_once DIGINOVAPLUS_DIR . 'inc/elementor/widgets/class-widget-product-grid.php';
		require_once DIGINOVAPLUS_DIR . 'inc/elementor/widgets/class-widget-categories.php';

		$widgets_manager->register( new \DigiNova_Plus_Widget_Hero() );
		$widgets_manager->register( new \DigiNova_Plus_Widget_Product_Grid() );
		$widgets_manager->register( new \DigiNova_Plus_Widget_Categories() );
	}

	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'diginovaplus' ),
			'<strong>' . esc_html__( 'DigiNova Plus', 'diginovaplus' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'diginovaplus' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'diginovaplus' ),
			'<strong>' . esc_html__( 'DigiNova Plus', 'diginovaplus' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'diginovaplus' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

// Instantiate the class
DigiNova_Plus_Elementor_Init::instance();
