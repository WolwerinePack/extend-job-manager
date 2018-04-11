<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();

	$post_type = get_post_type();
	$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
	$sidebarPositionCustom = get_post_meta ( $post->ID, THEME_NAME."_sidebar_position", true ); 
	

	if($post_type == OT_POST_GALLERY) {
		get_template_part(THEME_INCLUDES.'gallery-single','style-1');
	} else if($post_type == OT_POST_PORTFOLIO) {
		get_template_part(THEME_INCLUDES.'portfolio-single');
		get_footer();
	} else if ($post_type== job_listing) {
		require_once('job_single.php');

	} else if ($post_type== post) {
		require_once('company_single.php');

	} else if ($post_type == advert){ ?>		
		 <!-- BEGIN .content -->
			<section class="content">				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">                
                	<div class="main-content-wrapper   big-sidebar-right">
                	<div class="main-content">
                		<div class="def-panel">
							<div class="panel-content shortocde-content">
								<div class="article-header"> 
                    				<?php get_template_part(THEME_SINGLE."post-title"); ?>
									<?php get_template_part(THEME_SINGLE."image");?>
									<?php if(ot_option_compare('post_date_single','post_date',$post->ID)==true 
											|| ot_option_compare('printPost','printPost',$post->ID)==true
											|| ot_option_compare('share_all','share_single',$post->ID)==true
											|| ot_option_compare('post_author_single','post_author_single',$post->ID)==true
									) { ?>
									<div class="article-header-info">
									<?php if(ot_option_compare('share_all','share_single',$post->ID)==true) { ?>                               
                                	<div class="right social-headers">
										<a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $link;?>" data-url="<?php echo $link;?>" class="soc-facebook ot-share"><i class="fa fa-facebook"></i></a>
										<a href="#" data-hashtags="" data-url="<?php echo $link;?>" data-via="<?php echo get_option(THEME_NAME.'_twitter_name');?>" data-text="<?php echo urlencode(remove_html(get_the_title()));?>" class="soc-twitter ot-tweet"><i class="fa fa-twitter"></i></a>
										<a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_attr(get_permalink());?>&media=<?php echo $image['src']; ?>&description=<?php echo esc_attr(get_the_title()); ?>" data-url="<?php echo esc_attr(get_permalink());?>" class="soc-pinterest ot-pin"><i class="fa fa-pinterest"></i></a>
										<a href="https://plus.google.com/share?url=<?php echo $link; ?>" class="soc-google-plus ot-pluss"><i class="fa fa-google-plus"></i></a>
										<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $link;?>&title=<?php echo urlencode(remove_html(get_the_title()));?>" data-url="<?php echo $link;?>" class="soc-linkedin ot-link"><i class="fa fa-linkedin"></i></a>
									</div>
									<?php } ?>
									<?php if(ot_option_compare('post_date_single','post_date',$post->ID)==true || ot_option_compare('printPost','printPost',$post->ID)==true || ot_option_compare('post_author_single','post_author_single',$post->ID)==true) { ?>
									<span class="article-header-meta">
										<?php } ?>
										<?php if(ot_option_compare('post_date_single','post_date',$post->ID)==true) { ?>
										<span class="article-header-meta-date"><?php the_time("F d");?>											
										</span>
										<span class="article-header-meta-time">
											<span class="head-time"><?php the_time("H:i");?></span>
											<span class="head-year"><?php the_time("Y");?></span>
										</span>
										<?php } ?>
										<?php if(ot_option_compare('printPost','printPost',$post->ID)==true || ot_option_compare('post_author_single','post_author_single',$post->ID)==true) { ?>
										<span class="article-header-meta-links <?php if(ot_option_compare('post_author_single','post_author_single',$post->ID)!=true || (ot_option_compare('printPost','printPost',$post->ID)!=true)) { ?> one-is-missing<?php } ?>">
											<?php } ?>
											<?php 
												if(ot_option_compare('post_author_single','post_author_single',$post->ID)==true) { 
													echo the_author_posts_link();
												}
											?>
											<?php if(ot_option_compare('printPost','printPost',$post->ID)==true && function_exists('wpf_the_print_link')) { ?>
											<?php wpf_the_print_link(true, '<i class="fa fa-print"></i><span>'.esc_html__("Print This Article", THEME_NAME).'</span>', false, false, 'Print this page', 'new'); ?>
											<?php } ?>
											<?php if(ot_option_compare('printPost','printPost',$post->ID)==true || ot_option_compare('post_author_single','post_author_single',$post->ID)==true) { ?>
										</span>
										<?php } ?>
										<?php if(ot_option_compare('post_date_single','post_date',$post->ID)==true || ot_option_compare('printPost','printPost',$post->ID)==true || ot_option_compare('post_author_single','post_author_single',$post->ID)==true) { ?>
									</span>
								<?php } ?>
							</div>
							<?php } ?>
                		</div>        
		                <?php the_content(); ?>
		                <?php wp_reset_query(); ?>
		                <?php if ( comments_open() ) : ?>
						<?php comments_template(); // Get comments.php template ?>
						<?php endif; ?>
                  	</div>
                  	</div>
            	</div>
                <?php get_template_part(THEME_INCLUDES."sidebar");  ?>
                </div><!-- END .wrapper -->
            </div><!-- BEGIN .content -->
		</section>
        <?php get_footer();?>
		 
	<?php }else { 
		get_template_part(THEME_INCLUDES.'news','single');		
		get_footer();
	}
	
	
?>