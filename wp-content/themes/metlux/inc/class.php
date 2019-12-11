<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
  return NULL;
/**
 * Customize Control for Taxonomy Select
 */
class metlux_Customize_Dropdown_Taxonomies_Control extends WP_Customize_Control {

  public $type = 'dropdown-taxonomies';

  public $taxonomy = '';


  public function __construct( $manager, $id, $args = array() ) {

    $metlux_taxonomy = 'category';
    if ( isset( $args['taxonomy'] ) ) {
      $taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
      if ( true === $taxonomy_exist ) {
        $our_taxonomy = esc_attr( $args['taxonomy'] );
      }
    }
    $args['taxonomy'] = $metlux_taxonomy;
    $this->taxonomy = esc_attr( $metlux_taxonomy );

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
         <select <?php echo $this->link(); ?>>
            <?php
              printf('<option value="%s" %s>%s</option>', '', selected($this->value(), '', false),__('Select', 'metlux') );
             ?>
            <?php if ( ! empty( $all_taxonomies ) ): ?>
              <?php foreach ( $all_taxonomies as $key => $tax ): ?>
                <?php
                  printf('<option value="%s" %s>%s</option>', $tax->term_id, selected($this->value(), $tax->term_id, false), $tax->name );
                 ?>
              <?php endforeach ?>
           <?php endif ?>
         </select>

    </label>
    <?php
  }

}

/**
 * Enqueue scripts for customizer
 */
//customizer Pro

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.1.1
 * @access public
 */
final class metlux_Customize {
  /**
   * Returns the instance.
   *
   * @since  1.1.1
   * @access public
   * @return object
   */
  public static function get_instance() {
    static $instance = null;
    if ( is_null( $instance ) ) {
      $instance = new self;
      $instance->setup_actions();
    }
    return $instance;
  }
  /**
   * Constructor method.
   *
   * @since  1.1.1
   * @access private
   * @return void
   */
  private function __construct() {}
  /**
   * Sets up initial actions.
   *
   * @since  1.1.1
   * @access private
   * @return void
   */
  private function setup_actions() {
    // Register panels, sections, settings, controls, and partials.
    add_action( 'customize_register', array( $this, 'sections' ) );
    // Register scripts and styles for the controls.
    add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
  }
  /**
   * Sets up the customizer sections.
   *
   * @since  1.1.1
   * @access public
   * @param  object  $manager
   * @return void
   */
  public function sections( $manager ) {
    // Load custom sections.
    require_once( trailingslashit( get_template_directory() ) . 'inc/metlux-pro.php' );
    // Register custom section types.
    $manager->register_section_type( 'Metlux_Customize_Section_Pro' );
    // Register sections.
    $manager->add_section(
      new Metlux_Customize_Section_Pro(
        $manager,
        'Metlux',
        array(
          'title'    => esc_html__( 'Metlux Plus', 'metlux' ),
          'pro_text' => esc_html__( 'Buy Pro',         'metlux' ),
          'pro_url'  => 'http://oceanwebthemes.com/webthemes/metluxplus-premium-wordpress-theme/'
        )
      )
    );
  }
  /**
   * Loads theme customizer CSS.
   *
   * @since  1.1.1
   * @access public
   * @return void
   */
  public function enqueue_control_scripts() {
    wp_enqueue_script( 'metlux-customize-controls', trailingslashit( get_template_directory_uri() ) . 'js/metlux-customizer.js', array( 'customize-controls' ) );
    wp_enqueue_style( 'metlux-customize-controls', trailingslashit( get_template_directory_uri() ) . 'css/metlux-customizer.css' );
  }
}
// Doing this customizer thang!
metlux_Customize::get_instance();