<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


	if(ot_option_compare('similar_posts','similar_posts',$post->ID)==true) {
	
		wp_reset_query();
		$categories = get_the_category($post->ID);
		
		if ($categories) {
			$category_ids = array();
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

			$args=array(
				'category__in' => $category_ids,
				'post__not_in' => array($post->ID),
				'showposts'=>3,
				'ignore_sticky_posts'=>1,
				'orderby' => 'rand'
			);

			$my_query = new wp_query($args);
			$postCount = $my_query->post_count;
			$counter = 1;
?>
	<!-- BEGIN .def-panel -->
	<div class="def-panel">
		<div class="panel-title">
			<a href="<?php echo get_the_permalink(get_option('page_for_posts'));?>?cat=<?php echo implode(",", $category_ids);?>" class="right">
				<?php esc_html_e("view more articles", THEME_NAME);?>
			</a>
			<h2><?php esc_html_e("Related Articles", THEME_NAME);?></h2>
		</div>
		<div class="related-articles">
		<?php
			wp_reset_query();
				if( $my_query->have_posts() ) {
					while ($my_query->have_posts()) {
						$my_query->the_post();
			?>

			<div class="item">
				<div class="item-header">
					<div class="image-overlay-icons" onclick="javascript:location.href = '<?php the_permalink();?>';">
						<a href="<?php the_permalink();?>" title="<?php the_title();?>">
							<i class="fa fa-search"></i>
						</a>
					</div>
					<a href="<?php the_permalink();?>" class="hover-image">
						<?php echo ot_image_html($my_query->post->ID,367,269);?>
					</a>
				</div>
				<div class="item-content">
					<h4>
						<a href="<?php the_permalink();?>">
						
                        <?php 
		
								/* get values from post meta*/
								$value = get_post_meta( $post->ID, '_wpptwi_icon', true );
								$icon_color = get_post_meta( $post->ID, '_wpptwi_icon_color', true );
								$icon_size = get_post_meta( $post->ID, '_wpptwi_icon_size', true );
						
								/* escapes html entities*/
								$icon = esc_attr( $value );
								$icon_color = esc_attr( $icon_color );
								$icon_size = esc_attr( $icon_size );
								
						
								/* checks if the icon is empty, title is in the loop*/	
								echo '<i class="fa '.$icon.'" style="color:'.$icon_color.'; font-size:15px; float:left; margin-right:5px;"></i>'.get_the_title ();
									
								?>
                        
                        
                        </a>
							<?php if ( comments_open() && ot_option_compare('post_comments_single','post_comments_single',$my_query->post->ID)==true) { ?>
							<a href="<?php the_permalink();?>#comments" class="comment-link">
								<i class="fa fa-comment-o"></i>
								<span><?php comments_number('0','1','%'); ?></span>
							</a>
						<?php } ?>
					</h4>
				</div>
			</div>
			<?php
				 }
			} else { esc_html_e('Sorry, no posts were found.' , THEME_NAME ); }
				?>
		<?php } ?>
		</div>
	<!-- END .def-panel -->
	</div>

<?php } ?>


<?php wp_reset_query();  ?>
