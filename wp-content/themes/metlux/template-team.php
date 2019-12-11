<?php
/**
* Template Name: Team
 * The template for displaying Team pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package metlux
 */

get_header(); ?>

<!--=================================
=            Page Header            =
==================================-->
<?php $cat= get_query_var('cat');?> 
<section class="page-header overlay" >
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-title">					
					<div class="divider"></div>
				</div>
				
			</div>
		</div>
	</div>
</section>

<!--====  End of Page Header  ====-->

<!--================================
=            Inner Page            =
=================================-->

<section class="inner-page">
<h4 class="hidden"><?php the_title(); ?></h4>

	<div class="container">
		<div class="row">
		<?php 
			$sidebar = esc_attr(get_theme_mod('metlux_default_layout','1'));		

			if($sidebar == 1 || $sidebar == 2){
				$class = 'col-md-9';
			}elseif($sidebar == 3){
				$class  = 'col-md-6';
			}else{
				$class = 'col-md-12';
			}

			
		if ($sidebar == 2 || $sidebar == 3){ 
			get_sidebar('left');
		}
				

		?>
			
			<div class="<?php echo $class; ?> col-sm-12 no-padding">
			
				<?php if ( have_posts() ) : the_post();  ?>
						<section class="our-team">
								<div class="row">
									<div class="col-sm-12">
										<!-- Section Title -->
										<div class="section-title">
											<h1><?php the_title(); ?></h1>
											<div class="divider"></div>
											<?php the_content(); ?>
										</div>
									</div>
								</div>

								<div class="row">
								<?php 
								$cn=0;
								$catId = esc_attr(get_theme_mod('metlux_team_category_display'));
								
									$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								?>	
								<?php query_posts('post_type=post&cat='.$catId.'&post_status=publish&paged='.$paged.'');  ?>
								<?php  
									
									while ( have_posts() ) : the_post(); $cn++;
									$feat_team_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'metlux-team' );
							        $feat_team_image = $feat_team_image[0];
							        $default_team_image = get_template_directory_uri().'/images/team/team1.png';

							        
								 ?>
									<div class="col-md-3 col-sm-6 col-xs-12">
										<div class="single">
											<div class="image">
											<?php	if ( has_post_thumbnail() ) {
												 echo  $image= '<img src="'.esc_url($feat_team_image).'" alt="">';
										                       									                    }
										        else{   
										                echo $image='<img src="'.esc_url($default_team_image).'" alt="">';
	     
										        }	
										      ?>
												<ul class="list-inline">
												<li> <a href="<?php the_permalink(); ?>"><?php esc_html_e('View Detail','metlux'); ?></a></li>
												</ul>
											</div>
											<div class="info">
												<h3><?php the_title(); ?></h3>												
											</div>
										</div>
									</div>
									<?php if($cn%4==0){ echo '<div class="clearfix"></div>';}?>
									<?php endwhile;  wp_reset_postdata(); ?>
									
								</div>

					
						</section>
							
							<div class="clear:both"></div>
							<?php 
							    $pagination = get_theme_mod('metlux_check_team_setting');
							    if($pagination==1){}
							    else{ ?>
							    	<div class="metlux-pagination">
										<?php the_posts_pagination( array(
			                                'mid_size' => 2,
			                                'prev_text' => __( '<span aria-hidden="true">&laquo;</span>', 'metlux' ),
			                                'next_text' => __( '<span aria-hidden="true">&raquo;</span>', 'metlux' ),
			                            ) ); ?>							    		
							    	</div>

							    <?php } ?>


						<?php else : ?>

							<?php get_template_part( 'template-parts/content', 'none' ); ?>

						<?php endif; ?>

				</div>
			

		<?php
		if ($sidebar == 1 || $sidebar == 3){ 
			get_sidebar('right');
		}
		

		?>
			
		</div>
	</div>
</section>

<!--====  End of Inner Page  ====-->



<?php

get_footer();

?>