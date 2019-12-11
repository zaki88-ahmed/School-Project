<?php 
/**
 * metlux Theme Customizer.
 *
 * @package metlux
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function metlux_customize_register( $wp_customize ) {
  $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'metlux_customize_register' );

add_action('after_setup_theme','metlux_customize_appearance_header_options');

function metlux_customize_appearance_header_options () {


add_theme_support( 'custom-logo', array(
  'height'      => 45,
  'width'       => 200,
  'flex-height' => true,
  'flex-width'  => true,
  'default'   =>get_template_directory_uri().'/images/logo.png',
 ) );

}



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function metlux_customize_preview_js() {
  wp_enqueue_script( 'metlux_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'metlux_customize_preview_js' );


function metlux_theme_sanitize_category($input){
  $output=intval($input);
  return $output;
}
/**
 * Sanitize Checkbox.
 * @param $input
 * @return int|string
 */
function metlux_theme_sanitize_checkbox( $input ) {
  if ( $input == 1 ) {
    return 1;
  } else {
    return '';
  }
}
/**
 * Sanitize Text Field
 * @param $input
 * @return int|string
 */
function metlux_theme_sanitize_text( $input ) {
    return sanitize_text_field($input);
}

if ( ! function_exists( 'metlux_theme_sanitize_dropdown_pages' ) ) :
    /**
     * Function to sanitize post/page/post type
     *
     * @access public
     * @since 1.1
     *
     * @param int $metlux_post_id
     * @param object $metlux_setting
     * @return int || float
     *
     */
function metlux_theme_sanitize_post( $metlux_post_id, $metlux_setting ) {
        // Ensure $metlux_post_id is an absolute integer.
        $metlux_post_id = absint( $metlux_post_id );

        // If $metlux_post_id is an ID of a published page, return it; otherwise, return the default.
        return ( 'publish' == get_post_status( $metlux_post_id ) ? $metlux_post_id : $metlux_setting->default );
    }

endif;
function metlux_theme_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}


function metlux_sanitize_image( $image, $setting ) {
  /*
   * Array of valid image file types.
   *
   * The array includes image mime types that are included in wp_get_mime_types()
   */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
  // Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
  // If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}
