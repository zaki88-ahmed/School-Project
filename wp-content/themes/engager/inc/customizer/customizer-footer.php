<?php 
    $wp_customize->add_section('footer_section',array(
        'priority' => 80,
        'title' => __('Footer  Section','engager'),
        'description' => __('Customize Your Footer Section','engager'),
        'panel' => 'theme_option'
    ));
    
    /************ Footer  Section Title ******************/
    $wp_customize->add_setting('footer_title',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_text',
    ));
   
    $wp_customize->add_control('footer_title',array(
        'label' => __('Footer Heading','engager'),
        'section' => 'footer_section',
        'settings' => 'footer_title',
        'type' => 'text',
    ));
    
    
    /*------- Copyright Section -------*/
    $wp_customize->add_setting('copyright_textbox', array( 
    'capability'        => 'edit_theme_options', 
        'sanitize_callback' => 'engager_sanitize_text',
    ));
    
    $wp_customize->add_control('copyright_textbox', array(  
        'label' => __('Copyright text','engager'),
        'section' => 'footer_section',
        'settings' => 'copyright_textbox',
        'type' => 'text',
    ));    
    
    /* ------ Enable/Disable Social Icon ------ */
    $wp_customize->add_setting('social_icon_display',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_checkbox',
        'default' => '0'
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,'social_icon_display',array(
        'label' => __('Enable/Disable Social Icon','engager'),
        'section' => 'footer_section',
        'settings' => 'social_icon_display',
        'type'=> 'checkbox',
    ))
    );
    
    /* ------ For  Social Icons Section ------ */
       
    /** ------ Facebook Url ---*/
    $wp_customize->add_setting('facebook_url',array( 
    'capability'        => 'edit_theme_options',   
        'sanitize_callback' => 'esc_url_raw',
        
    )
    );
    $wp_customize->add_control( 'facebook_url', array(  
        'label' => __('Facebook','engager'),
        'section' => 'footer_section',
        'settings' => 'facebook_url',
        'type' => 'text',
    ));
    
    /** ------ Twitter Url ---*/
    $wp_customize->add_setting('twitter_url',array( 
    'capability'        => 'edit_theme_options',   
        'sanitize_callback' => 'esc_url_raw',
        
    ));
    $wp_customize->add_control( 'twitter_url', array(  
        'label' => __('Twitter','engager'),
        'section' => 'footer_section',
        'settings' => 'twitter_url',
        'type' => 'text',
    ));
    
    /** ------ Google Plus Url ---*/
    $wp_customize->add_setting('googleplus_url',array(   
    'capability'        => 'edit_theme_options', 
        'sanitize_callback' => 'esc_url_raw',
        
    ));
    $wp_customize->add_control( 'googleplus_url', array(  
        'label' => __('Google Plus','engager'),
        'section' => 'footer_section',
        'settings' => 'googleplus_url',
        'type' => 'text',
    ));
    
    /** ------ Linkedin Url ---*/
    $wp_customize->add_setting('linkedin_url',array(  
    'capability'        => 'edit_theme_options',  
        'sanitize_callback' => 'esc_url_raw',
       
    ));
    
    $wp_customize->add_control( 'linkedin_url', array(  
        'label' => __('Linkedin Plus','engager'),
        'section' => 'footer_section',
        'settings' => 'linkedin_url',
        'type' => 'text',
    ));

?>