<?php
get_header();
	/*
	Template Name: TEST
	*/	
?>	<div id="locationField">
      <input id="autocomplete" placeholder="Enter your address"
             onFocus="geolocate()" type="text"></input>
    </div>

    <table id="address">
      <tr>
        <td class="label">Street address</td>
        <td class="slimField"><input class="field" id="street_number"
              disabled="true"></input></td>
        <td class="wideField" colspan="2"><input class="field" id="route"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">City</td>
        <!-- Note: Selection of address components in this example is typical.
             You may need to adjust it for the locations relevant to your app. See
             https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
        -->
        <td class="wideField" colspan="3"><input class="field" id="locality"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">State</td>
        <td class="slimField"><input class="field"
              id="administrative_area_level_1" disabled="true"></input></td>
        <td class="label">Zip code</td>
        <td class="wideField"><input class="field" id="postal_code"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">Country</td>
        <td class="wideField" colspan="3"><input class="field"
              id="country" disabled="true"></input></td>
      </tr>
    </table>

    <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

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
			types: ['(cities)'],
			componentRestrictions: {country: 'fr'}
		};
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode'], componentRestrictions: {country: 'fr'} });

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
    </script>
			






	    	<?php 
	    	/*
			* Test_Plugin
			*/
			$plugin='/';
			$test=validate_plugin( $plugin );
			if ( is_wp_error( $test ) ) { ?>			
			<h2>
				<pre>
<?php print_r($test); }else { echo '<h1>chemin valide : '.WP_PLUGIN_DIR.'/'.$plugin.'</h1><br />';} ?>
				</pre>				
			</h2>
			<?php
	    	$result = activate_plugin( $plugin );
		    	if ( is_wp_error( $result ) ) { ?>
		    		<h1><?php echo 'resultat : '; ?>
		    			<pre>
		    				<?php print_r($result);?>
		    			</pre>
		    		</h1>
		    		<br />
				<?php }
				else{ ?>
					<h1>
						<?php 
							echo 'nothing else matter';						
					    ?>
					</h1>
				<?php } ?>
		</div>
		<div>
			<h1>
				<?php 
				/**
				* AFFICHAGE DES COOKIES
				*/	
				$count_cookies=0;
				$cookie='application';
					if(!isset($_COOKIE[$cookie]))
					{
						echo "The cookie: '" .$cookie. "' is not set.";						
				    } 
				    else 
				    {
				    	echo "The cookie '" .$cookie. "' is set.<br />";
				    	echo "Value of cookie: " . $_COOKIE[$cookie];
				    	$count_cookies++;
				    }
				?>
			</h1>
			<h1>
				<?php 
				/**
				* AFFICHAGE DES COOKIES
				*/	
				$cookie='c_name';
					if(!isset($_COOKIE[$cookie]))
					{
						echo "The cookie: '" .$cookie. "' is not set.";						
				    } 
				    else 
				    {
				    	echo "The cookie '" .$cookie. "' is set.<br />";
				    	echo "Value of cookie: " . $_COOKIE[$cookie];
				    	$count_cookies++;
				    }
				?>
			</h1>
			<br />
			<h1>
				<?php 
				$cookie='c_website';
					if(!isset($_COOKIE[$cookie]))
					{
						echo "The cookie: '" .$cookie. "' is not set.";						
				    } 
				    else 
				    {
				    	echo "The cookie '" .$cookie. "' is set.<br />";
				    	echo "Value of cookie: " . $_COOKIE[$cookie];
				    	$count_cookies++;
				    }
				?>
			</h1>
			<br />
			<h1>
				<?php 
				$cookie='c_tagline';
					if(!isset($_COOKIE[$cookie]))
					{
						echo "The cookie: '" .$cookie. "' is not set.";						
				    } 
				    else 
				    {
				    	echo "The cookie '" .$cookie. "' is set.<br />";
				    	echo "Value of cookie: " . $_COOKIE[$cookie];
				    	$count_cookies++;
				    }
				?>
			</h1>
			<br />
			<h1>
				<?php 
				$cookie='c_video';
					if(!isset($_COOKIE[$cookie]))
					{
						echo "The cookie: '" .$cookie. "' is not set.";						
				    } 
				    else 
				    {
				    	echo "The cookie '" .$cookie. "' is set.<br />";
				    	echo "Value of cookie: " . $_COOKIE[$cookie];
				    	$count_cookies++;
				    }
				?>
			</h1>
			<br />
			<h1>
				<?php 
				$cookie='c_twitter';
					if(!isset($_COOKIE[$cookie]))
					{
						echo "The cookie: '" .$cookie. "' is not set.";						
				    } 
				    else 
				    {
				    	echo "The cookie '" .$cookie. "' is set.<br />";
				    	echo "Value of cookie: " . $_COOKIE[$cookie];
				    	$count_cookies++;
				    }
				?>
			</h1>
			<br />
			<h1>
				<?php 
				$cookie='c_why';
					if(!isset($_COOKIE[$cookie]))
					{
						echo "The cookie: '" .$cookie. "' is not set.";						
				    } 
				    else 
				    {
				    	echo "The cookie '" .$cookie. "' is set.<br />";
				    	echo "Value of cookie: " . $_COOKIE[$cookie];
				    	$count_cookies++;
				    }
				?>
			</h1>
			<br />
			<h1>
				<?php 
				$cookie='c_number';
					if(!isset($_COOKIE[$cookie]))
					{
						echo "The cookie: '" .$cookie. "' is not set.";						
				    } 
				    else 
				    {
				    	echo "The cookie '" .$cookie. "' is set.<br />";
				    	echo "Value of cookie: " . $_COOKIE[$cookie];
				    	$count_cookies++;
				    }
				?>
			</h1>
			<br />
			<h1>
				<?php 
				$cookie='c_profil';
					if(!isset($_COOKIE[$cookie]))
					{
						echo "The cookie: '" .$cookie. "' is not set.";						
				    } 
				    else 
				    {
				    	echo "The cookie '" .$cookie. "' is set.<br />";
				    	echo "Value of cookie: " . $_COOKIE[$cookie];
				    	$count_cookies++;
				    }
				?>
			</h1>
			<br />
			<h1>
				<?php 
				$cookie='c_rh';
					if(!isset($_COOKIE[$cookie]))
					{
						echo "The cookie: '" .$cookie. "' is not set.";						
				    } 
				    else 
				    {
				    	echo "The cookie '" .$cookie. "' is set.<br />";
				    	echo "Value of cookie: " . $_COOKIE[$cookie];
				    	$count_cookies++;
				    }
				    echo "<br /><br />Nombre de cookies : ".$count_cookies;
				?>
			</h1>
		</div>
		<div>
			<h1>
				<?php $user=get_current_user_id();echo 'utilisateur : '.$user ;?>
			</h1>
		</div>
	</div>
    <div class="pure-u-1-24"></div>
    <div class="pure-u-7-24">
		<?php  dynamic_sidebar('sidebar-jobs'); ?>
	</div>
</div>
<?php get_footer(); ?>