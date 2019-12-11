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
 * @package Metlux
 */
get_header();

			 get_template_part( 'sections/slider');

			 get_template_part( 'sections/welcome');

			 get_template_part( 'sections/service');

			 get_template_part( 'sections/product');

			 get_template_part( 'sections/video');

			 get_template_part( 'sections/team');

			 get_template_part( 'sections/testimonial');

			 get_template_part( 'sections/blog');

			 get_template_part( 'sections/newsletter');

			 get_template_part( 'sections/client');
 get_footer(); ?>
