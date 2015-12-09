<?php
/**
 * The template for displaying comment form.
 *
 * @package xinmag
 * @since xinmag 1.0
 */
// No comments and comment is not open
	if ( ! have_comments() && ! comments_open() )
		return;
?>
<div id="comments" class="comments-area clearfix">
<?php
	if ( post_password_required() ) { ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'xinmag' ); ?></p></div>
<?php	return;
	}
	if ( have_comments() ) { ?>
		<h4 class="comments-title">
		<?php
			printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'xinmag' ),
			number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );	?>
		</h4>
<?php	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
  	 	// Comments navigate ?>
			<nav id="comment-nav-above" class="site-navigation comment-navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'xinmag' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'xinmag' ) ); ?></div>
			</nav>
<?php 	} ?>

		<ol class="commentlist">
<?php		wp_list_comments( array( 'callback' => 'xinwp_comment' ) ); ?>
		</ol>

<?php 	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { 		// Comments Navigation  ?>
			<nav id="comment-nav-below" class="site-navigation comment-navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'xinmag' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'xinmag' ) ); ?></div>
			</nav>
<?php 	}
	}
	comment_form(); ?>
</div>