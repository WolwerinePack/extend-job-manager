<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();

	//post tags
	$posttags = get_the_tags();
	$tagCount = count($posttags);

	$categories = get_the_category();
	$catCount = count($categories);
?>
	<?php if (($posttags && ot_option_compare('post_tag_single','post_tag',$post->ID)==true) || ($categories && ot_option_compare('post_category_single','post_category',$post->ID)==true)) { ?>
		<div class="panel-tags-cats">
			<?php if ($posttags && ot_option_compare('post_tag_single','post_tag',$post->ID)==true) { ?>
				<span><i class="fa fa-tag"></i>&nbsp;&nbsp;<?php esc_html_e('Article "tagged" as:', THEME_NAME);?></span>
				<div class="tagcloud">
					<?php	
						  foreach($posttags as $tag) {
							echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name . '</a>'; 
						  }
					?>
				</div>
			<?php } ?>
			<?php if (($posttags && ot_option_compare('post_tag_single','post_tag',$post->ID)==true) && ($categories && ot_option_compare('post_category_single','post_category',$post->ID)==true)) { ?>
				<div class="article-splitter"></div>
			<?php } ?>
			<?php if ($categories && ot_option_compare('post_category_single','post_category',$post->ID)==true) { ?>
				<span><i class="fa fa-folder-open"></i>&nbsp;&nbsp;<?php esc_html_e("Categories:", THEME_NAME);?></span>
				<div class="category-cloud">
					<?php	
						$i=1;
						foreach($categories as $cat) {
							echo '<a href="'.get_category_link($cat->term_id).'">'.$cat->name . '</a>'; 
							
						
							$i++;
						}

					?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>