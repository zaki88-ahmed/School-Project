<?php    
    $wp_customize->add_section('testimonial_section',array(
    'priority' => 80,
    'title' => __('Testimonial','engager'),
    'description' => __('Write Some Words for Testimonial Section in Homepage','engager'),
    'panel' => 'theme_option'
    ));

    /******** Enable/Disable Testimonial Section ***********/
    $wp_customize->add_setting('testimonial_section_display',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_checkbox',
        'default' => '1'
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,'testimonial_section_display',array(
        'label' => __('Enable/Disable Testimonial Section','engager'),
        'section' => 'testimonial_section',
        'settings' => 'testimonial_section_display',
        'type'=> 'checkbox',
    ))
    );
        
    /****** Testimonial Section Title **********/
    $wp_customize->add_setting('testimonial_textbox',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_text',
        'default' => __('Testimonial','engager')
    ) );
       
    $wp_customize->add_control('testimonial_textbox',array(
        'label' => __('Testimonial Section  Title','engager'),
        'section' => 'testimonial_section',
        'settings' => 'testimonial_textbox',
        'type' => 'text',
    ));
    
    
    /* ------ Choose Testimonial Category ------ */
    $wp_customize->add_setting('testimonial_category_display',array(
        'sanitize_callback' => 'engager_sanitize_category',
        'default' => ''
    ));
    
    $wp_customize->add_control(new engager_Customize_Dropdown_Taxonomies_Control($wp_customize,'testimonial_category_display',array(
        'label' => __('Choose Category ','engager'),
        'section' => 'testimonial_section',
        'settings' => 'testimonial_category_display',
        'type'=> 'dropdown-taxonomies',
    ) 
    ));  
    $wp_customize->add_setting('testimonial_category_display_num',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_select',
        'default'=>'3',
    ));
    
    $wp_customize->add_control( 'testimonial_category_display_num', array(
        'settings' => 'testimonial_category_display_num',
        'label'    =>  __( 'No Of Posts To Show On Testimonial Section', 'engager' ),
        'section'  => 'testimonial_section',
        'type'     => 'select',
        'choices'  => array(
        '1' => __( '1', 'engager' ),
        '2' => __( '2', 'engager' ),
        '3' => __( '3', 'engager' ),
        '4' => __( '4', 'engager' ),
        '5' => __( '5', 'engager' ),
        '6' => __( '6', 'engager' ),
        '7' => __( '7', 'engager' ),
        '8' => __( '8', 'engager' ),
        '9' => __( '9', 'engager' ),
            
        ),
    
    ) );   
?>