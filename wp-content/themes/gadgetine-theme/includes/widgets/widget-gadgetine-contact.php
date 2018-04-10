<?php
add_action('widgets_init', create_function('', 'return register_widget("OT_contact");'));

class OT_contact extends WP_Widget {
	function OT_contact() {
		 parent::__construct(false, $name = THEME_FULL_NAME.' Contact',array( 'description' => __( "Contact Information", THEME_NAME )));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => '',
			'text' => '',
			'address' => '',
			'phone' => '',
			'email' => '',


		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = esc_attr($instance['title']);
		$text = esc_attr($instance['text']);
		$address = esc_attr($instance['address']);
		$phone = esc_attr($instance['phone']);
		$email = esc_attr($instance['email']);

        ?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Title:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        	<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php  printf ( __( 'Text:' , THEME_NAME )); ?> <textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea></label></p>

         	<p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php printf ( __( 'Phone:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" /></label></p>
        	<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php printf ( __( 'Email:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></label></p>

        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = ($new_instance['text']);
		$instance['address'] = ($new_instance['address']);
		$instance['phone'] = ($new_instance['phone']);
		$instance['email'] = ($new_instance['email']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$text = $instance['text'];
		$address = $instance['address'];
		$phone = $instance['phone'];
		$email = $instance['email'];



		
?>		
	<?php echo $before_widget; ?>
	<?php if($title) echo $before_title.$title.$after_title; ?>
		<div class="contact-widget">
			<?php if($phone) { ?>
				<div class="large-icon">
					<i class="fa fa-phone"></i>
					<span><?php echo stripslashes($phone);?></span>
				</div>
			<?php } ?>
			<?php if($email) { ?>
				<div class="large-icon">
					<i class="fa fa-envelope"></i>
					<span>
						<a href="mailto:<?php echo stripslashes($email);?>" target="_blank"><?php echo stripslashes($email);?></a>
					</span>
				</div>
			<?php } ?>
			<?php 
				if($text) {
	            	echo wpautop(stripslashes($text));
	           	} 
   			?>	
		</div>
	<?php echo $after_widget; ?>
    <?php
	}
}
?>