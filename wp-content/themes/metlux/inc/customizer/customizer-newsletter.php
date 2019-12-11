<?php


/***********************THEME NEWSLETTER SECTION ********************/
/******************************************************/
$wp_customize->add_section('metlux_newsletter_section', array(
    'priority'      => 6,
    'title'         =>__('Newsletter Section', 'metlux'),
    'panel'         => 'metlux_home_options'
    ));
 $wp_customize->add_setting('newsletter_background', array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'metlux_sanitize_image'
    ));

 $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'newsletter_background', array(
    'label' => __('Upload Background Image For Newsletter Section', 'metlux'),
    'section' => 'metlux_newsletter_section',
    'setting' => 'newsletter_background',
    'priority'              => 20
    )));
