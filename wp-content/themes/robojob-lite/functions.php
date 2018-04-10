<?php
/**
 * robojob functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package robojob lite
 */

if ( ! function_exists( 'robojob_lite_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function robojob_lite_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on robojob, use a find and replace
		 * to change 'robojob-lite' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'robojob-lite', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		add_theme_support( 'custom-logo', array(
		   'height'      => 175,
		   'width'       => 400,
		   'flex-width' => true,
		));

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'robojob-lite-post-image', 690, 520, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'robojob-lite' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
		) );

		// Add customizer edit shortcodes
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'robojob_lite_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'job-manager-templates' );

	}
endif;
add_action( 'after_setup_theme', 'robojob_lite_setup' );

if ( ! function_exists( 'robojob_lite_add_editor_styles' ) ) {
	// Add editor styles
	function robojob_lite_add_editor_styles() {
	    add_editor_style( '/assets/css/admin/editor-styles.min.css' );
	    $font_url = '//fonts.googleapis.com/css?family=Open+Sans:400,700|Droid+Serif:400,400italic,700,700italic';
	    add_editor_style( str_replace( ',', '%2C', $font_url ) );
	}
	add_action( 'init', 'robojob_lite_add_editor_styles' );
}

if ( ! function_exists( 'robojob_lite_content_width' ) ) {
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function robojob_lite_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'robojob_lite_content_width', 640 );
	}
	add_action( 'after_setup_theme', 'robojob_lite_content_width', 0 );
}
/**
 * Theme styles and scripts enqueue
 */
require get_template_directory() . '/inc/enqueue.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

require get_template_directory() . '/inc/custom-header.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Sanitization additions.
 */
require get_template_directory() . '/inc/customizer/robojob-lite-sanitization.php';

/**
 * sidebar additions.
 */
require get_template_directory() . '/inc/robojob-lite-sidebar.php';

/**
 * Nav Walker additions.
 */
if ( ! class_exists( 'wp_bootstrap_navwalker' )) {
	require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';
}

/**
 * robojob functions
 */
require get_template_directory() . '/inc/lib/robojob-lite-functions.php';

require get_template_directory() . '/inc/lib/robojob-lite-banner.php';

/**
 * robojob shortcode
 */

require get_template_directory() . '/inc/lib/extra-function.php';

require get_template_directory() . '/inc/lib/extra-posts.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/inc/customizer/robojob-lite-customize-control.php';

require_once get_template_directory() . '/inc/customizer/class-upgrade-to-pro.php';

/**
 * Include the TGM_Plugin_Activation class.
 */
get_template_part('inc/plugin', 'activation');

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2 for parent theme Robojob
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
add_action( 'tgmpa_register', 'robojob_lite_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
if ( ! function_exists('robojob_lite_register_required_plugins') ) {
	function robojob_lite_register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			array(
				'name'      => __('WP Job Manager', 'robojob-lite'),
				'slug'      => 'wp-job-manager',
				'required'  => false,
			),

			array(
				'name'      => __('Contact Form 7', 'robojob-lite'),
				'slug'      => 'contact-form-7',
				'required'  => false,
			),

			array(
				'name'      => __('Customizer Export/Import', 'robojob-lite'),
				'slug'      => 'customizer-export-import',
				'required'  => false,
			),

			array(
				'name'      => __('WP Job Manager - Company Profiles', 'robojob-lite'),
				'slug'      => 'wp-job-manager-companies',
				'required'  => false,
			),

			array(
				'name'      => __('WP Job Manager - Contact Listing ', 'robojob-lite'),
				'slug'      => 'wp-job-manager-contact-listing',
				'required'  => false,
			),

			array(
				'name'      => __('WP Job Manager - Job Type Colors ', 'robojob-lite'),
				'slug'      => 'wp-job-manager-colors',
				'required'  => false,
			),

			array(
				'name'      => __('User Role Editor', 'robojob-lite'),
				'slug'      => 'user-role-editor',
				'required'  => false,
			),

		);

		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'robojob-lite',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}

