<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package education-one
 */

get_header(); ?>
<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php education_one_breadcrumb_trail(); ?>
			</div>
			<div class="col-md-12">
				<div class="page-title">
					<?php the_archive_title( '<h1>', '</h1>' ); ?>
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
			
			<?php $sidebar = esc_attr(get_theme_mod('archive_sidebar_position','right' ));?>
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
                    	  get_template_part( 'template-parts/content', get_post_format() );
                    ?>
                <?php endwhile; ?>   
                 <?php 
                     the_posts_pagination( array(
                            'mid_size' => 2,
                            'prev_text' => __( '<span aria-hidden="true">&laquo;</span>', 'education-one' ),
                            'next_text' => __( '<span aria-hidden="true">&raquo;</span>', 'education-one' ),
                        ) );

                  ?>       
                <?php else : ?>
                    <?php get_template_part( 'template-parts/content', 'none' ); ?>
                  
					<!--Pagination Section-->
					
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
?>
