<?php
namespace app;
class add_fields
{
	public function __construct()
	{
		add_filter( 'job_manager_get_listings',array ($this, 'filter_by_featured_field_query_args'), 10, 2 );

		add_filter( 'submit_job_form_fields',array ($this, 'add_premium_submit_job_form_fields') );

		add_filter( 'submit_job_form_fields',array ($this, 'add_job_expertise_submit_job_form_fields') );
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'add_job_expertise_job_manager_job_listing_data_fields') );
		add_action( 'single_job_listing_meta_end',array ($this, 'add_job_expertise_single_job_listing_meta_end') );
		add_filter( 'job_manager_job_filters_search_jobs_end',array ($this, 'add_job_expertise_job_manager_job_filters_search_jobs_end') );
		add_filter( 'job_manager_get_listings',array ($this, 'filter_by_expertise_field_query_args'), 10, 2 );

		add_filter( 'submit_job_form_fields',array ($this, 'add_job_profil_submit_job_form_fields') );
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'add_job_profil_job_manager_job_listing_data_fields') );
		add_action( 'single_job_listing_meta_end',array ($this, 'add_job_profil_single_job_listing_meta_end') );
		add_filter( 'job_manager_job_filters_search_jobs_end',array ($this, 'add_job_profil_job_manager_job_filters_search_jobs_end') );
		add_filter( 'job_manager_get_listings',array ($this, 'filter_by_profil_field_query_args'), 10, 2 );

		add_filter( 'submit_job_form_fields',array ($this, 'add_job_diag_submit_job_form_fields') );
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'add_job_diag_job_manager_job_listing_data_fields') );
		add_filter( 'single_job_listing_meta_end',array($this, 'add_job_diag_single_job_listing_meta_end') );
		add_filter( 'job_manager_job_filters_search_jobs_end',array ($this, 'add_job_diag_job_manager_job_filters_search_jobs_end') );
		add_filter( 'job_manager_get_listings',array ($this, 'filter_by_diag_field_query_args'), 10, 2 );

		add_filter( 'submit_job_form_fields',array ($this, 'add_job_exp_submit_job_form_fields') );
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'add_job_exp_job_manager_job_listing_data_fields') );
		add_filter( 'single_job_listing_meta_end',array($this, 'add_job_exp_single_job_listing_meta_end') );
		add_filter( 'job_manager_job_filters_search_jobs_end',array ($this, 'add_job_exp_job_manager_job_filters_search_jobs_end') );
		add_filter( 'job_manager_get_listings',array ($this, 'filter_by_exp_field_query_args'), 10, 2 );

		add_filter( 'submit_job_form_fields',array ($this, 'add_job_salary_submit_job_form_fields') );
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'add_job_salary_job_manager_job_listing_data_fields') );
		add_filter( 'single_job_listing_meta_end',array ($this, 'add_job_salary_single_job_listing_meta_end') );
		add_filter( 'job_manager_job_filters_search_jobs_end',array ($this, 'add_job_salary_job_manager_job_filters_search_jobs_end') );
		add_filter( 'job_manager_get_listings',array ($this, 'filter_by_salary_field_query_args'), 10, 2 );

		/*add_filter( 'submit_job_form_fields',array ($this, 'add_job_zone_submit_job_form_fields') );
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'add_job_zone_job_manager_job_listing_data_fields') );*/
		add_filter( 'single_job_listing_meta_end',array ($this, 'add_job_zone_single_job_listing_meta_end') );
		add_filter( 'job_manager_job_filters_search_jobs_end',array ($this, 'add_job_zone_job_manager_job_filters_search_jobs_end') );
		add_filter( 'job_manager_get_listings',array ($this, 'filter_by_zone_field_query_args'), 10, 2 );

		/*add_filter( 'submit_job_form_fields',array ($this, 'add_company_why_submit_job_form_fields') );
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'add_company_why_job_manager_job_listing_data_fields') );

		add_filter( 'submit_job_form_fields',array ($this, 'add_company_number_submit_job_form_fields') );
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'add_company_number_job_manager_job_listing_data_fields') );

		add_filter( 'submit_job_form_fields',array ($this, 'add_company_profil_submit_job_form_fields') );
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'add_company_profil_job_manager_job_listing_data_fields') );

		add_filter( 'submit_job_form_fields',array ($this, 'add_company_rh_submit_job_form_fields') );
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'add_company_rh_job_manager_job_listing_data_fields') );*/

		add_action( 'job_manager_job_submitted_content_after',array ($this, 'add_button_job_manager_job_submitted_content_after') );

		add_filter( 'job_manager_job_filters_search_jobs_end',array ($this, 'add_reset_button_job_manager_job_filters_search_jobs_end') );

		add_action( 'init',array ($this, 'taxonomies_plusplus'), 0 );
	}
	/**
	* Ajoute une condition a la recherche pour ne pas afficher les annonces premium
	*/	
	public function filter_by_featured_field_query_args( $query_args, $args ) {
		if ( isset( $_POST['form_data'] ) ) {			
				$query_args['meta_query'][0] = array(
							'key'     => '_featured',
							'value'   => 0,
							'compare' => '=',
							'type'    => 'numeric'
						);
				// This will show the 'reset' link
				add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
		}
		return $query_args;
	}

	/**
	* Ajoute la checkbox premium au FRONTEND
	* @var array $fields
	*/
	public function add_premium_submit_job_form_fields( $fields ) {
		$fields['job']['premium'] = array(
			'label'       => __( 'Premium ?', 'job_manager' ),
			'type'        => 'checkbox',
			'description' => 'l\'option payante Premium , permet à votre annonce d\'avoir une meilleure visibilité',
			'required'    => false,
			'priority'    => 0,
		);
		return $fields;
	}

	/**
	* Ajoute le champ job_expertise au FRONTEND
	* @var array $fields 
	*/
	public function add_job_expertise_submit_job_form_fields( $fields ) {
		$fields['job']['job_expertise'] = array(
			'label'       => __( 'Champ d\'Expertise', 'job_manager' ),
			'type'        => 'multiselect',
			'required'    => true,
			'options' => array('Amiante AM/SM' => 'Amiante AM/SM', 'DPE AM/SM' => 'DPE AM/SM', 'Gaz' => 'Gaz', 'Elec' => 'Elec', 'Termites' => 'Termites', 'Termites DOM-TOM' => 'Termites DOM-TOM', 'Plomb' => 'Plomb', 'ERNMT' => 'ERNMT', 'Carrez' => 'Carrez'),
			'placeholder' => 'Selectionnez au moins un champ d\'expertise',
			'default'     => 'Amiante AM/SM',
			'priority'    => 4
	  	);
		return $fields;
	}
	/**
	* Ajoute le champ job_expertise au BACKEND
	* @var array $fields 
	*/
	public function add_job_expertise_job_manager_job_listing_data_fields( $fields )  {
		$fields['_job_expertise'] = array(
			'label'       => __( 'Champ d\'Expertise', 'job_manager' ),
			'type'        => 'multiselect',
			'required'    => true,
			'options' => array('Amiante AM/SM' => 'Amiante AM/SM', 'DPE AM/SM' => 'DPE AM/SM', 'Gaz' => 'Gaz', 'Elec' => 'Elec', 'Termites' => 'Termites', 'Termites DOM-TOM' => 'Termites DOM-TOM', 'Plomb' => 'Plomb', 'ERNMT' => 'ERNMT', 'Carrez' => 'Carrez'),
			'placeholder' => '',
			'default'     => 'Amiante AM/SM',
			'priority'    => 5
		);
		return $fields;
	}
	/**
	* Ajoute le champ job_expertise a la fiche du JOB
	*/
	public function add_job_expertise_single_job_listing_meta_end() {
  		
  		global $post;
  		$profil = get_post_meta( $post->ID, '_job_profil', true );
		if ( $profil ) {
    		echo '<li>' . __( 'Champ d\'Expertise: ' ) . esc_html( $profil ) . '</li>';
  		}
	}
	/**
	* Ajout du champ de filtrage job_expertise a la recherche de job
	*/
	public function add_job_expertise_job_manager_job_filters_search_jobs_end() {
		?>
			<p id="1" class="default">Champ d'Expertise :
				<ul class="job_types default" id="10">
					<li><label for="job_expertise_0"><input name="filter_by_expertise[]" value="Amiante AM/SM" checked="checked" id="job_expertise_0" type="checkbox"> Amiante AM/SM</label></li>
					<li><label for="job_expertise_1"><input name="filter_by_expertise[]" value="DPE AM/SM" checked="checked" id="job_expertise_1" type="checkbox"> DPE AM/SM</label></li>
					<li><label for="job_expertise_2"><input name="filter_by_expertise[]" value="Gaz" checked="checked" id="job_expertise_2" type="checkbox"> Gaz</label></li>
					<li><label for="job_expertise_3"><input name="filter_by_expertise[]" value="Elec" checked="checked" id="job_expertise_3" type="checkbox"> Elec</label></li>
					<li><label for="job_expertise_4"><input name="filter_by_expertise[]" value="Termites" checked="checked" id="job_expertise_4" type="checkbox"> Termites</label></li>
					<li><label for="job_expertise_5"><input name="filter_by_expertise[]" value="Termites DOM-TOM" checked="checked" id="job_expertise_5" type="checkbox"> Termites DOM-TOM</label></li>
					<li><label for="job_expertise_6"><input name="filter_by_expertise[]" value="Plomb" checked="checked" id="job_expertise_6" type="checkbox"> Plomb</label></li>
					<li><label for="job_expertise_7"><input name="filter_by_expertise[]" value="ERNMT" checked="checked" id="job_expertise_7" type="checkbox"> ERNMT</label></li>
					<li><label for="job_expertise_8"><input name="filter_by_expertise[]" value="Carrez" checked="checked" id="job_expertise_8" type="checkbox"> Carrez</label></li>
					<input name="filter_by_expertise[]" value="" type="hidden">		
				</ul>
			</p>
		<?php
	}
	/**
	* Construction des arguments pour le filtre job_expertise dans la recherche de JOB
	* @var array $query_args
	*/
	public function filter_by_expertise_field_query_args( $query_args, $args ) {
		if ( isset( $_POST['form_data'] ) ) {
			parse_str( $_POST['form_data'], $form_data );
			// If this is set, we are filtering by expertise
			if ( ! empty( $form_data['filter_by_expertise'] ) )
			{
				$query_args['meta_query'][1] = array('relation' => 'OR');
				foreach ($form_data['filter_by_expertise'] as $key => $value)
				{
					$selected_range = sanitize_text_field( $value );
					$query_args['meta_query'][1][] = 
						array(
								'key'     => '_job_expertise',
								'value'   => serialize( $selected_range),
								'compare' => 'LIKE',
							);
				}
				// This will show the 'reset' link
				add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
			}
		}
		return $query_args;
	}

	/**
	* Ajoute le champ job_profil au FRONTEND
	* @var array $fields 
	*/
	public function add_job_profil_submit_job_form_fields( $fields ) {
		$fields['job']['job_profil'] = array(
			'label'       => __( 'Profil', 'job_manager' ),
			'type'        => 'radio',
			'required'    => true,
			 'options' => array('Technicien Diagnostiqueur' => 'Technicien Diagnostiqueur', 'Manageur Entrepreneur' => 'Manageur Entrepreneur', 'Poste Admin' => 'Poste Admin'),
			'placeholder' => '',
			'default'     => 'Technicien Diagnostiqueur',
			'priority'    => 4
	  	);
		return $fields;
	}
	/**
	* Ajoute le champ job_profil au BACKEND
	* @var array $fields 
	*/
	public function add_job_profil_job_manager_job_listing_data_fields( $fields )  {
		$fields['_job_profil'] = array(
			'label'       => __( 'Profil', 'job_manager' ),
			'type'        => 'radio',
			'required'    => true,
			'options' => array('Technicien Diagnostiqueur' => 'Technicien Diagnostiqueur', 'Manageur Entrepreneur' => 'Manageur Entrepreneur', 'Poste Admin' => 'Poste Admin'),
			'placeholder' => '',
			'default'     => 'Technicien Diagnostiqueur',
			'priority'    => 5
		);
		return $fields;
	}
	/**
	* Ajoute le champ job_profil a la fiche du JOB
	*/
	public function add_job_profil_single_job_listing_meta_end() {
  		
  		global $post;
  		$profil = get_post_meta( $post->ID, '_job_profil', true );
		if ( $profil ) {
    		echo '<li>' . __( 'Profil: ' ) . esc_html( $profil ) . '</li>';
  		}
	}
	/**
	* Ajout du champ de filtrage job_profil a la recherche de job
	*/
	public function add_job_profil_job_manager_job_filters_search_jobs_end() {
		?>
		<p id="2"  class="default">Profil :
			<ul class="job_types default" id="20">
				<li><label for="job_profil_0"><input name="filter_by_profil[]" value="Technicien Diagnostiqueur" checked="checked" id="job_profil_0" type="checkbox"> Technicien Diagnostiqueur</label></li>
				<li><label for="job_profil_1"><input name="filter_by_profil[]" value="Manageur Entrepreneur" checked="checked" id="job_profil_1" type="checkbox"> Manageur Entrepreneur</label></li>
				<li><label for="job_profil_2"><input name="filter_by_profil[]" value="Poste Admin" checked="checked" id="job_profil_2" type="checkbox"> Poste Admin</label></li>
				<input name="filter_by_profil[]" value="" type="hidden">		
			</ul>
		</p>
		<?php
	}
	/**
	* Construction des arguments pour le filtre job_profil dans la recherche de JOB
	* @var array $query_args
	*/
	public function filter_by_profil_field_query_args( $query_args, $args ) {
		if ( isset( $_POST['form_data'] ) ) {
			parse_str( $_POST['form_data'], $form_data );
			// If this is set, we are filtering by profil
			if ( ! empty( $form_data['filter_by_profil'] ) )
			{
				$query_args['meta_query'][2] = array('relation' => 'OR');
				foreach ($form_data['filter_by_profil'] as $key => $value)
				{
					$selected_range = sanitize_text_field( $value );
					$query_args['meta_query'][2][] = 
						array(
								'key'     => '_job_profil',
								'value'   => serialize( $selected_range ),
								'compare' => 'LIKE',
							);
				}
				// This will show the 'reset' link
				add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
			}
		}
		return $query_args;
	}

	/**
	* Ajoute le champ job_diag au FRONTEND
	* @var array $fields 
	*/
	public function add_job_diag_submit_job_form_fields( $fields ) {
		$fields['job']['job_diag'] = array(
			'label'       => __( 'Type de diagnostique', 'job_manager' ),
			'type'        => 'multiselect',
			'required'    => true,
			'options' => array('Locatif' => 'Locatif', 'Vente' => 'Vente', 'Avant-travaux' => 'Avant-travaux', 'Après-travaux' => 'Après-travaux', 'Avant-démolition' => 'Avant-démolition'),			
			'default' => 'Locatif',
			'priority'    => 6
	  	);
		return $fields;
	}
	/**
	* Ajoute le champ job_diag au BACKEND
	* @var array $fields 
	*/
	public function add_job_diag_job_manager_job_listing_data_fields( $fields )  {
		$fields['_job_diag'] = array(
			'label'       => __( 'Type de diagnostique', 'job_manager' ),
			'type'        => 'select',
			'options' => array('Locatif' => 'Locatif', 'Vente' => 'Vente', 'Avant-travaux' => 'Avant-travaux', 'Après-travaux' => 'Après-travaux', 'Avant-démolition' => 'Avant-démolition'),
			'description' => '',
			'priority'    => 7
		);
		return $fields;
	}
	/**
	* Ajoute le champ job_diag a la fiche du JOB
	*/
	public function add_job_diag_single_job_listing_meta_end() {
  		
  		global $post;
  		$diag = get_post_meta( $post->ID, '_job_diag', true );
		if ( $diag ) {
    		echo '<li>' . __( 'Type de diagnostique: ' ) . esc_html( $diag ) . '</li>';
  		}
	}
	/**
	* Ajout du champ de filtrage job_diag a la recherche de job
	*/
	public function add_job_diag_job_manager_job_filters_search_jobs_end() {
		?>
		<p id="3" class="default">Diagnostique :
			<ul class="job_types default"  id="30">
				<li><label for="job_diag_0"><input name="filter_by_diag[]" value="Locatif" checked="checked" id="job_diag_0" type="checkbox"> Locatif</label></li>
				<li><label for="job_diag_1"><input name="filter_by_diag[]" value="Vente" checked="checked" id="job_diag_1" type="checkbox"> Vente</label></li>
				<li><label for="job_diag_2"><input name="filter_by_diag[]" value="Avant-travaux" checked="checked" id="job_diag_2" type="checkbox"> Avant-travaux</label></li>
				<li><label for="job_diag_3"><input name="filter_by_diag[]" value="Après-travaux" checked="checked" id="job_diag_3" type="checkbox"> Après-travaux</label></li>
				<li><label for="job_diag_4"><input name="filter_by_diag[]" value="Avant-démolition" checked="checked" id="job_diag_4" type="checkbox"> Avant-démolition</label></li>
				<input name="filter_by_diag[]" value="" type="hidden">		
			</ul>
		</p>
		<?php
	}
	/**
	* Construction des arguments pour le filtre job_diag dans la recherche de JOB
	* @var array $query_args
	*/
	public function filter_by_diag_field_query_args( $query_args, $args ) {
		if ( isset( $_POST['form_data'] ) ) {
			parse_str( $_POST['form_data'], $form_data );
			// If this is set, we are filtering by profil
			if ( ! empty( $form_data['filter_by_diag'] ) )
			{
				$query_args['meta_query'][3] = array('relation' => 'OR');
				foreach ($form_data['filter_by_diag'] as $key => $value)
				{
					$selected_range = sanitize_text_field( $value );
					$query_args['meta_query'][3][] = 
						array(
								'key'     => '_job_diag',
								'value'   => serialize( $selected_range ),
								'compare' => 'LIKE',
							);
				}
				// This will show the 'reset' link
				add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
			}
		}
		return $query_args;
	}

	/**
	* Ajoute le champ job_exp au FRONTEND
	* @var array $fields 
	*/
	public function add_job_exp_submit_job_form_fields( $fields ) {
		$fields['job']['job_exp'] = array(
			'label'       => __( 'Expérience', 'job_manager' ),
			'type'        => 'multiselect',
			'required'    => true,
			'options' => array('Débutant' => 'Débutant', '3 à 5 ans' => '3 à 5 ans', '6 à 9 ans' => '6 à 9 ans', '+ de 9 ans' => '+ de 9 ans'),
			'default' => 'Débutant',	
			'priority'    => 7
	  	);
		return $fields;
	}
	/**
	* Ajoute le champ job_exp au BACKEND
	* @var array $fields 
	*/
	public function add_job_exp_job_manager_job_listing_data_fields( $fields )  {
		$fields['_job_exp'] = array(
			'label'       => __( 'Expérience', 'job_manager' ),
			'type'        => 'multiselect',
			'options' => array('Débutant' => 'Débutant', '3 à 5 ans' => '3 à 5 ans', '6 à 9 ans' => '6 à 9 ans', '+ de 9 ans' => '+ de 9 ans'),	
			'description' => '',
			'priority'    => 8
		);
		return $fields;
	}
	/**
	* Ajoute le champ job_exp a la fiche du JOB
	*/
	public function add_job_exp_single_job_listing_meta_end() {  		
  		global $post;
  		$exp = get_post_meta( $post->ID, '_job_exp', true );
		if ( $exp ) {
    		echo '<li>' . __( 'Expérience: ' ) . esc_html( $exp ) . '</li>';
  		}
	}
	/**
	* Ajout du champ de filtrage job_exp a la recherche de job
	*/
	public function add_job_exp_job_manager_job_filters_search_jobs_end() {
		?>	
			<p  id="4" class="default">Expérience :
				<ul class="job_types default"  id="40">
					<li><label for="job_exp_0"><input name="filter_by_exp[]" value="Débutant" checked="checked" id="job_exp_0" type="checkbox"> Débutant</label></li>
					<li><label for="job_exp_1"><input name="filter_by_exp[]" value="3 à 5 ans" checked="checked" id="job_exp_1" type="checkbox"> 3 à 5 ans</label></li>
					<li><label for="job_exp_2"><input name="filter_by_exp[]" value="6 à 9 ans" checked="checked" id="job_exp_2" type="checkbox"> 6 à 9 ans</label></li>
					<li><label for="job_exp_3"><input name="filter_by_exp[]" value="+ de 9 ans" checked="checked" id="job_exp_3" type="checkbox"> + de 9 ans</label></li>
					<input name="filter_by_exp[]" value="" type="hidden">		
				</ul>
			</p>
		<?php
	}
	/**
	* Construction des arguments pour le filtre job_exp dans la recherche de JOB
	* @var array $query_args
	*/
	public function filter_by_exp_field_query_args( $query_args, $args ) {
		if ( isset( $_POST['form_data'] ) ) {
			parse_str( $_POST['form_data'], $form_data );
			// If this is set, we are filtering by profil
			if ( ! empty( $form_data['filter_by_exp'] ) )
			{
				$query_args['meta_query'][4] = array('relation' => 'OR');
				foreach ($form_data['filter_by_exp'] as $key => $value)
				{
					$selected_range = sanitize_text_field( $value );
					$query_args['meta_query'][4][] = 
						array(
								'key'     => '_job_exp',
								'value'   => serialize( $selected_range ),
								'compare' => 'LIKE',
							);
				}
				// This will show the 'reset' link
				add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
			}
		}
		return $query_args;
	}

	/**
	* Ajoute le champ job_salary au FRONTEND
	* @var array $fields 
	*/
	public function add_job_salary_submit_job_form_fields( $fields ) {
		$fields['job']['job_salary'] = array(
			'label'       => __( 'Salaire (€)', 'job_manager' ),
			'type'        => 'radio',
			'required'    => true,
			'options' => array('Non Rémunéré' => 'Non Rémunéré', '20000 - 25000' => '20000 - 25000', '25001 - 30000' => '25001 - 30000', '30001 - 35000' => '30001 - 35000'),
			'default' => 'Non Rémunéré',
			'priority'    => 8
	  	);
		return $fields;
	}
	/**
	* Ajoute le champ job_salary au BACKEND
	* @var array $fields 
	*/
	public function add_job_salary_job_manager_job_listing_data_fields( $fields )  {
		$fields['_job_salary'] = array(
			'label'       => __( 'Salaire (€)', 'job_manager' ),
			'type'        => 'radio',
			'options' => array('Non Rémunéré' => 'Non Rémunéré', '20000 - 25000' => '20000 - 25000', '25001 - 30000' => '25001 - 30000', '30001 - 35000' => '30001 - 35000'),
			'description' => '',
			'priority'    => 9
		);
		return $fields;
	}
	/**
	* Ajoute le champ job_salary a la fiche du JOB
	*/
	function add_job_salary_single_job_listing_meta_end() {
  		
  		global $post;
  		$salary = get_post_meta( $post->ID, '_job_salary', true );
		if ( $salary && $salary!=='Non Rémunéré') {
    		echo '<li>' . __( 'Salaire: ' ) . esc_html( $salary ) . '€/an</li>';
  		}
  		elseif ($salary==='Non Rémunéré') {
  			echo '<li>' . __( 'Salaire: ' ) . esc_html( $salary ).'</li>';
  		}
	}
	/**
	* Ajout du champ de filtrage job_salary a la recherche de job
	*/
	public function add_job_salary_job_manager_job_filters_search_jobs_end() {
		?>
		<p id="5" class="default">Salaire :
			<ul class="job_types default"  id="50">
				<li><label for="job_salary_0"><input name="filter_by_salary[]" value="Non Rémunéré" checked="checked" id="job_salary_0" type="checkbox"> Non Rémunéré</label></li>
				<li><label for="job_salary_1"><input name="filter_by_salary[]" value="20000 - 25000" checked="checked" id="job_salary_1" type="checkbox"> De 20,000 à 25,000</label></li>
				<li><label for="job_salary_2"><input name="filter_by_salary[]" value="25001 - 30000" checked="checked" id="job_salary_2" type="checkbox"> De 25,001 à 30,000</label></li>
				<li><label for="job_salary_3"><input name="filter_by_salary[]" value="30001 - 35000" checked="checked" id="job_salary_3" type="checkbox"> De 30,001 à 35,000</label></li>
				<input name="filter_by_salary[]" value="" type="hidden">		
			</ul>
		</p>
		<?php 
	}
	/**
	* Construction des arguments pour le filtre job_salary dans la recherche de JOB
	* @var array $query_args
	*/
	public function filter_by_salary_field_query_args( $query_args, $args ) {
		if ( isset( $_POST['form_data'] ) ) {
			parse_str( $_POST['form_data'], $form_data );
			// If this is set, we are filtering by salary
			if ( ! empty( $form_data['filter_by_salary'] ) )
			{
				$query_args['meta_query'][5] = array('relation' => 'OR');
				foreach ($form_data['filter_by_salary'] as $key => $value)
				{
					$selected_range = sanitize_text_field( $value );
					$query_args['meta_query'][5][] = 
						array(
								'key'     => '_job_salary',
								'value'   => serialize( $selected_range ),
								'compare' => 'LIKE',
							);
				}
				// This will show the 'reset' link
				add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
			}
		}
		return $query_args;
	}	

	/**
	* Ajoute le champ job_zone au FRONTEND
	* @var array $fields 
	*/
	public function add_job_zone_submit_job_form_fields( $fields ) {
		$fields['job']['job_zone'] = array(
			'label'       => __( 'Région', 'job_manager' ),
			'type'        => 'select',
			'required'    => false,
			'options' => array('', 'Auvergne - Rhône-Alpes' => 'Auvergne - Rhône-Alpes', 'Bourgogne - Franche-Comté' => 'Bourgogne - Franche-Comté', 'Bretagne' => 'Bretagne', 'Centre - Val de Loire' => 'Centre - Val de Loire', 'Corse' => 'Corse', 'Grand Est' => 'Grand Est', 'Hauts-de-France' => 'Hauts-de-France', 'Île-de-France' => 'Île-de-France', 'Normandie' => 'Normandie', 'Nouvelle-Aquitaine' => 'Nouvelle-Aquitaine', 'Occitanie' => 'Occitanie', 'Pays de la Loire' => 'Pays de la Loire', 'Provence - Alpes - Côte d’Azur' => 'Provence - Alpes - Côte d’Azur'),
			'default' => '',	
			'priority'    => 9
	  	);
		return $fields;
	}
	/**
	* Ajoute le champ job_zone au BACKEND
	* @var array $fields 
	*/
	public function add_job_zone_job_manager_job_listing_data_fields( $fields )  {
		$fields['_job_zone'] = array(
			'label'       => __( 'Région', 'job_manager' ),
			'type'        => 'select',
			'options' => array('', 'Auvergne - Rhône-Alpes' => 'Auvergne - Rhône-Alpes', 'Bourgogne - Franche-Comté' => 'Bourgogne - Franche-Comté', 'Bretagne' => 'Bretagne', 'Centre - Val de Loire' => 'Centre - Val de Loire', 'Corse' => 'Corse', 'Grand Est' => 'Grand Est', 'Hauts-de-France' => 'Hauts-de-France', 'Île-de-France' => 'Île-de-France', 'Normandie' => 'Normandie', 'Nouvelle-Aquitaine' => 'Nouvelle-Aquitaine', 'Occitanie' => 'Occitanie', 'Pays de la Loire' => 'Pays de la Loire', 'Provence - Alpes - Côte d’Azur' => 'Provence - Alpes - Côte d’Azur'),
			'description' => '',
			'priority'    => 10
		);
		return $fields;
	}
	/**
	* Ajoute le champ job_zone a la fiche du JOB
	*/
	public	function add_job_zone_single_job_listing_meta_end() {
  		
  		global $post;
  		$zone = get_post_meta( $post->ID, 'geolocation_state_long', true );
		if ( $zone ) {
    		echo '<li>' . __( 'Région: ' ) . esc_html( $zone ) . '</li>';
  		}
	}
	/**
	* Ajout du champ de filtrage job_zone a la recherche de job
	*/
	public function add_job_zone_job_manager_job_filters_search_jobs_end() {
		?>
		<p id="6" class="default">Région :
			<ul class="job_types default"  id="60">
				<li><label for="job_zone_1"><input name="filter_by_zone[]" value="Auvergne-Rhône-Alpes" checked="checked" id="job_zone_1" type="checkbox"> Auvergne - Rhône-Alpes</label></li>
				<li><label for="job_zone_2"><input name="filter_by_zone[]" value="Bourgogne Franche-Comté" checked="checked" id="job_zone_2" type="checkbox"> Bourgogne - Franche-Comté</label></li>
				<li><label for="job_zone_3"><input name="filter_by_zone[]" value="Bretagne" checked="checked" id="job_zone_3" type="checkbox"> Bretagne</label></li>
				<li><label for="job_zone_4"><input name="filter_by_zone[]" value="Centre-Val" checked="checked" id="job_zone_4" type="checkbox"> Centre - Val de Loire</label></li>
				<li><label for="job_zone_5"><input name="filter_by_zone[]" value="Corse" checked="checked" id="job_zone_5" type="checkbox"> Corse</label></li>
				<li><label for="job_zone_6"><input name="filter_by_zone[]" value="Grand Est" checked="checked" id="job_zone_6" type="checkbox"> Grand Est</label></li>
				<li><label for="job_zone_7"><input name="filter_by_zone[]" value="Hauts-de-France" checked="checked" id="job_zone_7" type="checkbox"> Hauts-de-France</label></li>
				<li><label for="job_zone_8"><input name="filter_by_zone[]" value="Île-de-France" checked="checked" id="job_zone_8" type="checkbox"> Île-de-France</label></li>
				<li><label for="job_zone_9"><input name="filter_by_zone[]" value="Normandie" checked="checked" id="job_zone_9" type="checkbox"> Normandie</label></li>
				<li><label for="job_zone_10"><input name="filter_by_zone[]" value="Nouvelle-Aquitaine" checked="checked" id="job_zone_10" type="checkbox"> Nouvelle-Aquitaine</label></li>
				<li><label for="job_zone_11"><input name="filter_by_zone[]" value="Occitanie" checked="checked" id="job_zone_11" type="checkbox"> Occitanie</label></li>
				<li><label for="job_zone_12"><input name="filter_by_zone[]" value="Pays de la Loire" checked="checked" id="job_zone_12" type="checkbox"> Pays de la Loire</label></li>
				<li><label for="job_zone_13"><input name="filter_by_zone[]" value="Provence" checked="checked" id="job_zone_13" type="checkbox"> Provence - Alpes - Côte d’Azur</label></li>
				<input name="filter_by_zone[]" value="aerith" type="hidden">
			</ul>
		</p>
		<?php
	}
	/**
	* Construction des arguments pour le filtre job_zone dans la recherche de JOB
	* @var array $query_args
	*/
	public function filter_by_zone_field_query_args( $query_args, $args ) {
		if ( isset( $_POST['form_data'] ) ) {
			parse_str( $_POST['form_data'], $form_data );
			// If this is set, we are filtering by salary
			if ( ! empty( $form_data['filter_by_zone'] ) )
			{
				$query_args['meta_query'][6] = array('relation' => 'OR');
				foreach ($form_data['filter_by_zone'] as $key => $value)
				{
					$selected_range = sanitize_text_field( $value );
					$query_args['meta_query'][6][] = 
						array(
								'key'     => 'geolocation_state_long',
								'value'   => serialize( $selected_range),
								'compare' => 'LIKE',
								'type'    => 'CHAR',
							);
				}
				// This will show the 'reset' link
				add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
			}
			$query_args['meta_query'][6][] = 
						array(
								'key'     => '_job_location',
								'value'   => '',
								'compare' => 'LIKE',
								'type'    => 'CHAR',
							);
		}
		return $query_args;
	}

	/**
	* Ajoute le champ company_why au FRONTEND
	* @var array $fields 
	*/
	public function add_company_why_submit_job_form_fields( $fields ) {
		$fields['company']['company_why'] = array(
			'label'       => __( 'Pourquoi travailler chez nous ?', 'wp-job_manager' ),
			'type'        => 'wp-editor',
			'required'    => false,
			'default'     => 'Technicien Diagnostiqueur',
			'priority'    => 6
	  	);
		return $fields;
	}
	/**
	* Ajoute le champ company_why au BACKEND
	* @var array $fields 
	*/
	public function add_company_why_job_manager_job_listing_data_fields( $fields )  {
		$fields['_company_why'] = array(
			'label'       => __( 'Pourquoi travailler chez nous ?', 'job_manager' ),
			'type'        => 'wp-editor',
			'description' => '',			
			'priority'    => 17
		);
		return $fields;
	}

	/**
	* Ajoute le champ company_number au FRONTEND
	* @var array $fields 
	*/
	public function add_company_number_submit_job_form_fields( $fields ) {
		$fields['company']['company_number'] = array(
			'label'       => __( 'Nombre de postes a pourvoir cette année et dans quelle(s) régions', 'wp-job_manager' ),
			'type'        => 'wp-editor',
			'required'    => false,
			'priority'    => 7
	  	);
		return $fields;
	}
	/**
	* Ajoute le champ company_number au BACKEND
	* @var array $fields 
	*/
	public function add_company_number_job_manager_job_listing_data_fields( $fields )  {
		$fields['_company_number'] = array(
			'label'       => __( 'Nombre de postes a pourvoir cette année et ou?', 'job_manager' ),
			'type'        => 'wp-editor',
			'description' => '',
			'priority'    => 18
		);
		return $fields;
	}

	/**
	* Ajoute le champ company_profil au FRONTEND
	* @var array $fields 
	*/
	public function add_company_profil_submit_job_form_fields( $fields ) {
		$fields['company']['company_profil'] = array(
			'label'       => __( 'Type de profils recherchés', 'wp-job_manager' ),
			'type'        => 'wp-editor',
			'required'    => false,
			'priority'    => 8
	  	);
		return $fields;
	}
	/**
	* Ajoute le champ company_profil au BACKEND 
	* @var array $fields 
	*/
	public function add_company_profil_job_manager_job_listing_data_fields( $fields )  {
		$fields['_company_profil'] = array(
			'label'       => __( 'Type de profils recherchés', 'job_manager' ),
			'type'        => 'wp-editor',
			'description' => '',
			'priority'    => 19
		);
		return $fields;
	}

	/**
	* Ajoute le champ company_rh au FRONTEND
	* @var array $fields 
	*/
	public function add_company_rh_submit_job_form_fields( $fields ) {
		$fields['company']['company_rh'] = array(
			'label'       => __( 'Contacter le service RH', 'wp-job_manager' ),
			'type'        => 'text',
			'sanitizer'   => 'email',
			'required'    => false,
			'priority'    => 9
	  	);
		return $fields;
	}
	/**
	* Ajoute le champ company_rh au BACKEND
	* @var array $fields 
	*/
	public function add_company_rh_job_manager_job_listing_data_fields( $fields )  {
		$fields['_company_rh'] = array(
			'label'       => __( 'Contacter le service RH', 'job_manager' ),
			'type'        => 'text',
			'description' => '',
			'priority'    => 20
		);
		return $fields;
	}

	/**
	* Ajoute un boutton qui permet de refaire un nouveau depot a la page qui indique le depot d'une annonce 
	*/
	public function add_button_job_manager_job_submitted_content_after()
	{ ?>		
		<div >
			<br />
			<button class="button" type="button" onclick="javascript:location.href='http://itga1.dev/post-a-job/'">Un nouveau poste ?</button>
		</div>
	<?php }

	/**
	* Ajoute un boutton reset a la recherche de jobs
	*/

	public function add_reset_button_job_manager_job_filters_search_jobs_end() {
		{ ?>
			<div id="7" class="default">
				<input type="reset" value="Reset" class="default button resetfields">
			</div>	
				<script>
					jQuery(function($){
				    	$("input[type='reset'], button[type='reset']").click(function(e){
				        	setTimeout(function(){
				         		$("form").trigger("chosen:updated").trigger( 'reset' ).trigger( 'update_results', [ 1, false ] );
				         	}, 50);
				    	});
					});
				</script>
		<?php }
	}



	public function taxonomies_plusplus(){
		$labels = array(
			'name'                       => _x( 'Taxonomies', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Taxonomy', 'text_domain' ),
			'all_items'                  => __( 'All Items', 'text_domain' ),
			'parent_item'                => __( 'Parent Item', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
			'new_item_name'              => __( 'New Item Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Item', 'text_domain' ),
			'edit_item'                  => __( 'Edit Item', 'text_domain' ),
			'update_item'                => __( 'Update Item', 'text_domain' ),
			'view_item'                  => __( 'View Item', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular Items', 'text_domain' ),
			'search_items'               => __( 'Search Items', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
			'no_terms'                   => __( 'No items', 'text_domain' ),
			'items_list'                 => __( 'Items list', 'text_domain' ),
			'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'taxonomy', array( 'job_listing' ), $args );

	}

}