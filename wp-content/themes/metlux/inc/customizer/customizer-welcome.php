<?php
/***********************THEME Welcome SECTION ********************/
/******************************************************/
$wp_customize->add_section('metlux_welcome_section', array(
    'priority'      => 6,
    'title'         =>__('Welcome Section', 'metlux'),
    'panel'         => 'metlux_home_options'
    ));

$wp_customize->add_setting( 'welcome_enable', array(
			    'capability'        => 'edit_theme_options',
			    'default'           => '1',
			    'sanitize_callback' => 'metlux_theme_sanitize_checkbox'
	) );

$wp_customize->add_control( 'welcome_enable', array(
			    'settings' => 'welcome_enable',
			    'label'    =>  __( 'Enable/Disable Welcome Section', 'metlux' ),
			    'section'  => 'metlux_welcome_section',
			    'type'     => 'radio',
			    'choices'  => array(
			        '1' => __( 'Enable', 'metlux' ),
			        '0' => __( 'Disable', 'metlux' ),
			       
			        ),
			    'priority'              => 20
	) );

$wp_customize->add_setting('welcome_title',array(
    'sanitize_callback' => 'metlux_theme_sanitize_text',
    'capability' => 'edit_theme_options',
    'default' => __('Welcome Title','metlux'),
    'transport'=>'postMessage'
    ));

$wp_customize->add_control('welcome_title',array(
    'label'     =>__('Welcome Title', 'metlux'),
    'section'   => 'metlux_welcome_section',
    'type'      => 'text',
    'capability' => 'edit_theme_options',
    'priority'              => 20
    ));

$wp_customize->add_setting('welcome_content',array(
    'sanitize_callback' => 'metlux_theme_sanitize_text',
    'capability' => 'edit_theme_options',
    'transport'=>'postMessage',
    'default' => __('Welcome Subtitle','metlux')
    ));

$wp_customize->add_control('welcome_content',array(
    'label'     =>__('Welcome Subtitle', 'metlux'),
    'section'   => 'metlux_welcome_section',
    'type'      => 'text',
    'capability' => 'edit_theme_options',
    'priority'              => 20
    ));

$wp_customize->add_setting( 'metlux_welcome_section_icon1', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'fa fa-magic',
    'sanitize_callback' => 'metlux_theme_sanitize_text'
) );

$wp_customize->add_control( 'metlux_welcome_section_icon1', array(
    'label'                 =>  __( 'Icon For Welcome 1', 'metlux' ),
    'description'           => sprintf( __( 'Use font awesome icon: Eg: %1$s. %2$s See more here %3$s', 'metlux' ), 'fa fa-magic','<a href="'.esc_url('http://fontawesome.io/icons/').'" target="_blank">','</a>' ),
    'section'               => 'metlux_welcome_section',
    'type'                  => 'text',
    'priority'              => 20,
    'settings' => 'metlux_welcome_section_icon1',
) );

$wp_customize->add_setting( 'metlux_welcome_section_icon2', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'fa fa-magic',
    'sanitize_callback' => 'metlux_theme_sanitize_text'
) );

$wp_customize->add_control( 'metlux_welcome_section_icon2', array(
    'label'                 =>  __( 'Icon For Welcome 2', 'metlux' ),
    'section'               => 'metlux_welcome_section',
    'type'                  => 'text',
    'priority'              => 20,
    'settings' => 'metlux_welcome_section_icon2',
) );
$wp_customize->add_setting( 'metlux_welcome_section_icon3', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'fa fa-magic',
    'sanitize_callback' => 'metlux_theme_sanitize_text'
) );

$wp_customize->add_control( 'metlux_welcome_section_icon3', array(
    'label'                 =>  __( 'Icon For Welcome 3', 'metlux' ),
    'section'               => 'metlux_welcome_section',
    'type'                  => 'text',
    'priority'              => 20,
    'settings' => 'metlux_welcome_section_icon3',
) );

$wp_customize->add_setting( 'metlux_welcome_section_icon4', array(
    'capability'        => 'edit_theme_options',
    'default'           => 'fa fa-magic',
    'sanitize_callback' => 'metlux_theme_sanitize_text'
) );

$wp_customize->add_control( 'metlux_welcome_section_icon4', array(
    'label'                 =>  __( 'Icon For Welcome 4', 'metlux' ),
    'section'               => 'metlux_welcome_section',
    'type'                  => 'text',
    'priority'              => 20,
    'settings' => 'metlux_welcome_section_icon4',
) );
$wp_customize->add_setting( 'metlux_welcome_section_page1', array(
    'capability'        => 'edit_theme_options',
    'default'           => 0,
    'sanitize_callback' => 'metlux_theme_sanitize_dropdown_pages'
) );
$wp_customize->add_control( 'metlux_welcome_section_page1', array(
    'label'                 =>  __( 'Select Page For Welcome 1', 'metlux' ),
    'section'               => 'metlux_welcome_section',
    'type'                  => 'dropdown-pages',
    'priority'              => 20,
    'settings' => 'metlux_welcome_section_page1',
) );


$wp_customize->add_setting( 'metlux_welcome_section_page2', array(
    'capability'        => 'edit_theme_options',
    'default'           => 0,
    'sanitize_callback' => 'metlux_theme_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'metlux_welcome_section_page2', array(
    'label'                 =>  __( 'Select Page For Welcome 2', 'metlux' ),
    'section'               => 'metlux_welcome_section',
    'type'                  => 'dropdown-pages',
    'priority'              => 20,
    'settings' => 'metlux_welcome_section_page2',
) );


$wp_customize->add_setting( 'metlux_welcome_section_page3', array(
    'capability'        => 'edit_theme_options',
    'default'           => 0,
    'sanitize_callback' => 'metlux_theme_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'metlux_welcome_section_page3', array(
    'label'                 =>  __( 'Select Page For Welcome 3', 'metlux' ),
    'section'               => 'metlux_welcome_section',
    'type'                  => 'dropdown-pages',
    'priority'              => 20,
    'settings' => 'metlux_welcome_section_page3',
) );

$wp_customize->add_setting( 'metlux_welcome_section_page4', array(
    'capability'        => 'edit_theme_options',
    'default'           => 0,
    'sanitize_callback' => 'metlux_theme_sanitize_dropdown_pages'
) );

$wp_customize->add_control( 'metlux_welcome_section_page4', array(
    'label'                 =>  __( 'Select Page For Welcome 4', 'metlux' ),
    'section'               => 'metlux_welcome_section',
    'type'                  => 'dropdown-pages',
    'priority'              => 20,
    'settings' => 'metlux_welcome_section_page4',
) );


