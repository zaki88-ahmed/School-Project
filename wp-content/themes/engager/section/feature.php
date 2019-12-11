<?php if(esc_attr(get_theme_mod('features_section_display','1'))):?>
<section class="services">
	<div class="container">
		<div class="row">
			<div class="section-title">
				<h1><?php echo esc_attr(get_theme_mod( 'featured_title', __('Feature Title','engager'))); ?></h1>
			</div>
		</div>

		<div class="row">
            <?php if(esc_attr(get_theme_mod('feature_page_display1')) == 0 && esc_attr(get_theme_mod('feature_page_display2')) == 0 && esc_attr(get_theme_mod('feature_page_display3')) == 0 && esc_attr(get_theme_mod('feature_page_display4')) == 0 && esc_attr(get_theme_mod('feature_page_display5') == 0 )): ?>
    			<?php 
                global $post;
    				$featured_id = absint(get_theme_mod('featured_category_display','1'));
    				$featured_num_post= absint(get_theme_mod( 'featured_category_display_num','5'));
    				$args = array(
    					'post_type'		=>'post',
    					'post_status'	=>'publish',
    					'paged'			=>1,
    					'posts_per_page'=>$featured_num_post,
    					'cat'			=>$featured_id,
    					'orderby'		=>'ID',
    					'order'			=>'DESC',
    				);
    				$loop = new WP_Query($args);
    				if ( $loop->have_posts() ) : 		
    	        		while ($loop->have_posts()) : $loop->the_post();
                     
        		 ?>				
    						<div class="columns-5 col-md-3 col-sm-6">
    							<div class="single">
    								<?php if(get_theme_mod( 'icon_featured')):?>
    									<div class="icon">
    										<i class="<?php echo esc_attr(get_theme_mod( 'icon_featured')); ?>"></i>
    									</div>
    								<?php elseif(has_post_thumbnail($post->ID)):?>
    									<div class="icon">
    										<?php the_post_thumbnail('engager_featured_image');?>
    									</div>
    								<?php else:?>
    									<div class="icon">
    										<i class="fa fa-home"></i>
    									</div>
    								<?php endif;?>
    								<p><?php the_excerpt(); ?></p>
    								<a href="<?php the_permalink();?>" title="" class="btn btn-plain"><?php echo esc_html(get_theme_mod('feature_read_more',__('Read More','engager')));?> <i class="fa fa-angle-double-right"></i></a>
    							</div>
    						</div>
    					<?php endwhile;?>
    				<?php endif;?>
                <?php else:?>
                    <?php 
                    $i=0;
                    global $post;
                    $feature_post[0] = absint(get_theme_mod('feature_page_display1'));
                    $feature_post[1] = absint(get_theme_mod('feature_page_display2'));
                    $feature_post[2] = absint(get_theme_mod('feature_page_display3'));
                    $feature_post[3] = absint(get_theme_mod('feature_page_display4'));
                    $feature_post[4] = absint(get_theme_mod('feature_page_display5'));                    
                    
                    $feature_icon[0] = esc_attr(get_theme_mod('feature_icon1','fa fa-bar-chart-o'));
                    $feature_icon[1] = esc_attr(get_theme_mod('feature_icon2','fa fa-bar-chart-o'));
                    $feature_icon[2] = esc_attr(get_theme_mod('feature_icon3','fa fa-bar-chart-o'));
                    $feature_icon[3] = esc_attr(get_theme_mod('feature_icon4','fa fa-bar-chart-o'));
                    $feature_icon[4] = esc_attr(get_theme_mod('feature_icon5','fa fa-bar-chart-o'));
                    
                        $args = array (
                            'post_type' => 'page',
                            'post_per_page' => 5,
                            'post__in'         => $feature_post,
                            'orderby'           =>'post__in',
                        );
                        $loop = new WP_Query($args);                        
                        if ( $loop->have_posts() ) : 		
                            while ($loop->have_posts()) : $loop->the_post(); 
                        ?>				
                                <div class="columns-5 col-md-3 col-sm-6">
                                    <div class="single">
                                        <?php if($feature_icon[$i]):?>
                                            <div class="icon">
                                                <i class="<?php echo esc_attr($feature_icon[$i]);?>"></i>
                                            </div>
                                        <?php elseif(has_post_thumbnail($post->ID)):?>
                                            <div class="icon">
                                                <?php the_post_thumbnail('engager_featured_image');?>
                                            </div>
                                        <?php else:?>
                                            <div class="icon">
                                                <i class="fa fa-home"></i>
                                            </div>
                                        <?php endif;?>
                                        <p><?php the_excerpt(); ?></p>
                                        <a href="<?php the_permalink();?>" title="" class="btn btn-plain"><?php echo esc_attr(get_theme_mod('feature_read_more',__('Read More','engager')));?> <i class="fa fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            <?php  $i=$i+1; endwhile;?>
                        <?php endif;?>
                <?php endif;?>
		</div>
	</div>
</section>
<?php endif;?>