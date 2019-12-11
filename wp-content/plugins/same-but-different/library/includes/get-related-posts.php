<?php
global $post, $categories, $tags;

if ( is_archive() || is_home() ) {
	return;
}

$posts = array();

if ( $relate_by_categories ) {
	// Get the categories of the current post
	if ( !$categories || count( $categories ) == 0 ) $categories = wp_get_post_categories( $post->ID );
}

if ( $relate_by_tags ) {
	// Get the tags of the current post
	if ( !$tags || count($tags) == 0 ) $tags = wp_get_post_tags( $post->ID );
	
	// Get the slugs of the tags of the current post
	$tagSlugs = array();
	for ($i=0; $i<count($tags); ++$i) {
		$tagSlugs[$i] = $tags[$i]->slug;
	}
}

// If the current post has no categories or tags then do nothing
if ( ( !$categories || count( $categories ) == 0 ) && ( !$tags || count( $tags ) == 0 ) ) {
	return;
}

// Create your base query argument array
$query_args = array(
	'posts_per_page' => 100,
	'exclude' => $post->ID // exclude the current post
);

// Posts by Categories
$postsByCategory = array();

if ( $relate_by_categories && count( $categories ) > 0 ) {
	$postsByCategoryArgs = $query_args;
	
	// Only get posts in the same categories
	$postsByCategoryArgs['category'] = implode( ',', $categories );

	$postsByCategory = get_posts( $postsByCategoryArgs );
}

// Posts by Tags
$postsByTag = array();

if ( $relate_by_tags && count( $tags ) > 0 ) {
	$postsByTagArgs = $query_args;

	// Only get posts with the same tags
	$postsByTagArgs['tax_query'] = array(
		array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => $tagSlugs
		)
	);
	
	$postsByTag = get_posts( $postsByTagArgs );
}

// Prepare the final lists of related posts to select from
$posts = array_merge ( $postsByCategory, $postsByTag );

if ( empty($posts) ) {
	return;
}
