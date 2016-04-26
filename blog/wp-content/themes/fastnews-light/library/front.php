<?php

add_action( 'after_setup_theme', 'kopa_front_after_setup_theme' );

function kopa_front_after_setup_theme() {
    kopa_i18n();
    add_theme_support( 'post-formats', array( 'gallery', 'audio', 'video' ) );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support('loop-pagination');
    add_theme_support( "title-tag" );

    register_nav_menus(array(
        'main-nav'   => esc_attr__( 'Main Menu', 'fastnews-light' ),
        'footer-nav' => esc_attr__( 'Footer Menu', 'fastnews-light' )
    ));

    global $content_width;
    if ( ! isset( $content_width ) ) {
        $content_width = 1061;
    }

    if ( ! is_admin() ){
        add_filter( 'wp_title', 'kopa_wp_title', 10, 2 );
        add_action( 'wp_enqueue_scripts', 'kopa_enqueue_script' );
        add_filter('body_class', 'kopa_body_class');
    }

    $sizes = array(
        'flexslider-image-size'   => array(720, 480, TRUE, esc_attr__('Flexslider Post Image (Kopatheme)', 'fastnews-light')),
        'flexslider-image-size-full'   => array(1061, 707, TRUE, esc_attr__('Flexslider Post Image (Kopatheme)', 'fastnews-light')),
        'article-list-image-size' => array(300, 277, TRUE, esc_attr__('Article List Post Image (Kopatheme)', 'fastnews-light')),
        'article-list-sm-image-size' => array(120, 120, TRUE, esc_attr__('Article List Small Post Image (Kopatheme)', 'fastnews-light')),
        'article-carousel-image-size' => array(354, 354, TRUE, esc_attr__('Article Carousel Post Image (Kopatheme)', 'fastnews-light')),
        'entry-list-image-size' => array(227, 182, TRUE, esc_attr__('Entry List Thumbnail Image (Kopatheme)', 'fastnews-light')),
        'blog-image-size' => array(680, 419, TRUE, esc_attr__('Blog Image Size (Kopatheme)', 'fastnews-light')),

    );
    $sizes = apply_filters('kopa_get_image_sizes', $sizes);

    foreach ($sizes as $slug => $details) {
        add_image_size($slug, $details[0], $details[1], $details[2]);
    }

    // customize filter
    add_filter('kopa_customization_init_options', 'fastnews_light_init_options');
    add_filter( 'excerpt_length', 'fastnews_light_custom_excerpt_length', 999 );
    add_filter( 'embed_oembed_html', 'fastnews_light_remove_oembed_attributes', 10, 4 );
}

function kopa_i18n() {
    load_theme_textdomain('fastnews-light', get_template_directory() . '/languages');
}

/**
 * @package Kopa
 * @subpackage Fastnews Light
 * @author: kopatheme
 * @description: Load stylesheet, javascript file and localization variables
 */
