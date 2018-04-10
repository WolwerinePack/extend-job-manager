<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly




/* -------------------------------------------------------------------------*
 * 								CONTENT WIDTH								*
 * -------------------------------------------------------------------------*/
 
 if ( ! isset( $content_width ) ) 
    $content_width = 900;


/* -------------------------------------------------------------------------*
 * 							CATEGORIE CUSTOM COLOR							*
 * -------------------------------------------------------------------------*/	


	$config = array(
	   'pages' => array('category',OT_POST_GALLERY.'-cat',OT_POST_PORTFOLIO.'-cat'),                    // taxonomy name, accept categories, post_tag and custom taxonomies
	   'context' => 'normal',                           // where the meta box appear: normal (default), advanced, side; optional
	   'fields' => array(),                             // list of meta fields (can be added by field arrays)
	   'local_images' => false,                         // Use local or hosted images (meta box images for add/remove)
	   'use_with_theme' => true                        	//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);




	$sidebar_names = get_option( THEME_NAME."_sidebar_names" );
	$sidebar_names = explode( "|*|", $sidebar_names );
	$sidebars = array();
	$sidebars['default'] = 'Default';
	$sidebars['off'] = 'Off';

	if(!empty($sidebar_names)) {
		foreach ($sidebar_names as $sidebar) {
			if($sidebar!="") {
				$sidebars[strtolower($sidebar)] = $sidebar;
			}
		}
	}	

	$sidebarSmall = array();
	$sidebarSmall['off'] = 'Off';
	$sidebarSmall['default'] = 'Default';

	if(!empty($sidebar_names)) {
		foreach ($sidebar_names as $sidebar) {
			if($sidebar!="") {
				$sidebarSmall[strtolower($sidebar)] = $sidebar;
			}
		}
	}


	$sidebarPosition = get_option(THEME_NAME.'_sidebar_position');
	$sidebarPosition_2 = get_option(THEME_NAME.'_sidebar_position_2');

	$my_meta = new Tax_Meta_Class($config);
	$my_meta->addColor(THEME_NAME.'_title_color',array('name'=> esc_html('Categoy Color', THEME_NAME)));
	//$my_meta->addSelect(THEME_NAME.'_blog_style',array('1'=>'Style 1','2'=>'Style 2','3'=>'Style 3','4'=>'Style 4','5'=>'Style 5'),array('name'=> esc_html('Category Style ',THEME_NAME), 'std'=> array('1')));
	if($sidebarPosition=="custom") {
		$my_meta->addSelect(THEME_NAME.'_sidebar_position',array('right'=>esc_html('Right', THEME_NAME),'left'=>esc_html('Left', THEME_NAME)),array('name'=> esc_html('Main Sidebar Position ','tax-meta'), 'std'=> array('right')));
	}
	$my_meta->addSelect(THEME_NAME.'_sidebar_select', $sidebars ,array('name'=> esc_html('Main Sidebar','tax-meta'), 'std'=> array('default')));
	if($sidebarPosition_2=="custom") {
		$my_meta->addSelect(THEME_NAME.'_sidebar_position_2',array('right'=>esc_html('Right', THEME_NAME),'left'=>esc_html('Left', THEME_NAME)),array('name'=> esc_html('Second Sidebar Position ','tax-meta'), 'std'=> array('right')));
	}
	$my_meta->addSelect(THEME_NAME.'_sidebar_select_2', $sidebarSmall ,array('name'=> esc_html('Second Sidebar','tax-meta'), 'std'=> array('off')));
	//$my_meta->addSelect(THEME_NAME.'_breaking_slider',array('show'=>esc_html('Show', THEME_NAME),'slider_off'=>esc_html('Hide', THEME_NAME)),array('name'=> esc_html('Breaking News Slider',THEME_NAME), 'std'=> array('slider_off')));

	
	$my_meta->Finish();




	


/* -------------------------------------------------------------------------*
 * 					GET META VALUE OUTSIDE THE LOOP							*
 * -------------------------------------------------------------------------*/
 
 function ot_meta($id,$value) {
	$meta = get_post_meta($id, $value, true);
	return $meta;
}


/* -------------------------------------------------------------------------*
 * 								GET IMAGE HTML								*
 * -------------------------------------------------------------------------*/
 
 function ot_image_html($id, $width=0, $height=0, $class=false) {
 	$image = get_post_thumb($id,$width,$height);
 	if($class) {
 		$class = ' class="'.$class.'"';
 	} else {
 		$class = false;
 	}
 	if($image["show"]!=false) {
		$return = '<img'.$class.' src="'.$image["src"].'" alt="'.esc_attr(get_the_title($id)).'" />';
 	} else {
 		$return = false;
 	}

	return $return;
}

/* -------------------------------------------------------------------------*
 * 								NUMBER FORMAT								*
 * -------------------------------------------------------------------------*/

function ot_format($number) {
    $prefixes = 'kMGTPEZY';
    if ($number >= 1000) {
        for ($i=-1; $number>=1000; ++$i) {
            $number /= 1000;
        }
        return floor($number).$prefixes[$i];
    }
    return $number;
}

/* -------------------------------------------------------------------------*
 * 								GET IMAGE HTML								*
 * -------------------------------------------------------------------------*/
 
 function ot_updated_tag_html() {
 	if (get_the_modified_time() != get_the_time() && get_option(THEME_NAME."_updated_tag")=="on") {
 		echo '<span class="tag" title="'.esc_html("Last Update: ", THEME_NAME).get_the_modified_time("H:i, j.M Y").'">'.esc_html("Updated", THEME_NAME).'</span>';	
 	}
}


/* -------------------------------------------------------------------------*
 * 							OT GET SIDEBAR SIDE								*
 * -------------------------------------------------------------------------*/
 
function ot_get_sidebar($id) {

	//sidebars defauult option
	$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
	//sidebars singlepost/page option
	$sidebarPositionCustom = get_post_meta ( $id, THEME_NAME."_sidebar_position", true ); 

	//left side sidebar
	if( ($sidebarPosition == "left" || ( $sidebarPosition == "custom" &&  $sidebarPositionCustom == "left"))) { 
		get_template_part(THEME_INCLUDES."sidebar");
	}

	//right side sidebar
	if( ($sidebarPosition == "right" || ( $sidebarPosition == "custom" &&  $sidebarPositionCustom == "right") || ( $sidebarPosition == "custom" && !$sidebarPositionCustom ))) { 
		get_template_part(THEME_INCLUDES."sidebar");
	}

}

/* -------------------------------------------------------------------------*
 * 							CHECK IS THERE IS SIDEBAR						*
 * -------------------------------------------------------------------------*/
 
function ot_check_sidebar($id) {
	$sidebar = get_post_meta( $id, "_".THEME_NAME.'_sidebar_select', true );
	$sidebarSmall = get_post_meta( $id, "_".THEME_NAME.'_sidebar_select_2', true );

	if(($sidebar!="off" || $sidebar=="") && (!$sidebarSmall || $sidebarSmall=="off")) {
		return "large";
	} else if(($sidebarSmall!="off" || $sidebarSmall=="") && (!$sidebar || $sidebar=="off")) {
		return "small";
	} else if(($sidebarSmall!="off" || $sidebarSmall=="") && ($sidebar!="off" || $sidebar=="")) {
		return "both";
	} else if($sidebarSmall=="off" && $sidebar=="off") {
		return "off";
	}
}


/* -------------------------------------------------------------------------*
 * 							AVARAGE POST RATING							*
 * -------------------------------------------------------------------------*/
 
function ot_avarage_rating($id) {
 	$ratings = get_post_meta( $id, "_".THEME_NAME."_ratings", true );
	$totalRate = array();
	$rating = explode(";", $ratings);

	foreach($rating as $rate) { 
		$ratingValues = explode(":", $rate);
		if(isset($ratingValues[1])){
			$ratingPrecentage = (str_replace(",",".",$ratingValues[1]))*20;
			$totalRate[] = $ratingPrecentage;
		}
		
	} 

	if(!empty($totalRate)) {
		$rateCount = count($totalRate);	
		$total = 0;
		foreach ($totalRate as $val) {
			$total = $total + $val;
		}

		$avaragePrecentage = round($total/$rateCount,2);
		$avarageRate = round((($total/$rateCount)/20),1);

		return array($avaragePrecentage,$avarageRate);

	} else {
		return false;
	}

}

/* -------------------------------------------------------------------------*
 * 								GET TITLE COLOR								*
 * -------------------------------------------------------------------------*/
 
function ot_title_color($id, $type="category", $echo=true) {
 	if($type == "category" && $id!="popular" && $id!="latest") {
		$config = array(
		   'pages' => array('category',OT_POST_GALLERY.'-cat',OT_POST_PORTFOLIO.'-cat'),                    // taxonomy name, accept categories, post_tag and custom taxonomies
		   'context' => 'normal',                           // where the meta box appear: normal (default), advanced, side; optional
		   'fields' => array(),                             // list of meta fields (can be added by field arrays)
		   'local_images' => false,                         // Use local or hosted images (meta box images for add/remove)
		   'use_with_theme' => true                        	//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
		);
		$my_meta = new Tax_Meta_Class($config);
		$titleColor = $my_meta->get_tax_meta($id, THEME_NAME.'_title_color');
		$my_meta->Finish();
	} else if ($type=="page") {
		$titleColor = "#".ot_meta($id, "_".THEME_NAME."_title_color"); 
	} else if ($id=="popular") {
		$titleColor = "#".get_option(THEME_NAME."_popular_post_color");
	} else if ($id=="latest") {
		$titleColor = "#".get_option(THEME_NAME."_latest_post_color");
	}

	
	if(!isset($titleColor) || $titleColor=="" || $titleColor=="#") $titleColor = "#".get_option(THEME_NAME."_default_cat_color");
	
	if($echo!=false) {
		echo $titleColor;
	} else {
		return $titleColor;
	}
}

/* -------------------------------------------------------------------------*
 * 								GET OPTION									*
 * -------------------------------------------------------------------------*/
 
function ot_get_option($id, $type, $echo=false) {
	$config = array(
	   'pages' => array('category',OT_POST_GALLERY.'-cat',OT_POST_PORTFOLIO.'-cat'),                    // taxonomy name, accept categories, post_tag and custom taxonomies
	   'context' => 'normal',                           // where the meta box appear: normal (default), advanced, side; optional
	   'fields' => array(),                             // list of meta fields (can be added by field arrays)
	   'local_images' => false,                         // Use local or hosted images (meta box images for add/remove)
	   'use_with_theme' => true                        	//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);
	$my_meta = new Tax_Meta_Class($config);
	$value = $my_meta->get_tax_meta($id, THEME_NAME.'_'.$type);
	$my_meta->Finish();

	if($echo!=false) {
		echo $value;
	} else {
		return $value;
	}
}

/* -------------------------------------------------------------------------*
 * 							CHECK WOOCOMMERCE								*
 * -------------------------------------------------------------------------*/
 
function ot_is_woocommerce_activated() {
	if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
}

/* -------------------------------------------------------------------------*
 * 								CUSTOM COUNTER								*
 * -------------------------------------------------------------------------*/

class ot_custom_counter {
	public static $count = 0;

    public static function plus_one() {
		return ++self::$count;
	}
    public static function count() {
		return self::$count;
	}
    public static function reset_count($val) {
		self::$count = $val;
	}
}

/* -------------------------------------------------------------------------*
 * 							MAIN NAV MENU WALKER							*
 * -------------------------------------------------------------------------*/

class OT_Walker extends Walker_Nav_Menu {

	public static $count = 0;
	public static $parent_menu_type = 0;


    public static function plus_one() {
		return ++self::$count;
	}
    public static function count() {
		return self::$count;
	}
    public static function reset_count($val) {
		self::$count = $val;
	}


    public static function set_menu_type($val) {
		self::$parent_menu_type = $val;
	}
    public static function menu_type() {
		return self::$parent_menu_type;
	}

    function start_lvl( &$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$menu_type = $this->menu_type();
		$count = $this->count();
		if($menu_type=="2" && $depth==0) { 
			$output .= "\n$indent<ul class=\"ot-mega-menu\">\n";
		} elseif($menu_type=="2" && $depth==1 && $count==1) { 
			$output .= "\n$indent<ul class=\"widget-menu widget\">\n";
		}  elseif($menu_type=="2" && $depth==1 && $count==2) { 
			$output .= "\n$indent<ul class=\"widget\">\n";
		}  elseif($menu_type=="2" && $depth==1 && $count==3) { 
			$output .= "\n$indent<ul class=\"widget\">\n";
		} else {
			$output .= "\n$indent<ul class=\"sub-menu\">\n";	
		}
		
	}

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query, $ot_menu_catID;
		$config = array(
		   'pages' => array('category',OT_POST_GALLERY.'-cat',OT_POST_PORTFOLIO.'-cat'),                    // taxonomy name, accept categories, post_tag and custom taxonomies
		   'context' => 'normal',                           // where the meta box appear: normal (default), advanced, side; optional
		   'fields' => array(),                             // list of meta fields (can be added by field arrays)
		   'local_images' => false,                         // Use local or hosted images (meta box images for add/remove)
		   'use_with_theme' => true                        	//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
		);
		$my_meta = new Tax_Meta_Class($config);
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        if($depth==0) {
        	$this->set_menu_type($item->menu_type);
        	$parent_menu_type = $this->menu_type();
        } else {
       		$parent_menu_type = $this->menu_type();
        }

        if(($item->menu_type=="2" || $item->menu_type=="3") && $depth==0) {
        	$this->reset_count(0);
        	$OTclass = "has-ot-mega-menu ";
        } else {
        	$OTclass = "normal-drop ";
        }

        if(!$item->description) {
        	$OTclass .= "  no-description ";
        }


        $class_names = $value = '';

		if($depth==1) {
			$count = $this->plus_one();
		} else {
			$count = $this->count();
		}

		if($count==1 && $depth==2) {
			$megaClass = " color-light";
		} else {
			$megaClass = false;
		}

		$postDate = get_option(THEME_NAME."_post_date");
		$postComments = get_option(THEME_NAME."_post_comment");
		$postAuthor = get_option(THEME_NAME."_post_author");

 		//mega menu with widgets
		if(($parent_menu_type=="2") && ($depth==0)) {
	        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	        
	        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

	        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	        $class_names = ' class="'.$OTclass. esc_attr( $class_names ).'"';


	        if($depth==0) {

		        if($item->object=="category") {
					$titleColor = $my_meta->get_tax_meta($item->object_id, THEME_NAME.'_title_color');
				}
				if($item->object=="page") {
					$titleColor = "#".ot_meta($item->object_id, "_".THEME_NAME."_title_color"); 	
				}

				if(!isset($titleColor) || $titleColor=="#") $titleColor = "#".get_option(THEME_NAME."_default_cat_color"); 
				
				if(isset($titleColor) && $item->color=="yes") {
					$style=' style="border-top: 3px solid '.$titleColor.'; "';
				} else { 
					$style = false;
				}
				
			} else { 
				$style = false;
			}

			
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"'.$value . $class_names . $style.'>';	
			$item_output = $args->before;

			$item_output .= '<a'. $attributes .'>';

		    
		    	
 			$item_output .= '<span>';
	        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			
	        if($item->description) {
	        	//$item_output .= '<i>'.$item->description.'</i>';	
	        }
 			

		   
		    $item_output .= '</span>';


	        $item_output .= '</a>';

	        $item_output.= $indent . '<ul class="ot-mega-menu">';
				$item_output.= $indent . '<li>';
						ob_start();
						if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($item->menu_sidebar) ) :
						endif;
						$item_output.= ob_get_contents();
						ob_end_clean();
				$item_output.= $indent . '</li>';	
			$item_output.= $indent . '</ul>';	

			$item_output.= $args->after;

		} else { 	//default menu

	        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

	        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	        $class_names = ' class="'.$OTclass. esc_attr( $class_names ).'"';
	        
	        if($depth==0) {

		        if($item->object=="category") {
					$titleColor = $my_meta->get_tax_meta($item->object_id, THEME_NAME.'_title_color');
				}
				if($item->object=="page") {
					$titleColor = "#".ot_meta($item->object_id, "_".THEME_NAME."_title_color"); 	
				}

				if(!isset($titleColor) || $titleColor=="#") $titleColor = "#".get_option(THEME_NAME."_default_cat_color"); 
				
				if(isset($titleColor) && $item->color=="yes") {
					$style=' style="border-top: 3px solid '.$titleColor.'; "';
				} else { 
					$style = false;
				}
				
			} else { 
				$style = false;
			}

			$output .= $indent . '<li id="menu-item-'. $item->ID . '"'.$value . $class_names . $style.'>';	
				


	        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	        //$attributes .= $style;

	        //$attributes .= ' data-id="'. esc_attr( $item->object_id        ) .'"';
	        //$attributes .= ' data-slug="'. esc_attr(  basename(get_permalink($item->object_id )) ) .'"';

	        $item_output = $args->before;
	        $item_output .= '<a'. $attributes .'>';


		    if(isset($item->classes[4]) && in_array("ot-dropdown", $item->classes)) {
		      $item_output .= '<span>';
		    } 	
	        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			
	        if($item->description) {
	        	//$item_output .= '<i>'.$item->description.'</i>';	
	        }
		    if(isset($item->classes[4]) && in_array("ot-dropdown", $item->classes)) {
		      $item_output .= '</span>';
		    } 	


	        $item_output .= '</a>';
        	$item_output .= $args->after;

       		
        }
       

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		$my_meta->Finish();


    }
	
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}

