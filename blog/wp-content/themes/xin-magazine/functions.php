<?php
/**
 * Xin Magazine Functions
 * 
 * @package	xinmag
 * @since   1.0
 * @author  XinThemes
 * @license GPL v3 or later
 * @link    http://www.xinthemes.com/
 */
// Global variable for content width
if ( ! isset( $content_width ) ) 
	$content_width = 690; // pixels
//Load Core functions
require_once( get_template_directory() . '/inc/theme-settings.php' );
require_once( get_template_directory() . '/xinwp/core-functions.php' );
	
add_action( 'after_setup_theme', 'xinmag_setup' );
if ( ! function_exists( 'xinmag_setup' ) ):
function xinmag_setup() {						
	register_nav_menus( array(
		'top-bar' => __( 'Top Menu' , 'xinmag' ),
		'footer' => __( 'Footer Menu', 'xinmag' ),
	));

	// Custom Header
	$custom_header_support = array(
		'default-image'		=> get_template_directory_uri() . '/images/logo.png',
		'flex-width'        => true,
		'flex-height'		=> true,
	    'header-text'		=> true,
		'default-text-color' => '000000',		
		'width' 			=> apply_filters( 'xinwp_header_image_width', 300 ),
		'height' 			=> apply_filters( 'xinwp_header_image_height', 110 ),
		// Callback for styling the header.
		'wp-head-callback' => 'xinwp_header_style_cb',
		// Callback for styling the header preview in the admin.
		'admin-head-callback' => 'xinwp_admin_header_style_cb',
		// Callback used to display the header preview in the admin.
		'admin-preview-callback' => 'xinwp_admin_header_image_cb',
	);
	add_theme_support( 'custom-header', $custom_header_support );	

	register_default_headers( array(
		'header' => array(
			'url' => '%s/images/logo.png',
			'thumbnail_url' => '%s/images/logo.png',
			'description' => __( 'Logo', 'xinwp' )
		),
	) );

	add_image_size( 'xinmag-section', 400, 250, true);
}
endif;

if ( ! function_exists( 'xinmag_content_nav' ) ) :
/**
Pagination for main loop
 */
function xinmag_content_nav( $nav_id ) {
	global $wp_query;
	xinmag_content_nav_link( $wp_query->max_num_pages, $nav_id );
}
endif;

if ( ! function_exists( 'xinmag_content_nav_link' ) ) :
/**
Pagination 
 */
function xinmag_content_nav_link( $num_of_pages, $nav_id ) {
	if ( $num_of_pages > 1 ) {
		echo '<nav id="' . $nav_id . '" class="pagination-centered">';
		echo '<ul class="pagination">';

		$big = 999999999;
    	if ( get_query_var( 'paged' ) )
	    	$current_page = get_query_var( 'paged' );
		elseif ( get_query_var( 'page' ) ) 
	   	 	$current_page = get_query_var( 'page' );
		else 
			$current_page = 1;
		$links =  paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, $current_page ),
			'total' => $num_of_pages,
			'mid_size' => 3,
			'prev_text'    => '<i class="icon-chevron-left"></i>' ,
			'next_text'    => '<i class="icon-chevron-right"></i>' ,
			'type' => 'array' ) );
			
		echo '<li><span>' . __( 'Page ', 'xinmag' ) . '</span></li>';
		foreach ( $links as $link )
			printf( '<li>%1$s</li>', $link );
		echo '</ul></nav>';					
	}
}
endif;

if ( ! function_exists( 'xinmag_meta_category' ) ) :
// Prints Post Categories
function xinmag_meta_category() {
	$categories = wp_get_post_categories( get_the_ID() , array('fields' => 'ids'));
	if( $categories ) {
 		$sep = ' &bull; ';
 		$cat_ids = implode( ',' , $categories );
 		$cats = wp_list_categories( 'title_li=&style=none&echo=0&include='.$cat_ids);
 		$cats = rtrim( trim( str_replace( '<br />',  $sep, $cats) ), $sep);
		echo '<span class="entry-category">';
		echo '<span class="meta-prep"><i class="icon-folder-open meta-icon"> </i></span>';	
 		echo  $cats;
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'xinmag_meta_author' ) ) :
function xinmag_meta_author() {
	printf( '<span class="by-author"><a class="url fn n" href="%1$s" title="%2$s" rel="author"><span class="meta-prep">%4$s</span> %3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'xinmag' ), get_the_author() ) ),
		get_the_author(),
		'<i class="icon-user meta-icon"> </i>' );
	
}
endif;


if ( ! function_exists( 'xinmag_meta_comment' ) ) :
// Prints Comments Link
function xinmag_meta_comment() {
	if ( comments_open() && ! post_password_required() ) {
		$comment_icon = '<i class="icon-comment meta-icon"> </i>';
		printf( '<span class="meta-comment">' );
		comments_popup_link( $comment_icon, $comment_icon . __( '1 Comment', 'xinmag' ) , $comment_icon . __( '% Comments', 'xinmag' ) );		
		printf( '</span>' );
	}
}
endif;

