<?php
/*
 * Plugin Name: Same but Different
 * Version: 1.0.05
 * Plugin URI: https://www.outtheboxthemes.com/wordpress-plugins/same-but-different/
 * Description: Display related posts based on common categories and tags.
 * Author: Out the Box
 * Author URI: https://www.outtheboxthemes.com/
 * Requires at least: 4.0
 * Tested up to: 5.3
 *
 * Text Domain: same-but-different
 * Domain Path: /languages/
 *
 * @package WordPress
 * @author Out the Box
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'OTB_SAME_BUT_DIFFERENT_DEBUG', false );

require_once( 'library/classes/otb-same-but-different.php' );
require_once( 'library/classes/otb-same-but-different-widget.php' );
require_once( 'library/classes/otb-same-but-different-settings.php' );
require_once( 'library/classes/otb-same-but-different-admin-api.php' );

/**
 * Returns the main instance of OTB_Same_But_Different to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object OTB_Same_But_Different
 */
function OTB_Same_But_Different() {
	$instance = OTB_Same_But_Different::instance( __FILE__, '1.0.05' );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = OTB_Same_But_Different_Settings::instance( $instance );
	}

	return $instance;
}

$otb_same_but_different = OTB_Same_But_Different();
