<?php
namespace app;
class set_cookies
{
	public function __construct()
	{
		add_action( 'job_manager_update_job_data',array ($this, 'set_cookies_job_manager_update_job_data'),20,2 );	

		add_action( 'job_manager_update_job_data',array ($this, 'inject_cookie_application_job_manager_update_job_data') );
		add_action( 'job_manager_update_job_data',array ($this, 'inject_cookie_cname_job_manager_update_job_data') );
		add_action( 'job_manager_update_job_data',array ($this, 'inject_cookie_cwebsite_job_manager_update_job_data') );
		add_action( 'job_manager_update_job_data',array ($this, 'inject_cookie_ctagline_job_manager_update_job_data') );
		add_action( 'job_manager_update_job_data',array ($this, 'inject_cookie_cvideo_job_manager_update_job_data') );
		add_action( 'job_manager_update_job_data',array ($this, 'inject_cookie_ctwitter_job_manager_update_job_data') );
		add_action( 'job_manager_update_job_data',array ($this, 'inject_cookie_cfacebook_job_manager_update_job_data') );
		add_action( 'job_manager_update_job_data',array ($this, 'inject_cookie_clinkedin_job_manager_update_job_data') );
		/*add_action( 'job_manager_update_job_data',array ($this, 'inject_cookie_cprofil_job_manager_update_job_data') );*/
		add_action( 'job_manager_update_job_data',array ($this, 'inject_cookie_crh_job_manager_update_job_data') );
		add_action( 'job_manager_update_job_data',array ($this, 'inject_cookie_cprenomrh_job_manager_update_job_data') );
		add_action( 'job_manager_update_job_data',array ($this, 'inject_cookie_ctelrh_job_manager_update_job_data') );
		add_action( 'job_manager_update_job_data',array ($this, 'inject_cookie_cmailrh_job_manager_update_job_data') );

		add_filter( 'submit_job_form_fields',array ($this, 'add_values_cookie_application') );
		add_filter( 'submit_job_form_fields_get_user_data',array ($this, 'add_values_cookie_application') );
		add_filter( 'submit_job_form_fields',array ($this, 'add_values_cookie_cname') );
		add_filter( 'submit_job_form_fields_get_user_data',array ($this, 'add_values_cookie_cname') );
		add_filter( 'submit_job_form_fields',array ($this, 'add_values_cookie_cwebsite') );
		add_filter( 'submit_job_form_fields_get_user_data',array ($this, 'add_values_cookie_cwebsite') );
		add_filter( 'submit_job_form_fields',array ($this, 'add_values_cookie_ctagline') );
		add_filter( 'submit_job_form_fields_get_user_data',array ($this, 'add_values_cookie_ctagline') );
		add_filter( 'submit_job_form_fields',array ($this, 'add_values_cookie_cvideo') );
		add_filter( 'submit_job_form_fields_get_user_data',array ($this, 'add_values_cookie_cvideo') );
		add_filter( 'submit_job_form_fields',array ($this, 'add_values_cookie_ctwitter') );
		add_filter( 'submit_job_form_fields_get_user_data',array ($this, 'add_values_cookie_ctwitter') );
		add_filter( 'submit_job_form_fields',array ($this, 'add_values_cookie_cfacebook') );
		add_filter( 'submit_job_form_fields_get_user_data',array ($this, 'add_values_cookie_cfacebook') );
		add_filter( 'submit_job_form_fields',array ($this, 'add_values_cookie_clinkedin') );
		add_filter( 'submit_job_form_fields_get_user_data',array ($this, 'add_values_cookie_clinkedin') );
		/*add_filter( 'submit_job_form_fields',array ($this, 'add_values_cookie_cprofil') );
		add_filter( 'submit_job_form_fields_get_user_data',array ($this, 'add_values_cookie_cprofil') );*/
		add_filter( 'submit_job_form_fields',array ($this, 'add_values_cookie_crh') );
		add_filter( 'submit_job_form_fields_get_user_data',array ($this, 'add_values_cookie_crh') );
		add_filter( 'submit_job_form_fields',array ($this, 'add_values_cookie_cprenomrh') );
		add_filter( 'submit_job_form_fields_get_user_data',array ($this, 'add_values_cookie_cprenomrh') );
		add_filter( 'submit_job_form_fields',array ($this, 'add_values_cookie_ctelrh') );
		add_filter( 'submit_job_form_fields_get_user_data',array ($this, 'add_values_cookie_ctelrh') );
		add_filter( 'submit_job_form_fields',array ($this, 'add_values_cookie_cmailrh') );
		add_filter( 'submit_job_form_fields_get_user_data',array ($this, 'add_values_cookie_cmailrh') );

	}
	/**
	*Creation de cookies apres la dépose d'une annonce
	*/
	public function set_cookies_job_manager_update_job_data(){	
		if(isset( $_POST['application'] ))
		{   
			$application=sanitize_text_field($_POST['application']);
			setcookie( 'application', $application, time() + 365 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}
		if(isset( $_POST['company_name'] ))
		{   
			$c_name=sanitize_text_field($_POST['company_name']);
			setcookie( 'c_name', $c_name, time() + 365 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}
		if(isset( $_POST['company_website'] ))
		{
			$c_website=sanitize_text_field($_POST['company_website']);
			setcookie( 'c_website', $c_website, time() + 365 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}
		if(isset( $_POST['company_tagline'] ))
		{
			$c_tagline=sanitize_textarea_field($_POST['company_tagline']);
			setcookie( 'c_tagline', $c_tagline, time() + 365 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}
		if(isset( $_POST['company_video'] ))
		{
			$c_video=sanitize_text_field($_POST['company_video']);
			setcookie( 'c_video', $c_video, time() + 365 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}
		if(isset( $_POST['company_twitter'] ))
		{
			$c_twitter=sanitize_text_field($_POST['company_twitter']);
			setcookie( 'c_twitter', $c_twitter, time() + 365 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}
		if(isset( $_POST['company_facebook'] ))
		{
			$c_facebook=sanitize_textarea_field($_POST['company_facebook']);
			setcookie( 'c_facebook', $c_facebook, time() + 365 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}
		if(isset( $_POST['company_linkedin'] ))
		{
			$c_linkedin=sanitize_textarea_field($_POST['company_linkedin']);
			setcookie( 'c_linkedin', $c_linkedin, time() + 365 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}
		/*if(isset( $_POST['company_profil'] ))
		{
			$c_profil=sanitize_textarea_field($_POST['company_profil']);
			setcookie( 'c_profil', $c_profil, time() + 365 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}*/
		if(isset( $_POST['company_rh'] ))
		{
			$c_rh=sanitize_textarea_field($_POST['company_rh']);
			setcookie( 'c_rh', $c_rh, time() + 365 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}
		if(isset( $_POST['company_prenomrh'] ))
		{
			$c_prenomrh=sanitize_textarea_field($_POST['company_prenomrh']);
			setcookie( 'c_prenomrh', $c_prenomrh, time() + 365 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}
		if(isset( $_POST['company_telrh'] ))
		{
			$c_telrh=sanitize_textarea_field($_POST['company_telrh']);
			setcookie( 'c_telrh', $c_telrh, time() + 365 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}
		if(isset( $_POST['company_mailrh'] ))
		{
			$c_mailrh=sanitize_textarea_field($_POST['company_mailrh']);
			setcookie( 'c_mailrh', $c_mailrh, time() + 365 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
		}
	}
	/**
	* Injection du contenu du cookie application dans la BDD
	* @var string $sentence 
	*/
	public function inject_cookie_application_job_manager_update_job_data($sentence)
	{
		$cookie='application';
		if(isset($_COOKIE[$cookie]))
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$sentence=update_user_meta( get_current_user_id(), '_application', isset( $value) ? $value : '' );

		}
		return $sentence;
	}
	/**
	* Injection du contenu du cookie c_name dans la BDD
	* @var string $sentence 
	*/
	public function inject_cookie_cname_job_manager_update_job_data($sentence)
	{
		$cookie='c_name';
		if(isset($_COOKIE[$cookie]))
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$sentence=update_user_meta( get_current_user_id(), '_company_name', isset( $value) ? $value : '' );

		}
		return $sentence;
	}
	/**
	* Injection du contenu du cookie c_name dans la BDD
	* @var string $sentence 
	*/
	public function inject_cookie_cwebsite_job_manager_update_job_data($sentence)
	{
		$cookie='c_website';
		if(isset($_COOKIE[$cookie]) )
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$sentence=update_user_meta( get_current_user_id(), '_company_website', isset( $value) ? $value : '' );

		}
		return $sentence;
	}
	/**
	* Injection du contenu du cookie c_tagline dans la BDD
	* @var string $sentence 
	*/
	public function inject_cookie_ctagline_job_manager_update_job_data($sentence)
	{
		$cookie='c_tagline';
		if(isset($_COOKIE[$cookie]) )
		{
			$value=sanitize_textarea_field($_COOKIE[$cookie]);
			$sentence=update_user_meta( get_current_user_id(), '_company_tagline', isset( $value) ? $value : '' );
		}
		return $sentence;
	}
	/**
	* Injection du contenu du cookie c_video dans la BDD
	* @var string $sentence 
	*/
	public function inject_cookie_cvideo_job_manager_update_job_data($sentence)
	{
		$cookie='c_video';
		if(isset($_COOKIE[$cookie]) )
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$sentence=update_user_meta( get_current_user_id(), '_company_video', isset( $value) ? $value : '' );
		}
		return $sentence;
	}
	/**
	* Injection du contenu du cookie c_twitter dans la BDD
	* @var string $sentence 
	*/
	public function inject_cookie_ctwitter_job_manager_update_job_data($sentence)
	{
		$cookie='c_twitter';
		if(isset($_COOKIE[$cookie]) )
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$sentence=update_user_meta( get_current_user_id(), '_company_twitter', isset( $value) ? $value : '' );
		}
		return $sentence;
	}
	/**
	* Injection du contenu du cookie c_facebook dans la BDD
	* @var string $sentence 
	*/
	public function inject_cookie_cfacebook_job_manager_update_job_data($sentence)
	{
		$cookie='c_facebook';
		if(isset($_COOKIE[$cookie]) )
		{
			$value=sanitize_textarea_field($_COOKIE[$cookie]);
			$sentence=update_user_meta( get_current_user_id(), '_company_facebook', isset( $value) ? $value : '' );
		}
		return $sentence;
	}
	/**
	* Injection du contenu du cookie c_linkedin dans la BDD
	* @var string $sentence 
	*/
	public function inject_cookie_clinkedin_job_manager_update_job_data($sentence)
	{
		$cookie='c_linkedin';
		if(isset($_COOKIE[$cookie]) )
		{
			$value=sanitize_textarea_field($_COOKIE[$cookie]);
			$sentence=update_user_meta( get_current_user_id(), '_company_linkedin', isset( $value) ? $value : '' );
		}
		return $sentence;
	}
	/**
	* Injection du contenu du cookie c_profil dans la BDD
	* @var string $sentence 
	*/
	public function inject_cookie_cprofil_job_manager_update_job_data($sentence)
	{
		$cookie='c_profil';
		if(isset($_COOKIE[$cookie]) )
		{
			$value=sanitize_textarea_field($_COOKIE[$cookie]);
			$sentence=update_user_meta( get_current_user_id(), '_company_profil', isset( $value) ? $value : '' );
		}
		return $sentence;
	}
	/**
	* Injection du contenu du cookie c_rh dans la BDD
	* @var string $sentence 
	*/
	public function inject_cookie_crh_job_manager_update_job_data($sentence)
	{
		$cookie='c_rh';
		if(isset($_COOKIE[$cookie]) && !is_user_logged_in() )
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$sentence=update_user_meta( get_current_user_id(), '_company_rh', isset( $value) ? $value : '' );
		}
		return $sentence;
	}
	/**
	* Injection du contenu du cookie c_prenomrh dans la BDD
	* @var string $sentence 
	*/
	public function inject_cookie_cprenomrh_job_manager_update_job_data($sentence)
	{
		$cookie='c_prenomrh';
		if(isset($_COOKIE[$cookie]) && !is_user_logged_in() )
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$sentence=update_user_meta( get_current_user_id(), '_company_prenomrh', isset( $value) ? $value : '' );
		}
		return $sentence;
	}
	/**
	* Injection du contenu du cookie c_telrh dans la BDD
	* @var string $sentence 
	*/
	public function inject_cookie_ctelrh_job_manager_update_job_data($sentence)
	{
		$cookie='c_telrh';
		if(isset($_COOKIE[$cookie]) && !is_user_logged_in() )
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$sentence=update_user_meta( get_current_user_id(), '_company_telrh', isset( $value) ? $value : '' );
		}
		return $sentence;
	}
	/**
	* Injection du contenu du cookie c_mailrh dans la BDD
	* @var string $sentence 
	*/
	public function inject_cookie_cmailrh_job_manager_update_job_data($sentence)
	{
		$cookie='c_mailrh';
		if(isset($_COOKIE[$cookie]) && !is_user_logged_in() )
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$sentence=update_user_meta( get_current_user_id(), '_company_mailrh', isset( $value) ? $value : '' );
		}
		return $sentence;
	}

	/**
	* Rempli le champ application du FRONTEND avec la valeur du cookies 'application'
	* @var array $fields 
	*/
	public function add_values_cookie_application($fields)
	{
		
		$cookie='application';
		if(isset($_COOKIE[$cookie]))
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$fields['job']['application']['value'] = $value;
		}

		return $fields;
	}
	/**
	* Rempli le champ company_name du FRONTEND avec la valeur du cookies 'c_name'
	* @var array $fields 
	*/
	public function add_values_cookie_cname($fields)
	{
		
		$cookie='c_name';
		if(isset($_COOKIE[$cookie]))
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$fields['company']['company_name']['value'] = $value;
		}

		return $fields;
	}
	/**
	* Rempli le champ company_website du FRONTEND avec la valeur du cookies 'c_website'
	* @var array $fields 
	*/
	public function add_values_cookie_cwebsite($fields)
	{
		
		$cookie='c_website';
		if(isset($_COOKIE[$cookie]))
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$fields['company']['company_website']['value'] = $value;
		}

		return $fields;
	}
	/**
	* Rempli le champ company_tagline du FRONTEND avec la valeur du cookies 'c_tagline'
	* @var array $fields 
	*/
	public function add_values_cookie_ctagline($fields)
	{
		
		$cookie='c_tagline';
		if(isset($_COOKIE[$cookie]))
		{
			$value=wp_unslash(wp_unslash(sanitize_textarea_field($_COOKIE[$cookie]) ) );
			$fields['company']['company_tagline']['value'] = $value;
		}

		return $fields;
	}
	/**
	* Rempli le champ company_video du FRONTEND avec la valeur du cookies 'c_video'
	* @var array $fields 
	*/
	public function add_values_cookie_cvideo($fields)
	{
		
		$cookie='c_video';
		if(isset($_COOKIE[$cookie]))
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$fields['company']['company_video']['value'] = $value;
		}

