<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package education-one
 */

get_header(); ?>

<div class="page-header">
	<div class="container">
		<div class="row">
<?php $education_one_post_breadcrumbs_show = get_theme_mod('education_one_post_breadcrumbs_show',1); if ($education_one_post_breadcrumbs_show == 1) :?>
			<div class="col-md-12">
				<?php education_one_breadcrumb_trail(); ?>
			</div>
<?php endif?>
			<div class="col-md-12">
				<div class="page-title">
					<h1>
						<?php the_title(); ?>
					</h1>
				</div>
			</div>
		</div>
	</div>
</div>

		<!--Category List-->
<section class="section category-page">
	<div class="container">
		<div class="row">
			<!--Main Content Bar-->
			<div class="contentbar-section">
			 <?php $sidebar =  esc_attr(get_theme_mod('post_sidebar_position','right' )); ?>
			 <?php if ( have_posts() ) : ?> 
			 <?php				
				if($sidebar=='none'){
				$class = 'col-md-12';
				}else{
				$class = 'col-md-9';
				}
			 ?>          
				<?php
				if ($sidebar == 'left'){ 
				get_sidebar();
				}
				?>  
				<div class="<?php echo esc_html($class); ?>">
					<!--Article List-->
					 <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                    	  get_template_part( 'template-parts/content', 'single' );
                    ?>
                <?php endwhile; ?>   
                 
               
				</div>
				<?php endif; ?> 
			</div>

			<!--Side Bar Section (can be place both left of right)-->	
		<?php
				if ($sidebar == 'right'){ 
				get_sidebar();
				}
		?>  
		</div>
	</div>	
</section>


<?php

get_footer();
