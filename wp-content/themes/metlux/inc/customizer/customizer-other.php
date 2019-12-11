<?php
            //************ page  layout

            $wp_customize->add_panel('metlux_other_options',array(
                'capability'     => 'edit_theme_options',
                'priority'       => 400,
                'title' => __('Metlux Additional Options ', 'metlux')
                ));


            $wp_customize->add_section( 'metlux_layout_options', array(
                'capability' => 'edit_theme_options',
                'priority'       => 20,
                'title'          => __( ' Options', 'metlux' ),
                'panel'          => 'metlux_other_options'
                ) );

            $wp_customize->add_setting( 'metlux_default_layout', array(
                'capability'        => 'edit_theme_options',
                'default'           => '1',
                'sanitize_callback' => 'metlux_theme_sanitize_text'
                ) );

            $wp_customize->add_control( 'metlux_default_layout', array(
                'settings' => 'metlux_default_layout',
                'label'                 =>  __( ' Layout Style', 'metlux' ),
                'section'               => 'metlux_layout_options',
                'type'                  => 'radio',
                'choices'               => array(
                    '1' => __( 'Right Sidebar', 'metlux' ),
                    '2' => __( 'Left Sidebar ', 'metlux' ),
                    '3' => __( 'Both Sidebar', 'metlux' ),
                    '4' => __( 'No Sidebar', 'metlux' )
                    ),
                'priority'              => 20
                ) );
            

                ///// scrolll

               

                $wp_customize->add_setting( 'metlux_scrollup_setting', array(
                    'capability'        => 'edit_theme_options',
                    'default'           => '',
                    'sanitize_callback' => 'metlux_theme_sanitize_checkbox',
                ) );

                $wp_customize->add_control( 'metlux_scrollup_setting', array(
                    'label'     => __( 'Check to disable Scroll Up', 'metlux' ),
                    'section'   => 'metlux_layout_options',
                    'settings'  => 'metlux_scrollup_setting',
                    'type'      => 'checkbox',
                ) );
                // Scrollup End


            
                // copyright 

                $wp_customize->add_setting( 'metlux_copyright_setting', array(
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'metlux_theme_sanitize_text',
                'default'           =>  __('Copyright &copy; 2017 ','metlux'),
                
                ) );

            $wp_customize->add_control( 'metlux_copyright_setting', array(
                'settings'               => 'metlux_copyright_setting',
                'label'                 =>  __( 'Write Copyright Text', 'metlux' ),
                'section'               => 'metlux_layout_options',
                'type'                  => 'text',
                
                'priority'              => 20
                ) );






