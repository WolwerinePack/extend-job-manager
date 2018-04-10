<?php
add_action('widgets_init', create_function('', 'return register_widget("OT_gallery");'));

class OT_gallery extends WP_Widget {
	function OT_gallery() {
		 parent::__construct(false, $name = THEME_FULL_NAME.' '.esc_html("Latest Galleries", THEME_NAME));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => esc_html("Latest Galleries", THEME_NAME),
			'count' => '3',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = esc_attr($instance['title']);
		$count = esc_attr($instance['count']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php  esc_html_e( 'Title:' , THEME_NAME ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php  esc_html_e( 'Item shown:' , THEME_NAME );?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>

        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['color'] = strip_tags($new_instance['color']);
		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$count = $instance['count'];
		$counter=1;
		if(!$count) $count=3;

		$my_query = new WP_Query(array('post_type' => 'gallery', 'showposts' => $count));  

		
		$totalCount = $my_query->found_posts;
        ?>
        <?php echo $before_widget;?>
			<?php if($title) echo $before_title.$title.$after_title; ?>
			<div>
			<div class="photo-gallery-list">
				<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
					<?php
						global $post;
						$g = $my_query->post->ID;
						$gallery_style = get_post_meta ( $g, "_".THEME_NAME."_gallery_style", true );
						$galleryImages = get_post_meta ( $g, THEME_NAME."_gallery_images", true ); 
						$imageIDs = explode(",",$galleryImages);
					?>
						<div class="item" rel="gallery-<?php echo $g;?>">
							<div class="item-header">
								<div class="gallery-navi">
									<a href="#gal-left"><i class="fa fa-angle-left"></i></a>
									<a href="#gal-right"><i class="fa fa-angle-right"></i></a>
								</div>
								<div class="gallery-change">
									<?php
										$c=1;
					            		foreach($imageIDs as $imgID) { 
					            			
					            			if($imgID) {
					            				$file = wp_get_attachment_url($imgID);
					            				$image = get_post_thumb(false, 300, 168, false, $file);
					            				if($c==1) {
					            					$class = " active";
					            				} else {
					            					$class = false;
					            				}
						            			
											?>

												<a href="<?php the_permalink();?>?page=<?php echo $c;?>" class="<?php if($gallery_style=="lightbox") { echo ' light-show '; } echo $class; ?>" data-id="gallery-<?php echo $g;?>">
													<img src="<?php echo $image['src'];?>" data-id="<?php echo $c;?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
												</a>
											<?php 
											///if($c==4) break;	
											$c++;
											} 
										} 
									?>
								</div>
							</div>
							<div class="item-content">
								<h4><a href="<?php the_permalink();?>" data-id="gallery-<?php echo $g;?>" class="<?php if($gallery_style=="lightbox") { echo 'light-show '; } ?>"><?php the_title();?></a></h4>
								<?php 
									add_filter('excerpt_length', 'new_excerpt_length_10');
									the_excerpt();
								?>
								<a href="<?php the_permalink();?>" data-id="gallery-<?php echo $g;?>" class="read-more-link right<?php if($gallery_style=="lightbox") { echo ' light-show '; } ?>"><?php esc_html_e("View gallery", THEME_NAME);?><i class="fa fa-chevron-right"></i></a>
								<span class="info-empty-link"><i class="fa fa-camera"></i><?php echo OT_image_count($g);?> <?php esc_html_e("Photos", THEME_NAME);?></span>
								<div class="clear-float"></div>
							</div>
						</div>

				<?php $counter++; ?>
				<?php endwhile; ?>
				<?php endif; ?>	
			</div>
			</div>


		<?php echo $after_widget; ?>	
        <?php
	}
}
?>