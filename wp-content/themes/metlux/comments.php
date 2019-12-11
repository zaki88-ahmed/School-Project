<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package metlux
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="metlux-comments">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="content-title">
			<?php
			$comments_number = get_comments_number();
			if ( 1 === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'metlux' ), get_the_title() );
			} else {
				printf(
				/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'metlux'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'metlux' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'metlux' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'metlux' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ul>
			<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'short_ping' => true,
				) );
			?>
		</ul><!-- .comment-list -->

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'metlux' ); ?></p>
	<?php endif; ?>

	<?php 
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
	$comments_args = array(
        
         'comment_field' => '<div class="col-sm-12"><div class="single"><p class="comment-form-comment"><textarea class="form-control" name="comment" aria-required="true" placeholder="'.__('Leave your message','metlux').'" rows="5" cols="37" wrap="hard"></textarea></p></div></div>',
		'fields' => apply_filters( 'comment_form_default_fields', array(
			
    'author' =>
      '<div class="col-sm-4"><div class="single"><p class="comment-form-author">' .
      '<input id="author" class ="form-control" placeholder="'.__('Name','metlux').'*" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"</p></div></div>',

    'email' =>
      '<div class="col-sm-4"><div class="single"><p class="comment-form-email">' .
      '<input id="email" class="form-control" placeholder="'.__('Email','metlux').'*" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"</p></div></div>',

    'url' =>
      '<div class="col-sm-4"><div class="single"><p class="comment-form-url">' .
      '<input id="url" class="form-control" placeholder="'.__('URL','metlux').'" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /></p></div></div>'

    )
  ),
);
	comment_form($comments_args); ?>

</div><!-- #comments -->
