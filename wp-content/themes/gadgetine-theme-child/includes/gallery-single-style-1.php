<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();
	wp_reset_query();
									
	$i = get_query_var( 'page', 1 );
	if ($i == 0) $i = 1;
	
	$galleryImages = get_post_meta ( $post->ID, THEME_NAME."_gallery_images", true ); 
	$imageIDs = explode(",",$galleryImages);
	$count = OT_image_count($post->ID);

	//main image
	$file = wp_get_attachment_url($imageIDs[$i-1]);
	$image = get_post_thumb(false, 1200, 824, false, $file);	

	$term_list = wp_get_post_terms($post->ID, OT_POST_GALLERY.'-cat');

	$catCount=0;
	foreach($term_list as $term){
		$catCount++;
	}
	
	$randID = rand(0,$catCount-1);	

?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<!-- BEGIN .def-panel -->
	<div class="def-panel">
		<?php get_template_part(THEME_SINGLE."page-title"); ?>

			<?php if (have_posts()): ?>

				<div class="panel-content ot-slide-item gallery-full-photo" id="<?php echo $post->ID;?>">
					<span class="next-image" data-next="<?php echo $i+1;?>"></span>
					<div class="photo-gallery-main">
						<a href="javascript:;" class="prev photo-controls" rel="<?php if($i>1) { echo $i-1; } else { echo $i-1; } ?>"><i class="fa fa-chevron-left"></i></a>
						<a href="javascript:;" class="next photo-controls" rel="<?php if($i<$count) { echo $i+1; } else { echo $i; } ?>"><i class="fa fa-chevron-right"></i></a>
						<div class="the-image loading waiter">
							<img class="image-big-gallery ot-gallery-image" data-id="<?php echo $i;?>" style="display:none;" src="<?php echo $image['src'];?>" alt="<?php echo esc_attr(the_title());?>" />
						</div>
					</div>
					<div class="photo-gallery-thumbs the-thumbs">
						<div>
		            		<?php 
			            		$c=1;
			            		foreach($imageIDs as $id) { 
			            			if($id) {
				            			$file = wp_get_attachment_url($id);
				            			$image = get_post_thumb(false, 80, 80, false, $file);
			            	?>
								<a href="javascript:;" class="gal-thumbs <?php if($c==$i) { ?>active<?php } ?>" rel="<?php echo $c;?>" data-nr="<?php echo $c;?>">
									<img src="<?php echo $image['src'];?>" alt="<?php echo esc_attr(get_the_title());?>"/>
								</a>
				                <?php $c++; ?>
			               	 	<?php } ?>
			                <?php } ?>
						</div>
					</div>
					<div class="photo-gallery-content shortocde-content">
						
						<div class="content-category">
							<?php foreach ($term_list as $term) { ?>
								<a href="<?php echo get_term_link((int)$term->term_id, OT_POST_GALLERY.'-cat');?>" style="color: <?php ot_title_color($term->term_id);?>;"><?php echo $term->name;?></a>
							<?php } ?>
						</div>

						<h2><?php the_title();?></h2>
						<?php 
							if (get_the_content() != "") { 				
								add_filter('the_content','remove_images');
								add_filter('the_content','remove_objects');
								the_content();
							} 
						?>
					</div>
				</div>
			<?php endif;?>
		</div>

		<?php if(ot_option_compare('similar_posts_gallery','similar_posts', $post->ID)==true) { ?>
			<!-- BEGIN .def-panel -->
			<div class="def-panel">
				<div class="panel-title">
					<a href="<?php echo get_page_link(ot_get_page("gallery", false));?>" class="right"><?php esc_html_e("view all galleries",THEME_NAME);?></a>
					<h2><?php esc_html_e("Related Photo Galleries",THEME_NAME);?></h2>
				</div>
				<div class="panel-content">

					<div class="photo-gallery-grid">
						<?php
							$categories = get_the_terms($post->ID, OT_POST_GALLERY.'-cat');
							$categoriesNew = array();
							$i=0;
							if(!empty($categories)) {
								foreach ($categories as $category) {
									$categoriesNew[$i]['term_id'] = $category->term_id;
									$categoriesNew[$i]['name'] = $category->name;
									$i++;
								}
								$categories = $categoriesNew;
								if($i==1) {
									$randID = 0;
								} else {
									$randID = rand(0,$i-1);
								}
							} else {
								$randID = 0;
							}


							$counter=1;
							$my_query = new WP_Query( 
								array( 
									'post__not_in' => array($post->ID),
									'post_type' => OT_POST_GALLERY, 
									'showposts' => 4, 
									'tax_query' => array(
										array(
											'taxonomy' => OT_POST_GALLERY.'-cat',
											'field' => 'id',
											'terms' => $categories[$randID]['term_id'],
										)
									),
									'orderby' => 'rand'
								)
							);
							
							if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); 
								$term_list = wp_get_post_terms($my_query->post->ID, OT_POST_GALLERY.'-cat');
								$catCount=0;
								foreach($term_list as $term){
									$catCount++;
								}
								
								$randID = rand(0,$catCount-1);	

								$src = get_post_thumb($post->ID,284,213);
								$gallery_style = get_post_meta ( $post->ID, "_".THEME_NAME."_gallery_style", true );
						?>
							<div class="item" data-id="gallery-<?php the_ID(); ?>">
								<div class="item-header">
									<div class="image-overlay-icons<?php if($gallery_style=="lightbox") { echo ' light-show'; } ?>" data-color="<?php ot_title_color($term_list[$randID]->term_id);?>" data-id="gallery-<?php the_ID(); ?>" onclick="javascript:location.href = '<?php the_permalink();?>';<?php if($gallery_style=="lightbox") { echo ' return false;'; } ?>">
										<a href="<?php the_permalink();?>" title="<?php esc_html_e("Read article", THEME_NAME);?>" <?php if($gallery_style=="lightbox") { echo ' class="light-show"'; } ?> data-id="gallery-<?php the_ID(); ?>"><i class="fa fa-search"></i></a>
									</div>
									<a href="<?php the_permalink();?>" class="hover-image<?php if($gallery_style=="lightbox") { echo ' light-show'; } ?>" data-id="gallery-<?php the_ID(); ?>">
										<img src="<?php echo $src["src"]; ?>" alt="<?php the_title();?>" />
									</a>
								</div>
								<div class="item-content">
									<?php if(isset($term_list[$randID]->term_id)) { ?>
										<div class="content-category">
											<a href="<?php echo get_term_link((int)$term_list[$randID]->term_id, OT_POST_GALLERY.'-cat');?>" style="color: <?php ot_title_color($term_list[$randID]->term_id);?>;"><?php echo $term_list[$randID]->name;?></a>
										</div>
									<?php } ?>
									<h3><a href="<?php the_permalink();?>"<?php if($gallery_style=="lightbox") { echo ' class="light-show"'; } ?> data-id="gallery-<?php the_ID(); ?>"><?php the_title();?></a></h3>
									<?php 
										add_filter('excerpt_length', 'new_excerpt_length_20');
										the_excerpt();
									?>
									<a href="<?php the_permalink();?>" class="read-more-link<?php if($gallery_style=="lightbox") { echo ' light-show'; } ?>" data-id="gallery-<?php the_ID(); ?>"><?php esc_html_e("View Gallery", THEME_NAME);?><i class="fa fa-chevron-right"></i></a>
								</div>
							</div>

							<?php $counter++; ?>
						<?php endwhile;?>
						<?php else: ?>
							<p><?php  esc_html_e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
						<?php endif; ?>
					</div>

				</div>

			<!-- END .def-panel -->
			</div>
		<?php } ?> 
<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer(); ?>