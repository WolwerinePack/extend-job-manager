<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();
	wp_reset_query();

	if (is_pagetemplate_active("template-contact.php")) {
		$contactPages = ot_get_page("contact");
		if($contactPages[0]) {
			$contactUrl = get_page_link($contactPages[0]);
		}
	} else {
		$contactUrl = false;
	}
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?>	
	<!-- BEGIN .def-panel -->
	<div class="def-panel">
		<div class="panel-content">

			<div class="big-message">
				<h2><?php esc_html_e("404",THEME_NAME);?></h2>
				<div>
					<h3><?php esc_html_e("Page Not Found",THEME_NAME);?></h3>
				</div>
				<p><?php _e("You must be lost or we just have lost this<br>page You were looking for. Sorry about that.",THEME_NAME);?></p>
				<div class="msg-menu">
					<a href="<?php echo home_url();?>"><?php esc_html_e("Homepage",THEME_NAME);?></a>
					<?php if($contactUrl) { ?>
						<a href="<?php echo $contactUrl;?>"><?php esc_html_e("Contact Us",THEME_NAME);?></a>
					<?php } ?>
				</div>
			</div>

		</div>
		
	<!-- END .def-panel -->
	</div>
<?php get_template_part(THEME_LOOP."loop-end"); ?>

<?php get_footer(); ?>