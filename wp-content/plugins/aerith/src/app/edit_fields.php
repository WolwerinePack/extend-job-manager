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

		add_shortcode( 'job_manager_companies_plus', array( $this, 'shortcode_plus' ) );

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
	    $fields['job']['job_location']['placeholder'] = "Par exemple : 13590 ou bien : Meyreuil";
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

	/**
	 * Register the `[job_manager_companies_plus]` shortcode.
	 *
	 * @since WP Job Manager - Company Profiles 1.0
	 *
	 * @param array $atts
	 * @return string The shortcode HTML output
	 */
	public function shortcode_plus( $atts ) {
		$atts = shortcode_atts( array(
			'show_letters' => true
		), $atts );

		wp_enqueue_script( 'jquery-masonry' );
	?>
		<script type="text/javascript">
		jQuery(function($) {
			$('.companies-overview').masonry({
				itemSelector : '.company-group',
				isFitWidth   : true
			});
		});
		</script>
	<?php
	return $this->build_company_archive_plus( $atts );
	}

	/**
	 * Ajoute un nouveau shortcode afin d'afficher les clients PREMIUM
	 *
	 * Not very flexible at the moment. Only can deal with english letters.
	 *
	 * @since WP Job Manager - Company Profiles 1.0
	 *
	 * @param array $atts
	 * @return string The shortcode HTML output
	 */
	public function build_company_archive_plus( $atts ) {
		global $wpdb;
		$output      = '';
		$companies   = $wpdb->get_col(
			"SELECT p.post_title FROM {$wpdb->postmeta} pm
			 LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
			 WHERE p.post_status = 'publish'
			 AND p.post_type = 'post'
			 GROUP BY p.post_title
			 ORDER BY p.post_title"
		);
		$_companies = array();
		$_companieslogo = array();
		foreach ( $companies as $company ) {
			$_companies[ strtoupper( $company[0] ) ][] = $company;						
		}

		if ( $atts[ 'show_letters' ] ) {
			$output .= '<div class="company-letters">';

			foreach ( range( 'A', 'Z' ) as $letter ) {
				$output .= '<a href="#' . $letter . '">' . $letter . '</a>';
			}

			$output .= '</div>';
		}

		$output .= '<ul class="companies-overview">';

		foreach ( range( 'A', 'Z' ) as $letter ) {
			if ( ! isset( $_companies[ $letter ] ) )
				continue;

			$output .= '<li class="company-group-modif"><div id="' . $letter . '" class="company-letter-modif">' . $letter . '</div>';
			$output .= '<ul class="companies-overview">';

			foreach ( $_companies[ $letter ] as $company_name ) {
				$companieid=$wpdb->get_col(
					"SELECT p.ID FROM {$wpdb->posts} p 
					 WHERE p.post_title = '$company_name' 
					 AND p.post_type='post'");
				$companielogo =	$wpdb->get_col(
					"SELECT p.guid FROM {$wpdb->posts} p 
					 WHERE p.post_parent = '$companieid[0]'
					 AND p.post_type = 'attachment'");
				$output .= '<li class="company-group"><div class="company-letter"><img src="'.$companielogo[0].'"></div><div class="conteneurglobal"><p>' . esc_attr( $company_name ) . '</p><a href="' . site_url().'/'. $company_name  . '">en savoir plus</a></div></li>';
			}

			$output .= '</ul>';
			$output .= '</li>';
		}

		$output .= '</ul>';

		return $output;
	}
}