function kopa_enqueue_script() {
    if ( ! is_admin() ) {
        global $wp_styles, $is_IE;
        $dir = get_template_directory_uri();

        wp_enqueue_style('kopa-bootstrap', $dir . '/css/bootstrap.css', array(), NULL, 'screen');
        wp_enqueue_style('kopa-fontawesome', $dir . '/css/font-awesome.css', array(), NULL);
        wp_enqueue_style('kopa-superfish', $dir . '/css/superfish.css', array(), NULL, 'screen');
        wp_enqueue_style('kopa-flexlisder', $dir . '/css/flexslider.css', array(), NULL, 'screen');
        wp_enqueue_style('kopa-prettyPhoto', $dir . '/css/prettyPhoto.css', array(), NULL, 'screen');
        wp_enqueue_style('kopa-style', get_stylesheet_uri(), array(), NULL);
        wp_enqueue_style('kopa-responsive', $dir . '/css/responsive.css', array(), NULL);

        if ( $is_IE ) {
            wp_register_style('kopa-ie', $dir . '/css/ie.css', array(), NULL);
            $wp_styles->add_data('kopa-ie', 'conditional', 'lt IE 9');
            wp_enqueue_style('kopa-ie');
        }

        /* JAVASCRIPTs */
        wp_enqueue_script('kopa-google-api', '//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js', array(), NULL, TRUE);
        wp_localize_script('jquery', 'kopa_front_variable', kopa_front_localize_script());
        wp_enqueue_script('kopa-superfish-js', $dir . '/js/superfish.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-retina', $dir . '/js/retina.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-bootstrap-js', $dir . '/js/bootstrap.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-carouFredSel', $dir . '/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery'), '6.2.1', TRUE);
        wp_enqueue_script('kopa-flexlisder-js', $dir . '/js/jquery.flexslider-min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-prettyPhoto-js', $dir . '/js/jquery.prettyPhoto.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-modernizr-transitions', $dir . '/js/modernizr-transitions.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-imagesloaded', $dir . '/js/imagesloaded.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-masonry', $dir . '/js/masonry.pkgd.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-jquery-validate', $dir . '/js/jquery.validate.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('jquery-form', null, array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-set-view-count', $dir . '/js/set-view-count.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-custom-js', $dir . '/js/custom.js', array('jquery'), NULL, TRUE);

        // send localization to frontend
        wp_localize_script('kopa-custom-js', 'kopa_custom_front_localization', kopa_custom_front_localization());

        if (is_single() || is_page()) {
            wp_enqueue_script('comment-reply');
        }
    }
}

function kopa_front_localize_script() {
    $kopa_variable = array(
        'ajax' => array(
            'url' => admin_url('admin-ajax.php')
        ),
        'template' => array(
            'post_id' => (is_singular()) ? get_queried_object_id() : 0
        )
    );
    return $kopa_variable;
}

/**
 * @package Kopa
 * @subpackage Fastnews Light
 * @author: kopatheme
 * @description: Pass localization variables to js
 */
function kopa_custom_front_localization() {
    $front_localization = array(
        'validate' => array(
            'form' => array(
                'submit'  => esc_attr__('Submit', 'fastnews-light'),
                'sending' => esc_attr__('Sending...', 'fastnews-light')
            ),
            'name' => array(
                'required'  => esc_attr__('Please enter your name.', 'fastnews-light'),
                'minlength' => esc_attr__('At least {0} characters required.', 'fastnews-light')
            ),
            'email' => array(
                'required' => esc_attr__('Please enter your email.', 'fastnews-light'),
                'email'    => esc_attr__('Please enter a valid email.', 'fastnews-light')
            ),
            'url' => array(
                'required' => esc_attr__('Please enter your url.', 'fastnews-light'),
                'url'      => esc_attr__('Please enter a valid url.', 'fastnews-light')
            ),
            'message' => array(
                'required'  => esc_attr__('Please enter a message.', 'fastnews-light'),
                'minlength' => esc_attr__('At least {0} characters required.', 'fastnews-light')
            )
        )
    );

    return $front_localization;
}

/**
 * @package Kopa
 * @subpackage Fastnews Light
 * @author: kopatheme
 * @description: get custom body class
 */
