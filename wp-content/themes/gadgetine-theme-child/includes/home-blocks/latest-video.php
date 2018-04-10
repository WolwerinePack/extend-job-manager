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
                <h2 style="border-bottom: 2px solid #<?php echo $color;?>; color: #<?php echo $color;?>;"><?php echo $title;?></h2>
            </div>
        <?php } ?>
        <div class="panel-content video-news-list">
            <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>   
                <?php $OT_builder->set_double($my_query->post->ID); ?>   
                <div class="item">
                    <div class="item-header">
                        <a href="<?php the_permalink();?>" class="hover-image">
                            <img src="<?php echo THEME_IMAGE_URL;?>video-icon.png" alt="<?php the_title();?>" class="news-video-icon" />
                            <?php echo ot_image_html($my_query->post->ID,376,212);?>
                        </a>
                    </div>
                    <div class="item-content">
                        <h3>
                            <a href="<?php the_permalink();?>"><?php the_title();?></a>
                        </h3>
                        <?php if (ot_option_compare('post_date','post_date_single',$my_query->post->ID)==true) { ?>
                            <p>
                                <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>">
                                    <?php the_time(get_option('date_format'));?>
                                </a>
                            </p>
                        <?php } ?>
                    </div>
                </div>
            <?php endwhile; else: ?>
                <p><?php esc_html_e('No posts were found, please select posts for video block.', THEME_NAME); ?></p>
            <?php endif; ?> 
            <div class="clear-float"></div>
        </div>
    <!-- END .def-panel -->
    </div>