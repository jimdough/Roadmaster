
<?php
global $kopa_setting;
if ( is_page(get_the_ID()) && have_posts() ) {
    while ( have_posts() ) {
        the_post();
        $page_title = get_the_title();
        if ( empty($page_title) ) {
            $page_title = esc_attr__('No title', 'fastnews-light');
        }
        ?>
    <?php ?>
    <article class="kopa-single-page clearfix" id="page-<?php the_ID(); ?>">
        <h3 class="entry-cat-title h1"><?php echo esc_html($page_title); ?></h3>
        <?php the_content(); ?>
    </article>

    <div class="kopa-pagelink clearfix">
        <?php wp_link_pages( array(
                    'before'   => '<p>',
                    'after'    => '</p>',
                    'pagelink' => esc_attr__( 'Page %', 'fastnews-light' )
                ) );
        ?>
    </div>

    <?php comments_template(); ?>

    <?php } // endwhile
} // endif