/* -------------------------------------------------------------------------*
 * 								TOP NAV MENU WALKER							*
 * -------------------------------------------------------------------------*/

class OT_Walker_Top extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query;
		$config = array(
		   'pages' => array('category',OT_POST_GALLERY.'-cat',OT_POST_PORTFOLIO.'-cat'),                    // taxonomy name, accept categories, post_tag and custom taxonomies
		   'context' => 'normal',                           // where the meta box appear: normal (default), advanced, side; optional
		   'fields' => array(),                             // list of meta fields (can be added by field arrays)
		   'local_images' => false,                         // Use local or hosted images (meta box images for add/remove)
		   'use_with_theme' => true                        	//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
		);
		$my_meta = new Tax_Meta_Class($config);
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        
        if($depth==0) {
		    if(empty($item->description)) {
		      	$class = ' single';
		    } else {
		    	$class = false;
		    }	
        } else {
        	$class = false;
        }

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="' . esc_attr( $class_names.$class ).'"';

		
        $output .= $indent . '<li id="menu-item-'. $item->ID . '"'. $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        //$attributes .= ' data-id="'. esc_attr( $item->object_id        ) .'"';
        //$attributes .= ' data-slug="'. esc_attr(  basename(get_permalink($item->object_id )) ) .'"';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
       // if($depth==0) {
		    if(isset($item->classes[4]) && in_array("ot-dropdown", $item->classes)) {
		      $item_output .= '<span>';
		    } 	
        //}
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

       // if($depth==0 && $item->description ) {
       	//	$item_output .= '<i>'.$item->description.'</i>';
       	//}
        //if($depth==0) {
		   if(isset($item->classes[4]) && in_array("ot-dropdown", $item->classes)) {
		      $item_output .= '</span>';
		    } 	
        //}
        $item_output .= '</a>';

        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		$my_meta->Finish();



    }
}
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {
	
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'ot-dropdown'; 
		}
	}
	
	return $items;    
}


function remove_br($subject) {
	$subject = str_replace("<br/>", " ", $subject );
	$subject = str_replace("<br>", " ", $subject );
	$subject = str_replace("<br />", " ", $subject );
	return $subject;
}

function get_query_string_paged() {
	global $query_string;
	$pos = strpos($query_string,"paged=");
	if($pos !== false ) {
		$sub = substr($query_string,$pos);
		$posand = strpos($sub,"&");
		if ($posand == 0) {$paged = substr($sub,6);}
		else { $paged = substr($sub,6,$posand-6);}
		return $paged;
	}
	return 0;
}


function get_gallery_page() {
	$pages = get_pages();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == "template-gallery.php") {
			return $p->ID;
		}
	}
	return false;
}

function get_shop_page() {
	$pages = get_pages();
	$pageID = array();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == "template-shop.php") {
			$pageID[]=$p->ID;
		}
	}
	return $pageID;
}

