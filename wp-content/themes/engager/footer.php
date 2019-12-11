<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package engager
 */

?>
<footer>
<?php if(get_theme_mod('footer_title') || is_active_sidebar('footer_sidebar')): ?>
<section class="home-contact">
	<div class="container">
		<div class="row">
			<div class="section-title">
				<h1><?php echo esc_html(get_theme_mod( 'footer_title', __('Footer Title','engager'))); ?></h1>
			</div>
		</div>

		<?php  if(is_active_sidebar('footer_sidebar')): ?>
				<div class="single">
					<address>
						<?php dynamic_sidebar('footer_sidebar');?>
					</address>
				</div> 
		<?php endif;?>
		
	</div>
</section>
<?php endif; ?>

<section class="copyright">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="info">
					<p><?php echo esc_html(get_theme_mod( 'copyright_textbox',  __('Copyright 2018 Your Company','engager') )); ?> </p>
				</div>
			</div>

			<?php if(esc_attr(get_theme_mod('social_icon_display','1'))):?>
				<div class="col-sm-4">
					<div class="social-media">
						<ul class="list-inline">
							<?php if(get_theme_mod('facebook_url')):?>							
								<li><a href="<?php echo  esc_url(get_theme_mod('facebook_url'));?>" title=""><i class="fa fa-facebook"></i></a></li>
							<?php endif;?>

							<?php if(get_theme_mod('twitter_url')):?>	
								<li><a href="<?php echo esc_url(get_theme_mod('twitter_url'));?>" title=""><i class="fa fa-twitter"></i></a></li>
							<?php endif;?>

							<?php if(get_theme_mod('googleplus_url')):?>
								<li><a href="<?php echo esc_url(get_theme_mod('googleplus_url'));?>" title=""><i class="fa fa-google-plus"></i></a></li>
							<?php endif;?>

							<?php if(get_theme_mod('linkedin_url')):?>
								<li><a href="<?php echo esc_url(get_theme_mod('linkedin_url'));?>" title=""><i class="fa fa-linkedin"></i></a></li>
							<?php endif;?>
						</ul>
					</div>	
				</div>
			<?php endif;?>
			<div class="col-sm-4">
				<div class="info fright">
				<?php echo esc_html_e('Design by', 'engager'); ?> <a href="http://oceanwebthemes.com">Ocean Web Themes</a>
				</div>
			</div>
		</div>		
	</div>
</section>
</footer>
<!-- Tab to top scrolling -->
<div class="scroll-top-wrapper"> <span class="scroll-top-inner">
  <i class="fa fa-2x fa-angle-up"></i>
    </span></div>

<?php wp_footer(); ?>

</body>
</html>
