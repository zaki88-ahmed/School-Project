<?php if(esc_attr(get_theme_mod('testimonial_section_display','1'))):?>
<div class="testimonial-section">
    <div class="container">
        <div class="row">
            <div class="section-title">
                <h1><?php echo esc_html(get_theme_mod( 'testimonial_textbox', '' )); ?></h1>
            </div>
        </div>
        
        <div id="owl-demo" class="owl-carousel">
            <?php 
                $cid = absint(get_theme_mod('testimonial_category_display','1'));     
                $num_post= absint(get_theme_mod( 'testimonial_category_display_num','3'));
                
                $args = array(
                    'post_type'     =>'post',
                    'post_status'   =>'publish',
                    'paged'         =>1,
                    'posts_per_page'=>$num_post,
                    'cat'           =>$cid,
                    'orderby'       =>'ID',
                    'order'         =>'DESC',
                );
            $loop = new WP_Query($args);                        
            if ( $loop->have_posts() ) : 		
                while ($loop->have_posts()) : $loop->the_post();
            ?>			
                    <div class="item">
                        <?php the_excerpt();?>
                        <h3>
                            <?php the_title();?>
                        </h3>
                    </div>
                <?php endwhile;?>
            <?php endif;?>
        </div>
    </div>
</div>
<?php endif;?>