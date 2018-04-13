<!--
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package robojob lite
-->
<?php
	get_header(); 
	global $post;
    $post_ID = get_the_ID();
	$company_name = get_post_meta( $post_ID, '_company_name', true);
	$company_url =home_url( '/entreprise/' . trailingslashit( $company_name ) );
?>
<section class="content">
    <div class="wrapper">
    	<div class="main-content-wrapper   big-sidebar-right">
            <div class="main-content">
       			<div class="def-panel">
					<div class="panel-content shortocde-content">
						<div class="article-header">
							<div class="article-header-info">
								<span class="article-header-meta">
									<span class="article-header-meta-date"><h1 style="color: #3F484F"><a href=<?php echo $company_url ?>><?php echo $company_name ?></a></h1></span>
								</span>
							</div>
						</div>
						<div class="article-content">
							<?php
								while ( have_posts() ) : the_post();
									get_template_part( 'template-parts/content-single');

									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;
								endwhile; // End of the loop.
							?>
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
<?php
get_footer();