if ( ! function_exists( 'xinmag_meta_date' ) ) :
// Prints Post Date
function xinmag_meta_date( $style = 1) {
	if ( 1 == $style ) {
		echo '<p class="post-date-2">';
		echo '<span class="month">' . get_the_date('M') . '</span>';
		echo '<span class="day">' . get_the_date('j') . '</span>';
		echo '<span class="year">' . get_the_date('Y') . '</span></p>';
	} elseif ( 2 == $style ) {
		echo '<i class="icon-calendar meta-icon"> </i>';
		printf( __( '<time class="entry-date" datetime="%1$s">%2$s</time>', 'xinmag' ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ) );				
	} 
}
endif;

if ( ! function_exists( 'xinmag_meta_tag' ) ) :
// Prints Post Tags
function xinmag_meta_tag() {
	$tags_list = get_the_tag_list( '', __( ' &bull; ', 'xinmag' ) );
	if ( $tags_list ) {
		echo '<span class="entry-tags"><i class="icon-tags meta-icon"> </i>';
		printf( '<span class="entry-tag">%1$s</span>',
		$tags_list );
		echo '</span>';
	} 
}
endif;

if ( ! function_exists( 'xinmag_post_meta' ) ) :
function xinmag_post_meta() {
	if ( 'post' == get_post_type() ) {
		echo '<span class="entry-meta">';		
		if ( is_sticky() ) {
			printf( '<span class="entry-featured">%1$s </span>', __( 'Featured ', 'xinmag') );
		}
		xinmag_meta_author();
		xinmag_meta_category();
		xinmag_meta_comment();			
		echo '</span>';	
	}
}
endif;

if ( ! function_exists( 'xinmag_post_tag' ) ) :
// Prints tages, edit link at the bottom of the post
function xinmag_post_tag() {
	printf ('<div class="entry-meta entry-meta-bottom">');	
	if ( 'post' == get_post_type() )
		xinmag_meta_tag();
/*	if ( is_singular() && ! is_home() )
		printf( __(' <a href="%1$s" title="Permalink to %2$s" rel="bookmark">Permalink</a>', 'xinmag' ),
				esc_url( get_permalink() ),
				the_title_attribute( 'echo=0' )
			); */
	edit_post_link( '<i class="icon-pencil"></i> ' . __( '[Edit]', 'xinmag' ), '<span class="edit-link">', '</span>' );
	echo '</div>';	
}
endif;

if ( ! function_exists( 'xinmag_post_summary_meta' ) ) :
// Prints meta info for Post Summary
function xinmag_post_summary_meta( $meta_flag = 0 ) {
	global $xinwp_entry_meta;
	
	echo '<div class="entry-meta entry-meta-summary clearfix">';
	if ( ( $xinwp_entry_meta || $meta_flag ) && 'post' == get_post_type() ) {
		xinmag_meta_date( 2 );
		xinmag_meta_author();
		xinmag_meta_category();
		xinmag_meta_tag();
		xinmag_meta_comment();
	}
	edit_post_link( '<i class="icon-pencil"></i> ' . __( '[Edit]', 'xinmag' ), '<span class="edit-link">', '</span>' );	
	echo '</div>';	
}
endif;

function xinmag_body_classes( $classes ) {
	global $xinmag_options, $xinmag_layout;
			
	if ( ! is_single() )
		$classes[] = 'multi';
	elseif ( 2 == $xinmag_layout )
		$classes[] = 'fullscreen';
	return $classes;
}
add_filter( 'body_class', 'xinmag_body_classes' );

function xinmag_scripts_method() {	
	global $xinmag_options;

	$theme_uri = get_template_directory_uri();		

	wp_enqueue_style('xinmag', $theme_uri . '/css/xinmag.css', array( 'xinwp-foundation' ), XINWP_VERSION);
	$child_pre = array( 'xinmag' );
	// Load Scheme CSS
	if ( ! empty( $xinmag_options['schemecss'] ) ) {
		wp_enqueue_style('xinmag-scheme', $xinmag_options['schemecss'], $child_pre, XINWP_VERSION );
		$child_pre[] = 'xinmag-scheme';		
	}
	//Load child theme's style.css
    if ( $theme_uri != get_stylesheet_directory_uri() )
		wp_enqueue_style('xinmag-child', get_stylesheet_uri(), $child_pre, XINWP_VERSION );

	// Page Template specific
	if ( is_page_template( 'pages/portfolio.php' ) ) {
		wp_enqueue_script( 'infinite-scroll' , $theme_uri . '/js/jquery.infinitescroll.min.js', array( 'jquery-masonry' ), '2.0', true );	
		$xinmag_dep[] = 'infinite-scroll';
	}		
	//Scripts
	wp_enqueue_script( 'flexslider' , $theme_uri . '/js/jquery.flexslider-min.js', array( 'jquery'), '2.0', true );
	wp_enqueue_script( 'xinmag' , $theme_uri . '/js/xinmag.js', array( 'foundation', 'flexslider'), XINWP_VERSION, true );
}
if ( ! is_admin() )
	add_action( 'wp_enqueue_scripts', 'xinmag_scripts_method' ); 

