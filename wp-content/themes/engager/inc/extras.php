<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package engager
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function engager_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'engager_body_classes' );

if ( ! class_exists( 'Walker_Page' ) )
  return NULL;

/**
 * Class Engager_Walker_Page
 */
class Engager_Walker_Page extends Walker_Page {

  /**
   * @see Walker::start_lvl()
   * @since 1.0.0
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param int    $depth  Depth of page. Used for padding.
   * @param array  $args
   */
  public function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class='dropdown-menu'>\n";
  }

  /**
   * @see Walker::end_lvl()
   * @since 1.0.0
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param int    $depth  Depth of page. Used for padding.
   * @param array  $args
   */
  public function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }

  /**
   * @see Walker::start_el()
   * @since 1.0.0
   *
   * @param string $output       Passed by reference. Used to append additional content.
   * @param object $page         Page data object.
   * @param int    $depth        Depth of page. Used for padding.
   * @param int    $current_page Page ID.
   * @param array  $args
   */
  function start_el(&$output, $page, $depth = 0, $args = array(), $current_page = 0) {
    if ( $depth ) {
      $indent = str_repeat( "\t", $depth );
    } else {
      $indent = '';
    }

    $css_class = array( 'page_item', 'page-item-' . $page->ID );

    if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
      $css_class[] = 'page_item_has_children';
    }

    if ( ! empty( $current_page ) ) {
      $_current_page = get_post( $current_page );
      if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {
        $css_class[] = 'current_page_ancestor';
      }
      if ( $page->ID == $current_page ) {
        $css_class[] = 'active';
      } elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
        $css_class[] = 'current_page_parent';
      }
    } elseif ( $page->ID == get_option('page_for_posts') ) {
      $css_class[] = 'current_page_parent';
    }

    $css_classes = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

    /** This filter is documented in wp-includes/post-template.php */
    if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
      $output .= $indent . sprintf(
              '<li class="%s"><a href="%s">%s%s%s <span class="caret"></span></a>',
              $css_classes,
              get_permalink( $page->ID ),
              $args['link_before'],
              apply_filters( 'the_title', $page->post_title, $page->ID ),
              $args['link_after']
          );
    } else {
      $output .= $indent . sprintf(
              '<li class="%s"><a href="%s">%s%s%s</a>',
              $css_classes,
              get_permalink( $page->ID ),
              $args['link_before'],
              apply_filters( 'the_title', $page->post_title, $page->ID ),
              $args['link_after']
          );
    }

  }
  /**
   * @see Walker::end_el()
   * @since 1.0.0
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param object $page Page data object. Not used.
   * @param int    $depth Depth of page. Not Used.
   * @param array  $args
   */
  public function end_el( &$output, $page, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }

}

// ====================== Engager TAG CLOUDS ARGUMENTS ========================== //
add_filter( 'widget_tag_cloud_args', 'engager_tag_cloud_args' );
function engager_tag_cloud_args( $args ) {
  $args['number'] = 14; // Your extra arguments go heres
  $args['largest'] = 14;
  $args['smallest'] = 14;
  $args['unit'] = 'px';
  return $args;
}

// ========================= Engager CUSTOM COMMENTS ========================== //
if ( ! function_exists( 'engager_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own engager_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since 1.0.0
 */
function engager_comment( $comment, $args, $depth ) {
  $comment = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
    // Display trackbacks differently than normal comments.
  ?>
  <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
    <p><?php esc_html_e( 'Pingback:', 'engager' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'engager' ), '<span class="edit-link">', '</span>' ); ?></p>
  <?php
      break;
    default :
    // Proceed with normal comments.
    global $post;
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
      <header class="comment-meta comment-author vcard">
        <?php
          echo get_avatar( $comment, 44 );
          printf( ' <b class="fn">%1$s</b> %2$s',
            get_comment_author_link(),
            // If current post author is also comment author, make it known visually.
            esc_html(( $comment->user_id === $post->post_author ) ? '<span>' . '' . '</span>' : '')
          );
                    
          printf( '<time datetime="%2$s">%3$s</time>',
            esc_url( get_comment_link( $comment->comment_ID ) ),
            get_comment_time( 'c' ),
            /* translators: 1: date, 2: time */
            sprintf( esc_html(__( '%1$s at %2$s', 'engager' )), get_comment_date(), get_comment_time() )
          );
        ?>
      </header><!-- .comment-meta -->

      <?php if ( '0' == $comment->comment_approved ) : ?>
        <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'engager' ); ?></p>
      <?php endif; ?>

      <section class="comment-content comment">
        <?php comment_text(); ?>
        <?php edit_comment_link( __( 'Edit', 'engager' ), '<p class="edit-link">', '</p>' ); ?>
      </section><!-- .comment-content -->

      <a href="" class="reply" title="">
                  <?php 
                    comment_reply_link( array_merge( $args, array( 
                    'reply_text' => __('Reply','engager'),
                    'after' => ' <span></span>', 
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'] 
                    ) ) ); 
                ?>
            </a><!-- .reply -->
    </article><!-- #comment-## -->
  <?php
    break;
  endswitch; // end comment_type check
}
endif;

add_filter( 'comment_form_default_fields', 'engager_comment_form_fields' );
function engager_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="col-sm-12 form-group comment-form-author">' . 
                    '<input class="form-control" id="author" name="author" type="text" placeholder="'.esc_attr__('* Full Name','engager').'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="col-sm-6 form-group comment-form-email">'.
                    '<input class="form-control" id="email" placeholder="'.esc_attr__('* Email Address','engager').'" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
        'url'    => '<div class=" col-sm-6 form-group comment-form-url">' .
                    '<input class="form-control" id="url" placeholder="'.esc_attr__('Website','engager').'" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>'        
    );
    
    return $fields;

}


add_filter( 'comment_form_defaults', 'engager_comment_form' );
function engager_comment_form( $args ) {
    $args['comment_field'] = '<div class="col-sm-12 form-group comment-form-comment">'.'<textarea class="form-control" id="comment" placeholder="'.esc_attr__('Write your comment..','engager').'" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </div>';
    $args['class_submit'] = 'btn btn-theme'; // since WP 4.1
    
    return $args;
}
