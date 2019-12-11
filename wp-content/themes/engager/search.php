<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package engager
 */

get_header(); ?>


	
		<section class="inner-banner">
			<?php if (get_header_image() != '') {?>
				<img src="<?php echo esc_url(get_header_image()); ?>" class="img-responsive center-block" alt="">
			<?php } ?>
		</section>
		
    	<section class="inner-page blog-page">
    		<div class="container">
        		<div class="row">
					<?php $sidebar =  esc_html(get_theme_mod('select_search_page_sidebar','right'));
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

					<div class="<?php echo esc_attr($class); ?>">
						<?php
						if ( have_posts() ) : 
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								get_template_part( 'template-parts/content', 'search' );

							endwhile;

							the_posts_navigation();

						else :

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
