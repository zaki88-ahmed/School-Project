<?php    
    $wp_customize->add_section('general_information',array(
    'priority' => 80,
    'title' => __('General Information Section','engager'),
    'description' => __('General Information Section in Homepage','engager'),
    'panel' => 'theme_option'
    ));

    
    /******** Enable/Disable Information Section ***********/
    $wp_customize->add_setting('information_section_display',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_checkbox',
        'default' => '0'
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,'information_section_display',array(
        'label' => __('Enable/Disable information Section','engager'),
        'section' => 'general_information',
        'settings' => 'information_section_display',
        'type'=> 'checkbox',
    ))
    );

    /********** Choose General Information  Page *****************/  
    $wp_customize->add_setting( 'general_information_page', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> 0,
        'sanitize_callback' => 'engager_sanitize_dropdown_pages'
    ) );
    
    $wp_customize->add_control( 'general_information_page', array(
        'label'                 =>  __( 'Select Page For General Information Section', 'engager' ),
        'section'               => 'general_information',
        'type'                  => 'dropdown-pages',
        'priority'              => 10,
        'settings' => 'general_information_page',
    )); 
?>