function get_home_page() {
	$pages = get_pages();
	$pageID = array();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == "template-homepage.php") {
			$pageID[]=$p->ID;
		}
	}
	return $pageID;

}
function get_menu_page() {
	$pages = get_pages();
	$pageID = array();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == "template-menucard.php") {
			$pageID[]=$p->ID;
		}
	}
	return $pageID;

}
function get_events_page() {
	$pages = get_pages();
	$pageID = array();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == "template-events.php") {
			$pageID[]=$p->ID;
		}
	}
	return $pageID;

}

function get_archive_page() {
	$pages = get_pages();
	$pageID = array();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == "template-archive.php") {
			$pageID[]=$p->ID;
		}
	}
	return $pageID;

}

function get_fullwidth_page() {
	$pages = get_pages();
	$pageID = array();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == "template-full-width.php") {
			$pageID[]=$p->ID;
		}
	}
	return $pageID;

}
function get_map_page() {
	$pages = get_pages();
	$pageID = array();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == "template-sitemap.php") {
			$pageID[]=$p->ID;
		}
	}
	return $pageID;

}

function ot_get_page($name, $type="array") {

		$query = new WP_Query( 
			array( 
				'post_type' => 'page',
				'meta_key' => '_wp_page_template', 
				'meta_value' => 'template-'.$name.'.php', 
				'fields' => 'ids' ) 
			);

		if(isset($query->posts) && is_array($query->posts)) return ($query->posts);
		return false;

	}

function ot_get_page_array($name, $type="array") {

		$query = new WP_Query( 
			array( 
				'post_type' => 'page',
				'meta_key' => '_wp_page_template', 
				'meta_value' => 'template-'.$name.'.php', 
				'fields' => 'ids' ) 
			);

		if(isset($query->posts) && is_array($query->posts)) return ($query->posts);
		return false;

	}

/* -------------------------------------------------------------------------*
 * 								Awesome Icons								*
 * -------------------------------------------------------------------------*/

function ot_awesome_icons(){
	$icons = array(
		'Select a Icon',
		'fa-glass','fa-music','fa-search','fa-envelope-o','fa-heart','fa-star','fa-star-o','fa-user','fa-film','fa-th-large','fa-th','fa-th-list','fa-check','fa-times','fa-search-plus','fa-search-minus','fa-power-off','fa-signal','fa-cog','fa-trash-o','fa-home','fa-file-o','fa-clock-o','fa-road','fa-download','fa-arrow-circle-o-down','fa-arrow-circle-o-up','fa-inbox','fa-play-circle-o','fa-repeat','fa-refresh','fa-list-alt','fa-lock','fa-flag','fa-headphones','fa-volume-off','fa-volume-down','fa-volume-up','fa-qrcode','fa-barcode','fa-tag','fa-tags','fa-book','fa-bookmark','fa-print','fa-camera','fa-font','fa-bold','fa-italic','fa-text-height','fa-text-width','fa-align-left','fa-align-center','fa-align-right','fa-align-justify','fa-list','fa-outdent','fa-indent','fa-video-camera','fa-picture-o','fa-pencil','fa-map-marker','fa-adjust','fa-tint','fa-pencil-square-o','fa-share-square-o','fa-check-square-o','fa-arrows','fa-step-backward','fa-fast-backward','fa-backward','fa-play','fa-pause','fa-stop','fa-forward','fa-fast-forward','fa-step-forward','fa-eject','fa-chevron-left','fa-chevron-right','fa-plus-circle','fa-minus-circle','fa-times-circle','fa-check-circle','fa-question-circle','fa-info-circle','fa-crosshairs','fa-times-circle-o','fa-check-circle-o','fa-ban','fa-arrow-left','fa-arrow-right','fa-arrow-up','fa-arrow-down','fa-share','fa-expand','fa-compress','fa-plus','fa-minus','fa-asterisk','fa-exclamation-circle','fa-gift','fa-leaf','fa-fire','fa-eye','fa-eye-slash','fa-exclamation-triangle','fa-plane','fa-calendar','fa-random','fa-comment','fa-magnet','fa-chevron-up','fa-chevron-down','fa-retweet','fa-shopping-cart','fa-folder','fa-folder-open','fa-arrows-v','fa-arrows-h','fa-bar-chart-o','fa-twitter-square','fa-facebook-square','fa-camera-retro','fa-key','fa-cogs','fa-comments','fa-thumbs-o-up','fa-thumbs-o-down','fa-star-half','fa-heart-o','fa-sign-out','fa-linkedin-square','fa-thumb-tack','fa-external-link','fa-sign-in','fa-trophy','fa-github-square','fa-upload','fa-lemon-o','fa-phone','fa-square-o','fa-bookmark-o','fa-phone-square','fa-twitter','fa-facebook','fa-github','fa-unlock','fa-credit-card','fa-rss','fa-hdd-o','fa-bullhorn','fa-bell','fa-certificate','fa-hand-o-right','fa-hand-o-left','fa-hand-o-up','fa-hand-o-down','fa-arrow-circle-left','fa-arrow-circle-right','fa-arrow-circle-up','fa-arrow-circle-down','fa-globe','fa-wrench','fa-tasks','fa-filter','fa-briefcase','fa-arrows-alt','fa-users','fa-link','fa-cloud','fa-flask','fa-scissors','fa-files-o','fa-paperclip','fa-floppy-o','fa-square','fa-bars','fa-list-ul','fa-list-ol','fa-strikethrough','fa-underline','fa-table','fa-magic','fa-truck','fa-pinterest','fa-pinterest-square','fa-google-plus-square','fa-google-plus','fa-money','fa-caret-down','fa-caret-up','fa-caret-left','fa-caret-right','fa-columns','fa-sort','fa-sort-desc','fa-sort-asc','fa-envelope','fa-linkedin','fa-undo','fa-gavel','fa-tachometer','fa-comment-o','fa-comments-o','fa-bolt','fa-sitemap','fa-umbrella','fa-clipboard','fa-lightbulb-o','fa-exchange','fa-cloud-download','fa-cloud-upload','fa-user-md','fa-stethoscope','fa-suitcase','fa-bell-o','fa-coffee','fa-cutlery','fa-file-text-o','fa-building-o','fa-hospital-o','fa-ambulance','fa-medkit','fa-fighter-jet','fa-beer','fa-h-square','fa-plus-square','fa-angle-double-left','fa-angle-double-right','fa-angle-double-up','fa-angle-double-down','fa-angle-left','fa-angle-right','fa-angle-up','fa-angle-down','fa-desktop','fa-laptop','fa-tablet','fa-mobile','fa-circle-o','fa-quote-left','fa-quote-right','fa-spinner','fa-circle','fa-reply','fa-github-alt','fa-folder-o','fa-folder-open-o','fa-smile-o','fa-frown-o','fa-meh-o','fa-gamepad','fa-keyboard-o','fa-flag-o','fa-flag-checkered','fa-terminal','fa-code','fa-reply-all','fa-star-half-o','fa-location-arrow','fa-crop','fa-code-fork','fa-chain-broken','fa-question','fa-info','fa-exclamation','fa-superscript','fa-subscript','fa-eraser','fa-puzzle-piece','fa-microphone','fa-microphone-slash','fa-shield','fa-calendar-o','fa-fire-extinguisher','fa-rocket','fa-maxcdn','fa-chevron-circle-left','fa-chevron-circle-right','fa-chevron-circle-up','fa-chevron-circle-down','fa-html5','fa-css3','fa-anchor','fa-unlock-alt','fa-bullseye','fa-ellipsis-h','fa-ellipsis-v','fa-rss-square','fa-play-circle','fa-ticket','fa-minus-square','fa-minus-square-o','fa-level-up','fa-level-down','fa-check-square','fa-pencil-square','fa-external-link-square','fa-share-square','fa-compass','fa-caret-square-o-down','fa-caret-square-o-up','fa-caret-square-o-right','fa-eur','fa-gbp','fa-usd','fa-inr','fa-jpy','fa-rub','fa-krw','fa-btc','fa-file','fa-file-text','fa-sort-alpha-asc','fa-sort-alpha-desc','fa-sort-amount-asc','fa-sort-amount-desc','fa-sort-numeric-asc','fa-sort-numeric-desc','fa-thumbs-up','fa-thumbs-down','fa-youtube-square','fa-youtube','fa-xing','fa-xing-square','fa-youtube-play','fa-dropbox','fa-stack-overflow','fa-instagram','fa-flickr','fa-adn','fa-bitbucket','fa-bitbucket-square','fa-tumblr','fa-tumblr-square','fa-long-arrow-down','fa-long-arrow-up','fa-long-arrow-left','fa-long-arrow-right','fa-apple','fa-windows','fa-android','fa-linux','fa-dribbble','fa-skype','fa-foursquare','fa-trello','fa-female','fa-male','fa-gittip','fa-sun-o','fa-moon-o','fa-archive','fa-bug','fa-vk','fa-weibo','fa-renren','fa-pagelines','fa-stack-exchange','fa-arrow-circle-o-right','fa-arrow-circle-o-left','fa-caret-square-o-left','fa-dot-circle-o','fa-wheelchair','fa-vimeo-square','fa-try','fa-plus-square-o','fa-space-shuttle','fa-slack','fa-envelope-square','fa-wordpress','fa-openid','fa-university','fa-graduation-cap','fa-yahoo','fa-google','fa-reddit','fa-reddit-square','fa-stumbleupon-circle','fa-stumbleupon','fa-delicious','fa-digg','fa-pied-piper','fa-pied-piper-alt','fa-drupal','fa-joomla','fa-language','fa-fax','fa-building','fa-child','fa-paw','fa-spoon','fa-cube','fa-cubes','fa-behance','fa-behance-square','fa-steam','fa-steam-square','fa-recycle','fa-car','fa-taxi','fa-tree','fa-spotify','fa-deviantart','fa-soundcloud','fa-database','fa-file-pdf-o','fa-file-word-o','fa-file-excel-o','fa-file-powerpoint-o','fa-file-image-o','fa-file-archive-o','fa-file-audio-o','fa-file-video-o','fa-file-code-o','fa-vine','fa-codepen','fa-jsfiddle','fa-life-ring','fa-circle-o-notch','fa-rebel','fa-empire','fa-git-square','fa-git','fa-hacker-news','fa-tencent-weibo','fa-qq','fa-weixin','fa-paper-plane','fa-paper-plane-o','fa-history','fa-circle-thin','fa-header','fa-paragraph','fa-sliders','fa-share-alt','fa-share-alt-square','fa-bomb'
    );

	return $icons;
}


