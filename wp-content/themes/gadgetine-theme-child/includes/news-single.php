<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();

	$image = get_post_thumb($post->ID,0,0); 
	$link = get_permalink();
?>

	<?php get_template_part(THEME_LOOP."loop-start"); ?>
		<?php if (have_posts()) : ?>
			<!-- BEGIN .def-panel -->
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
										<a href="https://twitter.com/share" data-hashtags="" data-url="<?php echo $link;?>" data-via="<?php echo get_option(THEME_NAME.'_twitter_name');?>" data-text="<?php echo urlencode(remove_html(get_the_title()));?>" class="soc-twitter ot-tweet"><i class="fa fa-twitter"></i></a>
										<a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_attr(get_permalink());?>&media=<?php echo $image['src']; ?>&description=<?php echo esc_attr(get_the_title()); ?>" data-url="<?php echo esc_attr(get_permalink());?>" class="soc-pinterest ot-pin"><i class="fa fa-pinterest"></i></a>
										<a href="https://plus.google.com/share?url=<?php echo $link; ?>" class="soc-google-plus ot-pluss"><i class="fa fa-google-plus"></i></a>
										<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $link;?>&title=<?php echo urlencode(remove_html(get_the_title()));?>" data-url="<?php echo $link;?>" class="soc-linkedin ot-link"><i class="fa fa-linkedin"></i></a>
									</div>
								<?php } ?>
								<?php if(ot_option_compare('post_date_single','post_date',$post->ID)==true || ot_option_compare('printPost','printPost',$post->ID)==true || ot_option_compare('post_author_single','post_author_single',$post->ID)==true) { ?>
								<span class="article-header-meta">
								<?php } ?>
									<?php if(ot_option_compare('post_date_single','post_date',$post->ID)==true) { ?>
										<span class="article-header-meta-date"><?php the_time("F d");?></span>
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

					<?php wp_reset_query();?>		
					<?php the_content();?>	
					<?php 
						$args = array(
							'before'           => '<div class="post-pages"><p>' . esc_html('Pages:', THEME_NAME),
							'after'            => '</p></div>',
							'link_before'      => '',
							'link_after'       => '',
							'next_or_number'   => 'number',
							'nextpagelink'     => esc_html('Next page', THEME_NAME),
							'previouspagelink' => esc_html('Previous page', THEME_NAME),
							'pagelink'         => '%',
							'echo'             => 1
						);

						wp_link_pages($args); 
					?>	

					<?php get_template_part(THEME_SINGLE."post-ratings"); ?>
					<?php get_template_part(THEME_SINGLE."post-tags-categories"); ?>
					</div>
				<!-- END .def-panel -->
				</div>

				<?php get_template_part(THEME_SINGLE."about-author"); ?>
				<?php get_template_part(THEME_SINGLE."post-related"); ?>
				
			<?php else: ?>
				<p><?php  esc_html_e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
			<?php endif; ?>
			<?php wp_reset_query(); ?>
			<?php if ( comments_open() ) : ?>
				<?php comments_template(); // Get comments.php template ?>
			<?php endif; ?>
	<?php get_template_part(THEME_LOOP."loop-end"); ?>