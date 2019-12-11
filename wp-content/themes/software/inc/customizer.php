<?php
/**
 * software Theme Customizer.
 *
 * @package software
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function software_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'software_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function software_customize_preview_js() {
	wp_enqueue_script( 'software_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'software_customize_preview_js' );

function software_theme_sanitize_textarea( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function software_theme_sanitize_category($input){
  $output=intval($input);
  return $output;
}

function software_sanitize_radio( $input, $setting ) 
{
	$input = sanitize_key( $input );
	$options = $setting->manager->get_control( $setting->id )->choices;
	if ( array_key_exists( $input, $options ))
		return $input; 
	else 
		return $setting->default;
}

function software_customize_pro_js() {
	wp_enqueue_script( 'software-customize-controls', trailingslashit( get_template_directory_uri() ) . 'js/software-customizer.js', array( 'customize-controls','jquery' ) , '1.0.0', true);  
	wp_enqueue_style( 'software-customizer-css',trailingslashit( get_template_directory_uri()) . 'css/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'software_customize_pro_js' );

function software_theme_customizer_register( $wp_customize ) 
    {

	
	
     // Load custom sections.
	 if ( ! class_exists( 'Software_Customize_Section_Pro' )) {
		 get_template_part( 'inc/software-pro');
	 }
     // Register custom section types.
     $wp_customize->register_section_type( 'Software_Customize_Section_Pro' );
     // Register sections.
    $wp_customize->add_section(
      new Software_Customize_Section_Pro(
        $wp_customize,
        'Software Theme',
        array(
		  'priority' => 1,
          'title'    => esc_html__( 'Software Plus', 'software' ),
          'pro_text' => esc_html__( 'Buy Pro',         'software' ),
          'pro_url'  => 'https://oceanwebthemes.com/webthemes/software-plus/'
		  )
      )
    );		
	
    	 $wp_customize->add_panel( 'theme_option', array(
        'priority' => 200,
        'title' => __( 'Software Theme Option', 'software' ),
        'description' => __( 'Software Theme Option.', 'software' ),
      ));

        /**********************************************/
      /************* MAIN SLIDER SECTION *************/
      /**********************************************/  

      $wp_customize->add_section('main_slider_category',array(
        'priority' => 50,
        'title' => __('Slider Categories','software'),
        'description' => __('Select the Slide Category for Homepage.','software'),
        'panel' => 'theme_option'
      ));

        $wp_customize->add_setting('enable_slider',array(
          'capability'=>'edit_theme_options',
          'sanitize_callback' => 'software_sanitize_radio',
          'default'=>'disable',
          ));

       $wp_customize->add_control( 'enable_slider', array(
         'settings' => 'enable_slider',
         'label'    =>  __( 'Enable/Disable Slider Section', 'software' ),
         'section'  => 'main_slider_category',
         'type'     => 'radio',
         'choices'  => array(
             'enable' => __( 'Enable', 'software' ),
             'disable' => __( 'Disable', 'software' ),
                  
             ),

        ) ); 


      $wp_customize->add_setting('slider_category_display',array(
        'sanitize_callback' => 'software_theme_sanitize_category',
        'default' => ''
      ));
      $wp_customize->add_control(new software_theme_Customize_Dropdown_Taxonomies_Control($wp_customize,'slider_category_display',array(
        'label' => __('Choose category','software'),
        'section' => 'main_slider_category',
        'settings' => 'slider_category_display',
        'type'=> 'dropdown-taxonomies',
        )  

      ));
      $wp_customize->add_setting('slider_category_display_num',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'software_sanitize_radio',
        'default'=>'2',
        ));
       $wp_customize->add_control( 'slider_category_display_num', array(
       'settings' => 'slider_category_display_num',
       'label'    =>  __( 'No Of Posts To Show On Slider Section', 'software' ),
       'section'  => 'main_slider_category',
       'type'     => 'select',
       'choices'  => array(
           '1' => __( '1', 'software' ),
           '2' => __( '2', 'software' ),
           '3' => __( '3', 'software' ),
           '4' => __( '4', 'software' ),
           '5' => __( '5', 'software' ),
           '6' => __( '6', 'software' ),

           ),

        ) );
      $wp_customize->add_setting(
        'slider_button',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => __('Download','software')
          )
      );
      $wp_customize->add_control(
        'slider_button',
         array(
          'label' => __('Download Button  Text','software'),
          'section' => 'main_slider_category',
          'settings' => 'slider_button',
          'type' => 'text',
         )
      );
      $wp_customize->add_setting(
        'slider_button_link',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'capability' => 'edit_theme_options',
              'default' => '',
          )
      );
      $wp_customize->add_control(
        'slider_button_link',
         array(
          'label' => __('Download Link','software'),
          'section' => 'main_slider_category',
          'settings' => 'slider_button_link',
          'type' => 'text',
         )
      );

       $wp_customize->add_setting('enable_readmore',array(
          'capability'=>'edit_theme_options',
          'sanitize_callback' => 'software_sanitize_radio',
          'default'=>'enable',
          ));

       $wp_customize->add_control( 'enable_readmore', array(
         'settings' => 'enable_readmore',
         'label'    =>  __( 'Enable/Disable Read More ', 'software' ),
         'section'  => 'main_slider_category',
         'type'     => 'radio',
         'choices'  => array(
             'enable' => __( 'Enable', 'software' ),
             'disable' => __( 'Disable', 'software' ),
                  
             ),

        ) ); 

