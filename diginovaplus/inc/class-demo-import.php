<?php
/**
 * One Click Demo Import Integration
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DigiNova_Plus_Demo_Import {

	public function __construct() {
		// Define demo import files
		add_filter( 'ocdi/import_files', array( $this, 'import_files' ) );

		// Run code after demo import
		add_action( 'ocdi/after_import', array( $this, 'after_import_setup' ) );

		// Disable OCDI branding
		add_filter( 'ocdi/disable_pt_branding', '__return_true' );
	}

	public function import_files() {
		return array(
			array(
				'import_file_name'             => __( 'DigiNova Plus Demo', 'diginovaplus' ),
				'categories'                   => array( 'Main Demo' ),
				'local_import_file'            => DIGINOVAPLUS_DIR . 'assets/demo/demo-content.xml',
				'import_preview_image_url'     => DIGINOVAPLUS_URI . 'assets/images/logo.png',
				'import_notice'                => __( 'This will import sample products and 3 different Home pages (SaaS, Marketplace, Creative).', 'diginovaplus' ),
				'preview_url'                  => 'https://example.com/demo',
			),
		);
	}

	public function after_import_setup() {
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

		if ( $main_menu ) {
			set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			) );
		}

		// Assign front page and posts page (blog page).
		$front_page_id = get_page_by_title( 'Home' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		if ( $front_page_id ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
		}
		
		if ( $blog_page_id ) {
			update_option( 'page_for_posts', $blog_page_id->ID );
		}

		// Setup WooCommerce pages if WooCommerce is active
		if ( class_exists( 'WooCommerce' ) ) {
			$shop_page_id = get_page_by_title( 'Shop' );
			$cart_page_id = get_page_by_title( 'Cart' );
			$checkout_page_id = get_page_by_title( 'Checkout' );
			$myaccount_page_id = get_page_by_title( 'My Account' );

			if ( $shop_page_id ) update_option( 'woocommerce_shop_page_id', $shop_page_id->ID );
			if ( $cart_page_id ) update_option( 'woocommerce_cart_page_id', $cart_page_id->ID );
			if ( $checkout_page_id ) update_option( 'woocommerce_checkout_page_id', $checkout_page_id->ID );
			if ( $myaccount_page_id ) update_option( 'woocommerce_myaccount_page_id', $myaccount_page_id->ID );
		}
	}
}

new DigiNova_Plus_Demo_Import();
