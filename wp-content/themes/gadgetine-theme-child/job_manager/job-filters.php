<?php
/**
 * Filters in `[jobs]` shortcode.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-filters.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @version     1.21.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wp_enqueue_script( 'wp-job-manager-ajax-filters' );

do_action( 'job_manager_job_filters_before', $atts );
?>

<form class="job_filters">
	<?php do_action( 'job_manager_job_filters_start', $atts ); ?>

	<div class="search_jobs">
		<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>

		<div class="search_keywords">
			<label for="search_keywords"></label>
			<input class="slide" type="text" name="search_keywords" id="search_keywords" placeholder="Mots-clés ou Code Postal" value="<?php echo esc_attr( $keywords ); ?>" onkeypress="refuserToucheEntree(event);" />
		</div>
		<script>
			function refuserToucheEntree(event)
			{
			    // Compatibilité IE / Firefox
			    if(!event && window.event) {
			        event = window.event;
			    }
			    // IE
			    if(event.keyCode == 13) {
			        event.returnValue = false;
			        event.cancelBubble = true;
			    }
			    // DOM
			    if(event.which == 13) {
			        event.preventDefault();
			        event.stopPropagation();
			    }
			}
		</script>
		<div >
			<button id="8" class="button slide" type="button"><i class="icon ion-android-add-circle"></i> Recherche Avancée</button>
		</div>

		<?php if ( $categories ) : ?>
			<?php foreach ( $categories as $category ) : ?>
				<input type="hidden" name="search_categories[]" value="<?php echo sanitize_title( $category ); ?>" />
			<?php endforeach; ?>
		<?php elseif ( $show_categories && ! is_tax( 'job_listing_category' ) && get_terms( 'job_listing_category' ) ) : ?>
			<div class="search_categories">
				<label for="search_categories"><?php _e( 'Category', 'wp-job-manager' ); ?></label>
				<?php if ( $show_category_multiselect ) : ?>
					<?php job_manager_dropdown_categories( array( 'taxonomy' => 'job_listing_category', 'hierarchical' => 1, 'name' => 'search_categories', 'orderby' => 'name', 'selected' => $selected_category, 'hide_empty' => false ) ); ?>
				<?php else : ?>
					<?php job_manager_dropdown_categories( array( 'taxonomy' => 'job_listing_category', 'hierarchical' => 1, 'show_option_all' => __( 'Any category', 'wp-job-manager' ), 'name' => 'search_categories', 'orderby' => 'name', 'selected' => $selected_category, 'multiple' => false ) ); ?>
				<?php endif; ?>				
			</div>
		<?php endif; ?>

		<?php do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>
	</div>

	<?php do_action( 'job_manager_job_filters_end', $atts ); ?>
</form>

<?php do_action( 'job_manager_job_filters_after', $atts ); ?>

<noscript><?php _e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'wp-job-manager' ); ?></noscript>