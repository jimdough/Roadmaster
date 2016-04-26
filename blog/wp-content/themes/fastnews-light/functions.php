<?php
define('KOPA_THEME_URL', 'http://kopatheme.com/freebies/fast-news-magazine-wordpress-theme-light-version/');
define('KOPA_THEME_NAME', 'FastNews Light');

#MENU WALKER
require get_template_directory() . '/library/menu_walker.php';
#LAYOUT
require get_template_directory() . '/library/sidebar.php';
require get_template_directory() . '/library/layout.php';
require get_template_directory() . '/library/front.php';
require get_template_directory() . '/library/backend.php';

#CUSTOMIZE
require get_template_directory() . '/api/kopa-customization.php';
require get_template_directory() . '/api/TGMPluginActivation.class.php';
require get_template_directory() . '/api/bfithumb.php';
require get_template_directory() . '/library/customizer.php';
require get_template_directory() . '/library/customize.php';

#PLUGIN
require get_template_directory() . '/library/plugin.php';
