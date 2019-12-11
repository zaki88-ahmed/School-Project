<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package metlux
 */

get_header(); ?>

<!--=================================
=            Page Header            =
==================================-->
<section class="page-header overlay" >
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-title">
					<?php
					the_archive_title( '<h1>', '</h1>' );
					the_archive_description( '<div>', '</div>' );
				?>
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
			
			<div class="<?php echo $class; ?> col-sm-12">
				<div class="row">
			
				<?php if ( have_posts() ) : ?>
				
							<?php while ( have_posts() ) : the_post(); ?>
								<?php 

									 $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'metlux-products' );
									 if ( has_post_thumbnail() ) 
           							 { 
						                $image=esc_url($image[0]);
						             }	else
									 {
										 $image= esc_url(get_template_directory_uri());
										 $image.='/images/portfolio/p1.jpg';
									 }
            						 $day = get_the_date('d');
       								 $date= get_the_date('M Y');						
								?>
								<div class="col-md-4 col-sm-6 col-xs-12 post-grid">
										<!-- Single Post -->
										<div  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="post-single">
									<?php if(has_post_thumbnail() || $image !== ''){ ?>  
										<div class="featured-image overlay">
										<?php if( has_category() ): ?><h6 class="category"><i class="fa fa-folder-open"></i> <?php single_cat_title(); ?></h6><?php endif; ?>
											<a href="<?php the_permalink(); ?>" title=""><img src="<?php echo $image; ?>" alt=""></a>
											<div class="date">
												<strong><?php echo esc_attr($day); ?></strong> <p><?php echo esc_attr($date); ?></p>
											</div>
										</div>
									<?php }?>
										<div class="title">
												<h2><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e('Home','metlux'); ?>" alt="<?php esc_attr_e('Home','metlux'); ?>"><?php the_title(); ?></a></h2>
										</div>

										<ul class="post-info list-inline">
											<li><i class="fa fa-user"></i>&nbsp;<?php echo esc_html( get_the_author_meta('display_name') );?></li>
											<?php if (get_comments_number()!=0): ?><li><i class="fa fa-comments-o"></i>&nbsp;<?php comments_popup_link(esc_html__('0 comment','metlux'),esc_html__('one comment','metlux'), esc_html__('% comments','metlux'),esc_html__('comments-link','metlux'), esc_html__('Comments are off for this post','metlux'));?></li><?php endif; ?>
										</ul>
										<div class="post-content">
											<?php the_excerpt(); ?>
										</div>
										<div><a href="<?php the_permalink(); ?>" class="btn btn-theme" title="<?php the_title();?>" alt="<?php the_title();?>"><?php esc_html_e('keep reading','metlux'); ?></a></div>
									</div>
									</div>
								</div>

							<?php endwhile;  wp_reset_postdata(); ?>
							<div class="clear:both"></div>
							<?php 
							    $pagination = get_theme_mod('metlux_check_category_setting');
							    if($pagination==1){}
							    else{ ?>
							    	<div>
										<?php the_posts_pagination( array(
			                                'mid_size' => 2,
			                                'prev_text' => __( '<span aria-hidden="true">&laquo;</span>', 'metlux' ),
			                                'next_text' => __( '<span aria-hidden="true">&raquo;</span>', 'metlux' ),
			                            ) ); ?>
									</div>
						    	<?php }  ?>
							

						<?php else : ?>

							<?php get_template_part( 'template-parts/content', 'none' ); ?>

						<?php endif; ?>

				</div>
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