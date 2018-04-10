<?php
add_action('widgets_init', create_function('', 'return register_widget("OT_popular_posts");'));

class OT_popular_posts extends WP_Widget {
	function OT_popular_posts() {
		 parent::__construct(false, $name = THEME_FULL_NAME.' '.esc_html("Popular Posts", THEME_NAME));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html("Popular Posts", THEME_NAME),
			'count' => '3',
			'cat' => '',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = esc_attr($instance['title']);
		$cat = esc_attr($instance['cat']);
		$count = esc_attr($instance['count']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('cat'); ?>"><?php esc_html_e( 'Category:' , THEME_NAME );?>
			<?php
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 1,
				'hierarchical'             => 1,
				'taxonomy'                 => 'category');
				$args = get_categories( $args ); 
			?> 	
			<select name="<?php echo $this->get_field_name('cat'); ?>" style="width: 100%; clear: both; margin: 0;">
				<option value=""><?php esc_html_e("Latest News", THEME_NAME);?></option>
				<?php foreach($args as $ar) { ?>
					<option value="<?php echo $ar->term_id; ?>" <?php if($ar->term_id==$cat)  {echo 'selected="selected"';} ?>><?php echo $ar->cat_name; ?></option>
				<?php } ?>
			</select>
			
			</label></p>
			
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php esc_html_e( 'Post count:' , THEME_NAME );?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>

		
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['count'] = strip_tags($new_instance['count']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$count = $instance['count'];
		$cat = $instance['cat'];


		$args=array(
			'posts_per_page' => $count,
			'order' => 'DESC',
			'cat' => $cat,
			'orderby'	=> 'meta_value_num',
			'meta_key'	=> "_".THEME_NAME.'_post_views_count',
			'post_type'=> 'post',
			'ignore_sticky_posts' => true
		);



		$the_query = new WP_Query($args);
		$counter = 1;
		
		$totalCount = $the_query->found_posts;
		
		$blogID = get_option('page_for_posts');
		
		if($cat) {
			$link = get_category_link( $cat );
		} else {
			$link = get_page_link($blogID);
		}

?>		
	<?php echo $before_widget; ?>
		<?php if($title) echo $before_title.$title.$after_title; ?>

			<div class="small-article-list">
				<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<?php

					// post details
					$categories = get_the_category($the_query->post->ID); 
					$postCategorySingle = get_post_meta ( $the_query->post->ID, "_".THEME_NAME."_post_category", true ); 
					$postDateSingle = get_post_meta ( $the_query->post->ID, "_".THEME_NAME."_post_date", true ); 
					$image = get_post_thumb($the_query->post->ID,0,0); 

				?>
					<div class="item<?php if($image['show']==false) { echo " no-image"; } ?>">
						<?php if($image['show']==true) { ?>
							<div class="item-header">
								<a href="<?php the_permalink();?>" class="hover-image">
									<?php echo ot_image_html($the_query->post->ID,57,37); ?>
								</a>
							</div>
						<?php } ?>
						<div class="item-content">
							<h4>
								<a href="<?php the_permalink();?>"><?php the_title();?></a>
								<?php if ( comments_open() && ot_option_compare("post_comments_single","post_comments_single", $the_query->post->ID)==true) { ?>
									<a href="<?php the_permalink();?>#comments" class="comment-link">
										<i class="fa fa-comment-o"></i>
										<span><?php comments_number("0","1","%"); ?></span>
									</a>
								<?php } ?>
							</h4>
						</div>
					</div>
				<?php endwhile; else: ?>
					<p><?php  esc_html_e( 'No posts where found' , THEME_NAME);?></p>
				<?php endif; ?>
			</div>

	<?php echo $after_widget; ?>
    <?php
	}
}
?>