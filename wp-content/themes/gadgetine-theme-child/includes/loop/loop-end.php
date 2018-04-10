<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
	$post_type = get_post_type();

	//sidebars
	$sidebar = get_post_meta ( OT_page_ID(), "_".THEME_NAME."_sidebar_select", true ); 
	$sidebarPosition = get_post_meta ( OT_page_ID(), "_".THEME_NAME."_sidebar_position", true ); 
	$sidebar_2 = get_post_meta ( OT_page_ID(), "_".THEME_NAME."_sidebar_select_2", true ); 
	$sidebarPosition_2 = get_post_meta ( OT_page_ID(), "_".THEME_NAME."_sidebar_position_2", true ); 

	if(is_category()) {
		$catID = get_cat_id( single_cat_title("",false) );
		//sidebars
		$sidebar = ot_get_option ( $catID, "sidebar_select", false ); 
		$sidebarPosition = ot_get_option ( $catID, "sidebar_position", false ); 
		$sidebar_2 = ot_get_option ( $catID, "sidebar_select_2", false ); 
		$sidebarPosition_2 = ot_get_option ( $catID, "sidebar_position_2", false ); 
	} elseif(is_tax()){
		$sidebar = ot_get_option ( get_queried_object()->term_id, "sidebar_select", false );
		$sidebarPosition = ot_get_option ( get_queried_object()->term_id, "sidebar_position", false );
		$sidebar_2 = ot_get_option ( get_queried_object()->term_id, "sidebar_select_2", false );
		$sidebarPosition_2 = ot_get_option ( get_queried_object()->term_id, "sidebar_position_2", false );
	}


	if(is_search()) {
		$sidebar_2 = "off";
		$sidebarPosition_2 = "false";
		$sidebar = "default";
		$sidebarPosition = "right";
	}

	if ( $sidebar=='') {
		$sidebar='default';
	}		

	//default main sidebar position
	$defPosition = get_option(THEME_NAME."_sidebar_position");
	if (($sidebarPosition == '' && $defPosition != "custom") || ($sidebarPosition != '' && $defPosition != "custom")) {
		$sidebarPosition = $defPosition;
	} else if ((!$sidebarPosition && $defPosition == "custom") || ($sidebarPosition == '' && $defPosition == "custom")) {
		$sidebarPosition = "right";
	}
	
	//default small sidebar position
	$defPosition_2 = get_option(THEME_NAME."_sidebar_position_2");
	if (($sidebarPosition_2 == '' && $defPosition_2 != "custom") || ($sidebarPosition_2 != '' && $defPosition_2 != "custom")) {
		$sidebarPosition_2 = $defPosition_2;
	} else if ((!$sidebarPosition_2 && $defPosition_2 == "custom") || ($sidebarPosition_2 == '' && $defPosition_2 == "custom")) {
		$sidebarPosition_2 = "right";
	}


?>
				<!-- END .main-content-spacy -->
				</div>
				<?php 
					if($sidebar_2 && $sidebar_2!="off") {
						get_template_part(THEME_INCLUDES."sidebar","small");
					} 
					if($sidebar!="off") {
						get_template_part(THEME_INCLUDES."sidebar");
					}   


				?>
				</div>
				
			<!-- END .wrapper -->
			</div>
			
		<!-- BEGIN .content -->
		</section>


				