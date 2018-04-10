<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	global $query_string, $post;
	$post_type = get_post_type();
	
	if($post_type == OT_POST_GALLERY) {
		get_template_part("template","gallery");
	} else if($post_type == OT_POST_PORTFOLIO) {
		get_template_part("template","portfolio");
	} else {
		get_header();
		get_template_part(THEME_INCLUDES."news");
		get_footer();
	}
?>