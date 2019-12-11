<?php get_header(); ?>
			
<!--=================================
=            Page Header            =
==================================-->
<?php if (is_front_page() && is_home()) { 
			 get_template_part( 'sections/slider');
} else { ?>
<section class="page-header overlay" >
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-title">
					<h1><?php if(is_front_page()): if(get_theme_mod('theme_welcome_text')): echo esc_attr(get_theme_mod('theme_welcome_text'));else: esc_html_e('Welcome to ','metlux'); echo bloginfo('name'); endif; endif; ?></h1>
					<div class="divider"></div>
				</div>
				
			</div>
		</div>
	</div>
</section>
<?php } ?>

<section class="inner-page">
<h4 class="hidden"><?php esc_attr_e('inner page','metlux')?></h4>
	<div class="container">
		<div class="row">

		<?php 
			$sidebar = esc_attr(get_theme_mod('metlux_default_layout','1'));

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
			<div class="<?php echo $class; ?> col-sm-12">
				<div class="single-page">
					<?php if ( have_posts() ) : ?>
					<div class="content">
					<?php if ( is_home() && ! is_front_page() ) : ?>
								<header>
									<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
								</header>
							<?php endif; ?>

						
							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>

								<?php

									/*
									 * Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content', get_post_format() );
								?>

							<?php endwhile; ?>
						</div>

						<div>
							<?php the_posts_pagination( array(
                                'mid_size' => 2,
                                'prev_text' => __( '<span aria-hidden="true">&laquo;</span>', 'metlux' ),
                                'next_text' => __( '<span aria-hidden="true">&raquo;</span>', 'metlux' ),
                            ) ); ?>
						</div>

						<?php else : ?>

						<?php get_template_part( 'template-parts/content', 'none' ); ?>

					<?php endif; ?>
				</div>
			</div>
			<?php
				if ($sidebar == 1 || $sidebar == 3){ 
					get_sidebar('right');
				}
				

				?>
		</div>
	</section>
<?php get_footer(); ?>