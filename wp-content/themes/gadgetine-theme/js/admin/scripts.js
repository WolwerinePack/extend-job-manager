
function makeid() {
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for( var i=0; i < 5; i++ )
		text += possible.charAt(Math.floor(Math.random() * possible.length));

	return text;
}

function ot_on_management_load() {
	jQuery('.tag_name_select').change(function() {
			var str="";
			$(".tag_name_select option:selected").each(function () {
				str += $(this).text();
			});
			
			if (str=="Custom") {
				$('.tag_name_input').css({ 'display': 'block'});
				$('.tag_name_select').attr('name','ot');
				$('.tag_name_input').attr('name',$('.tag_name_input').attr('id'));
			} else {
				$('.tag_name_input').css({ 'display': 'none'});
				$('.tag_name_select').attr('name',$('.tag_name_select').attr('id'));
			}

	});

	// tab switcher
	jQuery( "#tabs" ).tabs({
	    activate: function (e, ui) { 
	        jQuery.cookie('selected-tab', ui.newTab.index(), { path: '/', expires: 1 }); 
	    }, 
	    active: jQuery.cookie('selected-tab') 
	});

	jQuery( ".sub_tabs" ).tabs({
	    activate: function (e, ui) { 
	        jQuery.cookie('selected-sub-tab', ui.newTab.index(), { path: '/', expires: 1 }); 
	    }, 
	    active: jQuery.cookie('selected-sub-tab') 
	});

	jQuery( ".meta_sub_tabs" ).tabs({
	    activate: function (e, ui) { 
	        jQuery.cookie('selected-meta-sub-tab', ui.newTab.index(), { path: '/', expires: 1 }); 
	    }, 
	    active: jQuery.cookie('selected-meta-sub-tab') 
	});


	//edit sidebar
	jQuery(".edit-sidebar").click(function() {
		var id = $(this).attr("id").substring(5);
		var $title = $("#text-"+id).attr("alt");
				
		jQuery("#name-"+id).remove(":contains(\'Sidebar Name:\')");
		jQuery("#edit-"+id).attr("style","display:none;");
		jQuery("#save-"+id).attr("style","display:inline;");

		jQuery("#text-"+id).append("<p id=\"name-"+id+"\"><b>Sidebar Name:</b></p><span class=\"input-text-1\"><input id=\"input-"+id+"\" name=\"sidebar-name\" value=\""+$title+"\" /></span>");

					
		jQuery("#input-"+id).keydown(function (e){
			if(e.keyCode == 13){
				
				var $title = $("#input-"+id).val();
				var $old_name = $("#text-"+id).attr("alt");
							
				save_sidebar(id,$title,$old_name);
							
			}
		})
					
	});

	//save sidebar 
	jQuery(".save-sidebar").click(function() {
		var id = $(this).attr("id").substring(5);
		var $title = $("#input-"+id).val();
		var $old_name = $("#text-"+id).attr("alt");
					
		save_sidebar(id,$title,$old_name);
	});

 /* -------------------------------------------------------------------------*
 * 								HOMEPAGE DRAG&DROP							*
 * -------------------------------------------------------------------------*/
	var adminUrl = scripts.adminUrl;
	var uploadHandler = scripts.uploadHandler;
	var themeUploadUrl = scripts.themeUploadUrl;
	var blockCount = jQuery("#active-homepage-blocks").data('fields')+1;


	jQuery(function() {

		if (typeof tinymce !== 'undefined') {
			//add tinyMCE to each textarea with custom settings
			tinymce.init(OTtinymceSettings);
		}

		var postId = jQuery("#post_ID").val();

		function block_drag() {
		    jQuery( ".pagebuilder-block-container" ).sortable({
		    	connectWith: ".pagebuilder-block-container",
		    	revert: true,
		    	cursorAt: { left: 140 },
		    	start:function(event , ui){
		    		ui.helper.width('281');
		    		if(jQuery(ui.item).hasClass("dropped")) {
			    		jQuery(ui.item).find('textarea.page-builder-input').each(function () {
			    			tinyMCE.execCommand("mceRemoveEditor", false, jQuery(ui.item).find('textarea.ot-tinymce').attr('id'));

			    		});
		    		}
		    	},
		    	stop:function(event , ui){
		    		ui.item.width('auto');
		    		if(!jQuery(ui.item).hasClass("dropped")) { //check if it's first drop 
					    jQuery(ui.item).addClass("dropped active-block").removeClass("inactive-block");
						jQuery(ui.item).find('textarea.page-builder-input, input.page-builder-input, select.page-builder-input').each(function () {
							//add new id
							var newID = jQuery(this).attr('id')+"_"+blockCount;
							if(jQuery(this).is('textarea.ot-tinymce')) {
								jQuery(this).attr('id', newID);
								jQuery(this).attr('name', newID);
								tinyMCE.execCommand("mceAddEditor", true, newID);
							} else {
								jQuery(this).attr('id', newID);	
								jQuery(this).attr('name', newID);	
							}

							blockCount++;
						});

						if(ui.item.find(".scroller")) {
							thisElement = ui.item.find(".scroller-wrap");
							thisElement.find("div.slider-slider").children('div.ui-widget-header').remove();
							jQuery(thisElement).children("div").slider({
								range: "min",
								value: jQuery(thisElement).children("input").data("value"),
								min: jQuery(thisElement).children("input").data("min"),
								max: jQuery(thisElement).children("input").data("max"),
								slide: function( event, ui ) {
									jQuery(this).prev("input").val(ui.value);
								}

							});
						}
						addLoadEvent(jscolor.init);

		    		} else {
		    			jQuery(ui.item).find('textarea.page-builder-input').each(function () {
		    				tinyMCE.execCommand("mceAddEditor", true, jQuery(ui.item).find('textarea.ot-tinymce').attr('id'));
		    			});
		    		}

					jQuery(this).sortable("refresh");


				    
				}
		    });

			//dragable blocks js
			jQuery("#available-homepage-blocks li.component").draggable({
				connectToSortable: ".pagebuilder-block-container",
				accept: ".component",
				helper: "clone",
				revert: "invalid"
			});
		}

		block_drag();

		//popup window for column layouts
		jQuery( document ).on( "click", "#available-homepage-columns>li.column", function() {
			//clone column from popup to active block window
			jQuery(this).clone().appendTo("#active-homepage-blocks").toggleClass("inactive-column active-column");
			jQuery('#pagebuilder-block-popup .note').fadeIn('slow').delay(1500).fadeOut('slow');

			block_drag();
		});

		//sortable columns
	    jQuery("ul#active-homepage-blocks").sortable({
	    	start:function(event , ui){
	    		jQuery(ui.item).find('textarea.page-builder-input').each(function () {
	    			tinyMCE.execCommand("mceRemoveEditor", false, jQuery(ui.item).find('textarea.ot-tinymce').attr('id'));

	    		});
	    	},
	    	stop:function(event , ui){
    			jQuery(ui.item).find('textarea.page-builder-input').each(function () {
    				tinyMCE.execCommand("mceAddEditor", true, jQuery(ui.item).find('textarea.ot-tinymce').attr('id'));
    			});
				jQuery(this).sortable("refresh");
			    
			}

	    });


		//trash
	    jQuery('#pagebuilder-block-remover').droppable({
	    	accept: ".active-block, .active-column",
	    	tolerance: "touch",
	        over: function(event, ui) {
	        	jQuery('#pagebuilder-block-remover').addClass('delete-area-active');
	            jQuery(ui.draggable).addClass('gona-to-delete-this');
	        },  
	        out: function(event, ui) {
	        	jQuery('#pagebuilder-block-remover').removeClass('delete-area-active');
	        	jQuery(ui.draggable).removeClass('gona-to-delete-this');
	        },        
	        drop: function(event, ui) {
	            jQuery(ui.draggable).remove();
	            jQuery('#pagebuilder-block-remover').removeClass('delete-area-active');
	        }
	    });

		// read all active blocks and send to php
		jQuery( document ).on( "click", "#ot-submit-home", function() {

			var button = jQuery(this);
			button.val(button.data('loading'));
          	var blocks = {};
          	blocks.columnRows = [];

          	var i = 0;
          	var ii = 0;
          	var iii = 0;
          	var iiii = 0;
          	var fieldCount = blockCount;
          	//rows
			jQuery("#active-homepage-blocks>li").each(function () {
				blocks.columnRows.push({});
				blocks.columnRows[i]['row'] = jQuery(this).data('id');
				//row columns
				ii = 0;
				blocks.columnRows[i].columns = [];
				jQuery(this).find(".paragraph-row>div.column-content").each(function () {
					blocks.columnRows[i].columns.push({});
					//column number
					blocks.columnRows[i].columns[ii].columnID = jQuery(this).data('type');
					//column blocks
					iii = 0;
					blocks.columnRows[i].columns[ii].contentBlocks = [];
					jQuery(this).find("ul.pagebuilder-block-container>li").each(function () {
						blocks.columnRows[i].columns[ii].contentBlocks.push({});
						blocks.columnRows[i].columns[ii].contentBlocks[iii].blocksContentName = jQuery(this).attr("rel");
						//column blocks content
						blocks.columnRows[i].columns[ii].contentBlocks[iii].blocksContent = [];
						jQuery(this).find('textarea.page-builder-input, input.page-builder-input, select.page-builder-input').each(function () {
							blocks.columnRows[i].columns[ii].contentBlocks[iii].blocksContent.push( jQuery(this).attr('id') );
							fieldCount++;
						});
						iii++;
					});	
					ii++;
				});
				i++;
			});
			

			//add field count
			blocks.fieldCount = fieldCount;


			// save TinyMCE instances before serialize
    		tinyMCE.triggerSave();

			var values = jQuery("ul#active-homepage-blocks *").serializeArray();

			layout = JSON.stringify(blocks);
			values = JSON.stringify(values);

			jQuery.ajax({
				url:adminUrl,
				type:"POST",
				data:"action=update_homepage&post_id="+postId+"&layout=" + layout+"&values=" + encodeURIComponent(values),
				success:function(results) {
					button.val(button.data('saved'));
					//console.log(results);
				}
			});

			return false;
      
        });


		//column layout popup js
	    jQuery( "#pagebuilder-block-popup" ).dialog({
	    	dialogClass: "orange-themes",
	    	width: "1000px",
	      	autoOpen: false,
	      	show: {
	       		effect: "blind",
	        	duration: 500
	      	},
	      	hide: {
	        	effect: "explode",
	        	duration: 500
	      	}
	    });
	 
	 	jQuery( document ).on( "click", "#pagebuilder-block-popup-open", function() {
	      	jQuery( "#pagebuilder-block-popup" ).dialog( "open" );
	    });


		//block layout popup js
	 	jQuery(document).on( "click", "#active-homepage-blocks .edit", function() {
	      	jQuery(this).parent().find('.block-content-settings').show();
	      	jQuery(".block-content-settings").draggable();
	    });

		//block layout close popup js
	 	jQuery( document ).on( "click", ".block-content-settings .close-seetings-box", function() {
	      	jQuery(this).parent().parent().hide();
	    });

	

	});




		
	//unique block drag js	
	jQuery("#active-homepage-blocks li").each(function () {
		if(jQuery(this).find("#unique-block").length != 0) {
			var blockId = jQuery(this).attr("rel");
			jQuery("#available-homepage-blocks li").each(function () {
				if( jQuery(this).attr("rel") == blockId) {
					jQuery(this).css("display", "none");
				}
			});
		
		}
	});
	


	var themeName = scripts.themeName;
	jQuery(function() {
		jQuery("ul#sidebar_order").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=update_sidebar';
			jQuery.post(adminUrl, order, function(theResponse){
				//$("#contentRight").html(theResponse);
				var text = theResponse.slice(0,-1);
				jQuery("#"+themeName+"_sidebar_names").val(text);
			});
		}
		});
	});

	jQuery(".sidebar-delete").click(function() {
				
		var id = jQuery(this).attr("id");
		id = id.replace('delete-', '');
		jQuery.ajax({
			url:adminUrl,
			type:"POST",
			data:"action=delete_sidebar&sidebar_name=" + id,
			success:function(results) {
				//alert(results);
				//$("#contentRight").html(results);
				var text = results.slice(0,-1);
				jQuery("#"+themeName+"_sidebar_names").val(text);
				jQuery("#recordsArray_"+id).remove();
			}
		});
	});

	
