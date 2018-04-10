<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
	//post title
	$titleShow = get_post_meta ( $post->ID, "_".THEME_NAME."_show_single_title", true ); 

?>					



<?php if($titleShow!="hide"){ ?>
        
        <?php 
		
		/* get values from post meta*/
		$value = get_post_meta( $post->ID, '_wpptwi_icon', true );
		$icon_color = get_post_meta( $post->ID, '_wpptwi_icon_color', true );
		$icon_size = get_post_meta( $post->ID, '_wpptwi_icon_size', true );

		/* escapes html entities*/
		$icon = esc_attr( $value );
		$icon_color = esc_attr( $icon_color );
		$icon_size = esc_attr( $icon_size );
		

		/* checks if the icon is empty, title is in the loop*/	
		echo '<i class="fa '.$icon.'" style="color:'.$icon_color.'; font-size:'.$icon_size.'px; float:left; margin-right:10px; "></i> <h1> '.get_the_title ().'</h1>';
			
		?> 

<?php } ?> 