<?php
/**
 * The Sidebar containing the First and Second widget areas.
 *
 * @package xinmag
 * @since xinmag 1.0
 */
	global $xinmag_options;

	$width = $xinmag_options['sidebar1'] + $xinmag_options['sidebar2'];
	if ( 3 != $xinmag_options['sidebarpos'] && $width > 0 && is_active_sidebar( 'full-widget-area' ) ) {
		if ( ( $width + $xinmag_options['content'] ) > 12 ) 
			$width = 12 - $xinmag_options['content'];
		$sidebar_class = 'large-' . $width;
		if ( 2 == $xinmag_options['sidebarpos'] )
			$sidebar_class .= " pull-" . $xinmag_options['content'];
		$sidebar_class .= ' columns' ?>
		<aside id="sidebar_full" class="<?php echo $sidebar_class; ?> widget-area blog-widgets" role="complementary">
			<ul class="xoxo">
<?php			dynamic_sidebar( 'full-widget-area' );	?>
			</ul>
		</aside>
<?php
	}
	if ( $xinmag_options['sidebar1'] > 0 ) {
		$sidebar_class = 'large-' . $xinmag_options['sidebar1'];
		if ( 1 != $xinmag_options['sidebarpos'] )
			$sidebar_class .= " pull-" . $xinmag_options['content'];
			$sidebar_class .= ' columns';
?>	
		<aside id="sidebar_one" class="<?php echo $sidebar_class; ?> widget-area blog-widgets" role="complementary">
		<ul class="xoxo">		
<?php		if ( is_active_sidebar( 'first-widget-area' ) ) {
				dynamic_sidebar( 'first-widget-area' );	
			}
			elseif ( ! is_active_sidebar( 'second-widget-area' ) || 0 == $xinmag_options['sidebar2'] ) { //If no sidebar used at all, show some default widgets
				//xinmag_default_widgets();				
			}
?>
		</ul>
		</aside>
<?php
	}
	// Second Sidebar
	if ( is_active_sidebar( 'second-widget-area' ) && ( $xinmag_options['sidebar2'] > 0) ) {
		$sidebar_class = "large-" . $xinmag_options['sidebar2'];
		$sidebar_class .= ' columns';
		if ( 2 == $xinmag_options['sidebarpos'] )
			$sidebar_class = $sidebar_class . " pull-" . $xinmag_options['content'];
?>
		<aside id="sidebar_two" class="<?php echo $sidebar_class; ?> widget-area blog-widgets" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'second-widget-area' ); ?>
			</ul>
		</aside>
<?php
	}
?>	
