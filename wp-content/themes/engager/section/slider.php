<?php if ( esc_attr(get_theme_mod( 'slider_section_display','1' ) )) :?>
    <?php if(esc_attr(get_theme_mod('home_slider_page_one')) == 0 && esc_attr(get_theme_mod('home_slider_page_two')) == 0 && esc_attr(get_theme_mod('home_slider_page_three')) == 0 ): ?>
        <section class="slider">
        	<?php 		
        		$cid = absint(get_theme_mod('slider_category_display'));		
        		$num_post= absint(get_theme_mod( 'slider_category_display_num','3'));
        		
        		$args = array(
        			'post_type'		=>'post',
        			'post_status'	=>'publish',
        			'paged'			=>1,
        			'posts_per_page'=>$num_post,
        			'cat'			=>$cid,
        			'orderby'		=>'ID',
        			'order'			=>'DESC',
        		);
        		$loop = new WP_Query($args);
        		if ( $loop->have_posts() ) : ?>
        			<ul class="rslides">
        	        	<?php 
                            while ($loop->have_posts()) : $loop->the_post();
                            
                         ?>
        	        	<li>
        	        	<?php if(has_post_thumbnail()):?>
        	        			<?php $image= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'engager-slider-image' ); ?> 	        		
        		         			 <img src="<?php echo esc_url($image[0]); ?>" alt="">	         			         	
        	         	<?php else:?>
        		        	<img src="<?php echo esc_url(get_template_directory_uri());?>/images/slider.png" alt="">
        		     	<?php endif;?>
        		         <div class="my-caption">
        		         	<div class="outer">
        		         		<div class="inner"><div class="block">
        		         		<h1><?php the_title();?></h1>
        		         	<p><?php the_excerpt(); ?></p>
        		         	<a href="<?php the_permalink();?>" title="" class="btn btn-blue"><?php esc_html_e('Read More','engager');?></a>
        		         	</div></div>
        		         	</div>
        		         </div>
        	         	</li>
        	        	<?php endwhile;?>
                	</ul>
            	<?php endif;?>	
        </section>
    <?php else:?>
        <section class="slider">
            <?php 		
                $i=-1;
                  $sliderp[0] = absint(get_theme_mod('home_slider_page_one'));
                  $sliderp[1] = absint(get_theme_mod('home_slider_page_two'));
                  $sliderp[2] = absint(get_theme_mod('home_slider_page_three'));
                                  
                $args = array (
                    'post_type' => 'page',
                    'post_per_page' => 3,
                    'post__in'         => $sliderp,
                    'orderby'           =>'post__in',
                );
                
                $loop = new WP_Query($args);
                if ( $loop->have_posts() ) : ?>
                    <ul class="rslides">
                   <?php 
                            while ($loop->have_posts()) : $loop->the_post();
                            
                         ?>
                        <li>
                            <?php if(has_post_thumbnail()):?>
                            <?php $image= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'engager-slider-image' ); ?> 	        		
                            <img src="<?php echo esc_url($image[0]); ?>" alt="">	         			         	
                            <?php else:?>
                            <img src="<?php echo esc_url(get_template_directory_uri());?>/images/slider.png" alt="">
                            <?php endif;?>
                            <div class="my-caption">
                                <div class="outer">
                                    <div class="inner"><div class="block">
                                        <h1><?php the_title();?></h1>
                                        <p><?php the_excerpt();?></p>
                                        <a href="<?php the_permalink();?>" title="" class="btn btn-blue"><?php echo esc_attr(get_theme_mod('slider_read_more',__('Read More','engager')));?></a>
                                    </div></div>
                                </div>
                            </div>
                        </li>
                    <?php endwhile;?>
                    </ul>
            <?php endif;?>	
        </section>
    <?php endif;?>
<?php endif;?>
