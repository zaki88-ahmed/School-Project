<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package software
 */

?>

<section class="no-results not-found">
<div class="error-box">
	<?php if(is_404()): ?>
		
		<h1><?php esc_html_e('404 Error','software');?></h1>
		<p><?php esc_html_e( 'Oops, this page could not be found!', 'software' ); ?></p>
		

	<?php else: ?>
	<h1><?php esc_html_e('Nothing Found','software');?></h1>
	<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'software' ); ?></p>
	<?php endif; ?>
</div>
	

	<div class="page-content-none">
		<?php
				get_search_form();

		 ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
