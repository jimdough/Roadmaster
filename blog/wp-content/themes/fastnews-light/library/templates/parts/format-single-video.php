<div id="post-<?php the_ID(); ?>" <?php post_class('entry-box'); ?>>



    <div class="elements-box">
        <div class="video-container">
            <?php the_content(); ?>
        </div>
        <header>
            <?php
                $post_title = get_the_title();
                if ( empty($post_title) ) {
                    $post_title = esc_attr__('No title', 'fastnews-light');
                }
            ?>
            <h4 class="entry-title"><?php echo esc_html($post_title); ?></h4>
            <?php if ( 1 == get_theme_mod('post_date_status', '1') ) : ?>
            <span class="entry-date">&mdash; <?php the_time( get_option( 'date_format' ) ); ?></span>
            <?php endif; ?>
        </header>
    </div>

    <div class="kopa-pagelink clearfix">
        <?php wp_link_pages( array(
            'before'   => '<p>',
            'after'    => '</p>',
            'pagelink' => esc_attr__( 'Page %', 'fastnews-light' )
        ) ); ?>
    </div> <!-- .wp-link-pages -->

    <?php if ( 1 == get_theme_mod('post_navigation_status', '1') ) : ?>
        <footer class="clearfix">
            <?php get_template_part( 'library/templates/template', 'post-navigation' ); ?>
        </footer>
    <?php endif; ?>

</div><!--entry-box-->