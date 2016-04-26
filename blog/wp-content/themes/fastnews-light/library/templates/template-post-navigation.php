<?php 
$prev_post = get_previous_post(); 
if ( ! empty( $prev_post ) ) { ?>
    <p class="prev-post">
        <a href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>">&laquo;&nbsp;<?php echo esc_html( 'Previous Article', 'fastnews-light' ); ?></a>
        <a class="article-title" href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>"><?php echo esc_html($prev_post->post_title); ?></a>
    </p>
<?php } // endif ?>

<?php
$next_post = get_next_post();
if ( ! empty( $next_post ) ) { ?>
    <p class="next-post">
        <a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><?php echo esc_html( 'Next Article', 'fastnews-light' ); ?>&nbsp;&raquo;</a>
        <a class="article-title" href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><?php echo esc_html($next_post->post_title); ?></a>
    </p>
<?php } // endif ?>