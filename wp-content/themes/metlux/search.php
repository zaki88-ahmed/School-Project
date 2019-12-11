<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package metlux
 */

get_header(); ?>

<!--=================================
=            Page Header            =
==================================-->

<section class="page-header overlay" >
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-title">
					<h1><?php printf( __( 'Search Results for: %s', 'metlux' ), get_search_query() ); ?></h1>
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
			
			<div class="<?php echo $class; ?> col-sm-8">
				<div class="single-page">

				<?php if ( have_posts() ) : ?>

					<div class="<?php echo $col_class;?>">
						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php
							
							get_template_part( 'template-parts/content', 'search' );
							?>

						<?php endwhile; ?>
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
	</div>
</section>

<!--====  End of Inner Page  ====-->



<?php

get_footer();

?>