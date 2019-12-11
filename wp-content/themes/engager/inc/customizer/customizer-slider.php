<?php         
    $wp_customize->add_section('main_slider_section',array(
        'priority' => 40,
        'title' => __('Main Slider Section','engager'),
        'description' => __('Main Slider Section','engager'),
        'panel' => 'theme_option'
    ));
        
    /******** Enable/Disable Slider ***********/
    $wp_customize->add_setting('slider_section_display',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_dropdown_pages',
        'default' => '1'
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,'slider_section_display',array(
        'label' => __('Enable/Disable Slider','engager'),
        'section' => 'main_slider_section',
        'settings' => 'slider_section_display',
        'type'=> 'checkbox',
    ))
    );
    
    /******** Choose page for slider 1 *********/
    $wp_customize->add_setting( 'home_slider_page_one', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> 0,
        'sanitize_callback' => 'engager_sanitize_dropdown_pages'
    ) );
    
    $wp_customize->add_control( 'home_slider_page_one', array(
        'label'                 =>  __( 'Select Page For Slider 1', 'engager' ),
        'section'               => 'main_slider_section',
        'type'                  => 'dropdown-pages',
        'priority'              => 10,
        'settings' => 'home_slider_page_one',
    ) );
    
    /******** Choose page for slider 2 *******/
    $wp_customize->add_setting( 'home_slider_page_two', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> 0,
        'sanitize_callback' => 'engager_sanitize_dropdown_pages'
    ) );
    
    $wp_customize->add_control( 'home_slider_page_two', array(
        'label'                 =>  __( 'Select Page For Slider 2', 'engager' ),
        'section'               => 'main_slider_section',
        'type'                  => 'dropdown-pages',
        'priority'              => 10,
        'settings' => 'home_slider_page_two',
    ) );
    
     /******** Choose page for slider 3 *******/
    $wp_customize->add_setting( 'home_slider_page_three', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> 0,
        'sanitize_callback' => 'engager_sanitize_dropdown_pages'
    ) );    
    
    $wp_customize->add_control( 'home_slider_page_three', array(
        'label'                 =>  __( 'Select Page For Slider 3', 'engager' ),
        'section'               => 'main_slider_section',
        'type'                  => 'dropdown-pages',
        'priority'              => 10,
        'settings' => 'home_slider_page_three',
    ) );
    
    /* ------ Choose Slider Category ------ */
    $wp_customize->add_setting('slider_category_display',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_category',
        'default' => ''
    ));
    
    $wp_customize->add_control(new engager_Customize_Dropdown_Taxonomies_Control($wp_customize,'slider_category_display',array(
        'label' => __('Choose Category if no page is selected','engager'),
        'section' => 'main_slider_section',
        'settings' => 'slider_category_display',
        'type'=> 'dropdown-taxonomies',
    ) 
    ));   
    
    $wp_customize->add_setting('slider_category_display_num',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_select',
        'default'=>'3',
    ));
    
    $wp_customize->add_control( 'slider_category_display_num', array(
        'settings' => 'slider_category_display_num',
        'label'    =>  __( 'No Of Posts To Show On Slider Section', 'engager' ),
        'section'  => 'main_slider_section',
        'type'     => 'select',
        'choices'  => array(
        '1' => __( '1', 'engager' ),
        '2' => __( '2', 'engager' ),
        '3' => __( '3', 'engager' ),      
        ),
    
    ) ); 
    
    /********** Read More Text *****************/
    $wp_customize->add_setting('slider_read_more',array(
        'sanitize_callback' => 'engager_sanitize_text',
        'capability' => 'edit_theme_options',
        'default' => ''
    ));
    
    $wp_customize->add_control('slider_read_more',array(
        'label'     =>__('Read More Text', 'engager'),
        'section'   => 'main_slider_section',
        'type'      => 'text',
        'settings'	=> 'slider_read_more',
        'capability' => 'edit_theme_options',
        'priority'              => 20
    ));       
?>