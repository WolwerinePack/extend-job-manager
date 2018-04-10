<?php
add_action('widgets_init', create_function('', 'return register_widget("OT_cat_posts");'));

class OT_cat_posts extends WP_Widget {
	function OT_cat_posts() {
		 parent::__construct(false, $name = THEME_FULL_NAME.' '.esc_html("Latests News", THEME_NAME));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html("Latests News", THEME_NAME),
			'cat' => '',
			'count' => '3',
			'images' => 'show',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = esc_attr($instance['title']);
		$cat = esc_attr($instance['cat']);
		$count = esc_attr($instance['count']);
		$images = esc_attr($instance['images']);
        ?>
         	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( esc_html( 'Title:' , THEME_NAME ));?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('cat'); ?>"><?php printf ( esc_html( 'Category:' , THEME_NAME ));?>
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
			<p><label for="<?php echo $this->get_field_id('images'); ?>"><?php printf ( esc_html( 'Images:' , THEME_NAME ));?>
			<select name="<?php echo $this->get_field_name('images'); ?>" style="width: 100%; clear: both; margin: 0;">
				<option value="show" <?php if("show"==$images)  {echo 'selected="selected"';} ?>><?php esc_html_e("Show", THEME_NAME);?></option>
				<option value="hide" <?php if("hide"==$images)  {echo 'selected="selected"';} ?>><?php esc_html_e("Hide", THEME_NAME);?></option>
			</select>
			
			</label></p>
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php printf ( esc_html( 'Post count:' , THEME_NAME ));?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>

			
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['images'] = strip_tags($new_instance['images']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$count = $instance['count'];
		$cat = $instance['cat'];
		$images = $instance['images'];


	
	$args=array(
		'cat'=> $cat,
		'posts_per_page'=> $count,
		'ignore_sticky_posts' => true
	);
	
	$the_query = new WP_Query($args);
		$counter = 1;

	$blogID = get_option('page_for_posts');

	if($cat) {
		$link = get_category_link( $cat );
		$color = ot_title_color($cat, 'category', false);
	} else {
		$link = get_page_link($blogID);
		$color = ot_title_color($blogID, 'page', false);
	}

?>		
	<?php echo $before_widget; ?>
		<?php if($title) { ?>
			<h3 style="border-bottom: 2px solid <?php echo $color;?>; color: <?php echo $color;?>;">
				<?php echo $title;?>
			</h3>
		<?php } ?>
			<div class="small-article-list">
				<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<?php

					// post details
					$categories = get_the_category($the_query->post->ID); 
					$postCategorySingle = get_post_meta ( $the_query->post->ID, "_".THEME_NAME."_post_category", true ); 
					$postDateSingle = get_post_meta ( $the_query->post->ID, "_".THEME_NAME."_post_date", true ); 
					$image = get_post_thumb($the_query->post->ID,0,0); 

				?>
					<div class="item<?php if($image['show']==false || $images=="hide") { echo " no-image"; } ?>">
						<?php if($image['show']==true && $images!="hide") { ?>
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
				<?php if($link) { ?>
					<a href="<?php echo $link;?>" class="more-articles-button"><?php esc_html_e("show all articles", THEME_NAME);?></a>
				<?php } ?>
			</div>

	<?php echo $after_widget; ?>

      <?php
	}
}
?>