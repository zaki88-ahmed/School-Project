<?php
/**
 * This file holds the generators for the presentation page elements 
 * Called mostly in frontpage.php
 */
 
/**
 * Handles the generation of the built-in slider
 */
if (!function_exists('nirvana_ppslider')):
function nirvana_ppslider() {
	$nirvanas = nirvana_get_theme_options();
	extract($nirvanas);
    $custom_query = new WP_query();
    $slides = array();

	if ( $nirvana_slideNumber>0 ):

	// Switch for Query type
	switch ($nirvana_slideType) {
	  case 'Latest Posts' :
	       $custom_query->query('showposts='.$nirvana_slideNumber.'&ignore_sticky_posts=' . apply_filters('nirvana_pp_nosticky', 1) );
	  break;
	  case 'Random Posts' :
	       $custom_query->query('showposts='.$nirvana_slideNumber.'&orderby=rand&ignore_sticky_posts=' . apply_filters('nirvana_pp_nosticky', 1) );
	  break;
	  case 'Latest Posts from Category' :
	       $custom_query->query('showposts='.$nirvana_slideNumber.'&category_name='.$nirvana_slideCateg.'&ignore_sticky_posts=' . apply_filters('nirvana_pp_nosticky', 1) );
	  break;
	  case 'Random Posts from Category' :
	       $custom_query->query('showposts='.$nirvana_slideNumber.'&category_name='.$nirvana_slideCateg.'&orderby=rand&ignore_sticky_posts=' . apply_filters('nirvana_pp_nosticky', 1) );
	  break;
	  case 'Sticky Posts' :
	       $custom_query->query(array('post__in'  => get_option( 'sticky_posts' ), 'showposts' =>$nirvana_slideNumber,'ignore_sticky_posts' => apply_filters('nirvana_pp_nosticky', 1) ));
	  break;
	  case 'Specific Posts' :
	       // Transform string separated by commas into array
	       $pieces_array = explode(",", $nirvana_slideSpecific);
	       $custom_query->query( array( 'post_type' => 'any', 'showposts' => -1, 'post__in' => $pieces_array, 'ignore_sticky_posts' => apply_filters('nirvana_pp_nosticky', 1), 'orderby' => 'post__in' ) );
	       break;
	  case 'Custom Slides':
			// custom slides are handled later
	       break;
	  case 'Disabled':
		   break;
	}//switch

	endif; // slidenumber>0

	if ($nirvanas['nirvana_excerpttype']=='Characters') {
		remove_filter( 'get_the_excerpt', 'nirvana_excerpt_trim_chars' );
	} else {
		remove_filter( 'excerpt_length', 'nirvana_excerpt_trim_words' );
		remove_filter( 'get_the_excerpt', 'nirvana_excerpt_morelink', 20 );
	}
	add_filter( 'excerpt_length', 'nirvana_excerpt_length_slider', 999 );
	add_filter( 'excerpt_more', 'nirvana_excerpt_more_slider', 999 );

     // switch for reading/creating the slides
     switch ($nirvana_slideType) {
		  case 'Disabled':
			   break;
          case 'Custom Slides':
               for ($i=1;$i<=5;$i++):
                    if ( ${"nirvana_sliderimg$i"} ):
                         $slide['image'] = esc_url(${"nirvana_sliderimg$i"});
                         $slide['link'] = esc_url(${"nirvana_sliderlink$i"});
                         $slide['title'] = ${"nirvana_slidertitle$i"};
                         $slide['text'] = ${"nirvana_slidertext$i"};
                         $slides[] = $slide;
                    endif;
               endfor;
               break;
          default:
			   if ( $nirvana_slideNumber>0 ):
				   if ( $custom_query->have_posts() ) while ($custom_query->have_posts()) :
						$custom_query->the_post();
						$img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'slider');
						$slide['image'] = esc_url( $img[0] );
						$slide['link'] = esc_url( get_permalink() );
						$slide['title'] = get_the_title();
						$slide['text'] = get_the_excerpt();
						$slides[] = $slide;
				   endwhile;
			   endif; // slidenumber>0
               break;
     }; // switch

	// call slides output
	nirvana_ppslider_output($slides); // defined in frontpage.php
	
	// clean up excerpt filters
	remove_filter( 'excerpt_length', 'nirvana_excerpt_length_slider', 999 );
	remove_filter( 'excerpt_more', 'nirvana_excerpt_more_slider', 999 );

} // nirvana_ppslider()
endif;

