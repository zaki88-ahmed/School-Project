<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package metlux
 */

?>

			<div  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post-single">
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
						?>
					<div class="featured-image overlay">
						<a href="<?php the_permalink(); ?>" title=""><img src="<?php echo $image; ?>" alt=""></a>
					</div>

					<div class="date-title">
						<div class="date">
							<?php metlux_date();?>
						</div>
						<div class="title">
							<h2><a href="<?php the_permalink();?>" title="<?php the_title();?>" alt="<?php the_title();?>"><?php the_title();?></a></h2>
						</div>
					</div>
					<div class="clearfix"></div>
					
					<ul class="post-info list-inline">
						<i class="fa fa-user"></i> <?php echo esc_html( get_the_author_meta('display_name') );?>
						<i class="fa fa-comments-o"></i> <?php comments_popup_link(esc_html__('0 comment','metlux'),esc_html__('one comment','metlux'), esc_html__('% comments','metlux'));?>
						<i class="fa fa-folder-open"></i> <?php the_category(', '); ?>
					</ul>
					<div class="post-content">
						<?php the_excerpt();?>
					</div>
					<div><a href="<?php the_permalink(); ?>" class="btn btn-theme" title="<?php esc_html_e('Read More','metlux'); ?>" alt="<?php esc_html_e('Read More','metlux'); ?>"><?php esc_html_e('Read More','metlux'); ?></a></div>
				</div>
			</div>
