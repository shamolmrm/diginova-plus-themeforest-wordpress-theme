<?php
/**
 * WooCommerce Integration
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DigiNova_Plus_WooCommerce {

	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' ); // We will use our own styles
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
		
		// Wrapper hooks
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_before_main_content', array( $this, 'wrapper_start' ), 10 );
		add_action( 'woocommerce_after_main_content', array( $this, 'wrapper_end' ), 10 );
	}

	public function setup() {
		add_theme_support( 'woocommerce', array(
			'thumbnail_image_width' => 600,
			'single_image_width'    => 800,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		) );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	public function scripts() {
		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_style( 'diginovaplus-woocommerce', DIGINOVAPLUS_URI . 'assets/css/woocommerce.css', array(), wp_get_theme()->get( 'Version' ) );
		}
	}

	public function wrapper_start() {
		echo '<div id="primary" class="content-area py-5 bg-light"><main id="main" class="site-main" role="main"><div class="container">';
	}

	public function wrapper_end() {
		echo '</div></main></div>';
	}
}

new DigiNova_Plus_WooCommerce();
