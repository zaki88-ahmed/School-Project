<?php 


get_header(); ?>

<!--=================================
=            Page Header            =
==================================-->

<section class="page-header overlay" >

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-title">
					<h1><?php esc_html_e('404 NOT FOUND','metlux') ?></h1>
					<div class="divider"></div>
				</div>
				
			</div>
		</div>
	</div>
</section>

<!--====  End of Page Header  ====-->

<!--================================
=            Inner Page            =
=================================-->

<section class="inner-page">
<h4 class="hidden"><?php the_title(); ?></h4>

	<div class="container">
		<div class="row">
		<?php 
			$sidebar = get_theme_mod('metlux_default_layout','1');

			if($sidebar == 1 || $sidebar == 2){
				$class = 'col-md-9';
			}elseif($sidebar == 3){
				$class  = 'col-md-6';
			}else{
				$class = 'col-md-12';
			}

			
		if ($sidebar == 2 || $sidebar == 3){ 
			get_sidebar('left');
		}
				

		?>
			
			<div class="<?php echo $class; ?> col-sm-8">
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="single-page">

					<div class="error-page">
					<h3><?php esc_html_e('Oops!','metlux'); ?></h3>
					<h4><?php esc_html_e('We can not seem to find the page you are looking for.','metlux'); ?></h4>
					<h5><?php esc_html_e('Error code: 404','metlux'); ?></h5>
					
					<ul class="list-inline">
						<li><a href="<?php  echo esc_url(home_url()); ?>" title="<?php esc_attr_e('Home','metlux');?>" alt="<?php esc_attr_e('Home','metlux'); ?>"><?php esc_attr_e('Home','metlux'); ?></a></li>
						
					</ul>
					<h2><strong><?php esc_attr_e('404','metlux'); ?></strong></h2>
				</div>
				</div>
				</div>
			</div>

		<?php
		if ($sidebar == 1 || $sidebar == 3){ 
			get_sidebar('right');
		}
		

		?>
			
		</div>
	</div>
</section>

<!--====  End of Inner Page  ====-->



<?php

get_footer();

?>