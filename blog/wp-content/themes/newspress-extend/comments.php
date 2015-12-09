<?php
/* 	News Press's Comments Area for Single Pages
	Copyright: 2014, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since NewsPress 1.0
*/

	if ( post_password_required() ) { return; }
?>

<div id="commentsbox">
<?php if ( have_comments() ) : ?>
	<h2 class="comments"><?php comments_number(of_get_option ('nocomments', 'No Comments') . '', of_get_option ('1comment', 'One Comment'), '% ' . of_get_option ('comments', 'Comments') . '' );  echo ' ' . of_get_option ('to2', ' to'); ?> <a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
	<ol class="commentlist">
		<?php wp_list_comments( array( 'avatar_size' => '200' )  ); ?>
	</ol>
	<div class="comment-nav">
		<div class="floatleft">
			<?php previous_comments_link() ?>
		</div>
		<div class="floatright">
			<?php next_comments_link() ?>
		</div>
	</div>
<?php else : ?>
	<?php if ( ! comments_open() && ! is_page() ) : ?>
		<p class="watermark"><?php echo of_get_option ('cac', 'Comments are Closed'); ?></p>
	<?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
	<div id="comment-form">
		<?php 
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		
		$newspress_comment_args = array(
  		'id_form'           => 'commentform',
  		'id_submit'         => 'submit',
  		'title_reply'       => of_get_option ('lar', 'Leave a Reply'),
  		'title_reply_to'    => of_get_option ('lart', 'Leave a Reply to') . ' %s',
  		'cancel_reply_link' => of_get_option ('crply', 'Cancel Reply'),
  		'label_submit'      => of_get_option ('pcmnt', 'Post Comment'),

  'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . of_get_option ('commentsin', 'Comment:') .'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"> </textarea></p>',

  'must_log_in' => '<p class="must-log-in">' . sprintf( of_get_option ('mbli', 'For Posting a Comment You must be') .' <a href="%s"> ' . of_get_option ('loggedin', 'Logged In') .'</a>.', wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',

  'logged_in_as' => '<p class="logged-in-as">' . sprintf( of_get_option ('lias', 'Logged In as ') .' <a href="%1$s">%2$s</a>, <a href="%3$s" title="' . of_get_option ('lota', 'Log out of this account') .'">' . of_get_option ('loout', 'Log out?') .'</a>', admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',

  'comment_notes_before' => '<p class="comment-notes">' .  of_get_option ('yewnbs', 'Your email address will not be published. Required fields are marked as') . '  <span class="required">*</span></p>',

  'comment_notes_after' => '',

  'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' => '<p class="comment-form-author">' . '<label for="author">' . of_get_option ('comntname', 'Name:') .' ', '' . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>', 

    'email' => '<p class="comment-form-email"><label for="email">' . of_get_option ('comntemail', 'E-Mail:') .' ', '' . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',

    'url' => '<p class="comment-form-url"><label for="url">' . of_get_option ('comntweb', 'Website:') .' ', '' . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'
	
    )
  ),
);
		
	
		
		comment_form($newspress_comment_args); ?>
	</div>
<?php endif; ?>
</div>