/**********************************************/
      /************* ABOUT SECTION *************/
      /**********************************************/  

      $wp_customize->add_section('about_section',array(
        'priority' => 50,
        'title' => __('About Section','software'),
        'description' => __('Here you can configure about section','software'),
        'panel' => 'theme_option'
      ));

       $wp_customize->add_setting('enable_about',array(
          'capability'=>'edit_theme_options',
          'sanitize_callback' => 'software_sanitize_radio',
          'default'=>'disable',
          ));

       $wp_customize->add_control( 'enable_about', array(
         'settings' => 'enable_about',
         'label'    =>  __( 'Enable/Disable About Section', 'software' ),
         'section'  => 'about_section',
         'type'     => 'radio',
         'choices'  => array(
             'enable' => __( 'Enable', 'software' ),
             'disable' => __( 'Disable', 'software' ),
                  
             ),

        ) ); 

        $wp_customize->add_setting(
        'about_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => __('ABOUT SOFTWARE','software')
          )
      );
      $wp_customize->add_control(
        'about_title',
         array(
          'label' => __('About Title','software'),
          'section' => 'about_section',
          'settings' => 'about_title',
          'type' => 'text',
         )
      );

        $wp_customize->add_setting(
        'about_subtitle',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => __('this is what software3 is and why you should download it','software')
          )
      );
      $wp_customize->add_control(
        'about_subtitle',
         array(
          'label' => __('About Sub Title','software'),
          'section' => 'about_section',
          'settings' => 'about_subtitle',
          'type' => 'text',
         )
      );
 for ( $i = 1; $i <= 4; $i++ ) {
       

       $wp_customize->add_setting('about_page'.$i,array(
        'sanitize_callback' => 'software_theme_sanitize_category',
        'default' => ''
      ));
      $wp_customize->add_control(new Software_Customize_Latest_page_Control($wp_customize,'about_page'.$i,array(
        'label' => __('Choose  Page ','software').$i,
        'section' => 'about_section',
        'settings' => 'about_page'.$i,
        'type'=> 'latest_post_dropdown',
        )  

      ));
      $wp_customize->add_setting(
        'about_icon'.$i,
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => __('fa-area-chart','software')
          )
      );
      $wp_customize->add_control(
        'about_icon'.$i,
         array(
          'label' => __('Icon For Page ','software'). $i,
          'section' => 'about_section',
          'settings' => 'about_icon'.$i,
          'type' => 'text',
         )
      );
    }

