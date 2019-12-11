<?php
/**
 * software functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package software
 */

if ( ! function_exists( 'software_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function software_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on software, use a find and replace
	 * to change 'software' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'software', get_template_directory() . '/languages' );

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
	
	add_image_size( 'software-category-thumb', 350, 263, true ); // Category Images
	add_image_size( 'software-feature-thumb', 440, 390, true ); // Feature Images
	add_image_size( 'software-front-thumb', 555, 435, true ); // Front Images
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'software' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
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
	add_theme_support( 'custom-background', apply_filters( 'software_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'software_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function software_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'software_content_width', 640 );
}
add_action( 'after_setup_theme', 'software_content_width', 0 );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function software_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'software' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'software' ),
		'before_widget' => '<div class="single">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="side-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Left Sidebar', 'software' ),
		'id'            => 'sidebar_footer_left',
		'description'   => esc_html__( 'Add Socialize Widget Here.', 'software' ),
		'before_widget' => '<div class="social-media wow slideInUp">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="content-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Right Sidebar', 'software' ),
		'id'            => 'sidebar_footer_right',
		'description'   => esc_html__( 'Add Testimonial Widget Here.', 'software' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
}
add_action( 'widgets_init', 'software_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function software_scripts() {
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri().'/css/bootstrap.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.css' );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri().'/css/owl.carousel.css' );
	wp_enqueue_style( 'owl-theme', get_template_directory_uri().'/css/owl.theme.css' );
	wp_enqueue_style( 'animate', get_template_directory_uri().'/css/animate.css' );
	wp_enqueue_style( 'software-responsive', get_template_directory_uri().'/css/responsive.css' );
	wp_enqueue_style( 'software-style', get_stylesheet_uri() );
	add_editor_style( 'software-editor-style', get_template_directory_uri().'/css/editor-style.css' );
	
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'wow.min', get_template_directory_uri() . '/js/wow.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'software-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '20151215', true );

	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'software_scripts' );

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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

require get_template_directory() . '/inc/widgets.php';



// ================ CLOUDPRESS THEME THEME BREADCRUMB CUSTOMIZE ================== //
if ( ! function_exists( 'software_theme_breadcrumbs' ) ) :

