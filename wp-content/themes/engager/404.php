<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
			F<div class="row">
				<?php $sidebar =  esc_attr(get_theme_mod('select_page_not_found_sidebar','right'));
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
					<div class="not-found">
						<h1><?php esc_html_e( '404 Page not Found', 'engager' ); ?></h1>
						<h3><?php esc_html_e( 'OOPS, This page could not be found!', 'engager' ); ?></h3>
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'engager' ); ?></p>

					</div><!-- .page-content -->
				</div>

				<?php
				if ($sidebar == 'right' || $sidebar == 'both'){
					get_sidebar('right');
				}
				?>

			</div><!-- row -->
		</div><!-- container -->
	</section><!-- section -->
<?php
get_footer(); ?>
