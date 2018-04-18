<?php
/**
 * Notice when job has been submitted.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-submitted.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      José Fortuny
 * @package     WP Job Manager
 * @category    Template
 * @version    	2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_post_types;
switch ( $job->post_status ) :
	case 'publish' :
		printf( __( '%s listed successfully. To view your listing <a href="%s">click here</a>.', 'wp-job-manager' ), $wp_post_types['job_listing']->labels->singular_name, get_permalink( $job->ID ) );
	break;
	case 'pending' :
	$post = get_post($job->ID);
		$link = site_url().'/wp-admin/post.php?post='.$post->ID.'&action=edit';
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$foot = site_url()."/wp-content/uploads/2018/04/Footer.jpg";
		if( get_post_meta( $job->ID, '_premium', true) === 'premium' )
		{
			/**
			* Envois un mail a l'équipe de modération lors de la dépose d'une annonce PREMIUM
			*/
			$nom = get_post_meta( $job->ID, '_company_rh', true);
			$prenom = get_post_meta( $job->ID, '_company_prenomrh', true);
			$tel = get_post_meta( $job->ID, '_company_telrh', true);
			$mail = get_post_meta( $job->ID, '_company_mailrh', true);
			$company=get_post_meta( $job->ID, '_company_name', true);
			$location=get_post_meta( $job->ID, '_job_location', true);
			printf('<br /><h2>Vous avez choisi l\'offre Premium pour votre annonce.<br />Notre service commercial vous recontactera sous 24h pour finaliser votre demande.</h2>');
			$message = "Bonjour,<br />
			Une nouvelle offre d’emploi  PREMIUM a été déposée. <br />
			Entreprise : ".$company."<br />
			Emplacement : ".$location."<br />
			Nom : ".$nom."<br />
			Prénom : ".$prenom."<br />
			Téléphone : ".$tel."<br />
			Courriel : ".$mail."<br />
			Rendez-vous sur le lien suivant pour consulter les détails de la demande client : ".$link."<br />
			Par la suite, merci de bien vouloir lui renvoyer une proposition commerciale dans les 24 heures ouvrées.<br />
			<img src='".$foot."'>";
			$team="jose.fortuny@itga.fr";
			wp_mail($team, "Une nouvelle offre d’emploi PREMIUM / Contact à appeler  ", $message, $headers);			
		}
		else
		{ 
			/**
			* Envois un mail a l'équipe de modération lors de la dépose d'une annonce STANDARD
			*/
			printf( '<br /><h2>Annonce soumise avec succés , elle sera visible après validation pendant une durée de 60 jours.</h2>' );
			$message = "Bonjour,<br />
			Une nouvelle offre d’emploi STANDARD a été déposée.  Cliquez sur le lien suivant pour consulter cette offre d’emploi et autoriser ou refuser sa publication : ".$link."<br />
			<br />
			Merci.<br />
			<img src='".$foot."'>";
			$team="jose.fortuny@itga.fr";
			wp_mail($team, "Une nouvelle offre d’emploi standard en attente de modération", $message, $headers);
		}
	break;
	default :
		do_action( 'job_manager_job_submitted_content_' . str_replace( '-', '_', sanitize_title( $job->post_status ) ), $job );
	break;
endswitch;

do_action( 'job_manager_job_submitted_content_after', sanitize_title( $job->post_status ), $job );
