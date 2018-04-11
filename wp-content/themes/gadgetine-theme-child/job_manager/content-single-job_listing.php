<?php
/**
 * Single job listing.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-single-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @since       1.0.0
 * @version     1.28.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
?>
<div class="single_job_listing">
	<?php if ( get_option( 'job_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ) : ?>
		<div class="job-manager-info"><?php _e( 'This listing has expired.', 'wp-job-manager' ); ?></div>
	<?php else : ?>
		<?php
			/**
			 * single_job_listing_start hook
			 *
			 * @hooked job_listing_meta_display - 20
			 * @hooked job_listing_company_display - 30
			 */
			global $post;
			$post_ID = get_the_ID();
			$expertises = wp_get_post_terms( $post_ID, 'expertise', 'all' );
			$profils = wp_get_post_terms( $post_ID, 'profil', 'all' );
			$profil = $profils[0]->name;
			$diags = wp_get_post_terms( $post_ID, 'diagnostic', 'all' );
			$experiences = wp_get_post_terms( $post_ID, 'experience', 'all' );
			$salaries = wp_get_post_terms( $post_ID, 'salaire', 'all' );
			$salary = $salaries[0]->name;			
			$zip = get_post_meta( $post_ID, 'geolocation_postcode', true );
			$zone = get_post_meta( $post->ID, 'geolocation_state_long', true );
			$town= get_post_meta( $post->ID, 'geolocation_city', true ); 
			$company_linkedin = get_post_meta( $post_ID, '_company_linkedin', true);
        	$company_facebook = get_post_meta( $post_ID, '_company_facebook', true);

			do_action( 'single_job_listing_meta_before' ); 
		?>
<ul class="job-listing-meta meta slug-search"">
	<?php do_action( 'single_job_listing_meta_start' ); ?>

	<?php if ( get_option( 'job_manager_enable_types' ) ) { ?>
		<?php $types = wpjm_get_the_job_types(); ?>
		<?php if ( ! empty( $types ) ) : foreach ( $types as $type ) : ?>
			<li class="job-type <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>"><?php echo esc_html( $type->name ); ?></li>
		<?php endforeach; endif; ?>
	<?php } ?>

	<li class="location">
		<?php if ( $zip ) { ?>
	    		<a class="google_map_link" href="http://maps.google.com/maps?q=<?php echo esc_html( $zip ) ?>&amp;zoom=14&amp;size=512x512&amp;maptype=roadmap&amp;sensor=false" target="_blank"><?php echo esc_html( $zip ) ?></a>
	  	<?php }
		if ( $town ) { ?>
	    		<?php echo esc_html( $town ) ?>
	  	<?php }
		if ( $zone ) { ?>
	    		<?php echo esc_html( $zone ) ?>
	  	<?php } ?>
	</li>
	<li class="date-posted"><?php the_job_publish_date(); ?></li>
</ul>

<ul class="slug-search">
	<?php if ( $expertises )
	{ 
		if ( count( $expertises ) > 1)
  		{ ?>
  			<li><strong> Champs d'expertise : </strong>
		<?php }
    	else
    	{ ?>
    		<li><strong> Champ d'expertise : </strong>
    	<?php }

    	foreach ($expertises as $expertise )
    	{
			$expert = $expertise->name;
			echo esc_html( $expert ); ?> <strong>/</strong>
		<?php } ?>
			</li>
	<?php } ?>
</ul>

<ul class="slug-search">
	<?php if ( $profil ) { ?>
    		<li><strong><?php echo __( 'Profil : ' ) ?></strong>
    		<?php echo esc_html( $profil ) ?></li>
  	<?php } ?>
</ul>  	

<ul class="slug-search">
	<?php if ( $diags ) {
			if ( count( $diags ) > 1)
  			{ ?>
  				<li> <strong>Types de diagnostic : </strong>
  			<?php }
    		else
    		{ ?>
	    		<li> <strong>Type de diagnostic : </strong>
    		<?php }	
		  	foreach ($diags as $diag ) {
		  		$diagnostique = $diag->name;
		  		echo esc_html( $diagnostique ) ?>
		  		<strong> / </strong>
		  	<?php } ?>
		  	</li>
   		<?php } ?>
</ul>  	

<ul class="slug-search">
	<?php if ( $experiences ) {
			if ( count( $diag ) > 1)
  			{ ?>
  				<li> <strong>Niveaux d'experience : </strong>
  			<?php }
    		else
    		{ ?>
	    		<li> <strong>Niveau d'experience : </strong>
    		<?php }
    		foreach ($experiences as $experience ) {
		  		$exp = $experience->name;
		  		echo esc_html( $exp ) ?>
		  		<strong> / </strong>
		  	<?php } ?>
		  	</li>
	<?php } ?>
</ul>

<ul class="slug-search">
	<?php if ( $salary ) { ?>
	<li><strong>Salaire: </strong>
		<?php echo esc_html( $salary ) ?>
		<?php if ( $salary!=='Non rémunéré' && $salary!=='A négocier')
  		{ ?>
  			€/an</li>
  		<?php }
    	else
    	{ ?>
	    	</li>
    	<?php } ?>
	<?php } ?>
</ul>

	<?php if ( is_position_filled() ) : ?>
		<li class="position-filled"><?php _e( 'This position has been filled', 'wp-job-manager' ); ?></li>
	<?php elseif ( ! candidates_can_apply() && 'preview' !== $post->post_status ) : ?>
		<li class="listing-expired"><?php _e( 'Applications have closed', 'wp-job-manager' ); ?></li>
	<?php endif; ?>

	<?php do_action( 'single_job_listing_meta_end' ); ?>
</ul>

		<div class="job_description">
			<?php wpjm_the_job_description(); ?>
		</div>
		<div class="company">
			<?php the_company_logo(); ?>
			<p class="name">
				<?php if ( $website = get_the_company_website() ) : ?>
					<a class="website" href="<?php echo esc_url( $website ); ?>" target="_blank" rel="nofollow"><?php _e( 'Website', 'wp-job-manager' ); ?></a>
				<?php endif; ?>
				<?php the_company_twitter(); ?>
				<?php if ( $company_linkedin )
                { ?>    
                    <a target="_blank" href="https://fr.linkedin.com/company/<?php echo esc_attr($company_linkedin); ?>"><i class="fa fa-linkedin"></i> Linkedin </a>                   
                <?php } ?>
                <?php if ( $company_facebook )
                { ?>
                    <a target="_blank" href="https://fr-fr.facebook.com/<?php echo esc_attr($company_facebook); ?>"><i class="fa fa-facebook"></i> Facebook </a>                
                <?php } ?>
				<?php the_company_name( '<strong>', '</strong>' ); ?>
			</p>
			<?php the_company_tagline( '<p class="tagline">', '</p>' ); ?>
			<?php the_company_video(); ?>
		</div>

		<?php if ( candidates_can_apply() ) : ?>
			<?php get_job_manager_template( 'job-application.php' ); ?>
		<?php endif; ?>

		<?php
			/**
			 * single_job_listing_end hook
			 */
			do_action( 'single_job_listing_end' );
		?>
	<?php endif; ?>
</div>
