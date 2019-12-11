<?php

/***********************THEME CLIENT SECTION ********************/
/******************************************************/
$wp_customize->add_section('metlux_client_section', array(
    'priority'      => 6,
    'title'         =>__('Client Section', 'metlux'),
    'panel'         => 'metlux_home_options'
    ));

$wp_customize->add_setting( 'client_enable', array(
                'capability'        => 'edit_theme_options',
                'default'           => '1',
                'sanitize_callback' => 'metlux_theme_sanitize_checkbox'
    ) );

    $wp_customize->add_control( 'client_enable', array(
                'settings' => 'client_enable',
                'label'    =>  __( 'Enable/Disable Client Section', 'metlux' ),
                'section'  => 'metlux_client_section',
                'type'     => 'radio',
                'choices'  => array(
                    '1' => __( 'Enable', 'metlux' ),
                    '0' => __( 'Disable', 'metlux' ),
                   
                    ),
                'priority'              => 20
    ) );


    $wp_customize->add_setting( 'client_no_of_posts', array(
                'capability'        => 'edit_theme_options',
                'default'           => '7',
                'sanitize_callback' => 'metlux_theme_sanitize_text'
    ) );

    $wp_customize->add_control( 'client_no_of_posts', array(
                'settings' => 'client_no_of_posts',
                'label'    =>  __( 'No Of Posts To Show On Client Section', 'metlux' ),
                'section'  => 'metlux_client_section',
                'type'     => 'select',
                'choices'  => array(
                    '5' => __( '5', 'metlux' ),
                    '7' => __( '7', 'metlux' ),
                 
                    ),
                'priority'              => 20
    ) );


 $wp_customize->add_setting('metlux_client_category_display',array(
    'sanitize_callback' => 'metlux_theme_sanitize_category',
    'capability' => 'edit_theme_options',
    'default' => ''
    ));

$wp_customize->add_control(new metlux_Customize_Dropdown_Taxonomies_Control($wp_customize,'metlux_client_category_display',array(
    'label' => __('Choose client category','metlux'),
    'section' => 'metlux_client_section',
    'settings' => 'metlux_client_category_display',
    'type'=> 'dropdown-taxonomies',
     'priority'              => 20
    )  

));