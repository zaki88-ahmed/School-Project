<?php
/**
 * Template Name: Frontpage
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package engager
 */
get_header();
     get_template_part( 'section/slider');
     get_template_part( 'section/welcome');
     get_template_part( 'section/feature');
     get_template_part( 'section/general_information');
     get_template_part( 'section/testimonial');
     get_template_part( 'section/latest_blog');	
get_footer();?>