<!--===========================
=            Brand            =
============================-->
<?php 
    $sectionenable = esc_attr(get_theme_mod('client_enable',1));
    if($sectionenable==1){
       
        $postn = esc_attr(get_theme_mod('client_no_of_posts','7'));
        $catId = esc_attr(get_theme_mod('metlux_client_category_display',1));
        

 echo $clients = '<section class="brand-carousel" >
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                             <h6 class="hidden">'.__('Brand Carousel','metlux').'</h6>
                           <div id="brand-carousel">';
    global $post;
    $counter=1;
    $the_query = new WP_Query( array ( 'posts_per_page' => $postn, 'cat'=>$catId ) );
    while ( $the_query->have_posts()): 
    $the_query->the_post();
    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'metlux-clientLogo' );
    $featured_image = esc_url($featured_image[0]);                    
    echo $clients='<div class="item">';
    
    if ( !has_post_thumbnail() ) {
                     echo   $clients='<img src="'.esc_url(get_template_directory_uri()).'/images/brand/logo1.png" class="center-block" alt=""></div>';
                    }
    else{   
                       echo  $clients='<img src="'.$featured_image.'" class="center-block" alt=""></div>';
        } 
     $counter=$counter+1;            
    endwhile;
    wp_reset_postdata();            
    echo $clients='</div></div></div></div></section>';
    ?>

<?php }?>