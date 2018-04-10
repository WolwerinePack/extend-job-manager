<?php
global $orangeThemes_fields;
$orangeThemes_general_options= array(



/* ------------------------------------------------------------------------*
 * HOME SETTINGS
 * ------------------------------------------------------------------------*/   

array(
	"type" => "homepage_blocks",
	"title" => esc_html("Homepage Blocks:", THEME_NAME),
	"id" => $orangeThemes_fields->themeslug."_homepage_blocks",
	"blocks" => array(
		array(
			"title" => esc_html("Latest News", THEME_NAME),
			"type" => "homepage_news_block",
			"image" => "icon-article.png",
			"description" => esc_html("With large and small images",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_title", "title" => esc_html("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_count", "title" => esc_html("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_cat",
					"taxonomy" => "category",
					"title" => esc_html("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_offset", "title" => esc_html("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_color", 
					"title" => esc_html("Block Title Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),
			),
		),
		array(
			"title" => esc_html("Latest News", THEME_NAME),
			"type" => "homepage_news_block_4",
			"image" => "icon-article.png",
			"description" => esc_html("With large and medium images",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_title", "title" => esc_html("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_count", "title" => esc_html("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_cat",
					"taxonomy" => "category",
					"title" => esc_html("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_offset", "title" => esc_html("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_color", 
					"title" => esc_html("Block Title Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),
			),
		),
		array(
			"title" => esc_html("Latest News", THEME_NAME),
			"type" => "homepage_news_block_5",
			"image" => "icon-article.png",
			"description" => esc_html("With large and without small images",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_title", "title" => esc_html("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_count", "title" => esc_html("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_cat",
					"taxonomy" => "category",
					"title" => esc_html("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_offset", "title" => esc_html("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_color", 
					"title" => esc_html("Block Title Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),
			),
		),
		array(
			"title" => esc_html("Latest News", THEME_NAME),
			"type" => "homepage_news_block_6",
			"image" => "icon-article.png",
			"description" => esc_html("With small images",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_title", "title" => esc_html("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_count", "title" => esc_html("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_cat",
					"taxonomy" => "category",
					"title" => esc_html("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_offset", "title" => esc_html("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_color", 
					"title" => esc_html("Block Title Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),
			),
		),
		array(
			"title" => esc_html("Featured News", THEME_NAME),
			"type" => "homepage_news_block_2",
			"image" => "icon-review.png",
			"description" => esc_html("Featured News Block",THEME_NAME),
			"options" => array(
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_count", "title" => esc_html("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_cat",
					"taxonomy" => "category",
					"title" => esc_html("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_offset", "title" => esc_html("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
			),
		),
		array(
			"title" => esc_html("Latest Video Block", THEME_NAME),
			"type" => "homepage_news_block_3",
			"image" => "icon-video.png",
			"description" => esc_html("Latest News With Videos",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_title", "title" => esc_html("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_count", "title" => esc_html("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),

				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_cat",
					"taxonomy" => "category",
					"title" => esc_html("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_offset", "title" => esc_html("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_color", 
					"title" => esc_html("Block Title Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),
			),
		),
		array(
			"title" => esc_html("Popular Video Block", THEME_NAME),
			"type" => "homepage_news_block_7",
			"image" => "icon-video.png",
			"description" => esc_html("Popular News With Videos",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_title", "title" => esc_html("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_count", "title" => esc_html("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),

				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_cat",
					"taxonomy" => "category",
					"title" => esc_html("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_offset", "title" => esc_html("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_color", 
					"title" => esc_html("Block Title Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),
			),
		),
		array(
			"title" => esc_html("Popular News", THEME_NAME),
			"type" => "homepage_news_block_8",
			"image" => "icon-review.png",
			"description" => esc_html("Most Viewed News",THEME_NAME),
			"options" => array(
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_count", "title" => esc_html("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_cat",
					"taxonomy" => "category",
					"title" => esc_html("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_offset", "title" => esc_html("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
			),
		),
		array(
			"title" => esc_html("Shop", THEME_NAME),
			"type" => "homepage_news_block_10",
			"image" => "icon-shop.png",
			"description" => esc_html("Shop Items",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_title", "title" => esc_html("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_count", "title" => esc_html("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $orangeThemes_fields->themeslug."_cat",
					"taxonomy" => "product_cat",
					"title" => esc_html("Set Category", THEME_NAME),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_offset", "title" => esc_html("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array(
					"type" => "select",
					"title" => esc_html("Type:", THEME_NAME),
					"id" => $orangeThemes_fields->themeslug."_type",
					"options"=>array(
						array("slug"=>"1", "name"=>esc_html("Latest", THEME_NAME)), 
						array("slug"=>"2", "name"=>esc_html("Featured", THEME_NAME)), 
					),
					"home" => "yes"
				),	
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_color", 
					"title" => esc_html("Block Title Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),					
			),
		),
		array(
			"title" => esc_html("Reviews", THEME_NAME),
			"type" => "homepage_news_block_11",
			"image" => "icon-review.png",
			"description" => esc_html("Latest/Top reviews.",THEME_NAME),
			"options" => array(
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_title", "title" => esc_html("Title:", THEME_NAME), "home" => "yes" ),
				array( "type" => "scroller", "id" => $orangeThemes_fields->themeslug."_count", "title" => esc_html("Count:", THEME_NAME), "max" => 30, "home" => "yes" ),
				array(
					"type" => "categories",
					"title" => esc_html("Set Category", THEME_NAME),
					"id" => $orangeThemes_fields->themeslug."_cat",
					"taxonomy" => "category",
					"home" => "yes"
				),
				array( "type" => "input", "id" => $orangeThemes_fields->themeslug."_offset", "title" => esc_html("From which post should start the loop (for example 4 ), for default leave it empty, or add 0. (Offset):", THEME_NAME), "home" => "yes" ),
				array(
					"type" => "select",
					"title" => esc_html("Type:", THEME_NAME),
					"id" => $orangeThemes_fields->themeslug."_type",
					"options"=>array(
						array("slug"=>"latest", "name"=>esc_html("Latest Reviews", THEME_NAME)), 
						array("slug"=>"top", "name"=>esc_html("Top Reviews", THEME_NAME)), 
					),
					"home" => "yes"
				),				
				array( 
					"type" => "color", 
					"id" => $orangeThemes_fields->themeslug."_color", 
					"title" => esc_html("Color:", THEME_NAME),
					"std" => get_option(THEME_NAME."_default_cat_color"),
					"home" => "yes"
				),
			),
		),
		array(
			"title" => esc_html("Text Block",THEME_NAME),
			"type" => "text_block",
			"image" => "icon-text.png",
			"description" => esc_html("Custom Text Block/Shortcodes Block",THEME_NAME),
			"options" => array(
				array( "type" => "textarea", "id" => $orangeThemes_fields->themeslug."_text", "title" => esc_html("Text:",THEME_NAME), "upload" => "yes",  "editor" => "yes", "home" => "yes" ),
			),
		),
		array(
			"title" => esc_html("HTML Code",THEME_NAME),
			"type" => "homepage_html",
			"image" => "icon-html.png",
			"description" => esc_html("Custom HTML/Shortcodes Block",THEME_NAME),
			"options" => array(
				array( "type" => "textarea", "id" => $orangeThemes_fields->themeslug."_html", "title" => esc_html("Code/Text:",THEME_NAME), "home" => "yes" ),
			),
		),
		array(
			"title" => esc_html("Banner Block",THEME_NAME),
			"type" => "homepage_banner",
			"image" => "icon-banner.png",
			"description" => esc_html("Supports HTML,CSS, Javascript and Shortcodes.",THEME_NAME),
			"options" => array(
				array( "type" => "textarea", "id" => $orangeThemes_fields->themeslug."_banner", "title" => esc_html("Code/Text:",THEME_NAME), "home" => "yes","sample" => '<a href="http://www.orange-themes.com" target="_blank"><img src="'.THEME_IMAGE_URL.'no-banner-430x100.jpg" alt="" title="" /></a>', ),
			),
		),

	)
),


 
 );


$orangeThemes_fields->add_options($orangeThemes_general_options);
?>