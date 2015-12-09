<?php
/**
 * Functions that output contents
 * 
 * @package	xincore
 * @since   1.0
 * @author  XinThemes
 * @license GPL v3 or later
 * @link    http://www.xinthemes.com/
 */
//Section Menu
if ( ! function_exists( 'xinwp_section_menu' ) ):
function xinwp_section_menu( $id = 'section-menu', $search = false ) {
	if ( has_nav_menu( 'section' ) ) {
		echo '<nav id="' . $id. '" class="section-menu clearfix">';
		wp_nav_menu( array(
			'theme_location'  => 'section',
			'container'       => false,
			'fallback_cb'     => false,
		));
		if ( $search )
			get_search_form();
		echo '</nav>';
	}
}
endif;

if ( ! function_exists( 'xinwp_single_post_link' ) ) :
/* This function echo the link to single post view for the following:
- Aside Post
- Post without title
------------------------------------------------------------------------- */
function xinwp_single_post_link() {
	if ( ! is_single() ) {
		if ( has_post_format( 'aside' ) || has_post_format( 'quote' ) || '' == the_title_attribute( 'echo=0' ) ) { 
			printf ('<a class="single-post-link" href="%1$s" title="%1$s"><i class="icon-chevron-right"></i></a>',
				get_permalink(),
				get_the_title()	);
		} 
	}
}
endif;