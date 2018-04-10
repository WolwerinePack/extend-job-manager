<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Template Name: Contact Page
*/	
?>
<?php get_header(); ?>
<?php 
	wp_reset_query();
	$mail_to = get_post_meta ( $post->ID, "_".THEME_NAME."_contact_mail", true ); 
	$map = get_post_meta ( $post->ID,  "_".THEME_NAME."_map", true ); 

?>

<?php get_template_part(THEME_LOOP."loop-start"); ?>
	<?php if($mail_to) { ?>
		<?php if (have_posts()) : ?>
			<!-- BEGIN .def-panel -->
			<div class="def-panel">
				<?php get_template_part(THEME_SINGLE."page-title"); ?>
				<div class="panel-content contact-us-page">
					<div class="map-page">
						<?php 
							if($map) {
							 	echo $map;
							} 
						?> 
					</div>
					<div class="contact-info-page">
						<div class="shortocde-content">
							<?php 
								remove_filter('the_content', 'BigFirstChar');	
								the_content(); 
							?>
						</div>

						<div class="comment-form">
							<div class="alert-block contact-success-block" style="display:none; background: #75b226;">
								<a href="#" class="close-alert-block"><i class="fa fa-times"></i></a>
								<strong><?php esc_html_e("Great Success:",THEME_NAME);?></strong><span><?php esc_html_e("Your meesage went through!",THEME_NAME);?></span>
							</div>

							<form id="writecomment" name="writecomment" class="contact-form" action="">


								<input type="hidden"  name="form_type" value="contact" />
								<input type="hidden"  name="post_id" value="<?php echo $post->ID;?>" />

								<p class="contact-form-user">
									<label for="c_name"><?php esc_html_e("Nickname", THEME_NAME);?><span class="required">*</span></label>
									<input type="text" name="u_name" id="contact-name-input" placeholder="<?php esc_html_e("Nickname", THEME_NAME);?>" title="<?php esc_html_e("Nickname", THEME_NAME);?>" />
									<span class="error-msg comment-error" id="contact-name-error" style="display:none;"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<font class="ot-error-text"></font></span>
								</p>
								<p class="contact-form-email">
									<label for="c_name"><?php esc_html_e("E-mail", THEME_NAME);?><span class="required">*</span></label>
									<input type="text" name="email" id="contact-mail-input" placeholder="<?php esc_html_e("E-mail", THEME_NAME);?>" title="<?php esc_html_e("E-mail", THEME_NAME);?>" />
									<span class="error-msg comment-error" id="contact-mail-error" style="display:none;"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<font class="ot-error-text"></font></span>
								</p>
								<p class="contact-form-website">
									<label for="c_website"><?php esc_html_e("Website", THEME_NAME);?></label>
									<input type="text" placeholder="<?php esc_html_e("Website", THEME_NAME);?>" name="url" id="contact-url-input" title="<?php esc_html_e("Website", THEME_NAME);?>" />
								</p>
								<p class="contact-form-message">
									<label for="c_name"><?php esc_html_e("Your message", THEME_NAME);?><span class="required">*</span></label>
									<textarea name="message" placeholder="<?php esc_html_e("Your message", THEME_NAME);?>" id="contact-message-input"></textarea>
									<span class="error-msg comment-error" id="contact-message-error" style="display:none;"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<font class="ot-error-text"></font></span>
								</p>
								<p>
									<input name="submit" type="submit" class="submit-button button" id="contact-submit" value="<?php printf ( esc_html( 'Send Message' , THEME_NAME ));?>" />
								</p>
							</form>
						</div>
					</div>
				</div>
			<?php else: ?>
				<p><?php printf ( esc_html('Sorry, no posts matched your criteria.' , THEME_NAME )); ?></p>
			<?php endif; ?>
			</div>
	<?php } else { echo "<span style=\"color:#000; font-size:14pt;\">You need to set up Your contact mail!</span>"; } ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?>
<?php get_footer(); ?>