		return $fields;
	}
	/**
	* Rempli le champ company_twitter du FRONTEND avec la valeur du cookies 'c_twitter'
	* @var array $fields 
	*/
	public function add_values_cookie_ctwitter($fields)
	{
		
		$cookie='c_twitter';
		if(isset($_COOKIE[$cookie]))
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$fields['company']['company_twitter']['value'] = $value;
		}

		return $fields;
	}
	/**
	* Rempli le champ company_facebook du FRONTEND avec la valeur du cookies 'c_facebook'
	* @var array $fields 
	*/
	public function add_values_cookie_cfacebook($fields)
	{
		
		$cookie='c_facebook';
		if(isset($_COOKIE[$cookie]))
		{
			$value=wp_unslash(wp_unslash(sanitize_textarea_field($_COOKIE[$cookie])));
			$fields['company']['company_facebook']['value'] = $value;
		}

		return $fields;
	}
	/**
	* Rempli le champ company_linkedin du FRONTEND avec la valeur du cookies 'c_linkedin'
	* @var array $fields 
	*/
	public function add_values_cookie_clinkedin($fields)
	{
		
		$cookie='c_linkedin';
		if(isset($_COOKIE[$cookie]))
		{
			$value=wp_unslash(wp_unslash(sanitize_textarea_field($_COOKIE[$cookie])));
			$fields['company']['company_linkedin']['value'] = $value;
		}

		return $fields;
	}
	/**
	* Rempli le champ company_profil du FRONTEND avec la valeur du cookies 'c_profil'
	* @var array $fields 
	*/
	public function add_values_cookie_cprofil($fields)
	{
		
		$cookie='c_profil';
		if(isset($_COOKIE[$cookie]))
		{
			$value=sanitize_textarea_field($_COOKIE[$cookie]);
			$fields['company']['company_profil']['value'] = $value;
		}

		return $fields;
	}
	/**
	* Rempli le champ company_rh du FRONTEND avec la valeur du cookies 'c_rh'
	* @var array $fields 
	*/
	public function add_values_cookie_crh($fields)
	{
		
		$cookie='c_rh';
		if(isset($_COOKIE[$cookie]))
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$fields['company']['company_rh']['value'] = $value;
		}

		return $fields;
	}
	/**
	* Rempli le champ company_prenomrh du FRONTEND avec la valeur du cookies 'c_rh'
	* @var array $fields 
	*/
	public function add_values_cookie_cprenomrh($fields)
	{
		
		$cookie='c_prenomrh';
		if(isset($_COOKIE[$cookie]))
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$fields['company']['company_prenomrh']['value'] = $value;
		}

		return $fields;
	}	
	/**
	* Rempli le champ company_telrh du FRONTEND avec la valeur du cookies 'c_rh'
	* @var array $fields 
	*/
	public function add_values_cookie_ctelrh($fields)
	{
		
		$cookie='c_telrh';
		if(isset($_COOKIE[$cookie]))
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$fields['company']['company_telrh']['value'] = $value;
		}

		return $fields;
	}
	/**
	* Rempli le champ company_mailrh du FRONTEND avec la valeur du cookies 'c_rh'
	* @var array $fields 
	*/
	public function add_values_cookie_cmailrh($fields)
	{
		
		$cookie='c_mailrh';
		if(isset($_COOKIE[$cookie]))
		{
			$value=sanitize_text_field($_COOKIE[$cookie]);
			$fields['company']['company_mailrh']['value'] = $value;
		}

		return $fields;
	}	
}