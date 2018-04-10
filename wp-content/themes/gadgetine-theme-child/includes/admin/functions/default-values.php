<?php
	/* -------------------------------------------------------------------------*
	 * 						SET DEFAULT VALUES BY THEME INSTALL					*
	 * -------------------------------------------------------------------------*/
	global $pagenow;
	get_template_part(THEME_INCLUDES."/lib/class-tgm-plugin-activation");

	// with activate istall option
	if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
		$theme_logo = THEME_IMAGE_URL."logo.png";
		$theme_logo_f = THEME_IMAGE_URL."logo-footer.png";
		$favicon = THEME_IMAGE_URL."favicon.png";
		$banner = '	<a href="http://www.orange-themes.com" target="_blank"><img src="'.THEME_IMAGE_URL.'no-banner-728x90.jpg" alt="" title="" /></a>';
		$customHTML = '
									<span>Custom links here:</span>
									<a href="#">Google Adsense</a>
									<a href="#">Cheap laptops and netbooks</a>
									<a href="#">lpad, Laptops &amp; Books</a>
									<a href="#">Cheapest Cell Phones</a>
									<a href="#">Buy Quality HP laptops</a>
		';
		$copyright = '&copy; '.date("Y").' Copyright <b>'.THEME_FULL_NAME.' theme</b>. All Rights reserved.';
		
		update_option(THEME_NAME."_logo", $theme_logo);
		
		update_option(THEME_NAME.'_top_banner', 'on');
		update_option(THEME_NAME.'_top_banner_code', $banner);

		update_option(THEME_NAME.'_custom_html', $customHTML);

		update_option(THEME_NAME.'_rss_button', 'on');
		
		update_option(THEME_NAME.'_main_news_autostart', 'on');
		update_option(THEME_NAME.'_main_news_loop', 'on');
		update_option(THEME_NAME.'_main_slider_count', '10');

		
		update_option(THEME_NAME.'_google_font_1', 'Open Sans');
		update_option(THEME_NAME.'_google_font_2', 'Open Sans');
		update_option(THEME_NAME.'_google_font_3', 'Open Sans');
		update_option(THEME_NAME.'_font_size_1', '16');
		update_option(THEME_NAME.'_body_bg_type', 'pattern');
		update_option(THEME_NAME.'_color_1', '2c3e50');
		update_option(THEME_NAME.'_color_2', '3f484f');
	
		update_option(THEME_NAME.'_default_cat_color', '3F484F');



		update_option(THEME_NAME.'_show_single_title', 'custom');
		update_option(THEME_NAME.'_showTumbIcon', 'custom');
		update_option(THEME_NAME.'_sidebar_type', 'custom');
		update_option(THEME_NAME.'_main_share', 'on');
		update_option(THEME_NAME.'_rss_button', 'on');




		
		update_option(THEME_NAME.'_share_all', 'custom');
		update_option(THEME_NAME.'_about_author', 'custom');
		update_option(THEME_NAME.'_similar_posts_gallery', 'custom');
		update_option(THEME_NAME.'_sidebar_position', "custom");
		update_option(THEME_NAME.'_sidebar_position_2', "custom");
		update_option(THEME_NAME.'_post_style', "custom");



		
		update_option(THEME_NAME."_favicon", $favicon);
		update_option(THEME_NAME.'_page_layout', 'wide');
		update_option(THEME_NAME.'_responsive', 'on');
		update_option(THEME_NAME.'_menu_style', 'on');



		update_option(THEME_NAME.'_similar_posts', "custom");
		//update_option(THEME_NAME.'_single_post_style', 'custom');
		//update_option(THEME_NAME.'_post_likes_single', 'custom');
		update_option(THEME_NAME.'_post_comments_single', 'custom');
		//update_option(THEME_NAME.'_post_views_single', 'custom');
		update_option(THEME_NAME.'_post_author_single', 'custom');
		update_option(THEME_NAME.'_post_date_single', 'custom');
		update_option(THEME_NAME.'_post_category_single', 'custom');
		update_option(THEME_NAME.'_post_tag_single', 'custom');
		update_option(THEME_NAME.'_about_author', 'custom');
		update_option(THEME_NAME.'_show_single_thumb', "custom");
		update_option(THEME_NAME."_rss_url", get_bloginfo("rss_url"));
		update_option(THEME_NAME.'_copyright', $copyright);
		update_option(THEME_NAME.'_show_first_thumb', "on");
		update_option(THEME_NAME.'_singlePostBlogTitle', "on");

		
		update_option(THEME_NAME.'_search', 'on');



}

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'WPBakery Visual Composer', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory(). '/includes/lib/plugins/js_composer.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),	
		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Woocommerce', // The plugin name
			'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory(). '/includes/lib/plugins/woocommerce.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),		
		array(
			'name'     				=> 'Wp Print Friendly', // The plugin name
			'slug'     				=> 'wp-print-friendly', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory(). '/includes/lib/plugins/wp-print-friendly.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),	

	);


	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> THEME_NAME,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> esc_html( 'Install Required Plugins', THEME_NAME ),
			'menu_title'                       			=> esc_html( 'Install Plugins', THEME_NAME ),
			'installing'                       			=> esc_html( 'Installing Plugin: %s', THEME_NAME ), // %1$s = plugin name
			'oops'                             			=> esc_html( 'Something went wrong with the plugin API.', THEME_NAME ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> esc_html( 'Return to Required Plugins Installer', THEME_NAME ),
			'plugin_activated'                 			=> esc_html( 'Plugin activated successfully.', THEME_NAME ),
			'complete' 									=> esc_html( 'All plugins installed and activated successfully. %s', THEME_NAME ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );
}

	


?>