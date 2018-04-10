<?php
namespace app;
class edit_fields
{
	public function __construct()
	{
		add_filter( 'submit_job_form_show_signin',array ($this, 'submit_job_form_show_signin_false') );

		add_filter( 'submit_job_form_fields',array ($this, 'custom_job_title_submit_job_form_fields') );

		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'custom_filled_job_manager_job_listing_data_fields') );
		
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'custom_featured_job_manager_job_listing_data_fields') );

		add_filter( 'submit_job_form_fields',array ($this, 'custom_job_location_submit_job_form_fields') );
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'custom_job_location_job_manager_job_listing_data_fields') );

		add_filter( 'submit_job_form_fields',array ($this, 'custom_job_type_submit_job_form_fields') );		

		add_filter( 'submit_job_form_fields',array ($this, 'custom_job_description_job_form_fields') );

		add_filter( 'submit_job_form_fields',array ($this, 'custom_application_job_form_fields') );
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'custom_application_job_manager_job_listing_data_fields') );

		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'hide_job_author_job_listing_data_fields') );

		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'custom_company_name_job_listing_data_fields') );

		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'custom_company_website_job_listing_data_fields') );

		add_filter( 'submit_job_form_fields',array ($this, 'custom_company_tagline_submit_job_form_fields') );
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'custom_company_tagline_job_listing_data_fields') );

		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'custom_company_video_job_listing_data_fields') );

		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'custom_company_twitter_job_listing_data_fields') );

		add_filter( 'submit_job_form_fields',array ($this, 'custom_company_logo_job_form_fields') );

	}

	/**
	* Empeche l'apparition du champ "votre compte" du FRONTEND
	*/
	public function submit_job_form_show_signin_false() {
		return false;
	}

	/**
	* Modifie le label du champ job_title du FRONTEND
	* @var array $fields 
	*/
	public function custom_job_title_submit_job_form_fields( $fields ) {
	    $fields['job']['job_title']['label'] = "Intitulé du poste";
	    return $fields;
	}

	/**
	* Modifie la priorite de la checkbox '_featured' du BACKEND
	* @var array $fields
	*/
	public function custom_featured_job_manager_job_listing_data_fields( $fields )
	{
		$fields['_featured']['priority'] = -1;
		return $fields;
	}

	/**
	* Modifie la priorite de la checkbox '_filled' du BACKEND
	* @var array $fields
	*/
	public function custom_filled_job_manager_job_listing_data_fields( $fields )
	{
		$fields['_filled']['priority'] = 0;
		return $fields;
	}

	/**
	* Modifie le label et le placeholder du champ job_location du FRONTEND
	* @var array $fields
	*/
	public function custom_job_location_submit_job_form_fields( $fields ) {
	    $fields['job']['job_location']['label'] = "Code postal";
	    $fields['job']['job_location']['required'] = "true";
	    $fields['job']['job_location']['placeholder'] = "Par exemple : 13590";
	    $fields['job']['job_location']['description'] = "";
	    return $fields;
	}
	/**
	* Modifie le label et le placeholder du champ job_location du BACKEND
	* @var array $fields
	*/
	public function custom_job_location_job_manager_job_listing_data_fields( $fields ) {
		$fields['_job_location']['label'] = "Code postal";
	    $fields['_job_location']['placeholder'] = "Par exemple : 13590";
	    return $fields;
	}

	/**
	* Modifie le type d'input du champ job_type du FRONTEND
	* @var array $fields
	*/
	public function custom_job_type_submit_job_form_fields( $fields ) {
		$keys=get_terms( array(
			'taxonomy' => 'job_listing_type',
    		'hide_empty' => false,  ) );
		foreach ( $keys as $key)
		{
			$options[$key->slug]=$key->name;
		}
	    $fields['job']['job_type']['type'] = "radio";
	    $fields['job']['job_type']['options'] = $options;
	    return $fields;
	}
	/**
	* Modifie la priorite du champ job_description du FRONTEND
	* @var array $fields
	*/
	public function custom_job_description_job_form_fields( $fields ) {
		$fields['job']['job_description']['priority'] = 10;
		return $fields;
	}

	/**
	* Modifie le nom la priorite et la description du champ application du FRONTEND
	* @var array $fields:
	*/
	public function custom_application_job_form_fields( $fields ) {
		$fields['job']['application']['label'] = 'Courriel recruteur';
		$fields['job']['application']['priority'] = 11;
		$fields['job']['application']['description'] = 'ce champ n\'apparaitra pas dans l\'annonce , ce courriel ne sert que pour vous envoyer les candidatures';
		return $fields;
	}
	/**
	* Modifie la priorite du champ _application du BACKEND
	* @var array $fields:
	*/
	public function custom_application_job_manager_job_listing_data_fields( $fields ) {
		$fields['_application']['label'] = 'Email pour postuler';
		$fields['_application']['priority'] = 11;
		return $fields;
	}

	/** Masque le champ _job_author du BACKEND
	*
	*/
	public function hide_job_author_job_listing_data_fields( $fields)
	{
		unset($fields['_job_author']);
		return $fields;
	}

	/**
	* Modifie la priorite du champ _company_name du BACKEND
	* @var array $fields
	*/
	public function custom_company_name_job_listing_data_fields( $fields )
	{
		$fields['_company_name']['priority'] = 12;
		return $fields;
	}

	/**
	* Modifie la priorite du champ _company_website du BACKEND
	* @var array $fields
	*/
	public function custom_company_website_job_listing_data_fields( $fields )
	{
		$fields['_company_website']['priority'] = 13;
		return $fields;
	}

	/**
	* Modifie le format et le nom du champ _company_tagline du FRONTEND
	* @var array $fields
	*/
	public function custom_company_tagline_submit_job_form_fields( $fields )
	{
		$fields['company']['company_tagline']['label'] = 'Description de la société';
		$fields['company']['company_tagline']['type'] = 'wp-editor';
		return $fields;
	}
	/**
	* Modifie la priorite du champ _company_tagline du BACKEND
	* @var array $fields
	*/
	public function custom_company_tagline_job_listing_data_fields( $fields )
	{
		$fields['_company_tagline']['priority'] = 14;
		return $fields;
	}

	/**
	* Modifie la priorite du champ _company_video du BACKEND
	* @var array $fields
	*/
	public function custom_company_video_job_listing_data_fields( $fields )
	{
		$fields['_company_video']['priority'] = 15;
		return $fields;
	}

	/**
	* Modifie la priorite du champ _company_twitter du BACKEND
	* @var array $fields
	*/
	public function custom_company_twitter_job_listing_data_fields( $fields )
	{
		$fields['_company_twitter']['priority'] = 16;
		return $fields;
	}

	/**
	* Modifie la priorite du champ company_logo du FRONTEND
	* @var array $fields:
	*/
	public function custom_company_logo_job_form_fields( $fields ) {
		$fields['company']['company_logo']['priority'] = 10;
		$fields['company']['company_logo']['description'] = "Taille conseillée pour un affichage optimum : 130 * 130 pixel . Taille du fichier limitée a 8mb";
		return $fields;
	}
		
}