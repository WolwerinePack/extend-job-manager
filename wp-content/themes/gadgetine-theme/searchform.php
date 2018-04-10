<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

	<form method="get" action="<?php echo home_url(); ?>" name="searchform" >
		<div>
			<label class="screen-reader-text" for="s"><?php esc_html_e("Search for:",THEME_NAME);?></label>
			<input type="text" placeholder="<?php printf ( esc_html( 'search here' , THEME_NAME ));?>" class="search" name="s" id="s" />
			<input type="submit" id="searchsubmit" value="<?php esc_html_e("Search",THEME_NAME);?>" />
		</div>
	<!-- END .searchform -->
	</form>
