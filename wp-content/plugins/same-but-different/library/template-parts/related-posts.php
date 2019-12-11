<?php
// If there are related posts
if ( count($posts) ) {
	// Get just the IDs of your posts
	$postIds = array_unique( wp_list_pluck( $posts, 'ID' ) );
	
	// Do a new query with these IDs to get a properly-sorted list of posts
	$posts = get_posts( array(
		'post__in' => $postIds,
		'posts_per_page' => $amount,
		'order' => $order
	) );
?>

	<ul class="same-but-different related-posts <?php echo ( $show_thumbnail ) ? 'thumbnails' : ''; ?> <?php echo ( $show_title ) ? 'titles' : ''; ?>">
	<?php 
	$i = 0;
	foreach( $posts as $post ) : setup_postdata($post);
	?>
		<li class="related-post post-<?php the_ID(); ?>">
			<?php
			if ( $show_thumbnail ) {
				$thumbnail_id = get_post_thumbnail_id( $post->ID );
				$thumbnail_image = wp_get_attachment_image_src( $thumbnail_id, 'large' );
				
				if ( $thumbnail_id ) {
			?>
					<div class="background-image" style="background-image: url( '<?php echo esc_url( $thumbnail_image[0] ); ?>' );">
						<a href="<?php the_permalink() ?>"><img src="<?php echo $assets_url; ?>/images/image-size-3-2.png" class="placeholder" alt="<?php esc_attr( the_title() ); ?>" /></a>
					</div>
			<?php
				}
			}
			
			if ( $show_title ) {
				$title_classes 		= array();
				$title_link_classes = array();
				
				$title_classes[] = 'title';
				
				if ( $show_thumbnail ) {
					$title_classes[] = 'top-padded';
				}
				
				$title_heading_opening_tag = '';
				$title_heading_closing_tag = '';
				
				if ( $title_heading_tag ) {
					$title_heading_opening_tag = '<' . $title_heading_tag . ' class="' . esc_attr( implode( ' ', $title_classes ) ) . '">';
					$title_heading_closing_tag = '</' . $title_heading_tag . '>';
				} else {
					$title_link_classes = $title_classes;
				}
			?>
			
			<?php echo $title_heading_opening_tag; ?>
			<a href="<?php the_permalink() ?>" class="<?php echo esc_attr( implode( ' ', $title_link_classes ) ); ?>"><?php the_title(); ?></a>
			<?php echo $title_heading_closing_tag; ?>
			
			<?php
			}
			?>
		</li>
	
	<?php
	$i++;
	endforeach;
	
	// Prevent weirdness
	wp_reset_postdata();
	?>
	</ul>

<?php 
}