/* -------------------------------------------------------------------------*
 * 									SLIDE ORDER								*
 * -------------------------------------------------------------------------*/
	jQuery(function() {
		jQuery("ul.slider-sequence").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=update_slider';
			jQuery.post(adminUrl, order, function(theResponse){
				//alert(theResponse);
			});
		}
		});
	});


    var height = jQuery('.popup-help');
    jQuery('.popup-help').css({ marginTop: height.height() / -2 - 2 });


	jQuery('.help').click(function() {
	    jQuery('.popup-help').addClass('popup-help-hidden');
	    jQuery(this).next(".popup-help").removeClass('popup-help-hidden');
	 });
	  
	    
	jQuery('.close').click(function() {
	    jQuery('.popup-help').addClass('popup-help-hidden');
	}); 


/* -------------------------------------------------------------------------*
 * 							SAVE/EDIT/DELETE SIDEBAR						*
 * -------------------------------------------------------------------------*/

	OT_sidebar_edit();	

	function save_sidebar(new_name,old_name,old_name_id,new_name_id) {
		var adminUrl = scripts.adminUrl;
		var themeName = scripts.themeName;
		new_name = new_name.replace(/\s+/g, '-').toLowerCase();
		
		jQuery.ajax({
			url: adminUrl,
			type:"POST",
			data:"action=edit_sidebar&sidebar_name="+new_name+"&old_name="+old_name,
			success:function(results) {
				jQuery("#save-"+old_name_id).parent(".edit-wrapper").removeClass("edit-wrapper").addClass("blocks-content");
				jQuery("#recordsArray_"+old_name_id).html("<div class=\"blocks-content clearfix\" style=\"text-align: left;\">Sidebar name: <b>"+new_name+"</b> <a href=\"javascript:{}\" class=\"button edit sidebar-edit\" id=\"edit-"+new_name_id+"\" rel=\""+new_name+"\">Edit</a><a href=\"javascript:{}\" class=\"button delete sidebar-delete\" id=\"delete-"+new_name_id+"\">Delete</a></div>");
				jQuery("#recordsArray_"+old_name_id).attr("id", "recordsArray_"+new_name_id);
				var text = results.slice(0,-1);
				jQuery("#"+themeName+"_sidebar_names").val(text);

				jQuery(document).ready(function($){
					var adminUrl = scripts.adminUrl;
					var themeName = scripts.themeName;
					jQuery(".sidebar-delete").click(function() {

						var id = jQuery(this).attr("id");
						id = id.replace('delete-', '');
						jQuery.ajax({
							url:adminUrl,
							type:"POST",
							data:"action=delete_sidebar&sidebar_name=" + id,
							success:function(results) {
								//alert(results);
								//$("#contentRight").html(results);
								var text = results.slice(0,-1);
								jQuery("#"+themeName+"_sidebar_names").val(text);
								jQuery("#recordsArray_"+id).remove();
							}
						});
					});
				});
				
				OT_sidebar_edit();

			}
		});
		
	}

	
	function OT_sidebar_edit() {
		jQuery(".sidebar-edit").click(function() {
			var old_name_id = jQuery(this).attr("id").replace("edit-", "");
			var old_name = jQuery(this).attr("rel");
			jQuery(this).parent(".blocks-content").removeClass("blocks-content").addClass("edit-wrapper");
			jQuery(this).parent(".edit-wrapper").html("Sidebar name: <input type=\"text\" id=\"input-"+old_name_id+"\" name=\"sidebar-name\" value=\""+old_name+"\" class=\"text\" /><a href=\"javascript:void(0)\" class=\"button edit\" id=\"save-"+old_name_id+"\">Save</a><a href=\"javascript:void(0)\" class=\"button delete sidebar-delete\" id=\"delete-"+old_name_id+"\">Delete</a>")

			jQuery("#input-"+old_name_id).keydown(function (e){
			if(e.keyCode == 13){
				var new_name = jQuery("#input-"+old_name_id).val();
				new_name = new_name.replace(/\s+/g, '-').toLowerCase();
				
				var new_name_id=new_name.replace(/ /g,"");
				new_name_id=new_name_id.toLowerCase();
				
				
					save_sidebar(new_name,old_name,old_name_id,new_name_id);
				}
			});
			jQuery("#save-"+old_name_id).click(function() {
				var new_name = jQuery("#input-"+old_name_id).val();
				new_name = new_name.replace(/\s+/g, '-').toLowerCase();
				var new_name_id=new_name.replace(/ /g,"");
				new_name_id=new_name_id.toLowerCase();
				save_sidebar(new_name,old_name,old_name_id,new_name_id);
			});	

				var adminUrl = scripts.adminUrl;
				var themeName = scripts.themeName;
				jQuery(".sidebar-delete").click(function() {

					var id = $(this).attr("id");
					id = id.replace('delete-', '');
					jQuery.ajax({
						url:adminUrl,
						type:"POST",
						data:"action=delete_sidebar&sidebar_name=" + id,
						success:function(results) {
							//alert(results);
							//$("#contentRight").html(results);
							var text = results.slice(0,-1);
							jQuery("#"+themeName+"_sidebar_names").val(text);
							jQuery("#recordsArray_"+id).remove();
						}
					});
				});		

		});
	}


	/* -------------------------------------------------------------------------*
	 * 						SUBMIT MANAGEMENT PANEL DATA
	 * -------------------------------------------------------------------------*/
	jQuery('.ot-save-management').click(function() {
		var button = jQuery(this);
		jQuery("#orange-themes-options").css("opacity","0.5");
		button.text(button.data('loading'));

		var str = jQuery("#orange-themes-options").serialize();
		jQuery.ajax({
			url:adminUrl,
			type:"POST",
			data:str+"&action=ot_management_save",
			success:function(results) {	
				jQuery(".main-wrapper").remove();
				jQuery("#ot-saved-content").html(results);
				jQuery("input, textarea, select, button").uniform();
				ot_on_management_load();
				addLoadEvent(jscolor.init);
				jQuery('.sidebar').css({ height: jQuery('.main-wrapper').height() - 86 });
				jQuery("#orange-themes-options").css("opacity","1.0");
				button.text(button.data('saved'));
			}
		});
		
		return false;

	});	
}


