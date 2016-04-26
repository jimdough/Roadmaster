<?php 
if ( is_front_page() || 1 == get_theme_mod('kopa_theme_options_display_blog_slider', '0') ) {
    get_template_part( 'library/templates/parts/blog-slider' );
}
?>

<?php if ( have_posts() ) {

    /* for first post
    ----------------------------------------
    */
    $post_index = 1;
    while ( have_posts() ) {
        the_post(); ?>

        <?php if ( 1 == $post_index ) { ?>
            <div class="latest-entry-item">
                <?php
                $item_cls = 'entry-item clearfix';
                if ( is_sticky(get_the_ID()) ) {
                    $item_cls .= ' sticky-post';
                }
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( $item_cls ); ?>>
                    <?php if ( has_post_thumbnail() && 1 == get_theme_mod('blog_thumbnail_status', '1') ) { ?>
                        <div class="entry-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                            <?php
                            if ( is_sticky(get_the_ID()) ) {
                                echo '<span class="sticky-post-icon"><i class="fa fa-flash"></i></span>';
                            }
                            ?>
                        </div>
                        <!-- entry-thumb -->
                    <?php } // endif ?>
                    <!-- entry-thumb -->
                    <div class="entry-content">
                        <header>
                            <?php
                            $post_class = 'entry-title';
                            if ( is_sticky() && ! has_post_thumbnail() ) {
                                $post_class .= ' sticky-title';
                            }
                            $post_title = get_the_title();
                            if ( empty($post_title)) {
                                $post_title = esc_attr__('No title', 'fastnews-light');
                            }
                            ?>
                            <h4 class="<?php echo esc_attr($post_class); ?>"><a href="<?php the_permalink(); ?>"><?php echo (!is_search())? $post_title: kopa_search_title();  ?></a></h4>
                            <?php if ( 1 == get_theme_mod('blog_date_status', '1') ) : ?>
                                <span class="entry-date"><a href="<?php the_permalink(); ?>">&mdash; <?php the_time( get_option( 'date_format' ) ); ?></a></span>
                            <?php endif;?>
                        </header>
                        <?php
                        if ( 1 == get_theme_mod('blog_excerpt_status', '1') ) {
                            the_excerpt();
                        }
                        ?>
                        <?php if ( 1 == get_theme_mod('blog_readmore_status', '1') ) : ?>
                            <a href="<?php the_permalink(); ?>" class="more-link"><?php echo esc_html( 'Continue Reading ...', 'fastnews-light' ); ?></a>
                        <?php endif; ?>
                    </div>
                    <!-- entry-content -->
                </article>
                <!-- entry-item -->
            </div>
            <!-- latest-entry-item-->
        <?php } ?>

    <?php $post_index++;
    } // endwhile



    /* for even posts
    ----------------------------------------
    */
    $post_index = 1;
    echo '<ul class="entry-list l-entry-list clearfix">';
    while ( have_posts() ) {
        the_post(); ?>

        <?php if ( $post_index != 1 && $post_index % 2 == 0 ) { ?>
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
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                            <?php
                            if ( is_sticky(get_the_ID()) ) {
                                echo '<span class="sticky-post-icon"><i class="fa fa-flash"></i></span>';
                            }
                            ?>
                        </div>
                        <!-- entry-thumb -->
                    <?php } // endif ?>
                    <div class="entry-content">
                        <header>
                            <?php
                            $post_class = 'entry-title';
                            if ( is_sticky() && ! has_post_thumbnail() ) {
                                $post_class .= ' sticky-title';
                            }
                            $post_title = get_the_title();
                            if ( empty($post_title)) {
                                $post_title = esc_attr__('No title', 'fastnews-light');
                            }
                            ?>
                            <h4 class="<?php echo esc_attr($post_class); ?>"><a href="<?php the_permalink(); ?>"><?php echo (!is_search())? $post_title: kopa_search_title();  ?></a></h4>
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
                        <a href="<?php the_permalink(); ?>" class="more-link"><?php echo esc_html( 'Continue Reading ...', 'fastnews-light' ); ?></a>
                        <?php endif; ?>
                    </div>
                    <!-- entry-content -->
                </article>
                <!-- entry-item -->
            </li>
        <?php } ?>

    <?php $post_index++;
    } // endwhile
    echo '</ul> <!-- l-entry-list -->';



    /* for odd posts
    ----------------------------------------
    */
    $post_index = 1;
    echo '<ul class="entry-list r-entry-list clearfix">';
    while ( have_posts() ) {
        the_post(); ?>

        <?php if ( $post_index != 1 && $post_index % 2 != 0 ) { ?>
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
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                            <?php
                                if ( is_sticky(get_the_ID()) ) {
                                    echo '<span class="sticky-post-icon"><i class="fa fa-flash"></i></span>';
                                }
                            ?>
                        </div>
                        <!-- entry-thumb -->
                    <?php } // endif ?>
                    <div class="entry-content">
                        <header>
                            <?php
                            $post_class = 'entry-title';
                            if ( is_sticky() && ! has_post_thumbnail() ) {
                                $post_class .= ' sticky-title';
                            }
                            $post_title = get_the_title();
                            if ( empty($post_title)) {
                                $post_title = esc_attr__('No title', 'fastnews-light');
                            }
                            ?>
                            <h4 class="<?php echo esc_attr($post_class); ?>"><a href="<?php the_permalink(); ?>"><?php echo (!is_search())? $post_title: kopa_search_title();  ?></a></h4>
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
                        <?php endif; ?>
                    </div>
                    <!-- entry-content -->
                </article>
                <!-- entry-item -->
            </li>
        <?php } ?>

    <?php $post_index++;
    } // endwhile
    echo '</ul> <!-- r-entry-list -->';
    echo '<div class="clear"></div>';
} else {
    echo esc_attr__('No item found!', 'fastnews-light');
}

// endif ?>

<!-- pagination -->
<?php get_template_part('library/templates/template', 'pagination'); ?>