/* -------------------------------------------------------------------------*
 * 							GALLERY IMAGE SELECT							*
 * -------------------------------------------------------------------------*/
 
function ot_gallery_image_select($id, $value) {
	global $post_id,$post;
	if(!$post_id) {
		$post_id = $post->ID;
	}
	?>
	<div id="ot_images_container">
		<ul class="ot_gallery_images">
			<?php
				if ( $value ) {
					$product_image_gallery = $value;
				} else {
					// Backwards compat
					$attachment_ids = get_posts( 'post_parent=' . $post_id . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids&meta_value=0' );
					$attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
					$product_image_gallery = implode( ',', $attachment_ids );
				}

				$attachments = array_filter( explode( ',', $product_image_gallery ) );

				if ( $attachments )
					foreach ( $attachments as $attachment_id ) {
						echo '<li class="image" data-attachment_id="' . $attachment_id . '">
							' . wp_get_attachment_image( $attachment_id, array(80,80) ) . '
							<ul class="actions">
								<li><a href="#" class="delete" title="' . esc_html( 'Delete image', THEME_NAME ) . '">' . esc_html( 'Delete', THEME_NAME ) . '</a></li>
							</ul>
						</li>';
					}
			?>
		</ul>

		<input type="hidden" id="<?php echo $id;?>" name="<?php echo $id;?>" value="<?php echo esc_attr( $product_image_gallery ); ?>" />

	</div>
	<p class="add_product_images hide-if-no-js">
		<a href="#"><?php esc_html_e( 'Add images', THEME_NAME ); ?></a>
	</p>
	<script type="text/javascript">
		jQuery(document).ready(function($){

			// Uploading files
			var product_gallery_frame;
			var $image_gallery_ids = $('#<?php echo $id;?>');
			var $ot_gallery_images = $('#ot_images_container ul.ot_gallery_images');

			jQuery('.add_product_images').on( 'click', 'a', function( event ) {

				var $el = $(this);
				var attachment_ids = $image_gallery_ids.val();

				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( product_gallery_frame ) {
					product_gallery_frame.open();
					return;
				}

				// Create the media frame.
				product_gallery_frame = wp.media.frames.downloadable_file = wp.media({
					// Set the title of the modal.
					title: '<?php esc_html_e( 'Add Images to Product Gallery', THEME_NAME ); ?>',
					button: {
						text: '<?php esc_html_e( 'Add to gallery', THEME_NAME ); ?>',
					},
					multiple: true
				});

				// When an image is selected, run a callback.
				product_gallery_frame.on( 'select', function() {

					var selection = product_gallery_frame.state().get('selection');

					selection.map( function( attachment ) {

						attachment = attachment.toJSON();

						if ( attachment.id ) {
							attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

							$ot_gallery_images.append('\
								<li class="image" data-attachment_id="' + attachment.id + '">\
									<img src="' + attachment.url + '" width="80" height="80"/>\
									<ul class="actions">\
										<li><a href="#" class="delete" title="<?php echo addslashes(esc_html( 'Delete image', THEME_NAME )); ?>"> <?php echo addslashes(esc_html( 'Delete', THEME_NAME )); ?></a></li>\
									</ul>\
								</li>');
						}

					} );

					$image_gallery_ids.val( attachment_ids );
				});

				// Finally, open the modal.
				product_gallery_frame.open();
			});

			// Image ordering
			$ot_gallery_images.sortable({
				items: 'li.image',
				cursor: 'move',
				scrollSensitivity:40,
				forcePlaceholderSize: true,
				forceHelperSize: false,
				helper: 'clone',
				opacity: 0.65,
				placeholder: 'wc-metabox-sortable-placeholder',
				start:function(event,ui){
					ui.item.css('background-color','#f6f6f6');
				},
				stop:function(event,ui){
					ui.item.removeAttr('style');
				},
				update: function(event, ui) {
					var attachment_ids = '';

					$('#ot_images_container ul li.image').css('cursor','default').each(function() {
						var attachment_id = jQuery(this).attr( 'data-attachment_id' );
						attachment_ids = attachment_ids + attachment_id + ',';
					});

					$image_gallery_ids.val( attachment_ids );
				}
			});

			// Remove images
			$('#ot_images_container').on( 'click', 'a.delete', function() {

				$(this).closest('li.image').remove();

				var attachment_ids = '';

				$('#ot_images_container ul li.image').css('cursor','default').each(function() {
					var attachment_id = jQuery(this).attr( 'data-attachment_id' );
					attachment_ids = attachment_ids + attachment_id + ',';
				});

				$image_gallery_ids.val( attachment_ids );

				return false;
			} );

		});
	</script>
	<?php

}

/* -------------------------------------------------------------------------*
 * 								WIDGET COUNTER								*
 * -------------------------------------------------------------------------*/
 
function widget_first_last_classes($params) {

	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'first ';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'last ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

	return $params;

}

function orange_themes_follow() {
		echo "<!-- BEGIN .follow -->";
		echo "<div class=\"follow\">";
			echo "<p>Follow Orange Themes</p>";
			echo "<a href=\"http://themeforest.net/user/orange-themes?ref=orange-themes\" class=\"themeforest\" target=\"blank\">Theme Forest</a>";
			echo "<a href=\"http://twitter.com/#!/orangethemes\" class=\"twitter\" target=\"blank\">Twitter</a>";
			echo "<a href=\"http://www.orange-themes.com/\" class=\"orangethemes\" target=\"blank\">Orange-Themes.com</a>";
		echo "<!-- END .follow -->";
		echo "</div>";
	}	
	
function orange_themes_info_message($content) {
	?>
	<a href="javascript:{}" class="help"><img src="<?php echo THEME_IMAGE_CPANEL_URL; ?>ico-help-1.png" /></a>
	<i class="popup-help popup-help-hidden trans-1">
		<a href="javascript:{}" class="close"></a>
		<?php echo $content; ?>
	</i>
	<?php
}
	
$uploadsdir=wp_upload_dir();
define("THEME_UPLOADS_URL", $uploadsdir['url']);





/* -------------------------------------------------------------------------*
 * 							GRAVATAR SETTUP									*
 * -------------------------------------------------------------------------*/
 
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	$url = 'http://www.gravatar.com/avatar/';
	$url .= md5(strtolower(trim($email)));
	$url .= "?s=$s&d=$d&r=$r";
	if ( $img ) {
		$url = '<img src="' . $url . '"';
		foreach ( $atts as $key => $val )
			$url .= ' ' . $key . '="' . $val . '"';
		$url .= ' />';
	}
	return $url;
}

/* -------------------------------------------------------------------------*
 * 							GET VIDEO TYPE								*
 * -------------------------------------------------------------------------*/
 
function get_video_type( $code ) {
	if (strpos($code, "dailymotion.com") !== false) {
	    return 'dailymotion';
	} else if (strpos($code, "twitch.tv") !== false) {
	    return 'twitch';
	} else if (strpos($code, "vine.co") !== false) {
	    return 'vine';
	} else if (strpos($code, "vimeo.com") !== false) {
	    return 'vimeo';
	} else if (strpos($code, "soundcloud.com") !== false) {
	    return 'soundcloud';
	} else if (strpos($code, "mixcloud.com") !== false) {
	    return 'mixcloud';
	} else if (strpos($code, "youtube.com") !== false || strpos($code, "youtu.be") !== false) {
	    return 'youtube';
	} else { 
		return false;
	}
}



/* -------------------------------------------------------------------------*
 * 							REMOTE THUMBNAIL UPLOAD							*
 * -------------------------------------------------------------------------*/

function ot_image_upload($thumbnail, $postID, $desc = null) {
	if(!function_exists('download_url')) {
    	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
   	 	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
   	 	require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    }

    // Download file to temp location
    $tmp = download_url( $thumbnail );
    // Set variables for storage
    // fix file filename for query strings
    preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG)/', $thumbnail, $matches);
    $file_array['name'] = basename($matches[0]);
    $file_array['tmp_name'] = $tmp;
    // If error storing temporarily, unlink
    if ( is_wp_error( $tmp ) ) {
        @unlink($file_array['tmp_name']);
        $file_array['tmp_name'] = '';
    }
    // do the validation and storage stuff
    $id = media_handle_sideload( $file_array, $postID, null );
    // If error storing permanently, unlink
    if ( is_wp_error($id) ) {@unlink($file_array['tmp_name']);}
    add_post_meta($postID, '_thumbnail_id', $id, true);
}

/* -------------------------------------------------------------------------*
 * 							GET VIDEO THUMBNAIL								*
 * -------------------------------------------------------------------------*/
 
