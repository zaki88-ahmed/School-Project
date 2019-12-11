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
 * @package education-one
 */

get_header(); ?>
<?php $slider = esc_attr(get_theme_mod('slider_disable',1)); if (!is_front_page() || $slider == 0) {?>
<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php education_one_breadcrumb_trail(); ?>
			</div>
			<div class="col-md-12">
				<div class="page-title">

					<?php
					if(is_front_page()):
					echo '<h1 class="center">' ; esc_html_e('welcome','education-one');  echo '</h1>';
					else:
                    the_archive_title( '<h1>', '</h1>' );
                    endif;
                ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php }?>

<?php
if (is_front_page() )
{	
    if($slider==1){
 ?>
<section id="myCarousel" class="carousel slide">
       
       <ol class="carousel-indicators">
		<?php
				$cid = esc_attr(get_theme_mod('slider_category_display'));
				$category_link = get_category_link($cid);
				$education_one_cat = get_category($cid);
				if ($education_one_cat) {
    		?>

      		<?php
      			$posts_per_page = esc_attr(get_theme_mod('slider_no_of_posts',5));
                $args = array(
                  'posts_per_page' => $posts_per_page,
                  'paged' => 1,
                  'cat' => $cid
                );
                $loop = new WP_Query($args);
                
                $cn = -1;
                if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();$cn++;
            ?>
            <li data-target="#myCarousel" data-slide-to="<?php echo esc_html($cn); ?>" class="<?php if($cn==0){echo 'active';} ?>"></li>
            <?php endwhile;wp_reset_postdata(); endif; }?>
            
        </ol> 

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
		 <?php
			$cid = esc_attr(get_theme_mod('slider_category_display'));
			$category_link = get_category_link($cid);
			$education_one_cat = get_category($cid);
			if ($education_one_cat == '')
			{
				$cid = 1;
				$category_link = get_category_link($cid);
				$education_one_cat = get_category($cid);
			}
			if ($education_one_cat) {
		?>

  		<?php
  			$posts_per_page = esc_attr(get_theme_mod('slider_no_of_posts',5));
            $args = array(
              'posts_per_page' => $posts_per_page,
              'paged' => 1,
              'cat' => $cid
            );
            $loop = new WP_Query($args);
            
            $cn = 0;
            if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();$cn++;
			$image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'education-one-slider-thumb' );
       		 $readmore    = esc_attr(get_theme_mod('readmore_slider_disable',1));
       		 $buttontitle = esc_html(get_theme_mod('section_Button_title',__('Services','education-one')));
       		 $buttonlink  = esc_url(get_theme_mod('section_Button_link','#'));
        ?>
            <div class="item <?php echo $cn == 1 ? 'active' : ''; ?>">
                <div class="fill" style="background-image:url('<?php if ($image[0] =='') echo esc_url(get_template_directory_uri()) . '/images/slider' . ($cn % 2) . '.jpg'; else echo esc_url($image[0]); ?>');"></div>
                <div class="carousel-caption outer center-caption">
                    <div class="inner">
                    <h1><?php the_title(); ?></h1>
                    <?php the_excerpt(); ?>
                    <?php if($readmore==1): ?>
                   		 <a href="<?php the_permalink(); ?>" class="btn btn-theme" title=""><?php esc_html_e('Read More','education-one'); ?></a>
                    <?php endif;?>
                    <?php if($buttontitle): ?>
                    	 <a href="<?php echo esc_url($buttonlink); ?>" class="btn btn-dark" title=""><?php echo esc_html($buttontitle); ?></a>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
          <?php                 
			endwhile;
				wp_reset_postdata();  
			endif;                             
				}
			?> 
           
        </div>

  
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>


</section>
<?php } ;
} ?>
	<!--Category List-->
<section class="section category-page">
	<div class="container">
		<div class="row">
			<!--Main Content Bar-->
			<div class="contentbar-section">
			<?php $sidebar =  esc_attr(get_theme_mod('archive_sidebar_position','right' )); ?>
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
