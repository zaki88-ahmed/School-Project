<?php 
    $wp_customize->add_section('feature_section',array(
        'priority' => 80,
        'title' => __('Feature  Section','engager'),
        'description' => __('Write Some Words for Featured Section in Homepage','engager'),
        'panel' => 'theme_option'
    ));

    /******** Enable/Disable Features Section ***********/
    $wp_customize->add_setting('features_section_display',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_checkbox',
        'default' => '1'
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize,'features_section_display',array(
        'label' => __('Enable/Disable Welcome Section','engager'),
        'section' => 'feature_section',
        'settings' => 'features_section_display',
        'type'=> 'checkbox',
    ))
    );

    /************ Featured  Section Title   ************/        
    $wp_customize->add_setting('featured_title',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_text',
        'default' => __('Features Title','engager')
    ));
    
    $wp_customize->add_control('featured_title',array(
        'label' => __('Featured Heading','engager'),
        'section' => 'feature_section',
        'settings' => 'featured_title',
        'type' => 'text',
    ));
    
        
    /********* Icon For First Page ***********/
    $wp_customize->add_setting('feature_icon1',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_text',
        'default' => __('fa fa-bar-chart-o','engager'),
    ));
    
    $wp_customize->add_control('feature_icon1',array(
        'label' => __('Icon for First Page','engager'),
        'section' => 'feature_section',
        'settings' => 'feature_icon1',
        'type' => 'text',
    ));
        
    /********** Choose featuure  First Page *****************/  
    $wp_customize->add_setting( 'feature_page_display1', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> 0,
        'sanitize_callback' => 'engager_sanitize_dropdown_pages'
    ) );
    
    $wp_customize->add_control( 'feature_page_display1', array(
        'label'                 =>  __( 'Select Page For Feature Section', 'engager' ),
        'section'               => 'feature_section',
        'type'                  => 'dropdown-pages',
        'priority'              => 10,
        'settings' => 'feature_page_display1',
    )); 
    
        /********* Icon For Second Page ***********/
    $wp_customize->add_setting('feature_icon2',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_text',
        'default' => __('fa fa-bar-chart-o','engager'),
    ));
    
    $wp_customize->add_control('feature_icon2',array(
        'label' => __('Icon for Second Page','engager'),
        'section' => 'feature_section',
        'settings' => 'feature_icon2',
        'type' => 'text',
    ));
        
    /********** Choose featuure  Second Page *****************/  
    $wp_customize->add_setting( 'feature_page_display2', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> 0,
        'sanitize_callback' => 'engager_sanitize_dropdown_pages'
    ) );
    
    $wp_customize->add_control( 'feature_page_display2', array(
        'label'                 =>  __( 'Select Page For Feature Section', 'engager' ),
        'section'               => 'feature_section',
        'type'                  => 'dropdown-pages',
        'priority'              => 10,
        'settings' => 'feature_page_display2',
    )); 
    
    /********* Icon For Third Page ***********/
    $wp_customize->add_setting('feature_icon3',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_text',
        'default' => __('fa fa-bar-chart-o','engager'),
    ));
    
    $wp_customize->add_control('feature_icon3',array(
        'label' => __('Icon for Third Page','engager'),
        'section' => 'feature_section',
        'settings' => 'feature_icon3',
        'type' => 'text',
    ));
        
    /********** Choose feature  Third Page *****************/  
    $wp_customize->add_setting( 'feature_page_display3', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> 0,
        'sanitize_callback' => 'engager_sanitize_dropdown_pages'
    ) );
    
    $wp_customize->add_control( 'feature_page_display3', array(
        'label'                 =>  __( 'Select Page For Feature Section', 'engager' ),
        'section'               => 'feature_section',
        'type'                  => 'dropdown-pages',
        'priority'              => 10,
        'settings' => 'feature_page_display3',
    )); 
    
        /********* Icon For Fourth Page ***********/
    $wp_customize->add_setting('feature_icon4',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_text',
        'default' => __('fa fa-bar-chart-o','engager'),
    ));
    
    $wp_customize->add_control('feature_icon4',array(
        'label' => __('Icon for Fourth Page','engager'),
        'section' => 'feature_section',
        'settings' => 'feature_icon4',
        'type' => 'text',
    ));
        
    /********** Choose featuure  Fourth Page *****************/  
    $wp_customize->add_setting( 'feature_page_display4', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> 0,
        'sanitize_callback' => 'engager_sanitize_dropdown_pages'
    ) );
    
    $wp_customize->add_control( 'feature_page_display4', array(
        'label'                 =>  __( 'Select Page For Feature Section', 'engager' ),
        'section'               => 'feature_section',
        'type'                  => 'dropdown-pages',
        'priority'              => 10,
        'settings' => 'feature_page_display4',
    )); 
    
    /********* Icon For Fifth Page ***********/
    $wp_customize->add_setting('feature_icon5',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_text',
        'default' => __('fa fa-bar-chart-o','engager'),
    ));
    
    $wp_customize->add_control('feature_icon5',array(
        'label' => __('Icon for Fifth Page','engager'),
        'section' => 'feature_section',
        'settings' => 'feature_icon5',
        'type' => 'text',
    ));
        
    /********** Choose featuure  Fifth Page *****************/  
    $wp_customize->add_setting( 'feature_page_display5', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> 0,
        'sanitize_callback' => 'engager_sanitize_dropdown_pages'
    ) );
    
    $wp_customize->add_control( 'feature_page_display5', array(
        'label'                 =>  __( 'Select Page For Feature Section', 'engager' ),
        'section'               => 'feature_section',
        'type'                  => 'dropdown-pages',
        'priority'              => 10,
        'settings' => 'feature_page_display5',
    )); 
    
    /******************Featured Icon *******************/
    $wp_customize->add_setting('icon_featured',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_text',
        'default' =>'',
    ));
    
    $wp_customize->add_control('icon_featured',array(
        'label' => __('Icon if page is not selecetd.(Note:Same Icon is display for all post.)','engager'),
        'section' => 'feature_section',
        'settings' => 'icon_featured',
        'type' => 'text',
    ));
    
    /* ------ Choose Featured Category ------ */
    $wp_customize->add_setting('featured_category_display',array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_category',
        'default' =>1
    ));
    $wp_customize->add_control(new engager_Customize_Dropdown_Taxonomies_Control($wp_customize,'featured_category_display',array(
        'label' => __('Choose category','engager'),
        'section' => 'feature_section',
        'settings' => 'featured_category_display',
        'type'=> 'dropdown-taxonomies',
    ) 
    ));
    
    /* ------ Choose  Number of Post for Featured Content -----*/
    $wp_customize->add_setting('featured_category_display_num',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'engager_sanitize_select',
        'default'=>'5',
    ));
    
    $wp_customize->add_control( 'featured_category_display_num', array(
        'settings' => 'featured_category_display_num',
        'label'    =>  __( 'No Of Posts To Show On Featured Section', 'engager' ),
        'section'  => 'feature_section',
        'type'     => 'select',
        'choices'  => array(
            '5' => __( '5', 'engager' ),
            '10' => __( '10', 'engager' ),
            '15' => __( '15', 'engager'), 
        ),
    ));
    
    /********** Read More Text *****************/
    $wp_customize->add_setting('feature_read_more',array(
        'sanitize_callback' => 'engager_sanitize_text',
        'capability' => 'edit_theme_options',
        'default' => __('Read More','engager')
    ));
    
    $wp_customize->add_control('feature_read_more',array(
        'label'     =>__('Read More Text', 'engager'),
        'section'   => 'feature_section',
        'type'      => 'text',
        'settings'	=> 'feature_read_more',
        'capability' => 'edit_theme_options',
        'priority'              => 20
    ));    
?>