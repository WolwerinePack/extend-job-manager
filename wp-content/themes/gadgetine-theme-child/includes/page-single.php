<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
	$image = get_post_thumb($post->ID,0,0);
	$video = get_post_meta( $post->ID, "_".THEME_NAME."_video_code", true );
	$link = get_permalink();
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
<section class="content">   
    <div class="wrapper"> 
        <div class="main-content-wrapper   big-sidebar-right">
        	<div class="main-content">
				<div class="main-content-spacy">
					<div class="def-panel">
						<div class="panel-content shortocde-content">
							<div class="article-content">
								<?php the_content();?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<aside id="sidebar">
				<?php  dynamic_sidebar('sidebar-jobs'); ?>
			</aside>
		</div>
	</div>
</section>
<?php wp_reset_query(); ?>
<?php if ( comments_open() ) : ?>
	<?php comments_template(); // Get comments.php template ?>
<?php endif; ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer();?>			