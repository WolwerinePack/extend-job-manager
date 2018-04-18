	jQuery.noConflict();
    jQuery('#60').slideUp();
    jQuery(document).ready(function() {        
		jQuery("#1").click(function(){
            if(jQuery("#10").is(":visible"))
            {
                jQuery("#1 > i").attr('class', 'ion-android-add-circle');
                jQuery('#10').hide();
            }
            else
            {
                jQuery("#1 > i").attr('class', 'ion-android-remove-circle');
                jQuery('#10').show();
            }

        });
        jQuery("#2").click(function(){
            if(jQuery("#20").is(":visible"))
            {
                jQuery("#2 > i").attr('class', 'ion-android-add-circle');
                jQuery('#20').hide();
            }
            else
            {
                jQuery("#2 > i").attr('class', 'ion-android-remove-circle');
                jQuery('#20').show();
            }

        });
        jQuery("#3").click(function(){
            if(jQuery("#30").is(":visible"))
            {
                jQuery("#3 > i").attr('class', 'ion-android-add-circle');
                jQuery('#30').hide();
            }
            else
            {
                jQuery("#3 > i").attr('class', 'ion-android-remove-circle');
                jQuery('#30').show();
            }

        });
        jQuery("#4").click(function(){
            if(jQuery("#40").is(":visible"))
            {
                jQuery("#4 > i").attr('class', 'ion-android-add-circle');
                jQuery('#40').hide();
            }
            else
            {
                jQuery("#4 > i").attr('class', 'ion-android-remove-circle');
                jQuery('#40').show();
            }

        });
        jQuery("#5").click(function(){
            if(jQuery("#50").is(":visible"))
            {
                jQuery("#5 > i").attr('class', 'ion-android-add-circle');
                jQuery('#50').hide();
            }
            else
            {
                jQuery("#5 > i").attr('class', 'ion-android-remove-circle');
                jQuery('#50').show();
            }

        });
        jQuery("#6").click(function(){
            if(jQuery("#60").is(":visible"))
            {
                jQuery("#6 > i").attr('class', 'ion-android-add-circle');
                jQuery('#60').hide();
            }
            else
            {
                jQuery("#6 > i").attr('class', 'ion-android-remove-circle');
                jQuery('#60').show();
            }

        });
        jQuery("#8").click(function(){
            jQuery('#1').slideToggle('slow');
            jQuery('#2').slideToggle('slow');
            jQuery('#3').slideToggle('slow');
            jQuery('#4').slideToggle('slow');
            jQuery('#5').slideToggle('slow');
            jQuery('#6').slideToggle('slow');
            jQuery('#7').slideToggle('slow');
            if(jQuery("#8 > i").hasClass('ion-android-add-circle'))
            {
                jQuery("#8 > i").attr('class', 'ion-android-remove-circle');
            }
            else
            {
                jQuery("#8 > i").attr('class', 'ion-android-add-circle');
            }
            if(jQuery('#10').is(":visible")){jQuery('#10').slideUp('slow');jQuery("#1 > i").attr('class', 'ion-android-add-circle');};
            if(jQuery('#20').is(":visible")){jQuery('#20').slideUp('slow');jQuery("#2 > i").attr('class', 'ion-android-add-circle');};
            if(jQuery('#30').is(":visible")){jQuery('#30').slideUp('slow');jQuery("#3 > i").attr('class', 'ion-android-add-circle');};
            if(jQuery('#40').is(":visible")){jQuery('#40').slideUp('slow');jQuery("#4 > i").attr('class', 'ion-android-add-circle');};
            if(jQuery('#50').is(":visible")){jQuery('#50').slideUp('slow');jQuery("#5 > i").attr('class', 'ion-android-add-circle');};
            if(jQuery('#60').is(":visible")){jQuery('#60').slideUp('slow');jQuery("#6 > i").attr('class', 'ion-android-add-circle');};
        });
    });