function ot_video_thumbnail( $code, $postID ) {

	$time = get_post_modified_time('U',false,$postID);
	if(!isset($time)){
		$time = "0";
	}

	$thumb = get_post_meta($postID, '_thumbnail_id', true);
	if($thumb !== false && $thumb) {
		//check if a thumbnail exists
		$thumbnail = get_post_thumb($postID,670,377); 
		return $thumbnail['src'];
	} else {

		$videoType = get_video_type($code); 
		//Dailymotion thumbnail

		if($videoType=="dailymotion") {
			preg_match('#<object[^>]+>.+?//www.dailymotion.com/swf/video/([A-Za-z0-9]+).+?</object>#s', $code, $matches);

	        // Dailymotion url
	        if(!isset($matches[1])) {
	            preg_match('#//www.dailymotion.com/video/([A-Za-z0-9]+)#s', $code, $matches);
	        }

	        // Dailymotion iframe
	        if(!isset($matches[1])) {
	            preg_match('#//www.dailymotion.com/embed/video/([A-Za-z0-9]+)#s', $code, $matches);
	        }
	 		$id =  $matches[1];

			$thumbnail ="https://api.dailymotion.com/video/".$id."?fields=thumbnail_large_url";
			$thumbnail = json_response($thumbnail, true);
			$thumbnail = $thumbnail['thumbnail_large_url'];

		} else if ($videoType=="twitch") {
			preg_match('#<object (.*)><param name=["|\']flashvars["|\'] value=["|\'](.*)["|\'] (.*)><\/object>#s', $code, $matches);

			if (strpos($matches[2], "chapter_id")) {
			    preg_match('/chapter_id=([^"]+)/', $matches[2], $match);
				$id = $match[1];

				$type = "a";
				$thumbnail = json_response("https://api.twitch.tv/kraken/videos/".$type.$id, true);
				$thumbnail = $thumbnail['preview'];
				if(!$thumbnail) {
					$type = "b";
					$thumbnail = json_response("https://api.twitch.tv/kraken/videos/".$type.$id, true);	
					$thumbnail = $thumbnail['preview'];
					if(!$thumbnail) {
						$type = "c";
						$thumbnail = json_response("https://api.twitch.tv/kraken/videos/".$type.$id, true);	
						$thumbnail = $thumbnail['preview'];
					} else {
						$thumbnail = $thumbnail['preview'];
					}
				} else {
					$thumbnail = $thumbnail['preview'];
				}


			} else if (strpos($matches[2], "archive_id")) {
			    preg_match('/archive_id=([^"]+)/', $matches[2], $match);
				$id = $match[1];

				$type = "a";
				$thumbnail = json_response("https://api.twitch.tv/kraken/videos/".$type.$id, true);
				if(!isset($thumbnail['preview'])) {
					$type = "b";
					$thumbnail = json_response("https://api.twitch.tv/kraken/videos/".$type.$id, true);	
					if(!isset($thumbnail['preview'])) {
						$type = "c";
						$thumbnail = json_response("https://api.twitch.tv/kraken/videos/".$type.$id, true);	
					} else {
						$thumbnail = $thumbnail['preview'];
					}
				} else {
					$thumbnail = $thumbnail['preview'];
				}

			} else {
			    preg_match('/channel=([a-zA-Z0-9_]\w*)/', $matches[2], $match);
				$channel = $match[1];
				$thumbnail = json_response("https://api.twitch.tv/kraken/channels/$channel/videos", true);

				$thumbnail = $thumbnail['videos'][0]['preview'];


			}
			
		} else if($videoType=="youtube") { // get youtube thumbnail
			preg_match('#<iframe(.*)([^src]*)(src=)([\'\"]?)([^>\s\'\"]+)([\'\"]?)#s', $code, $matches);
			$id = OT_youtube_image($matches[5]);
			$thumbnail = "http://img.youtube.com/vi/".$id."/0.jpg";
			
		} else if($videoType=="vine") { // get vine thumbnail
			preg_match('#<iframe(.*)([^src]*)(src=)([\'\"]?)([^>\s\'\"]+)([\'\"]?) (.*)><\/iframe>#s', $code, $matches);  // get src
			preg_match("#(?<=vine.co/v/)[0-9A-Za-z]+#", $matches[5], $match);  // get video id

			$args = array(
				'timeout' => '10',
				'redirection' => '10',
				'sslverify' => false // for localhost
			);

			$vine = wp_remote_get("https://vine.co/v/".$match[0], $args);

			preg_match('/property="og:image" content="(.*?)"/', $vine['body'], $match);

			$thumbnail = $match[1];

			
		} else if($videoType=="vimeo") { // get vimeo thumbnail
			preg_match('#<iframe(.*)([^src]*)(src=)([\'\"]?)([^>\s\'\"]+)([\'\"]?)#s', $code, $matches);
			$id = OT_youtube_image($matches[5]);
			$id = explode("?", $id, 2);

			$url = "http://vimeo.com/api/v2/video/".$id[0].".xml";
			$args = array(
				'timeout' => '10',
				'redirection' => '10',
				'sslverify' => false // for localhost
			);
				
			
			$raw = wp_remote_get( $url, $args );
			$hash = simplexml_load_string($raw['body']);
			$thumbnail = $hash[0]->video->thumbnail_large;

			
		}

		//retunr a thumbnail if it's set
		if(isset($thumbnail)) {
			ot_image_upload($thumbnail,$postID);
			return $thumbnail;
		} else {
			return false;
		}
	}

	
}



/* -------------------------------------------------------------------------*
 * 							WEATHER FORECAST								*
 * -------------------------------------------------------------------------*/
 
function OT_weather_forecast($ip) {
	$locationType = get_option(THEME_NAME."_weather_location_type");
	if($locationType == "custom") {
		$whitelist = array();
	} else {
		$whitelist = array('localhost', '127.0.0.1');
	}

	$weather_api = get_option(THEME_NAME."_weather_api");
	$weather_api_key_type = get_option(THEME_NAME."_weather_api_key_type");
	if($weather_api) {
		if(!in_array($_SERVER['HTTP_HOST'], $whitelist)){
			if($locationType == "custom") {
				$result = true;
			} else {
				$url = "http://www.geoplugin.net/json.gp?ip=".$ip;
				$result = json_response($url);
			}

			if($result!=false) {
				if($locationType == "custom") {
					$city = false;
					$country = false;
					$weatherResult = get_transient('weather_result_'.urlencode($ip));
				} else {
					$city = $result->geoplugin_city;
					$country = $result->geoplugin_countryName;
					$weatherResult = get_transient('weather_result_'.urlencode($city).'_'.urlencode($country));
				}

				
				if($weatherResult==false) {
					$temperature = get_option(THEME_NAME."_temperature");
					

					if($city) {
						if($weather_api_key_type=="premium") {
							$url = "http://api.worldweatheronline.com/premium/v2/weather.ashx?key=".$weather_api."&q=".urlencode($city).",".urlencode($country)."&num_of_days=1&includeLocation=yes&date=today&format=json";
						} else {
							$url = "http://api.worldweatheronline.com/free/v2/weather.ashx?key=".$weather_api."&q=".urlencode($city).",".urlencode($country)."&num_of_days=1&includeLocation=yes&date=today&format=json";
						}				
						$result = json_response($url);
					} else {
						if($weather_api_key_type=="premium") {
							$url = "http://api.worldweatheronline.com/premium/v2/weather.ashx?key=".$weather_api."&q=".$ip."&num_of_days=1&includeLocation=yes&date=today&format=json";
						} else {
							$url = "http://api.worldweatheronline.com/free/v2/weather.ashx?key=".$weather_api."&q=".$ip."&num_of_days=1&includeLocation=yes&date=today&format=json";
						}
						$result = json_response($url);
					}
				
					if($result!=false) {
						$weather = array();

			
						$weather['temp_F'] = $result->data->current_condition[0]->temp_F;	
						$weather['temp_C'] = $result->data->current_condition[0]->temp_C;
						

						// temperature color
						if ($weather['temp_C'] <= -25) {
							$weather['color'] = "reg-cold";
						} else if ($weather['temp_C'] > -25 && $weather['temp_C'] < -10) {
							$weather['color'] = "reg-cold";
						} else if ($weather['temp_C'] >= -10 && $weather['temp_C'] <= 4) {
							$weather['color'] = "reg-cold";
						} else if ($weather['temp_C'] > 5 && $weather['temp_C'] < 25) {
							$weather['color'] = "reg-normal";
						}  else if ($weather['temp_C'] >= 25) {
							$weather['color'] = "reg-hot";
						} 
						
						// add + before 
						$weather['temp_F'] = intval($weather['temp_F']);
						if($weather['temp_F']>0) {
							$weather['temp_F'] = "+".$weather['temp_F'];
						} else {
							$weather['temp_F'];
						}				

						// add + before 
						$weather['temp_C'] = intval($weather['temp_C']);
						if($weather['temp_C']>0) {
							$weather['temp_C'] = "+".$weather['temp_C'];
						} else {
							$weather['temp_C'];
						}

						$weather['temp_F'] = $weather['temp_F'].'&deg;F';
						$weather['temp_C'] = $weather['temp_C'].'&deg;C';

						$weatherCode = $result->data->current_condition[0]->weatherCode;
						$weather['city'] = $result->data->nearest_area[0]->areaName[0]->value;
						$weather['country'] = $result->data->nearest_area[0]->country[0]->value;


						switch ($weatherCode) {
							case '395':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Moderate or heavy snow in area with thunder', THEME_NAME);
								break;
							case '392':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Patchy light snow in area with thunder', THEME_NAME);
								break;
							case '371':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Moderate or heavy snow showers', THEME_NAME);
								break;
							case '368':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Light snow showers', THEME_NAME);
								break;
							case '350':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Ice pellets', THEME_NAME);
								break;
							case '338':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Heavy snow', THEME_NAME);
								break;
							case '335':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Patchy heavy snow', THEME_NAME);
								break;
							case '332':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Moderate snow', THEME_NAME);
								break;
							case '329':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Patchy moderate snow', THEME_NAME);
								break;
							case '326':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Light snow', THEME_NAME);
								break;
							case '323':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Patchy light snow', THEME_NAME);
								break;
							case '320':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Moderate or heavy sleet', THEME_NAME);
								break;
							case '317':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Light sleet', THEME_NAME);
								break;
							case '284':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Heavy freezing drizzle', THEME_NAME);
								break;
							case '281':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Freezing drizzle', THEME_NAME);
								break;
							case '266':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Light drizzle', THEME_NAME);
								break;
							case '263':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Patchy light drizzle', THEME_NAME);
								break;
							case '230':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Blizzard', THEME_NAME);
								break;
							case '227':
								$weather['image'] = "weather-snow";
								$weather['weatherDesc'] = esc_html('Blowing snow', THEME_NAME);
								break;
							case '389':
								$weather['image'] = "weather-thunder";
								$weather['weatherDesc'] = esc_html('Moderate or heavy rain in area with thunder', THEME_NAME);
								break;
							case '386':
								$weather['image'] = "weather-thunder";
								$weather['weatherDesc'] = esc_html('Patchy light rain in area with thunder', THEME_NAME);
								break;
							case '200':
								$weather['image'] = "weather-thunder";
								$weather['weatherDesc'] = esc_html('Thundery outbreaks in nearby', THEME_NAME);
								break;
							case '377':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Moderate or heavy showers of ice pellets', THEME_NAME);
								break;
							case '374':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Light showers of ice pellets', THEME_NAME);
								break;
							case '365':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Moderate or heavy sleet showers', THEME_NAME);
								break;
							case '362':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Light sleet showers', THEME_NAME);
								break;
							case '359':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Torrential rain shower', THEME_NAME);
								break;
							case '356':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Moderate or heavy rain shower', THEME_NAME);
								break;
							case '353':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Light rain shower', THEME_NAME);
								break;
							case '314':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Moderate or Heavy freezing rain', THEME_NAME);
								break;
							case '311':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Light freezing rain', THEME_NAME);
								break;
							case '308':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Heavy rain', THEME_NAME);
								break;
							case '305':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Heavy rain at times', THEME_NAME);
								break;
							case '302':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Moderate rain', THEME_NAME);
								break;
							case '299':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Moderate rain at times', THEME_NAME);
								break;
							case '296':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Light rain', THEME_NAME);
								break;
							case '293':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Patchy light rain', THEME_NAME);
								break;
							case '185':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Patchy freezing drizzle nearby', THEME_NAME);
								break;
							case '179':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Patchy snow nearby', THEME_NAME);
								break;
							case '176':
								$weather['image'] = "weather-rain";
								$weather['weatherDesc'] = esc_html('Patchy rain nearby', THEME_NAME);
								break;
							case '260':
								$weather['image'] = "weather-cloudy";
								$weather['weatherDesc'] = esc_html('Freezing fog', THEME_NAME);
								break;
							case '248':
								$weather['image'] = "weather-cloudy";
								$weather['weatherDesc'] = esc_html('Fog', THEME_NAME);
								break;
							case '143':
								$weather['image'] = "weather-cloudy";
								$weather['weatherDesc'] = esc_html('Mist', THEME_NAME);
								break;
							case '122':
								$weather['image'] = "weather-cloudy";
								$weather['weatherDesc'] = esc_html('Overcast', THEME_NAME);
								break;
							case '119':
								$weather['image'] = "weather-cloudy";
								$weather['weatherDesc'] = esc_html('Cloudy', THEME_NAME);
								break;
							case '116':
								$weather['image'] = "weather-clouds";
								$weather['weatherDesc'] = esc_html('Partly Cloudy', THEME_NAME);
								break;
							case '113':
								$weather['image'] = "weather-sun";
								$weather['weatherDesc'] = esc_html('Sunny', THEME_NAME);
								break;
							case '182':
								$weather['image'] = "weather-sleet";
								$weather['weatherDesc'] = esc_html('Patchy sleet nearby', THEME_NAME);
								break;
							default:
								$weather['image'] = "weather-default";
								$weather['weatherDesc'] = esc_html('Can\'t get any data.', THEME_NAME);
								break;
						}

						//set wp cache
						if($locationType == "custom") {
							set_transient('weather_result_'.urlencode($ip), $weather, 3600 );
						} else {
							set_transient( 'weather_result_'.urlencode($city).'_'.urlencode($country), $weather, 3600 );
						}
						
					} else {
						$weather['error'] = esc_html("Something went wrong with the connection!",THEME_NAME);
					}
				} else {
					//get wp cache
					if($locationType == "custom") {
						$weather = get_transient('weather_result_'.urlencode($ip));
					} else {
						$weather = get_transient('weather_result_'.urlencode($city).'_'.urlencode($country));
					}

				}
			} else {
				$weather['error'] = esc_html("Something went wrong with the connection!",THEME_NAME);
			}
		} else {
			$weather['error'] = esc_html("This option doesn't work on localhost!",THEME_NAME);
		}
	} else {

		$weather['error'] = esc_html("Please set up your API key!",THEME_NAME);

	}
	return $weather;
}

