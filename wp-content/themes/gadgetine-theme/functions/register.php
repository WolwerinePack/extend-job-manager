<?php

$homepage = get_option( 'show_on_front');
if( $homepage == "page" ) {
	$meta = get_post_custom_values("_wp_page_template",get_option( 'page_on_front'));
	if($homepage == "page" && $meta[0] == "template-homepage.php") {$has_homepage=true;} else {$has_homepage=false;}
}
	
	
function register_my_menus() {
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array( 
				'top-menu' => esc_html( 'Top Menu', THEME_NAME ),
				'main-menu' => esc_html( 'Main Menu', THEME_NAME ),
				'footer-menu' => esc_html( 'Footer Menu', THEME_NAME ),
			)
		);
	}	
}

function create_gallery() {
		
	$labels = array(
    'name' => _x('Gallery', THEME_NAME),
    'singular_name' => _x('Gallery Menu', THEME_NAME),
    'add_new' => _x('Add New', THEME_NAME),
    'add_new_item' => esc_html('Add New Item', THEME_NAME),
    'edit_item' => esc_html('Edit Item', THEME_NAME),
    'new_item' => esc_html('New Gallery Item', THEME_NAME),
    'view_item' => esc_html('View Item', THEME_NAME),
    'search_items' => esc_html('Search Gallery Items', THEME_NAME),
    'not_found' =>  esc_html('No gallery items found', THEME_NAME),
    'not_found_in_trash' => esc_html('No gallery items found in Trash', THEME_NAME), 
    'parent_item_colon' => ''
	);
  
	register_taxonomy(OT_POST_GALLERY."-cat", 
					    	array("Gallery Categories"), 
					    	array(	"hierarchical" => true, 
					    			"label" => "Gallery Categories", 
					    			"singular_label" => "Gallery Categories", 
					    			"rewrite" => true,
					    			"query_var" => true
					    		));  
		
		register_post_type( OT_POST_GALLERY,
		array( 'labels' => $labels,
	         'public' => true,  
	         'show_ui' => true,  
	         'capability_type' => 'post',  
	         'hierarchical' => false,  
			 'taxonomies' => array(OT_POST_GALLERY.'-cat'),
	         'supports' => array('title', 'editor', 'thumbnail', 'comments', 'page-attributes', 'excerpt') ) );

}

function orange_register_sidebar($name, $id, $description){
	register_sidebar(array('name'=>$name,
		'id' => $id,
		'description' => $description,
		'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
	));
}



/* -------------------------------------------------------------------------*
 * 							DEFAULT SIDEBARS								*
 * -------------------------------------------------------------------------*/
$stickySidebar = get_option ( THEME_NAME."_sticky_sidebar" );
$orange_sidebars=array();
$orange_sidebars[] = array('name'=>esc_html('Default Sidebar', THEME_NAME), 'id'=>'default','description' => esc_html('The default page sidebar.', THEME_NAME));
$orange_sidebars[] = array('name'=>esc_html('Footer Widgets', THEME_NAME), 'id'=>'ot_footer', 'description' => esc_html('Footer widget area, supports up to 3 widgets.', THEME_NAME));	

if(function_exists('is_woocommerce')) {
	$orange_sidebars[] = array('name'=>'Woocommerce', 'id'=>'ot_woocommerce', 'description' => esc_html('Woocommerce Page Sidebar', THEME_NAME));	
}
if(function_exists("is_bbpress")) {
	$orange_sidebars[] = array('name'=>'bbPress', 'id'=>'ot_bbpress', 'description' => esc_html('bbPress Page Sidebar', THEME_NAME));
}
if(function_exists("is_buddypress")) {
	$orange_sidebars[] = array('name'=>'BuddyPress', 'id'=>'ot_buddypress', 'description' => esc_html('BuddyPress Page Sidebar', THEME_NAME));	
}
if($stickySidebar=="on") {
	$orange_sidebars[] = array('name'=>'Sicky Sidebar', 'id'=>'sicky_sidebar', 'description' => __('Sticky sidebar under the main sidebar, that will stay fixed while you scroll down the page', THEME_NAME));	
}


$sidebar_strings = get_option(THEME_NAME.'_sidebar_names');
$generated_sidebars = explode("|*|", $sidebar_strings);
array_pop($generated_sidebars);
$orange_generated_sidebars=array();
	
foreach($generated_sidebars as $sidebar) {
	$orange_sidebars[]=array('name'=>$sidebar, 'id'=>convert_to_class($sidebar), 'description'=>$sidebar);
	$orange_generated_sidebars[]=array('name'=>$sidebar, 'id'=>convert_to_class($sidebar), 'description'=>$sidebar);
}
 
 /* -------------------------------------------------------------------------*
 * 							REGISTER ALL SIDEBARS
 * -------------------------------------------------------------------------*/

if (function_exists('register_sidebar')) {
	
	//register the sidebars
	foreach($orange_sidebars as $sidebar){
		orange_register_sidebar($sidebar['name'], $sidebar['id'], $sidebar['description']);
	}
	
}

add_action('init', 'register_my_menus' );
add_theme_support( 'post-thumbnails' );
add_action('init', 'create_gallery');


?>