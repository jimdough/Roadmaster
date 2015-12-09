<?php
/**
 * The template for displaying the footer.
 *
 * @package xinmag
 * @since xinmag 1.0
 */
?>
</div><!-- row -->
</div><!-- #main -->
<?php
	global $xinmag_layout;
	
	if ( 2 != $xinmag_layout )
		get_sidebar( 'footer' );
?>
<div id="footer">
	<div class="row">
		<div id="site-info" class="left">
		<?php esc_attr_e('&copy;', 'xinmag'); ?> <?php _e(date('Y')); ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php bloginfo( 'name' ); ?></a>
		</div>
		<div id="site-generator" class="right">
			<a href="<?php echo esc_url( __('http://www.xinthemes.com/','xinmag')); ?>" title="<?php esc_attr_e('Designed by Stephen Cui', 'xinmag'); ?>" rel="designer"><?php esc_attr_e('Xin Magazine Theme', 'xinmag'); ?></a>
		</div>
<?php
	if ( has_nav_menu( 'footer' ) ) {
		wp_nav_menu( array( 'container_class' => 'footer-menu', 'theme_location' => 'footer' ) );
    }
?>
	</div>
	<div class="back-to-top"><a href="#"><span class="icon-chevron-up"></span><?php _e(' TOP','xinmag'); ?></a></div>
</div><!-- #footer -->
</div><!-- #wrapper -->
<?php wp_footer(); ?>
</body>
</html>
