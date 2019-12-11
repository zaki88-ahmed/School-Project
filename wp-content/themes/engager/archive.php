<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package engager
 */

get_header(); ?>

<section class="inner-page blog-page">
	<div class="container">

					
			<div class="row">
				<div class="col-sm-12">
					<div class="page-title">
						<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
						?>
					</div>
				</div>
			</div>
		<div class="row">
			<?php $sidebar =  esc_attr(get_theme_mod('select_post_sidebar','right'));
				if($sidebar=='left'|| $sidebar=='right'){
					$class ='col-md-8';
				}
				else {
					$class='col-md-12';
				}
			?>

			<?php
	            if ($sidebar == 'left'){ 
	            	get_sidebar('left');
	            }
            ?>

			<div class="<?php echo esc_attr($class);?>">
				<?php while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content',  get_post_format() );

				endwhile; // End of the loop.
				?>
				<div class="engager-pagination">
	                <?php the_posts_pagination( array(
	                    'mid_size' => 2,
	                    'prev_text' => __( '<<', 'engager' ),
	                    'next_text' => __( '>>	', 'engager' ),
	                ) ); ?>
            	</div>
			</div>
			
			
			<?php
	            if ($sidebar == 'right'){ 
	            	get_sidebar('right');
	            }
       		?>
		</div>
	</div>
</section>

<?php
get_footer(); ?>
