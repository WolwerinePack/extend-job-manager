<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
	$image = get_post_thumb($post->ID,0,0);
	$video = get_post_meta( $post->ID, "_".THEME_NAME."_video_code", true );
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<!-- BEGIN .main-content-spacy -->
	<div class="main-content-spacy">
		<!-- BEGIN .def-panel -->
		<div class="def-panel">
			<?php if (have_posts()) :  ?>
				<?php get_template_part(THEME_SINGLE."page-title"); ?>
					<div class="panel-content shortocde-content">
						<?php if(ot_option_compare('show_single_thumb','show_single_thumb',$post->ID)==true && ($image['show']==true || $video)) { ?>
							<div class="article-header">
								<?php get_template_part(THEME_SINGLE."image");?>
							</div>
						<?php } ?>
						<?php the_content();?>
					</div>
			<?php else: ?>
				<p><?php  esc_html_e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
			<?php endif; ?>
		</div>
	</div>
	<?php wp_reset_query(); ?>
	<?php if ( comments_open() ) : ?>
		<?php comments_template(); // Get comments.php template ?>
	<?php endif; ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
				