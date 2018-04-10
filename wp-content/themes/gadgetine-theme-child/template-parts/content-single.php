<?php
	/**
	 * Template part for displaying single posts.
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package robojob lite
	 */
	global $post;
	$post_thumbnail_id = get_post_thumbnail_id($post->ID);
	$attachment = get_post_meta($post_thumbnail_id);
	$featured_image = wp_get_attachment_image_src($post_thumbnail_id , 'full');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="pure-g">
		<div class="pure-u-23-24">
			<div class="post-content">
				<header class="entry-header">
					<?php
						if ( is_single() ) {
							the_title( '<h1 class="entry-title">', '</h1>' );
						} else {
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						}
						if ( 'post' === get_post_type() ) : ?>
							<div class="entry-meta">	
								<?php robojob_lite_posted_on(); ?>
							</div>
							<!-- End Entry-meta -->
						<?php endif;
					?>				
				</header>
				<!-- End Entry Header -->
				<div class="entry-content hello">						
					<?php the_content(); ?>
				</div>
				<!-- End Entry Content -->
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'robojob-lite' ),
						'after'  => '</div>',
					) );
				?>
			</div>
		</div>
	</div>
</article>

<!-- End Posts -->
