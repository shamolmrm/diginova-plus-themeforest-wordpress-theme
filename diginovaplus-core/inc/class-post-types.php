<?php
/**
 * Custom Post Types Registration
 *
 * @package DigiNovaPlusCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DigiNova_Plus_Core_Post_Types {

	public function __construct() {
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
	}

	public function register_post_types() {
		// Products CPT
		$labels = array(
			'name'               => _x( 'Products', 'post type general name', 'diginovaplus-core' ),
			'singular_name'      => _x( 'Product', 'post type singular name', 'diginovaplus-core' ),
			'menu_name'          => _x( 'Products', 'admin menu', 'diginovaplus-core' ),
			'name_admin_bar'     => _x( 'Product', 'add new on admin bar', 'diginovaplus-core' ),
			'add_new'            => _x( 'Add New', 'product', 'diginovaplus-core' ),
			'add_new_item'       => __( 'Add New Product', 'diginovaplus-core' ),
			'new_item'           => __( 'New Product', 'diginovaplus-core' ),
			'edit_item'          => __( 'Edit Product', 'diginovaplus-core' ),
			'view_item'          => __( 'View Product', 'diginovaplus-core' ),
			'all_items'          => __( 'All Products', 'diginovaplus-core' ),
			'search_items'       => __( 'Search Products', 'diginovaplus-core' ),
			'parent_item_colon'  => __( 'Parent Products:', 'diginovaplus-core' ),
			'not_found'          => __( 'No products found.', 'diginovaplus-core' ),
			'not_found_in_trash' => __( 'No products found in Trash.', 'diginovaplus-core' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'diginovaplus-core' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'product' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 5,
			'menu_icon'          => 'dashicons-cart',
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
			'show_in_rest'       => true,
		);

		register_post_type( 'diginovaplus_products', $args );
	}

	public function register_taxonomies() {
		// Product Category
		$labels = array(
			'name'              => _x( 'Categories', 'taxonomy general name', 'diginovaplus-core' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name', 'diginovaplus-core' ),
			'search_items'      => __( 'Search Categories', 'diginovaplus-core' ),
			'all_items'         => __( 'All Categories', 'diginovaplus-core' ),
			'parent_item'       => __( 'Parent Category', 'diginovaplus-core' ),
			'parent_item_colon' => __( 'Parent Category:', 'diginovaplus-core' ),
			'edit_item'         => __( 'Edit Category', 'diginovaplus-core' ),
			'update_item'       => __( 'Update Category', 'diginovaplus-core' ),
			'add_new_item'      => __( 'Add New Category', 'diginovaplus-core' ),
			'new_item_name'     => __( 'New Category Name', 'diginovaplus-core' ),
			'menu_name'         => __( 'Category', 'diginovaplus-core' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'product-category' ),
			'show_in_rest'      => true,
		);

		register_taxonomy( 'diginovaplus_category', array( 'diginovaplus_products' ), $args );
	}
}
