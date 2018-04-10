<?php
namespace app;
class add_taxonomy
{
	public function __construct()
	{
		add_action( 'init',array ($this, 'taxonomies_expertise'), 0 );

		add_action( 'init',array ($this, 'taxonomies_profil'), 0 );

		add_action( 'init',array ($this, 'taxonomies_diagnostique'), 0 );

		add_action( 'init',array ($this, 'taxonomies_experience'), 0 );

		add_action( 'init',array ($this, 'taxonomies_salaire'), 0 );
	}

	/**
	* Creation de la Taxonomy expertise
	*/
	public function taxonomies_expertise(){
		$labels = array(
			'name'                       => _x( 'Expertises', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Expertise', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Expertise', 'text_domain' ),
			'all_items'                  => __( 'All Items', 'text_domain' ),
			'parent_item'                => __( 'Parent Item', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
			'new_item_name'              => __( 'New Item Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Item', 'text_domain' ),
			'edit_item'                  => __( 'Edit Item', 'text_domain' ),
			'update_item'                => __( 'Update Item', 'text_domain' ),
			'view_item'                  => __( 'View Item', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular Items', 'text_domain' ),
			'search_items'               => __( 'Search Items', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
			'no_terms'                   => __( 'No items', 'text_domain' ),
			'items_list'                 => __( 'Items list', 'text_domain' ),
			'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'expertise', array( 'job_listing' ), $args );
	}

	/**
	* Creation de la Taxonomy profil
	*/
	public function taxonomies_profil(){
		$labels = array(
			'name'                       => _x( 'Profils', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Profil', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Profil', 'text_domain' ),
			'all_items'                  => __( 'All Items', 'text_domain' ),
			'parent_item'                => __( 'Parent Item', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
			'new_item_name'              => __( 'New Item Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Item', 'text_domain' ),
			'edit_item'                  => __( 'Edit Item', 'text_domain' ),
			'update_item'                => __( 'Update Item', 'text_domain' ),
			'view_item'                  => __( 'View Item', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular Items', 'text_domain' ),
			'search_items'               => __( 'Search Items', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
			'no_terms'                   => __( 'No items', 'text_domain' ),
			'items_list'                 => __( 'Items list', 'text_domain' ),
			'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'profil', array( 'job_listing' ), $args );
	}

	/**
	* Creation de la Taxonomy diagnostique
	*/
	public function taxonomies_diagnostique(){
		$labels = array(
			'name'                       => _x( 'Diagnostics', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Diagnostic', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Diagnostic', 'text_domain' ),
			'all_items'                  => __( 'All Items', 'text_domain' ),
			'parent_item'                => __( 'Parent Item', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
			'new_item_name'              => __( 'New Item Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Item', 'text_domain' ),
			'edit_item'                  => __( 'Edit Item', 'text_domain' ),
			'update_item'                => __( 'Update Item', 'text_domain' ),
			'view_item'                  => __( 'View Item', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular Items', 'text_domain' ),
			'search_items'               => __( 'Search Items', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
			'no_terms'                   => __( 'No items', 'text_domain' ),
			'items_list'                 => __( 'Items list', 'text_domain' ),
			'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'diagnostic', array( 'job_listing' ), $args );
	}

	/**
	* Creation de la Taxonomy experience
	*/
	public function taxonomies_experience(){
		$labels = array(
			'name'                       => _x( 'Niveaux d\'experience', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Niveau d\'experience', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Niveau d\'experience', 'text_domain' ),
			'all_items'                  => __( 'All Items', 'text_domain' ),
			'parent_item'                => __( 'Parent Item', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
			'new_item_name'              => __( 'New Item Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Item', 'text_domain' ),
			'edit_item'                  => __( 'Edit Item', 'text_domain' ),
			'update_item'                => __( 'Update Item', 'text_domain' ),
			'view_item'                  => __( 'View Item', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular Items', 'text_domain' ),
			'search_items'               => __( 'Search Items', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
			'no_terms'                   => __( 'No items', 'text_domain' ),
			'items_list'                 => __( 'Items list', 'text_domain' ),
			'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'experience', array( 'job_listing' ), $args );
	}

	/**
	* Creation de la Taxonomy salaire
	*/
	public function taxonomies_salaire(){
		$labels = array(
			'name'                       => _x( 'Salaires', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Salaire', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Salaire', 'text_domain' ),
			'all_items'                  => __( 'All Items', 'text_domain' ),
			'parent_item'                => __( 'Parent Item', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
			'new_item_name'              => __( 'New Item Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Item', 'text_domain' ),
			'edit_item'                  => __( 'Edit Item', 'text_domain' ),
			'update_item'                => __( 'Update Item', 'text_domain' ),
			'view_item'                  => __( 'View Item', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular Items', 'text_domain' ),
			'search_items'               => __( 'Search Items', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
			'no_terms'                   => __( 'No items', 'text_domain' ),
			'items_list'                 => __( 'Items list', 'text_domain' ),
			'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'salaire', array( 'job_listing' ), $args );
	}
}