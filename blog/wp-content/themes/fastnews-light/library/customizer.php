<?php

function fastnews_light_init_options($options){
    #Panels

    $options['panels'][] = array(
        'id'    => 'fastnews_light_panel_theme_option',
        'title' => esc_attr__('Theme options', 'fastnews-light'));

    #Sections

    $options['sections'][] = array(
        'id'    => 'fastnews_light_section_general',
        'panel' => 'fastnews_light_panel_theme_option',
        'title' => esc_attr__('General', 'fastnews-light'));

    $options['sections'][] = array(
        'id'    => 'fastnews_light_section_logo_favicon',
        'panel' => 'fastnews_light_panel_theme_option',
        'title' => esc_attr__('Logo', 'fastnews-light'));

    $options['sections'][] = array(
        'id'    => 'fastnews_light_section_custom_headline',
        'panel' => 'fastnews_light_panel_theme_option',
        'title' => esc_attr__('Headline', 'fastnews-light'));

    $options['sections'][] = array(
        'id'    => 'fastnews_light_section_custom_slider',
        'panel' => 'fastnews_light_panel_theme_option',
        'title' => esc_attr__('Slider', 'fastnews-light'));

    $options['sections'][] = array(
        'id'    => 'fastnews_light_section_custom_blog',
        'panel' => 'fastnews_light_panel_theme_option',
        'title' => esc_attr__('Post archive', 'fastnews-light'));

    $options['sections'][] = array(
        'id'    => 'fastnews_light_section_custom_single_post',
        'panel' => 'fastnews_light_panel_theme_option',
        'title' => esc_attr__('Post single', 'fastnews-light'));

    $kopa_categories = get_categories();
    $kopa_category_options = array();
    $kopa_category_options['0'] = '--Select--';
    foreach ( $kopa_categories as $v ) {
        $item_name = $v->name;
        if ( $v->count ) {
            $item_name .= ' ( ' . $v->count . ' )';
        }
        $kopa_category_options[$v->term_id] = $item_name;
    }

    #General
    $options['settings'][] = array(
        'settings'          => 'breadcrumb_status',
        'label'       => esc_attr__('Breadcrumb', 'fastnews-light'),
        'description' => esc_attr__('Check this option to display.', 'fastnews-light'),
        'default'     => '1',
        'type'        => 'checkbox',
        'section'     => 'fastnews_light_section_general',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'copyright',
        'label'       => esc_attr__('CUSTOM LEFT FOOTER', 'fastnews-light'),
        'description' => esc_attr__('Enter the content you want to display in your left footer (e.g. copyright text).', 'fastnews-light'),
        'default'     => '',
        'type'        => 'textarea',
        'section'     => 'fastnews_light_section_general',
        'transport'   => 'refresh');


    #Logo
    $options['settings'][] = array(
        'settings'          => 'logo_url',
        'label'       => esc_attr__('Logo', 'fastnews-light'),
        'description' => esc_attr__('Upload your logo', 'fastnews-light'),
        'default'     => '',
        'type'        => 'image',
        'section'     => 'fastnews_light_section_logo_favicon',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'logo_margin_top',
        'label'       => esc_attr__('Logo margin top (px)', 'fastnews-light'),
        'default'     => '',
        'type'        => 'text',
        'section'     => 'fastnews_light_section_logo_favicon',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'logo_margin_left',
        'label'       => esc_attr__('Logo margin left (px)', 'fastnews-light'),
        'default'     => '',
        'type'        => 'text',
        'section'     => 'fastnews_light_section_logo_favicon',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'footer_logo_url',
        'label'       => esc_attr__('Footer Logo', 'fastnews-light'),
        'description' => esc_attr__('Upload your logo', 'fastnews-light'),
        'default'     => '',
        'type'        => 'image',
        'section'     => 'fastnews_light_section_logo_favicon',
        'transport'   => 'refresh');

    #Headline option
    $options['settings'][] = array(
        'settings'          => 'headline-title',
        'label'       => esc_attr__('Headline title', 'fastnews-light'),
        'default'     => esc_attr__('Breaking News', 'fastnews-light'),
        'type'        => 'text',
        'section'     => 'fastnews_light_section_custom_headline',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'headline-category',
        'label'       => esc_attr__('Headline category', 'fastnews-light'),
        'default'     => '',
        'type'        => 'select',
        'choices' => $kopa_category_options,
        'section'     => 'fastnews_light_section_custom_headline',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'headline-postnumber',
        'default'     => '10',
        'label'       => esc_attr__('Number of posts to show. ( Enter 0 to hide )', 'fastnews-light'),
        'type'        => 'text',
        'section'     => 'fastnews_light_section_custom_headline',
        'transport'   => 'refresh');

    #Slider options
    $options['settings'][] = array(
        'settings'          => 'kopa_theme_options_display_blog_slider',
        'label'       => esc_attr__('Show on archive', 'fastnews-light'),
        'description' => esc_attr__('Check this option to display.', 'fastnews-light'),
        'default'     => '1',
        'type'        => 'checkbox',
        'section'     => 'fastnews_light_section_custom_slider',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'kopa_theme_options_blog_slider_category_id',
        'label'       => esc_attr__('Slide category', 'fastnews-light'),
        'default'     => '',
        'type'        => 'select',
        'choices' => $kopa_category_options,
        'section'     => 'fastnews_light_section_custom_slider',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'kopa_theme_options_blog_slider_posts_number',
        'label'       => esc_attr__('Number of posts', 'fastnews-light'),
        'default'     => '3',
        'label'       => esc_attr__('Enter 0 to hide', 'fastnews-light'),
        'type'        => 'text',
        'section'     => 'fastnews_light_section_custom_slide',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'kopa_theme_options_blog_slider_effect',
        'label'       => esc_attr__('Effect', 'fastnews-light'),
        'default'     => '',
        'type'        => 'select',
        'choices' => array(
            'fade' => esc_attr__( 'Fade', 'fastnews-light' ),
            'slide' => esc_attr__( 'Slide', 'fastnews-light' )
        ),
        'section'     => 'fastnews_light_section_custom_slider',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'kopa_theme_options_blog_slider_slideshow_speed',
        'label'       => esc_attr__('Slideshow Speed (milliseconds)', 'fastnews-light'),
        'default'     => '7000',
        'type'        => 'text',
        'section'     => 'fastnews_light_section_custom_slider',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'kopa_theme_options_blog_slider_animation_speed',
        'label'       => esc_attr__('Animation Speed (milliseconds)', 'fastnews-light'),
        'default'     => '600',
        'type'        => 'text',
        'section'     => 'fastnews_light_section_custom_slider',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'kopa_theme_options_blog_slider_autoplay',
        'label'       => esc_attr__('Auto slide', 'fastnews-light'),
        'description' => esc_attr__('Check this option to display.', 'fastnews-light'),
        'default'     => '1',
        'type'        => 'checkbox',
        'section'     => 'fastnews_light_section_custom_slide',
        'transport'   => 'refresh');


    #Blog options
    $options['settings'][] = array(
        'settings'          => 'blog_excerpt_status',
        'label'       => esc_attr__('Excerpt', 'fastnews-light'),
        'description' => esc_attr__('Check this option to display.', 'fastnews-light'),
        'default'     => '1',
        'type'        => 'checkbox',
        'section'     => 'fastnews_light_section_custom_blog',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'blog_excerpt_length',
        'label'       => esc_attr__('Custom excerpt length', 'fastnews-light'),
        'default'     => '55',
        'type'        => 'text',
        'section'     => 'fastnews_light_section_custom_blog',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'blog_date_status',
        'label'       => esc_attr__('Date', 'fastnews-light'),
        'description' => esc_attr__('Check this option to display.', 'fastnews-light'),
        'default'     => '1',
        'type'        => 'checkbox',
        'section'     => 'fastnews_light_section_custom_blog',
        'transport'   => 'refresh');
    $options['settings'][] = array(
        'settings'          => 'blog_readmore_status',
        'label'       => esc_attr__('Read more', 'fastnews-light'),
        'description' => esc_attr__('Check this option to display.', 'fastnews-light'),
        'default'     => '1',
        'type'        => 'checkbox',
        'section'     => 'fastnews_light_section_custom_blog',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'blog_thumbnail_status',
        'label'       => esc_attr__('Thumbnail', 'fastnews-light'),
        'description' => esc_attr__('Check this option to display.', 'fastnews-light'),
        'default'     => '1',
        'type'        => 'checkbox',
        'section'     => 'fastnews_light_section_custom_blog',
        'transport'   => 'refresh');

    #Single post option
    $options['settings'][] = array(
        'settings'          => 'post-thumbnail-status',
        'label'       => esc_attr__('Thumbnail', 'fastnews-light'),
        'description' => esc_attr__('Check this option to display.', 'fastnews-light'),
        'default'     => '1',
        'type'        => 'checkbox',
        'section'     => 'fastnews_light_section_custom_single_post',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'post_date_status',
        'label'       => esc_attr__('Date', 'fastnews-light'),
        'description' => esc_attr__('Check this option to display.', 'fastnews-light'),
        'default'     => '1',
        'type'        => 'checkbox',
        'section'     => 'fastnews_light_section_custom_single_post',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'post_tag_status',
        'label'       => esc_attr__('Tags', 'fastnews-light'),
        'description' => esc_attr__('Check this option to display.', 'fastnews-light'),
        'default'     => '1',
        'type'        => 'checkbox',
        'section'     => 'fastnews_light_section_custom_single_post',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'post_navigation_status',
        'label'       => esc_attr__('Navigation', 'fastnews-light'),
        'description' => esc_attr__('Check this option to display.', 'fastnews-light'),
        'default'     => '1',
        'type'        => 'checkbox',
        'section'     => 'fastnews_light_section_custom_single_post',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'post_author_status',
        'label'       => esc_attr__('Author', 'fastnews-light'),
        'description' => esc_attr__('Check this option to display.', 'fastnews-light'),
        'default'     => '1',
        'type'        => 'checkbox',
        'section'     => 'fastnews_light_section_custom_single_post',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'post-relate-title',
        'label'       => esc_attr__('Related posts - title', 'fastnews-light'),
        'default'     => esc_attr__('Related Articles', 'fastnews-light'),
        'type'        => 'text',
        'section'     => 'fastnews_light_section_custom_single_post',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'post_get_by',
        'label'       => esc_attr__('Get by', 'fastnews-light'),
        'description' => '',
        'default'     => 'post_tag',
        'choices'     => array(
            'category' => esc_attr__('Category', 'fastnews-light'),
            'post_tag' => esc_attr__('Tag', 'fastnews-light'),
        ),
        'type'        => 'select',
        'section'     => 'fastnews_light_section_custom_single_post',
        'transport'   => 'refresh');

    $options['settings'][] = array(
        'settings'          => 'post-relate-limit',
        'label'       => esc_attr__('Related posts - Number of posts', 'fastnews-light'),
        'description' => esc_attr__('Enter 0 to disable this option.', 'fastnews-light'),
        'default'     => '6',
        'type'        => 'text',
        'section'     => 'fastnews_light_section_custom_single_post',
        'transport'   => 'refresh');

    return $options;
}