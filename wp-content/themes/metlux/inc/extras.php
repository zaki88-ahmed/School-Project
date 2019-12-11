<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package metlux
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */


function metlux_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'metlux_categories' );
}
add_action( 'edit_category', 'metlux_category_transient_flusher' );
add_action( 'save_post',     'metlux_category_transient_flusher' );


function metlux_customize_css()
{

    $bimagevideo = esc_url(get_theme_mod('video_background'));
     if($bimagevideo){
         $bimagevideo = esc_url(get_theme_mod('video_background'));
     }else{
         $bimagevideo = esc_url(get_template_directory_uri());
         $bimagevideo.= '/images/slider3.jpg';
     }

      $bimageservice = esc_url(get_theme_mod('service_background'));
        if($bimageservice){
            $bimageservice = esc_url(get_theme_mod('service_background'));
        }else{
             $bimageservice = esc_url(get_template_directory_uri());
            $bimageservice.= '/images/slider2.jpg';
        }

        $bimagenewsletter = esc_url(get_theme_mod('newsletter_background'));
         if($bimagenewsletter){
         $bimagenewsletter = esc_url(get_theme_mod('newsletter_background'));
         }else{
             $bimagenewsletter = esc_url(get_template_directory_uri());
             $bimagenewsletter.= '/images/slider3.jpg';
         }
    ?>
    <style type="text/css">
    .metlux-video{
        background:url('<?php echo  $bimagevideo ?>');
    }
     .services{
        background:url('<?php echo  $bimageservice ?>');
    }
    .home-newsletter{
        background:url('<?php echo  $bimagenewsletter ?>');
    }
   


    <?php 
     if(get_header_image() ){
        ?>
       
        .page-header{
            background:url('<?php echo  header_image(); ?>');
        }
      
    <?php
     }
        
    $background_color = esc_attr(get_background_color());
    if($background_color){
    ?>
         
         .testimonials{
            background: #<?php $background_color; ?>;
         }
           </style>
    <?php
}
}
add_action( 'wp_head', 'metlux_customize_css');
