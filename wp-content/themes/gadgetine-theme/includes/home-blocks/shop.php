<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    if (ot_is_woocommerce_activated() == true) { // Exit if woocommerce isn't active
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
        <div class="home-featured-shop-items woocommerce">
            <ul class="products">
                <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <?php 
                    $OT_builder->set_double($my_query->post->ID);
                    $image = get_post_thumb($my_query->post->ID,0,0); 
                    global $product;
                ?>
                    <li class="product<?php if($image['show']==false) { ?> no-image<?php } ?>">
                        <a href="<?php the_permalink();?>">
                            <?php if( $product && $product->is_on_sale()) { ?>
                                 <span class="onsale"><?php esc_html_e("Sale!", THEME_NAME);?></span>
                            <?php } ?>
                            <?php echo ot_image_html($my_query->post->ID,314,210);?>
                            <h3><?php the_title();?></h3>
                            <?php
                                if( $product && $product->get_rating_html()) { 
                                    echo $product->get_rating_html();
                                } 
                            ?>
                            <?php if( $product && $product->get_price_html()) { ?>
                                <span class="price"><?php echo $product->get_price_html();?><span>
                            <?php } ?>
                        </a>
                        <?php  woocommerce_template_loop_add_to_cart(); ?>
                    </li>

                <?php endwhile; ?>
                <?php endif; ?>


            </ul>
        </div>
<!-- END .def-panel -->
</div>
<?php } else { esc_html_e("Please set up WooCommerce Plugin", THEME_NAME); } ?>