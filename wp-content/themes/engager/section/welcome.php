<?php if(esc_attr(get_theme_mod('welocme_section_display','1'))):?>
<section class="welcome">
	<div class="container">
		<div class="row">
			<div class="section-title">
				<h1><?php echo esc_html(get_theme_mod( 'welcome_textbox', '' )); ?></h1>
			
			</div>
		</div>

		<div class="row">
            <?php 
            $i=-1;
            global $post;
            $welcome_post[0] = absint(get_theme_mod('welcome_page_display1'));
            $welcome_post[1] = absint(get_theme_mod('welcome_page_display2'));
            $welcome_post[2] = absint(get_theme_mod('welcome_page_display3'));                           
            
            $welcome_icon[0] = esc_attr(get_theme_mod('icon_text1','fa fa-bar-chart-o'));
            $welcome_icon[1] = esc_attr(get_theme_mod('icon_text2','fa fa-bar-chart-o'));
            $welcome_icon[2] = esc_attr(get_theme_mod('icon_text3','fa fa-bar-chart-o'));            
            
                $args = array (
                    'post_type' => 'page',
                    'post_per_page' => 3,
                    'post__in'         => $welcome_post,
                    'orderby'           =>'post__in',
                );
                $loop = new WP_Query($args);                        
                if ( $loop->have_posts() ) : 		
                    while ($loop->have_posts()) : $loop->the_post(); $i++;
                    
                ?>
            			<div class="col-sm-4">
            				<div class="single">			
                                <div class="icon">
                                    <i class="<?php echo esc_attr( $welcome_icon[$i] );?>"></i>
                                </div>
            					<a href="<?php the_permalink();?>" title="">
            						<h2><?php the_title();?></h2>
            					</a>
            					<p>
            						<?php the_excerpt(); ?>
            					</p>
            				</div>
            			</div>
                    <?php endwhile;?>
                <?php endif;?>
		</div>
	</div>
</section>
<?php endif;?>