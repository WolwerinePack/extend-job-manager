<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();


	$counter = new ot_custom_counter; 
	$counter->reset_count(1);

?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>

	<!-- BEGIN .def-panel -->
	<div class="def-panel">
		<?php get_template_part(THEME_SINGLE."page-title"); ?>
			
		<div class="panel-content main-article-list">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php get_template_part(THEME_LOOP."post"); ?>
				<?php 
					$counter = new ot_custom_counter; 
					$counter->plus_one(); 
				?>
			<?php endwhile; else: ?>
				<?php get_template_part(THEME_LOOP."no-post"); ?>
			<?php endif; ?>
		</div>
	</div>
	<?php customized_nav_btns($paged, $wp_query->max_num_pages); ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
