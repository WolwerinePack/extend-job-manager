	jQuery.noConflict();
    jQuery(document).ready(function() {
		jQuery("#1").click(function(){
            jQuery('#10').slideToggle('slow');

        });
        jQuery("#2").click(function(){
            jQuery('#20').slideToggle('slow');

        });
        jQuery("#3").click(function(){
            jQuery('#30').slideToggle('slow');

        });
        jQuery("#4").click(function(){
            jQuery('#40').slideToggle('slow');

        });
        jQuery("#5").click(function(){
            jQuery('#50').slideToggle('slow');

        });
        jQuery("#6").click(function(){
            jQuery('#60').slideToggle('slow');

        });
        jQuery("#8").click(function(){
            jQuery('#1').slideToggle('slow');
            jQuery('#2').slideToggle('slow');
            jQuery('#3').slideToggle('slow');
            jQuery('#4').slideToggle('slow');
            jQuery('#5').slideToggle('slow');
            jQuery('#6').slideToggle('slow');
            jQuery('#7').slideToggle('slow');
            if(jQuery('#10').is(":visible")){jQuery('#10').slideToggle('slow');};
            if(jQuery('#20').is(":visible")){jQuery('#20').slideToggle('slow');};
            if(jQuery('#30').is(":visible")){jQuery('#30').slideToggle('slow');};
            if(jQuery('#40').is(":visible")){jQuery('#40').slideToggle('slow');};
            if(jQuery('#50').is(":visible")){jQuery('#50').slideToggle('slow');};
            if(jQuery('#60').is(":visible")){jQuery('#60').slideToggle('slow');};
        });
    });