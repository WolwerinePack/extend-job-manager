<?php
/*
Template Name: Archive Page
*/	
?>
<?php get_header(); ?>
<?php
	wp_reset_query();
	global $wpdb;
	$limit = 0;
	$months = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month ,	YEAR( post_date ) AS year, COUNT( id ) as post_count FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'post' GROUP BY month , year ORDER BY post_date DESC");
	$cc=1;

	//sidebars
    $sidebar = get_post_meta( OT_page_ID(), "_".THEME_NAME.'_sidebar_select', true );
    if(is_category()) {
        $sidebar = ot_get_option(get_cat_id( single_cat_title("",false) ), 'sidebar_select', false);
    } elseif(is_tax()) {
        $sidebar = ot_get_option(get_queried_object()->term_id, 'sidebar_select', false);
    }

?>
	<?php get_template_part(THEME_LOOP."loop-start"); ?>
		<div class="archive-grid">
				<?php 
					$args = array(
						'type'                     => 'post',
						'child_of'                 => 0,
						'orderby'                  => 'name',
						'order'                    => 'ASC',
						'hide_empty'               => 1,
						'hierarchical'             => 1,
						'taxonomy'                 => 'category',
						'pad_counts'               => false );
							
					$categories = get_categories( $args );

					
					foreach ( $categories as $category ) { 
						$count_total = $category->count;
						$counter = 1;
						$cat_id = $category->term_id;
						$query='cat='.$cat_id.'&showposts=5';
						$my_query = new WP_Query($query);
						$titleColor = ot_title_color($cat_id, "category", false);
						

				?>
				<!-- BEGIN .def-panel -->
				<div class="def-panel">
					<div class="panel-title">
						<a href="<?php echo get_category_link ( $category->term_id ) ;?>" class="right"><?php printf(esc_html("show all %1$s news",THEME_NAME),$category->name);?></a>
						<h2 style="border-bottom: 2px solid <?php echo $titleColor;?>; color: <?php echo $titleColor;?>;"><?php echo $category->name; ?></h2>
					</div>
					<?php if ( $my_query->have_posts() ) : $my_query->the_post(); ?>
						<?php $image = get_post_thumb($my_query->post->ID,0,0); ?>
						<div class="panel-content article-list-big">

							<!-- BEGIN .item -->
							<div class="item item-the-huge<?php if($image['show']==false) { echo " no-image"; } ?>">
								<?php if($image['show']!=false) {  ?>
									<div class="item-header">
										<div class="image-overlay-icons" onclick="javascript:location.href = '<?php the_permalink();?>';">
											<a href="post.html" title="<?php esc_html_e("Read article", THEME_NAME);?>"><i class="fa fa-search"></i></a>
											<?php if ( comments_open() && ot_option_compare("post_comments_single","post_comments_single", $my_query->post->ID)==true) { ?>
												<a href="<?php the_permalink();?>#comments" title="<?php esc_html_e("Read comments", THEME_NAME);?>"><i class="fa fa-comments"></i></a>
											<?php } ?>
										</div>
										<a href="<?php the_permalink();?>" class="hover-image">
											<?php echo ot_image_html($my_query->post->ID,386,215);?>
										</a>
									</div>
								<?php } ?>
								<div class="item-content">
									<h3>
										<a href="<?php the_permalink();?>"><?php the_title();?></a>
										<?php if ( comments_open() && ot_option_compare("post_comments_single","post_comments_single", $post->ID)==true) { ?>
											<a href="<?php the_permalink();?>#comments" class="comment-link">
												<i class="fa fa-comment-o"></i>
												<span><?php comments_number("0","1","%"); ?></span>
											</a>
										<?php } ?>
									</h3>
									<?php 
										add_filter('excerpt_length', 'new_excerpt_length_50');
										the_excerpt();
										remove_filter('excerpt_length', 'new_excerpt_length_50');
									?>				
									<a href="<?php the_permalink();?>" class="read-more-link"><?php esc_html_e("Read More",THEME_NAME);?><i class="fa fa-chevron-right"></i></a>												
								</div>
								<!-- END .item -->
							</div>

						</div>
					<?php else: ?>
					<?php endif; ?>
					<div class="medium-article-list">
						<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
							<?php $image = get_post_thumb($my_query->post->ID,0,0); ?>
							<div class="item<?php if($image['show']==false) { echo " no-image"; } ?>">
								<?php if($image['show']!=false) {  ?>
									<div class="item-header">
										<div class="image-overlay-icons" onclick="javascript:location.href = '<?php the_permalink();?>';">
											<a href="<?php the_permalink();?>" title="<?php esc_html_e("Read article", THEME_NAME);?>"><i class="fa fa-search"></i></a>
										</div>
										<a href="<?php the_permalink();?>" class="hover-image">
											<?php echo ot_image_html($my_query->post->ID,114,85);?>
										</a>
									</div>
								<?php } ?>
								<div class="item-content">
									<h4>
										<a href="<?php the_permalink();?>"><?php the_title();?></a>
										<?php if ( comments_open() && ot_option_compare("post_comments_single","post_comments_single", $post->ID)==true) { ?>
											<a href="<?php the_permalink();?>#comments" class="comment-link">
												<i class="fa fa-comment-o"></i>
												<span><?php comments_number("0","1","%"); ?></span>
											</a>
										<?php } ?>
									</h4>
									<?php 
										add_filter('excerpt_length', 'new_excerpt_length_20');
										the_excerpt();
										remove_filter('excerpt_length', 'new_excerpt_length_20');
									?>									
								</div>

							</div>
						<?php endwhile; else: ?>
						<?php endif; ?>

						<a href="<?php echo get_category_link ( $category->term_id ) ;?>" class="more-articles-button">
							<?php printf(esc_html("show all %1$s news",THEME_NAME),$category->name);?>
						</a>
					</div>

				<!-- END .def-panel -->
				</div>
				<?php } ?>
				</div>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer(); ?>