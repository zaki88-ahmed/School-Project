<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package education-one
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses education_one_body_classes()
 */
function education_one_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'education_one_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'education_one_body_classes',
	) ) );
}
add_action( 'after_setup_theme', 'education_one_custom_header_setup' );

if ( ! function_exists( 'education_one_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see education_one_custom_header_setup().
 */
function education_one_header_style() {
	$header_text_color = get_header_textcolor();


	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
if ( ! function_exists( 'education_one_header_background' ) ) :		

 function education_one_header_background(){

 	?> 	<style type="text/css">

			.page-header{

				background: #151D30 url('<?php header_image(); ?>')!important;
				background-size: cover!important;
				
				}


 	</style>

 	<?php

 }
 add_action( 'wp_head', 'education_one_header_background');

 endif;
 