function kopa_body_class($classes) {
    $template_setting = fastnews_get_template_setting();
    if (is_front_page()) {
        $classes[] = 'home-page';
    } else {
        $classes[] = 'sub-page';
    }
    $sidebars = $template_setting['sidebars'];
    if ( ! is_active_sidebar($sidebars['position_16']) ) {
        $classes[] = 'kp-fullwidth-page';
    }

    $classes[] = 'kp-layout-'.$template_setting['layout_id'];
    switch ($template_setting['layout_id']) {
        case 'blog':
            $classes[] = 'kp-categories-1';
            break;
        case 'blog-2':
            $classes[] = 'kp-categories-2';
            break;
        case 'blog-3':
            $classes[] = 'kp-categories-3';
            break;
        case 'blog-4':
            $classes[] = 'kp-categories-4';
            break;
        case 'blog-5':
            $classes[] = 'kp-categories-5';
            break;
        case 'single-right-sidebar':
            $queried_object = get_queried_object();
            if ( false == get_post_format( $queried_object->ID ) ) {
                $classes[] = 'kp-single-standard';
            } elseif ( 'gallery' == get_post_format( $queried_object->ID ) ) {
                $classes[] = 'kp-single-gallery';
            }


            $classes[] = 'kp-single-right-sidebar';
            break;
        case 'page-right-sidebar':
            $classes[] = 'kp-page-right-sidebar';
            break;
        case 'page-fullwidth':
            $classes[] = 'kp-elements-page';
            break;
        case 'page-fullwidth-widgets':
            $classes[] = 'kp-gallery-page';
            break;
        case 'error-404':
            $classes[] = 'kp-error-page';
            break;
    }

    return $classes;
}

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @package Kopa
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function kopa_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() ) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 ) {
        $title = "$title $sep " . sprintf( esc_attr__( 'Page %s', 'fastnews-light' ), max( $paged, $page ) );
    }

    return $title;
}


/**
 * @package Kopa
 * @subpackage Fastnews Light
 * @author: kopatheme
 * @description: Print current time
 */
function kopa_the_current_time(){
    $retdate = '';
    $current_timestamp = current_time('timestamp');

    $retdate .= date_i18n( get_option( 'date_format' ), $current_timestamp);//get_the_time('l, j/n/Y \| g:i T');


    echo '<p class="current-date">' . $retdate . '</p>';
}

/**
 * @package Kopa
 * @subpackage Fastnews Light
 * @author: kopatheme
 * @description: print socials in header
 */
function kopa_the_socials( $type = null ) {
    $kopa_socials = kopa_get_socials();

    //check empty socials
    $check = false;
    $class = 'kopa-social-link';
    if ( 'type2' === $type) {
        $class = 'widget kopa-social-link';
    }
    foreach ( $kopa_socials as $k => $v ) {
        $item_url = get_theme_mod( $v['id'] . '_url', '' );

        if ( 'rss' === $v['id'] ) {
            if ( '#HIDE' != $item_url ) {
                $check = true;
                break;
            }
        } else {
            if ( ! empty( $item_url ) ) {
                $check = true;
                break;
            }
        }

    }
    if ( $check ) { ?>
    <div class="<?php echo esc_attr($class);?>">
        <?php if ( 'type2' === $type) {
        echo '<span>' . esc_attr__('Follow us', 'fastnews-light') . '</span>';
    } ?>
        <ul class="clearfix">
            <?php
            foreach ( $kopa_socials as $v1 ) {
                $item_url = get_theme_mod( $v1['id'] . '_url', '' );
                if ( 'rss' === $v1['id'] ) {
                    if ( empty( $item_url ) ) {
                        $item_url = get_bloginfo_rss('rss2_url');
                    } elseif ( '#HIDE' === $item_url ) {
                        $item_url = '';
                    }
                }
                if ( ! empty( $item_url ) ) {?>
                    <?php
                    $item_custom_icon = get_theme_mod( $v1['id'] . '_custom_icon_url', '' );
                    if ( empty($item_custom_icon) ) {
                        echo '<li><a href="' . esc_url($item_url) . '" class="fa fa-' . $v1['id'] . '" target="_blank" rel="nofollow"></a></li>';
                    } else {
                        $params = array( 'width' => 16, 'height' => 17, 'crop' => true );
                        $item_crop_custom_icon = bfi_thumb($item_custom_icon, $params);
                        echo '<li><a href=" ' . esc_url($item_url) . ' " title="' . $v1['id'] . '" rel="nofollow" target="_blank"><img src="' . $item_crop_custom_icon . '" alt="' . $v1['id'] . '"></a></li>';
                    }
                }
            }
            ?>
        </ul>
    </div>
    <?php }
    ?>

<?php }

