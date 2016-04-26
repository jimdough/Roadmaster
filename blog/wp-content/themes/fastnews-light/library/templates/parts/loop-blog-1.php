<?php
if ( is_front_page() || 1 == get_theme_mod('kopa_theme_options_display_blog_slider', '0') ) {
    get_template_part( 'library/templates/parts/blog-slider' );
}
?>

<ul class="entry-list isotop-item clearfix">
    <?php if ( have_posts() ) {
        while ( have_posts() ) {
            the_post(); ?>

            <li class="element">
                <?php
                $item_cls = 'entry-item clearfix';
                if ( is_sticky(get_the_ID()) ) {
                    $item_cls .= ' sticky-post';
                }
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( $item_cls ); ?>>
                    <?php if ( has_post_thumbnail() && 1 == get_theme_mod('blog_thumbnail_status', '1') ) { ?>
                        <div class="entry-thumb">
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo kopa_get_image_src(get_the_ID(), 'medium'); ?>" alt="<?php echo get_the_title(); ?>"></a>
                        </div>
                        <!-- entry-thumb -->
                    <?php
                    if ( is_sticky(get_the_ID()) ) {
                        echo '<span class="sticky-post-icon"><i class="fa fa-flash"></i></span>';
                    }
                    ?>
                    <?php } // endif ?>
                    <div class="entry-content">
                        <header>
                            <?php
                                $post_class = 'entry-title';
                                if ( is_sticky() && ! has_post_thumbnail() ) {
                                    $post_class .= 'sticky-title';
                                }
                                $post_title = get_the_title();
                                if ( empty($post_title)) {
                                    $post_title = esc_attr__('No title', 'fastnews-light');
                                }
                            ?>
                            <h4 class="<?php echo esc_attr($post_class); ?>"><a href="<?php the_permalink(); ?>"><?php echo (!is_search())? $post_title : kopa_search_title();  ?></a></h4>
                            <?php if ( 1 == get_theme_mod('blog_date_status', '1') ) : ?>
                                <span class="entry-date"><a href="<?php the_permalink(); ?>">&mdash; <?php the_time( get_option( 'date_format' ) ); ?></a></span>
                            <?php endif; ?>
                        </header>
                        <?php
                            if ( 1 == get_theme_mod('blog_excerpt_status', '1') ) {
                                the_excerpt();
                            }
                        ?>
                        <?php if ( 1 == get_theme_mod('blog_readmore_status', '1') ) : ?>
                            <a href="<?php the_permalink(); ?>" class="more-link"><?php echo esc_attr_e( 'Continue Reading ...', 'fastnews-light' ); ?></a>
                        <?php endif;?>
                    </div>
                    <!-- entry-content -->
                </article>
                <!-- entry-item -->
            </li>

        <?php } // endwhile
    } // endif ?>
</ul>

<!-- pagination -->
<?php get_template_part('library/templates/template', 'pagination'); ?>