<?php

add_action('wp_enqueue_scripts', 'fastnews_light_customize_logo', 40);

/**
 * Custom logo
 */
function fastnews_light_customize_logo(){
    $custom_styles = '';

    /* Logo */
    $logo_margin_top = get_theme_mod('logo_margin_top', '');
    $logo_margin_left = get_theme_mod('logo_margin_left', '');

    $logo_margin = '';
    if ( $logo_margin_top ) {
        $logo_margin .= "margin-top:{$logo_margin_top}px;";
    }
    if ( $logo_margin_left ) {
        $logo_margin .= "margin-left:{$logo_margin_left}px;";
    }
    if ( $logo_margin ) {
        $custom_styles .= ".kopa-logo { $logo_margin }";
    }

    /* Logo navigation */
    $logo_nav_margin_top = get_theme_mod('logo_nav_margin_top', '');
    $logo_nav_margin_left = get_theme_mod('logo_nav_margin_left', '');

    $logo_nav_margin = '';
    if ( $logo_nav_margin_top ) {
        $logo_nav_margin .= "margin-top:{$logo_nav_margin_top}px;";
    }
    if ( $logo_nav_margin_left ) {
        $logo_nav_margin .= "margin-left:{$logo_nav_margin_left}px;";
    }
    if ( $logo_nav_margin ) {
        $custom_styles .= ".nav-bar .kopa-logo { $logo_nav_margin }";
    }

    /* ==================================================================================================
     * Theme Options custom styles
     * ================================================================================================= */
    wp_add_inline_style('kopa-style', $custom_styles);
}

add_filter('kopa_current_tab_default', 'kopa_set_default_tab');
add_filter( 'kopa_settings_theme_options_enable', '__return_false' );

function kopa_set_default_tab($key) {
    return 'sidebar-manager';
}
