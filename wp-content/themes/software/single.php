<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
        
    
        
    </div>
</section>

	<section class="inner-page">
    <div class="container">
        <div class="row">
         <?php
                $class = 'col-md-12';
                $sidebar =  get_theme_mod('single_post_sidebar_position','right' );
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
          
         <?php 
            if(have_posts()):
                while(have_posts()): the_post();
                     get_template_part( 'template-parts/content',  'single' );
                endwhile;
            else:
                      get_template_part( 'template-parts/content',  'none' );
            endif;

          ?>
      
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
