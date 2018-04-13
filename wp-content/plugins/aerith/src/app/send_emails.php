<?php
namespace app;
class send_emails
{
	public function __construct()
	{
		add_filter( 'wp_mail_from',array ($this, 'my_mail_from' ) );
		add_filter( 'wp_mail_from_name',array ($this, 'my_mail_from_name' ) );

		add_action('pending_to_publish',array ($this, 'listing_published_send_email') );

		add_action('pending_to_pending',array ($this, 'listing_not_published_send_email') );

		add_action('transition_post_status',array ($this, 'listing_expired_send_email'), 10, 3 );
	}
	/**
	* change l'adresse mail "émettrice des mails automatiques"
	*/
	public function my_mail_from( $email ) {
    	return "dimagjob@dimag.fr";
	}
	/**
	* change le nom de l'émetteur des mails automatiques"
	*/
	public function my_mail_from_name( $name ) {
    	return "DIMAGJOB";
	}

	/**
	* Envois un mail au recruteur lors de la validation d'une annonce
	*/
	public function listing_published_send_email($post_id) {
		if( 'job_listing' != get_post_type( $post_id ) ) {
			return;
		}
		$post = get_post($post_id);
		$id = $post->ID;
		$author = get_post_meta( $id, '_application', true );
		$head = site_url()."/wp-content/uploads/2018/04/Header.jpg";
		$foot = site_url()."/wp-content/uploads/2018/04/Footer.jpg";
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$message = "<img src='".$head."'><br />Bonjour,<br /><br />L’équipe DimagJob a le plaisir de vous annoncer que votre offre d’emploi est publiée sur le site DimagJob pour une durée de 60 jours. <br />Vous pouvez consulter votre annonce sur le lien suivant <a href='".get_permalink( $post_id )."'>".$post->post_title."</a><br />Vous souhaitez poster une nouvelle offre d’emploi ? C’est par <a href='".site_url()."/publiez-une-annonce/'>ici !</a><br /><br />A bientôt sur DimagJob !<br /><img src='".$foot."'>";
		
		wp_mail($author, "Votre offre d’emploi est en ligne !", $message, $headers);
	}

	/**
	* Envois d'un mail au recruteur lors de la mise a la relecture d'une annonce
	*/
	public function listing_not_published_send_email($post_id) {
		if( 'job_listing' != get_post_type( $post_id ) ) {
			return;
		}
		$post = get_post($post_id);
		$id = $post->ID;
		$date= $post->post_date;
		$date=date('d-m-Y', strtotime($date));
		$author = get_post_meta( $id, '_application', true );
		$head = site_url()."/wp-content/uploads/2018/04/Header.jpg";
		$foot = site_url()."/wp-content/uploads/2018/04/Footer.jpg";
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$message = "<img src='".$head."'><br />Bonjour,<br /><br />Votre demande de publication de l’offre de \"".$post->post_title."\" publiée le ".$date." a été refusée.<br />Pour avoir plus d’informations veuillez contacter le 02 0202 020202.<br /><br />
		L'équipe Dimagjob.<br />
		<img src='".$foot."'>";

		wp_mail($author, "Information sur votre offre d’emploi ", $message,$headers);
	}
	/**
	* Envois d'un mail au recruteur lors de l'expiration d'une annonce
	*/
	public function listing_expired_send_email( $new_status, $old_status, $post ) {
	    if ( 'job_listing' !== $post->post_type || 'expired' !== $new_status || $old_status === $new_status ) {
	        return;
	    }
	    $post = get_post($post_id);
		$id = $post->ID;
		$author = get_post_meta( $id, '_application', true );
		$head = site_url()."/wp-content/uploads/2018/04/Header.jpg";
		$foot = site_url()."/wp-content/uploads/2018/04/Footer.jpg";
	 	$headers = array('Content-Type: text/html; charset=UTF-8');
	    $message = "<img src='".$head."'><br />Bonjour,<br /><br />Votre offre d’emploi \"<a href='".get_permalink( $post_id )."'>".$post->post_title."</a>\" a expirée et n’est donc plus visible sur le site DimagJob.<br />Vous souhaitez poster une nouvelle offre d’emploi ? C’est par <a href='".site_url()."/publiez-une-annonce/'>ici!</a><br /><br />A bientôt sur DimagJob !<br /><img src='".$foot."'>";
	    wp_mail( $author, "Votre offre d’emploi a expirée  !", $message, $headers );
	}
}