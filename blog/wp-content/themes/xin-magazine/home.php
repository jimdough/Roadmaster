<?php
/**
 * Default Home Page
 * 
 * @package xinmag
 * @since 1.0
 */
	global $xinmag_options;
	get_header();
	
	if ( 'page' == get_option( 'show_on_front' ) || 2 == $xinmag_options['homepage'] ) {
?>  
	<div id="content" class="<?php echo xinwp_content_class(); ?>" role="main">
<?php
		if ( have_posts() ) {
			xinmag_content_nav( 'nav-above' );
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', get_post_format() );
			}				
			xinmag_content_nav( 'nav-below' );
		} elseif ( current_user_can( 'edit_posts' ) ) {
			get_template_part( 'content-none', 'index' );
		} ?>						
	</div>
<?php
		get_sidebar();
	} elseif ( 1 == $xinmag_options['homepage'] ) {
		get_template_part( 'pages/magazine'  );
	}
	get_footer();
?>