/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// welcome
	wp.customize( 'welcome_title', function( value ) {
		value.bind( function( to ) {
			$( '.welcome .section-title h2' ).text( to );
		} );
	} );

	wp.customize( 'welcome_content', function( value ) {
		value.bind( function( to ) {
			$( '.welcome .section-title p' ).text( to );
		} );
	} );

	// service
	wp.customize( 'service_title', function( value ) {
		value.bind( function( to ) {
			$( '.services .section-title h2' ).text( to );
		} );
	} );

	wp.customize( 'service_content', function( value ) {
		value.bind( function( to ) {
			$( '.services .section-title p' ).text( to );
		} );
	} );

	// product
	wp.customize( 'product_title', function( value ) {
		value.bind( function( to ) {
			$( '.portfolio .section-title h2' ).text( to );
		} );
	} );

	wp.customize( 'product_content', function( value ) {
		value.bind( function( to ) {
			$( '.portfolio .section-title p' ).text( to );
		} );
	} );

	// team
	wp.customize( 'team_title', function( value ) {
		value.bind( function( to ) {
			$( '.our-team .section-title h2' ).text( to );
		} );
	} );

	wp.customize( 'team_content', function( value ) {
		value.bind( function( to ) {
			$( '.our-team .section-title p' ).text( to );
		} );
	} );

	// testimonials
	wp.customize( 'testimonial_title', function( value ) {
		value.bind( function( to ) {
			$( '.testimonials .section-title h2' ).text( to );
		} );
	} );

	wp.customize( 'testimonial_content', function( value ) {
		value.bind( function( to ) {
			$( '.testimonials .section-title p' ).text( to );
		} );
	} );

	// blog
	wp.customize( 'blog_title', function( value ) {
		value.bind( function( to ) {
			$( '.news-blog .section-title h2' ).text( to );
		} );
	} );

	wp.customize( 'blog_content', function( value ) {
		value.bind( function( to ) {
			$( '.news-blog .section-title p' ).text( to );
		} );
	} );
	

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.logo-menu .navbar-nav > li > a, .site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Site logo .
	wp.customize( 'metluxplus_header_logo_image', function( value ) {
		value.bind( function( to ) {
			$( '.logo a img' ).text( to );
		} );
	} );
	


} )( jQuery );
