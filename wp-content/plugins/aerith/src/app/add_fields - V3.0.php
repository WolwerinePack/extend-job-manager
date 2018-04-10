<?php
namespace app;
class add_fields
{
	public function __construct()
	{
		add_filter( 'job_manager_get_listings',array ($this, 'filter_by_featured_field_query_args'), 10, 2 );

		add_filter( 'submit_job_form_fields',array ($this, 'add_premium_submit_job_form_fields') );

		add_filter( 'submit_job_form_fields',array ($this, 'add_expertise_submit_job_form_fields') );
		/*add_action( 'single_job_listing_meta_end',array ($this, 'add_job_expertise_single_job_listing_meta_end') );*/
		add_filter( 'job_manager_job_filters_search_jobs_end',array ($this, 'add_job_expertise_job_manager_job_filters_search_jobs_end') );
		add_filter( 'job_manager_get_listings',array ($this, 'filter_by_expertise_field_query_args'), 10, 2 );

		add_filter( 'submit_job_form_fields',array ($this, 'add_profil_submit_job_form_fields') );
		/*add_action( 'single_job_listing_meta_end',array ($this, 'add_job_profil_single_job_listing_meta_end') );*/
		add_filter( 'job_manager_job_filters_search_jobs_end',array ($this, 'add_job_profil_job_manager_job_filters_search_jobs_end') );
		add_filter( 'job_manager_get_listings',array ($this, 'filter_by_profil_field_query_args'), 10, 2 );

		add_filter( 'submit_job_form_fields',array ($this, 'add_diag_submit_job_form_fields') );
		/*add_filter( 'single_job_listing_meta_end',array($this, 'add_job_diag_single_job_listing_meta_end') );*/
		add_filter( 'job_manager_job_filters_search_jobs_end',array ($this, 'add_job_diag_job_manager_job_filters_search_jobs_end') );
		add_filter( 'job_manager_get_listings',array ($this, 'filter_by_diag_field_query_args'), 10, 2 );

		add_filter( 'submit_job_form_fields',array ($this, 'add_experience_submit_job_form_fields') );
		/*add_filter( 'single_job_listing_meta_end',array($this, 'add_job_exp_single_job_listing_meta_end') );*/
		add_filter( 'job_manager_job_filters_search_jobs_end',array ($this, 'add_job_exp_job_manager_job_filters_search_jobs_end') );
		add_filter( 'job_manager_get_listings',array ($this, 'filter_by_exp_field_query_args'), 10, 2 );

		add_filter( 'submit_job_form_fields',array ($this, 'add_salaire_submit_job_form_fields') );
		/*add_filter( 'single_job_listing_meta_end',array ($this, 'add_job_salary_single_job_listing_meta_end') );*/
		add_filter( 'job_manager_job_filters_search_jobs_end',array ($this, 'add_job_salary_job_manager_job_filters_search_jobs_end') );
		add_filter( 'job_manager_get_listings',array ($this, 'filter_by_salary_field_query_args'), 10, 2 );

		/*add_filter( 'single_job_listing_meta_end',array ($this, 'add_job_zone_single_job_listing_meta_end') );*/
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
	* Ajoute le champ expertise au FRONTEND
	* @var array $fields 
	*/
	public function add_expertise_submit_job_form_fields( $fields ) {
		$expertise     = 'expertise';
		$fields['job'][$expertise] = array(
			'label'       => __( 'Champ d\'Expertise', 'wp-job_manager' ),
			'type'        => 'term-multiselect',
			'required'    => true,
			'priority'    => 4,
			'taxonomy'     => $expertise
	  	);
		return $fields;
	}
	
	/**
	* Ajoute le champ job_expertise a la fiche du JOB
	*/
	public function add_job_expertise_single_job_listing_meta_end() {
  		
  		global $post;
  		$post_ID = get_the_ID();
  		$expertises = wp_get_post_terms( $post_ID, 'expertise', 'all' );
  		if ( $expertises ) { 
  			if ( count( $expertises ) > 1)
  			{
  				echo '<li><strong> Champ d\'Expertises : </strong>';
  			}
    		else
    		{
	    		echo '<li><strong> Champ d\'Expertise : </strong>';
    		}	
		  	foreach ($expertises as $expertise ) {
		  		$expert = $expertise->name;
		  		echo esc_html( $expert ).' <strong>/</strong> ' ;
		  	}
		  	echo '</li>';
	  		
  		}
	}

	/**
	* Ajout du champ de filtrage job_expertise a la recherche de job
	*/
	public function add_job_expertise_job_manager_job_filters_search_jobs_end() {
		$terms = get_terms( array(
        	'taxonomy' => 'expertise',
            'hide_empty' => false,  ) ); 
        ?>
		<p id="1" class="default"><i class="icon ion-android-add-circle"></i> Champ d'Expertise
			<ul class="job_types default"  id="10">
			<?php foreach ($terms as $term ) : ?>
				<li><label for="expertise_<?php echo $term->slug; ?>" class="<?php echo sanitize_title( $term->name ); ?>"></label><input class="check" type="checkbox" name="filter_expertise[]" value="<?php echo $term->slug; ?>"  id="expertise_<?php echo $term->slug; ?>" /> <?php echo $term->name; ?></li>
			<?php endforeach; ?>
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
			if ( ! empty( $form_data['filter_expertise'] ) )
			{
				$query_args['post_type'] = 'job_listing';
				$query_args['tax_query'][1] = array('relation' => 'OR');
				$query_args['tax_query'][1][] = 
						array(
								'taxonomy'     => 'expertise',
								'field'   => 'slug',
								'terms' => $form_data['filter_expertise'],
							);

				// This will show the 'reset' link
				add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
			}
		}
		return $query_args;
	}

