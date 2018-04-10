<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
	
	$width = 1200;
	$height = 545;
	$image = get_post_thumb($post->ID,$width,$height); 
	

	//post details
	$caption = stripslashes(get_post_meta( $post->ID, "_".THEME_NAME."_image_caption", true ));


	$video = get_post_meta( $post->ID, "_".THEME_NAME."_video_code", true );


	if(ot_option_compare('show_single_thumb','show_single_thumb',$post->ID)==true && $image['show']==true && !$video) {
?>
	<div class="article-header-photo">
		<?php if($caption) { ?>
			<p class="featured-caption"><?php echo $caption;?></p>
		<?php } ?>
		<?php echo ot_image_html($post->ID,$width,$height); ?>
	</div>
<?php } elseif(ot_option_compare('show_single_thumb','show_single_thumb',$post->ID)==true && $video) {  ?>
	<div class="article-featured-video">
		<div class="video-embed">
			<?php echo stripslashes($video);?>
		</div>
	</div>
<?php } ?>