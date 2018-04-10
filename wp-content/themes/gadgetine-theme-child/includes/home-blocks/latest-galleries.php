<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $OT_builder = new OT_home_builder; 
    //get block data
    $data = $OT_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 

    $counter = 1;

    $sidebar = get_post_meta( OT_page_ID(), "_".THEME_NAME.'_sidebar_select', true );
    if(is_category()) {
        $sidebar = ot_get_option(get_cat_id( single_cat_title("",false) ), 'sidebar_select', false);
    } elseif(is_tax()) {
        $sidebar = ot_get_option(get_queried_object()->term_id, 'sidebar_select', false);
    }
?>
     <!-- BEGIN .main-nosplit -->
    <div class="main-nosplit">
        <!-- BEGIN .content-panel -->
        <div class="content-panel">
            <?php if($title) { ?>
                <div class="panel-header">
                    <b style="background:<?php echo $pageColor;?>;"><i class="fa fa-camera"></i><?php echo $title;?></b>
                    <?php if($link) { ?>
                        <div class="top-right"><a href="<?php echo $link;?>"><?php esc_html_e("View More Photo Galleries",THEME_NAME);?></a></div>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="panel-content">
                
                <div class="photo-gallery-blocks">

                    <ul class="images-scroll" style="margin-left: <?php echo ( $sidebar  == "off" ) ? "355" : "190" ;?>px;">
                        <?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
                            <?php $imageBig = get_post_thumb($my_query->post->ID,300,220); ?>
                            <?php if($counter==1) { $class =' class="active"';} else { $class=false; } ?>
                        <li<?php echo $class;?>><a href="<?php the_permalink();?>"><img src="<?php echo $imageBig['src'];?>" class="setborder" alt="<?php the_title();?>" title="<?php the_title();?>" /></a></li>
                        <?php $counter++; ?>
                        <?php endwhile; ?>
                        <?php endif; ?> 
                        <?php $counter = 1; ?>  
                    </ul>
                    
                    <div class="clear-float"></div>

                    <ul class="images-content">
                        <?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
                        <?php 
                            $galleryImages = get_post_meta ( $my_query->post->ID, THEME_NAME."_gallery_images", true ); 
                            $imageIDs = explode(",",$galleryImages);
                            if($counter==1) { $class =' class="active"';} else { $class=false; }
                        ?>
                        <li<?php echo $class;?>>
                            <div class="gallery-thumbs">
                                <div class="d-wrapper">
                                    <ul>
                                        <?php
                                            $c=0;

                                            foreach($imageIDs as $id) {
                                                if($c==5) break;
                                                if($id) {
                                                    $file = wp_get_attachment_url($id);
                                                    $image = get_post_thumb(false, 52, 40, false, $file);          
                                        ?>
                                            <li data-nr="<?php echo $c+1;?>">   
                                                <a href="<?php the_permalink();?>" rel="<?php echo $c+1;?>" class="light-show" data-id="gallery-<?php echo $post->ID; ?>">
                                                    <img src="<?php echo $image['src'];?>" alt="<?php the_title();?>" class="setborder" data-id="<?php echo $c+1;?>"/>
                                                </a>
                                            </li>   
                                        <?php
                                                $c++;
                                                }
                                            }
                                        ?>
                                    </ul>
                                    <div class="clear-float"></div>
                                </div>
                            </div>
                            
                            <div class="d-wrapper">
                                <div class="article-header">
                                    <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                                </div>

                                <div class="article-links">
                                    <a href="<?php the_permalink();?>" class="article-icon-link"><i class="fa fa-reply"></i><?php printf(esc_html('View all %1$s photos',THEME_NAME), OT_image_count($post->ID));?></a>
                                </div>
                            </div>
                        </li>
                        <?php $counter++; ?>
                        <?php endwhile; ?>
                        <?php endif; ?> 
                    </ul>
                    
                </div>

            </div>
        <!-- END .content-panel -->
        </div>
    </div>