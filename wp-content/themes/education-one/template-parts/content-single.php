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
$education_one_posts_meta_show = get_theme_mod('education_one_posts_meta_show',1);
$education_one_posts_date_show = get_theme_mod('education_one_posts_date_show',1);
$education_one_posts_category_show = get_theme_mod('education_one_posts_category_show',1);
$education_one_posts_author_show = get_theme_mod('education_one_posts_author_show',1);
$education_one_posts_tags_show = get_theme_mod('education_one_posts_tags_show',1);
$education_one_posts_comments_show = get_theme_mod('education_one_posts_comments_show',1);
?>

			<div id="post-<?php the_ID(); ?>" <?php post_class('article-wrapper'); ?>>
			
						<!--The title of the article <div class="article-wrapper">-->
						<h1 class="article-title">
							<?php the_title(); ?>
						</h1>
						<?php if(  ( $education_one_posts_meta_show == 1 && ($education_one_posts_date_show == 1 || $education_one_posts_category_show == 1 || $education_one_posts_tags_show == 1 || $education_one_posts_author_show == 1 || $education_one_posts_comments_show == 1) )  ) { ?>
						<ul class="article_meta">
						<?php if ($education_one_posts_date_show == 1) { ?> <li><a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'))); ?>" title=""><i class="fa fa-calendar"></i> <?php echo esc_html(get_the_date());?></a></li><?php } ?>
						<?php if ($education_one_posts_author_show == 1) { ?> <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>"><i class="fa fa-user"></i>  &nbsp;<?php echo esc_html(get_the_author_meta('display_name'));?></a></li><?php } ?>
						<?php if ($education_one_posts_category_show == 1) { ?>	 <li><i class="fa fa-folder-open"></i> <?php echo get_the_category_list(', '); ?></li><?php } ?>
        				<?php if ($education_one_posts_tags_show == 1) { ?>	<?php echo get_the_tag_list('<li><i class="fa fa-tag"></i> ',', ','</li>'); ?><?php } ?>
						<?php if ($education_one_posts_comments_show == 1) { ?>	<li><a href=""><i class="fa fa-comments-o"></i> &nbsp; <?php comments_popup_link(esc_html__('zero comment','education-one'),esc_html__('one comment','education-one'), esc_html__('% comments','education-one'));?></a></li><?php } ?>

						</ul>
						<?php } ?>
						<!--Image Section-->
						<?php 
			                if (has_post_thumbnail()) :
			                 
			             ?>
						<div class="img-section">
							<?php the_post_thumbnail();?>
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

					<div class="comment_section">
                    	<!--Start Comment list-->
						<!-- You can start editing here. -->
						<div id="commentsbox">
							<div class="commentform_wrapper">
							
							<?php comments_template();?> 
							</div>
		                    <!--End Comment Form-->
		                </div>
						</div>

						
					</div>	

