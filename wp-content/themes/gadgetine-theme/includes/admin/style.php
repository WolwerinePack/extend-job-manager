<?php
global $orange_themes_managment;
$orangeThemes_slider_options= array(
 array(
	"type" => "navigation",
	"name" => esc_html("Style Settings", THEME_NAME),
	"slug" => "custom-styling"
),

array(
	"type" => "tab",
	"slug"=>'custom-styling'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
		array("slug"=>"font_style", "name"=>esc_html("Font Style", THEME_NAME)),
		array("slug"=>"page_colors", "name"=>esc_html("Page Colors/Style", THEME_NAME)),
		array("slug"=>"page_layout", "name"=>esc_html("Layout", THEME_NAME))
		)
),

/* ------------------------------------------------------------------------*
 * PAGE FONT SETTINGS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'font_style'
),

array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html("Fonts",THEME_NAME)
),

array(
	"type" => "google_font_select",
	"title" => esc_html("Body text:",THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_google_font_1",
	"sort" => "alpha",
	"info" => esc_html("Font previews You Can find here: <a href='http://www.google.com/webfonts' target='_blank'>Google Fonts</a>",THEME_NAME),
	"default_font" => array('font' => "Open Sans", 'txt' => "(default)")
),
array(
	"type" => "google_font_select",
	"title" => esc_html("Titles:",THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_google_font_2",
	"sort" => "alpha",
	"info" => esc_html("Font previews You Can find here: <a href='http://www.google.com/webfonts' target='_blank'>Google Fonts</a>",THEME_NAME),
	"default_font" => array('font' => "Open Sans", 'txt' => "(default)")
),
array(
	"type" => "google_font_select",
	"title" => esc_html("Main menu text:",THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_google_font_3",
	"sort" => "alpha",
	"info" => esc_html("Font previews You Can find here: <a href='http://www.google.com/webfonts' target='_blank'>Google Fonts</a>",THEME_NAME),
	"default_font" => array('font' => "Open Sans", 'txt' => "(default)")
),


array(
	"type" => "close"

),


array(
"type" => "row",

),
array(
	"type" => "title",
	"title" => esc_html("Font Size",THEME_NAME)
),

array(
	"type" => "scroller",
	"title" => esc_html("Body text size in PX:",THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_font_size_1",
	"max" => "100",
	"std" => "16"
),

array(
	"type" => "close"

),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html("Font Character Sets", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => esc_html("Cyrillic Extended (cyrillic-ext):", THEME_NAME),
	"id"=>$orange_themes_managment->themeslug."_font_cyrillic_ex"
),
array(
	"type" => "checkbox",
	"title" => esc_html("Cyrillic (cyrillic):", THEME_NAME),
	"id"=>$orange_themes_managment->themeslug."_font_cyrillic"
),
array(
	"type" => "checkbox",
	"title" => esc_html("Greek Extended (greek-ext):", THEME_NAME),
	"id"=>$orange_themes_managment->themeslug."_font_greek_ex"
),
array(
	"type" => "checkbox",
	"title" => esc_html("Greek (greek):", THEME_NAME),
	"id"=>$orange_themes_managment->themeslug."_font_greek"
),
array(
	"type" => "checkbox",
	"title" => esc_html("Vietnamese (vietnamese):", THEME_NAME),
	"id"=>$orange_themes_managment->themeslug."_font_vietnamese"
),
array(
	"type" => "checkbox",
	"title" => esc_html("Latin Extended (latin-ext):", THEME_NAME),
	"id"=>$orange_themes_managment->themeslug."_font_latin_ex"
),
array(
	"type" => "close",

),
array(
	"type" => "save",
	"title" => esc_html("Save Changes",THEME_NAME)
),
   
array(
	"type" => "closesubtab"
),
/* ------------------------------------------------------------------------*
 * PAGE COLORS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'page_colors'
),

array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html("Default Category/News page Color", THEME_NAME)
),

array( 
	"type" => "color", 
	"id" => $orange_themes_managment->themeslug."_default_cat_color", 
	"title" => esc_html("Color:", THEME_NAME),
	"std" => "264C84",
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html("Colors", THEME_NAME)
),

array( 
	"type" => "color", 
	"id" => $orange_themes_managment->themeslug."_color_1", 
	"title" => esc_html("Main color scheme:", THEME_NAME),
	"std" => "2c3e50",
),
array( 
	"type" => "color", 
	"id" => $orange_themes_managment->themeslug."_color_2", 
	"title" => esc_html("Main menu/footer color:", THEME_NAME),
	"std" => "3f484f",
),


array(
	"type" => "close"
),

array(
	"type" => "row",

),
array(
	"type" => "title",
	"title" => esc_html("Body Backgrounds (only boxed view)",THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_body_bg_type",
	"radio" => array(
		array("title" => esc_html("Pattern:",THEME_NAME), "value" => "pattern"),
		array("title" => esc_html("Custom Image:",THEME_NAME), "value" => "image"),
		array("title" => esc_html("Color:",THEME_NAME), "value" => "color"),
	),
	"std" => "pattern"
),

array(
	"type" => "select",
	"title" => esc_html("Patterns ",THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_body_pattern",
	"options"=>array(
		array("slug"=>"texture-1", "name"=>esc_html("Texture 1",THEME_NAME)), 
		array("slug"=>"texture-2", "name"=>esc_html("Texture 2",THEME_NAME)), 
		array("slug"=>"texture-3", "name"=>esc_html("Texture 3",THEME_NAME)), 
		array("slug"=>"texture-4", "name"=>esc_html("Texture 4",THEME_NAME)), 
		array("slug"=>"texture-5", "name"=>esc_html("Texture 5",THEME_NAME)), 
	),
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_body_bg_type", "value" => "pattern")
	)
),

array(
	"type" => "color",
	"title" => esc_html("Body Background Color:",THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_body_color",
	"std" => "f1f1f1",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_body_bg_type", "value" => "color")
	)
),

array(
	"type" => "upload",
	"title" => esc_html("Body Background Image:",THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_body_image",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_body_bg_type", "value" => "image")
	)
),

array(
	"type" => "close",

),

array(
	"type" => "save",
	"title" => esc_html("Save Changes", THEME_NAME),
),
   
array(
	"type" => "closesubtab"
),
/* ------------------------------------------------------------------------*
 * PAGE LAYOUT
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'page_layout'
),

array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html("Enable Responsive", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => esc_html("Enable", THEME_NAME),
	"id" => $orange_themes_managment->themeslug."_responsive"
),

array(
	"type" => "close"
),


array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html("Page Layout", THEME_NAME),
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_page_layout",
	"radio" => array(
		array("title" => esc_html("Boxed:", THEME_NAME), "value" => "boxed"),
		array("title" => esc_html("Wide:", THEME_NAME), "value" => "wide"),
	),
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