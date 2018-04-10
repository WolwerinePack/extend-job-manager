<?php
	wp_reset_query();

	$sidebar = get_post_meta( OT_page_ID(), "_".THEME_NAME.'_sidebar_select', true );

	if(is_category()) {
		$sidebar = ot_get_option( get_cat_id( single_cat_title("",false) ), 'sidebar_select', false );
	} elseif(is_tax()){
		$sidebar = ot_get_option( get_queried_object()->term_id, 'sidebar_select', false );
	}
	
	if($sidebar=='' && function_exists('is_woocommerce') && is_woocommerce()) {
		$sidebar = 'ot_woocommerce';
	}
	if($sidebar=='' && function_exists("is_bbpress") && is_bbpress()) {
		$sidebar = 'ot_bbpress';
	}

	if($sidebar=='' && function_exists("is_buddypress") && is_buddypress()) {
		$sidebar = 'ot_buddypress';
	}
	

	if ( $sidebar=='' || is_search()) {
		$sidebar='default';
	}	
	$stickySidebar = get_option ( THEME_NAME."_sticky_sidebar" );
	
	if($sidebar!="off") {
?>
	
	<!-- BEGIN #sidebar -->
	<aside id="sidebar">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?>
		<?php endif; ?>
		<?php if($stickySidebar=="on") { ?>
			<div class="sidebar-fixed">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sicky_sidebar') ) : ?>
				<?php endif; ?>
			</div>
		<?php } ?>
	<!-- END #sidebar -->
	</aside>
<?php }  ?>
<?php wp_reset_query();  ?>