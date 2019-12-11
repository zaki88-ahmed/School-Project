<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package engager
 */

get_header(); ?>

<section class="inner-page blog-page">
	<div class="container">
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
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile; ?>

			<div class="engager-pagination">
                <?php the_posts_pagination( array(
                    'mid_size' => 2,
                    'prev_text' => __( '<<', 'engager' ),
                    'next_text' => __( '>>	', 'engager' ),
                ) ); ?>
            	</div>

		 <?php else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
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
get_footer();
