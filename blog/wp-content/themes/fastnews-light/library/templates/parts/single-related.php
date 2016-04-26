<?php
if (is_single()) {
    $get_by = get_theme_mod('post_get_by', 'post_tag');
    if ('hide' != $get_by) {
        $limit = (int) get_theme_mod('post-relate-limit', '4');
        if ($limit > 0) {
            global $post;
            $taxs = array();
            if ('category' == $get_by) {
                $cats = get_the_category(($post->ID));
                if ($cats) {
                    $ids = array();
                    foreach ($cats as $cat) {
                        $ids[] = $cat->term_id;
                    }
                    $taxs [] = array(
                        'taxonomy' => 'category',
                        'field' => 'id',
                        'terms' => $ids
                    );
                }
            } else {
                $tags = get_the_tags($post->ID);
                if ($tags) {
                    $ids = array();
                    foreach ($tags as $tag) {
                        $ids[] = $tag->term_id;
                    }
                    $taxs [] = array(
                        'taxonomy' => 'post_tag',
                        'field' => 'id',
                        'terms' => $ids
                    );
                }
            }

            if ($taxs) {
                $related_args = array(
                    'tax_query' => $taxs,
                    'post__not_in' => array($post->ID),
                    'posts_per_page' => $limit
                );
                $related_posts = new WP_Query( $related_args );
                if ( $related_posts->have_posts() ) {
                    $post_index = 1;
                    ?>
                <div class="kopa-related-post">
                    <?php
                        $relate_title = get_theme_mod('post-relate-title', esc_attr__('Related Articles', 'fastnews-light'));
                        if ( ! empty($relate_title) )  :
                    ?>
                        <h3><?php echo esc_html( $relate_title ); ?></h3>
                        <?php endif; ?>
                    <ul class="clearfix">
                        <?php while ( $related_posts->have_posts() ) {
                        $related_posts->the_post(); ?>
                        <li>
                            <article class="entry-item clearfix">
                                <?php if ( has_post_thumbnail() ) { ?>
                                <div class="entry-thumb">
                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo kopa_get_image_src(get_the_ID(), 'article-list-sm-image-size'); ?>" alt="<?php echo get_the_title(); ?>" ></a>
                                </div>
                                <?php } // endif ?>
                                <div class="entry-content">
                                    <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <span class="entry-date"><span class="kopa-minus"></span> <?php the_time( get_option( 'date_format' ) ); ?></span>
                                </div>
                            </article>
                        </li>
                        <?php
                        if ( $post_index % 2 == 0 ) {
                            echo '<div class="clear"></div>';
                        }

                        $post_index++;
                        ?>
                        <?php } // endwhile ?>
                    </ul>
                </div><!--kopa-related-post-->
                <?php
                } // endif
                wp_reset_postdata();
            }
        }
    }
}