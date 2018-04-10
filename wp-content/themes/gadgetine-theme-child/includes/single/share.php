<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$image = get_post_thumb($post->ID,0,0); 
?>

		<?php if(ot_option_compare('share_all','share_single',$post->ID)==true) { ?>
			<div class="article-share-bottom" id="share">
				
				<b><?php esc_html_e("Share", THEME_NAME);?></b>

				<span class="social-icon">
					<a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr(get_permalink());?>" data-url="<?php echo esc_attr(get_permalink());?>" class="social-button ot-share" style="background:#495fbd;"><i class="fa fa-facebook"></i><font><?php esc_html_e("Share", THEME_NAME);?></font></a>
					<span class="social-count"><span class="count">0</span><span class="social-arrow">&nbsp;</span></span>
				</span>

				<span class="social-icon">
					<a href="#" data-hashtags="" data-url="<?php echo esc_attr(get_permalink());?>" data-via="<?php echo get_option(THEME_NAME.'_twitter_name');?>" data-text="<?php echo esc_attr(get_the_title());?>" class="social-button ot-tweet" style="background:#43bedd;"><i class="fa fa-twitter"></i><font><?php esc_html_e("Tweet", THEME_NAME);?></font></a>
					<span class="social-count"><span class="count">0</span><span class="social-arrow">&nbsp;</span></span>
				</span>

				<span class="social-icon">
					<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="social-button ot-pluss" style="background:#df6149;"><i class="fa fa-google-plus"></i><font><?php esc_html_e("+1", THEME_NAME);?></font></a>
					<span class="social-count"><?php echo OT_plusones(get_permalink());?><span class="social-arrow">&nbsp;</span></span>
				</span>

				<span class="social-icon">
					<a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_attr(get_permalink());?>&media=<?php echo $image['src']; ?>&description=<?php echo esc_attr(get_the_title()); ?>" data-url="<?php echo esc_attr(get_permalink());?>" class="social-button ot-pin" style="background:#d23131;"><i class="fa fa-pinterest"></i><font><?php esc_html_e("Share", THEME_NAME);?></font></a>
					<span class="social-count"><span class="count">0</span><span class="social-arrow">&nbsp;</span></span>
				</span>

				<span class="social-icon">
					<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_attr(get_permalink());?>&title=<?php echo esc_attr(get_the_title());?>" class="social-button ot-link" style="background:#264c84;" data-url="<?php echo esc_attr(get_permalink());?>"><i class="fa fa-linkedin"></i><font><?php esc_html_e("Share", THEME_NAME);?></font></a>
					<span class="social-count"><span class="count">0</span><span class="social-arrow">&nbsp;</span></span>
				</span>

				<div class="clear-float"></div>

			</div>
		<?php } ?>		