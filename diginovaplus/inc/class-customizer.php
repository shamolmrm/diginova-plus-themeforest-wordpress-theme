<?php
/**
 * Theme Customizer
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DigiNova_Plus_Customizer {

	public function __construct() {
		add_action( 'customize_register', array( $this, 'register' ) );
		add_action( 'wp_head', array( $this, 'customizer_css' ) );
	}

	public function register( $wp_customize ) {

		// 1. Theme Options Panel
		$wp_customize->add_panel( 'diginovaplus_theme_options', array(
			'title'       => __( 'Theme Options', 'diginovaplus' ),
			'description' => __( 'Configure theme settings.', 'diginovaplus' ),
			'priority'    => 160,
		) );

		// 1.1 Colors Section
		$wp_customize->add_section( 'diginovaplus_colors', array(
			'title'    => __( 'Colors', 'diginovaplus' ),
			'panel'    => 'diginovaplus_theme_options',
			'priority' => 10,
		) );

		// Primary Color
		$wp_customize->add_setting( 'diginovaplus_primary_color', array(
			'default'           => '#6C63FF',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'diginovaplus_primary_color', array(
			'label'   => __( 'Primary Color', 'diginovaplus' ),
			'section' => 'diginovaplus_colors',
		) ) );

		// 1.2 Header Section
		$wp_customize->add_section( 'diginovaplus_header', array(
			'title'    => __( 'Header', 'diginovaplus' ),
			'panel'    => 'diginovaplus_theme_options',
			'priority' => 20,
		) );

		// Header Style
		$wp_customize->add_setting( 'diginovaplus_header_style', array(
			'default'           => 'default',
			'sanitize_callback' => array( $this, 'sanitize_header_style' ),
		) );
		$wp_customize->add_control( 'diginovaplus_header_style', array(
			'type'    => 'select',
			'label'   => __( 'Header Style', 'diginovaplus' ),
			'section' => 'diginovaplus_header',
			'choices' => array(
				'default'     => __( 'Default', 'diginovaplus' ),
				'transparent' => __( 'Transparent (Absolute)', 'diginovaplus' ),
				'sticky'      => __( 'Sticky', 'diginovaplus' ),
			),
		) );

		// 1.3 Footer Section
		$wp_customize->add_section( 'diginovaplus_footer', array(
			'title'    => __( 'Footer', 'diginovaplus' ),
			'panel'    => 'diginovaplus_theme_options',
			'priority' => 30,
		) );

		// Footer Style
		$wp_customize->add_setting( 'diginovaplus_footer_style', array(
			'default'           => 'default',
			'sanitize_callback' => array( $this, 'sanitize_footer_style' ),
		) );
		$wp_customize->add_control( 'diginovaplus_footer_style', array(
			'type'    => 'select',
			'label'   => __( 'Footer Style', 'diginovaplus' ),
			'section' => 'diginovaplus_footer',
			'choices' => array(
				'default' => __( 'Default (Widgets)', 'diginovaplus' ),
				'minimal' => __( 'Minimal (Copyright only)', 'diginovaplus' ),
			),
		) );

		// 1.4 Single Product Section
		$wp_customize->add_section( 'diginovaplus_single_product', array(
			'title'    => __( 'Single Product', 'diginovaplus' ),
			'panel'    => 'diginovaplus_theme_options',
			'priority' => 40,
		) );

		// Product Layout
		$wp_customize->add_setting( 'diginovaplus_single_product_layout', array(
			'default'           => '1',
			'sanitize_callback' => array( $this, 'sanitize_product_layout' ),
		) );
		$wp_customize->add_control( 'diginovaplus_single_product_layout', array(
			'type'    => 'select',
			'label'   => __( 'Product Page Layout', 'diginovaplus' ),
			'section' => 'diginovaplus_single_product',
			'choices' => array(
				'1' => __( 'Layout 1 (Standard with Sidebar)', 'diginovaplus' ),
				'2' => __( 'Layout 2 (Full Width Header)', 'diginovaplus' ),
			),
		) );
	}

	public function sanitize_header_style( $input ) {
		$valid = array( 'default', 'transparent', 'sticky' );
		return in_array( $input, $valid ) ? $input : 'default';
	}

	public function sanitize_footer_style( $input ) {
		$valid = array( 'default', 'minimal' );
		return in_array( $input, $valid ) ? $input : 'default';
	}

	public function sanitize_product_layout( $input ) {
		$valid = array( '1', '2' );
		return in_array( $input, $valid ) ? $input : '1';
	}

	public function customizer_css() {
		$primary_color = get_theme_mod( 'diginovaplus_primary_color', '#6C63FF' );

		// Only output if color has changed from default
		if ( '#6C63FF' !== $primary_color ) {
			// Basic RGB conversion for css vars
			list($r, $g, $b) = sscanf($primary_color, "#%02x%02x%02x");
			
			echo '<style type="text/css" id="diginovaplus-customizer-css">';
			echo ':root {';
			echo '--bs-primary: ' . esc_attr( $primary_color ) . ';';
			echo '--bs-primary-rgb: ' . esc_attr( "$r, $g, $b" ) . ';';
			echo '}';
			echo '</style>';
		}
	}
}

new DigiNova_Plus_Customizer();
