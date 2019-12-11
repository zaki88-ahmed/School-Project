<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class OTB_Same_But_Different {

	/**
	 * The single instance of OTB_Same_But_Different.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * Settings class object
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $settings = null;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $_version;

	/**
	 * The text domain.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $_text_domain;
	
	/**
	 * The main plugin file.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $file;

	/**
	 * The main plugin directory.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $dir;

	/**
	 * The plugin assets directory.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $assets_dir;

	/**
	 * The plugin assets URL.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $assets_url;

	/**
	 * Suffix for Javascripts.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $script_suffix;

	/**
	 * Suffix for Javascripts.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $has_run;

	/**
	 * Suffix for Javascripts.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $is_main_single_post_query = false;
	
	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct( $file = '', $version = '1.0.05' ) {
		$this->_version 	= $version;
		$this->_text_domain	= 'same-but-different';

		// Load plugin environment variables
		$this->file 	  = $file;
		$this->dir 		  = dirname( $this->file );
		$this->assets_dir = trailingslashit( $this->dir ) . 'library';
		$this->assets_url = esc_url( trailingslashit( plugins_url( '/library/', $this->file ) ) );
		
		$this->tabs['general'] = array(
			'title' => __( 'Settings', 'same-but-different' ),
			'type' => 'settings'
		);
		
		$this->tabs['themes'] = array(
			'title' => __( 'Our Themes', 'same-but-different' ),
			'type' => 'content'
		);
		
		$this->themes = array (
  			'tropicana' => array (
				'slug' => 'tropicana',
				'title' => 'Tropicana',
			    'thumbnail' => 'https://www.outtheboxthemes.com/wp-content/uploads/2018/07/tropicana-imac.png',
    			'coming_soon' => 'false',
    			'new' => 'true'
		  	),
  			'north-shore' => array (
				'slug' => 'north-shore',
				'title' => 'North Shore',
			    'thumbnail' => 'https://www.outtheboxthemes.com/wp-content/uploads/2018/03/north-shore-imac.png',
    			'coming_soon' => 'false',
    			'new' => 'false'
		  	),
  			'citylogic' => array (
				'slug' => 'citylogic',
				'title' => 'CityLogic',
			    'thumbnail' => 'https://www.outtheboxthemes.com/wp-content/uploads/2017/08/citylogic-imac.png',
    			'coming_soon' => 'false',
    			'new' => 'false'
		  	),
  			'shopstar' => array (
				'slug' => 'shopstar',
				'title' => 'Shopstar!',
			    'thumbnail' => 'https://www.outtheboxthemes.com/wp-content/uploads/2015/12/shopstar-imac.png',
    			'coming_soon' => 'false',
    			'new' => 'false'
		  	),
  			'panoramic' => array (
				'slug' => 'panoramic',
				'title' => 'Panoramic',
			    'thumbnail' => 'https://www.outtheboxthemes.com/wp-content/uploads/2015/12/panoramic-imac.png',
    			'coming_soon' => 'false',
    			'new' => 'false'
			)
		);
		
			// Check if there are any new themes
		foreach ($this->themes as $theme) {
			$theme = (object) $theme;
			$new = 'true' === $theme->new;
			
			if ($new && !get_option( 'otb_new_theme_' .$theme->slug. '_viewed' ) ) {
				add_filter( 'add_menu_classes', array( $this, 'show_notification_bubble' ) );
				
				update_option( 'otb_new_theme', true );
				$this->tabs['themes']['highlighted'] = true;
			}
		}
		
		$this->script_suffix = defined( 'OTB_SAME_BUT_DIFFERENT_DEBUG' ) && OTB_SAME_BUT_DIFFERENT_DEBUG ? '' : '.min';

		register_activation_hook( $this->file, array( $this, 'install' ) );

		// Load admin JS & CSS
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ), 10, 1 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ), 10, 1 );
		
		// Load front end JS & CSS
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front_end_scripts' ), 10, 1 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front_end_styles' ), 10, 1 );

		// Load API for generic admin functions
		if ( is_admin() ) {
			$this->admin = new OTB_Same_But_Different_Admin_API();
		}
				
		// Handle localisation
		$this->load_plugin_textdomain();
		add_action( 'init', array( $this, 'load_localisation' ), 0 );
		
		// Add page to menu
		add_action( 'admin_menu' , array( $this, 'add_menu_item' ) );

		add_action( 'pre_get_posts', array( $this, 'check_if_single_post' ) ) ;
		add_action( 'parse_comment_query', array( $this, 'show_related_posts_in_post_footer' ) );
		add_action( 'loop_end', array( $this, 'show_related_posts_in_post_footer' ) );
		
		// Add a link to the plugin listing on the Installed Plugins page
		add_filter( 'plugin_action_links_' . plugin_basename( $this->file ) , array( $this, 'add_link_to_plugin_listing' ) );
		
		add_action( 'widgets_init', array( $this, 'load_custom_widgets' ) );
	}
	
	/**
	 * Add page to admin menu
	 * @return void
	 */
	public function add_menu_item() {
		
		$badge = "";

		if ( get_option( 'otb_new_theme' ) ) {
			$badge = "<span class='update-plugins update-badge count-1' title='New theme'><span class='update-count'>1</span></span>";
		}

		$page = add_theme_page(
			__( 'Same but Different', 'same-but-different' ),
			__( 'Same but Different' . $badge, 'same-but-different' ),
			'edit_theme_options',
			$this->_text_domain . '_settings',
			array( $this, 'do_action'
		) );
		
		add_action( 'admin_print_styles-' . $page, array( $this->settings, 'settings_assets' ) );
	}
	
	public function check_if_single_post( $query ) {
		if( $query->is_main_query() 
		    && $query->is_singular()
			&& ! $query->is_page() 
		    && ! $query->is_attachment()
		) {
			$this->is_main_single_post_query = true;
		} 	
	}

	public function show_related_posts_in_post_footer() {
		global $post;
		
		if ( !get_option( $this->settings->base . 'display_on_posts', $this->get_default_value( 'display_on_posts' ) ) || !($this->is_main_single_post_query && is_singular('post') ) || $this->has_run ) {
			return false;
		}
		
		$title 			   = get_option( $this->settings->base . 'title', $this->get_default_value( 'title' ) );
		$amount 		   = get_option( $this->settings->base . 'amount', $this->get_default_value( 'amount' ) );
		$order 			   = get_option( $this->settings->base . 'order', $this->get_default_value( 'order' ) );
		$title_heading_tag = get_option( $this->settings->base . 'title_heading_tag', $this->get_default_value( 'title_heading_tag' ) );
		
		$display_fields	= get_option( $this->settings->base . 'display_fields', $this->get_default_value( 'display_fields' ) );
		$show_thumbnail = in_array( 'thumbnail', $display_fields );
		$show_title 	= in_array( 'title', $display_fields );
		
		$relate_by 		= get_option( $this->settings->base . 'relate_by', $this->get_default_value( 'relate_by' ) );

		if ( !is_array($relate_by) ) {
			return;
		}
		
		$relate_by_categories = in_array( 'category', $relate_by );
		$relate_by_tags 	  = in_array( 'post_tag', $relate_by );
		
		$assets_url = $this->assets_url;
		
		include( $this->assets_dir .'/includes/get-related-posts.php');
		
		if ( empty($posts) ) {
			return;
		}
		
		echo '<div class="same-but-different related-posts-container post-footer">';
		echo '<a name="same-but-different-related-posts-footer"></a>';
		
		if ( !empty($title) ) {
			echo '<h3>' .$title . '</h3>';
		}
		
		include( $this->assets_dir .'/template-parts/related-posts.php' );
		
		echo '</div>';
		
		$this->has_run = true;
	}

	public function show_notification_bubble( $menu ) {
		foreach( $menu as $menu_key => $menu_data ) {
			if ( $menu_data[0] == 'Appearance' ) {
				$menu[$menu_key][0] .= "<span class='update-plugins count-1'><span class='plugin-count'>1</span></span>";
			}
		}
				
		return $menu;
	}
	
	// Register and load the custom widgets
	public function load_custom_widgets() {
		register_widget( 'OTB_Same_But_Different_Widget' );
	}
	
	public function get_default_value( $id ) {
		$array = $this->settings->settings['general']['fields'];
	
		foreach ($array as $key => $val) {
			if ($val['id'] === $id) {
				return $val['default'];
			}
		}
		return null;
	}
	
	/**
	 * Add an upgrade link to installed plugins list
	 * @param  array $links Existing links
	 * @return array 		Modified links
	 */
	public function add_link_to_plugin_listing( $links ) {
		$settings_link = '<a href="themes.php?page=' . $this->_text_domain . '_settings">' . __( 'Settings', 'same-but-different' ) . '</a>';
		array_push( $links, $settings_link );
		return $links;
		
	}
	
	public function do_action() {
		if ( isset( $_GET['action'] ) ) {
			$action = sanitize_text_field( $_GET['action'] );
		} else {
			$action = 'view-page';
		}
	
		switch ( $action ) {
			case 'view-page':
				$tab;
				
				if ( isset( $_GET['tab'] ) && $_GET['tab'] ) {
					$tab = sanitize_text_field( $_GET['tab'] );
				} else {
					reset($this->tabs);
					$tab = key($this->tabs);
				}
				
				$this->render_page( $tab );
	
				break;
		}
	}
	
	/**
	 * Load page content
	 * @return void
	 */
	public function render_page( $tab ) {
		// Build page HTML
		echo '<div class="wrap" id="' . $this->_text_domain . '_settings">' . "\n";
		
		include($this->assets_dir .'/template-parts/tabs.php');
		
		if ( $this->tabs[$tab]['type'] == 'settings' ) {
			include($this->assets_dir .'/template-parts/content-settings.php');
		} elseif ( $this->tabs[$tab]['type'] == 'content' ) {
			include($this->assets_dir .'/template-parts/content-'. $tab .'.php');
		}
	
		echo '</div>' . "\n";
	}
	
	/**
	 * Load admin CSS.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function enqueue_admin_styles( $hook = '' ) {
		wp_enqueue_style( $this->_text_domain .'-admin-style', esc_url( $this->assets_url ). 'css/admin-style.css', array(), $this->_version );
	}

	/**
	 * Load admin Javascript.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function enqueue_admin_scripts( $hook = '' ) {
	}

	/**
	 * Load front end CSS.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	
	public function enqueue_front_end_styles( $hook = '' ) {
		wp_enqueue_style( $this->_text_domain .'-style', esc_url( $this->assets_url ). 'css/style.css', array(), $this->_version );
	}

	/**
	 * Load front end Javascript.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function enqueue_front_end_scripts( $hook = '' ) {
	}

	/**
	 * Load plugin localisation
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function load_localisation() {
		load_plugin_textdomain( 'same-but-different', false, dirname( plugin_basename( $this->file ) ) . '/languages/' );
	}

	/**
	 * Load plugin textdomain
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function load_plugin_textdomain() {
	    $domain = 'same-but-different';

	    $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

	    load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
	    load_plugin_textdomain( $domain, false, dirname( plugin_basename( $this->file ) ) . '/languages/' );
	}
	
	/**
	 * Main OTB_Same_But_Different Instance
	 *
	 * Ensures only one instance of OTB_Same_But_Different is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see OTB_Same_But_Different()
	 * @return Main OTB_Same_But_Different instance
	 */
	public static function instance( $file = '', $version = '1.0.05' ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $file, $version );
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
	}

	/**
	 * Installation. Runs on activation.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install() {
		$this->_log_version_number();
	}

	/**
	 * Log the plugin version number.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	private function _log_version_number() {
		update_option( str_replace('-', '_', $this->_text_domain ) . '_version', $this->_version );
	}
	
}