<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        get_template_part('library/templates/parts/format-single', get_post_format());
        ?>
    <?php if (get_the_terms(get_the_ID(), 'post_tag') && 1 == get_theme_mod('post_tag_status', '1') ) { ?>
        <div class="tag-box">
            <span><?php echo esc_html('Tagged with:', 'fastnews-light'); ?></span>
            <?php the_tags('', ' ', ''); ?>
        </div><!--tag-box-->
    <?php } // endif ?>

    <?php
        if ( 1 == get_theme_mod('post_author_status', '1') ) {
            get_template_part('library/templates/parts/single-author');
        }

        get_template_part('library/templates/parts/single-related');

        if(comments_open() ){
            comments_template();
        }
        ?>

    <?php
    } // endwhile
} // endif


