<?php

add_filter( 'kopa_layout_manager_settings', 'kopa_extra_layout_manager_settings' );

function fastnews_get_positions(){
    $f_positions = array(
        'position_1'       => esc_attr__( 'Widget Area 1', 'fastnews-light'),
        'position_2'       => esc_attr__( 'Widget Area 2', 'fastnews-light'),
        'position_3'       => esc_attr__( 'Widget Area 3', 'fastnews-light'),
        'position_4'       => esc_attr__( 'Widget Area 4', 'fastnews-light'),
        'position_5'       => esc_attr__( 'Widget Area 5', 'fastnews-light'),
        'position_6'       => esc_attr__( 'Widget Area 6', 'fastnews-light'),
        'position_7'       => esc_attr__( 'Widget Area 7', 'fastnews-light'),
        'position_8'       => esc_attr__( 'Widget Area 8', 'fastnews-light'),
        'position_9'       => esc_attr__( 'Widget Area 9', 'fastnews-light'),
        'position_10'       => esc_attr__( 'Widget Area 10', 'fastnews-light'),
        'position_11'       => esc_attr__( 'Widget Area 11', 'fastnews-light'),
        'position_12'       => esc_attr__( 'Widget Area 12', 'fastnews-light'),
        'position_13'       => esc_attr__( 'Widget Area 13', 'fastnews-light'),
        'position_14'       => esc_attr__( 'Widget Area 14', 'fastnews-light'),
        'position_15'       => esc_attr__('Widget Area 15', 'fastnews-light'),
        'position_16'       => esc_attr__( 'Widget Area 16', 'fastnews-light'),
        'position_17'       => esc_attr__( 'Widget Area 167', 'fastnews-light')

    );

    return apply_filters('fastnews_get_positions', $f_positions);
}

function fastnews_get_sidebars(){
    $f_sidebars = array(
        'position_4' => 'sidebar_4',
        'position_3' => 'sidebar_3',
        'position_16' => 'sidebar_16',
        'position_5' => 'sidebar_5',
        'position_6' => 'sidebar_6',
        'position_7' => 'sidebar_7',
        'position_8' => 'sidebar_8',
        'position_9' => 'sidebar_9',
        'position_10' => 'sidebar_10',
        'position_11' => 'sidebar_11',
        'position_12' => 'sidebar_12',
        'position_13' => 'sidebar_13',
        'position_14' => 'sidebar_14',
        'position_15' => 'sidebar_15',
    );

    return apply_filters('fastnews_get_sidebars', $f_sidebars);
}

