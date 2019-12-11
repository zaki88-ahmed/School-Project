<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package education-one
 */

get_header(); ?>


	<div class="error-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <h1>
                   <?php esc_html_e(' Oops!','education-one'); ?>
                </h1>
                <h2>
                   <?php esc_html_e(' We can\'t seem to find the page you\'re looking for','education-one'); ?>
                </h2>
                <p>
                   <?php esc_html_e(' ERROR: 404','education-one'); ?>
                </p>
                <?php get_search_form(); ?>
                <a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Go Back','education-one'); ?></a>
            </div>
          
        </div>
    </div>
</div>

<?php
get_footer();
