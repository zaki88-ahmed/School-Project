<?php    
    $wp_customize->add_section('welcome_text',array(
    'priority' => 60,
    'title' => __('Welcome Section','engager'),
    'description' => __('Write Some Words for Welcome Section in Homepage','engager'),
    'panel' => 'theme_option'
    ));

    /******** Enable/Disable Welcome Section ***********/
    $wp_customize->add_setting('welcome_section_display',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_checkbox',
        'default' => '1'
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,'welcome_section_display',array(
        'label' => __('Enable/Disable Welcome Section','engager'),
        'section' => 'welcome_textbox',
        'settings' => 'welcome_section_display',
        'type'=> 'checkbox',
    ))
    );
        
    /****** Welcome Section Title **********/
    $wp_customize->add_setting('welcome_textbox',array(
        'sanitize_callback' => 'engager_sanitize_text',
        'default' => __('Welcome to Engager','engager')
    ) );
       
    $wp_customize->add_control('welcome_textbox',array(
        'label' => __('Welcome Heading','engager'),
        'section' => 'welcome_text',
        'settings' => 'welcome_textbox',
        'type' => 'text',
    ));
    
    
    /********* Icon For First Page ***********/
    $wp_customize->add_setting('icon_text1',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_text',
        'default' => __('fa fa-bar-chart-o','engager'),
    ));
    
    $wp_customize->add_control('icon_text1',array(
        'label' => __('Icon for First Page','engager'),
        'section' => 'welcome_text',
        'settings' => 'icon_text1',
        'type' => 'text',
    ));
        
    /********** Choose Welcome  First Page *****************/  
    $wp_customize->add_setting( 'welcome_page_display1', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> 0,
        'sanitize_callback' => 'engager_sanitize_dropdown_pages'
    ) );
    
    $wp_customize->add_control( 'welcome_page_display1', array(
        'label'                 =>  __( 'Select Page For Welcome Section', 'engager' ),
        'section'               => 'welcome_text',
        'type'                  => 'dropdown-pages',
        'priority'              => 10,
        'settings' => 'welcome_page_display1',
    )); 
    
    /*************** Icon For Second Page *********/
    $wp_customize->add_setting('icon_text2',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_text',
        'default' => __('fa fa-bar-chart-o','engager'),
    ));
    
    $wp_customize->add_control('icon_text2',array(
        'label' => __('Icon for second Page','engager'),
        'section' => 'welcome_text',
        'settings' => 'icon_text2',
        'type' => 'text',
    ));
    
    /********** Choose Welcome  Second Page *****************/  
    $wp_customize->add_setting( 'welcome_page_display2', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> 0,
        'sanitize_callback' => 'engager_sanitize_dropdown_pages'
    ) );
    
    $wp_customize->add_control( 'welcome_page_display2', array(
        'label'                 =>  __( 'Select Page For Welcome Section', 'engager' ),
        'section'               => 'welcome_text',
        'type'                  => 'dropdown-pages',
        'priority'              => 10,
        'settings' => 'welcome_page_display2',
    ));   
    
    /*********** Icon For Third Page *************/
    $wp_customize->add_setting('icon_text3',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_text',
        'default' =>__('fa fa-bar-chart-o','engager'),
    ));
    
    $wp_customize->add_control('icon_text3',array(
        'label' => __('Icon for Third Page','engager'),
        'section' => 'welcome_text',
        'settings' => 'icon_text3',
        'type' => 'text',
    ));
    
    /********** Choose Welcome  Third Page *****************/  
    $wp_customize->add_setting( 'welcome_page_display3', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> 0,
        'sanitize_callback' => 'engager_sanitize_dropdown_pages'
    ) );
    
    $wp_customize->add_control( 'welcome_page_display3', array(
        'label'                 =>  __( 'Select Page For Welcome Section', 'engager' ),
        'section'               => 'welcome_text',
        'type'                  => 'dropdown-pages',
        'priority'              => 10,
        'settings' => 'welcome_page_display3',
    ));
 ?>