/* -------------------------------------------------------------------------*
 * 								GOOGLE + BUTTON								*
 * -------------------------------------------------------------------------*/
 
function OT_plusones($url) {
	if($url) {
	  	$curl = curl_init();
	  	curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
	  	curl_setopt($curl, CURLOPT_POST, 1);
	  	curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
	  	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	  	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
	  	$curl_results = curl_exec ($curl);
	  	curl_close ($curl);
	  	$json = json_decode($curl_results, true);
	  	return intval( $json[0]['result']['metadata']['globalCounts']['count'] );
	} else {
		return 0;
	}
}
/* -------------------------------------------------------------------------*
 * 								NEWS PAGE TITLE								*
 * -------------------------------------------------------------------------*/
 
function ot_page_title() {
	$post_type = get_post_type();
	//check if bbpress
	if (function_exists("is_bbpress") && is_bbpress()) {
		$OTbbpress = true;
	} else {
		$OTbbpress = false;
	}

	if(!is_archive() && !is_category() && !is_search() && $post_type!=OT_POST_GALLERY && $post_type!=OT_POST_PORTFOLIO) {
		$title = get_the_title(OT_page_id());
	} else if(is_single() && $post_type==OT_POST_GALLERY) {
		$galID = ot_get_page(OT_POST_GALLERY);
		$title = get_the_title($galID[0]);
	}  else if(is_single() && $post_type==OT_POST_PORTFOLIO) {
		$portID = ot_get_page(OT_POST_PORTFOLIO);
		$title = get_the_title($portID[0]);
	}  else if(is_search()) {
		$title = esc_html("Search Results for", THEME_NAME)." \"".remove_html($_GET['s'])."\"";
	} else if(is_category()) {
		$category = get_category( get_query_var( 'cat' ) );
		$cat_id = $category->cat_ID;
		$catName = get_category($cat_id )->name;
		$title = $catName;
	} else if (is_author()) {
		$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
		$title = esc_html("Posts From", THEME_NAME). " ".$curauth->display_name;
	} else if(is_tag()) {
		$category = single_tag_title('',false);
		$title =  esc_html("Tag", THEME_NAME)." \"".$category."\"";
	} else if(is_tax()) {
		$category = single_tag_title('',false);
		$title = $category;
	} else if(is_archive()) {
		if(ot_is_woocommerce_activated() == true && woocommerce_get_page_id('shop') == get_the_ID() || $OTbbpress==true) {
			$title = get_the_title(get_the_ID());
		} else {
			$title = esc_html("Archive", THEME_NAME);	
		}
	}else {
		$title = get_the_title(OT_page_id());
	}
	echo $title;
}

/* -------------------------------------------------------------------------*
 * 							CONTENT CLASS							*
 * -------------------------------------------------------------------------*/
 
function OT_content_class($id) {
	wp_reset_query();
	if(is_category()) {
		$catId = get_cat_id( single_cat_title("",false) );
		$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
		$sidebarPositionCustom = ot_get_option ( $catId, "sidebar_position"); 
	} elseif(is_tax()){
		$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
		$sidebarPositionCustom = ot_get_option ( get_queried_object()->term_id, "sidebar_position", false );
	} else {
		$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
		$sidebarPositionCustom = get_post_meta ( $id, "_".THEME_NAME."_sidebar_position", true ); 
	}
	
	if( $sidebarPosition == "left" || ( $sidebarPosition == "custom" && $sidebarPositionCustom == "left") ) { 
		$contentClass = "right";
	} else if( $sidebarPosition == "right" || ( $sidebarPosition == "custom" && $sidebarPositionCustom == "right") ) { 
		$contentClass = "left";
	} else if ( $sidebarPosition == "custom" && !$sidebarPositionCustom ) { 
		$contentClass = "left";
	} else {
		$contentClass = "left";
	}
	echo $contentClass;
}
/* -------------------------------------------------------------------------*
 * 								SIDEBAR CLASS								*
 * -------------------------------------------------------------------------*/
 
function OT_sidebarClass($id){
	wp_reset_query();
	if(is_category()) {
		$catId = get_cat_id( single_cat_title("",false) );
		$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
		$sidebarPositionCustom = ot_get_option ( $catId, "sidebar_position"); 
	} else {
		$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
		$sidebarPositionCustom = get_post_meta ( $id, "_".THEME_NAME."_sidebar_position", true ); 
	}
	if($sidebarPosition=="left" || ( $sidebarPosition == "custom" &&  $sidebarPositionCustom == "left") ) { $sidebarClass = 'left'; } else { $sidebarClass = 'right'; } 
    echo $sidebarClass;
}

/* -------------------------------------------------------------------------*
 * 							GET PAGE ID										*
 * -------------------------------------------------------------------------*/
 
function OT_page_id() {
	$page_id = get_queried_object_id();

	if(isset($page_id) && $page_id!=0) {
		return $page_id;	
	} elseif(ot_is_woocommerce_activated() == true) {
		return woocommerce_get_page_id('shop');
	}

}

/* -------------------------------------------------------------------------*
 * 							UPDATE POST VIEW COUNT							*
 * -------------------------------------------------------------------------*/
 
function OT_setPostViews() {
	global $post;
	if(is_single() && isset($post)) {
		$postID = $post->ID;
		$count_key = "_".THEME_NAME.'_post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		
		if ( !current_user_can( 'manage_options' ) && !isset($_COOKIE[THEME_NAME."_post_views_count_".$postID])) {
			if ( $count=='' ) {
				delete_post_meta($postID, $count_key);
				add_post_meta($postID, $count_key, '0');
			} else {
				$count++;
				update_post_meta($postID, $count_key, $count, $count-1);
			}
			
			setcookie(THEME_NAME."_post_views_count_".$postID, "1", time()+2678400); 
		}

	}
}

/* -------------------------------------------------------------------------*
 * 							GET POST VIEW COUNT								*
 * -------------------------------------------------------------------------*/
 