jQuery(document).ready(function($) {
	ot_on_management_load();
});


	


		
		
/* -------------------------------------------------------------------------*
 * 								CUSTOM SELECT								*
 * -------------------------------------------------------------------------*/
	jQuery(document).ready(function(){
	
	
		jQuery('.otpost-type').each(function(index) {
			jQuery(this).parent().find(".ppid").css("display", "none");
			jQuery(this).parent().find(".pid").css("display", "none");
			jQuery(this).parent().find(".gid").css("display", "none");
			
			
			
			switch(jQuery(this).find("select").first().val()) {
				case "post":
				jQuery(this).parent().find(".ppid").css("display", "block");
				break;
				case "gallery":
				jQuery(this).parent().find(".gid").css("display", "block");
				break;
				case "portfolio":
				jQuery(this).parent().find(".pid").css("display", "block");
				break;
			}
				
		});

		jQuery(".otpost-type select").live("change",function() {
		
			var selectField = jQuery(this).children("option:selected").text();
			jQuery(this).parent().parent().parent().parent().find(".ppid").css("display", "none");
			jQuery(this).parent().parent().parent().parent().find(".pid").css("display", "none");
			jQuery(this).parent().parent().parent().parent().find(".gid").css("display", "none");
			
			

			switch(selectField) {
				case "Post":
				jQuery(this).parent().parent().parent().parent().find(".ppid").css("display", "block");
				break;
				case "Gallery":
				jQuery(this).parent().parent().parent().parent().find(".gid").css("display", "block");
				break;
				case "Portfolio":
				jQuery(this).parent().parent().parent().parent().find(".pid").css("display", "block");
				break;
			}
		});
		
		
	});	
	



