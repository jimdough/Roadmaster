<?php

/* 	News Press's Under Construction Page
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
<title><?php wp_title() ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php wp_enqueue_style('newspress-style', get_stylesheet_uri(), false, '1.5');?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php  wp_head(); ?>
</head>

<body>

	<header>
		<h1><?php echo of_get_option('uct1', 'We are working our butts off to finish this website'); ?></h1>
		<p><?php echo of_get_option('uct2', 'Our developers, are doing their best to finish this website before the counter, but we can not help them.'); ?></p>
	</header>

	<div id="main">
		
		<div id="counter"></div>
        
        <?php date_default_timezone_set('UTC'); 
		if (of_get_option('timelinem', date('m')) == '1'): 
		$timey = of_get_option('timeliney', date('Y')) -1; 
		$timem = '12'; 
		else: $timey = of_get_option('timeliney', date('Y')); 
		$timem = of_get_option('timelinem', date('m')) -1; 
		endif;
		$timed = of_get_option('timelined', date('d'));
		?>
        
        <script type="text/javascript">
		jQuery(document).ready(function(){
		var note = jQuery('#note'),
        ts = new Date(<?php echo $timey; ?>, <?php echo $timem; ?>, <?php echo $timed; ?> ),
        newYear = true;
		jQuery('#counter').countdown({
		timestamp : ts 
		});
		});
		</script>

		<form action="" method="get">
			<input type="text" class="email" placeholder="<?php echo of_get_option('uct3', 'Input your e-mail address here...'); ?>" required />
			<input type="submit" class="submit" value="<?php echo of_get_option('uct4', 'Let Me Notified'); ?>" />
		</form>

		<div class="social-media-arrow"></div>

	<footer><h2><?php echo of_get_option('uct5', 'Learn More from our Social Pages'); ?></h2>
		<div id="social">
	  <?php $numslinks = of_get_option('nslinks', '5'); foreach (range(1, $numslinks ) as $numslinksn) { 
	  if ( of_get_option('sl' . $numslinksn, '#') != '' ): echo '<a href="'. of_get_option('sl' . $numslinksn, '#') .'" target="_blank" > </a>'; endif;
	  } ?>
      </div>
      </footer>
	</div>
    <p class="upcreditline"><?php newspress_creditline(); ?></p>

</body>

<?php wp_footer(); ?>
</body>
</html>