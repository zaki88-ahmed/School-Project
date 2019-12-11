<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package metlux
 */

?>
<!--============================
=            Footer            =
=============================-->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-12 ">
				<?php 
					if ( is_active_sidebar( 'footer_left' ) ) :
						 dynamic_sidebar('footer_left') ;
					endif;
				?>
				<div class="copyright ">
				<p><?php echo esc_attr(get_theme_mod('metlux_copyright_setting',__('Copyright &copy; 2018 ','metlux'))); echo bloginfo(); ?></p>
				<p><?php echo __('Design By:','metlux'); ?><a href="http://oceanwebthemes.com" title="" target="_blank"><?php echo __('Oceanweb Themes','metlux'); ?></a></p>
					
					
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				
				<?php 
					if ( is_active_sidebar( 'footer_right' ) ) :
						 dynamic_sidebar('footer_right') ;
					endif;
				?>
				<div class="clearfix"></div>
				
			</div>
		</div>
	</div>
</footer>


<!--====  End of Footer  ====-->


    <!--================================
    =            tab to top            =
    =================================-->
    <?php 
    		$scroll = esc_attr(get_theme_mod('metlux_scrollup_setting','0'));
    		if($scroll==1){
    ?>
      
	<?php }else{?>
	   <div class="scroll-top-wrapper">
		<span class="scroll-top-inner"><i class="fa fa-angle-double-up"></i></span>
		</div>
	<?php }?>
    
    <!--====  End of tab to top  ====-->


		</div>

		<?php wp_footer(); ?>
	
	</body>
</html>