function OT_getPostViews($postID){
    $count_key = "_".THEME_NAME.'_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
   
   if( $count=='' ){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
	
    return $count;
}


/* -------------------------------------------------------------------------*
 * 							GET POST LIKES COUNT								*
 * -------------------------------------------------------------------------*/
 
function OT_getPostLikes($postID){
    $count_key = "_".THEME_NAME.'_post_likes_count';
    $count = get_post_meta($postID, $count_key, true);
   
   if( $count=='' ){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
	
    return $count;
}


/* -------------------------------------------------------------------------*
 * 								POST TYPE								*
 * -------------------------------------------------------------------------*/
 
	function OT_post_type($post_type) {
		switch ($post_type) {
			case "blog":
				$post_type="post";
				break;
			case "gallery":
				$post_type="gallery";
				break;
			case "all":
				$post_type=array("post","gallery");
				break;
			default:
				$post_type="post";
		}
		return $post_type;
	}

/* -------------------------------------------------------------------------*
 * 						 CUSTOM GET COMMENTS								*
 * -------------------------------------------------------------------------*/
 
	function ot_get_comments_number($id) {
		$num_comments = get_comments_number($id); // get_comments_number returns only a numeric value

		if ( $num_comments == 0 ) {
			$comments = esc_html('<strong>0</strong> comments', THEME_NAME);
		} elseif ( $num_comments > 1 ) {
			$comments = '<strong>'.$num_comments.'</strong>' . esc_html(' comments', THEME_NAME);
		} else {
			$comments = esc_html('<strong>1</strong> comment', THEME_NAME);
		}
		return $comments;
	}

 /* -------------------------------------------------------------------------*
 * 						ADD CUSTOM TEXT FORMATTING BUTTONS					*
 * -------------------------------------------------------------------------*/
global $orangethemes_buttons;
$orangethemes_buttons=array("orangethemesbutton", "orangethemesspacer", "orangethemesquote", "|",
			 "orangethemeslists", "|","orangethemesvideo","orangethemesgallery" ,"orangethemesmarker","orangethemestabs", "|",
			 "orangethemescaption","orangethemessocial", "|", "orangethemesparagraph", "orangethemesparagraph2", "orangethemesparagraph5", "orangethemesparagraph3", "orangethemesparagraph4", "orangethemesalert", "orangethemesaccordion", "orangethemestoggles", "|", "orangethemesbreak");

function add_orangethemes_buttons() {
   if ( get_user_option('rich_editing') == 'true') {
     add_filter('mce_external_plugins', 'add_orangethemes_btn_tinymce_plugin');
     add_filter('mce_buttons_3', 'register_orangethemes_buttons');
     add_filter('ot_mce_external_plugins', 'add_orangethemes_btn_tinymce_plugin');
     add_filter('ot_mce_buttons_3', 'register_orangethemes_buttons');
   }
}

function register_orangethemes_buttons($buttons) {
	global $orangethemes_buttons;
		
   array_push($buttons, implode(",",$orangethemes_buttons));
   return $buttons;
}

function add_orangethemes_btn_tinymce_plugin($plugin_array) {
	global $orangethemes_buttons;
	
	foreach($orangethemes_buttons as $btn){
		$plugin_array[$btn] = THEME_ADMIN_URL.'buttons-formatting/editor-plugin.js';
	}
	return $plugin_array;

}

 /* -------------------------------------------------------------------------*
 * 						PAGE BUILDER EDITOR JS					*
 * -------------------------------------------------------------------------*/
 function ot_editor_js() {
 ?>
 	<script type="text/javascript">
		OTtinymceSettings = {	
			theme:"modern",
			skin:"lightgray",
			language:"en",
			formats:{
				alignleft: [
					{selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign:'left'}},
					{selector: 'img,table,dl.wp-caption', classes: 'alignleft'}
				],
				aligncenter: [
					{selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign:'center'}},
					{selector: 'img,table,dl.wp-caption', classes: 'aligncenter'}
				],
				alignright: [
					{selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign:'right'}},
					{selector: 'img,table,dl.wp-caption', classes: 'alignright'}
				],
				strikethrough: {inline: 'del'}
			},
			relative_urls:false,
			remove_script_host:false,
			convert_urls:false,
			browser_spellcheck:true,
			keep_styles:false,
			preview_styles:"font-family font-size font-weight font-style text-decoration text-transform",
			plugins:"charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpautoresize,wpeditimage,wpgallery,wplink,wpdialogs,wpview,wpfullscreen",
			external_plugins:{
<?php
			$ot_mce_external_plugins = apply_filters( 'ot_mce_external_plugins', array() );
			foreach ( $ot_mce_external_plugins as $name => $url ) {
				echo '"'.$name.'":"'.set_url_scheme($url).'",';
			}
?>
			},
			selector:"#active-homepage-blocks .ot-tinymce",
			resize:false,
			menubar:false,
			indent:false,
			toolbar1:"bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,wp_fullscreen,wp_adv",
			toolbar2:"formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",
			toolbar3:"<?php $ot_mce_buttons_3 = apply_filters( 'ot_mce_buttons_3', array() );echo implode($ot_mce_buttons_3, ',');?>",
			body_class:"content post-type-page post-status-publish",
		};
	</script>
 <?php
 }

 /* ------------------------------------------------------------------------*
 * 							OTHER THEMES									*
 * -------------------------------------------------------------------------*/
 
 function other_themes () {
?>
		<!-- BEGIN more-orange-themes -->
		<div class="more-orange-themes">

			<div class="header">
				<img src="<?php echo THEME_IMAGE_MTHEMES_URL; ?>title-more-themes.png" alt="" width="447" height="23" />
				<p>
					<a href="http://www.themeforest.net/user/orange-themes/portfolio?ref=orange-themes" class="btn-1" target="_blank"><span><u class="themeforest">Check our portfolio at themeforest.net</u></span></a>
					<a href="http://www.twitter.com/#!/orangethemes" class="btn-1" target="_blank"><span><u class="twitter">Follow us on twitter</u></span></a>
					<a href="http://www.orange-themes.com" class="btn-1" target="_blank"><span><u class="orangethemes">Orange-themes.com</u></span></a>
				</p>
			</div>

			<?php 
				$xml = theme_get_latest_theme_version(THEME_NOTIFIER_CACHE_INTERVAL); 
				foreach ( $xml->item as $entry ) {
				$title = explode("Private: ", $entry->title);
			?>
			
			<!-- BEGIN .item -->
			<div class="item">
				<div class="image">
					<a href="<?php echo $entry->purchase; ?>"><img src="<?php echo $entry->image; ?>" /></a>
				</div>
				<div class="text">
					<h2><a href="<?php echo $entry->purchase; ?>"><?php echo $title[1]; ?></a></h2>
					<p><?php echo $entry->content; ?></p>
					<p class="link"><a href="<?php echo $entry->demo; ?>" target="_blank">Demo website</a></p>
					<p class="link"><a href="<?php echo $entry->purchase; ?>" target="_blank">Purchase at ThemeForest.net</a></p>
					<?php if ( $entry->html ) { ?>
						<p class="link"><a href="<?php echo $entry->html; ?>" target="_blank">HTML version</a></p>
					<?php } ?>
				</div>
			<!-- END .item -->
			</div>
			<?php } ?> 
			
		<!-- END more-orange-themes -->
		</div>
<?php
	
}

/* -------------------------------------------------------------------------*
 * 							COUNT ATTACHMENTS								*
 * -------------------------------------------------------------------------*/
 
function OT_attachment_count($post_id = false) {
	global $post;
    //Get all attachments
    $attachments = get_posts( array(
        'post_type' => 'attachment',
        'posts_per_page' => -1
    ) );

    $att_count = 0;
    if ( $attachments ) {
        foreach ( $attachments as $attachment ) {
            // Check for the post type based on individual attachment's parent
            if ( OT_POST_GALLERY == get_post_type($attachment->post_parent) && $post_id == $attachment->post_parent ) {
                $att_count = $att_count + 1;
            } else if (OT_POST_GALLERY == get_post_type($attachment->post_parent) && $post_id == false) {
				$att_count = $att_count + 1;
			}
        }
    }
	 return $att_count;
}

/* -------------------------------------------------------------------------*
 * 							CATEGORY ORDER								*
 * -------------------------------------------------------------------------*/
 
	function ot_category_order($order,$array) {
		if($order) {
		
			$order_array = explode(",", $order);
			$i=0;
		
			foreach($order_array as $id){
				foreach($array as $n => $category){
					if(is_object($category) && $category->term_id == $id){
						$array[$n]->order = $i;
						$i++;
					}
				}
							
				foreach($array as $n => $category){
					if(is_object($category) && !isset($category->order)){
						$array[$n]->order = 99999;
					}
				}
			}
					
			usort($array, THEME_NAME."_category_order_compare");
					
		}

		return $array;
		
	}
/* -------------------------------------------------------------------------*
 * 							GALLERY IMAGE COUNT								*
 * -------------------------------------------------------------------------*/
 
function OT_image_count($post_id = false) {
    //Get all images
   	$galleryImages = get_post_meta ( $post_id, THEME_NAME."_gallery_images", true ); 
   	$imageIDs = explode(",",$galleryImages);
   	$att_count = count(array_filter($imageIDs));

	return $att_count;
}

/* -------------------------------------------------------------------------*
 * 							CHECK PAGE TEMPLATE								*
 * -------------------------------------------------------------------------*/
 
function is_pagetemplate_active($pagetemplate = '') {
	global $wpdb;
	$sql = "select meta_key from $wpdb->postmeta where meta_key like '_wp_page_template' and meta_value like '" . $pagetemplate . "'";
	$result = $wpdb->query($sql);
	if ($result) {
		return TRUE;
	} else {
		return FALSE;
	}
}
/* -------------------------------------------------------------------------*
 * 								HEX -> RGB								*
 * -------------------------------------------------------------------------*/
 
function OTHexToRGB($hex) {
		$hex = ereg_replace("#", "", $hex);
		$color = array();
 
		if(strlen($hex) == 3) {
			$color['r'] = hexdec(substr($hex, 0, 1) . $r);
			$color['g'] = hexdec(substr($hex, 1, 1) . $g);
			$color['b'] = hexdec(substr($hex, 2, 1) . $b);
		}
		else if(strlen($hex) == 6) {
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
		}
 
		return $color;
}



/* -------------------------------------------------------------------------*
 * 								GET GOOGLE FONTS							*
 * -------------------------------------------------------------------------*/
 
function OT_get_google_fonts($sort = "alpha") {

	$font_list = get_option(THEME_NAME."_google_font_list");
	$font_list_time = get_option(THEME_NAME."_google_font_list_update");
	$now = time();
	$interval = 41600;
	
	if($font_list && (( $now - $font_list_time ) < $interval)) {
		$font_list = $font_list;
	} else if(!$font_list || (( $now - $font_list_time ) > $interval)) {
		$url = "https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCpatq_HIaUbw1XUxVAellP4M1Uoa6oibU&sort=" . $sort;
		$result = json_response( $url );

		if($result!=false) {
			$font_list = array();
			foreach ( $result->items as $font ) {

				$font_list[] .= $font->family;
				
			}

		update_option(THEME_NAME."_google_font_list",$font_list);
		update_option(THEME_NAME."_google_font_list_update",time());
		} else {
			$font_list = false;
		}

	} else {
		$font_list = false;
	}

		
	return $font_list;
	
}
/* -------------------------------------------------------------------------*
 * 								JSON RESPONSE								*
 * -------------------------------------------------------------------------*/
 
