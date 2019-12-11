<?php if(esc_attr(get_theme_mod('blog_section_display','1'))):?>
<section class="services">
<div class="blog-section">
    <div class="container">
        <div class="row">
        	<div class="section-title">
        		<h1><?php echo esc_html(get_theme_mod( 'blog_textbox', '' )); ?></h1>
    		</div>
        </div>
                
        <div class="row">
            <?php   
                    
                $cid = absint(get_theme_mod('latest_blog_category_display'));     
                $num_post= absint(get_theme_mod( 'latest_blog_category_display_num','3'));
                
                $args = array(
                    'post_type'     =>'post',
                    'post_status'   =>'publish',
                    'paged'         =>1,
                    'posts_per_page'=>2,
                    'cat'           =>$cid,
                    'orderby'       =>'ID',
                    'order'         =>'DESC',
                );
                    $loop = new WP_Query($args);                        
                    if ( $loop->have_posts() ) : 		
                        while ($loop->have_posts()) : $loop->the_post(); 
                    ?>	
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    <?php if(has_post_thumbnail()):?>                                         
                                            <?php the_post_thumbnail('engager-blog-image');?>
                                    <?php else:?>                                        
                                            <img src="<?php echo esc_url(get_template_directory_uri());?>/images/slider.png" class="img-responsive">
                                    <?php endif;?>
                                    <div class="caption">
                                        <h3>
                                            <?php the_title();?>
                                        </h3>
                                        <?php the_excerpt(); ?>
                                        <a href="<?php the_permalink();?>" class="btn btn-plain"><?php echo __('Read More','engager');?>
                                            <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;?>
                    <?php endif;?>
        </div>
    </div>
</div>
</section>
<?php endif;?>