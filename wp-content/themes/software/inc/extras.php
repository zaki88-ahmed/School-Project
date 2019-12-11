<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package software
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function software_body_classes( $classes ) {
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
add_filter( 'body_class', 'software_body_classes' );

if ( ! class_exists( 'WP_Customize_Control' ) )
  return NULL;

/**
 * Class software_theme_Customize_Dropdown_Taxonomies_Control
 */
class software_theme_Customize_Dropdown_Taxonomies_Control extends WP_Customize_Control {

  public $type = 'dropdown-taxonomies';

  public $taxonomy = '';


  public function __construct( $manager, $id, $args = array() ) {

    $software_theme_taxonomy = 'category';
    if ( isset( $args['taxonomy'] ) ) {
      $taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
      if ( true === $taxonomy_exist ) {
        $our_taxonomy = esc_attr( $args['taxonomy'] );
      }
    }
    $args['taxonomy'] = $software_theme_taxonomy;
    $this->taxonomy = esc_attr( $software_theme_taxonomy );

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
              printf('<option value="%s" %s>%s</option>', '', selected($this->value(), '', false),esc_html(__('Select', 'software')) );
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

if( class_exists( 'WP_Customize_Control' ) ):
  class Software_Customize_Latest_page_Control extends WP_Customize_Control {
    public $type = 'latest_post_dropdown';
 
    public function render_content() {

    $latest = new WP_Query( array(
      'post_type'   => 'page',
      'post_status' => 'publish', 
      'posts_per_page'=>-1, 
    ));

    ?>
      <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <select <?php $this->link(); ?>>
         <?php
              printf('<option value="%s" %s>%s</option>', '', selected($this->value(), '', false),esc_html(__('Select', 'software') ));
             ?>
          <?php 
          while( $latest->have_posts() ) {
            $latest->the_post();            
            echo "<option " . selected( $this->value(), get_the_ID() ) . " value='" . get_the_ID() . "'>" . the_title( '', '', false ) . "</option>";
          }
          ?>
        </select>
      </label>
    <?php
    }
  }
endif;

