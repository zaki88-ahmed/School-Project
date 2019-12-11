<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package software
 */

get_header(); ?>

<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="theme-bc">
                    <?php software_theme_breadcrumbs(); ?>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
				<div class="page-title">
					<?php the_archive_title( '<h1>', '</h1>' ); ?>
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
    <div class="container">
        <div class="row">
        
            <?php
                $class = 'col-md-12';
                $sidebar =  get_theme_mod('category_sidebar_position','right' );
                if($sidebar != 'none'){
                    $class = 'col-md-9';
                }
            ?>          
            <?php
                if ($sidebar == 'left'){ 
                    get_sidebar();
                   }
            ?>          
        <div class="<?php echo esc_attr($class); ?> col-sm-8">
          <div class="block">
          <?php 
            if(have_posts()):
                while(have_posts()): the_post();
                     get_template_part( 'template-parts/content',  get_post_format() );
                endwhile;
                ?>
                 <nav class="my-pagination">
               <?php 
                     the_posts_pagination( array(
                            'mid_size' => 2,
                            'prev_text' => __( '<span aria-hidden="true">&laquo;</span>', 'software' ),
                            'next_text' => __( '<span aria-hidden="true">&raquo;</span>', 'software' ),
                        ) );

                  ?>      
            </nav>
                <?php 
            else:
                      get_template_part( 'template-parts/content',  'none' );
            endif;

          ?>
          </div>
        </div>
         <?php if ($sidebar == 'right'){          
                get_sidebar();            

                }
            ?>

           
        </div>
    </div>
</section>



<?php

get_footer();
