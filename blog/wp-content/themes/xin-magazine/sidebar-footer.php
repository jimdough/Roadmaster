<?php
/**
 * @package xinmag
 * @since 1.0
 */
?>

<div id="footer-widget-area" role="complementary">
<div class="row">
<?php
	global $xinmag_options;	
	if ( is_active_sidebar( 'first-footer-widget-area' ) && $xinmag_options['column_footer1'] > 0 ) { ?>
		<div id="first" class="<?php echo xinwp_grid_columns( $xinmag_options['column_footer1'] ); ?> widget-area">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
			</ul>
		</div>
<?php
	}
	if ( is_active_sidebar( 'second-footer-widget-area' ) && $xinmag_options['column_footer2'] > 0) { ?>
		<div id="second" class="<?php echo xinwp_grid_columns( $xinmag_options['column_footer2'] ); ?> widget-area">	
			<ul class="xoxo">
				<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
			</ul>
		</div>
<?php
	}
	if ( is_active_sidebar( 'third-footer-widget-area' ) && $xinmag_options['column_footer3'] ) { ?>
		<div id="third" class="<?php echo xinwp_grid_columns( $xinmag_options['column_footer3'] ); ?> widget-area">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
			</ul>
		</div>
<?php
	}
	if ( is_active_sidebar( 'fourth-footer-widget-area' ) && $xinmag_options['column_footer4'] ) { ?>
		<div id="fourth" class="<?php echo xinwp_grid_columns( $xinmag_options['column_footer4'] ); ?> widget-area">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
			</ul>
		</div>
<?php
	} ?>
</div>
</div>