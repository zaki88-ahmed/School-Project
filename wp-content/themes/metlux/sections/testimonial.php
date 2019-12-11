<!--==================================
=            Testimonials            =
===================================-->
<?php 
    $sectionenable = esc_attr(get_theme_mod('testimonial_enable',1));
    if($sectionenable==1){
        $title = esc_attr(get_theme_mod('testimonial_title', __('Testimonial Title','metlux')));
        $desc   = esc_html(get_theme_mod('testimonial_content',__('Testimonial Subtitle','metlux')));
        $postn = esc_attr(get_theme_mod('testimonial_no_of_posts','4'));
        $catId = esc_attr(get_theme_mod('metlux_testimonial_category_display',1));
        
?>
 <section class="testimonials"  >
    <div class="container">
    <div class="row">
            <div class="col-sm-12">
                <!-- Section Title -->
                <div class="section-title">
                    <h2><?php echo $title; ?></h2>
                    <div class="divider"></div>
                    <p><?php echo $desc; ?></p>
                </div>
            </div>
        </div>
        <div class="row"><div id="testimonials" class="owl-carousel owl-theme">
        <?php 
         global $post;
    $counter=1;
    $the_query = new WP_Query( array ( 'posts_per_page' => $postn, 'cat'=>$catId ) );
    while ( $the_query->have_posts() ):
        $the_query->the_post();
        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'metlux-customer' );
        $featured_image = esc_url($featured_image[0]);
        if($counter%2==1){
            $position = 'top';
        }else{
            $position = 'bottom';
        }
       ?>
       <div class="item">
              <div class="single">
    <?php
        if($position=="bottom"){
    ?>
                    <div class="image">
    <?php 
        if ( !has_post_thumbnail() ) {
                     echo   $testimonials='<img src="'.esc_url(get_template_directory_uri()).'/images/clients/c1.jpg" alt="">';
                    }
        else{   
                      echo  $testimonials= '<img src="'.$featured_image.'" alt="">';
        }     
        ?>  
                </div>
        <?php
        }

        echo  $testimonials='<div class="feedback '.$position.'">
                    <p>'.get_the_excerpt().'</p>
                    <a href="'.esc_url(get_permalink()).'" title="">'.esc_attr(get_the_title()).'</a>
                </div>';
        if($position=="top"){
               echo $testimonials='<div class="image">';
            if ( !has_post_thumbnail() ) {
                          echo   $testimonials='<img src="'.esc_url(get_template_directory_uri()).'/images/clients/c1.jpg" alt="">';
                        }
            else{   
                          echo    $testimonials= '<img src="'.$featured_image.'" alt="">';
            }       
            echo   $testimonials='</div>';
        }
         
         echo $testimonials='</div></div>';
          
    $counter=$counter+1;            
    endwhile;
    
   echo  $testimonials = '</div></div></div></section>';
   
    wp_reset_postdata();
    ?>

<?php }?>
