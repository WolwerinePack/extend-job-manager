<?php

	
	// author id
	$user_ID = get_the_author_meta('ID');

	//social
	$linkedin = get_user_meta($user_ID, 'linkedin', true);
	$twitter = get_user_meta($user_ID, 'twitter', true);
	$facebook = get_user_meta($user_ID, 'facebook', true);
	$pinterest = get_user_meta($user_ID, 'pinterest', true);
	$googlepluss = get_user_meta($user_ID, 'googlepluss', true);

?>


<?php if(ot_option_compare('about_author','about_author',$post->ID)==true) { ?>

	<!-- BEGIN .def-panel -->
	<div class="def-panel">
		<div class="panel-title">
			<a href="<?php $user_info = get_userdata($user_ID); echo get_author_posts_url($user_ID, $user_info->user_nicename ); ?>" class="right">
				<?php esc_html_e("view more articles", THEME_NAME);?>
			</a>
			<h2><?php esc_html_e("About Article Author", THEME_NAME);?></h2>
		</div>
		<div class="about-author">
			<?php if(ot_get_avatar_url(get_avatar( get_the_author_meta('user_email',$user_ID), 100))) { ?>
				<span class="about-author-header">
					<img src="<?php echo ot_get_avatar_url(get_avatar( get_the_author_meta('user_email',$user_ID), 100));?>" alt="<?php echo esc_attr(get_the_author_meta('display_name',$user_ID)); ?>" />
				</span>
			<?php } ?>
			<div class="about-author-content">
				<div class="right">
					<?php if($facebook) { ?><a href="<?php echo $facebook;?>" class="soc-facebook"><i class="fa fa-facebook"></i></a><?php } ?>
					<?php if($twitter) { ?><a href="<?php echo $twitter;?>" class="soc-twitter"><i class="fa fa-twitter"></i></a><?php } ?>
					<?php if($pinterest) { ?><a href="<?php echo $pinterest;?>" class="soc-pinterest"><i class="fa fa-pinterest"></i></a><?php } ?>
					<?php if($googlepluss) { ?><a href="<?php echo $googlepluss;?>" class="soc-google-plus"><i class="fa fa-google-plus"></i></a><?php } ?>
					<?php if($linkedin) { ?><a href="<?php echo $linkedin;?>" class="soc-linkedin"><i class="fa fa-linkedin"></i></a><?php } ?>
				</div>
				<strong><?php echo get_the_author_meta('display_name',$user_ID); ?></strong>
				<p><?php echo get_the_author_meta('description'); ?></p>
				<a href="<?php $user_info = get_userdata($user_ID); echo get_author_posts_url($user_ID, $user_info->user_nicename ); ?>" class="read-more-link"><?php esc_html_e("View More Articles", THEME_NAME);?><i class="fa fa-chevron-right"></i></a>
			</div>
		</div>
	<!-- END .def-panel -->
	</div>
<?php } ?>