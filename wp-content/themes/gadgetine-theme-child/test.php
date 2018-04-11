<?php
get_header();
/*
* Template Name: TEST
*/	
?>	
<div class="pure-g">
		<div class="pure-u-16-24">
		<div>	
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
		    		<h2><?php echo 'resultat : '; ?>
		    			<pre>
<?php print_r($result);?>
		    			</pre>
		    		</h2>
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
				$cookie='c_facebook';
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
				$cookie='c_linkedin';
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