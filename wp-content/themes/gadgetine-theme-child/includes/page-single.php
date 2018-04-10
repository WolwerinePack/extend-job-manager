<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
	$image = get_post_thumb($post->ID,0,0);
	$video = get_post_meta( $post->ID, "_".THEME_NAME."_video_code", true );
	$link = get_permalink();
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
<!-- BEGIN .main-content-spacy -->
<section class="content">               
    <!-- BEGIN .wrapper -->
    <div class="wrapper"> 
        <div class="main-content-wrapper   big-sidebar-right">
        	<div class="main-content">
				<div class="main-content-spacy">
					<!-- BEGIN .def-panel -->
					<div class="def-panel">
						<div class="panel-content shortocde-content">
						</div>
						<div class="pure-g">
			                <div class="pure-u-16-24">
								<?php the_content();?>
							</div>
							<div class="pure-u-1-24"></div>
			                <div class="pure-u-7-24">
								<?php  dynamic_sidebar('sidebar-jobs'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php wp_reset_query(); ?>
<?php if ( comments_open() ) : ?>
	<?php comments_template(); // Get comments.php template ?>
<?php endif; ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer();?>			