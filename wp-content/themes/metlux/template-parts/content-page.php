<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package metlux
 */

?>

				  <div  id="post-<?php the_ID(); ?>" class="content">
						  <?php if(has_post_thumbnail()){ ?>
							<img src="<?php echo esc_url(get_the_post_thumbnail_url ()); ?>" class="aligncenter" alt="">
						  <?php } ?>

								<?php the_content(); ?>
								 <?php
    									wp_link_pages( array(
      									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'metlux' ),
      									'after'  => '</div>',
     										 ) );
      								?>
        	
					</div>