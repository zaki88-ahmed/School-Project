<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package education-one
 */

?>

<footer class="section image footer-bg">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="logo text-center wow slideInDown">
				<a href="<?php echo esc_url(get_site_url()); ?>" title="<?php echo esc_html(get_theme_mod('footer_logo_text',__('Education One','education-one'))); ?>">
					<h1><?php echo esc_html(get_theme_mod('footer_logo_text',__('Education One','education-one'))); ?></h1>
				</a>
				</div>

				<div class="social-icons text-center">
					<ul class="list-inline">
					<?php
						$flink = get_theme_mod('facebook_link','');
						$tlink = get_theme_mod('twitter_link','');
						$glink = get_theme_mod('googleplus_link','');
						$ilink = get_theme_mod('instagram_link','');
						$ylink = get_theme_mod('youtube_link','');
						$llink = get_theme_mod('linkedin_link','');
						$slink = get_theme_mod('skype_link','');

					 ?>
					 	<?php if($flink): ?>
							<li><a href="<?php echo esc_url($flink); ?>" title=""><i class="fa fa-facebook"></i></a></li>
						<?php endif; ?>
						<?php if($tlink): ?>
							<li><a href="<?php echo esc_url($tlink); ?>" title=""><i class="fa fa-twitter"></i></a></li>
						<?php endif; ?>
						<?php if($ilink): ?>
							<li><a href="<?php echo esc_url($ilink); ?>" title=""><i class="fa fa-instagram"></i></a></li>
						<?php endif; ?>
						<?php if($ylink): ?>
							<li><a href="<?php echo esc_url($ylink); ?>" title=""><i class="fa fa-youtube-play"></i></a></li>
						<?php endif; ?>
						<?php if($slink): ?>
							<li><a href="<?php echo esc_url($slink); ?>" title=""><i class="fa fa-skype"></i></a></li>
						<?php endif; ?>
						<?php if($glink): ?>
							<li><a href="<?php echo esc_url($glink); ?>" title=""><i class="fa fa-google-plus"></i></a></li>
						<?php endif; ?>
						<?php if($llink): ?>
							<li><a href="<?php echo esc_url($llink); ?>" title=""><i class="fa fa-linkedin"></i></a></li>
						<?php endif; ?>
					</ul>
				</div>

				<div class="copyright text-center">
					<p><?php echo wp_kses_post(get_theme_mod('copyright_text',__('Copyright 2018. Your Theme All right Reserved.','education-one'))); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
</footer>


<?php wp_footer(); ?>


</body>
</html>
