<?php get_header(); 
global $wdwt_front;
$wdwt_front =  new news_magazine_front($wdwt_options); ?>
</header>
<div class="container">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
		<aside id="sidebar1" >
			<div class="sidebar-container">			
				<?php  dynamic_sidebar( 'sidebar-1' ); 	?>
				<div class="clear"></div>
			</div>
		</aside>
	<?php } 
	news_magazine_frontend_functions::content_posts_for_home();
	if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
		<aside id="sidebar2">
			<div class="sidebar-container">
			  <?php  dynamic_sidebar( 'sidebar-2' ); 	?>
			  <div class="clear"></div>
			</div>
		</aside>
	<?php } ?>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>