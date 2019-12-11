<?php 

 $wp_customize->add_panel('metlux_home_options',array(
    'capability'     => 'edit_theme_options',
    'priority'       => 300,
    'title' => __('Metlux Home Options', 'metlux')
    ));


 /***********************THEME SLIDER ********************/
 /******************************************************/
 $wp_customize->add_section('metlux_slider_section', array(
    'priority'      => 6,
    'title'         =>__('Slider Section', 'metlux'),
    'panel'         => 'metlux_home_options'
    ));

 $wp_customize->add_setting( 'slider_enable', array(
			    'capability'        => 'edit_theme_options',
			    'default'           => '1',
			    'sanitize_callback' => 'metlux_theme_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'slider_enable', array(
			    'settings' => 'slider_enable',
			    'label'    =>  __( 'Enable/Disable Home Slider', 'metlux' ),
			    'section'  => 'metlux_slider_section',
			    'type'     => 'radio',
			    'choices'  => array(
			        '1' => __( 'Enable', 'metlux' ),
			        '2' => __( 'Disable', 'metlux' ),
			       
			        ),
			    'priority'              => 20
	) );

	//slider text align
		$wp_customize->add_setting( 'slider_text_align', array(
		    'capability'		=> 'edit_theme_options',
		    'default'			=> 'text-center',
		    'sanitize_callback' => 'metlux_theme_sanitize_text'
		) );

		$wp_customize->add_control( 'slider_text_align', array(
		    'label'                 =>  __( 'Select Slider Text Position', 'metlux' ),
		    'section'               => 'metlux_slider_section',
		    'type'                  => 'select',
		    'priority'              => 20,
		    'settings'			    => 'slider_text_align',
		     'choices'    			=> array(
		          'text-left'  	 => __('left','metlux'),
		          'text-right'   => __('right','metlux'),
		          'text-center'  => __('center','metlux')
		        ),
		) );

		$wp_customize->add_setting( 'home_slider_page_one', array(
		    'capability'		=> 'edit_theme_options',
		    'default'			=> 0,
		    'sanitize_callback' => 'metlux_theme_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'home_slider_page_one', array(
		    'label'                 =>  __( 'Select Page For Slider 1', 'metlux' ),
		    'section'               => 'metlux_slider_section',
		    'type'                  => 'dropdown-pages',
		    'priority'              => 20,
		    'settings' => 'home_slider_page_one',
		) );


		$wp_customize->add_setting( 'home_slider_page_two', array(
		    'capability'		=> 'edit_theme_options',
		    'default'			=> 0,
		    'sanitize_callback' => 'metlux_theme_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'home_slider_page_two', array(
		    'label'                 =>  __( 'Select Page For slider 2', 'metlux' ),
		    'section'               => 'metlux_slider_section',
		    'type'                  => 'dropdown-pages',
		    'priority'              => 20,
		    'settings' => 'home_slider_page_two',
		) );


		$wp_customize->add_setting( 'home_slider_page_three', array(
		    'capability'		=> 'edit_theme_options',
		    'default'			=> 0,
		    'sanitize_callback' => 'metlux_theme_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'home_slider_page_three', array(
		    'label'                 =>  __( 'Select Page For slider 3', 'metlux' ),
		    'section'               => 'metlux_slider_section',
		    'type'                  => 'dropdown-pages',
		    'priority'              => 20,
		    'settings' => 'home_slider_page_three',
		) );



		 $wp_customize->add_setting('metlux_slider_category_display',array(
		    'sanitize_callback' => 'metlux_theme_sanitize_category',
		    'capability' => 'edit_theme_options',
		    'default' => ''
		    ));

		$wp_customize->add_control(new metlux_Customize_Dropdown_Taxonomies_Control($wp_customize,'metlux_slider_category_display',array(
		    'label' => __('Category if no page is selected','metlux'),
		    'section' => 'metlux_slider_section',
		    'settings' => 'metlux_slider_category_display',
		    'type'=> 'dropdown-taxonomies',
		    'priority'              => 20
		    )  

		));

	$wp_customize->add_setting( 'slider_no_of_posts', array(
			    'capability'        => 'edit_theme_options',
			    'default'           => '3',
			    'sanitize_callback' => 'metlux_theme_sanitize_text'
	) );

	$wp_customize->add_control( 'slider_no_of_posts', array(
			    'settings' => 'slider_no_of_posts',
			    'label'    =>  __( 'No Of Posts To Show On Home Slider', 'metlux' ),
			    'section'  => 'metlux_slider_section',
			    'type'     => 'select',
			    'choices'  => array(
			        '1' => __( '1', 'metlux' ),
			        '2' => __( '2', 'metlux' ),
			        '3' => __( '3', 'metlux' ),			       
			        ),
			    'priority'              => 20
	) );

		$wp_customize->add_setting('slider_read_more',array(
		    'sanitize_callback' => 'metlux_theme_sanitize_text',
		    'capability' => 'edit_theme_options',
		    'default' => __('Read More','metlux')
		    ));

		$wp_customize->add_control('slider_read_more',array(
		    'label'     =>__('Read More Text', 'metlux'),
		    'section'   => 'metlux_slider_section',
		    'type'      => 'text',
		    'settings'	=> 'slider_read_more',
		    'capability' => 'edit_theme_options',
		    'priority'              => 20
		    ));
