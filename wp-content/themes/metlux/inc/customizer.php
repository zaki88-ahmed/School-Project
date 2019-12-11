<?php
/******************************************
Customizer Base
 *******************************************/
require trailingslashit( get_template_directory() ).'inc/customizer/customizer-base.php';

function metlux_customizer( $wp_customize ) 
{

   

    /**
    * Customizer for Slider 
    */
    require get_template_directory() . '/inc/customizer/customizer-slider.php';
     /**
    * Customizer for Welcome 
    */
    require get_template_directory() . '/inc/customizer/customizer-welcome.php';

 /**
    * Customizer for service 
    */
    require get_template_directory() . '/inc/customizer/customizer-service.php';

 /**
    * Customizer for product 
    */
    require get_template_directory() . '/inc/customizer/customizer-product.php';

 /**
    * Customizer for Video 
    */
    require get_template_directory() . '/inc/customizer/customizer-video.php';

 /**
    * Customizer for team 
    */
    require get_template_directory() . '/inc/customizer/customizer-team.php';

 /**
    * Customizer for Testimonial 
    */
    require get_template_directory() . '/inc/customizer/customizer-testimonial.php';

 /**
    * Customizer for Blog 
    */
    require get_template_directory() . '/inc/customizer/customizer-blog.php';

 /**
    * Customizer for Newsletter 
    */
    require get_template_directory() . '/inc/customizer/customizer-newsletter.php';

 /**
    * Customizer for Client 
    */
    require get_template_directory() . '/inc/customizer/customizer-client.php';

 /**
    * Customizer for Other setting 
    */
    require get_template_directory() . '/inc/customizer/customizer-other.php';




}
add_action( 'customize_register', 'metlux_customizer' );
