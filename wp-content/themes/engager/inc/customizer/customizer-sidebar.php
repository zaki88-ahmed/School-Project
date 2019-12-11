<?php 
    /***************************Engager Sidebar Bar Layout Pannel*****************************/
    $wp_customize->add_panel( 'sidebar_layout', array(
        'priority' => 300,
        'title' => __( 'Engager Sidebar Layout', 'engager' ),
        'description' => __( 'Engager Sidebar Layout.', 'engager' ),
    ));
        
    $wp_customize->add_section('single_post_sidebar',array(
        'priority' => 40,
        'title' => __('Single Post Sidebar','engager'),
        'description' => __('Single Post Sidebar','engager'),
        'panel' => 'sidebar_layout'
    ));
    
    /* ------ Single Post Sidebar ------ */
    $wp_customize->add_setting('select_post_sidebar',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_select',
        'default' => 'right',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,'select_post_sidebar',array(
        'label' => __('Select Sidebar Position','engager'),
        'section' => 'single_post_sidebar',
        'settings' => 'select_post_sidebar',
        'type'=> 'radio',
        'choices' =>array(
            'right' =>__('Right','engager'),
            'left'  =>__('Left','engager'),
            'no'    =>__('no','engager'),
        )
    ))
    );
    
    /* ------ Single Page Sidebar ------ */
    $wp_customize->add_section('single_page_sidebar',array(
        'priority' => 50,
        'title' => __('Single Page Sidebar','engager'),
        'description' => __('Single Page Sidebar','engager'),
        'panel' => 'sidebar_layout'
    ));
    
    $wp_customize->add_setting('select_page_sidebar',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_select',
        'default' => 'right',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,'select_page_sidebar',array(
        'label' => __('Select Sidebar Position','engager'),
        'section' => 'single_page_sidebar',
        'settings' => 'select_page_sidebar',
        'type'=> 'radio',
        'choices' =>array(
            'right' =>__('Right','engager'),
            'left'  =>__('Left','engager'),
            'no'    =>__('no','engager'),
        )
    ))
    );
        
    /* ------ Category Sidebar ------ */    
    $wp_customize->add_section('category_sidebar',array(
        'priority' => 60,
        'title' => __('Category Sidebar','engager'),
        'description' => __('Category Sidebar','engager'),
        'panel' => 'sidebar_layout'
    ));
    
    $wp_customize->add_setting('select_category_sidebar',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_select',
        'default' => 'right',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,'select_category_sidebar',array(
        'label' => __('Select Sidebar Position','engager'),
        'section' => 'category_sidebar',
        'settings' => 'select_category_sidebar',
        'type'=> 'radio',
        'choices' =>array(
            'right' =>__('Right','engager'),
            'left'  =>__('Left','engager'),
            'no'    =>__('no','engager'),
        )
    ))
    );
    
    /* ------ Search Page Sidebar ------ */    
    $wp_customize->add_section('search_page_sidebar',array(
        'priority' => 60,
        'title' => __('Search Page Sidebar','engager'),
        'description' => __('Search Page Sidebar','engager'),
        'panel' => 'sidebar_layout'
    ));
    
    $wp_customize->add_setting('select_search_page_sidebar',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_select',
        'default' => 'right',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,'select_search_page_sidebar',array(
        'label' => __('Select Sidebar Position','engager'),
        'section' => 'search_page_sidebar',
        'settings' => 'select_search_page_sidebar',
        'type'=> 'radio',
        'choices' =>array(
            'right' =>__('Right','engager'),
            'left'  =>__('Left','engager'),
            'no'    =>__('no','engager'),
        )
    ))
    );
        
    /* ------  Page Not Found Sidebar ------ */    
    $wp_customize->add_section('page_not_found_sidebar',array(
        'priority' => 60,
        'title' => __('Page Not Found Sidebar','engager'),
        'description' => __('Page Not Found','engager'),
        'panel' => 'sidebar_layout'
    ));
    
    $wp_customize->add_setting('select_page_not_found_sidebar',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_select',
        'default' => 'right',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,'select_page_not_found_sidebar',array(
        'label' => __('Select Sidebar Position','engager'),
        'section' => 'page_not_found_sidebar',
        'settings' => 'select_page_not_found_sidebar',
        'type'=> 'radio',
        'choices' =>array(
            'right' =>__('Right','engager'),
            'left'  =>__('Left','engager'),
            'no'    =>__('no','engager'),
        )
    ))
    );
?>