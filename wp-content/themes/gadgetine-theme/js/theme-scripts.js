
(function ($) {
	"use strict";

	jQuery(window).scroll(function() {

		var fixedSidebars = jQuery(".sidebar-fixed");

		if(fixedSidebars.length){
			fixedSidebars.each(function(){
				var thisel = jQuery(this),
					fixedHeight = parseInt(thisel.height())+parseInt(thisel.offset().top),
					fixedH = parseInt(thisel.height()),
					fixedOffset = parseInt(thisel.offset().top),
					contentHeight = parseInt(thisel.parent().height()+thisel.parent().offset().top),
					scrollOffset = (jQuery("body").hasClass("admin-bar"))?parseInt(jQuery(window).scrollTop())+32:parseInt(jQuery(window).scrollTop());
				
				var dopadding = scrollOffset - fixedOffset;
				thisel.parent().height(thisel.parent().height());

				if(fixedHeight >= contentHeight){
					thisel.removeClass("is-now-fixed").css("paddingTop", "0px");
				}else if(fixedOffset <= scrollOffset){
					if(dopadding+fixedOffset+fixedH >= contentHeight){
						thisel.addClass("is-now-fixed").css("paddingTop", parseInt(contentHeight-fixedHeight)+"px");
					}else{
						thisel.addClass("is-now-fixed").css("paddingTop", parseInt(dopadding)+"px")
					}
				}else{
					thisel.removeClass("is-now-fixed").css("paddingTop", "0px");
				}
			});
		}
	});

	jQuery(window).ready(function() {
		
		jQuery(".close-alert-block").click(function(){
			jQuery(this).parent().animate({
				paddingTop: "0px",
				paddingBottom: "0px",
				marginBottom: "0px",
				height: "0px",
				opacity: "0"
			}, 200);
			return false;
		});

		jQuery(".widget .photo-gallery-list .gallery-navi a").click(function(){
			var thisel = jQuery(this),
				imageel = thisel.parent().siblings(".gallery-change").children("a.active");
			if(thisel.attr("href") == "#gal-left") {
				imageel.parent().find("img").removeClass("bounceInLeft").removeClass("bounceOutRight").removeClass("bounceInRight").removeClass("bounceOutLeft");
				imageel.prev().addClass("active").children("img").addClass("animated bounceInLeft").parent().siblings("a.active").removeClass("active").children("img").addClass("animated bounceOutRight");
			}else
			if(thisel.attr("href") == "#gal-right") {
				imageel.parent().find("img").removeClass("bounceInLeft").removeClass("bounceOutRight").removeClass("bounceInRight").removeClass("bounceOutLeft");
				imageel.next().addClass("active").children("img").addClass("animated bounceInRight").parent().siblings("a.active").removeClass("active").children("img").addClass("animated bounceOutLeft");
			}
			return false;
		});

		jQuery(".short-tabs").each(function(){
			var thisel = jQuery(this);
			thisel.children("ul").children("li").eq(0).addClass("active");
			thisel.children("div").eq(0).addClass("active");
		})

		jQuery(".short-tabs > ul > li a").click(function () {
			var thisel = jQuery(this).parent();
			thisel.siblings(".active").removeClass("active");
			thisel.addClass("active");
			thisel.parent().siblings("div.active").removeClass("active");
			thisel.parent().siblings("div").eq(thisel.index()).addClass("active");
			return false;
		});

		// Accordion blocks
		jQuery(".accordion > div > a").click(function () {
			var thisel = jQuery(this).parent();
			if (thisel.hasClass("active")) {
				thisel.removeClass("active").children("div").animate({
					"height": "toggle",
					"opacity": "toggle",
					"padding-top": "toggle"
				}, 300);
				return false;
			}
			// thisel.siblings("div").removeClass("active");
			thisel.siblings("div").each(function () {
				var tz = jQuery(this);
				if (tz.hasClass("active")) {
					tz.removeClass("active").children("div").animate({
						"height": "toggle",
						"opacity": "toggle",
						"padding-top": "toggle"
					}, 300);
				}
			});
			// thisel.addClass("active");
			thisel.addClass("active").children("div").animate({
				"height": "toggle",
				"opacity": "toggle",
				"padding-top": "toggle"
			}, 300);
			return false;
		});


		jQuery(".photo-gallery-grid .image-overlay-icons").each(function(){
			var thisel = jQuery(this);
			thisel.parent().append("<div class='inner-frame' style='box-shadow: inset 0 0 0 5px "+thisel.data("color")+";'></div>")
			thisel.find("a").css("background", thisel.data("color"));
		});

		jQuery(".lightbox").click(function () {
			var thisel = jQuery(this);
			thisel.css('overflow', 'hidden');
			jQuery("body").css('overflow', 'auto');
			thisel.find(".lightcontent").fadeOut('fast');
			thisel.fadeOut('slow');
		}).children().click(function (e) {
			return false;
		});


		var opversion = '12';
		var is_opera = navigator.userAgent.toLowerCase().indexOf('version/'+opversion) > -1;
		if(is_opera){
			jQuery(".related-articles").css("display", "none");
		}


	});


})(jQuery);

function lightboxclose() {
	jQuery(".lightbox").css('overflow', 'hidden');
	jQuery(".lightbox .lightcontent").fadeOut('fast');
	jQuery(".lightbox").fadeOut('slow');
	jQuery("body").css('overflow', 'auto');
}
