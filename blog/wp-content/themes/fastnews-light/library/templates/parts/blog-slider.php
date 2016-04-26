<?php
$kopa_setting = fastnews_get_template_setting();
$sidebars = $kopa_setting['sidebars'];

if ( is_active_sidebar($sidebars['position_16']) ) {
    $kopa_blog_slider_image_size = 'flexslider-image-size';
    $default_thumb = '720x480';
} else {
    $kopa_blog_slider_image_size = 'flexslider-image-size';
    $default_thumb = '1061x707';
}


// get options
$kopa_blog_slider_category_id = (int) get_theme_mod( 'kopa_theme_options_blog_slider_category_id', '' );
$kopa_theme_options_blog_slider_posts_number = (int) get_theme_mod( 'kopa_theme_options_blog_slider_posts_number', '3' );
$kopa_blog_slider_settings = array(
    'animation'       => get_theme_mod( 'kopa_theme_options_blog_slider_effect', 'slide' ),
    'slideshow_speed' => (int) get_theme_mod( 'kopa_theme_options_blog_slider_slideshow_speed', '7000' ),
    'animation_speed' => (int) get_theme_mod( 'kopa_theme_options_blog_slider_animation_speed', '600' ),
    'autoplay'        => get_theme_mod( 'kopa_theme_options_blog_slider_autoplay', 'false' )
);

// new query posts
$kopa_blog_slider_posts = new WP_Query( array(
    'cat'            => $kopa_blog_slider_category_id,
    'posts_per_page' => $kopa_theme_options_blog_slider_posts_number,
) );

if ( $kopa_blog_slider_posts->have_posts() && 1 == get_theme_mod( 'kopa_theme_options_display_blog_slider', '1' ) ) { ?>
    <div class="kp-slider-widget widget">
        <div class="home-slider flexslider loading" data-animation="<?php echo esc_attr($kopa_blog_slider_settings['animation']); ?>" data-slideshow_speed="<?php echo esc_attr($kopa_blog_slider_settings['slideshow_speed']); ?>" data-animation_speed="<?php echo esc_attr($kopa_blog_slider_settings['animation_speed']); ?>" data-autoplay="<?php echo esc_attr($kopa_blog_slider_settings['autoplay']); ?>" data-direction="horizontal">
            <ul class="slides">
            <?php while ( $kopa_blog_slider_posts->have_posts() ) { 
                $kopa_blog_slider_posts->the_post();
                $post_title = get_the_title();
                if ( empty($post_title) ) {
                    $post_title = esc_attr__('No title', 'fastnews-light');
                }
                ?>
               
                    <li>
                        <article>
							<?php if ( has_post_thumbnail() ) {
                                the_post_thumbnail($kopa_blog_slider_image_size);
                            } else { ?>
							    <img src="//placehold.it/<?php echo esc_attr($default_thumb); ?>" alt="<?php echo get_the_title();?>">
							<?php
							} // endif ?>
                            <div class="flex-caption">
                                <header>
                                    <span class="entry-categories"><?php echo esc_html( 'in:', 'fastnews-light' ); ?> <?php the_category( ', '); ?></span>
                                    <span class="entry-met">&nbsp;|&nbsp;</span>
                                    <span class="entry-date"><a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span>
                                </header>
                                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html($post_title); ?></a></h2>
                                <?php the_excerpt(); ?>
                            </div>
                            <!-- flex-caption -->
                        </article>
                    </li>
                
            <?php } // endwhile ?>
            </ul>
        </div>
    </div>
<?php } // endif

wp_reset_postdata();
