<?php
if ( !defined('ABSPATH')) exit;

// check if post is pwd protected
if ( post_password_required() || !comments_open() ) {
    return;
}
/*
 * Comments call back function
 */
if(!function_exists('kopa_comments_callback')){
    function kopa_comments_callback($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;

        if ( 'pingback' == get_comment_type() || 'trackback' == get_comment_type() ) { ?>

        <li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment-wrap clearfix">

                <div class="comment-body clearfix">
                    <header class="clearfix">
                        <div class="comment-meta">
                            <span class="author"><?php echo esc_html( 'Pingback', 'fastnews-light' ); ?></span>
                        </div>

                        <div class="comment-button">
                            <?php if ( current_user_can( 'moderate_comments' ) ) {
                            edit_comment_link( esc_attr__( 'Edit', 'fastnews-light' ) );
                        } ?>
                        </div>

                    </header>

                    <p><?php comment_author_link(); ?></p>

                </div><!--comment-body -->

            </article>
        </li>

        <?php } elseif ( 'comment' == get_comment_type() ) { ?>

        <li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment-wrap clearfix">
                <div class="comment-avatar">
                    <?php if ( get_comment_author_url() ) { ?>
                        <a href="<?php comment_author_url(); ?>">
                    <?php } ?>

                    <?php echo get_avatar($comment->comment_author_email, 82); ?>

                    <?php if ( get_comment_author_url() ) { ?>
                        </a>
                    <?php } ?>
                </div>
                <div class="comment-body clearfix">
                    <header class="clearfix">
                        <div class="comment-meta">
                            <span class="author"><?php comment_author(); ?></span>
                            <span class="date"><?php comment_time( get_option('date_format') ); ?> <?php echo esc_html( 'at', 'fastnews-light' ); ?> <?php comment_time( get_option('time_format') ); ?></span>
                        </div>
                        <div class="comment-button">
                            <?php if ( current_user_can( 'moderate_comments' ) ) { ?>
                            <?php edit_comment_link( esc_attr__( 'Edit', 'fastnews-light' ) ); ?>
                            <span>/</span>
                            <?php } ?>
                            <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                        </div>
                    </header>

                    <?php comment_text(); ?>
                </div><!--comment-body -->
            </article>
        </li>

        <?php
        } // endif check comment type
    }
}
if(!function_exists('kopa_comment_form_args')){
    function kopa_comment_form_args() {
        global $user_identity;
        $commenter = wp_get_current_commenter();

        $fields = array(
            'author' => '<p class="input-block">               
                <label class="required" for="comment_name" >' . esc_attr__("Name <span>(required):</span>", 'fastnews-light') . '</label>
                <input type="text" name="author" id="comment_name"                 
                value="' . esc_attr($commenter['comment_author']) . '">                                               
                </p>',
            'email' => '<p class="input-block">   
                <label for="comment_email" class="required">' . esc_attr__("Email <span>(required):</span>", 'fastnews-light') . '</label>
                <input type="email" name="email" id="comment_email"                                                                 
                value="' . esc_attr($commenter['comment_author_email']) . '" >
                </p>',
            'url' => '<p class="input-block">   
                <label for="comment_url" class="required">' . esc_attr__("Website", 'fastnews-light') . '</label>
                <input type="url" name="url" id="comment_url"                 
                value="' . esc_attr($commenter['comment_author_url']) . '" >
                </p>'
        );

        $comment_field = '<p class="textarea-block">
        <label class="required" for="comment_message">' . esc_attr__('Your comment <span>(required):</span>', 'fastnews-light') . '</label>
        <textarea name="comment" id="comment_message"></textarea>
        </p>';

        $args = array(
            'fields' => apply_filters('comment_form_default_fields', $fields),
            'comment_field' => $comment_field,
            'must_log_in' => '<p class="alert">' . sprintf('%1$s <a href="%2$s" title="Log in">%3$s</a> %4$s', esc_attr__('You must be', 'fastnews-light'), wp_login_url(get_permalink()), esc_attr__('logged in', 'fastnews-light'), esc_attr__('to post a comment.', 'fastnews-light')) . '</p><!-- .alert -->',
            'logged_in_as' => '<p class="log-in-out">' . sprintf('%1$s <a href="%2$s" title="%3$s">%3$s</a>.', esc_attr__('Logged in as', 'fastnews-light'), admin_url('profile.php'), esc_attr($user_identity)) . ' <a href="' . wp_logout_url(get_permalink()) . '" title="' . esc_attr__('Log out of this account', 'fastnews-light') . '">' . esc_attr__('Log out &raquo;', 'fastnews-light') . '</a></p><!-- .log-in-out -->',
            'comment_notes_before' => '<span class="c-note">'. esc_attr__('Your email address will not be published. Required fields are marked', 'fastnews-light'). ' <strong>*</strong></span>',
            'comment_notes_after' => '',
            'id_form' => 'comments-form',
            'id_submit' => 'submit-comment',
            'title_reply' => esc_attr__('Leave a reply', 'fastnews-light'),
            'title_reply_to' => esc_attr__('Reply', 'fastnews-light'),
            'cancel_reply_link' => sprintf('<span class="title-text">%1$s</span>', esc_attr__('Cancel', 'fastnews-light')),
            'label_submit' => esc_attr__('Post Comment', 'fastnews-light')
        );

        return $args;
    }
}

if ( have_comments() ) { ?>
<div id="comments">
    <h3><?php comments_number(esc_attr__('No Comments', 'fastnews-light'), esc_attr__('1 Comment', 'fastnews-light'), esc_attr__('% Comments', 'fastnews-light')); ?></h3>
    <ol class="comments-list clearfix">
        <?php
        wp_list_comments(array(
            'walker' => null,
            'style' => 'ul',
            'callback' => 'kopa_comments_callback',
            'end-callback' => null,
            'type' => 'all'
        ));
        ?>
    </ol>
    <center class="pagination kopa-comment-pagination"><?php paginate_comments_links(); ?></center>
    <div class="clear"></div>
</div>
<?php } elseif ( ! comments_open() && post_type_supports(get_post_type(), 'comments') ) {
    return;
} // endif
comment_form(kopa_comment_form_args());
