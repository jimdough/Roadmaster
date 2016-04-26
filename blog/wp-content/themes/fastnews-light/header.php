<?php
$kopa_logo_url = get_theme_mod('logo_url', '');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->

    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/css3-mediaqueries.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/PIE_IE678.js"></script>
    <![endif]-->

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="kp-page-header">
    <div id="header-top">
        <div class="wrapper clearfix">
            <nav id="main-nav" class="pull-left">
                <?php
                if (has_nav_menu('main-nav')) {
                    wp_nav_menu(array(
                        'theme_location' => 'main-nav',
                        'container' => '',
                        'menu_id' => 'main-menu',
                        'items_wrap' => '<ul id="%1$s" class="%2$s clearfix">%3$s</ul>'
                    ));

                    $mobile_menu_walker = new kopa_mobile_menu();
                    wp_nav_menu(array(
                        'theme_location' => 'main-nav',
                        'container' => 'div',
                        'container_id' => 'mobile-menu',
                        'menu_id' => 'toggle-view-menu',
                        'items_wrap' => '<span>' . esc_attr__('Menu', 'fastnews-light') . '</span><ul id="%1$s">%3$s</ul>',
                        'walker' => $mobile_menu_walker
                    ));
                }
                ?>
            </nav>
            <!-- main-nav -->

            <?php get_search_form(); ?>
        </div>
        <!-- wrapper -->
    </div>
    <!-- header-top -->
    <div id="header-middle">
        <div class="wrapper clearfix">
            <div class="logo-image pull-left">
                <?php if ( ! empty($kopa_logo_url) ) : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img class="kopa-logo" src="<?php echo esc_url($kopa_logo_url); ?>"alt="<?php bloginfo('name'); ?> <?php echo esc_html('Logo', 'fastnews-light'); ?>">
                    </a>
                <?php else: ?>
                    <?php if(is_home() || is_front_page()): ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                    <?php else: ?>
                        <div class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></div>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
            <?php if ( is_active_sidebar('sidebar_ads') ) : ?>
                <div class="top-banner pull-right">
                    <?php dynamic_sidebar('sidebar_ads'); ?>
                </div>
            <?php endif; ?>
        </div>
        <!-- wrapper -->
    </div>
    <!-- header-middle -->
    <div id="header-bottom">
        <div class="wrapper clearfix">
            <div class="kp-headline-wrapper pull-left">
                <?php  get_template_part('library/templates/parts/header-ticker'); ?>
            </div>
            <!-- kp-headline-wrapper -->
        </div>
        <!-- wrapper -->
    </div>
    <!-- header-bottom -->
</div>
<!-- kp-page-header -->

<div id="main-content" class="clearfix">