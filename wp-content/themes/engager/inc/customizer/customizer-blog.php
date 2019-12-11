<?php    
    $wp_customize->add_section('latest_blog',array(
    'priority' => 80,
    'title' => __('Latest Blog/News Section','engager'),
    'description' => __('Write Some Words for Blog/News Section in Homepage','engager'),
    'panel' => 'theme_option'
    ));

    /******** Enable/Disable Latest News/Blog Section ***********/
    $wp_customize->add_setting('blog_section_display',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_checkbox',
        'default' => '1'
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,'blog_section_display',array(
        'label' => __('Enable/Disable News/Blog Section','engager'),
        'section' => 'latest_blog',
        'settings' => 'blog_section_display',
        'type'=> 'checkbox',
    ))
    );

    /****** Latest News/Blog Section Title **********/
    $wp_customize->add_setting('blog_textbox',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_text',
        'default' => __('Latest News/Blog','engager')
    ) );
       
    $wp_customize->add_control('blog_textbox',array(
        'label' => __('Latest News/Blog Heading','engager'),
        'section' => 'latest_blog',
        'settings' => 'blog_textbox',
        'type' => 'text',
    ));
    
    
    /* ------ Choose Slider Category ------ */
    $wp_customize->add_setting('latest_blog_category_display',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_category',
        'default' => ''
    ));
    
    $wp_customize->add_control(new engager_Customize_Dropdown_Taxonomies_Control($wp_customize,'latest_blog_category_display',array(
        'label' => __('Choose Category ','engager'),
        'section' => 'latest_blog',
        'settings' => 'latest_blog_category_display',
        'type'=> 'dropdown-taxonomies',
    ) 
    ));  
 ?>