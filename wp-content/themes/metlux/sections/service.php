<!--=====================================
=            Service Section            =
======================================-->
<?php 
	$sectionenable = esc_attr(get_theme_mod('service_enable',1));
	if($sectionenable==1){
		$title = esc_html(get_theme_mod('service_title',__('Service Title','metlux')));
		$desc	= esc_html(get_theme_mod('service_content',__('Service Subtitle','metlux')));
		
     
 ?>
<section class="services img-bg" >
    <div class="container">
    <div class="row">
            <div class="col-sm-12">
                <!-- Section Title -->
                <div class="section-title">
                    <h2><?php echo $title; ?></h2>
                    <div class="divider"></div>
                    <p><?php echo $desc; ?></p>
                </div>
            </div>
        </div>
        <div class="row">
     <?php 
    global $post;
    $i=-1;
   
                  $servicesp[0] = esc_attr(get_theme_mod('metlux_service_section_page1'));
                  $servicesp[1] = esc_attr(get_theme_mod('metlux_service_section_page2'));
                  $servicesp[2] = esc_attr(get_theme_mod('metlux_service_section_page3'));
                 

                  $servicesi[0] = esc_attr(get_theme_mod('metlux_service_section_icon1','fa fa-magic'));
                  $servicesi[1] = esc_attr(get_theme_mod('metlux_service_section_icon2','fa fa-magic'));
                  $servicesi[2] = esc_attr(get_theme_mod('metlux_service_section_icon3','fa fa-magic'));
                  
                      $args = array (
                          'post_type' => 'page',
                          'post_per_page' => 3,
                          'post__in'         => $servicesp,
                          'orderby'           =>'post__in',
                        );

                      $serviceloop = new WP_Query($args);

                
if ($serviceloop->have_posts()) :  while ($serviceloop->have_posts()) : $serviceloop->the_post();
                      $i++;
                      
    
    ?>
       <div class="col-sm-4 col-xs-12">
                <div class="single">
                    <div class="icon"><i class="<?php echo $servicesi[$i]; ?>"></i></div>
                    <h2><?php the_title(); ?></h2>
                    <?php the_excerpt(); ?>
                    <a class="read-more" href="<?php echo the_permalink(); ?>">
                        <?php esc_html_e('Read More','metlux');?><br> <i class="fa fa-angle-double-down"></i>
                    </a>
                </div>
        </div>
        
     <?php
    endwhile;
     wp_reset_postdata();
     endif;
    ?>
   		</div>
   	</div>
   </section>
<?php  }?>



<!--====  End of Service Section  ====-->
