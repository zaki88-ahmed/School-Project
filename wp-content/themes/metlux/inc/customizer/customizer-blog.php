<?php
/***********************THEME BLOG SECTION ********************/
/******************************************************/
$wp_customize->add_section('metlux_blog_section', array(
    'priority'      => 6,
    'title'         =>__('Blog Section', 'metlux'),
    'panel'         => 'metlux_home_options'
    ));

$wp_customize->add_setting( 'blog_enable', array(
                'capability'        => 'edit_theme_options',
                'default'           => '1',
                'sanitize_callback' => 'metlux_theme_sanitize_checkbox'
    ) );

    $wp_customize->add_control( 'blog_enable', array(
                'settings' => 'blog_enable',
                'label'    =>  __( 'Enable/Disable Blog Section', 'metlux' ),
                'section'  => 'metlux_blog_section',
                'type'     => 'radio',
                'choices'  => array(
                    '1' => __( 'Enable', 'metlux' ),
                    '2' => __( 'Disable', 'metlux' ),
                   
                    ),
                'priority'              => 20
    ) );

$wp_customize->add_setting('blog_title',array(
    'sanitize_callback' => 'metlux_theme_sanitize_text',
    'capability' => 'edit_theme_options',
    'default' => __('Blog Title ','metlux'),
    'transport'=>'postMessage'
    ));

$wp_customize->add_control('blog_title',array(
    'label'     =>__('Blog Title', 'metlux'),
    'section'   => 'metlux_blog_section',
    'type'      => 'text',
    'capability' => 'edit_theme_options',
    'priority'              => 20
    ));

$wp_customize->add_setting('blog_content',array(
    'sanitize_callback' => 'metlux_theme_sanitize_text',
    'capability' => 'edit_theme_options',
    'transport'=>'postMessage',
    'default' => __('Blog Subtitle','metlux')
    ));

$wp_customize->add_control('blog_content',array(
    'label'     =>__('Blog Subtitle', 'metlux'),
    'section'   => 'metlux_blog_section',
    'type'      => 'text',
    'capability' => 'edit_theme_options',
    'priority'              => 20
    ));


 

    $wp_customize->add_setting( 'blog_no_of_posts', array(
                'capability'        => 'edit_theme_options',
                'default'           => '2',
                'sanitize_callback' => 'metlux_theme_sanitize_text'
    ) );

    $wp_customize->add_control( 'blog_no_of_posts', array(
                'settings' => 'blog_no_of_posts',
                'label'    =>  __( 'No Of Posts To Show On Blog Section', 'metlux' ),
                'section'  => 'metlux_blog_section',
                'type'     => 'select',
                'choices'  => array(
                    '2' => __( '2', 'metlux' ),
                    '4' => __( '4', 'metlux' ),
                    '6' => __( '6', 'metlux' ),
                 
                    ),
                'priority'              => 20
    ) );


 $wp_customize->add_setting('metlux_blog_category_display',array(
    'sanitize_callback' => 'metlux_theme_sanitize_category',
    'capability' => 'edit_theme_options',
    'default' => ''
    ));

$wp_customize->add_control(new metlux_Customize_Dropdown_Taxonomies_Control($wp_customize,'metlux_blog_category_display',array(
    'label' => __('Choose blog category','metlux'),
    'section' => 'metlux_blog_section',
    'settings' => 'metlux_blog_category_display',
    'type'=> 'dropdown-taxonomies',
     'priority'              => 20
    )  

));

$wp_customize->add_setting( 'view_enable', array(
                'capability'        => 'edit_theme_options',
                'default'           => '1',
                'sanitize_callback' => 'metlux_theme_sanitize_checkbox'
    ) );

    $wp_customize->add_control( 'view_enable', array(
                'settings' => 'view_enable',
                'label'    =>  __( 'Enable/Disable View All Text', 'metlux' ),
                'section'  => 'metlux_blog_section',
                'type'     => 'radio',
                'choices'  => array(
                    '1' => __( 'Enable', 'metlux' ),
                    '0' => __( 'Disable', 'metlux' ),
                   
                    ),
                'priority'              => 20
    ) );

    $wp_customize->add_setting( 'view_text', array(
                'capability'        => 'edit_theme_options',
                'default'           => __('View All','metlux'),
                'sanitize_callback' => 'metlux_theme_sanitize_text'
    ) );

    $wp_customize->add_control( 'view_text', array(
                'settings' => 'view_text',
                'label'    =>  __( 'View All Text', 'metlux' ),
                'section'  => 'metlux_blog_section',
                'type'     => 'text',
                
                'priority'              => 20
    ) );


 