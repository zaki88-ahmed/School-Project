<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package software
 */

?>
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		    <div class="single-page">
          <?php 
                if (has_post_thumbnail()) :
                $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
              ?>
              <div class="image">
                <img src="<?php echo esc_url($image[0]); ?>" class="img-responsive" alt="">
              </div>
            <?php endif; ?>

          <div class="post-title">
           
            <h1><a href="" title=""><?php the_title(); ?></a></h1>
          </div>
          <br>
          <ul class="post-info list-inline">
            <li><a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'))); ?>" title=""><i class="fa fa-calendar"></i> <?php echo get_the_date();?></a></li>
            <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>" title=""><i class="fa fa-user"></i> <?php echo esc_html(get_the_author_meta('display_name'));?></a></li>
            <li><a href="" title=""><i class="fa fa-comments-o"></i> <?php esc_html(comments_popup_link('zero comment','one comment', '% comments'));?></a></li>
            <li><a href="" title=""><i class="fa fa-folder-open"></i> <?php wp_kses_post(get_the_category_list(', ')); ?></a></li>
          </ul>
          <div class="content">
            <?php the_content(); ?>
          </div>
          <div class="author-box">
            <div class="image">
              <?php echo get_avatar('user_email'); ?>
            </div>
            <div class="info">
            <p><?php echo esc_html( get_the_author_meta('description') );?></p>
              <h6><a href="" title=""><?php echo esc_html( get_the_author_meta('display_name') );?> |</a> <?php echo esc_html( get_the_author_meta('user_email') );?></h6>
            </div>
          </div>

           <div class="swift-pager">
            <ul class="pager">                    
                <?php
                previous_post_link( '<li class="previous">%link</li>', _x( '<i class="fa fa-angle-left"></i>', 'Previous post link', 'software' ) );
                next_post_link(     '<li class="next">%link</li>',     _x( '<i class="fa fa-angle-right"></i>', 'Next post link',     'software' ) );
                ?>
            </ul>
           	<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Posts:', 'software' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
        </div> 

   <!-- Comment Form -->
          <div class="comment-form">
              <?php
              if ( comments_open() || get_comments_number() ) :
              comments_template();
              endif;
              ?>
          </div>

        </div>
      </div>