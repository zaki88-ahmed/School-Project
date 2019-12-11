<?php
/***********************THEME SERVICE SECTION ********************/
/******************************************************/

$wp_customize->add_section('metlux_service_section', array(
    'priority'      => 6,
    'title'         =>__('Service Section', 'metlux'),
    'panel'         => 'metlux_home_options'
    ));

$wp_customize->add_setting( 'service_enable', array(
			    'capability'        => 'edit_theme_options',
			    'default'           => '1',
			    'sanitize_callback' => 'metlux_theme_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'service_enable', array(
			    'settings' => 'service_enable',
			    'label'    =>  __( 'Enable/Disable Service Section', 'metlux' ),
			    'section'  => 'metlux_service_section',
			    'type'     => 'radio',
			    'choices'  => array(
			        '1' => __( 'Enable', 'metlux' ),
			        '0' => __( 'Disable', 'metlux' ),
			       
			        ),
			    'priority'              => 20
	) );

$wp_customize->add_setting('service_title',array(
    'sanitize_callback' => 'metlux_theme_sanitize_text',
    'capability' => 'edit_theme_options',
    'default' => __('Service Title','metlux'),
    'transport'=>'postMessage'
    ));

$wp_customize->add_control('service_title',array(
    'label'     =>__('Service Title', 'metlux'),
    'section'   => 'metlux_service_section',
    'type'      => 'text',
    'capability' => 'edit_theme_options',
    'priority'              => 20
    ));

$wp_customize->add_setting('service_content',array(
    'sanitize_callback' => 'metlux_theme_sanitize_text',
    'capability' => 'edit_theme_options',
    'transport'=>'postMessage',
    'default' => __('Service Description','metlux')
    ));

$wp_customize->add_control('service_content',array(
    'label'     =>__('Service Subtitle', 'metlux'),
    'section'   => 'metlux_service_section',
    'type'      => 'text',
    'capability' => 'edit_theme_options',
    'priority'              => 20
    ));

$wp_customize->add_setting( 'metlux_service_section_icon1', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'fa fa-magic',
    'sanitize_callback' => 'metlux_theme_sanitize_text'
) );

$wp_customize->add_control( 'metlux_service_section_icon1', array(
    'label'                 =>  __( 'Icon For services 1', 'metlux' ),
    'description'           => sprintf( __( 'Use font awesome icon: Eg: %1$s. %2$s See more here %3$s', 'metlux' ), 'fa fa-magic','<a href="'.esc_url('http://fontawesome.io/icons/').'" target="_blank">','</a>' ),
    'section'               => 'metlux_service_section',
    'type'                  => 'text',
    'priority'              => 20,
    'settings' => 'metlux_service_section_icon1',
) );

$wp_customize->add_setting( 'metlux_service_section_icon2', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'fa fa-magic',
    'sanitize_callback' => 'metlux_theme_sanitize_text'
) );

$wp_customize->add_control( 'metlux_service_section_icon2', array(
    'label'                 =>  __( 'Icon For services 2', 'metlux' ),
    'section'               => 'metlux_service_section',
    'type'                  => 'text',
    'priority'              => 20,
    'settings' => 'metlux_service_section_icon2',
) );
$wp_customize->add_setting( 'metlux_service_section_icon3', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'fa fa-magic',
    'sanitize_callback' => 'metlux_theme_sanitize_text'
) );

$wp_customize->add_control( 'metlux_service_section_icon3', array(
    'label'                 =>  __( 'Icon For services 3', 'metlux' ),
    'section'               => 'metlux_service_section',
    'type'                  => 'text',
    'priority'              => 20,
    'settings' => 'metlux_service_section_icon3',
) );


$wp_customize->add_setting( 'metlux_service_section_page1', array(
    'capability'        => 'edit_theme_options',
    'default'           => 0,
    'sanitize_callback' => 'metlux_theme_sanitize_dropdown_pages'
) );
$wp_customize->add_control( 'metlux_service_section_page1', array(
    'label'                 =>  __( 'Select Page For services 1', 'metlux' ),
    'section'               => 'metlux_service_section',
    'type'                  => 'dropdown-pages',
    'priority'              => 20,
    'settings' => 'metlux_service_section_page1',
) );


$wp_customize->add_setting( 'metlux_service_section_page2', array(
    'capability'        => 'edit_theme_options',
    'default'           => 0,
    'sanitize_callback' => 'metlux_theme_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'metlux_service_section_page2', array(
    'label'                 =>  __( 'Select Page For services 2', 'metlux' ),
    'section'               => 'metlux_service_section',
    'type'                  => 'dropdown-pages',
    'priority'              => 20,
    'settings' => 'metlux_service_section_page2',
) );


$wp_customize->add_setting( 'metlux_service_section_page3', array(
    'capability'        => 'edit_theme_options',
    'default'           => 0,
    'sanitize_callback' => 'metlux_theme_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'metlux_service_section_page3', array(
    'label'                 =>  __( 'Select Page For services 3', 'metlux' ),
    'section'               => 'metlux_service_section',
    'type'                  => 'dropdown-pages',
    'priority'              => 20,
    'settings' => 'metlux_service_section_page3',
) );


$wp_customize->add_setting('service_background', array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'metlux_sanitize_image'
    ));

 $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'service_background', array(
    'label' => __('Upload Background Image For Service Section', 'metlux'),
    'section' => 'metlux_service_section',
    'setting' => 'service_background',
    'priority'              => 20
    )));