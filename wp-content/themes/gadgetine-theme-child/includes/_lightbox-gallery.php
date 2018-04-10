<?php require_once( '../../../../wp-load.php' );?>
<a href="#" onclick="javascript:lightboxclose();" class="light-close"><i class="fa fa-times"></i><?php esc_html_e("Close Window",THEME_NAME);?></a>

<div class="main-block">
	<!-- BEGIN .single-gallery -->
	<div class="single-photo-gallery ot-slide-item gallery-full-photo">
		<span class="next-image" data-next="0"></span>
		<div class="panel-content gallery-full-photo">
			<div class="photo-gallery-main">
				<a href="javascript:;" class="prev photo-controls"><i class="fa fa-chevron-left"></i></a>
				<a href="javascript:;" class="next photo-controls"><i class="fa fa-chevron-right"></i></a>
				<div>
					<span class="gal-current-image">
						<div class="loading waiter">
							<img class="image-big-gallery ot-gallery-image" data-id="0" style="display:none;" src="#" alt="<?php the_title();?>" />
						</div>
					</span>
				</div>
			</div>
			<div class="photo-gallery-thumbs image-list the-thumbs">
				<div id="ot-lightbox-thumbs"></div>
			</div>
			<div class="photo-gallery-content shortocde-content">
				<div class="content-category">
					<a href="#" style="" id="ot-gal-cat"></a>
				</div>
				<h2 class="ot-light-title"></h2>
				<p id="ot-lightbox-content"></p>
			</div>

	<!-- END .single-gallery -->
	</div>	

</div>
