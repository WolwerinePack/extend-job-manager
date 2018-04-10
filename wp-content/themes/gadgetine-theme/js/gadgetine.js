jQuery(document).ready(function() {



	jQuery(".content .photo-gallery-thumbs > div").owlCarousel({
		items : 4,
		autoplay : false,
		nav : false,
		lazyload : false,
		dots : false,
		margin : 4,
		responsive:{
			0:{
				items: 4
			},
			400:{
				items: 6
			},
			700:{
				items: 12
			}
		}
	});

	jQuery(".related-articles").owlCarousel({
		items : 3,
		autoplay : false,
		nav : false,
		lazyload : false,
		dots : false,
		margin : 30,
		responsive:{
			0:{
				items: 1
			},
			400:{
				items: 2
			},
			700:{
				items: 3
			}
		}
	});

	jQuery(".gallery-preview-images > div").owlCarousel({
		items : 4,
		autoplay : false,
		nav : false,
		lazyload : false,
		dots : false,
		margin : 15,
		responsive:{
			0:{
				items: 1
			},
			400:{
				items: 2
			},
			700:{
				items: 4
			}
		}
	});

});
			
function refreshMegamenu() {
	var getThisel = jQuery(".has-ot-mega-menu").find(".widget");
		mega_widget_height = 0;
	getThisel.css("height", "auto");
	for (var i = 0; i <= getThisel.length - 1; i++) {
		if(parseInt(getThisel.eq(i).height())+(parseInt(getThisel.eq(i).css("padding-top"))*2) > mega_widget_height){
			mega_widget_height = parseInt(getThisel.eq(i).height())+(parseInt(getThisel.eq(i).css("padding-top"))*2);
		}
	}
	getThisel.css("height", mega_widget_height+"px");
}


/* -------------------------------------------------------------------------*
 * 								GALLERY	CATEGORY		
 * -------------------------------------------------------------------------*/
	jQuery(function() {

		// cache container
		var jQuerycontainer = jQuery('#gallery-full');
		var galleryCat = ot.galleryCat;
		
		jQuery(window).load(function(){
			jQuerycontainer.isotope({
				resizable: false,
				masonry: { columnWidth: jQuerycontainer.width() / 12 }
			});

		});
		
		if(galleryCat) {
			// initialize isotope
			jQuerycontainer.isotope({ 
				filter: "."+galleryCat 
			});

			var jQueryoptionSet = jQuery('#gallery-categories a');
				jQueryoptionSet.each(function(index) {
					jQuery(this).removeClass('active');
					if(jQuery(this).attr("data-option")=="."+galleryCat) {
						jQuery(this).addClass('active');
					}
				});				
		}


		
		// filter items when filter link is clicked
		jQuery('#gallery-categories a').click(function(){
			var jQuerythis = jQuery(this);
	
			var jQueryoptionSet = jQuerythis.parents('#gallery-categories');
				jQueryoptionSet.find('.active').removeClass('active');
				jQuerythis.addClass('active');
	  
		
		var selector = jQuerythis.attr('data-option');
		jQuerycontainer.isotope({ 
			filter: selector
		});
		  return false;
		});

		jQuery(window).load(function(){
		  	jQuery('#gallery-full').isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
		});		
		 

 /* 					infinitescroll					*/	

 
		jQuerycontainer.infinitescroll({
			navSelector  : '.gallery-navi',    // selector for the paged navigation 
			nextSelector : '.gallery-navi a.next',  // selector for the NEXT link (to page 2)
			itemSelector : '#gallery-full .gallery-image',     // selector for all items you'll retrieve
			animate      : true,
			loading: {
				finishedMsg: 'No more pages to load.',
				img: ot.imageUrl+'loading.gif'
			}
		},
			function(newElements) {

					
					//portfolio image load
					jQuery.each(newElements, function(i) {
						jQuery(".gallery-image").fadeIn('slow');
						jQuery(".waiter-portfolio").removeClass("loading").addClass("loaded");

						jQuery(".drop-icons").each(function() {
					    	var thiselement = jQuery(this);
					    	thiselement.css("cursor", "pointer");
					    	if(thiselement.find(".icon-block:last-child a").hasClass("light-show")) {
					    		thiselement.attr("data-id", thiselement.find(".icon-block:last-child a").attr("data-id"));
					    		thiselement.addClass("light-show");
					    	}

					 	});


					});



				 	jQuerycontainer.isotope('insert', jQuery(newElements));

		

			}
		);
		
	});
	