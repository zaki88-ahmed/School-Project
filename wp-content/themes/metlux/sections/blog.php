<!--===================================
=            News and Blog            =
====================================-->
<?php 
    $sectionenable = esc_attr(get_theme_mod('blog_enable',1));
    if($sectionenable==1){
        $title = esc_html(get_theme_mod('blog_title', __(' Blog Title','metlux')));
        $desc  = esc_html(get_theme_mod('blog_content',__('Blog Subtitle','metlux')));
        $postn = esc_attr(get_theme_mod('blog_no_of_posts','2'));
        $catId = esc_attr(get_theme_mod('metlux_blog_category_display',1));
        
?>
<?php 
echo $blog = '<section class="news-blog" >
    <div class="container">
    <div class="row">
            <div class="col-sm-12">
                <!-- Section Title -->
                <div class="section-title">
                    <h2>'.$title.'</h2>
                    <div class="divider"></div>
                    <p>'.$desc.'</p>
                </div>
            </div>
        </div>

         <div class="row">
        ';
         global $post;
    $counter=0;
    $the_query = new WP_Query( array ( 'posts_per_page' => $postn, 'cat'=>$catId ) );
    while ( $the_query->have_posts() ):$counter++;
        $the_query->the_post();
        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'metlux-blog' );
        $featured_image = esc_url($featured_image[0]);
        $day = esc_attr(get_the_date(__('d','metlux')));
        $date= esc_attr(get_the_date(__('M Y','metlux')));
     echo   $blog='<div class="col-sm-6">
                        <div class="single">
                            <div class="image">';
        if ( !has_post_thumbnail() ) {
                      echo  $blog='<img src="'.esc_url(get_template_directory_uri()).'/images/slider1.jpg" alt="">';
                    }
        else{   
                       echo   $blog= '<img src="'.$featured_image.'" alt="">';
        }                    
     if (get_comments_number()!=0){
       $comment ='<i class="fa fa-comments-o"></i>';
               
      }else{
        $comment = "";
      }                   
       echo  $blog='         </div>
                            <div class="content">
                                <div class="date"><strong>'.$day.'</strong>'.$date.'</div>
                                <div class="post-item">
                                    <h2><a href="'.esc_url(get_permalink()).'" title="">'.esc_attr(get_the_title()).'</a></h2>
                                    <div class="post-info">
                                        <span><a href="'.esc_url(get_author_posts_url(get_the_author_meta('ID'))).'" title=""><i class="fa fa-user"></i> '.esc_attr(get_the_author()).'</a></span>
                                        <span class="pull-right"></span>
                                    </div>
                                    <div class="details">
                                        '.esc_attr(get_the_excerpt()).'
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                    ;
    if($counter%2==0){ echo '<div class="clearfix"></div>';}            
    endwhile;
    wp_reset_postdata();
                   
    
     $category_link = get_category_link( $catId );
    
     $enable        =esc_attr(get_theme_mod('view_enable',1));
     $viewall        =esc_attr(get_theme_mod('view_text',__('View All','metlux')));
     if($enable==1){
     echo $blog='      <div class="col-sm-12 text-center">
                        <a href="'.esc_url($category_link).'" class="btn" title="">'.$viewall.'</a>
                    </div>';
    }
    echo $blog=' </div></div></section>';
    ?>

<?php }?>