	/**
	* Ajoute le champ profil au FRONTEND
	* @var array $fields 
	*/
	public function add_profil_submit_job_form_fields( $fields ) {
		$keys=get_terms( array(
			'taxonomy' => 'profil',
    		'hide_empty' => false,  ) );
		foreach ( $keys as $key)
		{
			$options[$key->slug]=$key->name;
		}

		$profil     = 'profil';
		$fields['job'][$profil] = array(
			'label'       => __( 'Profil', 'job_manager' ),
			'type'        => 'radio',
			'required'    => true,
			'priority'    => 3,
			'options' => $options,
			'taxonomy'     => $profil			
	  	);
		return $fields;
	}	
	/**
	* Ajoute le champ job_profil a la fiche du JOB
	*/
	public function add_job_profil_single_job_listing_meta_end() {
  		
  		global $post;
  		$post_ID = get_the_ID();
  		$terms = wp_get_post_terms( $post_ID, 'profil', 'all' );
  		$profil = $terms[0]->name;
		if ( $profil ) {
    		echo '<li>' . __( '<strong>Profil : </strong>' ) . esc_html( $profil ) . '</li>';
  		}
	}
	/**
	* Ajout du champ de filtrage job_profil a la recherche de job
	*/
	public function add_job_profil_job_manager_job_filters_search_jobs_end() {
		
		$terms = get_terms( array(
        	'taxonomy' => 'profil',
            'hide_empty' => false,  ) ); 
        ?>
		<p id="2"  class="default"><i class="icon ion-android-add-circle"></i> Profil 
			<ul class="job_types default"  id="20">
			<?php foreach ($terms as $term ) : ?>
				<li><label for="profil_<?php echo $term->slug; ?>" class="<?php echo sanitize_title( $term->name ); ?>"></label><input class="check" type="checkbox" name="filter_profil[]" value="<?php echo $term->slug; ?>"  id="profil_<?php echo $term->slug; ?>" /> <?php echo $term->name; ?></li>
			<?php endforeach; ?>
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
			if ( ! empty( $form_data['filter_profil'] ) )
			{
				$query_args['post_type'] = 'job_listing';
				$query_args['tax_query'][2] = array('relation' => 'OR');
				$query_args['tax_query'][2][] = 
					array(
							'taxonomy'     => 'profil',
							'field'   => 'slug',
							'terms' => $form_data['filter_profil'] ,
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
	public function add_diag_submit_job_form_fields( $fields ) {
		$diagnostique     = 'diagnostic';
		$fields['job'][$diagnostique] = array(
			'label'       => __( 'Type de diagnostics', 'job_manager' ),
			'type'        => 'term-multiselect',
			'required'    => true,
			'priority'    => 6,
			'taxonomy' => $diagnostique,
			
	  	);
		return $fields;
	}
	/**
	* Ajoute le champ job_diag a la fiche du JOB
	*/
	public function add_job_diag_single_job_listing_meta_end() {
  		
  		global $post;
  		$post_ID = get_the_ID();
  		$diags = wp_get_post_terms( $post_ID, 'diagnostic', 'all' );
		if ( $diags ) {
			if ( count( $diag ) > 1)
  			{
  				echo '<li> <strong>Types de Diagnostic : </strong>';
  			}
    		else
    		{
	    		echo '<li> <strong>Type de Diagnostic : </strong>';
    		}	
		  	foreach ($diags as $diag ) {
		  		$diagnostique = $diag->name;
		  		echo esc_html( $diagnostique ).'<strong> / </strong>' ;
		  	}
		  	echo '</li>';
   		}
	}
	/**
	* Ajout du champ de filtrage job_diag a la recherche de job
	*/
	public function add_job_diag_job_manager_job_filters_search_jobs_end() {
		$terms = get_terms( array(
        	'taxonomy' => 'diagnostic',
            'hide_empty' => false,  ) ); 
        ?>
		<p id="3" class="default"><i class="icon ion-android-add-circle"></i> Diagnostique
			<ul class="job_types default"  id="30">
				<?php foreach ($terms as $term ) : ?>
				<li><label for="diagnostic_<?php echo $term->slug; ?>" class="<?php echo sanitize_title( $term->name ); ?>"></label><input class="check" type="checkbox" name="filter_diagnostic[]" value="<?php echo $term->slug; ?>"  id="diagnostic_<?php echo $term->slug; ?>" /> <?php echo $term->name; ?></li>
			<?php endforeach; ?>
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
			// If this is set, we are filtering by diagnostique
			if ( ! empty( $form_data['filter_diagnostic'] ) )
			{
				$query_args['post_type'] = 'job_listing';
				$query_args['tax_query'][3] = array('relation' => 'OR');
				$query_args['tax_query'][3][] = 
					array(
							'taxonomy'     => 'diagnostic',
								'field'   => 'slug',
								'terms' => $form_data['filter_diagnostic'],
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
	public function add_experience_submit_job_form_fields( $fields ) {
		
		$experience     = 'experience';
		$fields['job'][$experience] = array(
			'label'       => __( 'Expérience', 'job_manager' ),
			'type'        => 'term-multiselect',
			'required'    => true,
			'priority'    => 7,
			'taxonomy' => 	$experience 
			
	  	);
		return $fields;
	}
	
	/**
	* Ajoute le champ job_exp a la fiche du JOB
	*/
	public function add_job_exp_single_job_listing_meta_end() {  		
  		global $post;
  		$post_ID = get_the_ID();
  		$experiences = wp_get_post_terms( $post_ID, 'experience', 'all' );
  		echo '<li> <strong>Expérience : </strong>';
	  	foreach ($experiences as $experience ) {
	  		$exp = $experience->name;
	  		echo esc_html( $exp ).'<strong> / </strong>' ;
	  	}
   		echo '</li>';
	}
	/**
	* Ajout du champ de filtrage job_exp a la recherche de job
	*/
	public function add_job_exp_job_manager_job_filters_search_jobs_end() {
		$terms = get_terms( array(
        	'taxonomy' => 'experience',
        	'orderby' => 'slug',
            'order' => ASC,
            'hide_empty' => false,  ) ); 
        ?>
			<p  id="4" class="default"><i class="icon ion-android-add-circle"></i> Expérience
				<ul class="job_types default"  id="40">
				<?php foreach ($terms as $term ) : ?>
					<li><label for="experience_<?php echo $term->slug; ?>" class="<?php echo sanitize_title( $term->name ); ?>"></label><input class="check" type="checkbox" name="filter_experience[]" value="<?php echo $term->slug; ?>"  id="experience_<?php echo $term->slug; ?>" /> <?php echo $term->name; ?></li>
				<?php endforeach; ?>		
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
			// If this is set, we are filtering by experience
			if ( ! empty( $form_data['filter_experience'] ) )
			{
				$query_args['post_type'] = 'job_listing';
				$query_args['tax_query'][4] = array('relation' => 'OR');
				$query_args['tax_query'][4][] = 
					array(
							'taxonomy'     => 'experience',
							'field'   => 'slug',
							'terms' => $form_data['filter_experience'],
						);
				// This will show the 'reset' link
				add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
			}
		}
		return $query_args;
	}
	/**
	* Ajoute le champ salaire au FRONTEND
	* @var array $fields
	*/
	public function add_salaire_submit_job_form_fields( $fields ) {
		$keys=get_terms( array(
			'taxonomy' => 'salaire',
			'orderby' => 'slug',
            'order' => ASC,
    		'hide_empty' => false,  ) );
		foreach ( $keys as $key)
		{
			$options[$key->slug]=$key->name;
		}

		$salaire     = 'salaire';
		$fields['job'][$salaire] = array(
			'label'       => __( 'Salaire', 'wp-job_manager' ),
			'type'        => 'radio',
			'required'    => true,
			'priority'    => 8,
			'default'	  => '1',
			'options' => $options,
			'taxonomy'     => $salaire
	  	);
		return $fields;
	}
	/**
	* Ajoute le champ job_salary a la fiche du JOB
	*/
	public function add_job_salary_single_job_listing_meta_end() {
  		
  		global $post;
  		$post_ID = get_the_ID();
  		$terms = wp_get_post_terms( $post_ID, 'salaire', 'all' );
  		$salary = $terms[0]->name;
  	    if ( $salary && $salary!=='Non Rémunéré') {
    		echo '<li>' . __( '<strong>Salaire: </strong>' ) . esc_html( $salary ) . ' €/an</li>';
  		}
  		elseif ($salary==='Non Rémunéré') {
  			echo '<li>' . __( '<strong>Salaire: </strong>' ) . esc_html( $salary ).'</li>';
  		}
  		echo '<br />';
	}
	/**
	* Ajout du champ de filtrage job_salary a la recherche de job
	*/
	public function add_job_salary_job_manager_job_filters_search_jobs_end() {

		$terms = get_terms( array(
        	'taxonomy' => 'salaire',
        	'orderby' => 'slug',
            'order' => ASC,
            'hide_empty' => false,  ) ); 
        ?>
		<p id="5" class="default"><i class="icon ion-android-add-circle"></i> Salaire 
			<ul class="job_types default"  id="50">
			<?php foreach ($terms as $term ) : ?>
				<li><label for="salaire_<?php echo $term->slug; ?>" class="<?php echo sanitize_title( $term->name ); ?>"></label><input class="check" type="checkbox" name="filter_salaire[]" value="<?php echo $term->slug; ?>"  id="salaire_<?php echo $term->slug; ?>" /> <?php echo $term->name; ?></li>
			<?php endforeach; ?>
			</ul>
		</p>	
		<?php 
	}
	/**
	* Construction des arguments pour le filtre by_salary dans la recherche de JOB
	* @var array $query_args
	*/
	public function filter_by_salary_field_query_args( $query_args, $args ) {
		if ( isset( $_POST['form_data'] ) ) {
			parse_str( $_POST['form_data'], $form_data );
			// If this is set, we are filtering by salary
			if ( ! empty( $form_data['filter_salaire'] ) )
			{
				$query_args['post_type'] = 'job_listing';
				$query_args['tax_query'][5] = array('relation' => 'OR');
				$query_args['tax_query'][5][0] = 
					array(
							'taxonomy'     => 'salaire',
							'field'   => 'slug',
							'terms' => $form_data['filter_salaire'],
						);				
				// This will show the 'reset' link
				add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
			}
		}
		return $query_args;
	}	

	/**
	* Ajoute le champ job_zone a la fiche du JOB
	*/
	public	function add_job_zone_single_job_listing_meta_end() {
  		
  		global $post;
  		$zone = get_post_meta( $post->ID, 'geolocation_state_long', true );
  		$town= get_post_meta( $post->ID, 'geolocation_city', true );
  		if ( $zone ) {
    		echo '<li>' . __( '<strong>Région: </strong>' ) . esc_html( $zone ) .' '.$town.'</li>';
  		}
	}
	/**
	* Ajout du champ de filtrage job_zone a la recherche de job
	*/
	public function add_job_zone_job_manager_job_filters_search_jobs_end() {
	
		$region = new find_zone;
		$zones= $region->getZone();
		?>
		<p id="6" class="default"><i class="icon ion-android-add-circle"></i> Région 
			<ul class="job_types default"  id="60">
				<?php foreach ($zones as $region) {?>
				<li><label for="zone_<?php echo $region ?>"></label><input name="filter_zone[]" value="<?php echo $region ?>" id="zone_<?php echo $region ?>"class="check" type="checkbox"> <?php echo $region ?></li>
				<?php } ?>
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
			if ( ! empty( $form_data['filter_zone'] ) )
			{
				$query_args['post_type'] = 'job_listing';
				$query_args['meta_query'][6] = array('relation' => 'OR');
				foreach ($form_data['filter_zone'] as $key => $value)
				{
					$selected_range = stripslashes(sanitize_text_field( $value ));
					$query_args['meta_query'][6][] = 
						array(
								'key'     => 'geolocation_state_long',
								'value'   => $selected_range,
							);
				}
				// This will show the 'reset' link
				add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
			}
			/*$query_args['meta_query'][6][] = 
						array(
								'key'     => '_job_location',
								'value'   => '',
								'compare' => 'LIKE',
								'type'    => 'CHAR',
							);*/
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
				<a id="7" href="#" class="reset default resetfields">Réinitialiser</a>

		<?php }		
	}

}