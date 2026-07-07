<?php
/**
 * Theme assets (scripts and styles)
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class DigiNova_Plus_Assets {

	/**
	 * Instance of this class.
	 *
	 * @var object
	 */
	private static $instance = null;

	/**
	 * Get instance.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_head', array( $this, 'preconnect_fonts' ), 5 );
	}

	/**
	 * Preconnect Google Fonts.
	 */
	public function preconnect_fonts() {
		echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
		echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue_scripts() {
		$version = DIGINOVAPLUS_VERSION;
		
		// Enqueue Google Fonts
		wp_enqueue_style(
			'diginovaplus-fonts',
			'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700&family=JetBrains+Mono&display=swap',
			array(),
			null
		);

		// Bootstrap CSS
		wp_enqueue_style( 'bootstrap', DIGINOVAPLUS_URI . 'assets/css/bootstrap.min.css', array(), '5.3.0' );

		// Theme Main Stylesheet
		wp_enqueue_style( 'diginovaplus-style', get_stylesheet_uri(), array( 'bootstrap' ), $version );

		// Animations
		wp_enqueue_style( 'diginovaplus-animations', DIGINOVAPLUS_URI . 'assets/css/animations.css', array(), $version );

		// WooCommerce Styles (if active)
		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_style( 'diginovaplus-woocommerce', DIGINOVAPLUS_URI . 'assets/css/woocommerce.css', array( 'diginovaplus-style' ), $version );
		}

		// --- Scripts ---
		
		// Bootstrap JS
		wp_enqueue_script( 'bootstrap-bundle', DIGINOVAPLUS_URI . 'assets/js/bootstrap.bundle.min.js', array(), '5.3.0', true );

		// Theme Main Script
		wp_enqueue_script( 'diginovaplus-theme', DIGINOVAPLUS_URI . 'assets/js/theme.js', array( 'jquery', 'bootstrap-bundle' ), $version, true );

		// Animations JS
		wp_enqueue_script( 'diginovaplus-animations', DIGINOVAPLUS_URI . 'assets/js/animations.js', array(), $version, true );

		// Conditional Enqueues (WooCommerce, etc.) will be added here
		if ( class_exists( 'WooCommerce' ) ) {
			// wp_enqueue_style( 'diginovaplus-woocommerce', DIGINOVAPLUS_URI . 'assets/css/woocommerce.css', array( 'diginovaplus-style' ), $version );
		}

		if ( is_singular( 'diginovaplus_products' ) ) {
			// wp_enqueue_script( 'diginovaplus-single-product', DIGINOVAPLUS_URI . 'assets/js/single-product.js', array(), $version, true );
		}

		if ( is_page_template( 'page-templates/template-products.php' ) ) {
			wp_enqueue_script( 'diginovaplus-ajax-filter', DIGINOVAPLUS_URI . 'assets/js/ajax-filter.js', array('jquery'), $version, true );
		}

		if ( is_page_template( 'page-templates/template-vendor-dashboard.php' ) ) {
			wp_enqueue_script( 'chartjs', 'https://cdn.jsdelivr.net/npm/chart.js', array(), '4.4.0', true );
			wp_enqueue_script( 'diginovaplus-vendor-dashboard', DIGINOVAPLUS_URI . 'assets/js/vendor-dashboard.js', array('chartjs'), $version, true );
		}

		// Localize script for AJAX
		wp_localize_script( 'diginovaplus-theme', 'diginovaplus_ajax', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'diginovaplus-nonce' ),
		) );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
