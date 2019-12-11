<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package education-one
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

		<div class="sidebar-section">	
				<div class="col-md-3">
					<div class="sidebar">
						<?php dynamic_sidebar('sidebar-1'); ?>
					
					</div>
				</div>
			</div>