/**
 * Handles the generation of the built-in columns
 */
if (!function_exists('nirvana_ppcolumns')):
function nirvana_ppcolumns() {
	$nirvanas = nirvana_get_theme_options();
	extract($nirvanas);
    $custom_query2 = new WP_query();
	$columns = array();

	if ($nirvana_columnNumber>0):
		// Switch for Query type
		switch ($nirvana_columnType) {
			case 'Latest Posts' :
			$custom_query2->query('showposts='.$nirvana_columnNumber.'&ignore_sticky_posts=1');
			break;
		case 'Random Posts' :
			$custom_query2->query('showposts='.$nirvana_columnNumber.'&orderby=rand&ignore_sticky_posts=1');
			break;
		case 'Latest Posts from Category' :
			$custom_query2->query('showposts='.$nirvana_columnNumber.'&category_name='.$nirvana_columnCateg.'&ignore_sticky_posts=1');
			break;
		case 'Random Posts from Category' :
			$custom_query2->query('showposts='.$nirvana_columnNumber.'&category_name='.$nirvana_columnCateg.'&orderby=rand&ignore_sticky_posts=1');
			break;
		case 'Sticky Posts' :
			$custom_query2->query(array('post__in'  => get_option( 'sticky_posts' ), 'showposts' =>$nirvana_columnNumber,'ignore_sticky_posts' => 1));
			break;
		case 'Specific Posts' :
			// Transform string separated by commas into array
			$pieces_array = explode(",", $nirvana_columnSpecific);
			$custom_query2->query(array( 'post_type' => 'any', 'post__in' => $pieces_array, 'ignore_sticky_posts' => 1,'orderby' => 'post__in', 'showposts' => -1 ));
			break;
		case 'Widget Columns':
			break;
		case 'Disabled':
			break;
		}//switch

	endif; // columnNumber>0

	// switch for reading/creating the columns
	switch ($nirvana_columnType) {
		case 'Disabled':
			break;
		case 'Widget Columns':
			if (is_active_sidebar('presentation-page-columns-area')) {
				// if widgets loaded
				nirvana_widgetcolumns_output( $nirvana_columnstitle ); // defined in frontpage.php
			} else {
				// if no widgets loaded use the defaults
				global $nirvana_column_defaults;
				nirvana_columns_output( $nirvana_column_defaults, $nirvana_nrcolumns );  // defined in rontpage.php
			}
			break;
		default:
			if($nirvana_columnNumber>0):
				if ( $custom_query2->have_posts() )
					while ($custom_query2->have_posts()) :
						$custom_query2->the_post();
						$img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ),'columns');
						$column['image'] = esc_url( $img[0] );
						$column['link'] = esc_url( get_permalink() );
						$column['text'] = get_the_excerpt();
						$column['title'] = get_the_title();
						$columns[] = $column;
					endwhile;
				nirvana_columns_output($columns,$nirvana_nrcolumns);
			endif; // columnNumber>0
		break;
	}; // switch
	
} // nirvana_ppcolumns()
endif;

function nirvana_excerpt_length_slider( $length ) {
	$nirvanas = nirvana_get_theme_options();
	return absint( $nirvanas['nirvana_fpsliderexcerptsize'] );
}

function nirvana_excerpt_more_slider( $more ) {
	return apply_filters( 'nirvana_slider_more', '...' );
}

// FIN