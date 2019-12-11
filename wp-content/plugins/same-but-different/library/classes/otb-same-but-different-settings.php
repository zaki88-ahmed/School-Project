<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class OTB_Same_But_Different_Settings {

	/**
	 * The single instance of OTB_Same_But_Different_Settings.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * The main plugin object.
	 * @var 	object
	 * @access  public
	 * @since 	1.0.0
	 */
	public $parent = null;

	/**
	 * Available settings for plugin.
	 * @var     array
	 * @access  public
	 * @since   1.0.0
	 */
	public $settings = array();

	public function __construct ( $parent ) {
		$this->parent = $parent;
		
		$this->base = 'same_but_different_';
		
		// Initialise settings
		add_action( 'init', array( $this, 'init_settings' ), 11 );
		
		// Register plugin settings
		add_action( 'admin_init' , array( $this, 'register_settings' ) );
	}
	
	/**
	 * Initialise settings
	 * @return void
	 */
	public function init_settings () {
		$this->settings = $this->settings_fields();
	}
	
	/**
	 * Load settings JS & CSS
	 * @return void
	 */
	public function settings_assets () {
		
		wp_register_script( $this->parent->_text_domain . '-settings-js', $this->parent->assets_url . 'js/settings' . $this->parent->script_suffix . '.js', array( 'jquery' ), $this->parent->_version );				
		wp_enqueue_script( $this->parent->_text_domain . '-settings-js' );
		
	}	
	
	/**
	 * Build settings fields
	 * @return array Fields to be displayed on settings page
	 */
	private function settings_fields () {
		
		// Create a new settings configuration to be used on the Settings tab
		$settings['general'] = array(
			'title'					=> __( 'Settings', 'same-but-different' ),
			'description'			=> __( 'Configure the related posts.', 'same-but-different' ),
			'fields'				=> array(
				array(
					'id' 			=> 'display_on_posts',
					'label'			=> __( 'Display on posts', 'same-but-different' ),
					'type'			=> 'checkbox',
					'default'		=> 'on',
					'description'	=> ''
				),
				array(
					'id' 			=> 'title',
					'label'			=> __( 'Title', 'same-but-different' ),
					'type'			=> 'text',
					'default'		=> 'Other posts you might like...',
					'placeholder'	=> '',
					'description'	=> ''
				),
				array(
					'id' 			=> 'amount',
					'label'			=> __( 'Number of posts to show', 'same-but-different' ),
					'type'			=> 'number',
					'default'		=> 3,
					'placeholder'	=> '',
					'description'	=> ''
				),
				array(
					'id' 			=> 'order',
					'label'			=> __( 'Order', 'same-but-different' ),
					'type'			=> 'select',
					'options'		=> array(
						'ASC' => 'Date ascending',
						'DESC' => 'Date descending'
					),
					'default'		=> 'DESC',
					'description'	=> ''
				),
				array(
					'id' 			=> 'title_heading_tag',
					'label'			=> __( 'Title Heading Tag', 'same-but-different' ),
					'type'			=> 'select',
					'options'		=> array(
						'' 	 => 'None',
						'h2' => 'H2',
						'h3' => 'H3',
						'h4' => 'H4',
						'h5' => 'H5',
						'h6' => 'H6'
					),
					'default'		=> 'h5',
					'description'	=> ''
				),
				array(
					'id' 			=> 'display_fields',
					'label'			=> __( 'Show', 'same-but-different' ),
					'type'			=> 'checkbox_multi',
					'options'		=> array( 'thumbnail' => 'Thumbnail', 'title' => 'Title' ),
					'default'		=> array( 'thumbnail', 'title' ),
					'description'	=> ''
				),
				array(
					'id' 			=> 'relate_by',
					'label'			=> __( 'Relate by', 'same-but-different' ),
					'type'			=> 'checkbox_multi',
					'options'		=> array( 'category' => 'Category', 'post_tag' => 'Tag' ),
					'default'		=> array( 'category', 'post_tag' ),
					'description'	=> ''
				)
			)
		);
				
		$settings = apply_filters( $this->parent->_text_domain . '_settings_fields', $settings );
	
		return $settings;
	}
	
	/**
	 * Register plugin settings
	 * @return void
	 */
	public function register_settings () {
		if ( is_array( $this->settings ) ) {
	
			// Check posted/selected tab
			$current_section = '';
			if ( isset( $_POST['tab'] ) && $_POST['tab'] ) {
				$current_section = sanitize_text_field( $_POST['tab'] );
			} else {
				if ( isset( $_GET['tab'] ) && $_GET['tab'] ) {
					$current_section = sanitize_text_field( $_GET['tab'] );
				}
			}
	
			foreach ( $this->settings as $section => $data ) {
	
				if ( $current_section && $current_section != $section ) continue;
	
				// Add section to page
				add_settings_section( $section, $data['title'], array( $this, 'settings_section' ), $this->parent->_text_domain . '_settings' );
	
				foreach ( $data['fields'] as $field ) {
					// Validation callback for field
					$validation = '';
					if ( isset( $field['callback'] ) ) {
						$validation = $field['callback'];
					}
	
					// Register field
					$option_name = $this->base  . $field['id'];
					
					register_setting( $this->parent->_text_domain . '_settings', $option_name, $validation );
	
					// Add field to page
					add_settings_field( $field['id'], $field['label'], array( $this->parent->admin, 'display_field' ), $this->parent->_text_domain . '_settings', $section, array( 'field' => $field, 'prefix' => $this->base ) );
				}
	
				if ( ! $current_section ) break;
			}
		}
	}
	
	public function settings_section ( $section ) {
		$html = '<p> ' . $this->settings[ $section['id'] ]['description'] . '</p>' . "\n";
		echo $html;
	}
	
	/**
	 * Main OTB_Same_But_Different_Settings Instance
	 *
	 * Ensures only one instance of OTB_Same_But_Different_Settings is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see OTB_Same_But_Different()
	 * @return Main OTB_Same_But_Different_Settings instance
	 */
	public static function instance ( $parent ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $parent );
		}
		return self::$_instance;
	} // End instance()

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->parent->_version );
	} // End __clone()

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->parent->_version );
	} // End __wakeup()

}
