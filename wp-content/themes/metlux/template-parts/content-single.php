    <?php
    /**
    * Template part for displaying single posts.
    *
    * @link https://codex.wordpress.org/Template_Hierarchy
    *
    * @package metlux
    */

    ?>


    <!--====  End of Page Header  ====-->


    <!--================================
    =            Inner Page            =
    =================================-->


    <div  id="post-<?php the_ID(); ?>" <?php post_class('single-page'); ?>>
     
      <?php if(has_post_thumbnail()){ ?>         
    <div class="featured-image">   
    <img src="<?php echo esc_url(get_the_post_thumbnail_url ()); ?>" class="aligncenter" alt="">     
    <div class="date">
      <strong><?php echo esc_attr( get_the_date(__('j','metlux') ));?></strong> <p><?php echo esc_attr( get_the_date(__('M','metlux')) );?><br><?php echo esc_attr( get_the_date(__(' Y','metlux')) );?></p>
    </div>
    </div>
    <?php }?>
   
    <ul class="post-info list-inline">
    <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>" title=""><i class="fa fa-user"></i> <?php echo esc_html( get_the_author_meta('display_name') );?></a></li>
   <?php if (get_comments_number()!=0): ?> <li><i class="fa fa-comments-o"></i> <?php comments_popup_link(esc_html('0 comment','metlux'),esc_html__('one comment','metlux'), esc_html__('% comments','metlux'),esc_html__('comments-link','metlux'), esc_html__('Comments are off for this post','metlux'));?></li><?php endif; ?>
   <?php if( has_category() ): ?> <li><i class="fa fa-folder-open"></i> <?php the_category(', '); ?></li><?php endif;?>
    </ul>
    <div class="content">
    <?php the_content(); ?>

    <?php
    wp_link_pages( array(
      'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'metlux' ),
      'after'  => '</div>',
      ) );
      ?>

    </div>
<?php if( has_tag() ): ?>
    <div class="tag-and-share">
      <h3 class="content-title"><?php esc_html_e('Tags:','metlux'); ?></h3>
      <div class="row">
        <div class="col-sm-8 col-xs-6">
        
          <div class="tags">
           <?php the_tags(' ',' '); ?>
         </div>
       
       </div>
      
    </div>
    </div>
  <?php endif; ?>

    <div class="author-box">
    <div class="image">
      <?php echo get_avatar(get_the_author_meta('user_email')); ?>
    </div>
    <div class="info">
      <p><?php echo esc_html( get_the_author_meta('description') );?></p>
      <?php $email= esc_html( get_the_author_meta('user_email') );?>
      <h6><a href=" mailto:<?php  echo esc_attr( $email );?>" title=""><?php echo esc_html( get_the_author_meta('display_name') );?> |</a> <?php echo esc_html( get_the_author_meta('user_email') );?></h6>
    </div>
    </div>

    <div class="metlux-pager">
      <nav>
        <ul class="pager">                    
          <?php
          previous_post_link( '<li class="previous">%link</li>', _x( '<i class="fa fa-angle-left"></i>', 'Previous post link', 'metlux' ) );
          next_post_link(     '<li class="next">%link</li>',     _x( '<i class="fa fa-angle-right"></i>', 'Next post link',     'metlux' ) );
          ?>
        </ul>
      </nav><!-- .nav-links -->
    </div>  
    <?php 
    global $post;
    $categories = get_the_category($post->ID);
    if ($categories) {
    $category_ids = array();
    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
    $args=array(
      'category__in' => $category_ids,
      'post__not_in' => array($post->ID),
      'posts_per_page'=> 3, // Number of related posts that will be shown.
      'ignore_sticky_posts'=>1  
    );
    $my_query = new WP_Query( $args );
    }?>

    <div class="related-post">
    <h3 class="content-title"><?php esc_html_e('Related Posts','metlux');?></h3>
    <div class="row">

      <?php if( $my_query->have_posts() ) :while( $my_query->have_posts() ):
      $my_query->the_post();?>
      <div class="col-md-4 col-sm-6 col-xs-12 post-grid">
        <!-- Single Post -->
        <div class="post-single">
         <?php if(has_post_thumbnail()){ ?>
          <div class="featured-image overlay">
            <h6 class="category"><a href="" title="<?php the_title(); ?>"><i class="fa fa-folder-open"></i> <?php the_category(', '); ?></a></h6>
            <a href="<?php the_permalink()?>" title="<?php the_title(); ?>">                 
                  <?php the_post_thumbnail('metlux-related');?>
                  
            </a>
            <div class="date">
              <strong><?php echo esc_attr( get_the_date(__('j','metlux')) );?></strong> <p><?php echo esc_attr( get_the_date(__('M','metlux')) );?><br><?php echo esc_attr( get_the_date(__(' Y','metlux')) );?></p>
            </div>
          </div>
           <?php } ?>
          <div class="title">
            <h2><a href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title();?></a></h2>
          </div>

          <ul class="post-info list-inline">
            <li><a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title=""><i class="fa fa-user"></i> <?php echo esc_html( get_the_author_meta('display_name') );?></a></li>
            <?php if (get_comments_number()!=0): ?><li><i class="fa fa-comments-o"></i> <?php comments_popup_link(esc_html('0 comment','metlux'),esc_html__('one comment','metlux'), esc_html__('% comments','metlux'),esc_html__('comments-link','metlux'), esc_html__('Comments are off for this post','metlux'));?></li><?php endif; ?>
          </ul>
          <div class="post-content">
            <?php the_excerpt();?>
          </div>
          <div><a href="<?php the_permalink()?>" class="btn btn-theme" title=""><?php esc_html_e('keep reading','metlux');?></a></div>
        </div>
      </div>
    <?php endwhile;endif;?>
    </div>
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
