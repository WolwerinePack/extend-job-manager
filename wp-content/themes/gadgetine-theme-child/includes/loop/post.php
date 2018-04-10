<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$image = get_post_thumb($post->ID,0,0);

	//counter
	$counter = new ot_custom_counter;
	$counter = $counter->count(); 

	$class = "item";
	if($image['show']==false) {
		$class .= " no-image";
	}
?>
		<!-- BEGIN .item -->
		<div  <?php post_class($class); ?> id="post-<?php the_ID(); ?>" >
			<?php get_template_part(THEME_LOOP."image"); ?>
			<div class="item-content">
				<h3> 
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
								echo '<i class="fa '.$icon.'" style="color:'.$icon_color.'; font-size:20px; float:left; margin-right:5px;"></i>'.get_the_title ();
									
								?> 
                    
                     </a>
					<?php if ( comments_open() && ot_option_compare("post_comments_single","post_comments_single", $post->ID)==true) { ?>
						<a href="<?php the_permalink();?>#comments" class="comment-link">
							<i class="fa fa-comment-o"></i>
							<span><?php comments_number("0","1","%"); ?></span>
						</a>
					<?php } ?>
				</h3>
				<?php 
					add_filter('excerpt_length', 'new_excerpt_length_30');
					echo excerpt(25);
					remove_filter('excerpt_length', 'new_excerpt_length_30');
				?>				
				<a href="<?php the_permalink();?>" class="read-more-link"><?php esc_html_e("Read More",THEME_NAME);?><i class="fa fa-chevron-right"></i></a>
			</div>
		<!-- END .item -->
		</div>