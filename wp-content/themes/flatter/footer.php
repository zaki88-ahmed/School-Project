<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flatter
 */

?>
	<?php if ( is_active_sidebar( 'Newsletter Block' ) ) : ?>
    <section class="newsletter">
        <div class="container">
            <div class="row">
                <div class="block wow fadeInUp">
                    <h3><?php echo esc_attr(get_theme_mod( 'newsletter_title', 'Subscribe for newsletter' )); ?></h3>
                    <div class="input-group">
                        <?php dynamic_sidebar( 'Newsletter Block' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!--
  ______          _
 |  ____|        | |
 | |__ ___   ___ | |_ ___ _ __
 |  __/ _ \ / _ \| __/ _ \ '__|
 | | | (_) | (_) | ||  __/ |
 |_|  \___/ \___/ \__\___|_|

-->

<footer>
    <div class="container">
        <div class="row">
		 <div class="col-sm-12">
            <?php dynamic_sidebar( 'Footer Block' ); ?>
			</div>
        </div>
    </div>

    <!-- Copyright -->

    <section class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h6>
                        <?php echo esc_attr(get_theme_mod( 'copyright_textbox', __( '&copy; 2018. Your Company. All Rights Reserved.', 'flatter' ) ) ); ?>
                        
                    </h6>
                </div>

                    <div class="col-sm-6">
                        <h6>
                        <?php  
						
						$footer_center_copyright = __( '<a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://spicethemes.com" rel="designer">Flatter</a> by SpiceThemes', 'flatter' );
						
						echo wp_kses_post($footer_center_copyright);

						?>
                        </h6>
                    </div>
                <div class="col-sm-3">
                   
                        <ul class="list-inline social-media">
                            <?php
                            $facebook =  esc_url(get_theme_mod('facebook_textbox','#'));
                            $twitter = esc_url(get_theme_mod('twitter_textbox','#'));
                            $googleplus = esc_url(get_theme_mod('googleplus_textbox','#'));
                            $youtube = esc_url(get_theme_mod('youtube_textbox','#'));
                            $linkedin = esc_url(get_theme_mod('linkedin_textbox','#'));

                            if($facebook){?>
                                <li><a href="<?php echo $facebook;?>"><i class="fa fa-facebook"></i></a></li>
                            <?php }
                            if($twitter){?>
                                <li><a href="<?php echo $twitter;?>"><i class="fa fa-twitter"></i></a></li>
                            <?php }
                            if($googleplus) {?>
                                <li><a href="<?php echo $googleplus;?>"><i class="fa fa-google-plus"></i></a></li>
                            <?php }
                            if($youtube){?>
                                <li><a href="<?php echo $youtube;?>"><i class="fa fa-youtube-play"></i></a></li>
                            <?php }
                            if($linkedin){?>
                                <li><a href="<?php echo $linkedin;?>"><i class="fa fa-linkedin"></i></a></li>
                            <?php }?>
                        </ul>

              
                </div>  <!-- /.end of col-sm-3 -->
            </div>
        </div>
    </section>
</footer>
    <?php $scroll_to_top= get_theme_mod('footer_scrolltotop_status','1'); ?>
    <?php if($scroll_to_top=='0'):?>
    	<div class="scroll-top-wrapper">
    		<span class="scroll-top-inner"><i class="fa fa-angle-double-up"></i></span>
    	</div>
    <?php endif;?>
    <?php $scroll_to_bottom= get_theme_mod('footer_scrolltobottom_status','1'); ?>
    <?php if($scroll_to_bottom=='0'):?>
        <div class="scroll-down-wrapper"> 
            <span class="scroll-down-inner">
                <i class="fa fa-angle-double-down"></i>
              </span>
        </div>
    <?php endif;?>

	<?php wp_footer(); ?>

</body>
</html>