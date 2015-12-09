<?php

/* 	News Press's Header
	Copyright: 2014, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since NewsPress 1.0
*/

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title('|', true, 'right'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php wp_enqueue_style('newspress-style', get_stylesheet_uri(), false, '1.5');?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php 

wp_head(); ?>

</head>

<body <?php body_class(); ?> >
	
    <div id="site-container">
    <?php if ( of_get_option('adv01', '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('adv01', '')); ?></div><?php endif; ?>  
    
      <div id="top-menu-container">
      <nav id="newspress-top-menu"><?php if ( has_nav_menu( 'top-menu' ) ) :  wp_nav_menu( array( 'theme_location' => 'top-menu' )); endif; ?></nav>
      <?php if (of_get_option ('sbox-check', '1') == '1'): get_search_form(); endif; ?>  
      
      <?php if (of_get_option('lbox-check', 1) == '1'): if (!is_user_logged_in()): ?>
  		<ul class="lboxd">
        	<li><a href="#" class="loginicon"> </a>
            	<ul>
                	<li><?php $largs = array('label_username' => of_get_option('username', 'Username'), 'label_password' => of_get_option('password', "Password"), 'label_remember' => of_get_option('rememberme', "Remember Me"), 'label_log_in' => of_get_option('log-in', "Log In")); wp_login_form($largs); ?></li>
                    <li><a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" ><?php echo of_get_option('fp3', "Forget Password?"); ?></a></li>
                    <br /><div class="content-ver-sep"></div><br />
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-login.php?action=register"><h4><?php echo of_get_option('caa3', "Create an Account"); ?></h4></a></li>
                </ul>
            </li>
  		</ul>
        
  		<?php else : ?>
        
  		<ul class="lboxd">
        	<li><a href="#" class="loginicon"> </a>
            	<ul>
                	<li><?php global $current_user; get_currentuserinfo(); echo '<h4>' . of_get_option('welcome', "Welcome") . '&nbsp; ' . $current_user->display_name . '!</h4>'; ?></li>
                    <br /><div class="content-ver-sep"></div><br />
                    <li><a  href="<?php echo admin_url( 'profile.php' ); ?>"><h4><?php echo of_get_option('gtmp3', "Go to My Profile"); ?></h4></a></li>
                    <br /><div class="content-ver-sep"></div><br />
                    <li><a href="<?php echo wp_logout_url( get_permalink() ); ?>"><button><?php echo of_get_option('logout', "Logout"); ?></button></a></li>
              	</ul>
         	</li>
     	</ul>
        
  		<?php endif; endif;?>
  		<!--Login Form End-->
        <script type="text/javascript">jQuery(":input").attr("autocomplete","off");</script>
      
	  <div id="social">
	  <?php $numslinks = of_get_option('nslinks', '5'); foreach (range(1, $numslinks ) as $numslinksn) { 
	  if ( of_get_option('sl' . $numslinksn, '#') != '' ): echo '<a href="'. of_get_option('sl' . $numslinksn, '#') .'" target="_blank"> </a>'; endif;
	  } ?>
      </div>
      
	  
      </div>
      
      <div id ="header">
      <?php if ( of_get_option('adv02', '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('adv02', '')); ?></div><?php endif; ?>
      <div id ="header-content">
      
		<!-- Site Titele and Description Goes Here -->
        <div class="topadlft"><?php echo do_shortcode(of_get_option('adv03', '<a href="#" target="_blank"><img src ="'. get_template_directory_uri() . '/images/ad3.png" /></a>')); ?></div> 
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php if ( of_get_option('site-logo', get_template_directory_uri() . '/images/logo.png') != '' ): ?><img class="site-logo" src="<?php echo of_get_option('site-logo', get_template_directory_uri() . '/images/logo.png'); ?>" /><h1 class="site-title-hidden"><?php echo bloginfo( 'name' ); ?></h1><?php else: ?><h1 class="site-title"><?php echo bloginfo( 'name' ); ?></h1><?php endif; ?></a>
                
        <?php if ( of_get_option('site-descrip', '0' ) != '1' ) : ?><h2 class="site-title-hidden"><?php echo bloginfo( 'description' ); ?></h2><?php else: ?>
        <h2 class="site-title-desc"><?php echo bloginfo( 'description' ); ?></h2><?php endif; ?>
        
        <div class="topadrt"><?php echo do_shortcode(of_get_option('adv04', '<a href="#" target="_blank"><img src ="'. get_template_directory_uri() . '/images/ad3.png" /></a>')); ?></div> 
        
        </div><!-- header-content -->
        <div class="heading-date"><?php if (of_get_option('website-date', date_i18n("l, F j, Y") ) !='' ): echo do_shortcode(of_get_option('website-date', date_i18n("l, F j, Y") ));  else: echo date_i18n("l, F j, Y"); endif; ?></div>  
        </div><!-- header -->    
        <!-- Site Main Menu Goes Here -->
        <nav id="newspress-main-menu">
		<?php if ( has_nav_menu( 'main-menu' ) ) :  wp_nav_menu( array( 'theme_location' => 'main-menu' )); else: wp_page_menu(); endif; ?>
        </nav>
      <div class="clear"> </div>
      <div id="container"> 
      
      
      
      
      
      
	  