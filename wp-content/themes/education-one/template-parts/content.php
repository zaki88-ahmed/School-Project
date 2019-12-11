<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package education-one
 */

?>
<?php 
$education_one_blog_meta_show = get_theme_mod('education_one_blog_meta_show',1);
$education_one_blog_date_show = get_theme_mod('education_one_blog_date_show',1);
$education_one_blog_category_show = get_theme_mod('education_one_blog_category_show',1);
$education_one_blog_author_show = get_theme_mod('education_one_blog_author_show',1);
$education_one_blog_tags_show = get_theme_mod('education_one_blog_tags_show',1);
$education_one_blog_comments_show = get_theme_mod('education_one_blog_comments_show',1);
?>
				<div class="article-row">


				<div class="row">

							<div class="col-md-4">
						<?php 
			                if (has_post_thumbnail()) :
			                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'education-one-category-thumb' );
			                   ?>
							
								<img src="<?php echo esc_url($image[0]); ?>" class="img-responsive wow fadeIn">
							<?php else: ?>
								<img src="<?php echo esc_url(get_template_directory_uri());?>/images/background.jpg" class="img-responsive wow fadeIn">
							<?php endif; ?>
							</div>
							<div class="col-md-8">
								<div class="article-wrapper wow fadeIn">
									<!--The title of the article-->
									<h1 class="article-title">
										<?php the_title(); ?>
									</h1>
						<?php if(  ( $education_one_blog_meta_show == 1 && ($education_one_blog_date_show == 1 || $education_one_blog_category_show == 1 || $education_one_blog_tags_show == 1 || $education_one_blog_author_show == 1 || $education_one_blog_comments_show == 1) )  ) { ?>

									<ul class="article_meta">
										<?php if ($education_one_blog_date_show == 1) { ?> 	<li><a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'))); ?>" title=""><i class="fa fa-calendar"></i> <?php echo esc_html(get_the_date());?></a></li> <?php } ?>
										<?php if ($education_one_blog_author_show == 1) { ?> 	<li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>"><i class="fa fa-user"></i>  &nbsp;<?php echo esc_html(get_the_author_meta('display_name'));?></a></li><?php } ?>
										<?php if ($education_one_blog_category_show == 1) { ?> 	 <li><i class="fa fa-folder-open"></i> <?php echo get_the_category_list(', '); ?></li><?php } ?>
                    					<?php if ($education_one_blog_tags_show == 1) { ?> 	<?php echo get_the_tag_list('<li><i class="fa fa-tag"></i> ',', ','</li>'); ?><?php } ?>
										<?php if ($education_one_blog_comments_show == 1) { ?> 	<li><a href="<?php the_permalink(); ?>"><i class="fa fa-comments-o"></i> &nbsp; <?php comments_popup_link(esc_html__('zero comment','education-one'),esc_html__('one comment','education-one'), esc_html__('% comments','education-one'));?></a></li><?php } ?>
              
									</ul>
						<?php } ?>
									<!--Image Section-->
									<div class="content-section">
										<?php the_excerpt(); ?>            					
										<a href="<?php the_permalink(); ?>"><button class="submit-btn" href="<?php the_permalink(); ?>" ><?php esc_html_e('Read More','education-one'); ?></button></a>
									</div>
								</div>
							</div>
						</div>


					</div>