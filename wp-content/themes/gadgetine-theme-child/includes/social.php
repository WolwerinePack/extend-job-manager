<?php 
	
	//main share icons
	$mainShare = get_option(THEME_NAME."_main_share");


	if($mainShare=="on") {
	wp_reset_query();

	if(is_category()) {
		$category = get_the_category();
		$category_id = get_cat_id( single_cat_title("",false) );
		$link = get_category_link( $category_id );
	} else {
		$link = get_permalink();
	}
?>

	<div class="social-icons-float">

		<span class="soc-header"><?php esc_html_e("Share", THEME_NAME);?></span>

		<span class="social-icon">
			<span class="social-count"><span class="count">0</span><span class="social-arrow">&nbsp;</span></span>
			<a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $link;?>" data-url="<?php echo $link;?>" class="social-button ot-share" style="background:#495fbd;"><i class="fa fa-facebook"></i><font><?php esc_html_e("Share", THEME_NAME);?></font></a>
		</span>

		<span class="social-icon">
			<span class="social-count"><span class="count">0</span><span class="social-arrow">&nbsp;</span></span>
			<a href="#" data-hashtags="" data-url="<?php echo $link;?>" data-via="<?php echo esc_attr(get_option(THEME_NAME.'_twitter_name'));?>" data-text="<?php echo esc_attr(get_the_title());?>" class="social-button ot-tweet" style="background:#43bedd;"><i class="fa fa-twitter"></i><font><?php esc_html_e("Tweet", THEME_NAME);?></font></a>
		</span>

		<span class="social-icon">
			<span class="social-count"><?php echo OT_plusones($link);?><span class="social-arrow">&nbsp;</span></span>
			<a href="https://plus.google.com/share?url=<?php echo $link;?>" class="social-button ot-pluss" style="background:#df6149;"><i class="fa fa-google-plus"></i><font><?php esc_html_e("+1", THEME_NAME);?></font></a>
		</span>

		<span class="social-icon">
			<span class="social-count"><span class="count">0</span><span class="social-arrow">&nbsp;</span></span>
			<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $link;?>&title=<?php echo esc_attr(get_the_title());?>" class="social-button ot-link" style="background:#264c84;" data-url="<?php echo $link;?>"><i class="fa fa-linkedin"></i><font><?php esc_html_e("Share", THEME_NAME);?></font></a>
		</span>

	</div>
<?php } ?>