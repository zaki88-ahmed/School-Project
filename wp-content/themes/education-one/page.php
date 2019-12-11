<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package education-one
 */

get_header(); ?>

<div class="page-header">
	<div class="container">
		<div class="row">
<?php $education_one_page_breadcrumbs_show = get_theme_mod('education_one_page_breadcrumbs_show',1); if ($education_one_page_breadcrumbs_show == 1) :?>
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


<!--innerpage-->
<section class="inner-page">
	<div class="container">
		<div class="row">
			<!--Article section-->
			<div class="article-section">
			<?php $sidebar =  esc_attr(get_theme_mod('page_sidebar_position','right' )); ?>
			<?php if(have_posts()): the_post(); ?>
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
					<!--The wrapper of the article-->
				 
                    <?php
                    	  get_template_part( 'template-parts/content', 'page' );
                    ?>
                     
                <?php else : ?>
                    <?php get_template_part( 'template-parts/content', 'none' ); ?>
                  
				</div>
			<?php endif; ?>
			</div>
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
