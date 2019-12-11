<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package engager
 */

?>
<div class="blog-single">
  <h2 class="post-title"><?php the_title();?></h2>
  <ul class="list-inline post-info">
        <li><a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('d'))); ?>" title=""><?php the_time( get_option( 'date_format' ) ); ?> </a></li>
        <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>" title=""><?php echo esc_attr(get_the_author_meta('display_name'));?></a></li>
        <?php
              if(has_category()):
                 the_category( ', ' ); endif;?>
        <?php if(has_tag()):
                 the_tags(__('Tags','engager'), ',' ,''); endif; ?>
  </ul>

  <?php if(has_post_thumbnail()):
    $args = array('class' => 'img-responsive center-block',);
        the_post_thumbnail('engager-post-image',$args); 
     endif;?>

  <div class="blog-content">
    <p><?php  the_excerpt();?></p>
  </div>
  <a href="<?php the_permalink();?>" title="" class="btn btn-blue"><?php esc_html_e('Read More','engager');?></a>  
</div>
