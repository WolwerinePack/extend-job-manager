<?php
add_shortcode('ot-gallery', 'gallery_handler');
function gallery_handler($atts, $content=null, $code="") {
	if(isset($atts['url'])) {
		if(substr($atts['url'],-1) == '/') {
			$atts['url'] = substr($atts['url'],0,-1);
		}
		$vars = explode('/',$atts['url']);
		$slug = $vars[count($vars)-1];
		$page = get_page_by_path($slug,'OBJECT',OT_POST_GALLERY);
		if(is_object($page)) {
			$id = $page->ID;
			if(is_numeric($id)) {
				$gallery_style = get_post_meta ( $id, "_".THEME_NAME."_gallery_style", true );
				$galleryImages = get_post_meta ( $id, THEME_NAME."_gallery_images", true ); 
				$imageIDs = explode(",",$galleryImages);
				$count = count($imageIDs);
				if($gallery_style=="lightbox") { $classL = 'light-show '; } else { $classL = false; }

				$content.=	'<div class="gallery-preview">';
					$content.=	'<div class="gallery-preview-images">';
						$content.=	'<div>';
							$counter = 1;
		            		foreach($imageIDs as $imgID) { 
		            			if ($counter==7) break;
		            			if($imgID) {
			            			$file = wp_get_attachment_url($imgID);
			            			$image = get_post_thumb(false, 194, 150, false, $file);
									if($counter==1) { $class=' class="active"'; } else { $class=false; }				
									$content.=	'<a href="'.$atts['url'].'?page='.$counter.'" class="'.$classL.'" data-id="gallery-'.$id.'"><img src="'.$image['src'].'" alt="'.esc_attr($page->post_title).'"  data-id="'.$counter.'"/></a>';
									$counter++;
								}
							} 
						$content.=	'</div>';
					$content.=	'</div>';
					$content.=	'<div class="gallery-preview-content">';
						$content.=	'<h3><a href="'.$atts['url'].'" class="'.$classL.'" data-id="gallery-'.$id.'">'.$page->post_title.'</a></h3>';
						if($page->post_excerpt) { 
								$content.=	'<p>'.$page->post_excerpt.'</p>'; 
							} else {
								$content.=	'<p>'.WordLimiter($page->post_content, 30).'</p>'; 
							}
						$content.=	'<div class="gallery-preview-meta">';
							$content.=	'<span class="right"><i class="fa fa-camera"></i> '.OT_image_count($id).' '.esc_html('photos', THEME_NAME).'</span>';
							$content.=	'<a href="'.$atts['url'].'" class="'.$classL.'read-more-link" data-id="gallery-'.$id.'">'.esc_html('View More', THEME_NAME).'<i class="fa fa-chevron-right"></i></a>';
						$content.=	'</div>';
					$content.=	'</div>';
				$content.=	'</div>';
			} else {
				$content.= "Incorrect URL attribute defined";
			}
		} else {
			$content.= "Incorrect URL attribute defined";
		}
		
	} else {
		$content.= "No url attribute defined!";
	
	}
	return $content;
}


?>