if ( ! function_exists( 'json_response' ) )	{

	function json_response( $url, $type = false )	{
			$args = array(
				 'timeout' => '10',
				 'redirection' => '10',
				 'sslverify' => false // for localhost
			);
			
			# Parse the given url
			$raw = wp_remote_get( $url, $args );
			if (!is_wp_error($raw)) {	
				if($type!=false) {
					$decoded = json_decode( $raw['body'],$type );	
				} else {
					$decoded = json_decode( $raw['body'] );
				}
				
				return $decoded;
			} else {

				//return $url;	
				return false;	
			}

	}

}
/* -------------------------------------------------------------------------*
 * 								USER COMMENT COUNT							*
 * -------------------------------------------------------------------------*/
 
function OT_user_comment_count( $user_id )	{
	global $wpdb;
	$where = 'WHERE comment_approved = 1 AND user_id = ' . $user_id ;
	$comment_count = $wpdb->get_var(
		"SELECT COUNT( * ) AS total
			FROM {$wpdb->comments}
			{$where}
		");

	return $comment_count;
}

/* -------------------------------------------------------------------------*
 * 								MENU NAME									*
 * -------------------------------------------------------------------------*/
 
function OT_et_theme_menu_name( $theme_location ) {
	if( ! $theme_location ) return false;
 
	$theme_locations = get_nav_menu_locations();
	if( ! isset( $theme_locations[$theme_location] ) ) return false;
 
	$menu_obj = get_term( $theme_locations[$theme_location], 'nav_menu' );
	if( ! $menu_obj ) $menu_obj = false;
	if( ! isset( $menu_obj->name ) ) return false;
 
	return $menu_obj->name;
}



/* -------------------------------------------------------------------------*
 * 							GET AMIN PAGE TYPE								*
 * -------------------------------------------------------------------------*/

function ot_get_current_post_type() {
  	global $post, $typenow, $current_screen;
	
  	//we have a post so we can just get the post type from that
  	if ( $post && $post->post_type )
    	return $post->post_type;
    
  	//check the global $typenow - set in admin.php
  	elseif( $typenow )
    	return $typenow;
    
  	//check the global $current_screen object - set in sceen.php
  	elseif( $current_screen && $current_screen->post_type )
    	return $current_screen->post_type;
  
 	 //lastly check the post_type querystring
  	elseif( isset( $_REQUEST['post_type'] ) )
    	return sanitize_key( $_REQUEST['post_type'] );

	elseif (get_post_type(isset($_REQUEST['post'])))
        return get_post_type($_REQUEST['post']);

  	//we do not know the post type!
  	return null;
}

/* -------------------------------------------------------------------------*
 * 							CHECK AMIN PAGE TYPE								*
 * -------------------------------------------------------------------------*/

function ot_page_type_check($value) {
	global $post_id;
	if(isset($value) && in_array(ot_get_current_post_type(), $value) && !in_array('!blog', $value)) {
		return true;
	} elseif (isset($value) && in_array(ot_get_current_post_type(), $value) && !in_array('blog', $value) && (in_array('!blog', $value) && $post_id != get_option('page_for_posts'))) {
		return true;
	} elseif (isset($value) && in_array('blog', $value) && $post_id == get_option('page_for_posts') && !in_array('!blog', $value)) {
		return true;
	}  elseif (isset($value) && in_array('blog', $value) && $post_id != get_option('page_for_posts') || in_array('!blog', $value) && $post_id != get_option('page_for_posts')) {
		return false;
	} elseif (isset($value) && in_array('!blog', $value) && $post_id == get_option('page_for_posts')) {
		return false;
	} elseif (isset($value) && in_array($post_id,ot_get_page_array($value))) {
		return true;
	} else {
		return false;
	}
}
/* -------------------------------------------------------------------------*
 * 							CHECK AMIN PAGE TEMPLATE						*
 * -------------------------------------------------------------------------*/

function ot_template_check($value) {
	global $post_id;
	if (!empty($value) && in_array($post_id,ot_get_page_array($value))) {
		return true;
	} else {
		return false;
	}
}
/* -------------------------------------------------------------------------*
 * 								OPTION COMPARE								*
 * -------------------------------------------------------------------------*/

function ot_option_compare($value, $valueSingle, $postID) {
	//post details
	$value = get_option(THEME_NAME."_".$value);
	$valueSingle = get_post_meta( $postID, "_".THEME_NAME."_".$valueSingle, true );

	if($value == "show" || ($value=="custom" && $valueSingle=="show") || ($value=="custom" && !$valueSingle)) {
		return true;
	} else {
		return false;
	}
}

/* -------------------------------------------------------------------------*
 * 								SUBMENU										*
 * -------------------------------------------------------------------------*/
function OT_submenu() {
	$subCats = array();
	$menu = false;
	
	if(is_category()) {
		$currentCategory = get_category( get_query_var( 'cat' ) );
		$currentID = $currentCategory->cat_ID;

		if(isset($currentCategory)) {
			
			if(isset($currentCategory->category_parent) && $currentCategory->category_parent!=0) {
				$catID = $currentCategory->category_parent;
			} else {
				$catID = $currentID;
			}
	
			$cats = get_categories(array('child_of' => $catID, 'hide_empty' => 0));												
			foreach ($cats as $cat) {
				$subCats[] = array(
					'url'		=> get_category_link( $cat->cat_ID ),
					'name'		=> $cat->name
				);
			}
		}
	} else if (is_single()) {
		$thisCategory = get_the_category();
		for($i=0; $i<=5; $i++) {
			if (!isset($thisCategory[$i]->category_parent)) break;
			if(isset($thisCategory[$i]->category_parent) && $thisCategory[$i]->category_parent!=0) {
				$catID[] = $thisCategory[$i]->category_parent;
			} else {
				$catID[] = $thisCategory[$i]->term_id;
			}
									
			$cats = get_categories(array('child_of' => $catID[$i], 'hide_empty' => 0));						
									
			foreach ($cats as $cat) {
				$subCats[] = array(
					'url'		=> get_category_link( $cat->cat_ID ),
					'name'		=> $cat->name
				);
			}

			$subCats = array_unique($subCats);
		}
	
	}
	

			
	if(!empty($subCats)) {
		$menu.= '<ul class="secondary-menu">';
		$c=1;
		foreach($subCats as $subCat) {
			$menu.= '<li><a href="'.$subCat['url'].'">'.$subCat['name'].'</a></li>';
			$c++;
			
			if($c>=6) {
				break; 
			}
		}
		$menu.= '</ul>';
	}
	
	echo $menu;
}

/* -------------------------------------------------------------------------*
 * 							COMMENT FORMATION								*
 * -------------------------------------------------------------------------*/

function orangethemes_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $orangeThemesCommentID;
	if(!ot_get_avatar_url(get_avatar( $comment, 80))) {
		$comentClass = "noavatar";
	} else {
		$comentClass = false;	
	}

	if($depth==1) {
		$orangeThemesCommentID = $orangeThemesCommentID+1;
	}
   ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	
	<div class="comment-block" id="comment-<?php comment_ID(); ?>">
		<?php if(ot_get_avatar_url(get_avatar( $comment, 60))) { ?>
			<a href="<?php if(get_comment_author_url()) { echo get_comment_author_url();} else { echo "#"; } ?>" class="image-avatar">
				<img src="<?php echo ot_get_avatar_url(get_avatar( $comment, 70, THEME_IMAGE_URL."no-avatar-70x70.jpg"));?>"  alt="<?php printf(esc_html('%1$s', THEME_NAME), get_comment_author());?>" title="<?php printf(esc_html('%1$s', THEME_NAME), get_comment_author());?>" class="user-avatar setborder"/>
			</a>
		<?php } ?>
		<div class="comment-text">
			<span class="time-stamp right"><?php printf(esc_html(' %1$s, %2$s', THEME_NAME), get_comment_date("F d"), get_comment_time("H:i"));?></span>
			<strong class="user-nick">
				<?php if($depth==1) { ?>
					<a href="<?php the_permalink();?>#comment-<?php comment_ID(); ?>" class="reply-id">#<?php echo $orangeThemesCommentID;?></a>
				<?php } ?>
				<a href="<?php if(get_comment_author_url()) { echo get_comment_author_url();} else { echo "#"; } ?>"><?php printf(esc_html('%1$s', THEME_NAME), get_comment_author());?></a>
				<?php if($comment->user_id == get_the_author_meta('ID')) { ?>
					<span class="user-author"><?php esc_html_e("Author", THEME_NAME);?></span>
				<?php } ?>
			</strong>
			<?php if ($comment->comment_approved == '0') : ?>
				<em style="padding-left:50px;"><?php esc_html_e( 'Your comment is awaiting moderation.' , THEME_NAME );?></em>
				<br />
			<?php endif; ?>
			<?php comment_text(); ?>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => ''.( esc_html( 'Reply to this comment' , THEME_NAME )).'<i class="fa fa-chevron-right"></i>'))) ?>
		</div>
		<div class="clear-float"></div>
	</div>



<?php
       }
	

	/* Fix pagination issue caused by Facebook plugin */

	function OT_fb_plugin_pagination_fix() {

	  //Check if plugin is activated and if we are on the homepage
	  if(class_exists('Facebook_Loader') && is_front_page()){
	    global $wp_query;
	    $page = get_query_var('page');
	    $paged = get_query_var('paged');

	    //Check if we are trying to reach pagination link
	    if($page > 1 || $paged > 1){
	      unset($wp_query->queried_object);
	     }

	  }

	}


add_action( 'admin_print_scripts', 'ot_editor_js' );
add_action( 'wp', 'OT_fb_plugin_pagination_fix', 99 );
add_action('init', 'add_orangethemes_buttons');
add_filter('dynamic_sidebar_params','widget_first_last_classes');
add_theme_support('automatic-feed-links' ); 
add_filter('wp', 'OT_setPostViews');


?>