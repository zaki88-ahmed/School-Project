<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package software
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
	<div class="col-md-3 col-sm-4">
                <aside class="sidebar">
                <!-- Search -->
                  <?php dynamic_sidebar( 'sidebar-1' ); ?>
                </aside>
            </div>
