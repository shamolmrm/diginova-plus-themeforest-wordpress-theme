<?php
/**
 * Register Taxonomies
 *
 * @package DigiNova_Plus_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DigiNova_Plus_Taxonomies {

	public function __construct() {
		add_action( 'init', array( $this, 'register_taxonomies' ), 0 );
	}

	public function register_taxonomies() {
		// Category (Hierarchical)
		$category_labels = array(
			'name'                       => _x( 'Categories', 'Taxonomy General Name', 'diginovaplus-core' ),
			'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'diginovaplus-core' ),
			'menu_name'                  => __( 'Categories', 'diginovaplus-core' ),
			'all_items'                  => __( 'All Categories', 'diginovaplus-core' ),
			'parent_item'                => __( 'Parent Category', 'diginovaplus-core' ),
			'parent_item_colon'          => __( 'Parent Category:', 'diginovaplus-core' ),
			'new_item_name'              => __( 'New Category Name', 'diginovaplus-core' ),
			'add_new_item'               => __( 'Add New Category', 'diginovaplus-core' ),
			'edit_item'                  => __( 'Edit Category', 'diginovaplus-core' ),
			'update_item'                => __( 'Update Category', 'diginovaplus-core' ),
			'view_item'                  => __( 'View Category', 'diginovaplus-core' ),
			'separate_items_with_commas' => __( 'Separate categories with commas', 'diginovaplus-core' ),
			'add_or_remove_items'        => __( 'Add or remove categories', 'diginovaplus-core' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'diginovaplus-core' ),
			'popular_items'              => __( 'Popular Categories', 'diginovaplus-core' ),
			'search_items'               => __( 'Search Categories', 'diginovaplus-core' ),
			'not_found'                  => __( 'Not Found', 'diginovaplus-core' ),
			'no_terms'                   => __( 'No categories', 'diginovaplus-core' ),
			'items_list'                 => __( 'Categories list', 'diginovaplus-core' ),
			'items_list_navigation'      => __( 'Categories list navigation', 'diginovaplus-core' ),
		);
		$category_args = array(
			'labels'                     => $category_labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => array( 'slug' => 'product-category' ),
			'show_in_rest'               => true,
		);
		register_taxonomy( 'diginovaplus_category', array( 'diginovaplus_products' ), $category_args );

		// Tag (Flat)
		$tag_labels = array(
			'name'                       => _x( 'Tags', 'Taxonomy General Name', 'diginovaplus-core' ),
			'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'diginovaplus-core' ),
			'menu_name'                  => __( 'Tags', 'diginovaplus-core' ),
			'all_items'                  => __( 'All Tags', 'diginovaplus-core' ),
			'new_item_name'              => __( 'New Tag Name', 'diginovaplus-core' ),
			'add_new_item'               => __( 'Add New Tag', 'diginovaplus-core' ),
			'edit_item'                  => __( 'Edit Tag', 'diginovaplus-core' ),
			'update_item'                => __( 'Update Tag', 'diginovaplus-core' ),
			'view_item'                  => __( 'View Tag', 'diginovaplus-core' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'diginovaplus-core' ),
			'add_or_remove_items'        => __( 'Add or remove tags', 'diginovaplus-core' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'diginovaplus-core' ),
			'popular_items'              => __( 'Popular Tags', 'diginovaplus-core' ),
			'search_items'               => __( 'Search Tags', 'diginovaplus-core' ),
			'not_found'                  => __( 'Not Found', 'diginovaplus-core' ),
			'no_terms'                   => __( 'No tags', 'diginovaplus-core' ),
			'items_list'                 => __( 'Tags list', 'diginovaplus-core' ),
			'items_list_navigation'      => __( 'Tags list navigation', 'diginovaplus-core' ),
		);
		$tag_args = array(
			'labels'                     => $tag_labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => array( 'slug' => 'product-tag' ),
			'show_in_rest'               => true,
		);
		register_taxonomy( 'diginovaplus_tag', array( 'diginovaplus_products' ), $tag_args );

		// Software Type (Hierarchical or Flat, let's go with Hierarchical for checkboxes)
		$software_labels = array(
			'name'                       => _x( 'Software Types', 'Taxonomy General Name', 'diginovaplus-core' ),
			'singular_name'              => _x( 'Software Type', 'Taxonomy Singular Name', 'diginovaplus-core' ),
			'menu_name'                  => __( 'Software Types', 'diginovaplus-core' ),
			'all_items'                  => __( 'All Software Types', 'diginovaplus-core' ),
			'parent_item'                => __( 'Parent Type', 'diginovaplus-core' ),
			'parent_item_colon'          => __( 'Parent Type:', 'diginovaplus-core' ),
			'new_item_name'              => __( 'New Type Name', 'diginovaplus-core' ),
			'add_new_item'               => __( 'Add New Type', 'diginovaplus-core' ),
			'edit_item'                  => __( 'Edit Type', 'diginovaplus-core' ),
			'update_item'                => __( 'Update Type', 'diginovaplus-core' ),
			'view_item'                  => __( 'View Type', 'diginovaplus-core' ),
			'separate_items_with_commas' => __( 'Separate types with commas', 'diginovaplus-core' ),
			'add_or_remove_items'        => __( 'Add or remove types', 'diginovaplus-core' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'diginovaplus-core' ),
			'popular_items'              => __( 'Popular Types', 'diginovaplus-core' ),
			'search_items'               => __( 'Search Types', 'diginovaplus-core' ),
			'not_found'                  => __( 'Not Found', 'diginovaplus-core' ),
			'no_terms'                   => __( 'No types', 'diginovaplus-core' ),
			'items_list'                 => __( 'Types list', 'diginovaplus-core' ),
			'items_list_navigation'      => __( 'Types list navigation', 'diginovaplus-core' ),
		);
		$software_args = array(
			'labels'                     => $software_labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => array( 'slug' => 'software-type' ),
			'show_in_rest'               => true,
		);
		register_taxonomy( 'diginovaplus_software_type', array( 'diginovaplus_products' ), $software_args );
	}
}

new DigiNova_Plus_Taxonomies();
