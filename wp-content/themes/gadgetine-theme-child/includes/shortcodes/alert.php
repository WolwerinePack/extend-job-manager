<?php
add_shortcode('alert', 'alert_handler');

function alert_handler($atts, $content=null, $code="") {
	extract(shortcode_atts(array('color' => null, 'icon' => null, 'title' => null), $atts) );
	
	if(isset($icon) && $icon!="Select a Icon" ) {
		$icon = '<i class="fa '.$icon.'"></i>';
	} else {
		$icon = false;
	}
		

	return '<div class="alert-block" style="background: #'.$color.';">
				<a href="#" class="close-alert-block"><i class="fa fa-times"></i></a>
				<h3>'.$title.'</h3>
				<span class="alert-text">
					'.do_shortcode($content).'
				</span>
			</div>';		


}

?>