<?php

 /*************************Vide0 Section*********************/
 $wp_customize->add_section('metlux_video_section', array(
    'priority'      => 6,
    'title'         =>__('video Section', 'metlux'),
    'panel'         => 'metlux_home_options'
    ));

$wp_customize->add_setting( 'video_enable', array(
                'capability'        => 'edit_theme_options',
                'default'           => '1',
                'sanitize_callback' => 'metlux_theme_sanitize_checkbox'
    ) );

    $wp_customize->add_control( 'video_enable', array(
                'settings' => 'video_enable',
                'label'    =>  __( 'Enable/Disable video Section', 'metlux' ),
                'section'  => 'metlux_video_section',
                'type'     => 'radio',
                'choices'  => array(
                    '1' => __( 'Enable', 'metlux' ),
                    '0' => __( 'Disable', 'metlux' ),
                   
                    ),
                'priority'              => 20
    ) );

$wp_customize->add_setting('video_title',array(
    'sanitize_callback' => 'metlux_theme_sanitize_text',
    'capability' => 'edit_theme_options',
    'default' => __('Video Title','metlux')
    ));

$wp_customize->add_control('video_title',array(
    'label'     =>__('video Title', 'metlux'),
    'section'   => 'metlux_video_section',
    'type'      => 'text',
    'capability' => 'edit_theme_options',
    'priority'              => 20
    ));

$wp_customize->add_setting('video_content',array(
    'sanitize_callback' => 'metlux_theme_sanitize_text',
    'capability' => 'edit_theme_options',
    'default' => __('Video Description','metlux')
    ));

$wp_customize->add_control('video_content',array(
    'label'     =>__('video Description', 'metlux'),
    'section'   => 'metlux_video_section',
    'type'      => 'text',
    'capability' => 'edit_theme_options',
    'priority'              => 20
    ));

$wp_customize->add_setting('video_background', array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'metlux_sanitize_image'
    ));

 $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'video_background', array(
    'label' => __('Upload Background Image For Video Section', 'metlux'),
    'section' => 'metlux_video_section',
    'setting' => 'video_background',
    'priority'              => 20
    )));

