<?php
	wp_reset_query();
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<!-- BEGIN .main-content-spacy -->
	<div class="main-content-spacy">
		<!-- BEGIN .def-panel -->
		<div class="def-panel">
		    <?php if (have_posts()) : ?>
		        <?php woocommerce_content(); ?>
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