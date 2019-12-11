<?php

/***********************Team Section ********************/
/******************************************************/
$wp_customize->add_section('metlux_team_section', array(
    'priority'      => 6,
    'title'         =>__('Team Section', 'metlux'),
    'panel'         => 'metlux_home_options'
    ));

$wp_customize->add_setting( 'team_enable', array(
                'capability'        => 'edit_theme_options',
                'default'           => '1',
                'sanitize_callback' => 'metlux_theme_sanitize_checkbox'
    ) );

    $wp_customize->add_control( 'team_enable', array(
                'settings' => 'team_enable',
                'label'    =>  __( 'Enable/Disable Team Section', 'metlux' ),
                'section'  => 'metlux_team_section',
                'type'     => 'radio',
                'choices'  => array(
                    '1' => __( 'Enable', 'metlux' ),
                    '0' => __( 'Disable', 'metlux' ),
                   
                    ),
                'priority'              => 20
    ) );

$wp_customize->add_setting('team_title',array(
    'sanitize_callback' => 'metlux_theme_sanitize_text',
    'capability' => 'edit_theme_options',
    'default' => __('Team Title ','metlux'),
    'transport'=> 'postMessage'
    ));

$wp_customize->add_control('team_title',array(
    'label'     =>__('Team Title', 'metlux'),
    'section'   => 'metlux_team_section',
    'type'      => 'text',
    'capability' => 'edit_theme_options',
    'priority'              => 20
    ));

$wp_customize->add_setting('team_content',array(
    'sanitize_callback' => 'metlux_theme_sanitize_text',
    'capability' => 'edit_theme_options',
     'transport'=> 'postMessage',
    'default' => __('Team Description','metlux')
    ));

$wp_customize->add_control('team_content',array(
    'label'     =>__('Team Description', 'metlux'),
    'section'   => 'metlux_team_section',
    'type'      => 'text',
    'capability' => 'edit_theme_options',
    'priority'              => 20
    ));


 

    $wp_customize->add_setting( 'team_no_of_posts', array(
                'capability'        => 'edit_theme_options',
                'default'           => '4',
                'sanitize_callback' => 'metlux_theme_sanitize_text'
    ) );

    $wp_customize->add_control( 'team_no_of_posts', array(
                'settings' => 'team_no_of_posts',
                'label'    =>  __( 'No Of Posts To Show On Team Section', 'metlux' ),
                'section'  => 'metlux_team_section',
                'type'     => 'select',
                'choices'  => array(
                    '4' => __( '4', 'metlux' ),
                    '8' => __( '8', 'metlux' ),
                    '12' => __( '12', 'metlux' ),
                 
                    ),
                'priority'              => 20
    ) );


 $wp_customize->add_setting('metlux_team_category_display',array(
    'sanitize_callback' => 'metlux_theme_sanitize_category',
    'capability' => 'edit_theme_options',
    'default' => ''
    ));

$wp_customize->add_control(new metlux_Customize_Dropdown_Taxonomies_Control($wp_customize,'metlux_team_category_display',array(
    'label' => __('Choose team category','metlux'),
    'section' => 'metlux_team_section',
    'settings' => 'metlux_team_category_display',
    'type'=> 'dropdown-taxonomies',
     'priority'              => 20
    )  

));

 