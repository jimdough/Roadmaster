<?php
/**
 * @package xinmag
 * @since 1.0
 */
?>
<?php
	if ( is_active_sidebar( 'nav-widget-area' )  ) { ?>
	  <div id="nav-widget" class="widget-area">
		<div class="row"><div class="large-12 columns">
			<ul class="xoxo">
			<?php dynamic_sidebar( 'nav-widget-area' ); ?>
			</ul>
		</div></div>
	  </div>
<?php
	}
?>