/**
 * @package Kopa
 * @subpackage Fastnews Light
 * @author: kopatheme
 * @description: print headline in header
 */
function kopa_the_headline() {
    $limit = (int) get_theme_mod( 'healine-postnumber', '5' );
    if ($limit) {
        $categories = get_theme_mod( 'headline-category', '' );
        $tags = get_theme_mod( 'headline-tag', '' );
        $post_format = get_theme_mod( 'headline-format', '' );
        if ( ! empty( $post_format ) ) {
            $post_format = 'post-format-' . $post_format;
        }
        $relation = get_theme_mod('headline-relation', 'OR');

        $query = array(
            'post_type'      => 'post',
            'posts_per_page' => $limit ,
            'order'          => 'DESC',
            'orderby'        => 'date',
            'ignore_sticky_posts' => true
        );

        if ( ! empty($categories) ) {
            $query['tax_query'][] = array(
                'taxonomy' => 'category',
                'field'    => 'id',
                'terms'    => $categories,
            );
        }

        if ( ! empty($tags) ) {
            $query['tax_query'][] = array(
                'taxonomy' => 'post_tag',
                'field'    => 'id',
                'terms'    => $tags,
            );
        }

        $query['tax_query']['relation'] = $relation;

        if ( !empty($post_format) ) {
            $query['tax_query'][] = array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array ( $post_format )
            );
        }

        $posts = new WP_Query($query);
        if ($posts->have_posts()) {
            $label_title = get_theme_mod( 'headline-title', '' );
            ?>
        <div class="kopa-ticker">
            <?php if ( $label_title ) :?>
            <h6 class="ticker-title"><?php echo esc_html($label_title); ?></h6>
            <?php endif; ?>
            <ul id="js-news">
                <?php
                while ( $posts->have_posts() ) {
                    $posts->the_post();
                    $post_title = get_the_title();
                    if ( empty( $post_title ) ) {
                        $post_title = esc_attr__( '(No title post)', 'fastnews-light' );
                    }
                    $post_url = get_permalink();
                    ?>
                    <li><a href="<?php echo esc_url($post_url); ?>" title="<?php echo esc_attr($post_title); ?>"><?php echo esc_html($post_title);?></a></li>
                    <?php }
                ?>
            </ul>
        </div>
        <?php
        }
        wp_reset_postdata();
    }
}

