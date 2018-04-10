<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();

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

	// header custom html
	$customHTML = get_option(THEME_NAME."_custom_html");
	// header social icons
	$topIcons = get_option(THEME_NAME."_top_icons");
	$twitter = get_option(THEME_NAME."_twitter");
	$facebook = get_option(THEME_NAME."_facebook");
	$pinterest = get_option(THEME_NAME."_pinterest");
	$linkedin = get_option(THEME_NAME."_linkedin");
	if(get_option(THEME_NAME."_rss") != "") { 
		$rss = get_option(THEME_NAME."_rss");
	} else {
		$rss = get_bloginfo('rss2_url');
	}
?>
			<!-- BEGIN .content -->
			<section class="content">
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					<?php if($topIcons=="on" || $customHTML!="") { ?>
						<!-- BEGIN .full-block -->
						<div class="full-block with-border-bottom">
							<?php if($topIcons=="on") { ?>
								<div class="right social-content">
									<?php if($rss) { ?><a href="<?php echo $rss;?>" target="_blank" class="soc-rss-icon"><i class="fa fa-rss"></i></a><?php } ?>
									<?php if($pinterest) { ?><a href="<?php echo $pinterest;?>" target="_blank" class="soc-pinterest-icon"><i class="fa fa-pinterest"></i></a><?php } ?>
									<?php if($linkedin) { ?><a href="<?php echo $linkedin;?>" target="_blank" class="soc-linkedin-icon"><i class="fa fa-linkedin"></i></a><?php } ?>
									<?php if($facebook) { ?><a href="<?php echo $facebook;?>" target="_blank" class="soc-facebook-icon"><i class="fa fa-facebook"></i></a><?php } ?>
									<?php if($twitter) { ?><a href="<?php echo $twitter;?>" target="_blank" class="soc-twitter-icon"><i class="fa fa-twitter"></i></a><?php } ?>
								</div>
							<?php } ?>
							<?php if($customHTML) { ?>
								<div class="advert-links">
									<?php echo stripcslashes($customHTML);?>
								</div>
							<?php } ?>
							<div class="clear-float"></div>
							<!-- END .full-block -->
						</div>
					<?php } ?>

					<?php 
						if(is_page_template('template-homepage.php')) {
							 get_template_part(THEME_SLIDERS."main-slider");
						} 
					?>

					<div class="main-content-wrapper
					<?php if(($sidebar!="off" && ($sidebar_2 && $sidebar_2!="off")) || ($sidebar_2 && $sidebar_2!="off")) { echo " with-double-sidebar";} ?>
					<?php if($sidebarPosition=="left" && $sidebar!="off") { echo " big-sidebar-left";} elseif($sidebarPosition=="right" && $sidebar!="off") { echo " big-sidebar-right";} ?>
					<?php if($sidebarPosition_2=="right" && ($sidebar_2 && $sidebar_2!="off")) { echo " small-sidebar-right";} elseif($sidebarPosition_2=="left" && ($sidebar_2 && $sidebar_2!="off")) {  echo " small-sidebar-left"; } ?>">

						<!-- BEGIN .main-content -->
						<div class="main-content<?php if((!$sidebar_2 || $sidebar_2=="off") && $sidebar=="off") { echo "-spacy"; }?>">

						<?php wp_reset_query();  ?>