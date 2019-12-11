<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package software
 */

get_header(); ?>

<div class="error-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <h1>
                   <?php esc_html_e(' Oops!','software'); ?>
                </h1>
                <h2>
                   <?php esc_html_e(' We can\'t seem to find the page you\'re looking for','software'); ?>
                </h2>
                <p>
                   <?php esc_html_e(' ERROR: 404','software'); ?>
                </p>
                <?php get_search_form(); ?>
                <a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Go Back','software'); ?></a>
            </div>
          
        </div>
    </div>
</div>




<?php

get_footer();
