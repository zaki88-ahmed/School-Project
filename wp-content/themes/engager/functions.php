<?php
/**
 * engager functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package engager
 */

if ( ! function_exists( 'engager_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function engager_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/directory.
	 * If you're building a theme based on engager, use a find and replace
	 * to change 'engager' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'engager', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_image_size( 'engager-slider-image', 1350, 575, true);
    add_image_size( 'engager-information-image' , 458, 305, true);
    add_image_size( 'engager-blog-image' , 360, 240, true);
	add_image_size( 'engager-post-image' , 748, 234, true);
	add_image_size('engager_featured_image',25, 30, true);
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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'engager' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// ADD Custom Logo 
	add_theme_support( 'custom-logo' , array(
		'height'		=>45,	
		'width'			=>200,	
		'flex-height'	=>true,	
		'flex-width'	=>true,
	));


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'engager_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'engager_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function engager_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'engager_content_width', 640 );
}
add_action( 'after_setup_theme', 'engager_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function engager_widgets_init() {

	/** ----- Right Sidebar   ------*/
	register_sidebar( array(
		'name'          => __('Sidebar Right','engager'),		
		'id'            => 'sidebar-1',
		'before_widget' => '<div class="side-single %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="side-title">',
		'after_title'   => '</h2><div class="underline"></div>',
	) );

    
    
	/** --------- Footer Sidebar  -----*/
	register_sidebar( array(
			'name'          => __('Footer Sidebar','engager'),
			'id'            => 'footer_sidebar',
			'before_widget' => '<div class="col-md-3 col-sm-6 %2$s ">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );

	
	/** ----- Left Sidebar   ------*/	
	register_sidebar( array(
			'name'          => __('Sidebar Left','engager'),
			'id'            => 'left_sidebar',
			'before_widget' => '<div class="side-single %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="side-title">',
			'after_title'   => '</h2><div class="underline"></div>',
		) );
        
    

}
add_action( 'widgets_init', 'engager_widgets_init' );


function engager_add_editor_styles() {
	$rep_lace=array("%2B", "%2C","%3A");
    $font_url = str_replace( $rep_lace, " ", "//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" );
    add_editor_style( $font_url );
}
add_action( 'after_setup_theme', 'engager_add_editor_styles' );

/**
 * Enqueue scripts and styles.
 */
function engager_scripts() {
	wp_enqueue_style( 'engager-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri().'/css/bootstrap.css',array(), '1.0.0' );
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri(). '/css/font-awesome.css' ,array(), '1.0.0' );	
	wp_enqueue_style( 'engager-custom-css', get_template_directory_uri(). '/css/custom.css',array(), '1.0.0' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css/owl.carousel.css',array(), '1.0.0' );
    wp_enqueue_style( 'owl-theme', get_template_directory_uri(). '/css/owl.theme.css',array(), '1.0.0' );
	$query_args = array(
		'family' => 'Open+Sans:300,400,600,700' 
	);
	wp_register_style( 'google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
	wp_enqueue_style( 'google-fonts' );
	

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'engager-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array(), '1.0.0', true );
	wp_enqueue_script( 'responsiveslides', get_template_directory_uri() . '/js/responsiveslides.js', array(), '1.0.0', true );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array(), '1.0.0', true );
	wp_enqueue_script( 'engager-script', get_template_directory_uri() . '/js/script.js', array(), '1.0.0', true );

	wp_enqueue_script( 'engager-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if(is_rtl()){
		wp_enqueue_style( 'engager-style-rtl-css', get_template_directory_uri().'/style-rtl.css' , array(), '1.0.0', true );
		wp_enqueue_style( 'bootstrap-rtl-css', get_template_directory_uri().'/css/bootstrap-rtl.css' , array(), '1.0.0', true );
		wp_enqueue_style( 'font-awesome-rtl-css', get_template_directory_uri(). '/css/font-awesome-rtl.css' , array(), '1.0.0', true );		
		wp_enqueue_style( 'engager-custom-rtl-css', get_template_directory_uri(). '/css/custom-rtl.css', array(), '1.0.0', true );
		wp_enqueue_script( 'bootstrap-rtl-js', get_template_directory_uri() . '/js/bootstrap-rtl.js', array(), '1.0.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'engager_scripts' );

function engager_add_editor_style() {
    
     add_editor_style('css/custom.css' );
}
add_action( 'after_setup_theme', 'engager_add_editor_style' );

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
require get_template_directory() . '/inc/customizer.php';

/**
*	Load Nav Walker File
*/
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/**
*  Load Class File 
*/
require get_template_directory() . '/inc/class.php';

