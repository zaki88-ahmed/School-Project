<?php
/**
 * education-one Theme Customizer.
 *
 * @package education-one
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function education_one_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'education_one_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function education_one_customize_preview_js() {
	wp_enqueue_script( 'education-one-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'education_one_customize_preview_js' );

function education_one_customize_pro_js() {
	wp_enqueue_script( 'education-one-customize-controls', trailingslashit( get_template_directory_uri() ) . 'js/education-customizer.js', array( 'customize-controls','jquery' ) , '1.0.0', true);  
	
	wp_enqueue_style( 'education_one-customizer-css',trailingslashit( get_template_directory_uri()) . 'css/customizer.css' );

	}
add_action( 'customize_controls_enqueue_scripts', 'education_one_customize_pro_js' );

function education_one_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function education_one_sanitize_category($input){
  $output=absint($input);
  return $output;
}
function education_one_sanitize_html( $input ) {
    return wp_filter_post_kses( $input );
}
function education_one_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
function education_one_sanitize_image( $image, $setting ) {
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
    $file = wp_check_filetype( $image, $mimes );
    return ( $file['ext'] ? $image : $setting->default );
}
function education_one_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function education_one_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function education_one_customizer_register( $wp_customize ) 
    {

	
     // Load custom sections.
	 if ( ! class_exists( 'Education_One_Customize_Section_Pro' )) {
		 get_template_part( 'inc/education-pro');
	 }
     // Register custom section types.
     $wp_customize->register_section_type( 'Education_One_Customize_Section_Pro' );
     // Register sections.
    $wp_customize->add_section(
      new Education_One_Customize_Section_Pro(
        $wp_customize,
        'Education-One',
        array(
		  'priority' => 1,
          'title'    => esc_html__( 'Education Plus', 'education-one' ),
          'pro_text' => esc_html__( 'Buy Pro',         'education-one' ),
          'pro_url'  => 'https://oceanwebthemes.com/webthemes/education-plus-wordpress-theme/'
		  )
      )
    );		
       $wp_customize->add_panel( 'theme_option', array(
        'priority' => 220,
        'title' => esc_html(__( 'Education One Theme Option', 'education-one')),
        'description' => esc_html(__( 'Education One Theme Option Panel', 'education-one')),
      ));
  
        /**********************************************/
      /************* MAIN SLIDER SECTION *************/
      /**********************************************/      

      $wp_customize->add_section('main_slider_category',array(
        'priority' => 20,
        'title' => esc_html(__('Slider Categories','education-one')),
        'description' => esc_html(__('Select the Slide Category for Frontpage.','education-one')),
        'panel' => 'theme_option'
      ));

       $wp_customize->add_setting(
        'section_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Home','education-one'))
          )
      );
      $wp_customize->add_control(
        'section_title',
         array(
          'label' => esc_html(__('Section Menu Title','education-one')),
          'section' => 'main_slider_category',
          'settings' => 'section_title',
          'type' => 'text',
         )
      );

      $wp_customize->add_setting('slider_category_display',array(
        'sanitize_callback' => 'education_one_sanitize_category',
        'default' => '0'
      ));

      $wp_customize->add_control(new education_one_Customize_Dropdown_Taxonomies_Control($wp_customize,'slider_category_display',array(
        'label' => esc_html(__('Choose category','education-one')),
        'section' => 'main_slider_category',
        'settings' => 'slider_category_display',
        'type'=> 'dropdown-taxonomies',
        )  
      ));
        // enable/disable slider
      $wp_customize->add_setting( 'slider_disable', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
     'default'   =>'0',
    ) );

    $wp_customize->add_control( 'slider_disable', array(
    'label'   => esc_html(__( 'Check to disable Slider', 'education-one')),
    'section'   => 'main_slider_category',
    'settings'  => 'slider_disable',
   
    'type'       => 'radio',
    'choices'    => array(
    '0'   => esc_html(__('Disable','education-one')),
    '1'  => esc_html(__('Enable','education-one')),
                  ),
    ) );
    // no of posts to show on slider
    $wp_customize->add_setting( 'slider_no_of_posts', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
    'default'           => esc_html(__('3','education-one')),
    ) );

    $wp_customize->add_control( 'slider_no_of_posts', array(
    'settings' => 'slider_no_of_posts',
    'label'                 =>  esc_html(__( 'No Of Posts To Show On Slider', 'education-one')),
    'section'               => 'main_slider_category',
    
    'type'                  => 'select',
    'choices'               => array(
         '1' => esc_html(__( '1', 'education-one')),
         '2' => esc_html(__( '2 ', 'education-one')),
         '3' => esc_html(__( '3', 'education-one'))
                        ),
    'priority'              => 20
    ) );

       // enable/disable slider
  $wp_customize->add_setting( 'readmore_slider_disable', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
     'default'   =>'0',
    ) );

    $wp_customize->add_control( 'readmore_slider_disable', array(
    'label'   => esc_html(__( 'Enable/Disable Readmore Button', 'education-one')),
    'section'   => 'main_slider_category',
    'settings'  => 'readmore_slider_disable',
   
    'type'       => 'radio',
    'choices'    => array(
    '0'   => esc_html(__('Disable','education-one')),
    '1'  => esc_html(__('Enable','education-one')),
                  ),
    ) );


     $wp_customize->add_setting(
        'section_readmore_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Read More','education-one'))
          )
      );
      $wp_customize->add_control(
        'section_readmore_title',
         array(
          'label' => esc_html(__('Slider Read More Title','education-one')),
          'section' => 'main_slider_category',
          'settings' => 'section_readmore_title',
          'type' => 'text',
         )
      );
	  
     $wp_customize->add_setting(
        'section_Button_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Services','education-one'))
          )
      );
      $wp_customize->add_control(
        'section_Button_title',
         array(
          'label' => esc_html(__('Slider Button Title','education-one')),
          'section' => 'main_slider_category',
          'settings' => 'section_Button_title',
          'type' => 'text',
         )
      );
       $wp_customize->add_setting(
        'section_Button_link',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'default' => esc_html(__('#','education-one'))
          )
      );
      $wp_customize->add_control(
        'section_Button_link',
         array(
          'label' => esc_html(__('Slider Button Link','education-one')),
          'section' => 'main_slider_category',
          'settings' => 'section_Button_link',
          'type' => 'url',
         )
      );


        /**********************************************/
      /************* ABOUT  SECTION *************/
      /**********************************************/      

      $wp_customize->add_section('about_section',array(
        'priority' => 20,
        'title' => esc_html(__('About  Section','education-one')),
        'description' => esc_html(__('About Us Section','education-one')),
        'panel' => 'theme_option'
      ));

       $wp_customize->add_setting(
        'about_menu_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('About','education-one'))
          )
      );
      $wp_customize->add_control(
        'about_menu_title',
         array(
          'label' => esc_html(__('Section Menu Title','education-one')),
          'section' => 'about_section',
          'settings' => 'about_menu_title',
          'type' => 'text',
         )
      );

       $wp_customize->add_setting(
        'about_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('About Us','education-one'))
          )
      );
      $wp_customize->add_control(
        'about_title',
         array(
          'label' => esc_html(__('Section Title','education-one')),
          'section' => 'about_section',
          'settings' => 'about_title',
          'type' => 'text',
         )
      );
      $wp_customize->add_setting(
        'about_text',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' =>''
          )
      );
      $wp_customize->add_control(
        'about_text',
         array(
          'label' => esc_html(__('Section Text','education-one')),
          'section' => 'about_section',
          'settings' => 'about_text',
          'type' => 'text',
         )
      );
      
       $wp_customize->add_setting(
        'about_icon',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('fa fa-laptop','education-one')),
              'description'=> esc_html(__('Use font-awesome class','education-one'))
          )
      );
      $wp_customize->add_control(
        'about_icon',
         array(
          'label' => esc_html(__('Section Icon','education-one')),
          'section' => 'about_section',
          'settings' => 'about_icon',
          'type' => 'text',
         )
      );

      $wp_customize->add_setting('about_category_display',array(
        'sanitize_callback' => 'education_one_sanitize_category',
        'default' => '0'
      ));

      $wp_customize->add_control(new education_one_Customize_Dropdown_Taxonomies_Control($wp_customize,'about_category_display',array(
        'label' => esc_html(__('Choose category','education-one')),
        'section' => 'about_section',
        'settings' => 'about_category_display',
        'type'=> 'dropdown-taxonomies',
        )  
      ));
	     // no of posts to show on slider
    $wp_customize->add_setting( 'about_no_of_posts', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
    'default'           => esc_html(__('4','education-one')),
    ) );

    $wp_customize->add_control( 'about_no_of_posts', array(
    'settings' => 'about_no_of_posts',
    'label'    =>  esc_html(__( 'No Of Posts To Show On About', 'education-one')),
    'section'  => 'about_section',
    
    'type'     => 'select',
    'choices'  => array(
	     '0' => esc_html(_X( '0', 'education-one')),
         '2' => esc_html(__( '2', 'education-one')),
         '3' => esc_html(__( '3 ', 'education-one')),
         '4' => esc_html(__( '4', 'education-one')),
        
          ),
    'priority'              => 20
    ) );
	  
        // enable/disable slider
  $wp_customize->add_setting( 'about_disable', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
     'default'   =>'1',
    ) );
  $wp_customize->add_control( 'about_disable', array(
    'label'   => esc_html(__( 'Check to disable About Section', 'education-one')),
    'section'   => 'about_section',
    'settings'  => 'about_disable',
   
    'type'       => 'radio',
    'choices'    => array(
                          '0'   => esc_html(__('Disable','education-one')),
                          '1'  => esc_html(__('Enable','education-one')),
                  ),
    ) );


        /**********************************************/
      /************* ABOUT TIMER SECTION *************/
      /**********************************************/      
       $wp_customize->add_section('about_timer_section',array(
        'priority' => 20,
        'title' => esc_html(__('About Timer  Section','education-one')),
        'description' => esc_html(__('About Timer Section Value','education-one')),
        'panel' => 'theme_option'
      ));

           // enable/disable slider
      $wp_customize->add_setting( 'about_timer_disable', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
     'default'   =>'1',
    ) );
  $wp_customize->add_control( 'about_timer_disable', array(
    'label'   => esc_html(__( 'Check to disable About Timer Section', 'education-one')),
    'section'   => 'about_timer_section',
    'settings'  => 'about_timer_disable',
   
    'type'       => 'radio',
    'choices'    => array(
                          '0'   => esc_html(__('Disable','education-one')),
                          '1'  => esc_html(__('Enable','education-one')),
                  ),
    ) );


     
    for ( $i = 1; $i <= 4; $i++ ) { 
       $wp_customize->add_setting('education_one_counter'.$i,array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'=> '323'.$i,
        
      ));
      $wp_customize->add_control('education_one_counter'.$i,array(
        'label' => esc_html(__('education-one Counter' ,'education-one')).$i,
        'section' => 'about_timer_section',
        
        'settings' => 'education_one_counter'.$i,
        'type' => 'text'
      ));  
       $wp_customize->add_setting('education_one_title'.$i,array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'=> esc_html(__('Design And Developers','education-one')).$i,
        
      ));
      $wp_customize->add_control('education_one_title'.$i,array(
        'label' => esc_html(__('education-one About Timer Title' ,'education-one')).$i,
        'section' => 'about_timer_section',
        
        'settings' => 'education_one_title'.$i,
        'type' => 'text'
      )); 
           

    }
    $wp_customize->add_setting('timer_background', array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_image'
    ));

 $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'timer_background', array(
    'label' => esc_html(__('Upload Background Image For Service Section', 'education-one')),
    'section' => 'about_timer_section',
    'setting' => 'timer_background',
    'priority'              => 20
    )));



        /**********************************************/
      /************* SERVICES  SECTION *************/
      /**********************************************/      

      $wp_customize->add_section('service_section',array(
        'priority' => 20,
        'title' => esc_html(__('Services  Section','education-one')),
        'description' => esc_html(__('Service Section Values','education-one')),
        'panel' => 'theme_option'
      ));

       $wp_customize->add_setting(
        'service_menu_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Services','education-one'))
          )
      );
      $wp_customize->add_control(
        'service_menu_title',
         array(
          'label' => esc_html(__('Section Menu Title','education-one')),
          'section' => 'service_section',
          'settings' => 'service_menu_title',
          'type' => 'text',
         )
      );

       $wp_customize->add_setting(
        'service_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Services ','education-one'))
          )
      );
      $wp_customize->add_control(
        'service_title',
         array(
          'label' => esc_html(__('Section Title','education-one')),
          'section' => 'service_section',
          'settings' => 'service_title',
          'type' => 'text',
         )
      );
       $wp_customize->add_setting(
        'service_text',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => ''
          )
      );
      $wp_customize->add_control(
        'service_text',
         array(
          'label' => esc_html(__('Section Subtitle','education-one')),
          'section' => 'service_section',
          'settings' => 'service_text',
          'type' => 'text',
         )
      );


       $wp_customize->add_setting(
        'service_icon',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('fa fa-laptop','education-one')),
              'description'=> esc_html(__('Use font-awesome class','education-one'))
          )
      );
      $wp_customize->add_control(
        'service_icon',
         array(
          'label' => esc_html(__('Section Icon','education-one')),
          'section' => 'service_section',
          'settings' => 'service_icon',
          'type' => 'text',
         )
      );

      $wp_customize->add_setting('service_category_display',array(
        'sanitize_callback' => 'education_one_sanitize_category',
        'default' => '0'
      ));

      $wp_customize->add_control(new education_one_Customize_Dropdown_Taxonomies_Control($wp_customize,'service_category_display',array(
        'label' => esc_html(__('Choose category','education-one')),
        'section' => 'service_section',
        'settings' => 'service_category_display',
        'type'=> 'dropdown-taxonomies',
        )  
      ));
        // enable/disable slider
      $wp_customize->add_setting( 'service_disable', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
     'default'   =>'1',
    ) );
  $wp_customize->add_control( 'service_disable', array(
    'label'   => esc_html(__( 'Check to disable Services Section', 'education-one')),
    'section'   => 'service_section',
    'settings'  => 'service_disable',
   
    'type'       => 'radio',
    'choices'    => array(
                          '0'   => esc_html(__('Disable','education-one')),
                          '1'  => esc_html(__('Enable','education-one')),
                  ),
    ) );
    // no of posts to show on slider
    $wp_customize->add_setting( 'service_no_of_posts', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
    'default'           => esc_html(__('3','education-one')),
    ) );

    $wp_customize->add_control( 'service_no_of_posts', array(
    'settings' => 'service_no_of_posts',
    'label'    =>  esc_html(__( 'No Of Posts To Show On Services', 'education-one')),
    'section'  => 'service_section',
    
    'type'     => 'select',
    'choices'  => array(
	     '0' => esc_html(_X( '0', 'education-one')),
         '3' => esc_html(__( '3', 'education-one')),
         '6' => esc_html(__( '6 ', 'education-one')),
         '9' => esc_html(__( '9', 'education-one')),
        
          ),
    'priority'              => 20
    ) );

 /**********************************************/
      /************* CTA  SECTION *************/
      /**********************************************/      

      $wp_customize->add_section('cta_section',array(
        'priority' => 20,
        'title' => esc_html(__('CTA  Section','education-one')),
        'description' => esc_html(__('Call To Action Section','education-one')),
        'panel' => 'theme_option'
      ));

      
       $wp_customize->add_setting(
        'cta_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('READY TO WORK? ','education-one'))
          )
      );
      $wp_customize->add_control(
        'cta_title',
         array(
          'label' => esc_html(__('Section Title','education-one')),
          'section' => 'cta_section',
          'settings' => 'cta_title',
          'type' => 'text',
         )
      );
       $wp_customize->add_setting(
        'cta_text',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Section Subtitle','education-one'))
          )
      );
      $wp_customize->add_control(
        'cta_text',
         array(
          'label' => esc_html(__('Section Text','education-one')),
          'section' => 'cta_section',
          'settings' => 'cta_text',
          'type' => 'text',
         )
      );

       $wp_customize->add_setting(
        'cta_button_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Button ','education-one'))
          )
      );
      $wp_customize->add_control(
        'cta_button_title',
         array(
          'label' => esc_html(__('Button Title','education-one')),
          'section' => 'cta_section',
          'settings' => 'cta_button_title',
          'type' => 'text',
         )
      );
      $wp_customize->add_setting(
        'cta_button_link',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'default' => esc_html(__('#','education-one'))
          )
      );
      $wp_customize->add_control(
        'cta_button_link',
         array(
          'label' => esc_html(__('Button Link','education-one')),
          'section' => 'cta_section',
          'settings' => 'cta_button_link',
          'type' => 'text',
         )
      );
        // enable/disable slider
  $wp_customize->add_setting( 'cta_disable', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
     'default'   =>'1',
    ) );
  $wp_customize->add_control( 'cta_disable', array(
    'label'   => esc_html(__( 'Check to disable CTA Section', 'education-one')),
    'section'   => 'cta_section',
    'settings'  => 'cta_disable',
   
    'type'       => 'radio',
    'choices'    => array(
                          '0'   => esc_html(__('Disable','education-one')),
                          '1'  => esc_html(__('Enable','education-one')),
                  ),
    ) );
  
      


 $wp_customize->add_setting('cta_background', array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_image'
    ));

 $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cta_background', array(
    'label' => esc_html(__('Upload Background Image For CTA Section', 'education-one')),
    'section' => 'cta_section',
    'setting' => 'cta_background',
    'priority'              => 20
    )));



        /**********************************************/
      /************* PORTFOLIO  SECTION *************/
      /**********************************************/      

      $wp_customize->add_section('portfolio_section',array(
        'priority' => 20,
        'title' => esc_html(__('Portfolio  Section','education-one')),
        'description' => esc_html(__('Portfolio Section','education-one')),
        'panel' => 'theme_option'
      ));

       $wp_customize->add_setting(
        'portfolio_menu_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Portfolio','education-one'))
          )
      );
      $wp_customize->add_control(
        'portfolio_menu_title',
         array(
          'label' => esc_html(__('Section Menu Title','education-one')),
          'section' => 'portfolio_section',
          'settings' => 'portfolio_menu_title',
          'type' => 'text',
         )
      );

       $wp_customize->add_setting(
        'portfolio_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Portfolio ','education-one'))
          )
      );
      $wp_customize->add_control(
        'portfolio_title',
         array(
          'label' => esc_html(__('Section Title','education-one')),
          'section' => 'portfolio_section',
          'settings' => 'portfolio_title',
          'type' => 'text',
         )
      );
       $wp_customize->add_setting(
        'portfolio_text',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Section Subtitle','education-one'))
          )
      );
      $wp_customize->add_control(
        'portfolio_text',
         array(
          'label' => esc_html(__('Section Subtitle','education-one')),
          'section' => 'portfolio_section',
          'settings' => 'portfolio_text',
          'type' => 'text',
         )
      );


     

      $wp_customize->add_setting('portfolio_category_display',array(
        'sanitize_callback' => 'education_one_sanitize_category',
        'default' => '0'
      ));

      $wp_customize->add_control(new education_one_Customize_Dropdown_Taxonomies_Control($wp_customize,'portfolio_category_display',array(
        'label' => esc_html(__('Choose category','education-one')),
        'section' => 'portfolio_section',
        'settings' => 'portfolio_category_display',
        'type'=> 'dropdown-taxonomies',
        )  
      ));
        // enable/disable slider
      $wp_customize->add_setting( 'portfolio_disable', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
     'default'   =>'1',
    ) );
  $wp_customize->add_control( 'portfolio_disable', array(
    'label'   => esc_html(__( 'Check to disable Portfolio Section', 'education-one')),
    'section'   => 'portfolio_section',
    'settings'  => 'portfolio_disable',
   
    'type'       => 'radio',
    'choices'    => array(
                          '0'   => esc_html(__('Disable','education-one')),
                          '1'  => esc_html(__('Enable','education-one')),
                  ),
    ) );

   
    /**********************************************/
      /************* TEAM  SECTION *************/
      /**********************************************/      

      $wp_customize->add_section('team_section',array(
        'priority' => 20,
        'title' => esc_html(__('Team  Section','education-one')),
        'description' => esc_html(__('Team Section','education-one')),
        'panel' => 'theme_option'
      ));

       $wp_customize->add_setting(
        'team_menu_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Team','education-one'))
          )
      );
      $wp_customize->add_control(
        'team_menu_title',
         array(
          'label' => esc_html(__('Section Menu Title','education-one')),
          'section' => 'team_section',
          'settings' => 'team_menu_title',
          'type' => 'text',
         )
      );

       $wp_customize->add_setting(
        'team_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Team ','education-one'))
          )
      );
      $wp_customize->add_control(
        'team_title',
         array(
          'label' => esc_html(__('Section Title','education-one')),
          'section' => 'team_section',
          'settings' => 'team_title',
          'type' => 'text',
         )
      );
       $wp_customize->add_setting(
        'team_text',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Section Subtitle','education-one'))
          )
      );
      $wp_customize->add_control(
        'team_text',
         array(
          'label' => esc_html(__('Section text','education-one')),
          'section' => 'team_section',
          'settings' => 'team_text',
          'type' => 'text',
         )
      );


     

      $wp_customize->add_setting('team_category_display',array(
        'sanitize_callback' => 'education_one_sanitize_category',
        'default' => '0'
      ));

      $wp_customize->add_control(new education_one_Customize_Dropdown_Taxonomies_Control($wp_customize,'team_category_display',array(
        'label' => esc_html(__('Choose category','education-one')),
        'section' => 'team_section',
        'settings' => 'team_category_display',
        'type'=> 'dropdown-taxonomies',
        )  
      ));
        // enable/disable slider
      $wp_customize->add_setting( 'team_disable', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
     'default'   =>'1',
    ) );
  $wp_customize->add_control( 'team_disable', array(
    'label'   => esc_html(__( 'Check to disable Team Section', 'education-one')),
    'section'   => 'team_section',
    'settings'  => 'team_disable',
   
    'type'       => 'radio',
    'choices'    => array(
                          '0'   => esc_html(__('Disable','education-one')),
                          '1'  => esc_html(__('Enable','education-one')),
                  ),
    ) );


    // no of posts to show on slider
    $wp_customize->add_setting( 'team_no_of_posts', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
    'default'           => esc_html(__('5','education-one')),
    ) );

    $wp_customize->add_control( 'team_no_of_posts', array(
    'settings' => 'team_no_of_posts',
    'label'    =>  esc_html(__( 'No Of Posts To Show On Team', 'education-one')),
    'section'  => 'team_section',
    
    'type'     => 'select',
    'choices'  => array(
	     '0' => esc_html(_X( '0', 'education-one')),
         '5' => esc_html(__( '5', 'education-one')),
         '10' => esc_html(__( '10 ', 'education-one')),
         '15' => esc_html(__( '15', 'education-one')),
        
          ),
    'priority'              => 20
    ) );

    /**********************************************/
      /************* PRICING  SECTION *************/
      /**********************************************/      

  $wp_customize->add_section('pricing_section',array(
        'priority' => 20,
        'title' => esc_html(__('Pricing  Section','education-one')),
        'description' => esc_html(__('This section is related to widget, If you enable this section then manage it Using education-one Pricing Widget.','education-one')),
        'panel' => 'theme_option'
      ));

  $wp_customize->add_setting(
        'pricing_menu_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Pricing','education-one'))
          )
      );
  $wp_customize->add_control(
        'pricing_menu_title',
         array(
          'label' => esc_html(__('Section Menu Title','education-one')),
          'section' => 'pricing_section',
          'settings' => 'pricing_menu_title',
          'type' => 'text',
         )
      );

  $wp_customize->add_setting(
        'pricing_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Pricing ','education-one'))
          )
      );
  $wp_customize->add_control(
        'pricing_title',
         array(
          'label' => esc_html(__('Section Title','education-one')),
          'section' => 'pricing_section',
          'settings' => 'pricing_title',
          'type' => 'text',
         )
      );

   $wp_customize->add_setting(
        'pricing_text',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => ''
          )
      );
  $wp_customize->add_control(
        'pricing_text',
         array(
          'label' => esc_html(__('Section Content','education-one')),
          'section' => 'pricing_section',
          'settings' => 'pricing_text',
          'type' => 'text',
         )
      );

         // enable/disable slider
 $wp_customize->add_setting( 'pricing_disable', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
     'default'   =>'1',
    ) );
  $wp_customize->add_control( 'pricing_disable', array(
    'label'   => esc_html(__( 'Check to disable Pricing Section', 'education-one')),
    'section'   => 'pricing_section',
    'settings'  => 'pricing_disable',
   
    'type'       => 'radio',
    'choices'    => array(
                          '0'   => esc_html(__('Disable','education-one')),
                          '1'  => esc_html(__('Enable','education-one')),
                  ),
    ) );
  $wp_customize->add_setting('pricing_background', array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_image'
    ));

 $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pricing_background', array(
    'label' => esc_html(__('Upload Background Image For Service Section', 'education-one')),
    'section' => 'pricing_section',
    'setting' => 'pricing_background',
    'priority'              => 20
    )));


     /**********************************************/
      /************* BLOG  SECTION *************/
      /**********************************************/      

      $wp_customize->add_section('blog_section',array(
        'priority' => 20,
        'title' => esc_html(__('Blog  Section','education-one')),
        'description' => esc_html(__('Blog Section','education-one')),
        'panel' => 'theme_option'
      ));

       $wp_customize->add_setting(
        'blog_menu_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Blog','education-one'))
          )
      );
      $wp_customize->add_control(
        'blog_menu_title',
         array(
          'label' => esc_html(__('Section Menu Title','education-one')),
          'section' => 'blog_section',
          'settings' => 'blog_menu_title',
          'type' => 'text',
         )
      );

       $wp_customize->add_setting(
        'blog_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Blog ','education-one'))
          )
      );
      $wp_customize->add_control(
        'blog_title',
         array(
          'label' => esc_html(__('Section Title','education-one')),
          'section' => 'blog_section',
          'settings' => 'blog_title',
          'type' => 'text',
         )
      );
      
      $wp_customize->add_setting('blog_category_display',array(
        'sanitize_callback' => 'education_one_sanitize_category',
        'default' => '0'
      ));

      $wp_customize->add_control(new education_one_Customize_Dropdown_Taxonomies_Control($wp_customize,'blog_category_display',array(
        'label' => esc_html(__('Choose category','education-one')),
        'section' => 'blog_section',
        'settings' => 'blog_category_display',
        'type'=> 'dropdown-taxonomies',
        )  
      ));
        // enable/disable slider
      $wp_customize->add_setting( 'blog_disable', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
     'default'   =>'1',
    ) );
  $wp_customize->add_control( 'blog_disable', array(
    'label'   => esc_html(__( 'Check to disable Blog Section', 'education-one')),
    'section'   => 'blog_section',
    'settings'  => 'blog_disable',
   
    'type'       => 'radio',
    'choices'    => array(
                          '0'   => esc_html(__('Disable','education-one')),
                          '1'  => esc_html(__('Enable','education-one')),
                  ),
    ) );

   // no of posts to show on slider
    $wp_customize->add_setting( 'blog_no_of_posts', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
    'default'           => esc_html(__('4','education-one')),
    ) );

    $wp_customize->add_control( 'blog_no_of_posts', array(
    'settings' => 'blog_no_of_posts',
    'label'    =>  esc_html(__( 'No Of Posts To Show On Blog', 'education-one')),
    'section'  => 'blog_section',
    
    'type'     => 'select',
    'choices'  => array(
	     '0' => esc_html(_X( '0', 'education-one')),
         '4' => esc_html(__( '4', 'education-one')),
         '8' => esc_html(__( '8 ', 'education-one')),
         '12' => esc_html(__( '12', 'education-one')),
        
          ),
    'priority'              => 20
    ) );
 /**********************************************/
      /************* NEWSLETTER  SECTION *************/
      /**********************************************/      

      $wp_customize->add_section('newsletter_section',array(
        'priority' => 20,
        'title' => esc_html(__('Newsletter  Section ','education-one')),
        'description' => esc_html(__('Newsletter Section','education-one')),
        'panel' => 'theme_option'
      ));


     $wp_customize->add_setting('newsletter_background', array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_image'
    ));

 $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'newsletter_background', array(
    'label' => esc_html(__('Upload Background Image For Newsletter Section', 'education-one')),
    'section' => 'newsletter_section',
    'setting' => 'newsletter_background',
    'priority'              => 20
    )));

     /**********************************************/
      /************* CONTACT  SECTION *************/
      /**********************************************/      

      $wp_customize->add_section('contact_section',array(
        'priority' => 20,
        'title' => esc_html(__('Contact  Section','education-one')),
        'description' => esc_html(__('Contact Section','education-one')),
        'panel' => 'theme_option'
      ));

       $wp_customize->add_setting(
        'contact_menu_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Contact','education-one'))
          )
      );
      $wp_customize->add_control(
        'contact_menu_title',
         array(
          'label' => esc_html(__('Section  Title','education-one')),
          'section' => 'contact_section',
          'settings' => 'contact_menu_title',
          'type' => 'text',
         )
      );

      $wp_customize->add_setting(
        'contact_form',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Enter Contact Form Shortcode Here','education-one'))
          )
      );
      $wp_customize->add_control(
        'contact_form',
         array(
          'label' => esc_html(__(' Contact Form Shortcode','education-one')),
          'section' => 'contact_section',
          'settings' => 'contact_form',
          'type' => 'text',
         )
      );
    $wp_customize->add_setting( 'contact_disable', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
     'default'   =>'1',
    ) );
  $wp_customize->add_control( 'contact_disable', array(
    'label'   => esc_html(__( 'Check to disable Contact Section', 'education-one')),
    'section'   => 'contact_section',
    'settings'  => 'contact_disable',
   
    'type'       => 'radio',
    'choices'    => array(
                          '0'   => esc_html(__('Disable','education-one')),
                          '1'  => esc_html(__('Enable','education-one')),
                  ),
    ) );


      /**********************************************/
      /************* MAP  SECTION *************/
      /**********************************************/      

      $wp_customize->add_section('map_section',array(
        'priority' => 20,
        'title' => esc_html(__('Map  Section','education-one')),
        'description' => esc_html(__('Map Section','education-one')),
        'panel' => 'theme_option'
      ));

       $wp_customize->add_setting(
        'map_menu_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Google Map IFraming Code','education-one'))
          )
      );
      $wp_customize->add_control(
        'map_menu_title',
         array(
          'label' => esc_html(__('Section  Title','education-one')),
          'section' => 'map_section',
          'settings' => 'map_menu_title',
          'type' => 'text',
         )
      );

       $wp_customize->add_setting(
        'map_iframe',
            array(
              'sanitize_callback' => 'education_one_sanitize_html',
              'default' => esc_html(__('Input Google Map Embeding Code Here','education-one'))
          )
      );
      $wp_customize->add_control(
        'map_iframe',
         array(
          'label' => esc_html(__('Map Iframe URL','education-one')),
          'section' => 'map_section',
          'settings' => 'map_iframe',
          'type' => 'text',
         )
      );
       // enable/disable slider
      $wp_customize->add_setting( 'map_disable', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'education_one_sanitize_select',
     'default'   =>'1',
    ) );
  $wp_customize->add_control( 'map_disable', array(
    'label'   => esc_html(__( 'Check to disable Map Section', 'education-one')),
    'section'   => 'map_section',
    'settings'  => 'map_disable',
   
    'type'       => 'radio',
    'choices'    => array(
                          '0'   => esc_html(__('Disable','education-one')),
                          '1'  => esc_html(__('Enable','education-one')),
                  ),
    ) );

 /* ------ Footer Section ------ */

       $wp_customize->add_section('footer_section',array(
        'priority' => 40,
        'title' => esc_html(__(' Footer Section','education-one')),
        'description' => esc_html(__('Footer Section','education-one')),
        'panel' => 'theme_option'
      ));

      /* ------ Footer Section ------ */

      $wp_customize->add_setting(
        'footer_logo_text',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Education One','education-one'))
          )
      );
      $wp_customize->add_control(
        'footer_logo_text',
         array(
          'label' => esc_html(__('Footer Logo Text','education-one')),
          'section' => 'footer_section',
          'settings' => 'footer_logo_text',
          'type' => 'text',
         )
      );
       $wp_customize->add_setting(
        'facebook_link',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'default' => esc_html(__('#','education-one'))
          )
      );
      $wp_customize->add_control(
        'facebook_link',
         array(
          'label' => esc_html(__('Facebook link','education-one')),
          'section' => 'footer_section',
          'settings' => 'facebook_link',
          'type' => 'text',
         )
      );

      $wp_customize->add_setting(
        'twitter_link',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'default' => esc_html(__('#','education-one'))
          )
      );
      $wp_customize->add_control(
        'twitter_link',
         array(
          'label' => esc_html(__('Twitter link','education-one')),
          'section' => 'footer_section',
          'settings' => 'twitter_link',
          'type' => 'text',
         )
      );

  $wp_customize->add_setting(
        'googleplus_link',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'default' => esc_html(__('#','education-one'))
          )
      );
      $wp_customize->add_control(
        'googleplus_link',
         array(
          'label' => esc_html(__('Google Plus link','education-one')),
          'section' => 'footer_section',
          'settings' => 'googleplus_link',
          'type' => 'text',
         )
      );

       $wp_customize->add_setting(
        'instagram_link',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'default' => esc_html(__('#','education-one'))
          )
      );
      $wp_customize->add_control(
        'instagram_link',
         array(
          'label' => esc_html(__('Instagram link','education-one')),
          'section' => 'footer_section',
          'settings' => 'instagram_link',
          'type' => 'text',
         )
      );

      $wp_customize->add_setting(
        'youtube_link',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'default' => esc_html(__('#','education-one'))
          )
      );
      $wp_customize->add_control(
        'youtube_link',
         array(
          'label' => esc_html(__('Youtube link','education-one')),
          'section' => 'footer_section',
          'settings' => 'youtube_link',
          'type' => 'text',
         )
      );


 $wp_customize->add_setting(
        'linkedin_link',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'default' => esc_html(__('#','education-one'))
          )
      );
      $wp_customize->add_control(
        'linkedin_link',
         array(
          'label' => esc_html(__('Linkedin link','education-one')),
          'section' => 'footer_section',
          'settings' => 'linkedin_link',
          'type' => 'text',
         )
      );
      $wp_customize->add_setting(
        'skype_link',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'default' => esc_html(__('#','education-one'))
          )
      );
      $wp_customize->add_control(
        'skype_link',
         array(
          'label' => esc_html(__('Skype link','education-one')),
          'section' => 'footer_section',
          'settings' => 'skype_link',
          'type' => 'text',
         )
      );


      $wp_customize->add_setting(
        'copyright_text',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => esc_html(__('Copyright 2018','education-one'))
          )
      );
      $wp_customize->add_control(
        'copyright_text',
         array(
          'label' => esc_html(__('Copyright Text','education-one')),
          'section' => 'footer_section',
          'settings' => 'copyright_text',
          'type' => 'text',
         )
      );





       $wp_customize->add_panel( 'layout', array(
        'priority' => 220,
        'title' => esc_html(__( 'Education One Sidebar Layout', 'education-one')),
        'description' => esc_html(__( 'Education One Sidebar Layout', 'education-one')),
      ));
      $wp_customize->add_section('archive_sidebar' , array(
        'priority' => 10,
        'title' => esc_html(__('Archive Sidebar','education-one')),
        'panel' => 'layout'
      ));
   $wp_customize->add_setting('archive_sidebar_position', array(
        'sanitize_callback' => 'education_one_sanitize_select',
          'default' => esc_html(__('right','education-one'))
        ));
      $wp_customize->add_control('archive_sidebar_position', array(
        'label'      => esc_html(__('Archive Sidebar position', 'education-one')),
        'section'    => 'archive_sidebar',
        'settings'   => 'archive_sidebar_position',
        'type'       => 'radio',
        'choices'    => array(
          'none'   => esc_html(__('none','education-one')),
          'left'   => esc_html(__('left','education-one')),
          'right'  => esc_html(__('right','education-one')),
        ),

      ));

      /**********************************************/

      /********** SINGLE POST SIDEBAR SECTION ***********/

      /**********************************************/    

      $wp_customize->add_section('single_post_sidebar' , array(
        'priority' => 20,
        'title' => esc_html(__('Single Post Sidebar','education-one')),
        'panel' => 'layout'
      ));
      $wp_customize->add_setting('post_sidebar_position', array(
        'sanitize_callback' => 'education_one_sanitize_select',
         'default' => esc_html(__('right','education-one'))
      ));
      $wp_customize->add_control('post_sidebar_position', array(
        'label'      => esc_html(__('Single Post Sidebar position', 'education-one')),
        'section'    => 'single_post_sidebar',
        'settings'   => 'post_sidebar_position',
        'type'       => 'radio',
        'choices'    => array(
           'none'   => esc_html(__('none','education-one')),
          'left'   => esc_html(__('left','education-one')),
          'right'  => esc_html(__('right','education-one')),
        ),

      ));
    /**********************************************/

      /********** SINGLE PAGE SIDEBAR SECTION ***********/

      /**********************************************/     
     $wp_customize->add_section('single_page_sidebar' , array(
        'priority' => 30,
        'title' => esc_html(__('Single Page Sidebar','education-one')),
        'panel' => 'layout'
      ));
     $wp_customize->add_setting('page_sidebar_position', array(
        'sanitize_callback' => 'education_one_sanitize_select',
         'default' => esc_html(__('right','education-one'))
      ));
     $wp_customize->add_control('page_sidebar_position', array(
        'label'      => esc_html(__('Single Page Sidebar position', 'education-one')),
        'section'    => 'single_page_sidebar',
        'settings'   => 'page_sidebar_position',
        'type'       => 'radio',
        'choices'    => array(
           'none'   => esc_html(__('none','education-one')),
          'left'   => esc_html(__('left','education-one')),
          'right'  => esc_html(__('right','education-one')),
        ),

      ));
    
	
	$wp_customize->add_section('education_one_theme_info' , array(
        'priority' => 0,
        'title' => esc_html(__('Education One','education-one'))
      ));
	  
    $wp_customize->add_panel( 'meta_layout', array(
        'priority' => 221,
        'title' => esc_html(__( 'Education One Meta Layout', 'education-one')),
        'description' => esc_html(__( 'Education One Meta Layout', 'education-one')),
      ));
	$wp_customize->add_section('education_one_post_meta' , array(
        'priority' => 0,
        'title' => esc_html(__('Post Meta','education-one')),
		'panel' => 'meta_layout'
      ));
  	$wp_customize->add_section('education_one_page_meta' , array(
        'priority' => 0,
        'title' => esc_html(__('Page Meta','education-one')),
		'panel' => 'meta_layout'
      ));
  	$wp_customize->add_section('education_one_blog_meta' , array(
        'priority' => 0,
        'title' => esc_html(__('Blog Meta','education-one')),
		'panel' => 'meta_layout'
      ));

    }

