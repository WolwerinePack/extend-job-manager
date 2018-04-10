<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly




	$width = 472;
	$height = 312;

	$image = get_post_thumb($post->ID,$width,$height); 
	$imageL = get_post_thumb($post->ID,0,0); 

	

	if(get_option(THEME_NAME."_show_first_thumb") == "on" && $image['show']==true) {
?>
	<div class="item-header">
		<div class="relative-element">
			<?php if (ot_option_compare('showTumbIcon','showTumbIcon',$post->ID)==true) { ?>
				<div class="image-overlay-icons" onclick="javascript:location.href = '<?php the_permalink();?>';">
					<a href="<?php the_permalink();?>" title="<?php esc_html_e("Read article", THEME_NAME);?>"><i class="fa fa-search"></i></a>
					<?php if ( comments_open() && ot_option_compare("post_comments_single","post_comments_single", $post->ID)==true) { ?>
						<a href="<?php the_permalink();?>#comments" title="<?php esc_html_e("Read comments", THEME_NAME);?>"><i class="fa fa-comments"></i></a>
					<?php } ?>
				</div>
			<?php } ?>
			<a href="<?php the_permalink();?>" class="hover-image">
				<?php echo ot_image_html($post->ID,$width,$height);?>
			</a>
		</div>
	</div>
<?php } ?>
