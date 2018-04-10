<?php
/*
Template Name: Drag & Drop Page Builder
*/	
?>
<?php get_header(); ?>
<?php

	wp_reset_query();
	global $post;
	
	//pagebuilder saved layout 
	$pagebuilder_layout = get_post_meta( $post->ID, "_".THEME_NAME."_pagebuilder_layout", true );
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>

	<?php 
		if(get_the_content()) {
			the_content();
		} 

		$OT_builder = new OT_home_builder;  
		if($pagebuilder_layout) {
			//foreach columns
			foreach ($pagebuilder_layout->columnRows as $columRows) {
				$OT_builder->columRows($columRows);
			}
		}

	?> 
	
<?php get_template_part(THEME_LOOP."loop-end"); ?>
 <div align="center">
		<?php echo adrotate_group(2); ?>
	</div>
	
<?php get_footer();?>