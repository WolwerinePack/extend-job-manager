<?php
global $orange_themes_managment;
$orangeThemes_slider_options= array(
 array(
	"type" => "navigation",
	"name" => esc_html("Slider Settings", THEME_NAME),
	"slug" => "sliders"
),

array(
	"type" => "tab",
	"slug"=>'sliders'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
		array("slug"=>"main_slider", "name"=>esc_html("Main News Sliders", THEME_NAME))
		)
),


/* ------------------------------------------------------------------------*
 * MAIN NEWS SLIDER SETTINGS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'main_slider'
),

array(
	"type" => "row",

),
array(
	"type" => "title",
	"title" => esc_html("Main News Sliders Settings", THEME_NAME)
),
array(
	"type" => "checkbox",
	"id" => $orange_themes_managment->themeslug."_main_news_autostart",
	"title" => esc_html("Main Slider Auto Start", THEME_NAME)
),
array(
	"type" => "checkbox",
	"id" => $orange_themes_managment->themeslug."_main_news_loop",
	"title" => esc_html("Main Slider Loop", THEME_NAME)
),
array(
	"type" => "scroller",
	"id" => $orange_themes_managment->themeslug."_main_slider_count",
	"title" => esc_html("Main Slider Slide Count", THEME_NAME),
	"max" => "100",
	"std" => "8"
),

array(
	"type" => "close"
),

array(
	"type" => "save",
	"title" => esc_html("Save Changes", THEME_NAME)
),
   
array(
	"type" => "closesubtab"
),

array(
	"type" => "closetab"
)
 
);

$orange_themes_managment->add_options($orangeThemes_slider_options);
?>