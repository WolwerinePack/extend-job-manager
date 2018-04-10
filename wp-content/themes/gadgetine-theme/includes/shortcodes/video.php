<?php
	add_shortcode('ot-video', 'ot_video_handler');
	
	
	function ot_video_handler($atts, $content=null, $code="") {
		if(isset($content)) {
				$return =  '		
					<div class="video-embed">
						'.$content.'
					</div>';
		} else {
			$return = "No url attribute defined!";
		
		}
			
		return $return;
	}
	
?>