function kopa_extra_layout_manager_settings( $options ) {
    $positions = fastnews_get_positions();
    $sidebars = fastnews_get_sidebars();

    # BLOG
    $blog = array(
        'title'     => esc_attr__('Blog', 'fastnews-light'),
        'preview'   => get_template_directory_uri() . '/images/layouts/blog.jpg',
        'positions' => array(
            'position_16',
            'position_5',
            'position_6',
            'position_7',
            'position_8',
            'position_9',
            'position_10',
            'position_11',
            'position_12',
            'position_13',
            'position_14',
            'position_15',
        )
    );

    $blog2 = array(
        'title'     => esc_attr__('Blog 2', 'fastnews-light'),
        'preview'   => get_template_directory_uri() . '/images/layouts/blog-2.jpg',
        'positions' => array(
            'position_16',
            'position_5',
            'position_6',
            'position_7',
            'position_8',
            'position_9',
            'position_10',
            'position_11',
            'position_12',
            'position_13',
            'position_14',
            'position_15',
        )
    );

    $blog3 = array(
        'title'     => esc_attr__('Blog 3', 'fastnews-light'),
        'preview'   => get_template_directory_uri() . '/images/layouts/blog-3.jpg',
        'positions' => array(
            'position_16',
            'position_5',
            'position_6',
            'position_7',
            'position_8',
            'position_9',
            'position_10',
            'position_11',
            'position_12',
            'position_13',
            'position_14',
            'position_15',
        )
    );

    $blog4 = array(
        'title'     => esc_attr__('Blog 4', 'fastnews-light'),
        'preview'   => get_template_directory_uri() . '/images/layouts/blog-4.jpg',
        'positions' => array(
            'position_16',
            'position_5',
            'position_6',
            'position_7',
            'position_8',
            'position_9',
            'position_10',
            'position_11',
            'position_12',
            'position_13',
            'position_14',
            'position_15',
        )
    );

    $blog5 = array(
        'title'     => esc_attr__('Blog 5', 'fastnews-light'),
        'preview'   => get_template_directory_uri() . '/images/layouts/blog-5.jpg',
        'positions' => array(
            'position_4',
            'position_3',
            'position_5',
            'position_6',
            'position_7',
            'position_8',
            'position_9',
            'position_10',
            'position_11',
            'position_12',
            'position_13',
            'position_14',
            'position_15',
        )
    );

    #PAGE
    $page_right_sidebar = array(
        'title'     => esc_attr__('Page Right Sidebar', 'fastnews-light'),
        'preview'   => get_template_directory_uri() . '/images/layouts/page-right-sidebar.jpg',
        'positions' => array(
            'position_16',
            'position_5',
            'position_6',
            'position_7',
            'position_8',
            'position_9',
            'position_10',
            'position_11',
            'position_12',
            'position_13',
            'position_14',
            'position_15',
        )
    );

    $page_fullwidth = array(
        'title'     => esc_attr__('Page Fullwidth', 'fastnews-light'),
        'preview'   => get_template_directory_uri() . '/images/layouts/page-fullwidth.jpg',
        'positions' => array(
            'position_16',
            'position_5',
            'position_6',
            'position_7',
            'position_8',
            'position_9',
            'position_10',
            'position_11',
            'position_12',
            'position_13',
            'position_14',
            'position_15',
        )
    );

    $page_fullwidth_widgets = array(
        'title'     => esc_attr__('Page Fullwidth Widgets', 'fastnews-light'),
        'preview'   => get_template_directory_uri() . '/images/layouts/page-fullwidth-widgets.jpg',
        'positions' => array(
            'position_16',
            'position_5',
            'position_6',
            'position_7',
            'position_8',
            'position_9',
            'position_10',
            'position_11',
            'position_12',
            'position_13',
            'position_14',
            'position_15',
        )
    );

    #SINGLE
    $single_right_sidebar = array(
        'title'     => esc_attr__('Single Right Sidebar', 'fastnews-light'),
        'preview'   => get_template_directory_uri() . '/images/layouts/single-right-sidebar.jpg',
        'positions' => array(
            'position_16',
            'position_5',
            'position_6',
            'position_7',
            'position_8',
            'position_9',
            'position_10',
            'position_11',
            'position_12',
            'position_13',
            'position_14',
            'position_15'
        )
    );

    #404 PAGE
    $error_404 = array(
        'title'     => esc_attr__('404 Page', 'fastnews-light'),
        'preview'   => get_template_directory_uri() . '/images/layouts/error-404.jpg',
        'positions' => array(
            'position_5',
            'position_6',
            'position_7',
            'position_8',
            'position_9',
            'position_10',
            'position_11',
            'position_12',
            'position_13',
            'position_14',
            'position_15'
        )
    );

    // blog layout
    $options['blog-layout']['positions'] = $positions;
    $options['blog-layout']['layouts'] = array(
        'blog' => $blog,
        'blog-2' => $blog2,
        'blog-3' => $blog3,
        'blog-4' => $blog4,
        'blog-5' => $blog5,
    );
    $options['blog-layout']['default'] = array(
        'layout_id' => 'blog',
        'sidebars'  => array(
            'blog' => $sidebars,
            'blog-2' => $sidebars,
            'blog-3' => $sidebars,
            'blog-4' => $sidebars,
            'blog-5' => $sidebars
        ),
    );

    // home layout
    $options['frontpage-layout']['positions'] = $positions;
    $options['frontpage-layout']['layouts'] = array(
        'blog' => $blog,
        'blog-2' => $blog2,
        'blog-3' => $blog3,
        'blog-4' => $blog4,
        'blog-5' => $blog5,
    );
    $options['frontpage-layout']['default'] = array(
        'layout_id' => 'blog',
        'sidebars'  => array(
            'blog' => $sidebars,
            'blog-2' => $sidebars,
            'blog-3' => $sidebars,
            'blog-4' => $sidebars,
            'blog-5' => $sidebars
        ),
    );

    // page layout
    $options['page-layout']['positions'] = $positions;
    $options['page-layout']['layouts'] = array(
        'page-right-sidebar' => $page_right_sidebar,
        'page-fullwidth' => $page_fullwidth,
        'page-fullwidth-widgets' => $page_fullwidth_widgets,
    );
    $options['page-layout']['default'] = array(
        'layout_id' => 'page-right-sidebar',
        'sidebars'  => array(
            'page-right-sidebar' => $sidebars,
            'page-fullwidth' => $sidebars,
            'page-fullwidth-widgets' => $sidebars,
        ),
    );

    // post layout
    $options['post-layout']['positions'] = $positions;
    $options['post-layout']['layouts'] = array(
        'single-right-sidebar' => $single_right_sidebar,
    );
    $options['post-layout']['default'] = array(
        'layout_id' => 'single-right-sidebar',
        'sidebars'  => array(
            'single-right-sidebar' => $sidebars
        ),
    );

    //search layout
    $options['search-layout']['positions'] = $positions;
    $options['search-layout']['layouts'] = array(
        'blog' => $blog,
        'blog-2' => $blog2,
        'blog-3' => $blog3,
        'blog-4' => $blog4,
        'blog-5' => $blog5,

    );
    $options['search-layout']['default'] = array(
        'layout_id' => 'blog',
        'sidebars'  => array(
            'blog' => $sidebars,
            'blog-2' => $sidebars,
            'blog-3' => $sidebars,
            'blog-4' => $sidebars,
            'blog-5' => $sidebars,
        ),
    );

    //404 layout
    $options['error404-layout']['positions'] = $positions;
    $options['error404-layout']['layouts'] = array(
        'error-404' => $error_404
    );
    $options['error404-layout']['default'] = array(
        'layout_id' => 'error-404',
        'sidebars'  => array(
            'error-404' => $sidebars,
        ),
    );

    //Rename title blog to archive, title frontpage to home
    foreach ( $options as $k => $v ) {
        if ( isset($v['type']) && 'title' == $v['type'] && 'blog-title' == $v['id'] ) {
            $options[$k]['title'] = esc_attr__('Archive', 'fastnews-light');
        }
    }
    $options['blog-layout']['title'] = esc_attr__('Archive', 'fastnews-light');

    return $options;
}
