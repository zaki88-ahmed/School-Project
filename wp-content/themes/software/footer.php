<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package software
 */

?>
<?php if (!is_404()) { ?>
<section class="footer-info">
    <div class="container">
        <div class="row">
        <?php if ( is_active_sidebar( 'sidebar_footer_left' ) ) : ?>
            <div class="col-sm-6">
                <?php dynamic_sidebar('sidebar_footer_left'); ?>
            </div>
          <?php endif; ?>
           <?php if ( is_active_sidebar( 'sidebar_footer_right' ) ) : ?>
            <div class="col-sm-6">
                <div class="testimonial wow slideInUp">
                    <h1 class="content-title"><?php echo esc_html(get_theme_mod('testimonial_title',__('Testimonials','software'))); ?></h1>
                    <div id="owl-demo" class="owl-carousel owl-theme">
 
                      <?php dynamic_sidebar('sidebar_footer_right'); ?>
                    </div>
                </div>
            </div>
          <?php endif; ?>
        </div>
    </div>
</section>
<?php } ?>

<footer>
    <div class="container">
        <div class="row">
        
            <div class="col-sm-6">
            <?php 
            $image = get_theme_mod('footer_logo'); 
            if($image):
            ?>
                <div class="logo">
                    <img src="<?php echo esc_url($image); ?>" class="img-responsive" alt="">
                </div>
            <?php endif; ?>
            </div>
        
            <div class="col-sm-6">
                <div class="info text-right left-xs">
                    <p class="copyright"><?php echo esc_html(get_theme_mod('copyright_text',__('&copy; 2017. Your Website All Rights Reserved','software'))) ?></p>
                    <p class="powered-by"><?php esc_html_e('Software Theme By :','software'); ?> <a href="<?php echo esc_url('https://oceanwebthemes.com'); ?>" target="_blank"><?php echo esc_html(__('OceanWeb Themes','software')); ?></a></p>
                </div>
            </div>
        </div>
    </div>
</footer>


<?php 
    $readmore = get_theme_mod('enable_scroll','enable');
    if($readmore=='enable'):
?>
<div class="scroll-top-wrapper"> <span class="scroll-top-inner">
        <i class="fa fa-angle-double-up"></i>
    </span>
</div>
<?php endif;?>


<?php wp_footer();?>

</body>
</html>