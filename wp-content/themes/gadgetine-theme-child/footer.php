<?php
	//main slider
	$autostartMain = get_option(THEME_NAME."_main_news_autostart");
	if($autostartMain=="on") {
		$autostart = "true";
	} else {
		$autostart = "false";
	}	
	$loopMain = get_option(THEME_NAME."_main_news_loop");
	if($loopMain=="on") {
		$loop = "true";
	} else {
		$loop = "false";
	}


	//copyright
	$copyRight = get_option(THEME_NAME."_copyright");

	// pop up banner
	$banner_type = get_option ( THEME_NAME."_banner_type" );
	
	$banner_fly_in = get_option ( THEME_NAME."_banner_fly_in" );
	$banner_fly_out = get_option ( THEME_NAME."_banner_fly_out" );
	$banner_start = get_option ( THEME_NAME."_banner_start" );
	$banner_close = get_option ( THEME_NAME."_banner_close" );
	$banner_overlay = get_option ( THEME_NAME."_banner_overlay" );
	$banner_views = get_option ( THEME_NAME."_banner_views" );
	$banner_timeout = get_option ( THEME_NAME."_banner_timeout" );
	
	$banner_text_image_img = get_option ( THEME_NAME."_banner_text_image_img" ) ;
	$banner_image = get_option ( THEME_NAME."_banner_image" );
	$banner_text = stripslashes ( get_option ( THEME_NAME."_banner_text" ) );
	
	if ( $banner_type == "image" ) {
	//Image Banner
		$cookie_name = substr ( md5 ( $banner_image ), 1,6 );
	} else if ( $banner_type == "text" ) { 
	//Text Banner
		$cookie_name = substr ( md5 ( $banner_text ), 1,6 );
	} else if ( $banner_type == "text_image" ) { 
	//Image And Text Banner
		$cookie_name = substr ( md5 ( $banner_text_image_img ), 1,6 );
	} else {
		$cookie_name = "popup";
	}

	if ( !$banner_start) {
		$banner_start = 0;
	}
	
	if ( !$banner_close) {
		$banner_close = 0;
	}
	
	if ( $banner_overlay == "on") {
		$banner_overlay = "true";
	} else {
		$banner_overlay = "false";
	}

	?>
			<!-- BEGIN .footer -->
			<footer class="footer">
					
				<!-- BEGIN .footer-widgets -->
				<div class="footer-widgets">
					<!-- BEGIN .wrapper -->
					<div class="wrapper">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('ot_footer') ) : ?>
							<?php dynamic_sidebar( 'footer-1' );?>
							<?php dynamic_sidebar( 'footer-2' );?>
							<?php dynamic_sidebar( 'footer-3' );?>
						<?php endif; ?>						
						<div class="clear-float"></div>
					</div>				
				<!-- END .footer-widgets -->
				</div>
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					<?php			
						if ( function_exists( 'register_nav_menus' )) {
							$args = array(
								'container' => '',
								'theme_location' => 'footer-menu',
								'menu_class'      => 'right',
								'items_wrap' => '<ul class="%2$s" rel="'.esc_html("Footer Menu", THEME_NAME).'">%3$s</ul>',
								'depth' => 1,
								"echo" => false
							);
										
							if(has_nav_menu('footer-menu')) {	
								echo wp_nav_menu($args);		
							} 

						}
					?>
					<p><?php echo stripslashes($copyRight);?></p>
				<!-- END .wrapper -->
				</div>
				
			<!-- END .footer -->
			</footer>
			
		<!-- END .boxed -->
		</div>

		<div class="lightbox">
			<div class="lightcontent-loading">
				<a href="#" onclick="javascript:lightboxclose();" class="light-close"><i class="fa fa-times"></i><?php esc_html_e("Close Window", THEME_NAME);?></a>
				<div class="loading-box">
					<h3><?php esc_html_e("Loading, Please Wait!", THEME_NAME);?></h3>
					<span><?php esc_html_e("This may take a second or two.", THEME_NAME);?></span>
					<span class="loading-image"><img src="<?php echo THEME_IMAGE_URL;?>loading.gif" title="" alt="" /></span>
				</div>
			</div>
			<div class="lightcontent"></div>
		</div>
<?php
	//main slider
	$mainSlider = get_post_meta ( OT_page_id(), "_".THEME_NAME."_main_slider", true ); 

	//slide counter
	$counter = 1;
	if((is_array($mainSlider) && !empty($mainSlider) && !in_array("slider_off",$mainSlider)) || (is_category() && $mainSlider=="on")) { 
		$args=array(
			'category__in' => $mainSlider,
			'posts_per_page' => get_option(THEME_NAME."_main_slider_count"),
			'order'	=> 'DESC',
			'orderby'	=> 'date',
			'meta_key'	=> "_".THEME_NAME.'_main_slider_post',
			'meta_value'	=> 'on',
			'post_type'	=> 'post',
			'ignore_sticky_posts '	=> 1,
			'post_status '	=> 'publish'
		);


		$the_query = new WP_Query($args);
		$post_count = $the_query ->post_count;
	} else {
		$post_count = 0;
	}

?>

		<script type="text/javascript">
			jQuery(".ot-slider").owlCarousel({
				items : 1,
				<?php if($post_count>=5) { ?>
					loop: <?php echo $loop;?>,
				<?php } ?>
				autoplay : <?php echo $autostart;?>,
				nav : true,
				lazyload : false,
				dots : false,
				margin : 15
			});
		</script>



<?php
			//pop up banner
			if ( $banner_type != "off" ) {
		?>
		

		<script type="text/javascript">
		<!--
		
		jQuery(document).ready(function($){
			$('#popup_content').popup( {
				starttime 			 : <?php echo $banner_start; ?>,
				selfclose			 : <?php echo $banner_close; ?>,
				popup_div			 : 'popup',
				overlay_div	 		 : 'overlay',
				close_id			 : 'baner_close',
				overlay				 : <?php echo $banner_overlay; ?>,
				opacity_level		 : 0.7,
				overlay_cc			 : false,
				centered			 : true,
				top	 		   		 : 130,
				left	 			 : 130,
				setcookie 			 : true,
				cookie_name	 		 : '<?php echo $cookie_name;?>',
				cookie_timeout 	 	 : <?php echo $banner_timeout; ?>,
				cookie_views 		 : <?php echo $banner_views ; ?>,
				floating	 		 : true,
				floating_reaction	 : 700,
				floating_speed 		 : 12,
				<?php 
					if ( $banner_fly_in != "off") { 
						echo "fly_in : true,
						fly_from : '".$banner_fly_in."', "; 
					} else {
						echo "fly_in : false,";
					}
				?>
				<?php 
					if ( $banner_fly_out != "off") { 
						echo "fly_out : true,
						fly_to : '".$banner_fly_out."', "; 
					} else {
						echo "fly_out : false,";
					}
				?>
				popup_appear  		 : 'show',
				popup_appear_time 	 : 0,
				confirm_close	 	 : false,
				confirm_close_text 	 : 'Do you really want to close?'
			} );
		});
		-->
		</script>
		<?php } ?>
	<?php wp_footer(); ?>
	<!-- END body -->
	</body>
<!-- END html -->
</html>