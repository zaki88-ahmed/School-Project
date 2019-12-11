<?php if(esc_attr(get_theme_mod('information_section_display','0'))):?>
<section class="welcome">
<div class="container">
    <div class="row">
        <?php $information_post[0] = esc_attr(get_theme_mod('general_information_page',1)); 
                $args = array (
                    'post_type' => 'page',
                    'post_per_page' => 1,
                    'post__in'         => $information_post,
                    'orderby'           =>'post__in',
                );
                $loop = new WP_Query($args);                        
                if ( $loop->have_posts() ) : 		
                    while ($loop->have_posts()) : $loop->the_post(); 
                    
                ?>
                        <?php if(has_post_thumbnail()):?>
                            <div class="col-md-5">
                                <?php the_post_thumbnail('engager-information-image');?>
                            </div>
                        <?php else:?>
                            <div class="col-md-5">
                                <img src="<?php echo esc_url(get_template_directory_uri());?>/images/slider.png" class="img-responsive">
                            </div>
                        <?php endif;?>
                        <div class="col-md-7">
                            <h2>
                                <?php the_title();?>
                            </h2>
                            <h5>
                                <?php echo esc_html( get_option('date_format') ); ?>
                            </h5>
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endwhile;?>
                <?php endif;?>
    </div>
</div>
</section>
<?php endif;?>