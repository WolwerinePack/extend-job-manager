<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $OT_builder = new OT_home_builder; 
    //get block data
    $data = $OT_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 
?>
    <!-- BEGIN .def-panel -->
    <div class="def-panel">
        <?php if($title) { ?>
            <div class="panel-title">
                <?php if($link) { ?>
                    <a href="<?php echo $link;?>" class="right"><?php esc_html_e( 'show all ', THEME_NAME ); echo strtolower($title);?></a>
                <?php } ?>
                <h2 style="border-bottom: 2px solid #<?php echo $color;?>; color: #<?php echo $color;?>;"><?php echo $title;?></h2>
            </div>
        <?php } ?>

        <div class="small-article-list">
        
           <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <?php 
                    $OT_builder->set_double($my_query->post->ID);
                    $image = get_post_thumb($my_query->post->ID,0,0);
                ?>
                <div class="item<?php if($image['show']==false) { ?> no-image<?php } ?>">
                    <?php if($image['show']!=false) { ?>
                        <div class="item-header">
                            <a href="<?php the_permalink();?>" class="hover-image">
                                <?php echo ot_image_html($my_query->post->ID,90,58);?>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="item-content">
                        <h4>
                            <a href="<?php the_permalink();?>"><?php the_title();?></a>
                            <?php if ( comments_open() && ot_option_compare("post_comments_single","post_comments_single", $my_query->post->ID)==true) { ?>
                                <a href="<?php the_permalink();?>#comments" class="comment-link">
                                    <i class="fa fa-comment-o"></i>
                                    <span><?php comments_number("0","1","%"); ?></span>
                                </a>
                            <?php } ?>
                        </h4>
                        <?php 
                            if($columnID=="column12" || ($columnID=="column6" && ot_check_sidebar(OT_page_ID()) == "off") ) { 
                                if($columnID=="column6" && ot_check_sidebar(OT_page_ID()) == "off") {
                                    $words = 20;
                                } else {
                                    $words = 40;
                                }
                                add_filter('excerpt_length', 'new_excerpt_length_'.$words);
                                the_excerpt();
                                remove_filter('excerpt_length', 'new_excerpt_length_'.$words);
                            }
                        ?>
                    </div>
                </div>
            <?php endwhile; endif; ?>

            <?php if($link) { ?>
                <a href="<?php echo $link;?>" class="more-articles-button"><?php esc_html_e( 'show all ', THEME_NAME ); echo strtolower($title);?></a>
            <?php } ?>
        </div>
        
    <!-- END .def-panel -->
    </div>
