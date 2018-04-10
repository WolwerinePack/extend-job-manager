<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php printf ( esc_html( 'This post is password protected. Enter the password to view comments.' , THEME_NAME ));?></p>
	<?php
		return;
	}

	
	add_action('comment_form_top', 'OT_fields_rules' );
	$orangeThemesCommentID=1;
?>
<?php //You can start editing here. ?>
					<!-- BEGIN .def-panel -->
					<div class="def-panel">
						<div class="panel-title">
							<a href="#respond" class="right"><?php esc_html_e("write a comment",THEME_NAME);?></a>
							<h2><?php comments_number(esc_html('0 Comments', THEME_NAME), esc_html('1 Comment', THEME_NAME), esc_html('% Comments', THEME_NAME)); ?></h2>
						</div>

						<div class="comments">

							<?php if ( have_comments() && comments_open()) : ?>
								<ol class="comments" id="comments">
									<?php wp_list_comments('type=comment&callback=orangethemes_comment'); ?>
								</ol>
								<div class="comments-pager"><?php paginate_comments_links(); ?></div>
								
							 <?php else : // this is displayed if there are no comments so far ?>

								<?php if ( comments_open() ) : ?>
										<div class="comments">
											<div class="no-comments-yet">
												<h3><?php esc_html_e('No Comments Yet!', THEME_NAME);?></h3>
												<span><?php _e('You can be the one to <a href="#respond">start a conversation</a>.', THEME_NAME);?></span>
											</div>
										</div>
								<?php endif; ?>
							<?php endif; ?>
							
						</div>
					</div>

					<?php if ( comments_open() ) : ?>
						<!-- BEGIN .def-panel -->
						<div class="def-panel">
							<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
							<p class="registered-user-restriction"><?php printf ( __( 'Only <a href="%1$s"> registered </a> users can comment.', THEME_NAME ), wp_login_url( get_permalink() ));?> </p>
							<?php else : ?>
								<div class="panel-title">
									<h2><?php esc_html_e( 'Add a Comment' , THEME_NAME );?></h2>
								</div>
								<div class="comment-form">

									<div id="writecomment">


										<a href="#" name="respond"></a>
										<?php 
											$defaults = array(
												'comment_field'       	=> '<p class="contact-form-message"><label for="comment">'.esc_html("Comment:",THEME_NAME).'<span class="required">*</span></label><textarea name="comment" id="comment" placeholder="'.esc_html("Your comment..",THEME_NAME).'"></textarea></p>',
												'comment_notes_before' 	=> '',
												'comment_notes_after'  	=> '',
												'id_form'              	=> '',
												'id_submit'            	=> 'submit',
												'title_reply'          => '',
												'title_reply_to'       => '',
												'cancel_reply_link'    	=> '',
												'label_submit'         	=> ''.esc_html( 'Post a Comment', THEME_NAME ).'',
											);
											comment_form($defaults);			
										?>
									</div>
								</div>
							<?php endif; // if you delete this the sky will fall on your head ?>
						</div>
					<?php endif; ?>