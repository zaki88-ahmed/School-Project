<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package education-one
 */

?>


<div class="nothing-found">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-7">
                <h1>
                   <?php esc_html_e('Nothing Found','education-one'); ?>
                </h1>
                
                <p>
                   <?php get_search_form(); ?>
                </p>
                <a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Go Back','education-one'); ?></a>
            </div>
            
        </div>
    </div>
</div>