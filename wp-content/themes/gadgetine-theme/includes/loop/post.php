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
		<div <?php post_class($class); ?> id="post-<?php the_ID(); ?>" >
			<?php get_template_part(THEME_LOOP."image"); ?>
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
					add_filter('excerpt_length', 'new_excerpt_length_30');
					the_excerpt();
					remove_filter('excerpt_length', 'new_excerpt_length_30');
				?>				
				<a href="<?php the_permalink();?>" class="read-more-link"><?php esc_html_e("Read More",THEME_NAME);?><i class="fa fa-chevron-right"></i></a>
			</div>
		<!-- END .item -->
		</div>