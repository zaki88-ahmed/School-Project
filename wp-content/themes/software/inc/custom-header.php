<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package software
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses software_header_style()
 */
function software_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'software_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'software_header_style',
		
	) ) );
}
add_action( 'after_setup_theme', 'software_custom_header_setup' );

if ( ! function_exists( 'software_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see software_custom_header_setup().
 */
function software_header_style() {
	$header_text_color = get_header_textcolor();

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
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
		.logo h1 a, .site-description , .logo-menu .dropdown-menu > li > a, .logo-menu .main-menu .navbar-nav > li > a, .logo-menu .main-menu .navbar-default .navbar-nav > .active > a{
			color: #<?php echo  esc_html($header_text_color); ?>;
		}
	<?php endif; ?>

	.page-header{

				background:#24C0D7 url('<?php header_image(); ?>');
				background-size: cover;

				}

	</style>
	<?php
}
endif;