add_action( 'customize_register', 'education_one_customizer_register' );


/*
* Kirki Fields
 */ 
function education_one_customizer_fields( $fields ) {
    
    
    $fields[] = array(
        'type'        => 'custom',
        'settings'    => 'education_one_theme_info',
        'label'       => esc_html__( 'EDUCATION ONE', 'education-one' ),
        'description' => wp_kses_post(__( '
        <h1>Education Plus</h1>
        <p><a class="button" href="https://oceanwebthemes.com/webthemes/education-plus-wordpress-theme/" target="_blank">Upgrade to Education Plus</a></p>
        <p>Upgrade to Education Plus and get access to premium features and dedicated support included with the premium version. View the <a href="https://oceanwebthemes.com/preview/?theme=education-plus" target="_blank">Education Plus Demo</a> to see the additional features and functionality that you will get after upgrade.</p>
        <p>Premium Theme Features:
        <ul>
            <li>&raquo; More slider options: custom slider</li>
            <li>&raquo; Full color customization</li>
            <li>&raquo; Unlimited fonts</li>
            <li>&raquo; Extra widgets</li>
            <li>&raquo; Barnding removal</li>
            <li>&raquo; Built-in social media sharing</li>
            <li>&raquo; Dedicated support and updates</li>
        </ul>
        </p>
        <hr />
        <h1>Current Theme: Education One</h1>
        <h3>Demo Site</h3>
        <p>Check out the <a  href="http://oceanwebthemes.com/preview/?theme=education-one" target="_blank">Education One Demo</a> and see what you can get with our theme.</p>
        <h3>Documentation</h3>
        <p>Read about the features which are available in this theme: </p>
        <p><a class="button" href="https://oceanwebthemes.com/doc/" target="_blank">Education One Documentation</a></p>
        <h3>Contact and Support</h3>
        <p>We are happy to assist if you have any feedback or support query.</p>
        <p><a class="button" href="https://oceanwebthemes.com/support" target="_blank">Education One Support</a></p>
        ', 'education-one' ) ),
        'section'     => 'education_one_theme_info',
        'priority'    => 1,

        );
		
	 // post meta
     $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'education_one_posts_meta_show',
        'label'       => esc_html__( 'Show Meta?', 'education-one' ),
        'description' => esc_html__( 'Choose whether to display date, category, author, tags for posts on the post page.', 'education-one' ),
        'section'     => 'education_one_post_meta',
        'priority'    => 1,
        'default'     => '1',
        'choices' => array( 'on'  => esc_attr__( 'SHOW', 'education-one' ), 'off' => esc_attr__( 'HIDE', 'education-one' ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'education_one_posts_date_show',
        'label'       => esc_html__( 'Show Date?', 'education-one' ),
        'section'     => 'education_one_post_meta',
        'priority'    => 2,
        'default'     => '1',
        'active_callback'  => array( array( 'setting'  => 'education_one_posts_meta_show', 'operator' => '==', 'value'    => '1', ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'education_one_posts_category_show',
        'label'       => esc_html__( 'Show Category?', 'education-one' ),
        'section'     => 'education_one_post_meta',
        'priority'    => 3,
        'default'     => '1',
        'active_callback'  => array( array( 'setting'  => 'education_one_posts_meta_show', 'operator' => '==', 'value'    => '1', ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'education_one_posts_author_show',
        'label'       => esc_html__( 'Show Author?', 'education-one' ),
        'section'     => 'education_one_post_meta',
        'priority'    => 4,
        'default'     => '1',
        'active_callback'  => array( array( 'setting'  => 'education_one_posts_meta_show', 'operator' => '==', 'value'    => '1', ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'education_one_posts_tags_show',
        'label'       => esc_html__( 'Show Tags?', 'education-one' ),
        'section'     => 'education_one_post_meta',
        'priority'    => 5,
        'default'     => '1',
        'active_callback'  => array( array( 'setting'  => 'education_one_posts_meta_show', 'operator' => '==', 'value'    => '1', ), )
    );
  
      $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'education_one_posts_comments_show',
        'label'       => esc_html__( 'Show Comment Count?', 'education-one' ),
        'section'     => 'education_one_post_meta',
        'priority'    => 5,
        'default'     => '1',
        'active_callback'  => array( array( 'setting'  => 'education_one_posts_meta_show', 'operator' => '==', 'value'    => '1', ), )
    );
	$fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'education_one_post_breadcrumbs_show',
        'label'       => esc_html__( 'Show Breadcrumbs?', 'education-one' ),
        'section'     => 'education_one_post_meta',
        'priority'    => 6,
        'default'     => '1',
        'active_callback'  => array( array( 'setting'  => 'education_one_posts_meta_show', 'operator' => '==', 'value'    => '1', ), )
    );
	// page meta
     $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'education_one_page_meta_show',
        'label'       => esc_html__( 'Show Meta?', 'education-one' ),
        'description' => esc_html__( 'Choose whether to display date, category, author, tags for posts on the post page.', 'education-one' ),
        'section'     => 'education_one_page_meta',
        'priority'    => 1,
        'default'     => '1',
        'choices' => array( 'on'  => esc_attr__( 'SHOW', 'education-one' ), 'off' => esc_attr__( 'HIDE', 'education-one' ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'education_one_page_date_show',
        'label'       => esc_html__( 'Show Date?', 'education-one' ),
        'section'     => 'education_one_page_meta',
        'priority'    => 2,
        'default'     => '1',
        'active_callback'  => array( array( 'setting'  => 'education_one_page_meta_show', 'operator' => '==', 'value'    => '1', ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'education_one_page_author_show',
        'label'       => esc_html__( 'Show Author?', 'education-one' ),
        'section'     => 'education_one_page_meta',
        'priority'    => 4,
        'default'     => '1',
        'active_callback'  => array( array( 'setting'  => 'education_one_page_meta_show', 'operator' => '==', 'value'    => '1', ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'education_one_page_breadcrumbs_show',
        'label'       => esc_html__( 'Show Breadcrumbs?', 'education-one' ),
        'section'     => 'education_one_page_meta',
        'priority'    => 4,
        'default'     => '1',
        'active_callback'  => array( array( 'setting'  => 'education_one_page_meta_show', 'operator' => '==', 'value'    => '1', ), )
    );
	 // blog meta
     $fields[] = array(
        'type'        => 'switch',
        'settings'    => 'education_one_blog_meta_show',
        'label'       => esc_html__( 'Show Meta?', 'education-one' ),
        'description' => esc_html__( 'Choose whether to display date, category, author, tags for posts on the post page.', 'education-one' ),
        'section'     => 'education_one_blog_meta',
        'priority'    => 1,
        'default'     => '1',
        'choices' => array( 'on'  => esc_attr__( 'SHOW', 'education-one' ), 'off' => esc_attr__( 'HIDE', 'education-one' ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'education_one_blog_date_show',
        'label'       => esc_html__( 'Show Date?', 'education-one' ),
        'section'     => 'education_one_blog_meta',
        'priority'    => 2,
        'default'     => '1',
        'active_callback'  => array( array( 'setting'  => 'education_one_blog_meta_show', 'operator' => '==', 'value'    => '1', ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'education_one_blog_category_show',
        'label'       => esc_html__( 'Show Category?', 'education-one' ),
        'section'     => 'education_one_blog_meta',
        'priority'    => 3,
        'default'     => '1',
        'active_callback'  => array( array( 'setting'  => 'education_one_blog_meta_show', 'operator' => '==', 'value'    => '1', ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'education_one_blog_author_show',
        'label'       => esc_html__( 'Show Author?', 'education-one' ),
        'section'     => 'education_one_blog_meta',
        'priority'    => 4,
        'default'     => '1',
        'active_callback'  => array( array( 'setting'  => 'education_one_blog_meta_show', 'operator' => '==', 'value'    => '1', ), )
    );
    $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'education_one_blog_tags_show',
        'label'       => esc_html__( 'Show Tags?', 'education-one' ),
        'section'     => 'education_one_blog_meta',
        'priority'    => 5,
        'default'     => '1',
        'active_callback'  => array( array( 'setting'  => 'education_one_blog_meta_show', 'operator' => '==', 'value'    => '1', ), )
    );
  
      $fields[] = array(
        'type'        => 'toggle',
        'settings'    => 'education_one_blog_comments_show',
        'label'       => esc_html__( 'Show Comment Count?', 'education-one' ),
        'section'     => 'education_one_blog_meta',
        'priority'    => 5,
        'default'     => '1',
        'active_callback'  => array( array( 'setting'  => 'education_one_blog_meta_show', 'operator' => '==', 'value'    => '1', ), )
    );
    return $fields;
}

add_filter( 'kirki/fields', 'education_one_customizer_fields' );
?>