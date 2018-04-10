<?php
namespace app;
class add_fields
{
	public function __construct()
	{
		add_filter( 'submit_job_form_fields',array ($this, 'add_premium_submit_job_form_fields') );

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

		add_filter( 'submit_job_form_fields',array ($this, 'add_job_zone_submit_job_form_fields') );
		add_filter( 'job_manager_job_listing_data_fields',array ($this, 'add_job_zone_job_manager_job_listing_data_fields') );
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
	}

	/**
	* Ajoute la checkbox premium au FRONTEND
	* @var array $fields
	*/
	public function add_premium_submit_job_form_fields( $fields ) {
		$fields['job']['premium'] = array(
			'label'       => __( 'Premium ?', 'job_manager' ),
			'type'        => 'checkbox',
			'description' => 'Voulez vous que cette annonce soit Premium ?',
			'required'    => false,
			'priority'    => 0,
		);
		return $fields;
	}

	/**
	* Ajoute le champ job_profil au FRONTEND
	* @var array $fields 
	*/
	public function add_job_profil_submit_job_form_fields( $fields ) {
		$fields['job']['job_profil'] = array(
			'label'       => __( 'Profil', 'job_manager' ),
			'type'        => 'select',
			'required'    => true,
			 'options' => array('', 'Technicien Diagnostiqueur' => 'Technicien Diagnostiqueur', 'Manageur Entrepreneur' => 'Manageur Entrepreneur', 'Poste Admin' => 'Poste Admin'),
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
			'type'        => 'select',
			'required'    => true,
			'options' => array('', 'Technicien Diagnostiqueur' => 'Technicien Diagnostiqueur', 'Manageur Entrepreneur' => 'Manageur Entrepreneur', 'Poste Admin' => 'Poste Admin'),
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
		<script type="text/javascript">
			jQuery(function($) {
				$("select[name='filter_by_profil']").chosen();
			});
		</script>
		<div class="search_categories">
			<label for="search_categories"><?php _e( 'Profil', 'wp-job-manager' ); ?></label>
			<select name="filter_by_profil" id="search_categories" class="job-manager-category-dropdown " data-placeholder="Choisissez un profil" data-no_results_text="Aucun résultat" data-multiple_text="Choisir une option" style="display: none;">
				<option value=""><?php _e( 'N\'importe quel profil', 'wp-job-manager' ); ?></option>
				<option value="Technicien Diagnostiqueur"><?php _e( 'Technicien Diagnostiqueur', 'wp-job-manager' ); ?></option>
				<option value="Manageur Entrepreneur"><?php _e( 'Manageur Entrepreneur', 'wp-job-manager' ); ?></option>
				<option value="Poste Admin"><?php _e( 'Poste Admin', 'wp-job-manager' ); ?></option>
			</select>
		</div>
		<?php
	}
	/**
	* Construction des arguments pour le filtre job_profil dans la recherche de JOB
	* @var array $query_args
	*/
	public function filter_by_profil_field_query_args( $query_args, $args ) {
		if ( isset( $_POST['form_data'] ) ) {
			parse_str( $_POST['form_data'], $form_data );
			
			if ( ! empty( $form_data['filter_by_profil'] ) ) {
				$selected_range = sanitize_text_field( $form_data['filter_by_profil'] );
				$query_args['meta_query'][] = array(
							'key'     => '_job_profil',
							'value'   => $selected_range,
							'compare' => '=',
							'type'    => 'text'
						);
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
			'type'        => 'select',
			'required'    => true,
			'options' => array('', 'Locatif' => 'Locatif', 'Vente' => 'Vente', 'Avant-travaux' => 'Avant-travaux', 'Après-travaux' => 'Après-travaux', 'Avant-démolition' => 'Avant-démolition'),			
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
			'options' => array('', 'Locatif' => 'Locatif', 'Vente' => 'Vente', 'Avant-travaux' => 'Avant-travaux', 'Après-travaux' => 'Après-travaux', 'Avant-démolition' => 'Avant-démolition'),
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
		<script type="text/javascript">
		jQuery(function($) {
			$("select[name='filter_by_diag']").chosen();
		});
		</script>
		<div class="search_categories">
			<label for="search_categories"><?php _e( 'Profil', 'wp-job-manager' ); ?></label>
			<select name="filter_by_diag" id="search_categories" class="job-manager-category-dropdown " data-placeholder="Choisissez un type de diagnostique" data-no_results_text="Aucun résultat" data-multiple_text="Choisir une option" style="display: none;">
				<option value=""><?php _e( 'N\'importe quel type de diagnostique', 'wp-job-manager' ); ?></option>
				<option value="Locatif"><?php _e( 'Locatif', 'wp-job-manager' ); ?></option>
				<option value="Vente"><?php _e( 'Vente', 'wp-job-manager' ); ?></option>
				<option value="Avant-travaux"><?php _e( 'Avant-travaux', 'wp-job-manager' ); ?></option>
				<option value="Après-travaux"><?php _e( 'Après-travaux', 'wp-job-manager' ); ?></option>
				<option value="Avant-démolition"><?php _e( 'Avant-démolition', 'wp-job-manager' ); ?></option>
			</select>
		</div>
		<?php
	}
	/**
	* Construction des arguments pour le filtre job_diag dans la recherche de JOB
	* @var array $query_args
	*/
	public function filter_by_diag_field_query_args( $query_args, $args ) {
		if ( isset( $_POST['form_data'] ) ) {
			parse_str( $_POST['form_data'], $form_data );
			
			if ( ! empty( $form_data['filter_by_diag'] ) ) {
				$selected_range = sanitize_text_field( $form_data['filter_by_diag'] );
				$query_args['meta_query'][] = array(
							'key'     => '_job_diag',
							'value'   => $selected_range,
							'compare' => 'LIKE',
							'type'    => 'text'
						);
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
			'type'        => 'select',
			'required'    => true,
			'options' => array('', 'Débutant' => 'Débutant', '3 à 5 ans' => '3 à 5 ans', '6 à 9 ans' => '6 à 9 ans', '+ de 9 ans' => '+ de 9 ans'),
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
			'type'        => 'select',
			'options' => array('', 'Débutant' => 'Débutant', '3 à 5 ans' => '3 à 5 ans', '6 à 9 ans' => '6 à 9 ans', '+ de 9 ans' => '+ de 9 ans'),	
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
		<script type="text/javascript">
			jQuery(function($) {
				$("select[name='filter_by_exp']").chosen();
			});
		</script>
		<div class="search_categories">
			<label for="search_categories"><?php _e( 'Expérience', 'wp-job-manager' ); ?></label>
			<select name="filter_by_exp" id="search_categories" class="job-manager-category-dropdown " data-placeholder="Choisissez une expérience" data-no_results_text="Aucun résultat" data-multiple_text="Choisir une option" style="display: none;">
				<option value=""><?php _e( 'N\'importe qu\'elle expérience', 'wp-job-manager' ); ?></option>
				<option value="Débutant"><?php _e( 'Débutant', 'wp-job-manager' ); ?></option>
				<option value="3 à 5 ans"><?php _e( '3 à 5 ans', 'wp-job-manager' ); ?></option>
				<option value="6 à 9 ans"><?php _e( '6 à 9 ans', 'wp-job-manager' ); ?></option>
				<option value="+ de 9 ans"><?php _e( '+ de 9 ans' ); ?></option>
			</select>
		</div>
		<?php
	}
	/**
	* Construction des arguments pour le filtre job_exp dans la recherche de JOB
	* @var array $query_args
	*/
	public function filter_by_exp_field_query_args( $query_args, $args ) {
		if ( isset( $_POST['form_data'] ) ) {
			parse_str( $_POST['form_data'], $form_data );
			if ( ! empty( $form_data['filter_by_exp'] ) ) {
				$selected_range = sanitize_text_field( $form_data['filter_by_exp'] );
				$query_args['meta_query'][] = array(
							'key'     => '_job_exp',
							'value'   => $selected_range,
							'compare' => '=',
							'type'    => 'text'
						);
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
			'required'    => false,
			'options' => array('20000 - 25000' => '20000 - 25000', '25001 - 30000' => '25001 - 30000', '30001 - 35000' => '30001 - 35000'),
			'default' => '',
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
			'options' => array('20000 - 25000' => '20000 - 25000', '25001 - 30000' => '25001 - 30000', '30001 - 35000' => '30001 - 35000'),
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
		if ( $salary ) {
    		echo '<li>' . __( 'Salaire: ' ) . esc_html( $salary ) . '€/an</li>';
  		}
	}
	/**
	* Ajout du champ de filtrage job_salary a la recherche de job
	*/
	public function add_job_salary_job_manager_job_filters_search_jobs_end() {
		?>
		<script type="text/javascript">
		jQuery(function($) {
			$("select[name='filter_by_salary']").chosen();
		});
		</script>
		<div class="search_categories">
			<label for="search_categories"><?php _e( 'Salary', 'wp-job-manager' ); ?></label>
			<select name="filter_by_salary" id="search_categories" class="job-manager-category-dropdown " data-placeholder="Choisissez une catégorie…" data-no_results_text="Aucun résultat" data-multiple_text="Choisir une option" style="display: none;">
				<option value=""><?php _e( 'N\'importe quel salaire', 'wp-job-manager' ); ?></option>
				<option value="20000-25000"><?php _e( 'De 20,000 à 25000', 'wp-job-manager' ); ?></option>
				<option value="25001-30000"><?php _e( 'De 25,001 à 30,000', 'wp-job-manager' ); ?></option>
				<option value="30001-35000"><?php _e( 'De 30,001 à 35,000', 'wp-job-manager' ); ?></option>
				<option value="over35"><?php _e( '35,000+', 'wp-job-manager' ); ?></option>
			</select>
		</div>
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
			if ( ! empty( $form_data['filter_by_salary'] ) ) {
				$selected_range = sanitize_text_field( $form_data['filter_by_salary'] );
				switch ( $selected_range ) {
					case 'upto20' :
						$query_args['meta_query'][] = array(
							'key'     => '_job_salary',
							'value'   => '20000',
							'compare' => '<',
							'type'    => 'NUMERIC'
						);
					break;
					case 'over35' :
						$query_args['meta_query'][] = array(
							'key'     => '_job_salary',
							'value'   => '35000',
							'compare' => '>=',
							'type'    => 'NUMERIC'
						);
					break;
					default :
						$query_args['meta_query'][] = array(
							'key'     => '_job_salary',
							'value'   => array_map( 'absint', explode( '-', $selected_range ) ),
							'compare' => 'BETWEEN',
							'type'    => 'NUMERIC'
						);
					break;
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
  		$zone = get_post_meta( $post->ID, '_job_zone', true );
		if ( $zone ) {
    		echo '<li>' . __( 'Région: ' ) . esc_html( $zone ) . '</li>';
  		}
	}
	/**
	* Ajout du champ de filtrage job_zone a la recherche de job
	*/
	public function add_job_zone_job_manager_job_filters_search_jobs_end() {
		?>
		<script type="text/javascript">
		jQuery(function($) {
			$("select[name='filter_by_zone']").chosen();
		});
		</script>
		<div class="search_categories">
			<label for="search_categories"><?php _e( 'Région', 'wp-job-manager' ); ?></label>
			<select name="filter_by_zone" id="search_categories" class="job-manager-category-dropdown " data-placeholder="Choisissez une région" data-no_results_text="Aucun résultat" data-multiple_text="Choisir une option" style="display: none;">
				<option value=""><?php _e( 'N\'importe qu\'elle région', 'wp-job-manager' ); ?></option>
				<option value="Auvergne - Rhône-Alpes"><?php _e( 'Auvergne - Rhône-Alpes', 'wp-job-manager' ); ?></option>
				<option value="Bourgogne - Franche-Comté"><?php _e( 'Bourgogne - Franche-Comté', 'wp-job-manager' ); ?></option>
				<option value="Bretagne"><?php _e( 'Bretagne', 'wp-job-manager' ); ?></option>
				<option value="Centre - Val de Loire"><?php _e( 'Centre - Val de Loire', 'wp-job-manager' ); ?></option>
				<option value="Corse"><?php _e( 'Corse', 'wp-job-manager' ); ?></option>
				<option value="Grand Est"><?php _e( 'Grand Est', 'wp-job-manager' ); ?></option>
				<option value="Hauts-de-France"><?php _e( 'Hauts-de-France', 'wp-job-manager' ); ?></option>
				<option value="Île-de-France"><?php _e( 'Île-de-France', 'wp-job-manager' ); ?></option>
				<option value="Normandie"><?php _e( 'Normandie', 'wp-job-manager' ); ?></option>
				<option value="Nouvelle-Aquitaine"><?php _e( 'Nouvelle-Aquitaine', 'wp-job-manager' ); ?></option>
				<option value="Occitanie"><?php _e( 'Occitanie', 'wp-job-manager' ); ?></option>
				<option value="Pays de la Loire"><?php _e( 'Pays de la Loire', 'wp-job-manager' ); ?></option>
				<option value="Provence - Alpes - Côte d’Azur"><?php _e( 'Provence - Alpes - Côte d’Azur', "wp-job-manager" ); ?></option>
			</select>			
		</div>
		<?php
	}
	/**
	* Construction des arguments pour le filtre job_zone dans la recherche de JOB
	* @var array $query_args
	*/
	public function filter_by_zone_field_query_args( $query_args, $args ) {
		if ( isset( $_POST['form_data'] ) ) {
			parse_str( $_POST['form_data'], $form_data );
			
			if ( ! empty( $form_data['filter_by_zone'] ) ) {
				$selected_range = sanitize_text_field( $form_data['filter_by_zone'] );
				$query_args['meta_query'][] = array(
							'key'     => '_job_zone',
							'value'   => $selected_range,
							'compare' => '=',
							'type'    => 'text'
						);
				// This will show the 'reset' link
				add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
			}
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
				<input type="reset" value="Reset" class="button resetfields">
				<script>
					jQuery(function($){
				    	$("input[type='reset'], button[type='reset']").click(function(e){
				        	setTimeout(function(){
				         		$("select").trigger("chosen:updated").trigger( 'update_results', [ 1, false ] );
				         	}, 50);
				    	});
					});
				</script>
		<?php }
	}

}