//add Bootstrap Breadcrumbs to your WordPress
	function software_theme_breadcrumbs() {

		$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter = ''; // delimiter between crumbs
		$home = 'Home'; // text for the 'Home' link
		$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$before = '<li class="active">'; // tag before the current crumb
		$after = '</li>'; // tag after the current crumb

		global $post;
		$homeLink = esc_url( home_url() );

		if (is_home() || is_front_page()) {

			if ($showOnHome == 1) echo '<ol class="breadcrumb"><li><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a></li></ol>';

		} else {

			echo '<ol class="breadcrumb"><li><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a> ' . esc_html($delimiter) . '</li> ';

			if ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) 
				{
								$parents_list = '<li>' . get_category_parents($thisCat->parent, TRUE, '</li><li> ' . $delimiter . ' ') ;
								$parents_list = substr($parents_list,0,-6);
								echo wp_kses_post($parents_list);
			    }
				the_archive_title('<li class="active">' ,'</li>');
			} elseif ( is_search() ) {
				echo '<li>'.esc_html( __('Search results for','software') . $delimiter ).'</li>';
				echo '<li class="active">' . esc_html( get_search_query() ). '"' . '</li>';

			} elseif ( is_day() ) {
				echo '<li><a href="' .esc_html( get_year_link(get_the_time('Y'))) . '">' . esc_html( get_the_time('Y')) . '</a> ' . esc_html($delimiter) . '</li> ';
				echo '<li><a href="' .esc_html( get_month_link(get_the_time('Y'),get_the_time('m')) ). '">' . esc_html(get_the_time('F')) . '</a> ' . esc_html($delimiter) . '</li> ';
				echo '<li class="active">' .esc_html( get_the_time('d')) .  '</li>';

			} elseif ( is_month() ) {
				echo '<li><a href="' .esc_html( get_year_link(get_the_time('Y')) ). '">' . esc_html(get_the_time('Y')) . '</a> ' . esc_html($delimiter) . '</li> ';
				echo '<li class="active">' .esc_html( get_the_time('F')) .  '</li>';

			} elseif ( is_year() ) {
				echo '<li class="active">' .esc_html(  get_the_time('Y')) .  '</li>';

			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					echo '<li><a href="' . esc_url($homeLink . '/' . $slug['slug'] .'/') . '">' . esc_html($post_type->labels->singolar_name) . '</a>';
					if ($showCurrent == 1) echo ' ' . esc_html($delimiter) . '</li> ' . '<li class="active">' . get_the_title() . '</li>';
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . '</li> ');
					if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
					echo '<li>' . wp_kses_post($cats) . '</li>';
					if ($showCurrent == 1) echo '<li class="active">'.esc_html(get_the_title()).'</li>';
				}

			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				echo esc_html($before . $post_type->labels->singolar_name . $after);

			} elseif ( is_attachment() ) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				echo esc_html(get_category_parents($cat, TRUE, ' ' . $delimiter . '</li> '));
				echo '<li><a href="' . esc_url(get_permalink($parent)) . '">' . esc_html($parent->post_title) . '</a>';
				if ($showCurrent == 1) echo esc_html(' ' . $delimiter . '</li> ' . $before . get_the_title() . $after);

			} elseif ( is_page() && !$post->post_parent ) {
				if ($showCurrent == 1) echo '<li class="active">'.esc_html( get_the_title() ) .'</li>';

			} elseif ( is_page() && $post->post_parent ) {
				$parent_id = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo wp_kses_post($breadcrumbs[$i]);
					if ($i != count($breadcrumbs)-1) echo esc_html(' ' . $delimiter . '</li> ');
				}
				if ($showCurrent == 1) echo ' ' . esc_html( $delimiter ) . '</li> ' .'<li class="active">'.esc_html(   get_the_title() ) . '</li>';

			} elseif ( is_tag() ) {
				echo '<li > '.esc_html( __('Posts tagged', 'software') . $delimiter ).'</li>';
				the_archive_title('<li class="active">','</li>');
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo '<li>' . esc_html( __('Articles posted by','software'). $delimiter ).'</li>';
				echo '<li class="active">'.esc_html( $userdata->display_name).'</li>';

			} elseif ( is_404() ) {
				echo '<li>' .esc_html( __('Error 404','software'). $delimiter ).'</li>';
				
			}

			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) 
				
				echo '<li>' .esc_html( __('Page','software'). $delimiter) .'</li>';
				echo '<li class="active">'.esc_html( get_query_var('paged')) .'</li>';
			
			}

			echo '</ol>';

		}
	} 
endif;



add_filter( 'comment_form_default_fields', 'software_theme_comment_form_fields' );
function software_theme_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="col-sm-4 "><div class="single">
                    <input class="form-control" id="author" name="author" placeholder="'. esc_attr(__( 'Name', 'software' )) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div></div>',
        'email'  => '<div class="col-sm-4 "><div class="single"> ' .
                    '<input class="form-control" id="email" placeholder="' . esc_attr(__( 'Email', 'software' )) .'" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div></div>',
        'url'    => '<div class=" col-sm-4 "><div class="single">' .
                    '<input class="form-control" id="url" placeholder="' . esc_attr(__( 'Website', 'software' )) . '" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div>'        
    );
    
    return $fields;
}

add_filter( 'comment_form_defaults', 'software_theme_comment_form' );
function software_theme_comment_form( $args ) {
    $args['comment_field'] = '<div class="col-sm-12 ">
    	<div class="single"> 
            <textarea class="form-control" placeholder="' . esc_attr(__( 'Comment', 'software' )) . '" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </div></div>';
   // $args['class_submit'] = 'btn btn-default'; // since WP 4.1
    
    return $args;
}

add_action('comment_form', 'software_theme_comment_button' );
function software_theme_comment_button() {
    echo '<div class="col-sm-12 ">
    		<div class="single">
    		<button class="btn btn-theme" type="submit">' . esc_html(__( 'Submit', 'software' )) . '</button>
    		</div>
    	</div>';
}

add_action( 'init', 'software_add_excerpts_to_pages' );
function software_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
     
}

function software_excerpt( $length ) {
	if (!is_admin())
	{
			$excerpt = get_theme_mod('software_excerpt_setting',30);
		      return esc_attr($excerpt);
	}
	return $length;
}
add_filter( 'excerpt_length', 'software_excerpt', 999 );
function software_excerpt_more( $more ) {
		    if (!is_admin()) { 
			return '...';
			}
			return $more;
		}
add_filter( 'excerpt_more', 'software_excerpt_more' );
