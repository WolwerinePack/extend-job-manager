<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
	$post_type = get_post_type();
	if(is_category()) {
		//custom colors
		$catId = get_cat_id( single_cat_title("",false) );
		$titleColor = ot_title_color($catId, "category", false);
	} else {
		//custom colors
		$titleColor = ot_title_color(OT_page_id(),"page", false);
	}
?>					

<?php if (ot_option_compare('show_single_title','show_single_title',$post->ID)==true) { ?>
	<div class="panel-title">
		<?php if($post_type == OT_POST_GALLERY) { ?>
			<a href="<?php echo get_page_link(ot_get_page("gallery", false));?>" class="right"><?php esc_html_e("back to galleries",THEME_NAME);?></a>
		<?php } else { ?>
			<a href="<?php echo home_url();?>" class="right"><?php esc_html_e("back to homepage",THEME_NAME);?></a>
		<?php } ?>
		<h2 style="color: <?php echo $titleColor;?>; border-bottom: 2px solid <?php echo $titleColor;?>;"><?php ot_page_title(); ?></h2>
	</div>
<?php } ?>