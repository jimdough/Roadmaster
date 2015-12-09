<?php
/**
 * Xin Core Functions
 * 
 * @package	xincore
 * @since   1.0
 * @author  XinThemes
 * @license GPL v3 or later
 * @link    http://www.xinthemes.com/
 */
if ( ! defined('ABSPATH') ) exit;

if ( ! function_exists( 'xinwp_setup' ) ):
function xinwp_setup() {
	// Featured Image
	add_theme_support( 'post-thumbnails' );
	// Feed Links required by WordPress
	add_theme_support( 'automatic-feed-links' );
	// Post Formats	
	add_theme_support( 'post-formats', array( 'aside', 'link', 'quote' ) );
	// Load Text Domain: Theme specific
	load_theme_textdomain( XINWP_ID, get_template_directory() . '/xinwp/languages' );
	// Load Text Domain: Framework specific
	load_theme_textdomain( 'xinwp', get_template_directory() . '/xinwp/languages' );
	// Editor Style
	add_editor_style();
	// Custom Background
	add_theme_support( 'custom-background', array(
		'default-color' => '', //Default background color
	) );
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
	
	remove_filter( 'term_description', 'wpautop' );
}
endif;
add_action( 'after_setup_theme', 'xinwp_setup' );

function xinwp_widgets_init() {
	register_widget( 'XinWP_Recent_Post' );
	register_widget( 'XinWP_Navigation' );

	// Full Sidebar 
	register_sidebar( array(
		'name' => __( 'Blog Widget Area (Full)', 'xinwp' ),
		'id' => 'full-widget-area',
		'description' => __( 'Available for Left or Right sidebar layout.', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );	
	// First Sidebar - left or right
	register_sidebar( array(
		'name' => __( 'Blog Widget Area 1', 'xinwp' ),
		'id' => 'first-widget-area',
		'description' => __( 'Blog Widget Area 1', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	// Second Sidebar - left or right
	register_sidebar( array(
		'name' => __( 'Blog Widget Area 2', 'xinwp' ),
		'id' => 'second-widget-area',
		'description' => __( 'Blog Widget Area 2', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	// Header Widget Area
	register_sidebar( array(
		'name' => __( 'Header Widget Area', 'xinwp' ),
		'id' => 'header-widget-area',
		'description' => __( 'Header Widget Area', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	

	// Nav Widget Area
	register_sidebar( array(
		'name' => __( 'Navigation Widget Area', 'xinwp' ),
		'id' => 'nav-widget-area',
		'description' => __( 'Navigation Widget Area', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	if ( XINWP_HOME_WIDGETS ) {
	// Home Widget Areas
	register_sidebar( array(
		'name' => __( 'Home Widget Area 1', 'xinwp' ),
		'id' => 'first-home-widget-area',
		'description' => __( 'Home Widget Area 1', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => __( 'Home Widget Area 2', 'xinwp' ),
		'id' => 'second-home-widget-area',
		'description' => __( 'Home Widget Area 2', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => __( 'Home Widget Area 3', 'xinwp' ),
		'id' => 'third-home-widget-area',
		'description' => __( 'Home Widget Area 3', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => __( 'Home Widget Area 4', 'xinwp' ),
		'id' => 'fourth-home-widget-area',
		'description' => __( 'Home Widget Area 4', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array(
		'name' => __( 'Home Widget Area 5', 'xinwp' ),
		'id' => 'fifth-home-widget-area',
		'description' => __( 'Home Widget Area 5', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	} // Home Widgets

	// Footer Widgets
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 1', 'xinwp' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'Footer Widget Area 1', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widget Area 2', 'xinwp' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'Footer Widget Area 2', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widget Area 3', 'xinwp' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'Footer Widget Area 3', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widget Area 4', 'xinwp' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'Footer Widget Area 4', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

	if ( XINWP_BBP_WIDGETS ) {
	// bbPress/BuddyPress Widget Area
	register_sidebar( array(
		'name' => __( 'bbPress/BuddyPress Widget Area', 'xinwp' ),
		'id' => 'bbp-widget-area',
		'description' => __( 'bbPress/BuddyPress Widget Area', 'xinwp' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	}	
}
add_action( 'widgets_init', 'xinwp_widgets_init' );

if ( ! function_exists( 'xinwp_header_style_cb' ) ) :
function xinwp_header_style_cb() {
	$text_color = get_header_textcolor();
	if ( $text_color == HEADER_TEXTCOLOR ) //Default Text Color. Doing Nothing
		return;
?>
<style type="text/css">
<?php
	if ( 'blank' == $text_color ) { // Blog Text is unchecked
?>
#site-title,
#site-description {
	position: absolute !important;
	clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
	clip: rect(1px, 1px, 1px, 1px);
}
<?php
	} else { // Custom color
?>
#site-title a,
#site-description {
	color: #<?php echo $text_color; ?> !important;
}
<?php
	}
?>
</style>
<?php
}
endif;
// Get Theme Options
function xinwp_get_options() {
	$options = wp_parse_args( get_option( XINWP_ID . '_theme_options' ), apply_filters( 'xinwp_default_options', null ) );
	return apply_filters( 'xinwp_options', $options );
}

function xinwp_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	$title .= get_bloginfo( 'name' );
	
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'xinwp' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'xinwp_wp_title', 10, 2 );

// Add <p> tag to WordPress the_excerpt()
function xinwp_excerpt_filter( $content ) {
	return '<p>' . $content . '</p>';
}
remove_filter('the_excerpt', 'wpautop');
add_filter( 'the_excerpt', 'xinwp_excerpt_filter' );

// Remove Jetpack Sharing from Excerpt
function xinwp_remove_sharing_filters() {
	if ( function_exists( 'sharing_display' ) ) {
		remove_filter( 'the_excerpt', 'sharing_display', 19 );
	}
}
add_action('xinwp_header_before_main','xinwp_remove_sharing_filters');
/** 
* Add span to category/archive count
*/
function xinwp_category_count_span($links) {
  $links = str_replace( '</a> (', '</a> <span>(', $links );
  $links = str_replace( ')', ')</span>', $links );
  return $links;
}
add_filter( 'wp_list_categories', 'xinwp_category_count_span' );

function xinwp_archive_count_span($links) {
  $links = str_replace( '</a>&nbsp;(', '</a> <span>(', $links );
  $links = str_replace( ')', ')</span>', $links );
  return $links;
}
add_filter( 'get_archives_link', 'xinwp_archive_count_span' );


if ( ! function_exists( 'xinwp_comment' ) ) :
function xinwp_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) {
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'xinwp' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( '<i class="icon-pencil"></i> ' . __( '[Edit]', 'xinwp' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-meta">
<?php 				echo get_avatar( $comment, 40 );
					printf( '<cite class="fn">%1$s</cite>', get_comment_author_link() );  ?>
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						printf( __( '%1$s at %2$s', 'xinwp' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( '<i class="icon-pencil"></i> ' . __( '[Edit]', 'xinwp' ), ' ' );					
					if ( $comment->comment_approved == '0' ) { ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'xinwp' ); ?></em>
<?php 				}; ?>
				</div>
			</footer>
			<div class="comment-content"><?php comment_text(); ?></div>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</article>
	<?php
			break;
	}
}
endif;

function xinwp_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'xinwp_excerpt_length' );

function xinwp_auto_excerpt_more( $more ) {
	return ' &hellip;';
}
add_filter( 'excerpt_more', 'xinwp_auto_excerpt_more' );

function xinwp_custom_excerpt_more( $output ) {
	if ( ! is_attachment() ) {
		$output .= xinwp_readmore_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'xinwp_custom_excerpt_more' );

/**
 * Replace rel="category tag" with rel="tag"
 * For W3C validation purposes only.
 */
function xinwp_replace_rel_category ($output) {
    $output = str_replace(' rel="category tag"', ' rel="tag"', $output);
    return $output;
}
add_filter('wp_list_categories', 'xinwp_replace_rel_category');
add_filter('the_category', 'xinwp_replace_rel_category');

function xinwp_scripts_method() {
	global $xinwp_options, $xinwp_fonts;
	
	$theme_uri = get_template_directory_uri();
	// Check if the fonts are webfont, if yes, load the font.
	$xinwp_fonts = xinwp_fonts_array();
	$font_elements = array(
			'bodyfont','headingfont','entrytitlefont',
			'sitetitlefont','sitedescfont', 'mainmenufont',
			'sidebarfont', 'widgettitlefont', 'footerfont'
	);
	$fonts = array();
	foreach ( $font_elements as $element ) {
		if ( $xinwp_options[$element] > 0
				&& ! in_array( $xinwp_options[ $element ], $fonts) )
			$fonts[] = $xinmag_options[ $element ];		
	}

	foreach ( $fonts as $font ) {
		if ( ! empty( $xinwp_fonts[ $font ]['url'] ) )
			wp_enqueue_style( str_replace(' ', '', $xinwp_fonts[ $font ]['label']), $xinwp_fonts[ $font ]['url'], false, 1.0 );
	}
// Foundation CSS
	wp_enqueue_style('xinwp-addons', $theme_uri . '/xinwp/css/addons.min.css', false, XINWP_VERSION);
	wp_enqueue_style('xinwp-foundation', $theme_uri . '/xinwp/css/foundation.min.css', array( 'xinwp-addons' ), '4.1.7');
// Javascript
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );	
	wp_enqueue_script( 'modernizr' , $theme_uri . '/xinwp/js/custom.modernizr.js', null, true );
	wp_enqueue_script( 'easing' , $theme_uri . '/xinwp/js/jquery.easing.js', array( 'jquery'), null, true );
	wp_enqueue_script( 'foundation' , $theme_uri . '/xinwp/js/foundation.min.js', array( 'jquery'), '4.1.7', true );
	if ( has_nav_menu( 'section' ) )
		wp_enqueue_script( 'xinwp-mobilemenu' , $theme_uri . '/xinwp/js/jquery.mobilemenu.min.js', array( 'jquery'), '4.1.7', true );
}
if ( ! is_admin() )
	add_action( 'wp_enqueue_scripts', 'xinwp_scripts_method' ); 
	
require( get_template_directory() . '/xinwp/general.php' );
require( get_template_directory() . '/xinwp/hooks.php' );
require( get_template_directory() . '/xinwp/lib-foundation.php' );
require( get_template_directory() . '/xinwp/lib-content.php' );
require( get_template_directory() . '/xinwp/fonts.php' );
require( get_template_directory() . '/xinwp/widgets.php' );

if ( is_admin() ) {
	require( get_template_directory() . '/xinwp/core-admin.php' );
	require( get_template_directory() . '/xinwp/options.php' );
}