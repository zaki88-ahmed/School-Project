<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package software
 */

?>

		<div class="single-page">
         
                  <?php if(!is_front_page() && has_post_thumbnail()){
                    echo '<div class="image">';
                    $arg =
                    array(
                    'class' => 'img-responsive',
                    'alt' => '',
                    'data-wow-duration'=> '2s'
                    );
                    the_post_thumbnail('full',$arg);
                    echo '</div>';
                    } 
                  ?>   
             

          <div class="content"> 
           <?php the_content(); ?>
           <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'software' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
          </div>
          

        </div>