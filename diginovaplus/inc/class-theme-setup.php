<?php
/**
 * Theme setup and configuration
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class DigiNova_Plus_Theme_Setup {

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
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
	}

	/**
	 * Setup theme supported features.
	 */
	public function setup() {
		// Load text domain.
		load_theme_textdomain( 'diginovaplus', get_template_directory() . '/languages' );

		// Theme supports.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		) );
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'dark-editor-style' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Image sizes.
		add_image_size( 'diginovaplus-product-grid', 600, 400, true );
		add_image_size( 'diginovaplus-product-thumb', 300, 200, true );
		add_image_size( 'diginovaplus-product-mini', 100, 100, true );

		// Register menus.
		register_nav_menus( array(
			'primary'  => esc_html__( 'Primary Menu', 'diginovaplus' ),
			'footer-1' => esc_html__( 'Footer Menu 1', 'diginovaplus' ),
			'footer-2' => esc_html__( 'Footer Menu 2', 'diginovaplus' ),
			'footer-3' => esc_html__( 'Footer Menu 3', 'diginovaplus' ),
		) );
	}

	/**
	 * Register widget areas.
	 */
	public function register_sidebars() {
		register_sidebar( array(
			'name'          => esc_html__( 'Main Sidebar', 'diginovaplus' ),
			'id'            => 'main-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'diginovaplus' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'diginovaplus' ),
			'id'            => 'shop-sidebar',
			'description'   => esc_html__( 'Sidebar for WooCommerce and products directory.', 'diginovaplus' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		for ( $i = 1; $i <= 4; $i++ ) {
			register_sidebar( array(
				'name'          => sprintf( esc_html__( 'Footer %d', 'diginovaplus' ), $i ),
				'id'            => 'footer-' . $i,
				'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'diginovaplus' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			) );
		}
	}
}
