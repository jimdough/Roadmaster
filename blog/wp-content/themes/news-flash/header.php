<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php newsflash_favicon(); ?>
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="container" id="mainc">
    <div class="row">
        <div class="col-md-12">
            <div class="branding">
            <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>"><?php newsflash_get_site_logo(); ?></a>
            <span class="text-right">
                <?php bloginfo( 'description' ); ?>
            </span>
            </div>
        </div>
    </div>
    <div class="navbar navbar-color navbar-static-top" id="topnav">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="fa fa-reorder"></span>

            </button>

        </div>
        <div class="navbar-collapse collapse">


            <?php


            $args = array(
                'theme_location' => 'primary',
                'depth' => 9,
                'container' => false,
                'menu_class' => 'nav navbar-nav',
                'fallback_cb' => false,
                'walker' => new newsflash_bootstrap_walker_nav_menu()
            );


            wp_nav_menu($args);


            ?>

        </div>
        <!--/.navbar-collapse -->

    </div>
<div id="mainb">