function xinmag_options( $options ) {
	//assign default color for each section;
	$cats = xinmag_top_categories();
	foreach ( $cats as $cat ) {
		$color_option = 'color_' . $cat->term_id;
		if ( ! isset( $options[ $color_option ] ) )
			$options[ $color_option ] = '#888888'; 
	}
	if ( empty( $options['section_order'] ) ) {
		$colors = array( '#0072BC',
						 '#88307F',
						 '#00AAAD',
						 '#8DC63F',
						 '#FAA61A',
						 '#888888' );
		$count = 0;
		$data = '';
		$css = '';
		foreach ($cats as $cat) {
			$color_option = 'color_' . $cat->term_id;
			$options[ $color_option ] = $colors[ $count ];
			$data .= 'section[]=' . $cat->term_id . '&';
			$css .= '.color_' . $cat->term_id . ' { color:' . $colors[ $count ] . '; } ' . "\n";
			$css .= '.bdcolor_' . $cat->term_id . ' { border-color:' . $colors[ $count ] . '; } ' . "\n";
			$css .= '.bgcolor_' . $cat->term_id . ' { background-color:' . $colors[ $count ] . '; } ' . "\n";
			$count++;
			if ( $count > 5 )
				break;
		}
		$options['section_order'] = $data;
		$options['xinmag_scheme_css'] = $css;
	}
	return $options;
}
add_filter( 'xinwp_options' , 'xinmag_options' );

function xinmag_default_options() {
	$defaults = array(
		'currenttab' => 0,	
		'homepage' => 1,
		'fp_option' => 1,
		'fp_category' => 0,
		'fp_effect' => 'slide',
		'fp_postnum' => 10,
		'gridwidth' => 1080,
		'content' => 8,
		'sidebar1' => 2,
		'sidebar2' => 2,
		'sidebarpos' => 1,
		'sidebarresp' => 0,
		'respbp' => 960,
		'column_footer1' => 4,
		'column_footer2' => 4,
		'column_footer3' => 4,
		'column_footer4' => 0,
		'brandname' => 'Your LOGO',
		'brandlogo' => '',
		'brandurl' => '',
		'menupos' => 'right',
		'xinmag_inline_css' => '',
		'xinmag_scheme_css' => '',
		'bodyfont' => 0,
		'sitetitlefont' => 0,
		'sitedescfont' => 0,
		'entrytitlefont' => 0,
		'headingfont' => 0,
		'widgettitlefont' => 0,
		'sidebarfont' => 0,
		'footerfont' => 0,
		'mainmenufont' => 0,
		'otherfont1' => '',
		'otherfont2' => '',
		'otherfont3' => '',
		'otherfont4' => '',
		'colorscheme' => '0',
		'schemecss' => '',
		'headerbg' => '',
		'titlebarbg' => '',
		'contentbg' => '',
		'footerbg' => '',
		'section_order' => '',
		'section_postnum' => 5,
	);
	return $defaults;
}
add_filter( 'xinwp_default_options', 'xinmag_default_options' );

if ( ! function_exists( 'xinmag_top_categories' ) ) : 
function xinmag_top_categories() {
	$args = array(
		'orderby' => 'count',
		'order' => 'DESC',
		'parent' => 0 );
	$categories = get_categories( $args );
	return apply_filters( 'xinmag_top_categories', $categories );
}
endif;

function xinmag_custom_css() {
	global $xinmag_options, $xinwp_fonts;
	// Inpage CSS
	echo '<!-- Custom CSS Styles -->' . "\n";
    echo '<style type="text/css" media="screen">' . "\n";
    if ( ! empty($xinmag_options['xinmag_scheme_css'] ) )
		echo $xinmag_options['xinmag_scheme_css'] . "\n";
    if ( ! empty($xinmag_options['xinmag_inline_css'] ) )
		echo $xinmag_options['xinmag_inline_css'] . "\n";
	echo '</style>' . "\n";
}
add_action( 'wp_head', 'xinmag_custom_css' );

require_once( get_template_directory() . '/inc/lib-content.php' );
require_once( get_template_directory() . '/scheme/scheme.php' );
if ( is_admin() ) {
	require_once( get_template_directory() . '/inc/theme-options.php' );
}

$xinmag_options = xinwp_get_options(); //Global Theme Options
$xinwp_options = $xinmag_options;
