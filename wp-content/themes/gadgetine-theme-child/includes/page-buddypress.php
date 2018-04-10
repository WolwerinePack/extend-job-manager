<?php wp_reset_query(); ?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<?php get_template_part(THEME_SINGLE."post-header"); ?>
		<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();

					the_content();
				} // end while
			} // end if
		?>
	<?php get_template_part(THEME_SINGLE."post-footer"); ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
