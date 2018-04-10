<?php
	
	define('WPLANG', 'fr-FR');
	
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	function theme_enqueue_styles() {
	    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	}	

	// Ajout de l'icon
	function excerpt($limit) {
	  $excerpt = explode(' ', get_the_excerpt(), $limit);
	  if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	  } else {
		$excerpt = implode(" ",$excerpt);
	  }	
	  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	  return $excerpt;
	}

	// Récuperation des fonctions du theme robojob
	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '-child/inc/template-tags.php';

	/**
	 * Custom functions that act independently of the theme templates.
	 */
	require get_template_directory() . '-child/inc/extras.php';

	require get_template_directory() . '-child/inc/custom-header.php';

	/**
	 * Customizer additions.
	 */
	//require get_template_directory() . '-child/inc/customizer/customizer.php';

	/**
	 * Sanitization additions.
	 */
	require get_template_directory() . '-child/inc/customizer/robojob-lite-sanitization.php';

	/**
	 * sidebar additions.
	 */
	require get_template_directory() . '-child/inc/robojob-lite-sidebar.php';

	/**
	 * Nav Walker additions.
	 */
	if ( ! class_exists( 'wp_bootstrap_navwalker' )) {
		require get_template_directory() . '-child/inc/wp_bootstrap_navwalker.php';
	}

	/**
	 * robojob functions
	*/
	require get_template_directory() . '-child/inc/lib/robojob-lite-functions.php';

	require get_template_directory() . '-child/inc/lib/robojob-lite-banner.php';

	/**
	 * robojob shortcode
	 */

	require get_template_directory() . '-child/inc/lib/extra-function.php';

	require get_template_directory() . '-child/inc/lib/extra-posts.php';

	/**
	 * Load Jetpack compatibility file.
	 */
	require get_template_directory() . '-child/inc/jetpack.php';

	require get_template_directory() . '-child/inc/customizer/robojob-lite-customize-control.php';

	//require_once get_template_directory() . '-child/inc/customizer/class-upgrade-to-pro.php';

	// Ajout du filtre sur les tags	
		
	add_filter('widget_tag_cloud_args','set_tag_cloud_numbers');
	function set_tag_cloud_numbers($args) {
		
	$args = array_merge(  array('number' => 25, 'orderby'=> 'count','order' => 'DESC'), $args );

	return $args; }

	/**
	 * Remove the preview step. Code goes in theme functions.php or custom plugin.
	 * @param  array $steps
	 * @return array
	 */
	function custom_submit_job_steps( $steps ) {
		unset( $steps['preview'] );
		return $steps;
	}
	add_filter( 'submit_job_steps', 'custom_submit_job_steps' );
	/**
	 * Change button text (won't work until v1.16.2)
	 */
	function change_preview_text() {
		return __( 'Soumettre l\'annonce' );
	}
	add_filter( 'submit_job_form_submit_button_text', 'change_preview_text' );
	/**
	 * Since we removed the preview step and it's handler, we need to manually publish jobs
	 * @param  int $job_id
	 */
	function done_publish_job( $job_id ) {
		$job = get_post( $job_id );
		if ( in_array( $job->post_status, array( 'preview', 'expired' ) ) ) {
			// Reset expirey
			delete_post_meta( $job->ID, '_job_expires' );
			// Update job listing
			$update_job                  = array();
			$update_job['ID']            = $job->ID;
			$update_job['post_status']   = get_option( 'job_manager_submission_requires_approval' ) ? 'pending' : 'publish';
			$update_job['post_date']     = current_time( 'mysql' );
			$update_job['post_date_gmt'] = current_time( 'mysql', 1 );
			wp_update_post( $update_job );
		}
	}
	add_action( 'job_manager_job_submitted', 'done_publish_job' );