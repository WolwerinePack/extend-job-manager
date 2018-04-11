<?php
/**
 * The template for displaying all single company.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package robojob lite
 */
    get_header();   

    $post_ID = get_the_ID();    
    if(isset($_SESSION['high_id']) && $_SESSION['high_id']>$post_ID)
    {
        $post_ID = $_SESSION['high_id'];
    }
    else
    {   
        $_SESSION['high_id']=$post_ID;
    }

    if ( is_plugin_active('wp-job-manager/wp-job-manager.php') && class_exists( 'Astoundify_Job_Manager_Companies' )) 
    {
        $company_website = get_post_meta( $post_ID, '_company_website', true);
        $company_name = get_post_meta( $post_ID, '_company_name', true);
        $company_tagline = wp_unslash(get_post_meta( $post_ID, '_company_tagline', true));
        $location = get_post_meta( $post_ID, '_job_location', true);
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
                                    <h1><?php echo $page ?></h1>
                                    <div class="page-header-meta">
                                        <ul class="job-meta">
                                                <div class="pure-g">
                                                    <?php
                                                    if ( ! empty($company_website) ) 
                                                    { ?>
                                                        <div class="pure-u-8-24">
                                                            <a href="<?php echo esc_url(get_the_company_website()); ?>" target="_blank"><i class="icon ion-link"></i> <?php esc_html_e( 'Site Web', 'gadgetine-theme' ); ?></a>
                                                        </div>                                                            
                                                    <?php
                                                    } ?>                                                       
                                                </div>
                                                <div class="pure-g">                                                       
                                                    <?php if ( $company_twitter )
                                                    { ?>
                                                        <div class="pure-u-8-24">
                                                            <a target="_blank" href="http://twitter.com/<?php echo esc_attr($company_twitter); ?>"><i class="fa fa-twitter"></i> Twitter </a>
                                                        </div>
                                                    <?php
                                                    } ?> 
                                                    <?php if ( $company_linkedin )
                                                    { ?>
                                                        <div class="pure-u-8-24">
                                                            <a target="_blank" href="https://fr.linkedin.com/company/<?php echo esc_attr($company_linkedin); ?>"><i class="fa fa-linkedin"></i> Linkedin </a>
                                                        </div>
                                                    <?php
                                                    } ?>
                                                    <?php if ( $company_facebook )
                                                    { ?>
                                                        <div class="pure-u-8-24">
                                                            <a target="_blank" href="https://fr-fr.facebook.com/<?php echo esc_attr($company_facebook); ?>"><i class="fa fa-facebook"></i> Facebook </a>
                                                        </div>
                                                    <?php
                                                    } ?>                                                        
                                                </div>
                                        </ul>
                                        <ul >
                                            <?php if ($company_tagline ) : ?>
                                                <h1 class="titre-meta">Description de la société</h1>
                                                <li class="tagline">
                                                    <div><p class="company-single pure-u-24-24"><?php echo $company_tagline; ?></p></div>
                                                </li>
                                            <?php endif; ?>
                                            <?php
                                                //global $post;
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
                                    </div>
                                <?php } else { echo '<h1>'; the_title(); echo '</h1>';} ?>
                                    <div id="primary" class="content-area <?php echo esc_attr($company_class); ?> ">
                                        <main id="main" class="site-main job-page-wrap" role="main">
                                        <?php if ($company_video && is_plugin_active('wp-job-manager/wp-job-manager.php') && class_exists( 'Astoundify_Job_Manager_Companies' ) ) { ?>
                                            <?php } ?>
                                            <?php if ( have_posts() ) : ?>
                                            <?php if (is_plugin_active('wp-job-manager/wp-job-manager.php') && class_exists( 'Astoundify_Job_Manager_Companies' )) { ?>
                                            <div class="entry-header">
                                                <h2 class="entry-title">
                                                    <?php printf( _n( '%d Offre en cours', '%d Offres en cours', esc_attr($wp_query->found_posts), 'robojob-lite' ), esc_attr($wp_query->found_posts) ); ?>
                                                </h2>
                                            </div>
                                            <?php } ?>
					                        <div class="job_listings">
                	   						    <ul class="job_listings">
                    			                    <?php
                    			                        while ( have_posts() ) : the_post();
                                                            if (is_plugin_active('wp-job-manager/wp-job-manager.php') && class_exists( 'Astoundify_Job_Manager_Companies' )) 
                                                            {
                    			                                get_job_manager_template_part( 'content', 'job_listing' );
                                                            }
                                                            else
                                                            {
                                                                get_template_part( 'template-parts/content-single');
                                                            }
                    			                            // If comments are open or we have at least one comment, load up the comment template.
                    			                            if ( comments_open() || get_comments_number() ) : comments_template();
                        			                        endif;
                        			                    endwhile;
                                                    ?>
                                                    <?php  the_posts_navigation(); ?>
                    			                </ul>
			                                </div>
			                                <?php endif; ?>
                                        </main>
                                    </div>
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
<?php get_footer();