if (! function_exists('robojob_lite_add_menu_users')) {
	add_filter( 'wp_nav_menu_items', 'robojob_lite_add_menu_users', 10, 2 );
	function robojob_lite_add_menu_users( $items, $args ) {
			global $current_user;
			wp_get_current_user();
			$username = $current_user->user_login;
			$useremail = $current_user->user_email;
			$robojob_lite_theme_options = robojob_lite_options();
			$manage_job_link = $robojob_lite_theme_options['manage_job_link'];
		  	if (is_user_logged_in() && $args->theme_location == 'primary' ) {
			  	if ( current_user_can('edit_theme_options') || current_user_can('edit_job_listings')  ) {
			       $items .= '<li class="menu-item menu-item-has-children menu-item-avatar dropdown"><a><span>'.get_avatar( $useremail, 32 ).'</span></a>';
			       $items .= '<ul role="menu" class="sub-menu dropdown-menu">';
			       $items .= '<li class="menu-item"><a href="'.   esc_url( home_url( $manage_job_link )) .'">'.__('Manage Jobs', 'robojob-lite').'</a></li>';
			       $items .= '<li class="menu-item"><a href="'.   esc_url(admin_url( 'profile.php' ) ) .'">'.__('Edit Profile', 'robojob-lite').'</a></li>';
			       $items .= '<li class="menu-item"><a href="'.  esc_url(wp_logout_url( get_permalink() )) .'">'.__('Log Out', 'robojob-lite').'</a></li>';
			       $items .= '</ul';
			       $items .= '</li>';
			    }

			}

		    elseif ( ! is_user_logged_in() && $args->theme_location == 'primary' ) {

		       $items .= '<li class="login-menu"><a href="'. esc_url(wp_login_url( home_url() )).'" title="'.esc_attr__('Login', 'robojob-lite').'">'.esc_html__('Log In', 'robojob-lite').'</a></li>';

		    }

		   return $items;

	}

	/*add_filter( 'submit_job_form_fields', 'custom_title_submit_job_form_fields' );

	function custom_title_submit_job_form_fields( $fields ) {

	    $fields['job']['job_title']['label'] = "Libellé du poste";

	    return $fields;
	}*/

	/*add_filter( 'submit_job_form_fields', 'custom_location_submit_job_form_fields' );

	function custom_location_submit_job_form_fields( $fields ) {

	    $fields['job']['job_location']['label'] = "Code postal";
	    $fields['job']['job_location']['placeholder'] = "Par exemple : 13590";

	    return $fields;
	}*/

	/*add_filter( 'job_manager_job_listing_data_fields', 'custom_location_job_manager_job_listing_data_fields' );

		function custom_location_job_manager_job_listing_data_fields( $fields ) {

		$fields['_job_location']['label'] = "Code postal";
	    $fields['_job_location']['placeholder'] = "Par exemple : 13590";

	    return $fields;
	}*/

	/*add_filter( 'submit_job_form_fields', 'frontend_edit_description_profil_field' );

	function frontend_edit_description_profil_field( $fields ) {
		$fields['job']['job_description']['priority'] = 10;
		return $fields;
	}*/

	/*add_filter( 'submit_job_form_fields', 'frontend_edit_application_profil_field' );

	function frontend_edit_application_profil_field( $fields ) {
		$fields['job']['application']['priority'] = 11;
		return $fields;
	}*/

	/*add_filter( 'submit_job_form_fields', 'frontend_edit_category_profil_field' );

	function frontend_edit_category_profil_field( $fields ) {
		$fields['job']['job_category']['label'] = 'Champ d\'expertise';
		$fields['job']['job_category']['priority'] = 5;
		return $fields;
	}*/

	/*add_filter( 'submit_job_form_fields', 'frontend_add_salary_field' );

	function frontend_add_salary_field( $fields ) {
		$fields['job']['job_salary'] = array(
			'label'       => __( 'Salaire (€)', 'job_manager' ),
			'type'        => 'select',
			'required'    => false,
			'options' => array('', '20000 - 25000' => '20000 - 25000', '25001 - 30000' => '25001 - 30000', '30001 - 35000' => '30001 - 35000'),
			'priority'    => 8
	  	);
		return $fields;
	}*/

	/*add_filter( 'job_manager_job_listing_data_fields', 'admin_add_salary_field' );

	function admin_add_salary_field( $fields )  {
		$fields['_job_salary'] = array(
			'label'       => __( 'Salaire (€)', 'job_manager' ),
			'type'        => 'select',
			'options' => array('', '20000 - 25000' => '20000 - 25000', '25001 - 30000' => '25001 - 30000', '30001 - 35000' => '30001 - 35000'),
			'description' => ''
		);
		return $fields;
	}*/

	/*add_action( 'single_job_listing_meta_end', 'display_job_salary_data' );

	function display_job_salary_data() {
  		
  		global $post;
  		$salary = get_post_meta( $post->ID, '_job_salary', true );
		if ( $salary ) {
    		echo '<li>' . __( 'Salaire: ' ) . esc_html( $salary ) . '€/an</li>';
  		}
	}*/

	/*add_filter( 'submit_job_form_fields', 'frontend_add_profil_field' );

	function frontend_add_profil_field( $fields ) {
		$fields['job']['job_profil'] = array(
			'label'       => __( 'Profil', 'job_manager' ),
			'type'        => 'select',
			'required'    => true,
			 'options' => array('', 'technicien-diagnostiqueur' => 'Technicien Diagnostiqueur', 'manageur-entrepreneur' => 'Manageur Entrepreneur', 'poste-admin' => 'Poste Admin'),
			'placeholder' => '',
			'default'     => 'technicien-diagnostiqueur',
			'priority'    => 4
	  	);
		return $fields;
	}*/

	/*add_filter( 'job_manager_job_listing_data_fields', 'admin_add_profil_field' );

	function admin_add_profil_field( $fields )  {
		$fields['_job_profil'] = array(
			'label'       => __( 'Profil', 'job_manager' ),
			'type'        => 'select',
			'required'    => true,
			'options' => array('', 'technicien-diagnostiqueur' => 'Technicien Diagnostiqueur', 'manageur-entrepreneur' => 'Manageur Entrepreneur', 'poste-admin' => 'Poste Admin'),
			'placeholder' => '',
			'default'     => 'technicien-diagnostiqueur',
		);
		return $fields;
	}*/

	/*add_action( 'single_job_listing_meta_end', 'display_job_profil_data' );

	function display_job_profil_data() {
  		
  		global $post;
  		$profil = get_post_meta( $post->ID, '_job_profil', true );
		if ( $profil ) {
    		echo '<li>' . __( 'Profil: ' ) . esc_html( $profil ) . '</li>';
  		}
	}*/

	/*add_filter( 'submit_job_form_fields', 'frontend_add_diag_field' );

	function frontend_add_diag_field( $fields ) {
		$fields['job']['type_diag'] = array(
			'label'       => __( 'Type de diagnostique', 'job_manager' ),
			'type'        => 'select',
			'required'    => false,
			'options' => array('', 'locatif' => 'Locatif', 'vente' => 'Vente', 'avant-travaux' => 'Avant-travaux', 'apres-travaux' => 'Après-travaux', 'avant-demol' => 'Avant-démolition'),			
			'priority'    => 6
	  	);
		return $fields;
	}*/

	/*add_filter( 'job_manager_job_listing_data_fields', 'admin_add_diag_field' );

	function admin_add_diag_field( $fields )  {
		$fields['_type_diag'] = array(
			'label'       => __( 'Type de diagnostique', 'job_manager' ),
			'type'        => 'select',
			'options' => array('', 'locatif' => 'Locatif', 'vente' => 'Vente', 'avant-travaux' => 'Avant-travaux', 'apres-travaux' => 'Après-travaux', 'avant-demol' => 'Avant-démolition'),
			'description' => ''
		);
		return $fields;
	}*/

	/*add_action( 'single_job_listing_meta_end', 'display_job_diag_data' );

	function display_job_diag_data() {
  		
  		global $post;
  		$diag = get_post_meta( $post->ID, '_type_diag', true );
		if ( $diag ) {
    		echo '<li>' . __( 'Type de diagnostique: ' ) . esc_html( $diag ) . '</li>';
  		}
	}*/

	/*add_filter( 'submit_job_form_fields', 'frontend_add_zone_field' );

	function frontend_add_zone_field( $fields ) {
		$fields['job']['zone'] = array(
			'label'       => __( 'Région', 'job_manager' ),
			'type'        => 'select',
			'required'    => false,
			'options' => array('', 'Auvergne - Rhône-Alpes' => 'Auvergne - Rhône-Alpes', 'Bourgogne - Franche-Comté' => 'Bourgogne - Franche-Comté', 'Bretagne' => 'Bretagne', 'Centre - Val de Loire' => 'Centre - Val de Loire', 'Corse' => 'Corse', 'Grand Est' => 'Grand Est', 'Hauts-de-France' => 'Hauts-de-France', 'Île-de-France' => 'Île-de-France', 'Normandie' => 'Normandie', 'Nouvelle-Aquitaine' => 'Nouvelle-Aquitaine', 'Occitanie' => 'Occitanie', 'Pays de la Loire' => 'Pays de la Loire', 'Provence - Alpes - Côte d\'Azur' => 'Provence - Alpes - Côte d\'Azur'),		
			'priority'    => 9
	  	);
		return $fields;
	}*/

	/*add_filter( 'job_manager_job_listing_data_fields', 'admin_add_zone_field' );

	function admin_add_zone_field( $fields )  {
		$fields['_zone'] = array(
			'label'       => __( 'Région', 'job_manager' ),
			'type'        => 'select',
			'options' => array('', 'Auvergne - Rhône-Alpes' => 'Auvergne - Rhône-Alpes', 'Bourgogne - Franche-Comté' => 'Bourgogne - Franche-Comté', 'Bretagne' => 'Bretagne', 'Centre - Val de Loire' => 'Centre - Val de Loire', 'Corse' => 'Corse', 'Grand Est' => 'Grand Est', 'Hauts-de-France' => 'Hauts-de-France', 'Île-de-France' => 'Île-de-France', 'Normandie' => 'Normandie', 'Nouvelle-Aquitaine' => 'Nouvelle-Aquitaine', 'Occitanie' => 'Occitanie', 'Pays de la Loire' => 'Pays de la Loire', 'Provence - Alpes - Côte d\'Azur' => 'Provence - Alpes - Côte d\'Azur'),
			'description' => ''
		);
		return $fields;
	}*/

	/*add_action( 'single_job_listing_meta_end', 'display_job_zone_data' );

	function display_job_zone_data() {
  		
  		global $post;
  		$zone = get_post_meta( $post->ID, '_zone', true );
		if ( $zone ) {
    		echo '<li>' . __( 'Région: ' ) . esc_html( $zone ) . '</li>';
  		}
	}*/
	
	/*add_filter( 'submit_job_form_fields', 'frontend_add_exp_field' );

	function frontend_add_exp_field( $fields ) {
		$fields['job']['exp'] = array(
			'label'       => __( 'Expérience', 'job_manager' ),
			'type'        => 'select',
			'required'    => true,
			'options' => array('', 'Débutant' => 'Débutant', '3 à 5 ans' => '3 à 5 ans', '6 à 9 ans' => '6 à 9 ans', '+ de 9 ans' => '+ de 9 ans'),		
			'priority'    => 7
	  	);
		return $fields;
	}*/

	/*add_filter( 'job_manager_job_listing_data_fields', 'admin_add_exp_field' );

	function admin_add_exp_field( $fields )  {
		$fields['_exp'] = array(
			'label'       => __( 'Expérience', 'job_manager' ),
			'type'        => 'select',
			'options' => array('', 'Débutant' => 'Débutant', '3 à 5 ans' => '3 à 5 ans', '6 à 9 ans' => '6 à 9 ans', '+ de 9 ans' => '+ de 9 ans'),	
			'description' => ''
		);
		return $fields;
	}*/

	/*add_action( 'single_job_listing_meta_end', 'display_job_exp_data' );

	function display_job_exp_data() {
  		
  		global $post;
  		$exp = get_post_meta( $post->ID, '_exp', true );
		if ( $exp ) {
    		echo '<li>' . __( 'Expérience: ' ) . esc_html( $exp ) . '</li>';
  		}
	}*/

	/*add_filter( 'submit_job_form_show_signin', 'show_signin_false' );

	function show_signin_false() {
		return false;
	}*/

	/*add_action( 'preview_to_pending', 'listing_posted_send_email' );

	function listing_posted_send_email($post_id) {
		if( 'job_listing' != get_post_type( $post_id ) ) {
			return;
		}
		$post = get_post($post_id);

		$message = "Bonjour la team l'offre, ".$post->post_title." viens juste d'être postée ".get_permalink( $post_id );
		$team="jose.fortuny@itga.fr";
		wp_mail($team, "Nouvelle offre d'emplois", $message);
	}*/

	/*add_action('pending_to_publish', 'listing_published_send_email');

	function listing_published_send_email($post_id) {
		if( 'job_listing' != get_post_type( $post_id ) ) {
			return;
		}
		$post = get_post($post_id);
		$author = get_userdata($post->post_author);

		$message = "Bonjour ".$author->display_name.", votre offre, ".$post->post_title." viens juste d'être validée ".get_permalink( $post_id );
		wp_mail($author->user_email, "Validation de votre offre d'emplois", $message);
	}*/

	/*add_action('pending_to_pending', 'listing_not_published_send_email');

	function listing_not_published_send_email($post_id) {
		if( 'job_listing' != get_post_type( $post_id ) ) {
			return;
		}
		$post = get_post($post_id);
		$author = get_userdata($post->post_author);

		$message = "Bonjour ".$author->display_name.", votre offre, ".$post->post_title." viens juste d'être mise a la relecture,merci de verifier son contenu ".get_permalink( $post_id );
		wp_mail($author->user_email, "Mise a la relecture de votre offre d'emplois", $message);
	}*/

	/*add_action( 'transition_post_status', 'listing_expired_send_email', 10, 3 );

	function listing_expired_send_email( $new_status, $old_status, $post ) {
	    if ( 'job_listing' !== $post->post_type || 'expired' !== $new_status || $old_status === $new_status ) {
	        return;
	    }
	    $author = get_userdata( $post->post_author );
	 
	    $message = "Bonjour " . $author->display_name . ", votre offre, " . $post->post_title . " est maintenant expirée: " . get_permalink( $post_id );
	    wp_mail( $author->user_email, "Votre offre a plus de 60 jours", $message );
	}*/

	/*add_action( 'job_manager_job_filters_search_jobs_end', 'filter_by_salary_field' );
	
	function filter_by_salary_field() {
		?>
		<div class="search_categories">
			<label for="search_categories"><?php _e( 'Salary', 'wp-job-manager' ); ?></label>
			<select name="filter_by_salary" class="job-manager-filter">
				<option value=""><?php _e( 'N\'importe quel Salaire', 'wp-job-manager' ); ?></option>
				<option value="20000-25000"><?php _e( 'De 20,000 à 25000', 'wp-job-manager' ); ?></option>
				<option value="25001-30000"><?php _e( 'De 25,001 à 30,000', 'wp-job-manager' ); ?></option>
				<option value="30001-35000"><?php _e( 'De 30,001 à 35,000', 'wp-job-manager' ); ?></option>
				<option value="over35"><?php _e( '€60,000+', 'wp-job-manager' ); ?></option>
			</select>
		</div>
		<?php
	}*/
	
	/*add_filter( 'job_manager_get_listings', 'filter_by_salary_field_query_args', 10, 2 );

	function filter_by_salary_field_query_args( $query_args, $args ) {
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
	}*/

	/*add_action( 'job_manager_job_filters_search_jobs_end', 'filter_by_zone_field' );
	
	function filter_by_zone_field() {
		?>
		<div class="search_categories">
			<label for="search_categories"><?php _e( 'Région', 'wp-job-manager' ); ?></label>
			<select name="filter_by_zone" class="job-manager-filter">
				<option value=""><?php _e( 'N\'importe qu\'elle région', 'wp-job-manager' ); ?></option>
				<option value="Occitanie"><?php _e( 'Occitanie', 'wp-job-manager' ); ?></option>
				<option value="20000-40000"><?php _e( '€20,000 to $40,000', 'wp-job-manager' ); ?></option>
				<option value="40000-60000"><?php _e( '€40,000 to $60,000', 'wp-job-manager' ); ?></option>
				<option value="over60"><?php _e( '€60,000+', 'wp-job-manager' ); ?></option>
			</select>
		</div>
		<?php
	}
	add_filter( 'job_manager_get_listings', 'filter_by_zone_field_query_args', 10, 2 );

	function filter_by_zone_field_query_args( $query_args, $args ) {
		if ( isset( $_POST['form_data'] ) ) {
			parse_str( $_POST['form_data'], $form_data );
			
			if ( ! empty( $form_data['filter_by_zone'] ) ) {
				$selected_range = sanitize_text_field( $form_data['filter_by_zone'] );
				$query_args['meta_query'][] = array(
							'key'     => '_zone',
							'value'   => $selected_range,
							'compare' => '=',
							'type'    => 'text'
						);
				// This will show the 'reset' link
				add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
			}
		}
		return $query_args;
	}*/
}