<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


	$page_layout = get_option(THEME_NAME."_page_layout");

	//logo settings
	$logo = get_option(THEME_NAME.'_logo');	

	$search = get_option(THEME_NAME.'_search');	

	//top banner	
	$topBanner = get_option(THEME_NAME."_top_banner");
	$topBannerCode = get_option(THEME_NAME."_top_banner_code");

	//fixed menu
	$menuStyle = get_option(THEME_NAME."_menu_style");

	$weatherSet = get_option(THEME_NAME."_weather");
	$weather = OT_weather_forecast($_SERVER['REMOTE_ADDR']);

	//rss button settings
	$rssButton = get_option(THEME_NAME."_rss_button");
	if(get_option(THEME_NAME."_rss") != "") { 
		$rss = get_option(THEME_NAME."_rss");
	} else {
		$rss = get_bloginfo('rss2_url');
	}
?>
		<!-- BEGIN .boxed -->
		<div class="boxed<?php echo $page_layout=="boxed" ? " active" : false; ?>">
			<?php if($rssButton=="on") { ?>
				<div class="rss-float">
					<a href="<?php echo $rss;?>" target="_blank"><i class="fa fa-rss"></i>&nbsp;&nbsp;<?php esc_html_e("Subscribe To RSS", THEME_NAME);?></a>
				</div>
			<?php } ?>
			<!-- BEGIN .header -->
			<header class="header">
				<?php if($weatherSet=="on" || has_nav_menu('top-menu')) { ?>
				<div class="top-line">
					<div class="wrapper">
				<?php } ?>
						<?php
							if($weatherSet=="on") { 
								if(!isset($weather['error'])) { 
						?>
									<div class="right weather-top">
										<span><?php esc_html_e("WEATHER",THEME_NAME);?><strong><?php echo $weather['country'].', '.$weather['city'];?></strong></span>
										<!--  -->
										<span class="weather-deg <?php echo $weather['color'];?>"><?php echo $weather['temp_'.get_option(THEME_NAME."_temperature")];?></span>
									</div>
						<?php 
								} else { 
									echo $weather['error'];
								} 
							}
						?>
						<?php

							if ( function_exists( 'register_nav_menus' )) {
								$walker = new OT_Walker_Top;
								$args = array(
									'container' => 'nav',
									'theme_location' => 'top-menu',
									'menu_class'      => 'top-menu load-responsive',
									'items_wrap' => '<ul class="%2$s" rel="'.esc_html("Top Menu", THEME_NAME).'">%3$s</ul>',
									'depth' => 3,
									'walker' => $walker,
									"echo" => false
								);
											
											
								if(has_nav_menu('top-menu')) {
									echo wp_nav_menu($args);
								}		

							}	

						?>						
				<?php if($weatherSet=="on" || has_nav_menu('top-menu')) { ?>
					</div>
				</div>
				<?php } ?>


				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					
					<!-- BEGIN .header-block -->
					<div class="header-block">
						<div class="header-logo">
							<?php if($logo) { ?>
									<a href="<?php echo home_url(); ?>"><img src="<?php echo $logo;?>" alt="<?php bloginfo('name'); ?>" /></a>
							<?php } else { ?>
									<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
							<?php } ?>
						</div>

						<?php if($topBanner=="on") { ?>
							<div class="header-banner">
								<?php //echo adrotate_group(1); ?>
							</div>
						<?php } ?>
					<!-- END .header-block -->
					</div>
					
				<!-- END .wrapper -->
				</div>


				<div class="header-menu">

					<nav class="main-menu">
					
						<?php if($search=="on") { ?>
							<div class="right head-searcher">
								<form method="get" action="<?php echo home_url(); ?>" name="searchform" >
									<input type="search" class="head-search-input" value="" placeholder="<?php esc_html_e("Search something..",THEME_NAME);?>" name="s" id="s"/>
									<input type="submit" class="head-search-button" value="s" />
								</form>
							</div>
						<?php } ?>

						
						<a href="#dat-menu" class="main-menu-reposnive-button"><i class="fa fa-bars"></i><?php esc_html_e("Show Menu", THEME_NAME);?></a>


						<?php	
			
							wp_reset_query();
							if ( function_exists( 'register_nav_menus' )) {
								$walker = new OT_Walker;
								$args = array(
									'container' => '',
									'theme_location' => 'main-menu',
									'menu_class'      => 'load-responsive',
									'items_wrap' => '<ul class="%2$s" rel="'.esc_html("Main Menu", THEME_NAME).'">%3$s</ul>',
									'depth' => 3,
									"echo" => false,
									'walker' => $walker
								);
											
											
								if(has_nav_menu('main-menu')) {
									echo wp_nav_menu($args);		
								} else {
									echo "<ul class=\"load-responsive\"><li class=\"navi-none\"><a href=\"".admin_url("nav-menus.php") ."\">Please set up ".THEME_FULL_NAME." menu!</a></li></ul>";
								}		

							}
						?>
			<!-- END .header -->
			</header>

<?php wp_reset_query(); ?>
