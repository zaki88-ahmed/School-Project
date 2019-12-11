<!--================================
=            Newsletter            =
=================================-->
<?php
 

?>
<?php if ( is_active_sidebar( 'newsletter' ) ) : ?>
<section class="home-newsletter">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php echo dynamic_sidebar('newsletter'); ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<!--====  End of Newsletter  ====-->