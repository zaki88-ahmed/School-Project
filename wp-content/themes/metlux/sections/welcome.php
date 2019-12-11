<!--===================================== 
=            Welcome section            =
======================================-->
<?php 
	$sectionenable = esc_attr(get_theme_mod('welcome_enable',1));
	if($sectionenable==1){
        //$welcometalign = esc_attr(get_theme_mod('metlux_welcome_section_align','text-left'));

		$title = esc_attr(get_theme_mod('welcome_title',__('Welcome Title','metlux')));
		$desc	= esc_html(get_theme_mod('welcome_content',__('Welcome Subtitle','metlux')));
		
 ?>
<section class="welcome" >
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
   
                  $welcomep[0] = esc_attr(get_theme_mod('metlux_welcome_section_page1'));
                  $welcomep[1] = esc_attr(get_theme_mod('metlux_welcome_section_page2'));
                  $welcomep[2] = esc_attr(get_theme_mod('metlux_welcome_section_page3'));
                  $welcomep[3] = esc_attr(get_theme_mod('metlux_welcome_section_page4'));

                  $welcomei[0] = esc_attr(get_theme_mod('metlux_welcome_section_icon1','fa fa-magic'));
                  $welcomei[1] = esc_attr(get_theme_mod('metlux_welcome_section_icon2','fa fa-magic'));
                  $welcomei[2] = esc_attr(get_theme_mod('metlux_welcome_section_icon3','fa fa-magic'));
                  $welcomei[3] = esc_attr(get_theme_mod('metlux_welcome_section_icon4','fa fa-magic'));
                
                      $args = array (
                          'post_type' => 'page',
                          'post_per_page' => 3,
                          'post__in'         => $welcomep,
                          'orderby'           =>'post__in',
                        );

                      $serviceloop = new WP_Query($args);

                      
                      if ($serviceloop->have_posts()) :  while ($serviceloop->have_posts()) : $serviceloop->the_post();
                      $i++;
                      
    
    ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single">
                    <div class="icon-outer">
                        <div class="icon">
                            <i class="<?php echo $welcomei[$i]; ?>"></i>
                        </div>
                    </div>
                    <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
       				<?php the_excerpt(); ?>
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
<?php }?>

<!--====  End of Welcome section  ====-->

