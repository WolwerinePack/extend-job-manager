<?php
namespace app;
class script_jquery
{
	public function __construct()
	{
			add_filter( 'submit_job_form_end',array ($this, 'add_script_submit_job_form_end') );
	}


	public function add_script_submit_job_form_end($fields){ ?>		
		<script>
			/*
			*	cache le formulaire le temps que le tweak de chosen se mette en place (voir plus bas)
			*/
			jQuery(".fieldset-company_rh, .fieldset-company_prenomrh, .fieldset-company_telrh, .fieldset-company_mailrh").addClass("rh");
			jQuery('#submit-job-form').hide();

			/*
			*	Rajoute le I et le champ caché a afficher pour les informations au bouton radio "premium"
			*   Rajoute également le titre et un champ d'information pour la partie Vos données de contact
			*/
			jQuery(function($){				
		    	$.when($.ready).then(function(e){
		        	$("input[value='premium']").parent().append("<i class='icon ion-ios-information-outline'></i><div class='information'>Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles,</div>");

		        	$(".fieldset-company_rh").before("<div class='rh'><h1 class='titre-meta'> Vos données de contact</h1><div class='choix'>(Ces informations sont uniquement destinées à nos services pour le traitement de votre demande. Elles ne seront pas communiquées aux candidats )</div><br /></div>");
		        	
		    	});
			});

			/**
			* lors du click sur le choix premium la partie Vos données de contact apparait et devient obligatoire
			*/
			jQuery(function($)
			{
				$("input[value='premium']").click(function()
				{
					$(".rh").slideDown();
					$("#company_rh, #company_prenomrh, #company_telrh, #company_mailrh").attr('required',' ');
					$(".fieldset-company_rh > div, .fieldset-company_prenomrh > div, .fieldset-company_telrh > div, .fieldset-company_mailrh > div").addClass('required-field');
					$('.fieldset-company_rh > label > small, .fieldset-company_prenomrh > label > small, .fieldset-company_telrh > label > small, .fieldset-company_mailrh > label > small ').hide();
				});
			});
			/**
			* lors du click sur le choix standard la partie Vos données de contact disparait et devient optionelle
			*/
			jQuery(function($)
			{
				$("input[value='standard']").click(function()
				{
					$(".rh").slideUp();
					$("#company_rh, #company_prenomrh, #company_telrh, #company_mailrh").removeAttr('required',' ');
					$(".fieldset-company_rh > div, .fieldset-company_prenomrh > div, .fieldset-company_telrh > div, .fieldset-company_mailrh > div").removeClass('required-field');
					$('.fieldset-company_rh > label > small, .fieldset-company_prenomrh > label > small, .fieldset-company_telrh > label > small, .fieldset-company_mailrh > label > small ').show();
				});
			});

			// affiche le champ d'informations au survol de la souris
			jQuery(function($){
				$("input[value='premium']").parent().mouseenter(function(e){
					$(".information").show();
				});
			});
			// masque le champ d'informations quand la souris ne survol plus 
			jQuery(function($){
			$("input[value='premium']").parent().mouseleave(function(e){
					$(".information").hide();
				});
			});

			jQuery(function($){
		    	$.when($.ready).then(function(e){
		        	$('#diagnostic').parent().before("<div class='choix'>( Plusieurs choix possible )</div>");
		        	$('#expertise').parent().before("<div class='choix'>( Plusieurs choix possible )</div>");
		        	$('#experience').parent().before("<div class='choix'>( Plusieurs choix possible )</div>");
		    	});
			});

			jQuery(function($){

				/**
				*	les commandes suivantes sont necessaires pour tweak le comportement de chosen afin que les input soient ouvert dés le début
				*	chosen:open ouvrent les champs
				*	mouseover permet d'empecher le clignotement des champs
				*	mousedown mets le focus en haut du formulaire
				*/
  			   	$(document).ready(function(e){		    		
	  				$('#expertise').trigger('chosen:open');
	  				$('#diagnostic').trigger('chosen:open');
	  				$('#experience').trigger('chosen:open');
  					$('li.highlighted').trigger('mouseover');
					$('#job_location+div').trigger('mousedown');
					setTimeout(function($){
							jQuery(document).scrollTop(0);
						},500);
	  			});

  			   	/*
  			   	*	affiche le formulaire aprés le chargemetn de la page.
  			   	*/
	  			$(document).ready(function(e){		    		
	  				setTimeout(function($){
						jQuery('#submit-job-form').show();
					},550);
	  			});
		    });
	  		
		</script>
		<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        var options = {
			types: ['(region)'],
			componentRestrictions: {country: 'fr'}
		};
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('job_location')),
            {types: ['(regions)'], componentRestrictions: {country: 'fr'} });

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAo_IFjU8w01LdnAH5i7v93u20Zti1Nek&libraries=places&callback=initAutocomplete"
        async defer>
    </script><?php 
		return $fields;
	}

}