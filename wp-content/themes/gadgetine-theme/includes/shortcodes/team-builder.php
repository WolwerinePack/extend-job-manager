<?php
	add_shortcode('team', 'team_handler');
	add_shortcode('team-2', 'team_2_handler');
	
	function team_handler($atts, $content=null, $code="") {
	
		/* title */
		if(isset($atts["title"])) {
			$title = $atts["title"];
		} else {
			$title = false;
		}
			
		/* subtitle */
		if(isset($atts["subtitle"])) {
			$subtitle = $atts["subtitle"];
		} else {
			$subtitle = false;
		}
		
		/* url */
		if(isset($atts["url"])) {
			$url = $atts["url"];
		} else {
			$url = false;
		}		

		/* image */
		if(isset($atts["image"])) {
			$image = $atts["image"];
		} else {
			$image = false;
		}

		
		$image = get_post_thumb(false, 60, 60, false, $image);

			$return =  '<div class="team-member single">';
				$return.=  '<div class="member">';
				if($image["show"]==true) {
					$return.=  '<div class="member-photo"><img src="'.$image["src"].'" class="setborder" alt="'.$title.'" /></div>';
				}
						$return.=  '<div class="member-info">';
						if($title)	$return.=  '<b>'.$title.'</b>';
						if($subtitle)	$return.=  '<span>'.$subtitle.'</span>';
						$return.=  '<p>'.$content.'</p>';
						if($url)	$return.=  '<a href="'.$url.'" class="link-icon"><i class="fa fa-reply"></i>'.esc_html("View all articles", THEME_NAME).'</a>';
						$return.=  '<div class="clear-float"></div>';
					$return.=  '</div>';
				$return.=  '</div>';
			$return.=  '</div>';


		return $return;
	}	
	function team_2_handler($atts, $content=null, $code="") {
	
		/* title */
		if(isset($atts["title"])) {
			$title = $atts["title"];
		} else {
			$title = false;
		}
			
		/* subtitle */
		if(isset($atts["subtitle"])) {
			$subtitle = $atts["subtitle"];
		} else {
			$subtitle = false;
		}
		
		/* url */
		if(isset($atts["url"])) {
			$url = $atts["url"];
		} else {
			$url = false;
		}		

		/* image */
		if(isset($atts["image"])) {
			$image = $atts["image"];
		} else {
			$image = false;
		}
		/* text */
		if(isset($atts["text"])) {
			$text = $atts["text"];
		} else {
			$text = false;
		}

		/* title */
		if(isset($atts["title2"])) {
			$title2 = $atts["title2"];
		} else {
			$title2 = false;
		}
			
		/* subtitle */
		if(isset($atts["subtitle2"])) {
			$subtitle2 = $atts["subtitle2"];
		} else {
			$subtitle2 = false;
		}
		
		/* url */
		if(isset($atts["url2"])) {
			$url2 = $atts["url2"];
		} else {
			$url2 = false;
		}		

		/* image */
		if(isset($atts["image2"])) {
			$image2 = $atts["image2"];
		} else {
			$image2 = false;
		}
		/* text */
		if(isset($atts["text2"])) {
			$text2 = $atts["text2"];
		} else {
			$text2 = false;
		}
		
		$image = get_post_thumb(false, 60, 60, false, $image);
		$image2 = get_post_thumb(false, 60, 60, false, $image2);

			$return =  '<div class="team-member">';
				$return.=  '<div class="member">';
				if($image["show"]==true) {
					$return.=  '<div class="member-photo"><img src="'.$image["src"].'" class="setborder" alt="'.$title.'" /></div>';
				}
					$return.=  '<div class="member-info">';
						if($title)	$return.=  '<b>'.$title.'</b>';
						if($subtitle)	$return.=  '<span>'.$subtitle.'</span>';
						$return.=  '<p>'.$atts["text"].'</p>';
						if($url)	$return.=  '<a href="'.$url.'" class="link-icon"><i class="fa fa-reply"></i>'.esc_html("View all articles", THEME_NAME).'</a>';
						$return.=  '<div class="clear-float"></div>';
					$return.=  '</div>';	

				$return.=  '</div>';
				$return.=  '<div class="member">';
					if($image2["show"]==true) {
						$return.=  '<div class="member-photo"><img src="'.$image2["src"].'" class="setborder" alt="'.$title2.'" /></div>';
					}				
						$return.=  '<div class="member-info">';
							if($title2)	$return.=  '<b>'.$title2.'</b>';
							if($subtitle2)	$return.=  '<span>'.$subtitle2.'</span>';
							$return.=  '<p>'.$atts["text2"].'</p>';
							if($url2)	$return.=  '<a href="'.$url2.'" class="link-icon"><i class="fa fa-reply"></i>'.esc_html("View all articles", THEME_NAME).'</a>';
							$return.=  '<div class="clear-float"></div>';
						$return.=  '</div>';
					$return.=  '</div>';
				$return.=  '</div>';


		return $return;
	}
	
?>