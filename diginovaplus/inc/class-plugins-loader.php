<?php
/**
 * TGM Plugin Activation configuration
 *
 * @package DigiNova_Plus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once DIGINOVAPLUS_DIR . 'inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'diginovaplus_register_required_plugins' );

function diginovaplus_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'DigiNova Plus Core',
			'slug'      => 'diginovaplus-core',
			'source'    => get_template_directory() . '/plugins/diginovaplus-core.zip',
			'required'  => true,
		),
		array(
			'name'      => 'Elementor',
			'slug'      => 'elementor',
			'required'  => true,
		),
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => true,
		),
		array(
			'name'      => 'One Click Demo Import',
			'slug'      => 'one-click-demo-import',
			'required'  => true,
		),
	);

	$config = array(
		'id'           => 'diginovaplus',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
