<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package education-one
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function education_one_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.


	return $classes;
}
add_filter( 'body_class', 'education_one_body_classes' );

add_filter( 'comment_form_default_fields', 'education_one_comment_form_fields' );
function education_one_comment_form_fields( $fields ) {
	$commenter = wp_get_current_commenter();

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

	$fields   =  array(
		'author' => '<div class="col-sm-12 form-group comment-form-author">' . ' ' .
			'<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' required="required" placeholder="'.esc_attr__('Your Name*','education-one').'"/></div>',
		'email'  => '<div class="col-sm-12 form-group comment-form-email"> ' .
			'<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" required="required" size="30"' . $aria_req . ' placeholder="'.esc_attr__('Email*','education-one').'"/></div>',
		'url'    => '<div class=" col-sm-12 form-group comment-form-url">' .
			'<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="'.esc_attr__('Your URL','education-one').'"/></div>'
	);

	return $fields;
}

add_filter( 'comment_form_defaults', 'education_one_comment_form' );
function education_one_comment_form( $args ) {
	$args['comment_field'] = '<div class="col-sm-12 form-group comment-form-comment">
           
            <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true" required="required" placeholder="'.esc_attr__('Leave your comment here..*','education-one').'"></textarea>
        </div>';
	$args['class_submit'] = 'btn submit-btn pull-left submit-comment-btn'; // since WP 4.1

	return $args;
}


if ( ! class_exists( 'WP_Customize_Control' ) )
  return NULL;

/**
 * Class education_one_Customize_Dropdown_Taxonomies_Control
 */
class education_one_Customize_Dropdown_Taxonomies_Control extends WP_Customize_Control {

  public $type = 'dropdown-taxonomies';

  public $taxonomy = '';


  public function __construct( $manager, $id, $args = array() ) {

    $our_taxonomy = 'category';
    if ( isset( $args['taxonomy'] ) ) {
      $taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
      if ( true === $taxonomy_exist ) {
        $our_taxonomy = esc_attr( $args['taxonomy'] );
      }
    }
    $args['taxonomy'] = $our_taxonomy;
    $this->taxonomy = esc_attr( $our_taxonomy );

    parent::__construct( $manager, $id, $args );
  }

  public function render_content() {

    $tax_args = array(
      'hierarchical' => 0,
      'taxonomy'     => $this->taxonomy,
    );
    $all_taxonomies = get_categories( $tax_args );

    ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
         <select <?php echo esc_html($this->link()); ?>>
            <?php
              printf('<option value="%s" %s>%s</option>', '', selected(esc_html($this->value()), '', false),esc_html(__('Select', 'education-one')) );
             ?>
            <?php if ( ! empty( $all_taxonomies ) ): ?>
              <?php foreach ( $all_taxonomies as $key => $tax ): ?>
                <?php
                  printf('<option value="%s" %s>%s</option>', esc_html($tax->term_id), selected($this->value(), esc_html($tax->term_id), false), esc_html($tax->name) );
                 ?>
              <?php endforeach ?>
           <?php endif ?>
         </select>

    </label>
    <?php
  }

}
