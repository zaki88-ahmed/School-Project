<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package engager
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(has_post_thumbnail()):
		$args = array('class' => 'img-responsive center-block',);
        the_post_thumbnail('engager-post-image',$args);    
	
	 endif;?>

	<div class="blog-content">
		<?php the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'engager' ),
				'after'  => '</div>',
			) ); 
		?>
	</div>

	

	<?php if ( get_edit_post_link() ) : ?>
		<div class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'engager' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</div><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
