<?php

/***********************THEME TESTIMONIAL SECTION ********************/
/******************************************************/

$wp_customize->add_section('metlux_testimonial_section', array(
    'priority'      => 6,
    'title'         =>__('Testimonial Section', 'metlux'),
    'panel'         => 'metlux_home_options'
    ));

$wp_customize->add_setting( 'testimonial_enable', array(
                'capability'        => 'edit_theme_options',
                'default'           => '1',
                'sanitize_callback' => 'metlux_theme_sanitize_checkbox'
    ) );

    $wp_customize->add_control( 'testimonial_enable', array(
                'settings' => 'testimonial_enable',
                'label'    =>  __( 'Enable/Disable Testimonial Section', 'metlux' ),
                'section'  => 'metlux_testimonial_section',
                'type'     => 'radio',
                'choices'  => array(
                    '1' => __( 'Enable', 'metlux' ),
                    '0' => __( 'Disable', 'metlux' ),
                   
                    ),
                'priority'              => 20
    ) );

$wp_customize->add_setting('testimonial_title',array(
    'sanitize_callback' => 'metlux_theme_sanitize_text',
    'capability' => 'edit_theme_options',
    'default' => __('Testimonial Title','metlux'),
    'transport'=>'postMessage'
    ));

$wp_customize->add_control('testimonial_title',array(
    'label'     =>__('Testimonial Title', 'metlux'),
    'section'   => 'metlux_testimonial_section',
    'type'      => 'text',
    'capability' => 'edit_theme_options',
    'priority'              => 20
    ));

$wp_customize->add_setting('testimonial_content',array(
    'sanitize_callback' => 'metlux_theme_sanitize_text',
    'capability' => 'edit_theme_options',
    'transport'=>'postMessage',
    'default' => __('Testimonial Description','metlux')
    ));

$wp_customize->add_control('testimonial_content',array(
    'label'     =>__('Testimonial Description', 'metlux'),
    'section'   => 'metlux_testimonial_section',
    'type'      => 'text',
    'capability' => 'edit_theme_options',
    'priority'              => 20
    ));


 

    $wp_customize->add_setting( 'testimonial_no_of_posts', array(
                'capability'        => 'edit_theme_options',
                'default'           => '4',
                'sanitize_callback' => 'metlux_theme_sanitize_text'
    ) );

    $wp_customize->add_control( 'testimonial_no_of_posts', array(
                'settings' => 'testimonial_no_of_posts',
                'label'    =>  __( 'No Of Posts To Show On Testimonial Section', 'metlux' ),
                'section'  => 'metlux_testimonial_section',
                'type'     => 'select',
                'choices'  => array(
                    '4' => __( '4', 'metlux' ),
                    '8' => __( '8', 'metlux' ),
                    '12' => __( '12', 'metlux' ),
                 
                    ),
                'priority'              => 20
    ) );


 $wp_customize->add_setting('metlux_testimonial_category_display',array(
    'sanitize_callback' => 'metlux_theme_sanitize_category',
    'capability' => 'edit_theme_options',
    'default' => ''
    ));

$wp_customize->add_control(new metlux_Customize_Dropdown_Taxonomies_Control($wp_customize,'metlux_testimonial_category_display',array(
    'label' => __('Choose testimonial category','metlux'),
    'section' => 'metlux_testimonial_section',
    'settings' => 'metlux_testimonial_category_display',
    'type'=> 'dropdown-taxonomies',
     'priority'              => 20
    )  

));
