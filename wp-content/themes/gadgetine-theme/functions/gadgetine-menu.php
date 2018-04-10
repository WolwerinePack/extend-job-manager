<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $orangeThemes_meta_fields;

$orangeThemes_meta_fields = new OrangeThemesManagment(THEME_FULL_NAME,THEME_NAME, "meta");

$orangeThemes_meta_options= array(
	/* ------------------------------------------------------------------------*
	 * META SETTINGS
	 * ------------------------------------------------------------------------*/   
	array(
		"type" => "meta_block",
		"title" => THEME_NAME.esc_html("Settings", THEME_NAME),
		"blocks" => array(
			array(
				"options" => array(
					array(
						"type" => "navigation",
					),					
					array(
						"type" => "meta_sub_navigation",
						"subname"=>array(
							array(
								"slug"=>"general", 
								"icon"=>"dashicons-admin-generic", 
								"name"=> esc_html("General", THEME_NAME),
								/*"hide_in"=> array(OT_POST_GALLERY),//post/page type*/
								"page_type" => array("page","post","!blog",OT_POST_GALLERY),

							), 
							array(
								"slug"=>"post_settings", 
								"icon"=>"dashicons-list-view", 
								"name"=> esc_html("Post/Page Settings", THEME_NAME),
								//"skip_templates"=> array('homepage', 'gallery')//page template
							), 
							array(
								"slug"=>"sidebar", 
								"icon"=>"dashicons-admin-appearance", 
								"name"=>esc_html("Sidebar", THEME_NAME)
							), 

						)
					),

					/* ------------------------------------------------------------------------*
					 * GENERAL SETTINGS
					 * ------------------------------------------------------------------------*/   
					array(
						"type" => "meta_sub_tab",
						"slug"=>'general',
						/*"hide_in"=> array(OT_POST_GALLERY),//post/page type*/
						"page_type" => array("page","post","!blog",OT_POST_GALLERY),
					),
		
					array(
						"type" => "row",
						"page_type" => array("page","post","!blog"),
						"compare" => get_option(THEME_NAME.'_show_single_thumb'),
						"skip_templates" => array("homepage","contact","gallery","portfolio","archive"),
					),
					array(
						"type" => "title",
						"title" => esc_html("Show Image In Single Post / News Page", THEME_NAME),
						"skip_templates" => array("homepage","contact","gallery","portfolio","archive"),
						"page_type" => array("page","post","!blog"),
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_show_single_thumb",
						"radio" => array(
							array("title" => esc_html("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","gallery","portfolio","archive"),
						"compare" => get_option(THEME_NAME.'_show_single_thumb'),
					),

					array(
						"type" => "close",
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","gallery","portfolio","archive"),
						"compare" => get_option(THEME_NAME.'_show_single_thumb'),
					),	
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_showTumbIcon')
					),
					array(
						"type" => "title",
						"title" => esc_html("Show Icons on Thumbnails in Post Listing Pages", THEME_NAME),
						"page_type" => array("post"),
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_showTumbIcon",
						"radio" => array(
							array("title" => esc_html("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_showTumbIcon'),
					),

					array(
						"type" => "close",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_showTumbIcon'),
					),			
					array(
						"type" => "row",
						"page_type" => array("page","post","!blog"),
						"compare" => get_option(THEME_NAME.'_show_single_title'),
						"skip_templates"=> array('homepage')//page template
					),
					array(
						"type" => "title",
						"title" => esc_html("Show Title In Single Post/Page", THEME_NAME),
						"page_type" => array("page","post","!blog"),
						"skip_templates"=> array('homepage')//page template
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_show_single_title",
						"radio" => array(
							array("title" => esc_html("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"page_type" => array("page","post","!blog"),
						"compare" => get_option(THEME_NAME.'_show_single_title'),
						"skip_templates"=> array('homepage')//page template
					),

					array(
						"type" => "close",
						"page_type" => array("page","post","!blog"),
						"compare" => get_option(THEME_NAME.'_show_single_title'),
						"skip_templates"=> array('homepage')//page template
					),


					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_post_author_single'),
					),
					array(
						"type" => "title",
						"title" => esc_html("Post Author", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_post_author_single",
						"radio" => array(
							array("title" => esc_html("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_post_author_single'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_post_date_single'),
					),
					array(
						"type" => "title",
						"title" => esc_html("Post Date", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_post_date",
						"radio" => array(
							array("title" => esc_html("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_post_date_single'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_printPost'),
					),
					array(
						"type" => "title",
						"title" => esc_html("Post Print Option", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_printPost",
						"radio" => array(
							array("title" => esc_html("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_printPost'),
						"page_type" => array("post")
					),
					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_share_all'),
					),
					array(
						"type" => "title",
						"title" => esc_html("Show Share Buttons", THEME_NAME),
						"page_type" => array("post"),
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_share_single",
						"radio" => array(
							array("title" => esc_html("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_share_all'),
						"page_type" => array("post"),
					),

					array(
						"type" => "close",
						"page_type" => array("post"),
					),
					
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_post_comments_single'),
					),
					array(
						"type" => "title",
						"title" => esc_html("Show Post Comments Count", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_post_comments_single",
						"radio" => array(
							array("title" => esc_html("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_post_comments_single'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_post_category_single'),
					),
					array(
						"type" => "title",
						"title" => esc_html("Post Categories", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_post_category",
						"radio" => array(
							array("title" => esc_html("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_post_category_single'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_post_tag_single'),
					),
					array(
						"type" => "title",
						"title" => esc_html("Post Tags", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_post_tag",
						"radio" => array(
							array("title" => esc_html("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_post_tag_single'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_similar_posts'),
					),
					array(
						"type" => "title",
						"title" => esc_html("\"Similar News\" Block In Post", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_similar_posts",
						"radio" => array(
							array("title" => esc_html("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_similar_posts'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => get_option(THEME_NAME.'_about_author'),
					),
					array(
						"type" => "title",
						"title" => esc_html("\"About Author\" Block In Post", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_about_author",
						"radio" => array(
							array("title" => esc_html("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_about_author'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),

					array(
						"type" => "row",
						"page_type" => array("homepage"),
					),

					array(
						"type" => "title",
						"title" => esc_html("Show Main Slider?", THEME_NAME),
						"page_type" => array("homepage"),
					),
					array(
						"type" => "multiple_select",
						"title" => esc_html("Set Main News Slider Categories", THEME_NAME),
						"id" => "_".$orangeThemes_meta_fields->themeslug."_main_slider",
						"taxonomy" => "category",
						"default" => array('slider_off', esc_html("Off", THEME_NAME)),
						"std" => 'slider_off',
						"page_type" => array("homepage"),
					),

					array(
						"type" => "close",
						"page_type" => array("homepage"),
					),
					array(
						"type" => "row",
						"page_type" => array(OT_POST_GALLERY),
						"compare" => get_option(THEME_NAME.'_similar_posts_gallery'),
					),
					array(
						"type" => "title",
						"title" => esc_html("\"Similar News\" Block In Gallery", THEME_NAME),
						"page_type" => array(OT_POST_GALLERY)
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_similar_posts",
						"radio" => array(
							array("title" => esc_html("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => get_option(THEME_NAME.'_similar_posts_gallery'),
						"page_type" => array(OT_POST_GALLERY)
					),

					array(
						"type" => "close",
						"page_type" => array(OT_POST_GALLERY)
					),
					array(
						"type" => "closesubtab",
						/*"hide_in"=> array(OT_POST_GALLERY),//post/page type*/
						"page_type" => array("page","post","!blog",OT_POST_GALLERY),

					),
					/* ------------------------------------------------------------------------*
					 * POST SETTINGS
					 * ------------------------------------------------------------------------*/   
					array(
						"type" => "meta_sub_tab",
						"slug"=>'post_settings',
						/*"skip_templates"=> array('homepage', 'gallery')//page template*/
					),
					array(
						"type" => "row",
						"page_type" => array("page")
					),
					array(
						"type" => "title",
						"title" => esc_html("Page Color For Main Menu", THEME_NAME),
						"page_type" => array("page")
					),
					array(
						"type" => "color",
						"title" => esc_html("Color:",THEME_NAME),
						"id"=> '_'.$orangeThemes_meta_fields->themeslug."_title_color",
						"std" => "264C84",
						"page_type" => array("page")
					),	
					array(
						"type" => "close",
						"page_type" => array("page")
					),
					array(
						"type" => "row",
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","archive","gallery")
					),
					array(
						"type" => "title",
						"title" => esc_html("Featured Image Credits", THEME_NAME),
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","archive","gallery")
					),
					array(
						"type" => "input",
						"title" => esc_html("Credits", THEME_NAME),
						"id" => "_".$orangeThemes_meta_fields->themeslug."_image_caption",
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","archive","gallery")
					),

					array(
						"type" => "close",
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","archive","gallery")
					),
					/*
					array(
						"type" => "row",
						"page_type" => array("page","post"),
						"protected" => array(
							array("dataType" => 'option', "id" => $orange_themes_managment->themeslug."_breaking_single", "value" => "custom")
						)
					),
					array(
						"type" => "title",
						"title" => esc_html("Show Breaking News Slider?", THEME_NAME),
						"page_type" => array("page","post"),
						"protected" => array(
							array("dataType" => 'option', "id" => $orange_themes_managment->themeslug."_breaking_single", "value" => "custom")
						)
					),
					array(
						"type" => "multiple_select",
						"title" => esc_html("Set Breaking News Slider Categories", THEME_NAME),
						"id" => "_".$orangeThemes_meta_fields->themeslug."_breaking_slider",
						"taxonomy" => "category",
						"default" => array('slider_off', esc_html("Off", THEME_NAME)),
						"compare" => get_option(THEME_NAME.'_breaking_single'),
						"std" => 'slider_off',
						"page_type" => array("page","post"),
						"protected" => array(
							array("dataType" => 'option', "id" => $orange_themes_managment->themeslug."_breaking_single", "value" => "custom")
						)
					),

					array(
						"type" => "close",
						"page_type" => array("page","post"),
						"protected" => array(
							array("dataType" => 'option', "id" => $orange_themes_managment->themeslug."_breaking_single", "value" => "custom")
						)
					),
					*/
					array(
						"type" => "row",
						"page_type" => array("post"),
					),	
					array(
						"type" => "title",
						"title" => esc_html("Show This Post In Homepage Featured Block", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "checkbox",
						"title" => esc_html("Show:",THEME_NAME),
						"id"=> '_'.$orangeThemes_meta_fields->themeslug."_featured",
						"page_type" => array("post")
					),
									
					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"skip_templates" => array("homepage","contact","gallery"),
					),	
					/*
					array(
						"type" => "title",
						"title" => esc_html("Show This Post In Breaking News Slider?", THEME_NAME),
						"page_type" => array("post"),
						"protected" => array(
							array("dataType" => 'option', "id" => $orange_themes_managment->themeslug."_breakingNewsType", "value" => "custom")
						)
					),
					array(
						"type" => "checkbox",
						"title" => esc_html("Show:",THEME_NAME),
						"id"=> '_'.$orangeThemes_meta_fields->themeslug."_breaking_post",
						"page_type" => array("post"),
						"protected" => array(
							array("dataType" => 'option', "id" => $orange_themes_managment->themeslug."_breakingNewsType", "value" => "custom")
						)

					),	
					*/
					array(
						"type" => "title",
						"title" => esc_html("Show This Post In Main Slider?", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "checkbox",
						"title" => esc_html("Show:",THEME_NAME),
						"id"=> '_'.$orangeThemes_meta_fields->themeslug."_main_slider_post",
						"page_type" => array("post")
					),
									
					array(
						"type" => "close",
						"page_type" => array("post")
					),						

					array(
						"type" => "row",
						"page_type" => array("post")
					),	
					array(
						"type" => "title",
						"title" => esc_html("Video Embed Code", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "textarea",
						"title" => esc_html("Vimeo, Youtube Embed Code:",THEME_NAME),
						"id"=> '_'.$orangeThemes_meta_fields->themeslug."_video_code",
						"page_type" => array("post")
					),	
					array(
						"type" => "close",
						"page_type" => array("post")
					),	
					array(
						"type" => "row",
						"page_type" => array("post")
					),
					array(
						"type" => "title",
						"title" => esc_html("Review Settings", THEME_NAME),
						"page_type" => array("post")
					),


					array(
						"type" => "textarea",
						"title" => esc_html('Ratings', THEME_NAME),
						"id" => "_".$orangeThemes_meta_fields->themeslug."_ratings",
						"info" => esc_html('Enter the ratings like this - Graphics:5; Gameplay:4,5; Sound:3; Storyline:4',THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "textarea",
						"title" => esc_html('Summary', THEME_NAME),
						"id" => "_".$orangeThemes_meta_fields->themeslug."_overall",
						"page_type" => array("post")
					),
					array(
						"type" => "close",
						"page_type" => array("post")
					),

					array(
						"type" => "row",
						"page_type" => array("contact")
					),
					array(
						"type" => "title",
						"title" => esc_html("Contact Page Email", THEME_NAME),
						"page_type" => array("contact")
					),
					array(
						"type" => "input",
						"title" => esc_html("Email:", THEME_NAME),
						"id" => "_".$orangeThemes_meta_fields->themeslug."_contact_mail",
						"page_type" => array("contact")
					),

					array(
						"type" => "close",
						"page_type" => array("contact")
					),
					array(
						"type" => "row",
						"page_type" => array("contact")
					),
					array(
						"type" => "title",
						"title" => esc_html("Contact Page Google Map", THEME_NAME),
						"page_type" => array("contact")
					),
					array(
						"type" => "textarea",
						"title" => esc_html("Embed Code:", THEME_NAME),
						"id" => "_".$orangeThemes_meta_fields->themeslug."_map",
						"page_type" => array("contact")
					),

					array(
						"type" => "close",
						"page_type" => array("contact")
					),

					array(
						"type" => "row",
						"page_type" => array(OT_POST_GALLERY),
						"skip_templates"=> array('homepage','gallery')//page template
					),
					array(
						"type" => "title",
						"title" => esc_html("Gallery Style", THEME_NAME),
						"page_type" => array(OT_POST_GALLERY),
						"skip_templates"=> array('homepage','gallery')//page template

					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_gallery_style",
						"radio" => array(
							array("title" => esc_html("Default:", THEME_NAME), "value" => "default"),
							array("title" => esc_html("Lightbox:", THEME_NAME), "value" => "lightbox")
						),
						"std" => 'default',
						"page_type" => array(OT_POST_GALLERY),
						"skip_templates"=> array('homepage','gallery')//page template
					),

					array(
						"type" => "close",
						"page_type" => array(OT_POST_GALLERY),
						"skip_templates"=> array('homepage','gallery')//page template
					),

					array(
						"type" => "closesubtab",
						/*"skip_templates"=> array('homepage', 'gallery')//page template*/
					),
					/* ------------------------------------------------------------------------*
					 * SIDEBAR SETTINGS
					 * ------------------------------------------------------------------------*/   
					array(
						"type" => "meta_sub_tab",
						"slug"=>'sidebar'
					),
					array(
						"type" => "row"
					),
					array(
						"type" => "title",
						"title" => esc_html('Main Sidebar Side', THEME_NAME),
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_sidebar_position",
						"radio" => array(
							array("title" => esc_html("Right:", THEME_NAME), "value" => "right"),
							array("title" => esc_html("Left:", THEME_NAME), "value" => "left")
						),
						"std" => 'right',
						"compare" => get_option(THEME_NAME.'_sidebar_position'),
					),
					array(
						"type" => "title",
						"title" => esc_html('Main Sidebar Name', THEME_NAME),
					),
					array(
						"type" => "sidebar_select",
						"title" => esc_html('Sidebar', THEME_NAME),
						"default" => array(
										array('', esc_html('Default', THEME_NAME)),
										array('off', esc_html('Off', THEME_NAME)),
									),
						"id" => "_".$orange_themes_managment->themeslug."_sidebar_select",
					),

					array(
						"type" => "close"
					),
					array(
						"type" => "row"
					),
					array(
						"type" => "title",
						"title" => esc_html('Second Sidebar Side', THEME_NAME),
					),
					array(
						"type" => "radio",
						"id" => "_".$orangeThemes_meta_fields->themeslug."_sidebar_position_2",
						"radio" => array(
							array("title" => esc_html("Right:", THEME_NAME), "value" => "right"),
							array("title" => esc_html("Left:", THEME_NAME), "value" => "left")
						),
						"std" => 'right',
						"compare" => get_option(THEME_NAME.'_sidebar_position_2'),
					),
					array(
						"type" => "title",
						"title" => esc_html('Second Sidebar Name', THEME_NAME),
					),
					array(
						"type" => "sidebar_select",
						"title" => esc_html('Sidebar', THEME_NAME),
						"default" => array(
										array('off', esc_html('Off', THEME_NAME)),
										array('default', esc_html('Default', THEME_NAME)),

									),
						"id" => "_".$orange_themes_managment->themeslug."_sidebar_select_2",
					),

					array(
						"type" => "close"
					),
					array(
						"type" => "closesubtab"
					),
		 			array(
						"type" => "close"
					)
				),
			),

		),
	)
);


$orangeThemes_meta_fields->add_options($orangeThemes_meta_options);


$orange_themes_meta_options = $orangeThemes_meta_fields->get_options();


function orange_themes_meta_box() {
	$image = '<img src="'.THEME_IMAGE_CPANEL_URL.'logo-orangethemes-1.png" width="11" height="15" /> ';
    $screens = array( 'post', 'page', OT_POST_GALLERY, OT_POST_PORTFOLIO );
    foreach ( $screens as $screen ) {
        add_meta_box('orange-themes-custom-'.$screen.'-data', ''.$image.esc_html('Post Custom Settings', THEME_NAME), 'orange_themes_meta_content', $screen, 'normal', 'high');
    }

}


 

function orange_themes_meta_content($post) { 
	global $orangeThemes_meta_fields;
	echo $orangeThemes_meta_fields->print_options();
}


add_action( 'admin_menu', 'orange_themes_meta_box' );

function save_meta_data($value) {
		global $post_id;
		
		$nonsavable_types = array(
			'navigation', 
			'tab',
			'sub_navigation',
			'meta_sub_navigation',
			'sub_tab',
			'meta_sub_tab',
			'homepage_set_test',
			'save',
			'closesubtab',
			'closetab',
			'row',
			'close'
		);

		if(isset($value['id'])) {
			$old = get_post_meta($post_id, $value['id'], true);
			if(isset($_REQUEST[$value['id']])) {
				$new = $_REQUEST[$value['id']];
			} else {
				$new = false;
			}
		}
		


		if(isset($value['id']) && isset($new) && !in_array($value['type'],$nonsavable_types)) {
			
			
			if($value['type']=="checkbox" && $new=="on" && $new!=$old){
				update_post_meta($post_id, $value['id'], $new);
			} elseif($value['type']=="checkbox" && $new!="on" && $new!=$old){
				update_post_meta($post_id, $value['id'], $new);
			}

			if($value['type']!="checkbox") {
				update_post_meta($post_id, $value['id'], $new);
				
			}

		}  elseif(!in_array($value['type'], $nonsavable_types) && isset($value['id'])){
			delete_post_meta($post_id, $value['id'], $old);
		}

		//set average rating for easier post sorting
		if(isset($value['id']) && $value['id']=="_".THEME_NAME."_ratings") {
			$average = ot_avarage_rating($post_id);
			update_post_meta($post_id, $value['id']."_average", $average[1]);
		}
		
	}

	// Save data from meta box
	function save_sticky_data($post_id) {

		global $orange_themes_meta_options;
		$nonsavable_types = array(
			'navigation', 
			'tab',
			'sub_navigation',
			'meta_sub_navigation',
			'sub_tab',
			'meta_sub_tab',
			'homepage_set_test',
			'save',
			'closesubtab',
			'closetab',
			'row',
			'close'
		);
		
		// verify nonce
		if (isset($_POST['sticky_meta_box_nonce']) && !wp_verify_nonce($_POST['sticky_meta_box_nonce'], "orange-themes")) {
			die( esc_html_e('Security check', THEME_NAME) );
		} else {

			// check autosave
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return $post_id;
			}

			// check permissions
			if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
				if (!current_user_can('edit_page', $post_id)) {
					return $post_id;
				}
			} elseif (!current_user_can('edit_post', $post_id)) {
				return $post_id;
			}

			//insert the default values if the fields are empty

			foreach ($orange_themes_meta_options[0]['blocks'][0]['options'] as $block) {
				if( isset( $block['id'] ) && get_post_meta($post_id,$block['id'],true)=='' && isset($block['std']) && !in_array($block['type'], $nonsavable_types)){
					update_post_meta($post_id, $block['id'], $block['std']);
				} else {
					save_meta_data($block);
					
				}
			}



		}
	}

	add_action('save_post', 'save_sticky_data');




$prefix = THEME_NAME.'_';
$image = '<img src="'.THEME_IMAGE_CPANEL_URL.'logo-orangethemes-1.png" width="11" height="15" /> ';

$homeID = ot_get_page('homepage');




if(isset($_GET['post'])) {
	$currentID = $_GET['post'];
} else {
	$currentID = 0;
}

global $box_array;

$box_array = array();

$box_array[] = array('id' => 'post-0','title' => ''.$image.esc_html("Main Slider Image", THEME_NAME),'page' => 'post', 'context' => 'side','priority' => 'low','fields' => array(array('name' => esc_html("Image:", THEME_NAME),'std' => '','id' => $prefix. 'homepage_image','type'=> 'slider_image_box')),'size' => 10,'first' => 'yes');


//gallery images
$box_array[] = array( 'id' => 'post-slider-images', 'title' => ''.$image.esc_html("Gallery Images", THEME_NAME), 'page' => OT_POST_GALLERY, 'context' => 'side', 'priority' => 'low', 'fields' => array(array('name' => "", 'std' => '', 'id' => $prefix. 'gallery_images', 'type'=> 'image_select' ) ), 'size' => 0,'first' => 'no'  );


//portfolio images
$box_array[] = array( 'id' => 'post-slider-images', 'title' => ''.$image.esc_html("Portfolio Images", THEME_NAME), 'page' => OT_POST_PORTFOLIO, 'context' => 'side', 'priority' => 'low', 'fields' => array(array('name' => "", 'std' => '', 'id' => $prefix. 'portfolio_images', 'type'=> 'image_select' ) ), 'size' => 0,'first' => 'no'  );


//homepage 
if(in_array($currentID, $homeID) || isset($_POST['post_type'])) {

	$box_array[] = array( 
		'id' => 'home-drag-drop', 
		'title' => ''.$image.esc_html("Homepage Builder", THEME_NAME), 
		'page' => 'page', 
		'context' => 'normal', 
		'priority' => 'high', 
		'fields' => array(
			array(
				'name' => '', 
				'std' => '', 'id' => $prefix. 'home_drag_drop', 
				'type'=> 'home_drag_drop' 
				) 
			), 
		'size' => 0,
		'first' => 'no'  
	);
}

// Add meta box
function add_sticky_box() {
	global $box_array;
	
	foreach ($box_array as $box) {
		add_meta_box($box['id'], $box['title'], 'sticky_show_box', $box['page'], $box['context'], $box['priority'], array('content'=>$box, 'first'=>$box['first'], 'size'=>$box['size']));
	}

}

function sticky_show_box( $post, $metabox) {
	show_box_funtion($metabox['args']['content'], $metabox['args']['first'], $metabox['args']['size']);
}

// Callback function to show fields in meta box
function show_box_funtion($fields, $first='no', $width='60') {
	global $post, $post_id;



	foreach ($fields['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		echo '<label for="', $field['id'], '">', $field['name'], '</label>';
	
		switch ($field['type']) {
			case 'slider_image_box':
				echo '<input class="upload input-text-1 ot-upload-field" type="text" name="', $field['id'], '" id="', $field['id'], '" value="',  $meta ? remove_html_slashes($meta) :  remove_html_slashes($field['std']), '" style="width: 140px;"/><a href="#" class="ot-upload-button">Button</a>';
				break;
			case 'image_select':
				ot_gallery_image_select($field['id'],$meta);
				break;
			case 'home_drag_drop':
				global $orangeThemes_fields;
				$orangeThemes_fields = new OrangeThemesManagment(THEME_FULL_NAME,THEME_NAME);
			
				get_template_part(THEME_FUNCTIONS."drag-drop");
				$options = $orangeThemes_fields->get_options();

				echo '
					<div style="vertical-align:top;clear: both;">
						'.$orangeThemes_fields->print_options().'
					</div>';
				break;
		}

	}

}

function save_data($fields) {
	global $post_id;

	foreach ($fields['fields'] as $field) {	
		$old = get_post_meta($post_id, $field['id'], true);
		if(isset($_POST[$field['id']])) {
			$new = $_POST[$field['id']];
			
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}//else if closer
		}
	}//foreach closer
	
}

function save_datepicker($fields) {
	global $post_id;

	foreach ($fields['fields'] as $field) {	
		$old = get_post_meta($post_id, $field['id'], true);
		if(isset($_POST[$field['id']])) {
			$new = $_POST[$field['id']];
			
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], strtotime($new));
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], strtotime($old));
			}//else if closer
		}
	}//foreach closer
	
}

function save_numbers($fields) { 
	global $post_id;
	foreach ($fields['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if(!is_numeric($new)) { 
			$new = preg_replace("/[^0-9]/","",$new);
		}
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}//else if closer
	}//foreach closer

}
// Save data from meta box
function save_meta_sticky_data($post_id) {
	global $box_array;

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($box_array as $box) {
		save_data($box);
	}

} //function closer
	add_action('admin_menu', 'add_sticky_box');	
	add_action('save_post', 'save_meta_sticky_data');

	
?>
