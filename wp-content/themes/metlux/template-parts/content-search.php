<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package metlux
 */

?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post-single">
					<div class="date-title">
						<div class="date">
							<strong><?php echo esc_attr( get_the_date(__('d','metlux')) );?></strong> <p><?php echo esc_attr( get_the_date(__('D','metlux') ));?><br><?php echo esc_attr( get_the_date(__('Y','metlux') ));?></p>
						</div>
						<div class="title">
							<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" ><?php the_title(); ?></a></h2>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="featured-image">
					<?php if(has_post_thumbnail()){ ?>
						<a href="<?php the_permalink(); ?>" title=""><img src="<?php echo esc_url(get_the_post_thumbnail_url ()); ?>" alt=""></a>
					<?php }?>
					</div>
					<ul class="post-info list-inline">
						<li><a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title=""><i class="fa fa-user">&nbsp;</i><?php echo esc_attr( get_the_author_meta('display_name') );?></a></li>
						<?php if (get_comments_number()!=0): ?><li><i class="fa fa-comments-o"></i>&nbsp;<?php comments_popup_link(esc_html('0 comment','metlux'),esc_html__('one comment','metlux'), esc_html__('% comments','metlux'),esc_html__('comments-link','metlux'), esc_html__('Comments are off for this post','metlux'));?></li><?php endif; ?>
						 <?php if( has_tag() ): ?><li><i class="fa fa-folder-open"></i>&nbsp; <?php the_tags(); ?></li><?php endif; ?>
					</ul>
					<div class="post-content">
						<?php the_excerpt(); ?>
					</div>
					<div><a href="<?php the_permalink(); ?>" class="btn btn-theme" title=""><?php esc_html_e('Read More','metlux'); ?></a></div>
				</div>
			</div>