if ( ! function_exists('revant_set_image_info') ) {
    function revant_set_image_info() {
        $image_thumbs = array(
            'widget-post-list-255-245' => array(
                'width' => 255,
                'height' => 245,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for widget: Kopa Posts List (255 x 245 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'widget-post-list-540-245' => array(
                'width' => 540,
                'height' => 245,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for widget: Kopa Posts List (540 x 245 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'widget-post-list-350-245' => array(
                'width' => 350,
                'height' => 245,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for widget: Kopa Posts List (350 x 245 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'widget-post-list-290-203' => array(
                'width' => 290,
                'height' => 203,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for widget: Kopa Posts List (290 x 203 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'widget-post-list-75-78' => array(
                'width' => 75,
                'height' => 78,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for widget: Kopa Posts List (75 x 78 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'widget-post-list-254-150' => array(
                'width' => 254,
                'height' => 150,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for widget: Kopa Posts List (254 x 150 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'widget-post-list-254-178' => array(
                'width' => 254,
                'height' => 178,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for widget: Kopa Posts List (254 x 178 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'widget-post-list-446-276' => array(
                'width' => 446,
                'height' => 276,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for widget: Kopa Posts List (446 x 276 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'widget-post-list-254-244' => array(
                'width' => 254,
                'height' => 244,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for widget: Kopa Posts List (254 x 244 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'widget-post-list-175-119' => array(
                'width' => 175,
                'height' => 119,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for widget: Kopa Posts List (175 x 119 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'post-author-page' => array(
                'width' => 350,
                'height' => 245,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for post in author page (350 x 245 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'post-blog-fullwidth-2' => array(
                'width' => 1110,
                'height' => 715,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for layout blog full-width-2 (1110 x 715 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'post-blog-left-2' => array(
                'width' => 730,
                'height' => 470,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for layout blog left-2 (730 x 470 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'post-search-page' => array(
                'width' => 243,
                'height' => 164,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for layout search page (243 x 164 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'post-single' => array(
                'width' => 223,
                'height' => 153,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for single (223 x 153 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'widget-post-carousel-syn' => array(
                'width' => 1110,
                'height' => 570,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for widget Kopa Posts Carousel Sync (1110 x 570 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'widget-post-carousel-syn-120-120' => array(
                'width' => 120,
                'height' => 120,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for widget Kopa Posts Carousel Sync (120 x 120 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
            'widget-post-carousel' => array(
                'width' => 237,
                'height' => 140,
                'bfi_thumb' => true,
                'title' => esc_attr__('Custom featured image for widget Kopa Posts List Carousel (237 x 140 px)', 'fastnews-light'),
                'enable_custom_feature_image' => true
            ),
        );

        return apply_filters('revant_custom_set_image_info', $image_thumbs);
    }
}

function kopa_the_date_custom ($post_id = 0, $format = 'Y') {
    $date = date_create(get_post_field( 'post_date', $post_id));
    if ( $date ){
        return $date->format($format);
    }else{
        return '';
    }

}

/**
 * @package Kopa
 * @subpackage Fastnews Light
 * @author: kopatheme
 * @description: get custom excerpt by word
 */
function kopa_get_the_excerpt_for_widget($excerpt='', $content = '', $length = 0) {
    if ( $length != 0 ){
        $kopa_length = $length;
    }elseif(is_category() || is_tag() || is_home()) {
        $kopa_length = (int) get_theme_mod('blog_excerpt', '55');
    }else{
        $kopa_length = (int) get_theme_mod('excerpt_front_page', '55');
    }
    global $post;
    if(empty($excerpt)){
        $temp_excerp = $post->post_excerpt;
    }else{
        $temp_excerp = $excerpt;
    }

    if ( empty($temp_excerp) ) {
        if(empty($content)){
            global $more;
            $temp = $more;
            $more = false;
            $content = get_the_content('');
            $more = $temp;
        }
        $temp_excerp =  strip_tags($content);
        $temp_excerp =  strip_shortcodes($temp_excerp);
        $kopa_excerpt = wp_trim_words($temp_excerp, $kopa_length, $more = null);
    }else{
        $kopa_excerpt =  $temp_excerp;
    }

    return $kopa_excerpt;
}

/**
 * Template tag: print breadcrumb
 */
function kopa_breadcrumb() {
    // get show/hide option
    $kopa_breadcrumb_status = get_theme_mod('breadcrumb_status', '1');

    if ( 1 != $kopa_breadcrumb_status ) {
        return;
    }

    if (is_main_query()) {
        global $post, $wp_query;

        $prefix = '&nbsp;/&nbsp;';
        $current_class = 'current-page';
        $description = '';
        $breadcrumb_before = '<div class="breadcrumb clearfix">';
        $breadcrumb_after = '</div>';
        $breadcrumb_home = '<a href="' . esc_url(home_url('/')) . '">' . esc_attr__('Home', 'fastnews-light') . '</a>';
        $breadcrumb = '';
        ?>

    <?php
        if (is_home()) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, esc_attr__('Blog', 'fastnews-light'));
        } else if (is_post_type_archive('product') && get_option('woocommerce_shop_page_id')) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title(get_option('woocommerce_shop_page_id')));
        } else if (is_tag()) {
            $breadcrumb.= $breadcrumb_home;

            $term = get_term(get_queried_object_id(), 'post_tag');
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $term->name);
        } else if (is_category()) {
            $breadcrumb.= $breadcrumb_home;

            $category_id = get_queried_object_id();
            $terms_link = explode(',', substr(get_category_parents(get_queried_object_id(), TRUE, ','), 0, (strlen(',') * -1)));
            $n = count($terms_link);
            if ($n > 1) {
                for ($i = 0; $i < ($n - 1); $i++) {
                    $breadcrumb.= $prefix . $terms_link[$i];
                }
            }
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_category_by_ID(get_queried_object_id()));

        } else if ( is_tax('product_cat') ) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . '<a href="'.get_page_link( get_option('woocommerce_shop_page_id') ).'">'.get_the_title( get_option('woocommerce_shop_page_id') ).'</a>';
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

            $parents = array();
            $parent = $term->parent;
            while ($parent):
                $parents[] = $parent;
                $new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
                $parent = $new_parent->parent;
            endwhile;
            if( ! empty( $parents ) ):
                $parents = array_reverse($parents);
                foreach ($parents as $parent):
                    $item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
                    $breadcrumb .= $prefix . '<a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a>';
                endforeach;
            endif;

            $queried_object = get_queried_object();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $queried_object->name);
        } else if ( is_tax( 'product_tag' ) ) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . '<a href="'.get_page_link( get_option('woocommerce_shop_page_id') ).'">'.get_the_title( get_option('woocommerce_shop_page_id') ).'</a>';
            $queried_object = get_queried_object();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $queried_object->name);
        } else if (is_single()) {
            $breadcrumb.= $breadcrumb_home;

            if ( get_post_type() === 'product' ) :

                $breadcrumb .= $prefix . '<a href="'.get_page_link( get_option('woocommerce_shop_page_id') ).'">'.get_the_title( get_option('woocommerce_shop_page_id') ).'</a>';

                if ($terms = get_the_terms( $post->ID, 'product_cat' )) :
                    $term = apply_filters( 'jigoshop_product_cat_breadcrumb_terms', current($terms), $terms);
                    $parents = array();
                    $parent = $term->parent;
                    while ($parent):
                        $parents[] = $parent;
                        $new_parent = get_term_by( 'id', $parent, 'product_cat');
                        $parent = $new_parent->parent;
                    endwhile;
                    if(!empty($parents)):
                        $parents = array_reverse($parents);
                        foreach ($parents as $parent):
                            $item = get_term_by( 'id', $parent, 'product_cat');
                            $breadcrumb .= $prefix . '<a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a>';
                        endforeach;
                    endif;
                    $breadcrumb .= $prefix . '<a href="' . get_term_link( $term->slug, 'product_cat' ) . '">' . $term->name . '</a>';
                endif;

                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title());

            else :

                $categories = get_the_category(get_queried_object_id());
                if ($categories) {
                    foreach ($categories as $category) {
                        $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_category_link($category->term_id), $category->name);
                    }
                }

                $post_id = get_queried_object_id();
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title($post_id));

            endif;

        } else if (is_page()) {
            if (!is_front_page()) {
                $post_id = get_queried_object_id();
                $breadcrumb.= $breadcrumb_home;
                $post_ancestors = get_post_ancestors($post);
                if ($post_ancestors) {
                    $post_ancestors = array_reverse($post_ancestors);
                    foreach ($post_ancestors as $crumb)
                        $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_permalink($crumb), get_the_title($crumb));
                }
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title(get_queried_object_id()));
            }
        } else if (is_year() || is_month() || is_day()) {
            $breadcrumb.= $breadcrumb_home;

            $date = array('y' => NULL, 'm' => NULL, 'd' => NULL);

            $date['y'] = get_the_time('Y');
            $date['m'] = get_the_time('m');
            $date['d'] = get_the_time('j');

            if (is_year()) {
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $date['y']);
            }

            if (is_month()) {
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_year_link($date['y']), $date['y']);
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, date('F', mktime(0, 0, 0, $date['m'])));
            }

            if (is_day()) {
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_year_link($date['y']), $date['y']);
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_month_link($date['y'], $date['m']), date('F', mktime(0, 0, 0, $date['m'])));
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $date['d']);
            }

        } else if (is_search()) {
            $breadcrumb.= $breadcrumb_home;

            $s = get_search_query();
            $c = $wp_query->found_posts;

            $description = sprintf('<span class="%1$s">%2$s "%3$s"', $current_class, esc_attr__('Your search for', 'fastnews-light'), $s);
            $breadcrumb .= $prefix . $description;
        } else if (is_author()) {
            $breadcrumb.= $breadcrumb_home;
            $author_id = get_queried_object_id();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</a>', $current_class, sprintf(esc_attr__('Posts created by %1$s', 'fastnews-light'), get_the_author_meta('display_name', $author_id)));
        } else if (is_404()) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, esc_attr__('Error 404', 'fastnews-light'));
        }

        if ($breadcrumb)
            echo apply_filters('kopa_breadcrumb', $breadcrumb_before . $breadcrumb . $breadcrumb_after);
    }
}

/*
 * Kopa get post format icon
 */
function kopa_get_post_format_icon ($post_id) {
    $post_format = get_post_format();
    if ( false === $post_format ) {
        $post_format = 'standard';
    }

    $fa_icon = '';
    switch($post_format){
        case 'standard':
            $fa_icon = 'standard-post';
            break;
        case 'video':
            $fa_icon = 'video-post';
            break;
        case 'audio':
            $fa_icon = 'audio-post';
            break;
        case 'gallery':
            $fa_icon = 'gallery-post';
            break;
        case 'quote':
            $fa_icon = 'quote-post';
            break;
        case 'link':
            $fa_icon = 'link-post';
            break;
    }
    return $fa_icon;
}

/*
 * Remove dimension of post thumbnail
 */
add_filter( 'post_thumbnail_html', 'revant_remove_thumbnail_dimensions', 10, 3 );
function revant_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

/*
 * Show pagination for widgets
 */
function kopa_pagination_other($r) {
    global $wp_rewrite;
    $total = $r->max_num_pages;
    if ($total > 1) {
        $current = (get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
        $pagination_args = array(
            'base' => @add_query_arg('paged', '%#%'),
            'format' => '',
            'current' => $current,
            'total' => $total,
            'end_size' => 2,
            'mid_size' => 1,
            'type' => 'list',
            'prev_next' => TRUE,
            'prev_text' => '<i class="fa fa-long-arrow-left"></i>' . esc_attr__('Previous', 'fastnews-light'),
            'next_text' => esc_attr__('Next', 'fastnews-light') . '<i class="fa fa-long-arrow-right"></i>'
        );

        if ($wp_rewrite->using_permalinks())
            $pagination_args['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');

        if (!empty($r->query_vars['s']))
            $pagination_args['add_args'] = array('s' => urlencode(get_query_var('s')));

        echo '<div class="kopa-pagination">';
        echo paginate_links($pagination_args);
        echo '</div>';
    }
}

/*
 * kopa function get title of archive
 */
function kopa_the_archive_title(){
    if ( is_home() ){
        echo '<h1 class="entry-cat-title">' . esc_attr__('Blog', 'fastnews-light') . '</h1>';
    } elseif ( is_tag() ) {
        printf( '<h1 class="entry-cat-title">%1$s: %2$s</h1>', esc_attr__('Tag Archives', 'fastnews-light'), single_tag_title( '', false ) );
    }
    elseif ( is_category()) {
        if ( 1 == get_theme_mod('blog_category_name_status', '1') ) {
            echo '<h1 class="entry-cat-title">' . esc_attr(single_cat_title( '', false )) .'</h1>';
        }
    } elseif( is_archive() ){
        if ( is_day() ){
            printf( '<h1 class="entry-cat-title">%s: %s </h1>', esc_attr__('Daily Archives', 'fastnews-light'), get_the_date() );
        } elseif ( is_month() ) {
            printf( '<h1 class="entry-cat-title">%s: %s</h1>', esc_attr__('Monthly Archives', 'fastnews-light'), get_the_date( _x( 'F Y', 'monthly archives date format', 'fastnews-light' ) ) );
        } elseif ( is_year() ) {
            printf( '<h1 class="entry-cat-title">%s: %s</h1>', esc_attr__('Yearly Archives', 'fastnews-light'), get_the_date( _x( 'Y', 'yearly archives date format', 'fastnews-light' ) ) );
        } else {
            echo spintf( '<h1 class="entry-cat-title">%s</h1>', esc_attr__('Archives', 'fastnews-light') );
        }
    }
}

function fastnews_get_template_setting($default = null) {
    if(function_exists('kopa_get_template_setting')){
        return kopa_get_template_setting();
    }

    return $default;
}

function kopa_log($message){
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}

function kopa_get_image_src($pid = 0, $size = 'thumbnail') {
    $thumb = get_the_post_thumbnail($pid, $size);
    if (!empty($thumb)) {
        $_thumb = array();
        $regex = '#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im';
        preg_match($regex, $thumb, $_thumb);
        $thumb = $_thumb[2];
    }
    return $thumb;
}

function kopa_content_get_audio($content, $enable_multi = false) {
    return kopa_content_get_media($content, $enable_multi, array('audio', 'soundcloud'));
}

function kopa_content_get_media($content, $enable_multi = false, $media_types = array()) {
    $media = array();
    $regex_matches = '';
    $regex_pattern = get_shortcode_regex();
    preg_match_all('/' . $regex_pattern . '/s', $content, $regex_matches);
    foreach ($regex_matches[0] as $shortcode) {
        $regex_matches_new = '';
        preg_match('/' . $regex_pattern . '/s', $shortcode, $regex_matches_new);

        if (in_array($regex_matches_new[2], $media_types)) :
            $media[] = array(
                'shortcode' => $regex_matches_new[0],
                'type' => $regex_matches_new[2],
                'url' => $regex_matches_new[5]
            );
            if (false == $enable_multi) {
                break;
            }
        endif;
    }

    return $media;
}

function kopa_content_get_gallery($content, $enable_multi = false) {
    return kopa_content_get_media($content, $enable_multi, array('gallery'));
}

function kopa_content_get_video($content, $enable_multi = false) {
    return kopa_content_get_media($content, $enable_multi, array('vimeo', 'youtube'));
}

function kopa_search_title(){           // highlight the post title in search pages
    $title = get_the_title();
    $keys = implode('|', explode(' ', get_search_query()));
    $title = preg_replace('/(' . $keys .')/iu', '<span class="kopa-search-keyword">\0</span>', $title);
    return $title;
}

function fastnews_light_custom_excerpt_length( $length ) {
    $e_length = get_theme_mod('blog_excerpt_length','55');
    if ( $e_length ) {
        return intval($e_length);
    }
    return $length;
}

function fastnews_light_remove_oembed_attributes( $html, $url, $attr, $post_ID ) {
    $return = str_replace('frameborder="no"', 'style="border: none"', $html);
    $return = str_replace('frameborder="0"', 'style="border: none"', $return);
    $return = str_replace('allowfullscreen', '', $return);
    $return = str_replace('scrolling="no"', '', $return);

    $post_curr_format = get_post_format( $post_ID );

    if ( 'audio' == $post_curr_format ) {
        $pattern = '/(height)="[0-9]*"/i';
        $return = preg_replace($pattern, "height='166px'", $return);
    }

    return $return;
}