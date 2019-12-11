<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package metlux
 */

if ( ! is_active_sidebar( 'left_sidebar' ) ) {
	return;
}
?>


<div class="col-md-3 col-sm-4">
				<?php if ( is_active_sidebar( 'left_sidebar' ) ) : ?>
				<aside class="sidebar">
						<?php  dynamic_sidebar('left_sidebar'); ?>
				</aside>
			<?php endif; ?>
</div>