<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package software
 */

?>

		
            <div class="category-single">
            <?php 
                if (has_post_thumbnail()) :
                $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'software-category-thumb' );
              ?>
              <div class="image">
                <img src="<?php echo esc_url($image[0]); ?>" class="img-responsive" alt="">
              </div>
            <?php endif; ?>
              <div class="content">
                <h2 class="title"><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h2>
                <h6 class="info"><a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'))); ?>" title=""><i class="fa fa-clock-o"></i>  <?php echo get_the_date();?></a>  <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>"><i class="fa fa-user"></i>   <?php echo esc_attr(get_the_author_meta('display_name'));?></a>    <i class="fa fa-comments"></i> <?php comments_popup_link('zero comment','one comment', '% comments');?></h6>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="btn read-more" title=""><?php esc_html_e('read more','software'); ?></a>
                
              </div>
            </div>

           

            <!-- Pagination -->
           
       