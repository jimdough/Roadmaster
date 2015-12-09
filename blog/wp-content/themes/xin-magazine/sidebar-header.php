<?php
/**
 * @package xinmag
 * @since xinmag 1.0
 */
?>
<?php
	if ( is_active_sidebar( 'header-widget-area' )  ) { ?>
	  <div id="header-widget" class="right widget-area">
		<ul class="xoxo">
			<?php dynamic_sidebar( 'header-widget-area' ); ?>
		</ul>
	  </div>
<?php
	}
?>

