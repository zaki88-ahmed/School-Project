<?php
/**
 * metlux functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package metlux
 */

/*// Register custom navigation walker
require_once('wp_bootstrap_navwalker.php');*/

if ( ! function_exists( 'metlux_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function metlux_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on metlux, use a find and replace
	 * to change 'metlux' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'metlux', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'metlux' ),
		'secondary'=>esc_html__( 'Secondary' ,'metlux')
		) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'gallery',
		'caption',
		) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'metlux_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
		) ) );
	add_theme_support( 'custom-logo', array(
	  'height'      => 45,
	  'width'       => 200,
	  'flex-height' => true,
	  'flex-width'  => true,  
	 ) );
}

//registering featured image and defining custom size for image
add_theme_support( 'post-thumbnails' );
add_image_size('metlux-products', 307, 230, true);
add_image_size('metlux-team', 307, 309, true);
add_image_size('metlux-customer', 277, 346, true);
add_image_size('metlux-blog', 645, 336, true);
add_image_size('metlux-clientLogo',110, 62,true);
add_image_size('metlux-single-blog',980, 510,true);
add_image_size('metlux-related',320, 159,true);
add_image_size('metlux-slider',1900, 1000,true);	



endif;
add_action( 'after_setup_theme', 'metlux_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function metlux_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'metlux_content_width', 640 );
}
add_action( 'after_setup_theme', 'metlux_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function metlux_widgets_init() {

	register_sidebar( array(
		'name'          => __(' Right Sidebar','metlux'),
		'id'            => 'sidebar-1',
		'description'   => __('Drag your widgets for Right Sidebar here','metlux'),
		'before_widget' => '<div class="single %2$s ">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="side-title">',
		'after_title'   => '</h3>',
		) );

	register_sidebar( array(
		'name'          => __(' Left Sidebar','metlux'),
		'id'            => 'left_sidebar',
		'description'   => __('Drag your widgets for Left Sidebar here','metlux'),
		'before_widget' => '<div class="single %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="side-title">',
		'after_title'   => '</h3>',
		) );

	register_sidebar( array(
		'name'          => __(' Footer left Sidebar','metlux'),
		'id'            => 'footer_left',
		'description'   => __('Drag your widgets for Footer left  here(One Text widget is recommended for this sidebar)','metlux'),
		'before_widget' => '<div class="footer-about %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer-title">',
		'after_title'   => '</h2>',
		) );

	register_sidebar( array(
		'name'          => __(' Footer Right Sidebar','metlux'),
		'id'            => 'footer_right',
		'description'   => __('Drag your widgets for Footer Right  here(Two  widgets are recommended for this sidebar )','metlux'),
		'before_widget' => '<div class="col-md-6 col-sm-6 left-border %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer-title">',
		'after_title'   => '</h2>',
		) );

	register_sidebar( array(
		'name'          => __(' Home Page Widget Area','metlux'),
		'id'            => 'newsletter',
		'description'   => __('Drag your widgets for home page here(Newsletter widget recommended for this sidebar )','metlux'),
		'before_widget' => '<div class="single %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
		) );
	register_sidebar( array(
		'name'          => __('Video Section','metlux'),
		'id'            => 'video_section',
		'description'   => __('Copy and Post Code For Video from Youtube )','metlux'),
		'before_widget' => '<div class=" %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
		) );
}
add_action( 'widgets_init', 'metlux_widgets_init' );



function metlux_date(){
	echo ' <strong>' . esc_attr( get_the_date(__('j','metlux')) ).'</strong>';  echo '<p>' .esc_attr( get_the_date(__('M','metlux')) ).  '<br>'
	.esc_attr( get_the_date(__(' Y','metlux')) ). '</br>';
}






/*Registering styles and scripts for metlux theme */

function metlux_styles(){
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() .'/css/bootstrap.css');
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.css');
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css/owl.carousel.css');
	wp_enqueue_style( 'owl-theme', get_template_directory_uri() .'/css/owl.theme.css');
	wp_enqueue_style( 'metlux-custom', get_template_directory_uri() .'/css/custom.css');
	wp_enqueue_style( 'metlux-style',get_stylesheet_uri(),'1.0.0' );

	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() .'/js/bootstrap.js',array('jquery'), '1.0.0',true);
	wp_enqueue_script( 'smartmenus', get_template_directory_uri() .'/js/jquery.smartmenus.js',array('jquery'),'1.0.0',true);
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() .'/js/owl.carousel.js',array('jquery'),'1.0.0',true);
	wp_enqueue_script( 'metlux-scripts', get_template_directory_uri() .'/js/script.js',array('jquery'), '1.0.0', true);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) && !(is_front_page()) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    add_editor_style( 'metlux-custom', get_template_directory_uri().'/css/custom.css' );


    if(is_rtl()) {
		wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri().'/css/bootstrap-rtl.css' );
		wp_enqueue_style( 'font-awesome-rtl', get_template_directory_uri().'/css/font-awesome-rtl.css' );
		wp_enqueue_style( 'owl-carousel-rtl', get_template_directory_uri() . '/css/owl-carousel.js', array(), '1.0.0', true );
        wp_enqueue_script( 'bootstrap-rtl-js', get_template_directory_uri() . '/js/bootstrap-rtl.js', array(), '1.0.0', true );
       
	}
}
add_action( 'wp_enqueue_scripts', 'metlux_styles');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/class.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets/widgets.php';


require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';


// --- comment form


add_action('comment_form', 'metlux_comment_button' );
function metlux_comment_button() {
    echo '<div class="submit-button col-sm-12">';
        echo '<button class="btn btn-theme" type="submit">' . __( 'Submit', 'metlux' ) . '</button>';
    echo '</div>';
}