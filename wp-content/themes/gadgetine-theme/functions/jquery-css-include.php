<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	add_action( 'wp_enqueue_scripts', 'orange_themes_scripts');
	
	function orange_themes_scripts() { 
		global $wp_styles,$wp_scripts;
		$slider_enable = get_option(THEME_NAME."_slider_enable");
		$responsive = get_option(THEME_NAME."_responsive");
		$banner_type = get_option ( THEME_NAME."_banner_type" );

		//font settings	
		$_font_cyrillic_ex = get_option(THEME_NAME.'_font_cyrillic_ex');	
		$_font_cyrillic = get_option(THEME_NAME.'_font_cyrillic');	
		$_font_greek_ex = get_option(THEME_NAME.'_font_greek_ex');	
		$_font_greek = get_option(THEME_NAME.'_font_greek');	
		$_font_vietnamese = get_option(THEME_NAME.'_font_vietnamese');	
		$_font_latin_ex = get_option(THEME_NAME.'_font_latin_ex');	

		if($_font_cyrillic_ex=="on") {
			$_font_cyrillic_ex = ",cyrillic-ext";	
		} else {
			$_font_cyrillic_ex = false;
		}
		if($_font_cyrillic=="on") {
			$_font_cyrillic = ",cyrillic";	
		} else {
			$_font_cyrillic = false;
		}
		if($_font_greek_ex=="on") {
			$_font_greek_ex = ",greek-ext";	
		} else {
			$_font_greek_ex = false;
		}
		if($_font_greek=="on") {
			$_font_greek = ",greek";	
		} else {
			$_font_greek = false;
		}
		if($_font_vietnamese=="on") {
			$_font_vietnamese = ",vietnamese";	
		} else {
			$_font_vietnamese = false;
		}
		if($_font_latin_ex=="on") {
			$_font_latin_ex = ",latin-ext";	
		} else {
			$_font_latin_ex = false;
		}

		//include google fonts
		$google_fonts = array();
		for($i=1; $i<=21; $i++) {
			if(get_option(THEME_NAME."_google_font_".$i)) {
				$google_fonts[] = get_option(THEME_NAME."_google_font_".$i);	
			}
			
		}
		$google_fonts = array_unique($google_fonts);
		$i=1;
		foreach($google_fonts as $google_font) {
			$protocol = is_ssl() ? 'https' : 'http';
			if($google_font && $google_font!="Arial") {
				wp_enqueue_style( 'google-fonts-'.$i, $protocol."://fonts.googleapis.com/css?family=".str_replace(" ", "+", $google_font)."&subset=latin".$_font_cyrillic_ex.$_font_cyrillic.$_font_greek_ex.$_font_greek.$_font_vietnamese.$_font_latin_ex);
			}
			$i++;
		}
		
		wp_enqueue_style("reset", THEME_CSS_URL."reset.css", Array());
		wp_enqueue_style("font-awesome", THEME_CSS_URL."font-awesome.min.css", Array());
		wp_enqueue_style("dat-menu", THEME_CSS_URL."dat-menu.css", Array());
		wp_enqueue_style("main-stylesheet", THEME_CSS_URL."main-stylesheet.css", Array());
		wp_enqueue_style("lightbox", THEME_CSS_URL."lightbox.css", Array());
		wp_enqueue_style("shortcode", THEME_CSS_URL."shortcodes.css", Array());
		wp_enqueue_style("animate", THEME_CSS_URL."animate.css", Array());
		wp_enqueue_style("carousel", THEME_CSS_URL."owl.carousel.css", Array());
		
		


		if($responsive=="on") {
			wp_enqueue_style("responsive", THEME_CSS_URL."responsive.css", Array());
		}
		wp_enqueue_style('ie-only-styles', THEME_CSS_URL.'ie-ancient.css');
		
		$wp_styles->add_data('ie-only-styles', 'conditional', 'lt IE 8');



		wp_enqueue_style('dynamic-css', admin_url('admin-ajax.php').'?action=ot_dynamic_css');
 		wp_enqueue_style("style", get_stylesheet_uri(), Array());

 		// js files
		wp_enqueue_script("jquery");
		wp_enqueue_script("jquery-effects-slide");
		wp_enqueue_script("cookies" , THEME_JS_URL."admin/jquery.c00kie.js", Array('jquery'), "1.0", true);
		
		if($banner_type) {
			wp_enqueue_script("banner" , THEME_JS_URL."jquery.floating_popup.1.3.min.js", Array('jquery'), "1.0", true);
		}

			

		
		wp_enqueue_script("modernizr" , THEME_JS_URL."modernizr.custom.50878.js", Array('jquery'), '', true);
		wp_enqueue_script("iscroll" , THEME_JS_URL."iscroll.js", Array('jquery'), '', true);
		wp_enqueue_script("dat-menu" , THEME_JS_URL."dat-menu.js", Array('jquery'), '', true);
		wp_enqueue_script(THEME_JS_URL."-scripts" , THEME_JS_URL."theme-scripts.js", Array('jquery'), "", true);
		wp_enqueue_script("lightbox" , THEME_JS_URL."lightbox.js", Array('jquery'), '', true);
		wp_enqueue_script("owl-carousel" , THEME_JS_URL."owl.carousel.min.js", Array('jquery'), '', false);
		

		wp_enqueue_script("move" , THEME_JS_URL."jquery.event.move.js", Array('jquery'), '1.3.1', true);
		wp_enqueue_script("swipe" , THEME_JS_URL."jquery.event.swipe.js", Array('jquery'), '', true);
		wp_enqueue_script("isotope" , THEME_JS_URL."isotope.pkgd.min.js", Array('jquery'), '', true);
		wp_enqueue_script("masonry" , THEME_JS_URL."masonry.pkgd.min.js", Array('jquery'), '', true);
		wp_enqueue_script("infinitescroll" , THEME_JS_URL."jquery.infinitescroll.min.js", Array('jquery'), '', true);
		wp_enqueue_script("imagesloaded" , THEME_JS_URL."imagesloaded.pkgd.js", Array('jquery'), '', true);




		if ( is_singular() ) wp_enqueue_script( "comment-reply" );

		wp_enqueue_script("ot-gallery" , THEME_JS_URL."ot_gallery.js", Array('jquery'), "1.0", true);
		wp_enqueue_script("ot-scripts" , THEME_JS_URL."scripts.js", Array('jquery'), "1.0", true);
		wp_enqueue_script("scripts-wp" , THEME_JS_URL.THEME_NAME.".js", Array('jquery'), "1.0.0", true);
		wp_enqueue_script("dynamic-scripts" , admin_url('admin-ajax.php').'?action=ot_dynamic_js', "1.0", true);

		add_action( 'wp_footer', function() {
		   echo '<!--[if lte IE 9]><script src="'.THEME_JS_URL.'ie-fix.js".js"></script><![endif]-->';
		} );
		$post_type = get_post_type();
		if($post_type=="gallery") {
			$gallery_id =get_the_ID();
		} else { 
			$gallery_id = false;
		}
		
		wp_localize_script('jquery','ot',
			array(
				'THEME_NAME' => THEME_NAME,
				'adminUrl' => admin_url("admin-ajax.php"),
				'gallery_id' => $gallery_id,
				'galleryCat' => get_query_var('gallery-cat'),
				'imageUrl' => THEME_IMAGE_URL,
				'cssUrl' => THEME_CSS_URL,
				'themeUrl' => THEME_URL
			)
		);
		
	}
	
?>