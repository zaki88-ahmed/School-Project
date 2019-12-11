<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package education-one
 */

?>
<?php 
$education_one_page_meta_show = get_theme_mod('education_one_page_meta_show',1);
$education_one_page_date_show = get_theme_mod('education_one_page_date_show',1);
$education_one_page_author_show = get_theme_mod('education_one_page_author_show',1);
?>
					<div class="article-wrapper">
						<!--The title of the article-->
						<h1 class="article-title">
							<?php the_title(); ?>
						</h1>
						<?php if ($education_one_page_meta_show && ($education_one_page_date_show ==1 || $education_one_page_author_show == 1) ) { ?>
						<ul class="article_meta">
							<?php if ($education_one_page_date_show == 1){?><li class="day"><span class="glyphicon glyphicon-calendar"></span><?php echo esc_html(get_the_date()); ?></li><?php }?>
							<?php if ($education_one_page_author_show == 1){?>
							<li class="posted_by">
								<i class="fa fa-user"></i>
								<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>" title="" rel="author"><?php echo esc_html(get_the_author_meta('display_name'));?></a>
							</li>
							<?php }?>
						</ul>
						<?php } ?>
						<!--Image Section-->
						<?php 
			                if (has_post_thumbnail()) :
			                $image       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
			                   
			             ?>
						<div class="img-section">
							<img src="<?php echo esc_url($image[0]); ?>" class="img-responsive" />
						</div>
						<?php endif; ?>

						<!--content-->
						<div class="text-content">
							<?php the_content(); ?>
							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'education-one' ),
									'after'  => '</div>',
								) );
							?>
						</div>

						
					</div>	
