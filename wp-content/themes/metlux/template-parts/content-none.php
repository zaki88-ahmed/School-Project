<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package metlux
 */

?>

			<div class="not-found">
				<div class="section-title">
					<h1><?php esc_html_e('Nothing Found!','metlux'); ?></h1>
					<div class="divider"></div>
				</div>
				<h2></h2>
					<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with <br>some different keywords.','metlux'); ?></p>
					<?php get_search_form(); ?>
				</div>