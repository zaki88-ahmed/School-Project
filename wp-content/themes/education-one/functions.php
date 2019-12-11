<?php
/**
 * education-one functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package education-one
 */

if ( ! function_exists( 'education_one_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function education_one_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on education-one, use a find and replace
	 * to change 'education-one' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'education-one', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'education-one-category-thumb', 392, 261, true ); // Homepage blog Images
	add_image_size( 'education-one-slider-thumb', 1920, 1080, true ); // slider  Images
	add_image_size( 'education-one-portfolio-thumb', 292, 219, true ); // portfolio  Images
	add_image_size( 'education-one-team-thumb', 222, 278, true ); // team  Images
	add_image_size( 'education-one-blog-thumb', 307, 230, true ); // blog  Images

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'education-one' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list',
		'gallery',
		'caption',
	) );

	  add_theme_support( 'custom-logo', array(
      'height'      => 45,
      'width'       => 200,
      'flex-height' => true,
      'flex-width'  => true,  
    ) ); 

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'education_one_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'education_one_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function education_one_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'education_one_content_width', 640 );
}
add_action( 'after_setup_theme', 'education_one_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function education_one_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'education-one' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'education-one' ),
		'before_widget' => '<div class="widget_area">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="widget_title">',
		'after_title'   => '</span>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'education-one Contact Info Sidebar', 'education-one' ),
		'id'            => 'contact-info',
		'description'   => esc_html__( 'Add education-one Contact Info Widget here.', 'education-one' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'education-one Homepage Newsletter', 'education-one' ),
		'id'            => 'newsletter',
		'description'   => esc_html__( 'Add Newssletter here.', 'education-one' ),
		'before_widget' => '<div class="content">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'education_one_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

function education_one_scripts() {
	
		
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css' );	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.css' );	
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri().'/css/owl.carousel.css' );	
	wp_enqueue_style( 'owl-theme', get_template_directory_uri().'/css/owl.theme.css' );	
	wp_enqueue_style( 'animate', get_template_directory_uri().'/css/animate.css' );	
	wp_enqueue_style( 'education-one-custom-styles', get_template_directory_uri().'/css/style.css' );
	wp_enqueue_style( 'education-one-style', get_stylesheet_uri() );
	$query_args = array('family' => 'Open+Sans:400,300,600,700,800,300italic,400italic,600italic,700italic,800italic');
	wp_register_style( 'education-one-google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
	wp_enqueue_style( 'education-one-google-fonts' );
	add_editor_style(  get_template_directory_uri().'/css/style.css' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'jquery-smartmenus', get_template_directory_uri() . '/js/jquery.smartmenus.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'animated-Modal', get_template_directory_uri() . '/js/animatedModal.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'education-one-script-js', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0.0', true );

	
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'education_one_scripts' );



/**
 * Fallback Menu
 * Instead of default bootstrap walker fallback
**/
class Education_One_Walker_Page extends Walker_Page {
  function start_lvl(&$output, $depth = 0, $args = Array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }
}

function education_one_wp_page_menu() {
	echo '<ul class="nav navbar-nav navbar-right">';
	wp_list_pages( array(
		'title_li' => '',
		'depth' => 8,
		'walker' => new Education_One_Walker_Page()
	) );
	echo '</ul>';
}

/**
* Include kirki
*/
if ( ! class_exists( 'Kirki' ) ) {
    include_once( dirname( __FILE__ ) . '/inc/kirki/kirki.php' );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/kirki-config.php';
require get_template_directory() . '/inc/customizer.php';

// Register Custom Navigation Walker
if ( ! class_exists( 'wp_bootstrap_navwalker' )) {
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';
}

if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
}

// BreadCrumbs
if ( ! class_exists( 'education_one_breadcrumb_trail' ) ) {
require get_template_directory() . '/inc/breadcrumbs.php';
}

////////////////////////////////////////////////////////////////////////////////////////////////////
if( !function_exists('education_one_register_required_plugins') ) {
    /**
     * Custom function to load TGMPA
     *
     * @since Pixova Lite 1.0.0
     */
    function education_one_register_required_plugins()
    {

        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(
            
            array(
                'name'                  => __('Newsletter','education-one'), // The plugin name.
                'slug'                  => 'newsletter', // The plugin slug (typically the folder name).
                'source'                => '', // The plugin source.
                'required'              => false, // If false, the plugin is only 'recommended' instead of required.
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
                'external_url'          => '' // If set, overrides default API URL and points to an external URL.
            ),
            
            array(
            	'name'                  => __(' Contact Form 7','education-one'), // The plugin name.
                'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name).
                'source'                => '', // The plugin source.
                'required'              => false, // If false, the plugin is only 'recommended' instead of required.
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
                'external_url'          => '' // If set, overrides default API URL and points to an external URL.
        	)
        );

        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'default_path' => '',                      // Default absolute path to pre-packaged plugins.
            'menu' => 'mt-install-plugins', // Menu slug.
            'has_notices' => true,                    // Show admin notices or not.
            'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg' => true,                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message' => '',                      // Message to output right before the plugins table.
            'strings' => array(
                'page_title' => __('Install Required Plugins', 'education-one'),
                'menu_title' => __('Install Plugins', 'education-one'),
                'installing' => __('Installing Plugin: %s', 'education-one'), // %s = plugin name.
                'oops' => __('Something went wrong with the plugin API.', 'education-one'),
                'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'education-one'), // %1$s = plugin name(s).
                'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'education-one'), // %1$s = plugin name(s).
                'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'education-one'), // %1$s = plugin name(s).
                'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'education-one'), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'education-one'), // %1$s = plugin name(s).
                'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'education-one'), // %1$s = plugin name(s).
                'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'education-one'), // %1$s = plugin name(s).
                'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'education-one'), // %1$s = plugin name(s).
                'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins', 'education-one'),
                'activate_link' => _n_noop('Begin activating plugin', 'Begin activating plugins', 'education-one'),
                'return' => __('Return to Required Plugins Installer', 'education-one'),
                'plugin_activated' => __('Plugin activated successfully.', 'education-one'),
                'complete' => __('All plugins installed and activated successfully. %s', 'education-one'), // %s = dashboard link.
                'nag_type' => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );

        tgmpa($plugins, $config);
    }

    add_action( 'tgmpa_register', 'education_one_register_required_plugins' );
}