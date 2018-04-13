<?php
/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      José Fortuny
 * @package     WP Job Manager
 * @category    Template
 * @since       1.0.0
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
$post_ID = get_the_ID();
$salaries = wp_get_post_terms( $post_ID, 'salaire', 'all' );
$salary = $salaries[0]->name;
$zip = get_post_meta( $post_ID, 'geolocation_postcode', true );
$town= get_post_meta( $post_ID, 'geolocation_city', true );
$types = wpjm_get_the_job_types();
$profil = get_post_meta( $post->ID, '_job_profil', true );
$premium = get_post_meta( $post->ID, '_featured', true );
?>
<li <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
	<a href="<?php the_job_permalink(); ?>">
		<?php if($premium==='1'){the_company_logo();} ?>
		<div class="position">
			<h3 class="slug-search"><?php wpjm_the_job_title(); ?></h3>
			<div class="company slug-search">
				<?php the_company_name( '<strong>', '</strong> ' ); ?>
				
				<div class="slug-search"><?php echo sanitize_text_field(wpjm_get_the_job_description()); ?></div>
			</div>
		</div>
		<ul class="slug-search ville">
			<li>
				<i class="icon ion-ios-location"></i>
				<?php echo ' '.$town; ?>
			</li>
			<li>				
				<?php echo ' '.$zip; ?>
			</li>
		</ul>
		<ul class="meta">
			<?php do_action( 'job_listing_meta_start' ); ?>
			<?php if ( get_option( 'job_manager_enable_types' ) ) { ?>				
				<li class="slug-search type">
					<?php if ( ! empty( $types ) ) : foreach ( $types as $type ) : ?>
					<?php echo esc_html( $type->name ); ?>
					<?php endforeach; endif; ?>						
				</li>
				<li class="slug-search"><?php echo $profil ?></li>					
				<li class="slug-search"><i class="icon ion-social-euro"></i> <?php echo $salary ?></li>
				<li class="slug-search"><i class="fa fa-calendar"></i> <?php the_job_publish_date(); ?></li>				
			<?php } ?>
			<?php do_action( 'job_listing_meta_end' ); ?>
		</ul>
	</a>
</li>
<pre><?php /*var_dump($_POST)*/ ;?></pre>
