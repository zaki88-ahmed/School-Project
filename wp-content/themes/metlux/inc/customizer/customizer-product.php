<?php
/***********************THEME PRODUCT SECTION ********************/
/******************************************************/
$wp_customize->add_section('metlux_product_section', array(
    'priority'      => 6,
    'title'         =>__('Product Section', 'metlux'),
    'panel'         => 'metlux_home_options'
    ));

$wp_customize->add_setting( 'product_enable', array(
                'capability'        => 'edit_theme_options',
                'default'           => '1',
                'sanitize_callback' => 'metlux_theme_sanitize_checkbox'
    ) );

    $wp_customize->add_control( 'product_enable', array(
                'settings' => 'product_enable',
                'label'    =>  __( 'Enable/Disable Product Section', 'metlux' ),
                'section'  => 'metlux_product_section',
                'type'     => 'radio',
                'choices'  => array(
                    '1' => __( 'Enable', 'metlux' ),
                    '0' => __( 'Disable', 'metlux' ),
                   
                    ),
                'priority'              => 20
    ) );

$wp_customize->add_setting('product_title',array(
    'sanitize_callback' => 'metlux_theme_sanitize_text',
    'capability' => 'edit_theme_options',
    'default' => __('Product Title','metlux'),
    'transport'=> 'postMessage'
    ));

$wp_customize->add_control('product_title',array(
    'label'     =>__('Product Title', 'metlux'),
    'section'   => 'metlux_product_section',
    'type'      => 'text',
    'capability' => 'edit_theme_options',
    'priority'              => 20
    ));

$wp_customize->add_setting('product_content',array(
    'sanitize_callback' => 'metlux_theme_sanitize_text',
    'capability' => 'edit_theme_options',
    'transport'=> 'postMessage',
    'default' => __('Product Description','metlux')
    ));

$wp_customize->add_control('product_content',array(
    'label'     =>__('Product Description', 'metlux'),
    'section'   => 'metlux_product_section',
    'type'      => 'text',
    'capability' => 'edit_theme_options',
    'priority'              => 20
    ));




 $wp_customize->add_setting('metlux_product_category_display',array(
    'sanitize_callback' => 'metlux_theme_sanitize_category',
    'capability' => 'edit_theme_options',
    'default' => '1'
    ));

$wp_customize->add_control(new metlux_Customize_Dropdown_Taxonomies_Control($wp_customize,'metlux_product_category_display',array(
    'label' => __('Choose product category','metlux'),
    'section' => 'metlux_product_section',
    'settings' => 'metlux_product_category_display',
    'type'=> 'dropdown-taxonomies',
     'priority'              => 20
    )  

));
 