<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flatter
 */

?>

<div class="blog-single">
  <ul class="list-inline post-info">
    <li><a href=" <?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('d'))); ?>" title=""><?php the_time( get_option( 'date_format' ) ); ?></a></li>
        <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>" title=""><?php echo esc_html(get_the_author_meta('display_name'));?></a></li>
        <?php
              if(has_category()):
                 the_category( ', ' ); endif;?>
        <?php if(has_tag()):
                 the_tags(__('Tags','engager'), ',', ''); endif; ?>
                
  </ul>

  <?php if(has_post_thumbnail()):
    $args = array('class' => 'img-responsive center-block',);
        the_post_thumbnail('engager-post-image',$args); 
     endif;?>

  <div class="blog-content">
    <?php the_content();?>
  </div>

  <div class="comment-form">            
        <?php
  
      // If comments are open or we have at least one comment, load up the comment template.
      if ( comments_open() || get_comments_number() ) :
        comments_template();
      endif;
    ?>
      
    </div>
</div>