/**********************************************/
      /************* FEATURE SECTION *************/
      /**********************************************/  

      $wp_customize->add_section('feature_section',array(
        'priority' => 50,
        'title' => __('Feature Section','software'),
        'description' => __('Check out our work','software'),
        'panel' => 'theme_option'
      ));

       $wp_customize->add_setting('enable_feature',array(
          'capability'=>'edit_theme_options',
          'sanitize_callback' => 'software_sanitize_radio',
          'default'=>'disable',
          ));

       $wp_customize->add_control( 'enable_feature', array(
         'settings' => 'enable_feature',
         'label'    =>  __( 'Enable/Disable Feature Section', 'software' ),
         'section'  => 'feature_section',
         'type'     => 'radio',
         'choices'  => array(
             'enable' => __( 'Enable', 'software' ),
             'disable' => __( 'Disable', 'software' ),
                  
             ),

        ) ); 

        $wp_customize->add_setting(
        'feature_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => __('Feature','software')
          )
      );
      $wp_customize->add_control(
        'feature_title',
         array(
          'label' => __('Feature Title','software'),
          'section' => 'feature_section',
          'settings' => 'feature_title',
          'type' => 'text',
         )
      );

        $wp_customize->add_setting(
        'feature_subtitle',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => __('this is what software3 is and why you should download it','software')
          )
      );
      $wp_customize->add_control(
        'feature_subtitle',
         array(
          'label' => __('Feature Title','software'),
          'section' => 'feature_section',
          'settings' => 'feature_subtitle',
          'type' => 'text',
         )
      );
        $wp_customize->add_setting('feature_page',array(
        'sanitize_callback' => 'software_theme_sanitize_category',
        'default' => ''
      ));
      $wp_customize->add_control(new Software_Customize_Latest_page_Control($wp_customize,'feature_page',array(
        'label' => __('Choose  Page ','software'),
        'section' => 'feature_section',
        'settings' => 'feature_page',
        'type'=> 'latest_post_dropdown',
        )  

      ));

       $wp_customize->add_setting('enable_feature_readmore',array(
          'capability'=>'edit_theme_options',
          'sanitize_callback' => 'software_sanitize_radio',
          'default'=>'enable',
          ));

       $wp_customize->add_control( 'enable_feature_readmore', array(
         'settings' => 'enable_feature_readmore',
         'label'    =>  __( 'Enable/Disable Readmore Button', 'software' ),
         'section'  => 'feature_section',
         'type'     => 'radio',
         'choices'  => array(
             'enable' => __( 'Enable', 'software' ),
             'disable' => __( 'Disable', 'software' ),
                  
             ),

        ) ); 
     
     /**********************************************/
      /************* FRONT PAGE SECTION *************/
      /**********************************************/  

      $wp_customize->add_section('frontpage_section',array(
        'priority' => 50,
        'title' => __('Front Page Section','software'),
        'description' => __('This is front page','software'),
        'panel' => 'theme_option'
      ));

       $wp_customize->add_setting('enable_frontpage',array(
          'capability'=>'edit_theme_options',
          'sanitize_callback' => 'software_sanitize_radio',
          'default'=>'disable',
          ));

       $wp_customize->add_control( 'enable_frontpage', array(
         'settings' => 'enable_frontpage',
         'label'    =>  __( 'Enable/Disable Frontpage  Section', 'software' ),
         'section'  => 'frontpage_section',
         'type'     => 'radio',
         'choices'  => array(
             'enable' => __( 'Enable', 'software' ),
             'disable' => __( 'Disable', 'software' ),
                  
             ),

        ) ); 
        $wp_customize->add_setting('front_page',array(
        'sanitize_callback' => 'software_theme_sanitize_category',
        'default' => ''
      ));
      $wp_customize->add_control(new Software_Customize_Latest_page_Control($wp_customize,'front_page',array(
        'label' => __('Choose  Page ','software'),
        'section' => 'frontpage_section',
        'settings' => 'front_page',
        'type'=> 'latest_post_dropdown',
        )  

      ));

      $wp_customize->add_setting(
        'download_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => __('Download','software')
          )
      );
      $wp_customize->add_control(
        'download_title',
         array(
          'label' => __(' Download Text','software'),
          'section' => 'frontpage_section',
          'settings' => 'download_title',
          'type' => 'text',
         )
      );
       $wp_customize->add_setting(
        'download_link',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => __('Download','software')
          )
      );
      $wp_customize->add_control(
        'download_link',
         array(
          'label' => __(' Download Link','software'),
          'section' => 'frontpage_section',
          'settings' => 'download_link',
          'type' => 'text',
         )
      );

      $wp_customize->add_setting('enable_front_readmore',array(
          'capability'=>'edit_theme_options',
          'sanitize_callback' => 'software_sanitize_radio',
          'default'=>'enable',
          ));

       $wp_customize->add_control( 'enable_front_readmore', array(
         'settings' => 'enable_front_readmore',
         'label'    =>  __( 'Enable/Disable Readmore Button', 'software' ),
         'section'  => 'frontpage_section',
         'type'     => 'radio',
         'choices'  => array(
             'enable' => __( 'Enable', 'software' ),
             'disable' => __( 'Disable', 'software' ),
                  
             ),

        ) ); 

       /**********************************************/
      /************* FOOTER SECTION *************/
      /**********************************************/  

      $wp_customize->add_section('footer_section',array(
        'priority' => 50,
        'title' => __('Footer Section','software'),
        'description' => __('Software Theme','software'),
        'panel' => 'theme_option'
      ));
       $wp_customize->add_setting(
        'testimonial_title',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => __('Testimonials','software')
          )
      );
      $wp_customize->add_control(
        'testimonial_title',
         array(
          'label' => __(' Testimonials Title For Widget','software'),
          'section' => 'footer_section',
          'settings' => 'testimonial_title',
          'type' => 'text',
         )
      );
      $wp_customize->add_setting('footer_logo',array(
      'sanitize_callback' => 'esc_url_raw',
      'default' =>  '',
      )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
        'label' => __(' Footer Logo.','software'),
        'description' => __('Recommended size (200*55) pixels','software'),
        'section' => 'footer_section',
        'settings' => 'footer_logo',
      )
    ));
    $wp_customize->add_setting(
        'copyright_text',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => __('&copy; 2017. Your Website All Rights Reserved','software')
          )
      );
      $wp_customize->add_control(
        'copyright_text',
         array(
          'label' => __(' Copyright Text','software'),
          'section' => 'footer_section',
          'settings' => 'copyright_text',
          'type' => 'text',
         )
      );
     
      /**********************************************/
      /************* OTHER SECTION *************/
      /**********************************************/  

      $wp_customize->add_section('other_section',array(
        'priority' => 50,
        'title' => __('Other Settings','software'),
        'description' => __('More settings','software'),
        'panel' => 'theme_option'
      ));

       $wp_customize->add_setting('enable_scroll',array(
          'capability'=>'edit_theme_options',
          'sanitize_callback' => 'software_sanitize_radio',
          'default'=>'enable',
          ));

       $wp_customize->add_control( 'enable_scroll', array(
         'settings' => 'enable_scroll',
         'label'    =>  __( 'Enable/Disable Scroll Button  ', 'software' ),
         'section'  => 'other_section',
         'type'     => 'radio',
         'choices'  => array(
             'enable' => __( 'Enable', 'software' ),
             'disable' => __( 'Disable', 'software' ),
                  
             ),

        ) ); 
       $wp_customize->add_setting( 'software_excerpt_setting', array(
          'capability'    => 'edit_theme_options',
          'default'     => 30,
          'sanitize_callback' => 'esc_attr',
        ) );

        $wp_customize->add_control( 'software_excerpt_setting', array(
          'description' => __('Excerpt length. Default is 40 words', 'software'),
          'input_attrs' => array(
                  'min'   => 10,
                  'max'   => 200,
                  'step'  => 5,
                  'style' => 'width: 60px;'
                  
                  ),
              'label'    => __( 'Excerpt Length (words)', 'software' ),
          'section'  => 'other_section',
          'settings' => 'software_excerpt_setting',
          'type'     => 'number',
          )
        );
        $wp_customize->add_setting(
        'welcome_section',
            array(
              'sanitize_callback' => 'sanitize_text_field',
              'default' => __('Welcome To Our Company','software')
          )
      );
      $wp_customize->add_control(
        'welcome_section',
         array(
          'label' => __(' Welcome Text For Latest Post','software'),
          'section' => 'other_section',
          'settings' => 'welcome_section',
          'type' => 'text',
         )
      );

    	  /**********************************************/

      /***** ADJUSTMENT OF SIDEBAR POSITION SECTION *****/

      /**********************************************/
      $wp_customize->add_panel( 'layout', array(
        'priority' => 220,
        'title' => __( 'Software Sidebar Layout', 'software' ),
        'description' => __( 'Layout of sidebars', 'software' ),
      ));
      $wp_customize->add_section('category_sidebar' , array(
        'priority' => 10,
        'title' => __('Archive Sidebar','software'),
        'panel' => 'layout'
      ));
   $wp_customize->add_setting('category_sidebar_position', array(
        'sanitize_callback' => 'software_sanitize_radio',
          'default' => __('right','software')
        ));
      $wp_customize->add_control('category_sidebar_position', array(
        'label'      => __('Archive Sidebar position', 'software'),
        'section'    => 'category_sidebar',
        'settings'   => 'category_sidebar_position',
        'type'       => 'radio',
        'choices'    => array(
          'none'   => __('none','software'),
          'left'   => __('left','software'),
          'right'  => __('right','software'),
        ),

      ));

      /**********************************************/

      /********** SINGLE POST SIDEBAR SECTION ***********/

      /**********************************************/    

      $wp_customize->add_section('single_post_sidebar' , array(
        'priority' => 20,
        'title' => __('Single Post Sidebar','software'),
        'panel' => 'layout'
      ));
      $wp_customize->add_setting('single_post_sidebar_position', array(
        'sanitize_callback' => 'software_sanitize_radio',
         'default' => __('right','software')
      ));
      $wp_customize->add_control('single_post_sidebar_position', array(
        'label'      => __('Single Post Sidebar position', 'software'),
        'section'    => 'single_post_sidebar',
        'settings'   => 'single_post_sidebar_position',
        'type'       => 'radio',
        'choices'    => array(
           'none'   => __('none','software'),
          'left'   => __('left','software'),
          'right'  => __('right','software'),
        ),

      ));
    /**********************************************/

      /********** SINGLE PAGE SIDEBAR SECTION ***********/

      /**********************************************/     
     $wp_customize->add_section('single_page_sidebar' , array(
        'priority' => 30,
        'title' => __('Single Page Sidebar','software'),
        'panel' => 'layout'
      ));
     $wp_customize->add_setting('single_page_sidebar_position', array(
        'sanitize_callback' => 'software_sanitize_radio',
         'default' => __('right','software')
      ));
     $wp_customize->add_control('single_page_sidebar_position', array(
        'label'      => __('Single Page Sidebar position', 'software'),
        'section'    => 'single_page_sidebar',
        'settings'   => 'single_page_sidebar_position',
        'type'       => 'radio',
        'choices'    => array(
           'none'   => __('none','software'),
          'left'   => __('left','software'),
          'right'  => __('right','software'),
        ),

      ));

     }

add_action( 'customize_register', 'software_theme_customizer_register' );