<?php
/*
 * Styles and scripts registration and enqueuing
 *
 * @package nirvana
 * @subpackage Functions
 */

/**
 * Enqueue all the styles 
 */
function nirvana_enqueue_styles() {
	global $nirvanas;
	extract($nirvanas);

	wp_enqueue_style( 'nirvana-fonts', get_template_directory_uri() . '/fonts/fontfaces.css', NULL, _CRYOUT_THEME_VERSION ); // fontfaces.css

	/* Google fonts */
	$gfonts = array();
	if (!empty($nirvana_googlefont)) 			$gfonts[] = cryout_gfontclean( $nirvana_googlefont );
	if (!empty($nirvana_googlefonttitle)) 		$gfonts[] = cryout_gfontclean( $nirvana_googlefonttitle );
	if (!empty($nirvana_googlefontside)) 		$gfonts[] = cryout_gfontclean( $nirvana_googlefontside );
	if (!empty($nirvana_googlefontwidget)) 		$gfonts[] = cryout_gfontclean( $nirvana_googlefontwidget );
	if (!empty($nirvana_sitetitlegooglefont))	$gfonts[] = cryout_gfontclean( $nirvana_sitetitlegooglefont );
	if (!empty($nirvana_menugooglefont)) 		$gfonts[] = cryout_gfontclean( $nirvana_menugooglefont );
	if (!empty($nirvana_headingsgooglefont))	$gfonts[] = cryout_gfontclean( $nirvana_headingsgooglefont );

	// enqueue fonts with subsets separately
	foreach($gfonts as $i=>$gfont):
		if (strpos($gfont,"&") !== false):
			wp_enqueue_style( 'nirvana-googlefont_'.$i, '//fonts.googleapis.com/css?family=' . $gfont );
			unset($gfonts[$i]);
		endif;
	endforeach;

	// merged google fonts
	if ( count($gfonts)>0 ):
		wp_enqueue_style( 'nirvana-googlefonts', '//fonts.googleapis.com/css?family=' . implode( "|" , array_unique($gfonts) ), array(), null, 'screen' ); // google fonts
	endif;

	// Main theme style
	wp_enqueue_style( 'nirvana-style', get_stylesheet_uri(), NULL, _CRYOUT_THEME_VERSION ); // main style.css
	
	// Options-based generated styling
 	wp_add_inline_style( 'nirvana-style', preg_replace( "/[\n\r\t\s]+/", " ", nirvana_custom_styles() ) ); // includes/custom-styles.php
	
	// Presentation Page options-based styling (only used when needed)
	if ( ($nirvana_frontpage=="Enable") && is_front_page() && ('posts' == get_option( 'show_on_front' )) ) {
	    wp_add_inline_style( 'nirvana-style', preg_replace( "/[\n\r\t\s]+/", " ", nirvana_presentation_css() ) ); // also in includes/custom-styles.php
	}
	
	// RTL support
	if ( is_rtl() ) wp_enqueue_style( 'nirvana-rtl', get_template_directory_uri() . '/styles/rtl.css', NULL, _CRYOUT_THEME_VERSION );	
	
	// User supplied custom styling
	wp_add_inline_style( 'nirvana-style', preg_replace( "/[\n\r\t\s]+/", " ", nirvana_customcss() ) ); // also in includes/custom-styles.php   
	
	// Responsive styling (loaded last)
	if ( $nirvana_mobile=="Enable" ) {
	    wp_enqueue_style( 'nirvana-mobile', get_template_directory_uri() . '/styles/style-mobile.css', NULL, _CRYOUT_THEME_VERSION  );
	}
	
} // nirvana_enqueue_styles()
add_action( 'wp_enqueue_scripts', 'nirvana_enqueue_styles' );


/**
 * Custom JS 
 */
add_action( 'wp_footer', 'nirvana_customjs', 35 ); // includes/custom-styles.php


/**
 * Frontend scripts 
 */
function nirvana_scripts_method() {
	global $nirvanas;

	wp_enqueue_script('nirvana-frontend',get_template_directory_uri() . '/js/frontend.js', array('jquery'), _CRYOUT_THEME_VERSION, true );

	if (($nirvanas['nirvana_frontpage'] == "Enable") && is_front_page() && !is_page()) {
		// if PP and the current page is frontpage - load the nivo slider js
		wp_enqueue_script('nirvana-nivoslider',get_template_directory_uri() . '/js/nivo.slider.min.js', array('jquery'), _CRYOUT_THEME_VERSION, true);
		// add slider init js in footer
		add_action('wp_footer', 'nirvana_pp_slider' ); // frontpage.php
	}
	
	$js_options = array(
		//'masonry' => $nirvana_masonry,
		'mobile' => ( ($nirvanas['nirvana_mobile']=='Enable') ? 1 : 0 ),
		'fitvids' => $nirvanas['nirvana_fitvids'],
		'contentwidth' => $nirvanas['nirvana_sidewidth'],
	);
	//wp_localize_script( 'nirvana-frontend', 'cryout_global_content_width', $nirvanas['nirvana_sidewidth'] );
	wp_localize_script( 'nirvana-frontend', 'nirvana_settings', $js_options );

	// Support sites with threaded comments (when in use)
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
if ( !is_admin() ) add_action( 'wp_enqueue_scripts', 'nirvana_scripts_method' );

/**
 * Customize editor styling a bit
 * nirvana_custom_editor_styles() is located in custom-styles.php
 */
function nirvana_add_editor_styles() {
	add_editor_style( add_query_arg( 'action', 'nirvana_editor_styles', admin_url( 'admin-ajax.php' ) ) );
	add_action( 'wp_ajax_nirvana_editor_styles', 'nirvana_editor_styles' );
	add_action( 'wp_ajax_no_priv_nirvana_editor_styles', 'nirvana_editor_styles' );
} // nirvana_add_editor_styles()
if ( is_admin() && $nirvanas['nirvana_editorstyle'] ) nirvana_add_editor_styles();

// FIN
