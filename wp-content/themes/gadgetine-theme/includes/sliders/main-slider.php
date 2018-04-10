<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();

	//main slider
	$mainSlider = get_post_meta ( OT_page_id(), "_".THEME_NAME."_main_slider", true ); 

	//slide counter
	$counter = 1;
	$totalCounter = 0;
	if((is_array($mainSlider) && !empty($mainSlider) && !in_array("slider_off",$mainSlider)) || (is_category() && $mainSlider=="on")) { 
		$args=array(
			'category__in' => $mainSlider,
			'showposts' => get_option(THEME_NAME."_main_slider_count"),
			'order'	=> 'DESC',
			'orderby'	=> 'date',
			'meta_key'	=> "_".THEME_NAME.'_main_slider_post',
			'meta_value'	=> 'on',
			'post_type'	=> 'post',
			'ignore_sticky_posts '	=> 1,
			'post_status '	=> 'publish'
		);


		$the_query = new WP_Query($args);
?>
	<!-- BEGIN .full-block -->
	<div class="full-block">
		
		<!-- BEGIN .ot-slider -->
		<div class="ot-slider owl-carousel">

			<!-- BEGIN .ot-slide -->
			<div class="ot-slide">
				<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php 
						switch ($counter) {
							case 1:
								$class = "first";
								$width = "552";
								$height = "426";
								break;
							case 2:
								$class = "second";
								$width = "264";
								$height = "426";
								break;
							case 3:
								$class = "third";
								$width = "360";
								$height = "207";
								break;
							case 4:
								$class = "fourth";
								$width = "360";
								$height = "207";
								break;
							default:
								$class = false;
								$width = "0";
								$height = "0";
								break;
						}
						$image = get_post_thumb($the_query->post->ID,$width,$height,THEME_NAME.'_homepage_image');  
						
						//categories
						$categories = get_the_category($the_query->post->ID);
                        $catCount = count($categories);
                        //select a random category id
                        $id = rand(0,$catCount-1);
						$titleColor = ot_title_color($categories[$id]->term_id, "category", false);
					?>
					<div class="ot-slider-layer <?php echo $class;?>">
						<a href="<?php the_permalink();?>">
							<strong>
								<span style="color: <?php echo $titleColor;?>;" class="category-tag"><?php echo get_cat_name($categories[$id]->term_id);?></span>
								<?php the_title();?>
								<?php if ( comments_open() && ot_option_compare("post_comments_single","post_comments_single", $the_query->post->ID)==true) { ?>
									<span class="comment-link">
										<i class="fa fa-comment-o"></i>
										<span><?php comments_number("0","1","%"); ?></span>
									</span>
								<?php } ?>
							</strong>
							<img src="<?php echo $image['src'];?>" alt="<?php the_title();?>" />
						</a>
					</div>
					<?php 
						$counter++; 
						$totalCounter++; 
					?>
					<?php if($counter==5 && $the_query->post_count != $totalCounter) { ?>
						<!-- END .ot-slide -->
						</div>
						<!-- BEGIN .ot-slide -->
						<div class="ot-slide">
						<?php $counter = 1; ?>
					<?php } ?>
				<?php endwhile; else: ?>
					<p><?php  esc_html_e('No posts where found', THEME_NAME); ?></p>
				<?php endif; ?>
			<!-- END .ot-slide -->
			</div>
		<!-- END .ot-slider -->
		</div>

	<!-- END .full-block -->
	</div>

	<?php } ?>
<?php wp_reset_query();  ?>