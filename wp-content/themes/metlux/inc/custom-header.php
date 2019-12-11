<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package metlux
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses metlux_header_style()
 */
function metlux_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'metlux_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '#00bcd4',
		'width'                  => 1920,
		'height'                 => 350,
		'flex-height'            => true,
		'wp-head-callback'       => 'metlux_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'metlux_custom_header_setup' );

if ( ! function_exists( 'metlux_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see metlux_custom_header_setup().
 */
function metlux_header_style() {
   

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
		.site-description, .logo-menu .navbar-nav > li > a {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
