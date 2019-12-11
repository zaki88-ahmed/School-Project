<?php 
$slidertalign = esc_attr(get_theme_mod('slider_text_align'));

?>

<?php 
	$sectionenable = esc_attr(get_theme_mod('slider_enable',1));
	if($sectionenable==1){
 ?>
<?php if(esc_attr(get_theme_mod('home_slider_page_one')) == 0 && esc_attr(get_theme_mod('home_slider_page_two')) == 0 && esc_attr(get_theme_mod('home_slider_page_three')) == 0 ): ?>
   <section id="myCarousel" class="carousel slide">
        <!-- Indicators -->        
       <ol class="carousel-indicators">
       <?php
        $i=-1;
        $catId = esc_attr(get_theme_mod('metlux_slider_category_display',1));
         $postn = esc_attr(get_theme_mod('slider_no_of_posts','4'));
        $query =new wp_Query
                    (
                            array
                            (
                            'post_type'     =>'post',
                            'posts_per_page'=>$postn,
                            'cat'			=>$catId
                            )
                    );
       if($query->have_posts()):while($query->have_posts()): $query->the_post();  $i++;
             if($i==0){$active= "active";}
             else {  $active= "";}       
         ?>
         <li data-target="#myCarousel" data-slide-to="<?php echo $i;?>" class="<?php echo $active; ?>"></li>
        <?php
           endwhile; wp_reset_postdata(); endif;
  		  ?>
        </ol> 

      
        <div class="carousel-inner">
       <?php
        global $post;
        $i=-1;
        $catId = esc_attr(get_theme_mod('metlux_slider_category_display',1));
        $postn = esc_attr(get_theme_mod('slider_no_of_posts','4'));
       $query =new wp_Query
                    (
                             array
                            (
                            'post_type'     =>'post',
                            'posts_per_page'=>$postn,
                            'cat'			=>$catId
                            )
                    );
       if($query->have_posts()):while($query->have_posts()): $query->the_post();
       $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'metlux-slider' );
      
      
         if ( has_post_thumbnail() ) 
            { 
                $image=esc_url($image[0]);
             }else
             {
                $image= esc_url(get_template_directory_uri());
                $image.='/images/slider1.jpg';
             }
       $i++;
       if($i==0)
       { 
                $active= "active";
        }else
        {
                $active= "";
        }
        ?>
   		<div class="item <?php echo  $active; ?>">
                <div class="fill "  style="background-image:url(<?php echo $image;?>);"></div>
                <div class="carousel-caption outer <?php echo $slidertalign; ?> ">
                    <div class="inner">
                    <h2><?php the_title(); ?></h2>
                    
                    <?php echo the_excerpt();?>
                    <div class="clearfix"></div> 
                    <a href="<?php  the_permalink(); ?>" class="btn btn-theme" title=""><?php echo esc_attr(get_theme_mod('slider_read_more',__('Read More','metlux'))); ?></a>
                    </div>
                </div>
            </div>
           <?php              
                    endwhile;
                        wp_reset_postdata();  
                    endif; 
 			?>            
        </div>
    </section>
  <?php else: ?>
     <section id="myCarousel" class="carousel slide">
        <!-- Indicators -->        
       <ol class="carousel-indicators">
      <?php
   
                  $i=-1;
                  $sliderp[0] = esc_attr(get_theme_mod('home_slider_page_one'));
                  $sliderp[1] = esc_attr(get_theme_mod('home_slider_page_two'));
                  $sliderp[2] = esc_attr(get_theme_mod('home_slider_page_three'));

              
                      $args = array (
                          'post_type' => 'page',
                          'post_per_page' => 3,
                          'post__in'         => $sliderp,
                          'orderby'           =>'post__in',
                        );

                      $sliderloop = new WP_Query($args);

                      
          if ($sliderloop->have_posts()) :  while ($sliderloop->have_posts()) : $sliderloop->the_post(); $i++;
                       if($i==0){$active= "active";}
             else {  $active= "";} 
                      
            ?>
                           <li data-target="#myCarousel" data-slide-to="<?php echo $i;?>" class="<?php echo $active; ?>"></li>
          <?php
            endwhile; wp_reset_postdata(); endif;
          ?>
        </ol> 

      
        <div class="carousel-inner">
       <?php
        global $post;
      
                  $i=-1;
                  $sliderp[0] = esc_attr(get_theme_mod('home_slider_page_one'));
                  $sliderp[1] = esc_attr(get_theme_mod('home_slider_page_two'));
                  $sliderp[2] = esc_attr(get_theme_mod('home_slider_page_three'));

              
                      $args = array (
                          'post_type' => 'page',
                          'post_per_page' => 3,
                          'post__in'         => $sliderp,
                          'orderby'           =>'post__in',
                        );

                      $sliderloop = new WP_Query($args);

                      
      if ($sliderloop->have_posts()) :  while ($sliderloop->have_posts()) : $sliderloop->the_post(); $i++;
                       if($i==0){$active= "active";}
                       else {  $active= "";}  
            
           $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'metlux-slider' );
      
         if ( has_post_thumbnail() ) 
            { 
                $image=esc_url($image[0]);
             }else
             {
                $image= esc_url(get_template_directory_uri());
                $image.='/images/slider1.jpg';
             }
     
        ?>
      <div class="item <?php echo  $active; ?>">
                <div class="fill <?php echo $slidertalign; ?> " style="background-image:url(<?php echo $image;?>);"></div>
                <div class="carousel-caption outer <?php echo $slidertalign; ?> ">
                    <div class="inner">
                    <h2><?php the_title(); ?></h2>                   
                    <?php echo the_excerpt();?>
                    <div class="clearfix"></div> 
                    <a href="<?php  the_permalink(); ?>" class="btn btn-theme" title=""><?php echo esc_attr(get_theme_mod('slider_read_more',__('Read More','metlux'))); ?></a>
                    </div>
                </div>
            </div>
           <?php              
                    endwhile;
                        wp_reset_postdata();  
                    endif; 
      ?>            
        </div>
    </section>


  <?php endif;?>
    <?php }?>
   

<!--====  End of Slider  ====-->
