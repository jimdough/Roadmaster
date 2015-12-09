<?php
/**
 * @package xinmag
 * @since xinmag 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 9]><html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title('|', true, 'right'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
  <header id="masthead" class="site-header">
<?php
	global $xinmag_layout;
	
	xinmag_top_menu();
	if ( 2 != $xinmag_layout ) {
?>
	<div class="row">	
		<?php xinmag_branding(); ?>
    </div>
<?php
		get_sidebar( 'navigation' );
		xinmag_section_header();
	}
?>
  </header>
<?php xinwp_header_before_main(); //Action Hooks ?>
<div id="main">
<?php
	global $xinmag_options;
	
?>
<div class="row row-container">
