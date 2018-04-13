<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();

	$post_ID = get_the_ID();    
    if ( is_plugin_active('wp-job-manager/wp-job-manager.php') && class_exists( 'Astoundify_Job_Manager_Companies' )) 
    {
    	$company_name = get_the_title();
    	$company_tagline = get_the_content();
        $company_why = get_post_meta( $post_ID,'why', true);
        $company_number = get_post_meta( $post_ID, 'number', true);
        $company_profil = get_post_meta( $post_ID, 'profil', true);
        
        
        $location = get_post_meta( $post_ID, '_job_location', true);
        $company_website = get_post_meta( $post_ID, '_company_website', true);
        $company_twitter = get_post_meta( $post_ID, '_company_twitter', true);
        $company_linkedin = get_post_meta( $post_ID, '_company_linkedin', true);
        $company_facebook = get_post_meta( $post_ID, '_company_facebook', true);
        
        $job_types = wp_get_post_terms( $post_ID, 'job_listing_type', 'all' );
        foreach ($job_types as $job_type ) 
        {
           $job_type_name = $job_type->name;
           $job_type_slug = $job_type->slug;
        }
        $company_video = get_the_company_video();
    }
?>
<section class="content">               
    <div class="wrapper"> 
        <div class="main-content-wrapper big-sidebar-right">
            <div class="main-content">
                <div class="def-panel">
                    <div class="panel-content shortocde-content">
                        <div class="article-header"> 
                            <div class="article-header-info">
                                <span class="article-header-meta">
                                    <span class="article-header-meta-date"><h1 style="color: #3F484F"><?php echo $company_name ?></h1></span>
                                </span>
                            </div>
                        </div>
                        <div class="article-content">
                            <?php 
                                if ( is_plugin_active('wp-job-manager/wp-job-manager.php') && class_exists( 'Astoundify_Job_Manager_Companies' ) ) 
                                { ?>
                                    <ul >
                                        <?php if ($company_tagline ) : ?>
                                            <h1 class="titre-meta">Description de la société</h1>
                                            <li class="tagline">
                                                <div><p class="company-single pure-u-24-24"><?php echo $company_tagline; ?></p></div>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ( $company_why ) { ?>
                                        <h1 class="titre-meta">Pourquoi travailler pour nous ?</h1>
                                            <li class="why">
                                                <div><p class="company-single pure-u-24-24"><?php echo $company_why; ?></p></div>
                                            </li>
                                        <?php } ?>
                                        <?php if ( $company_number ) { ?>
                                        <h1 class="titre-meta">Nombres de postes a pourvoir cette année et dans quelle région</h1>
                                            <li class="number">
                                                <div><p class="company-single pure-u-24-24"><?php echo $company_number; ?></p></div>
                                            </li>
                                        <?php } ?>
                                        <?php if ( $company_profil ) { ?>
                                        <h1 class="titre-meta">Type de profil que nous recherchons</h1>
                                            <li class="profil">
                                                <div><p class="company-single pure-u-24-24"><?php echo $company_profil; ?></p></div>
                                            </li>
                                        <?php } ?>
                                        <?php
                                            $post_thumbnail_id = get_post_thumbnail_id($post->ID);
                                            $attachment = get_post_meta($post_thumbnail_id);
                                            $featured_image = wp_get_attachment_image_src($post_thumbnail_id , 'full');
                                        ?>
                                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                            <?php
                                            if (! is_attachment()) : //do not show any of these in attachment page
                                                if (has_post_format('gallery'))
                                                {
                                                        $image_url = get_post_gallery_images($post);
                                                        $post_thumbnail_id = get_post_thumbnail_id($post->ID);
                                                        $attachment =  get_post($post_thumbnail_id);
                                                ?>                                                                       
                                                        <div class="pure-u-8-24"> 
                                                            <?php foreach( $image_url as $image ) { ?>
                                                                <img src="<?php echo esc_url($image); ?>">
                                                            <?php } ?>
                                                        </div>
                                                <?php 
                                                }
                                                else if (! has_post_format('video')) 
                                                { ?>
                                                    <?php if ( $featured_image ) : ?>
                                                        <div class="pure-u-8-24">
                                                            <img src="<?php echo esc_url($featured_image[0]); ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                <?php
                                                }
                                            endif; ?>
                                            <br /><br />
                                            <?php the_company_video();?>
                                        </article>
                                    </ul>
                            <?php } 
                                else { echo '<h1>'; the_title(); echo '</h1>';} ?>                                      
                        </div>
                    </div>
                </div>
            </div>
            <aside id="sidebar">
                <?php  dynamic_sidebar('sidebar-jobs'); ?>
            </aside>
        </div>        
    </div>
</section>
<?php get_footer();?>