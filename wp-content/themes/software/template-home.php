<?php
/**
 * Template Name: Frontpage
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package software
 */

get_header(); ?>
<?php 
  $enable = get_theme_mod('enable_slider','disable'); 
  if($enable=='enable'):
?>

<header id="myCarousel" class="carousel fade">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        <?php
          $cid = absint(get_theme_mod('slider_category_display'));
          $category_link = get_category_link($cid);
          $software_theme_cat = get_category($cid);
          if ($software_theme_cat) {
            global $post;
            $cnum= absint(get_theme_mod('slider_category_display_num'));
            $args = array(
              'posts_per_page' => $cnum,
              'paged' => 1,
              'cat' => $cid
            );
            $loop = new WP_Query($args);
            $cn = -1;
            if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();$cn++;
            ?>
            <li data-target="#myCarousel" data-slide-to="<?php echo esc_attr($cn); ?>" class="<?php if($cn==0){echo esc_attr(__('active','software'));} ?>"></li>
             <?php                 
                endwhile;
                  wp_reset_postdata();  
                endif;                             
                }
              ?> 
            
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
        <?php
          $cid = absint(get_theme_mod('slider_category_display'));
          $category_link = get_category_link($cid);
          $software_theme_cat = get_category($cid);
          if ($software_theme_cat) {
            global $post;
            $cnum= absint(get_theme_mod('slider_category_display_num'));
            $args = array(
              'posts_per_page' => $cnum,
              'paged' => 1,
              'cat' => $cid
            );
            $loop = new WP_Query($args);
            $cn = -1;
            if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();$cn++;
             $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
             $download    = get_theme_mod('slider_button',__('Download','software'));
             $link        = get_theme_mod('slider_button_link','');

            ?>
            <div class="item <?php if($cn==0){echo esc_html(__('active','software'));} ?>">
                <div class="fill"></div>
                <div class="carousel-caption outer">
                <img src="<?php echo esc_url($image[0]);?>" class="img-responsive" alt="">
                     <div class="middle">
                         <div class="inner wow slideInDown" data-wow-duration="1.5s">
                    <h3 class="caption-title"><?php the_title(); ?></h3>
                    <?php the_excerpt(); ?>
                    <?php if($download): ?>
                    <h5>
                    <a href="<?php echo esc_url($link) ; ?>" class="btn btn-slider" title=""><?php echo esc_html($download); ?> <i class="fa fa-download"></i></a>
                    </h5>
                    <?php endif; ?>
                    <?php 
                      $readmore = get_theme_mod('enable_readmore','enable');
                      if($readmore=='enable'):
                     ?>
                    <h5>
                    <a href="<?php the_permalink(); ?>" class="btn btn-slider" title=""><?php esc_html_e('Read More','software'); ?> <i class="fa fa-angle-double-right"></i></a>
                    </h5>
                  <?php endif;?>
                    </div>
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

</header>
<?php endif;?>
<?php 
  $enable = get_theme_mod('enable_about','disable'); 
  if($enable=='enable'):
?>

<section class="about-us">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-title">
                    <h1><?php echo esc_html(get_theme_mod('about_title',__('ABOUT SOFTWARE','software'))); ?></h1>
                </div>
            </div>
          <?php
           for ( $i = 1; $i <= 4; $i++ ) {
             $icon =  get_theme_mod('about_icon'.$i,'fa-area-chart');
          $cid = absint(get_theme_mod('about_page'.$i));
             $the_query = new WP_Query( 'page_id='.$cid );
            if ($the_query->have_posts()) : 
             $page = get_post($cid);
             ?>
            <div class="col-md-3 col-sm-6">
                <div class="single wow slideInUp">
                    <div class="icon">
                        <i class="fa <?php echo esc_attr($icon); ?>"></i>
                    </div>
                    <h1><?php echo esc_html($page->post_title); ?></h1>
                   <p><?php echo esc_html($page->post_excerpt); ?></p>
                    <a href="<?php the_permalink($cid); ?>" title="" class="btn read-more"><?php esc_html_e('Read More ','software'); ?><i class="fa fa-angle-double-right"></i></a>
                </div>
            </div>
             <?php                 
                  wp_reset_postdata();  
                endif;  
                }                           
              ?> 

          
        </div>
    </div>
</section>
<?php endif; ?>
<?php 
  $enable = get_theme_mod('enable_feature','disable'); 
  if($enable=='enable'):
    $cid = absint(get_theme_mod('feature_page'));
   $page = get_post($cid);
   if (have_posts()) :
   $image = wp_get_attachment_image_src( get_post_thumbnail_id( $cid ), 'software-feature-thumb' );
   $feature_readmore = get_theme_mod('enable_feature_readmore','enable');
   $excerpt = wpautop($page->post_excerpt);
   $content = wpautop($page->post_content);
?>
<section class="home-features">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-title">
                    <h1><?php echo esc_html(get_theme_mod('feature_title',__('Feature','software'))); ?></h1>                   
                </div>                
            </div>
            <div class="clearfix"></div>

            <div class="col-sm-6">
               <div class="featured_content">
               <?php if($excerpt): ?>
                  <p><?php echo esc_html($excerpt); ?></p>
                <?php else: ?>
                   <p><?php echo wp_kses_post($content); ?></p>
                <?php endif;?>
               </div>
                <?php if($feature_readmore=='enable'): ?>
                   <a href="<?php the_permalink($cid); ?>" class="btn btn-slider" title=""><?php esc_html_e('Read More','software'); ?> <i class="fa fa-angle-double-right"></i></a>
               <?php endif;?>
            </div>
            <?php if($image):?>
            <div class="col-sm-6 img-col">
                <div class="image wow slideInUp">
                    <img src="<?php echo esc_url($image[0]); ?>" class="img-responsive center-block" alt="">
                </div>
            </div>
          <?php endif;?>
        </div>
    </div>
</section>
<?php endif;?>
<?php endif;?>

<?php 
  $enable = get_theme_mod('enable_frontpage','disable'); 
  if($enable=='enable'):
    $cid = absint(get_theme_mod('front_page'));
   $page = get_post($cid);
   if (have_posts()) :
   $image = wp_get_attachment_image_src( get_post_thumbnail_id( $cid ), 'software-front-thumb' );
   $download = esc_attr(get_theme_mod('download_title'));

   $readmore = get_theme_mod('enable_front_readmore','enable');
   $excerpt = wpautop($page->post_excerpt);
   $content = wpautop($page->post_content);
?>
<section class="download-sec">
    <div class="container">
        <div class="row">
        <?php
          if($image):
         ?>
            <div class="col-sm-6">
                <div class="image wow slideInUp">
                    <img src="<?php echo esc_url($image[0]); ?>" class="img-responsive center-block" alt="">
                </div>
            </div>
          <?php endif;?>
            <div class="col-sm-6">
                <div class="content wow slideInUp">
                    <?php if($excerpt): ?>
                       <p><?php echo esc_html($excerpt); ?></p>
                    <?php else: ?>
                        <p><?php echo esc_html($content); ?></p>
                    <?php endif;?>
                    <?php if($download): ?>
                    <a href="<?php echo   esc_url(get_theme_mod('download_link')); ?>" title="" class="btn btn-download"><?php echo esc_html($download);?> <i class="fa fa-download"></i></a>
                  <?php endif;?>
                  <?php if($readmore=='enable'): ?>
                    <a href="<?php the_permalink($cid); ?>" title="" class="btn btn-download"> <?php esc_html_e('Read More','software'); ?> <i class="fa fa-angle-double-right"></i></a>
                  <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif;?>
<?php endif;?>


<?php

get_footer();
