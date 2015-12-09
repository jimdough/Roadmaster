<?php
/* 	News Press's Functions
	Copyright: 2014, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since NewsPress 1.0
*/
   
  
  	register_nav_menus( array( 'main-menu' => "Main Menu", 'top-menu' => "Top Menu" ) );

//	Set the content width based on the theme's design and stylesheet.
	if ( ! isset( $content_width ) ) $content_width = 684;

// 	Load the D5 Framework Optios Page
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
	require_once dirname( __FILE__ ) . '/inc/npmeta.php';

	
// 	Tell WordPress for wp_title in order to modify document title content
	function newspress_wp_title( $title, $sep ) {
	if ( is_feed() ) { return $title; }
	global $page, $paged;
	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}
	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( ' %s', max( $paged, $page ) );
	}
	return $title;
	}
	add_filter( 'wp_title', 'newspress_wp_title', 10, 2 );
	
	function default_attachment_display_settings() {
	update_option( 'image_default_align', 'right' );
	update_option( 'image_default_link_type', 'none' );
	update_option( 'image_default_size', 'full' );
	}
	add_action( 'after_setup_theme', 'default_attachment_display_settings' );
	
// 	Tell WordPress for the Feed Link
	add_editor_style();
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );


    add_theme_support( 'post-thumbnails' );
	add_image_size( 'post-page', 350, 175, true );
	add_image_size( 'cat-page', 400, 200, true );
	add_image_size( 'single-page', 900, 450, true );
	set_post_thumbnail_size( 350, 175, true );

	
	
	function newspress_gallery_atts( $out, $pairs, $atts ) {
	if (is_front_page()): $newspressgalsize = 'large'; else: $newspressgalsize = 'cat-page'; endif;
    $atts = shortcode_atts( array(
        'columns' => '2',
        'size' => $newspressgalsize,
         ), $atts );
 
    $out['columns'] = $atts['columns'];
    $out['size'] = $atts['size'];
    return $out;
 
	}
	add_filter( 'shortcode_atts_gallery', 'newspress_gallery_atts', 10, 3 );
	
	
		
// 	WordPress 3.4 Custom Background Support	
	$newspress_custom_background = array(
	'default-color'          => 'FFFFFF',
	'default-image'          => '',
	);
	add_theme_support( 'custom-background', $newspress_custom_background );
	
// 	WordPress 3.4 Custom Header Support				
	$newspress_custom_header = array(
	'default-image'          => get_template_directory_uri() . '/images/logo.png',
	'random-default'         => false,
	'width'                  => 300,
	'height'                 => 90,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '000000',
	'header-text'            => false,
	'uploads'                => true,
	'wp-head-callback' 		 => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $newspress_custom_header );
	
// 	Functions for adding script
	function newspress_enqueue_scripts() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
		wp_enqueue_script( 'comment-reply' ); 
	}
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'newspress-menu-style', get_template_directory_uri(). '/js/menu.js' );
	if ( of_get_option('fontfamily', '') == '' ) :
	wp_enqueue_style('newspress-gfonts1', '//fonts.googleapis.com/css?family=Oswald:400,300,700', false );
	endif;
	
	if (is_front_page()):
	if ( of_get_option('num-heading-slide', '5') != '') :
	wp_enqueue_script( 'newspress-main-slider', get_template_directory_uri() . '/js/jquery.fractionslider.min.js' );
	wp_enqueue_style('newspress-main-slider-css', get_template_directory_uri(). '/css/fractionslider.css' );
	endif;
	

	if ( of_get_option('breakingnews-source', '4') == '1' || of_get_option('breakingnews-source', '4') == '2' || of_get_option('breakingnews-source', '4') == '3' ):
	wp_enqueue_script( 'newspress-bnews', get_template_directory_uri() . '/js/jquery.ticker.js' );
	wp_enqueue_style('newspress-bnews-css', get_template_directory_uri(). '/css/ticker-style.css' );
	endif;
	
	if ( of_get_option('fpgallery', '1') != '3') :
	wp_enqueue_script( 'newspress-post-slider', get_template_directory_uri() . '/js/jquery.bxslider.min.js' );
	wp_enqueue_style('newspress-post-slider-css', get_template_directory_uri(). '/css/jquery.bxslider.css' );
	endif;
		
	endif;
	
	if (of_get_option('mmactive', '0') == '1' ):
	if( ! is_user_logged_in() || !current_user_can( 'edit_posts' ) ):
	wp_enqueue_script( 'newspress-uc1', get_template_directory_uri() . '/js/jquery.countdown.js' );
	wp_enqueue_script( 'newspress-uc2', get_template_directory_uri() . '/js/modernizr.custom.js' );
	wp_enqueue_script( 'newspress-uc3', get_template_directory_uri() . '/js/under-construction.js' );
	wp_enqueue_style('newspress-uc4', get_template_directory_uri(). '/css/under-construction.css' );
	endif;
	endif;
	if ( of_get_option('responsive', '0') == '1' ) : wp_enqueue_style('newspress-responsive', get_template_directory_uri(). '/style-responsive.css' ); endif;
	}
	add_action( 'wp_enqueue_scripts', 'newspress_enqueue_scripts' );
	
	function newspress_creditline () {
	echo of_get_option('copyright', '&copy; ' . date("Y"). ': ' . get_bloginfo( 'name' )). '<span class="credit"> | NewsPress Theme by: <a href="http://d5creation.com" target="_blank"> D5 Creation</a> | Powered by: <a href="http://wordpress.org" target="_blank">WordPress</a>';
    }

// 	Redirect Visitors to Under Construction Mood	
	if (of_get_option('mmactive', '0') == '1' ):
	function newspress_redirect()
	{
    if( ! is_user_logged_in() || !current_user_can( 'edit_posts' ) )
    {
       	get_template_part( 'under-construction' );
		// wp_redirect( home_url( '/signup/' ) );
        exit();
    }
	}
	add_action( 'template_redirect', 'newspress_redirect' );
	endif;
	
// 	Excerpt Length
	function newspress_excerpt_length( $length ) {
	global $newspress_excerptlength;
	if ($newspress_excerptlength) {
    return $newspress_excerptlength;
	} else {
	if ( of_get_option('num-wrds', '90' ) != '' ): $return_wrd = of_get_option('num-wrds', '90' ); else: $return_wrd = 90; endif;
    return $return_wrd; //default value
    } }
	add_filter( 'excerpt_length', 'newspress_excerpt_length', 999 );
	
	function newspress_excerpt_more($more) {
       global $post;
	return '<a href="'. get_permalink($post->ID) . '" class="read-more">' . of_get_option('readmore', 'Read More') . '</a>';
	}
	add_filter('excerpt_more', 'newspress_excerpt_more');
	
	function newspress_content() {
	if (( of_get_option('contype', '2') != '2' ) || is_page() || is_single() ) : the_content('<span class="read-more">' . of_get_option('readmore', 'Read More') . '</span>');
	else: the_excerpt();
	endif;	
	}
	
	// 	Post Meta Design
	function newspress_post_meta() { ?>
	<div class="post-meta"><span class="post-edit"> <?php edit_post_link(''); ?></span></span>
	<span class="post-tag"> <?php the_tags('<span class="post-tag-icon"></span>', ', '); ?> </span><span class="post-category"> <?php the_category(', '); ?> </span> <span class="post-comments"> <?php comments_popup_link(of_get_option ('nocomments', 'No Comments') . ' &#187;', of_get_option ('1comment', 'One Comment') . ' &#187;', '% ' . of_get_option ('comments', 'Comments') . ' &#187;'); ?></span>
	</div> 
	
	<?php
	}
	
	// 	Post Author and Date Design
	function newspress_author_meta() {
	$archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d'); 
	?>
	<div class="post-author"><span class="post-author"><?php if ( get_post_meta(get_the_ID(), 'np_author', 'true') !='' ): echo get_post_meta(get_the_ID(), 'np_author', 'true'); else:  the_author_posts_link(); endif; ?> | </span><span class="post-date"><a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php the_time('F j, Y'); ?></a></span></div> 
	<?php
	}

//	News Page Navigation
	function newspress_page_nav() { ?>
	<div id="page-nav">
    <div class="alignleft"><?php previous_posts_link('&laquo;  ' . of_get_option('pe3', 'Newer News') ) ?></div>
	<div class="alignright"><?php next_posts_link(of_get_option('ne3', 'Older News') .' &raquo;') ?></div>
	</div>
	<?php }

	
//	404 Error Content
	function newspress_404() { ?>
	<h1 class="arc-post-title page-404"><?php echo of_get_option('swcf', 'Sorry, we could not find anything that matched your search.'); ?></h1>
		<h3 class="arc-src"><span><?php echo of_get_option('yctas', 'You Can Try Another Search...'); ?></span></h3>
		<?php get_search_form(); ?>
		<p><a href="<?php echo home_url(); ?>" title="Browse the Home Page">&laquo; <?php echo of_get_option('orhp', 'Or Return to the Home Page'); ?></a></p><br />
	<?php }


//	Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link
	function newspress_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
	}
	add_filter( 'wp_page_menu_args', 'newspress_page_menu_args' );
	
// retrieves the attachment ID from the file URL
	function newspress_get_attachment_id_from_src ($image_src) {

		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id = $wpdb->get_var($query);
		return $id;

	}
	
//	Set Automatic Featured Image with Post
	if (of_get_option('auto-featured-image', '1') == '1' ):	
	function newspress_autoset_featured() {
          global $post;
          $already_has_thumb = has_post_thumbnail($post->ID);
              if (!$already_has_thumb)  {
			  if (of_get_option('auto-featured-image-source', '2') == '1' ):	  
              $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1&order=ASC" );
                          if ($attached_image) {
                                foreach ($attached_image as $attachment_id => $attachment) {
                                set_post_thumbnail($post->ID, $attachment_id);
                                }
                           } ;
			 else:  
			 if (of_get_option('auto-featured-image-url', '') != '' ): $image_src = of_get_option('auto-featured-image-url', '');
			 $attachment_id = newspress_get_attachment_id_from_src ($image_src);			 
			 set_post_thumbnail($post->ID, $attachment_id);
			 
			 endif;	 endif;		   
						   
                        }
      }
	add_action('the_post', 'newspress_autoset_featured');
	add_action('save_post', 'newspress_autoset_featured');
	add_action('draft_to_publish', 'newspress_autoset_featured');
	add_action('new_to_publish', 'newspress_autoset_featured');
	add_action('pending_to_publish', 'newspress_autoset_featured');
	add_action('future_to_publish', 'newspress_autoset_featured');
	endif;

//	Set Most Popular Posts by Views	
	function newspress_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
	}
	
	function newspress_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
	}

	// 	Functions for adding some custom code within the head tag of site
	function newspress_custom_code() {
?>
	
	<style type="text/css">
	.site-title a, 
	.site-title a:active, 
	.site-title a:hover { color: #<?php echo get_header_textcolor(); ?>; }
	.credit { display: <?php if (of_get_option('credit', '0') == '1') :  echo ('none'); endif;?>; }
	<?php if (of_get_option('wpad', '0') == '1' ): ?> .post-author { display: none; }  <?php endif; ?>
	<?php if (of_get_option('wppct', '0') == '1' ): ?> .post-meta { display: none; }  <?php endif; ?>
	<?php if (of_get_option('heightsh', '') != '' ): echo  '.fsubheading { min-height:'.of_get_option('heightsh', '').'px; }';   endif; ?>
	<?php if (of_get_option('heightcat', '') != '' ): echo  '.fpage-cat { min-height:'.of_get_option('heightcat', '').'px; }';   endif; ?>
	<?php if (of_get_option('50-slider', '0') == '1' ): echo '#slide-container { width: 70%; float: left; margin-bottom: 5px; max-height: 330px; } #slide-container img { width: 100%; height: 100%; } .slide-title h2 { font-size: 17px; line-height:110%; } .slide-des { font-size: 15px; } #slide-container .read-more { font-size: 13px; } #slide-container .rarrow { border-width: 11px; top: 6px; }#slide-container .read-more:after { font-size: 25px; top: 3px; } #content { padding: 0 0 10px; }';  endif; ?>
	<?php if ( of_get_option('fontfamily', '') != '' ) : echo  'body, .heading-date, h4.fcpt a, #newspress-main-menu, #newspress-main-menu ul ul, .sub-menu, .sub-menu ul ul, h1, h2, h2 a, h2 a:visited, h3, h4, h5, h6, .read-more, .fpgcontainert .read-more, #page-nav a, .fpec #editorschoice h3, .fpmost-read #mostdiscussed h3 { font-family:'.of_get_option('fontfamily', '').'; }';   endif; ?>
	
	<?php 
	
	if (of_get_option('colorcssaccept', '0') == '1') :
	$color1 = of_get_option('color1', '#F90909');
	$color2 = of_get_option('color2', '#000000');
	$color3 = of_get_option('color3', '#111111');
	$color4 = of_get_option('color4', '#333333');
	$color5 = of_get_option('color5', '#555555');
	$color6 = of_get_option('color6', '#777777');
	$color7 = of_get_option('color7', '#AAAAAA');
	$color8 = of_get_option('color8', '#BBBBBB');
	$color9 = of_get_option('color9', '#CCCCCC');
	$color10 = of_get_option('color10', '#DDDDDD');
	$color11 = of_get_option('color11', '#EEEEEE');
	$color12 = of_get_option('color12', '#F6F6F6');
	$color13 = of_get_option('color13', '#FFFFFF');
	
	echo ' 
	.wp-caption { background: ' . $color11 . '; border: 1px solid ' . $color13 . '; }
body {	background: ' . $color13 . '; color: ' . $color5 . '; }	
.fs-pager-wrapper a, .fs-custom-pager-wrapper a {	background: ' . $color1 . '; color: ' . $color5 . '; }
#site-container { background: ' . $color12 . '; box-shadow: 0 0 3px 0 ' . $color5 . '; }
#top-menu-container #searchsubmit, .page-link a { background-color: ' . $color3 . '; }
#top-menu-container input#s { background: ' . $color5 . '; border-color:' . $color3 . ' transparent ' . $color6 . ' ' . $color6 . '; color: ' . $color7 . '; }
#top-menu-container input#s:focus { width: 150px; color: ' . $color11 . '; background: ' . $color6 . '; }
img.site-logo, h1.site-title { color: ' . $color1 . '; text-shadow: 0 0 0 ' . $color10 . ', 1px 1px 0 ' . $color10 . ', 2px 2px 1px rgba(0, 0, 0, 0.75), 2px 2px 1px rgba(0, 0, 0, 0.5), 0 0 1px rgba(0, 0, 0, 0.2); }
.fsubheading { border-top: 2px solid ' . $color9 . '; }
.breakingnews { background:' . $color13 . '; border-bottom: 1px solid ' . $color1 . '; }
.fccontainer a, .fsubheading a, .fpheading a, .fpage-catspecial a, .popularposts a  { color: ' . $color5 . '; }
.fccontainer h3.fcpt:hover, .fccontainer li a:hover, .fsubheading h2.post-title:hover, .fpheading h1.page-title:hover, .fpage-catspecial h3.fcpt:hover, .fpage-catspecial li a:hover, .ticker-content a:hover, .popularposts a:hover   { color: ' . $color1 . '; }
.fccontainer .read-more, .fsubheading .read-more, .fpheading .read-more, .fpage-catspecial .read-more, h2.post-title a:hover { color: ' . $color1 . '; }
.fpage-catg span { color: ' . $color1 . '; }
.fpage-catg span:hover { color: ' . $color13 . '; }
h2.fcname { background: ' . $color6 . '; color: ' . $color13 . ';}
h3.fcpt a { color: ' . $color4 . ';}
#footer { background: ' . $color4 . '; border-top: 3px solid ' . $color1 . '; }
#social a { background: ' . $color2 . '; }
#creditline { background: ' . $color3 . '; color: ' . $color11 . '; text-shadow: 0 0 1px ' . $color2 . '; }
ins { background: ' . $color13 . '; }
pre { background:' . $color13 . '; }
abbr,
acronym { border-bottom: 1px dotted ' . $color6 . '; }
address { background: ' . $color11 . '; border: 2px solid ' . $color10 . '; }
#newspress-top-menu {border-left: 1px solid ' . $color3 . '; border-right: 1px solid ' . $color5 . '; }
#newspress-top-menu li a{ border-left: 1px solid ' . $color5 . '; border-right: 1px solid ' . $color3 . '; color: ' . $color7 . '; text-shadow: 0 0 1px ' . $color2 . '; }
#newspress-top-menu li a:hover { color: ' . $color10 . '; }
#newspress-main-menu { background: ' . $color9 . '; background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, ' . $color13 . '), color-stop(1, ' . $color9 . '), color-stop(1, ' . $color12 . ') ); background-image: -o-linear-gradient(bottom, ' . $color13 . ' 0%, ' . $color9 . ' 100%, ' . $color12 . ' 100%); background-image: -moz-linear-gradient(bottom, ' . $color13 . ' 0%, ' . $color9 . ' 100%, ' . $color12 . ' 100%);
	background-image: -webkit-linear-gradient(bottom, ' . $color13 . ' 0%, ' . $color9 . ' 100%, ' . $color12 . ' 100%); background-image: -ms-linear-gradient(bottom, ' . $color13 . ' 0%, ' . $color9 . ' 100%, ' . $color12 . ' 100%);
	background-image: linear-gradient(to bottom, ' . $color13 . ' 0%, ' . $color9 . ' 100%, ' . $color12 . ' 100%); }
#newspress-main-menu ul {  border-left: 1px solid ' . $color10 . '; }
#newspress-main-menu a { color: ' . $color5 . '; border-right: 1px solid ' . $color10 . '; }
#newspress-main-menu ul ul, 
.sub-menu, .sub-menu ul ul { background: ' . $color1 . '; border-bottom: 5px solid ' . $color3 . '; }
#newspress-main-menu ul ul a  { border-bottom: 1px dotted ' . $color8 . '; color: ' . $color11 . '; }
#newspress-main-menu a:hover, #newspress-main-menu .current-menu-item > a, #newspress-main-menu .selected a, 
#newspress-main-menu .current-menu-ancestor > a, 
#newspress-main-menu .current_page_item > a, 
#newspress-main-menu .current_page_ancestor > a { background: ' . $color1 . '; color: ' . $color11 . '; }
#newspress-main-menu ul ul a:hover, 
#newspress-main-menu ul ul .current-menu-item > a, 
#newspress-main-menu ul ul .current-menu-ancestor > a, 
#newspress-main-menu ul ul .current_page_item > a, 
#newspress-main-menu ul ul .current_page_ancestor > a { background: ' . $color5 . '; }
#right-sidebar .widget .widget-title, h3.fpgal-title { background: ' . $color1 . '; color: ' . $color13 . '; }
#footer-sidebar .widget .widget-title { color: ' . $color8 . '; text-shadow: 1px 1px 1px ' . $color2 . '; }
#wp-calendar td { color: ' . $color6 . '; }
button,
input[type="reset"],
input[type="button"],
input[type="submit"],
#respond .form-submit input#submit,
#wp-submit { color:' . $color6 . '; box-shadow: 0 0 3px 0 ' . $color6 . '; background: ' . $color12 . ';
	background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, ' . $color13 . '), color-stop(1, ' . $color9 . '), color-stop(1, ' . $color12 . ') );
	background-image: -o-linear-gradient(bottom, ' . $color13 . ' 0%, ' . $color9 . ' 100%, ' . $color12 . ' 100%);
	background-image: -moz-linear-gradient(bottom, ' . $color13 . ' 0%, ' . $color9 . ' 100%, ' . $color12 . ' 100%);
	background-image: -webkit-linear-gradient(bottom, ' . $color13 . ' 0%, ' . $color9 . ' 100%, ' . $color12 . ' 100%);
	background-image: -ms-linear-gradient(bottom, ' . $color13 . ' 0%, ' . $color9 . ' 100%, ' . $color12 . ' 100%);
	background-image: linear-gradient(to bottom, ' . $color13 . ' 0%, ' . $color9 . ' 100%, ' . $color12 . ' 100%); }
button:hover,
input[type="reset"]:hover,
input[type="button"]:hover,
input[type="submit"]:hover,
#respond .form-submit input#submit:hover,
#wp-submit:hover { 	box-shadow: 0 0 5px 0 ' . $color3 . '; 	color: ' . $color4 . '; text-shadow: 1px 1px 1px ' . $color12 . '; }
textarea, input[type="text"], input[type="password"], input[type="email"], input[type="number"], input[type="search"], input[type="tel"], input[type="url"], .titlewrap input, select { background: ' . $color11 . '; border-color: ' . $color8 . ' ' . $color8 . ' ' . $color13 . ' ' . $color13 . '; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1) inset; color: ' . $color6 . ';}
textarea:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus, input[type="number"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="url"]:focus, .titlewrap:focus input:focus, select:focus { background:' . $color12 . '; }
.gallery-caption { background:' . $color4 . '; color: ' . $color7 . '; }
#content.single-image-show .attachment-single-page { background: ' . $color2 . '; }
.single-page-image p { background: ' . $color13 . '; }
#content .attachment-post-page,
#content .attachment-post-thumbnail,
#content .attachment-single-page,
#content .attachment-cat-page, .fi-full-width, .fi-full-width-cat { border: 1px solid ' . $color9 . '; }
#content h1.vi-heading, .vi-heading, #content h1.vi-heading a, #content h2.vi-heading, #content h3.vi-heading, h4.vi-heading, #content h2.vi-heading a, #content h3.vi-heading a  { color: ' . $color1 . '; }
h1.page-title, 
h1.page-title a,
h1.arc-post-title { color: ' . $color4 . '; text-shadow: -1px -1px 3px ' . $color13 . '; }
.arc-content h1.arc-post-title {background: ' . $color6 . '; text-shadow: 0 1px ' . $color3 . '; color: ' . $color13 . '; }
#content .page-404 { color: ' . $color1 . '; }
.subtitle,
p.subtitle
#content p.subtitle  { color: ' . $color6 . '; }
h3.arc-src { color: ' . $color1 . '; }
h3.arc-src span { color: ' . $color5 . '; }
.cat-read-more, .fccontainer .cat-read-more, .fpage-catspecial .cat-read-more  { background: ' . $color1 . '; color: ' . $color13 . '; }
.rarrow { border-left: 13px solid ' . $color1 . ';}
.post-author, .post-author a { color: ' . $color6 . '; }
.post-author a:hover, .post-meta a:hover { color: ' . $color1 . '; }
.post-meta { border: 1px solid ' . $color10 . '; color: ' . $color5 . '; }
.post-meta a { color: ' . $color5 . '; }
#page-nav a { border: 1px solid ' . $color10 . '; background: ' . $color13 . '; }
#page-nav a:hover { background: ' . $color3 . '; color: ' . $color7 . '; }
#top-menu-container { background: ' . $color4 . '; }
#headersep { background: ' . $color9 . '; border-bottom: 2px solid ' . $color13 . '; }
.content-ver-sep { background: ' . $color9 . '; border-bottom: 1px solid ' . $color13 . '; }
#right-sidebar .widget, #right-sidebar .widget li, #right-sidebar .widget a { color: ' . $color4 . '; }
#footer-sidebar .widget, #footer-sidebar .widget li, #footer-sidebar .widget a { color: ' . $color8 . '; }
#right-sidebar .widget a:hover { color: ' . $color1 . '; }
#footer-sidebar .widget a:hover { color: ' . $color13 . '; }
a { color: ' . $color1 . '; }
table { background-color: ' . $color11 . '; border: 1px solid ' . $color13 . '; box-shadow: 0 0 5px 0 ' . $color10 . '; color: ' . $color4 . '; }
th { background: ' . $color9 . '; }
caption { color: ' . $color5 . '; }
.post.sticky, .sticky { background:' . $color13 . '; border: 5px solid ' . $color10 . '; box-shadow: 0 0 5px 0 ' . $color5 . '; }
#content img, #content-full img { border: 1px solid ' . $color9 . '; }
blockquote { border-left: 10px solid ' . $color10 . '; border-right: 10px solid ' . $color10 . '; }
blockquote:before { color: ' . $color3 . '; }
blockquote:after { color: ' . $color3 . '; }
h2.post-title, h2.comments, h3#reply-title, h2.post-title a, h2.comments a, h2.post-title-color { color: ' . $color5 . '; }
h1.notfound { background: ' . $color13 . '; color: ' . $color1 . '; }
.comments { border-bottom: 1px solid ' . $color11 . ';  }
#commentsbox a:hover {  color: ' . $color1 . '; }
#commentsbox .comment-author cite,
#commentsbox .comment-author cite a{color:' . $color6 . ';}
#commentsbox img.avatar{border: 5px solid ' . $color13 . '; box-shadow: 0 0 3px 0 ' . $color7 . '; }
.comment-body{ background: ' . $color13 . '; box-shadow: 0 0 0 1px ' . $color10 . ';}
.comment-body:after { border-right: 15px solid ' . $color13 . '; }
#commentsbox .comment-meta,
#commentsbox .comment-meta a:link,
#commentsbox .comment-meta a:visited{color:' . $color7 . ';}
#commentsbox .comment-meta { border-bottom: 1px solid ' . $color11 . '; }
#respond .required{color:' . $color1 . ';}
a.loginicon::before, a.loginicon:hover::before {color: ' . $color11 . ';}
ul.lboxd ul{background:' . $color10 . ';}
.go-top::before {background: ' . $color3 . '; }
.fpgcontainer, .fpec, .fpmost-read, .fpgcontainert { background: ' . $color13 . '; border: 1px solid ' . $color10 . ';}
.fpgcontainert a:hover { color: ' . $color1 . '; }
.fraction-slider .prev{ border-right: 20px solid ' . $color1 . '; }
.fraction-slider .next{ border-left: 20px solid ' . $color1 . '; }
.fs-pager-wrapper .active,
.fs-custom-pager-wrapper .active{ border: 2px solid ' . $color1 . ';}
#slide-container{background: ' . $color2 . ';}
.slide-title, .ticker-title { color: ' . $color13 . '; background: ' . $color1 . ';  }
.slide-des { color: ' . $color13 . '; background: ' . $color1 . ';  }
.ticker-content { background-color: ' . $color13 . '; }
.ticker-swipe {background-color: ' . $color13 . ';}
.ticker-swipe span { background-color: ' . $color13 . '; border-bottom: 1px solid ' . $color5 . '; }
.no-js-news, .page-link a { color: ' . $color13 . '; }
.page-link a:hover { background: ' . $color1 . '; }


		';
		
	$coldefault = '
img.site-logo, h1.site-title { text-shadow: 0 0 0 #DDDDDD, 1px 1px 0 #DDDDDD, 2px 2px 1px rgba(0, 0, 0, 0.75), 2px 2px 1px rgba(0, 0, 0, 0.5), 0 0 1px rgba(0, 0, 0, 0.2); }

.fpage-catg span:hover { background: rgba(0, 0, 0, 0.3); }

.sub-menu, .sub-menu ul ul { background: rgba(250, 10, 10, .3); }

#newspress-main-menu .current_page_ancestor > a { background: rgba(250, 10, 10, .9); }

#newspress-main-menu ul ul .current_page_ancestor > a { background: rgba(85, 85, 85, .9); }

th {text-shadow: 0 1px 0 rgba(255, 255, 255, 0.7); }

.slide-title { background: rgba(250, 10, 10, 0.75); }

.slide-des { background: rgba(250, 10, 10, 0.75); }
		';
	
	 echo of_get_option('color-setting', $coldefault) ; 
	 endif;  	 ?>
	
	</style>
	<link rel="shortcut icon" href="<?php echo of_get_option('favicon', get_template_directory_uri() . '/images/favicon.ico'); ?>" />
	
<?php 
	if ( of_get_option ('auto-refresh', '' ) != '' ): echo '<meta http-equiv="refresh" content="'. of_get_option ('auto-refresh', '' ) . '" >'; endif;
	
	echo of_get_option('headcode');
	}
	
	add_action('wp_head', 'newspress_custom_code');
	
//	Removing HTMl Comments	
	add_filter( 'comment_text', 'wp_filter_nohtml_kses' );
	add_filter( 'comment_text_rss', 'wp_filter_nohtml_kses' );
	add_filter( 'comment_excerpt', 'wp_filter_nohtml_kses' );
	
	
//	Registers the Widgets and Sidebars for the site
	function newspress_widgets_init() {
		
	register_sidebar( array(
		'name' =>  'Slider Sidebar', 
		'id' => 'sidebar-7',
		'description' =>  'An optional widget area for the Front Page Heading Slider', 
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' =>  'Front Page Sidebar', 
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' =>  'News Page Sidebar', 
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' =>  'Footer Area One', 
		'id' => 'sidebar-3',
		'description' =>  'An optional widget area for your site footer', 
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' =>  'Footer Area Two', 
		'id' => 'sidebar-4',
		'description' =>  'An optional widget area for your site footer', 
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' =>  'Footer Area Three', 
		'id' => 'sidebar-5',
		'description' =>  'An optional widget area for your site footer', 
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' =>  'Footer Area Four', 
		'id' => 'sidebar-6',
		'description' =>  'An optional widget area for your site footer', 
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
			
	}
	add_action( 'widgets_init', 'newspress_widgets_init' );
	
	// show_admin_bar(false);
		
	// 	When the post has no post title, but is required to link to the single-page post view.

	add_filter('the_title', 'newspress_title');
	function newspress_title($title) {
        if ( '' == $title ) {
            return '(Untitled)';
        } else { return $title; } 
    }

// 	WordPress Login Form Customization
	if (of_get_option('login-logo', 1 ) == '1') :
	function sunrain_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url("<?php echo of_get_option('site-logo', get_template_directory_uri(). '/images/logo.png'); ?>");
            padding-bottom: 10px;
			background-size: 100%  100%;
			width: 100%;
        }
    </style>
	<?php }
	add_action( 'login_enqueue_scripts', 'sunrain_login_logo' );

	function sunrain_login_logo_url() {
    return esc_url( home_url( '/' ) );
	}
	add_filter( 'login_headerurl', 'sunrain_login_logo_url' );
	endif;
	
	if ( of_get_option('admin-bar', '') == '1' ): add_filter( 'show_admin_bar', '__return_false' ); endif;
	
	function newspress_remove_quick_edit( $actions ) {
	unset($actions['inline hide-if-no-js']);
	return $actions;
	}
	if ( current_user_can('manage_options') ) {
	} else {
	add_filter('post_row_actions','newspress_remove_quick_edit',10,1);
	}
	
	function newspress_sort_get_terms_args( $args, $taxonomies ) {
    global $pagenow;
    $args['orderby'] = 'slug';
    $args['order'] = 'ASC';
    return $args;
	}
	add_filter( 'get_terms_args', 'newspress_sort_get_terms_args', 10, 2 );
	
	
	
//	Remove WordPress Custom Header Support for the theme sunrain
//	remove_theme_support('custom-header');
	

	
// Add Shortcode
	add_filter('widget_text', 'do_shortcode');
	function newspress_fpmost( $pnewsattr ) {	
	
	$pnews = shortcode_atts( array( 'total_news' => '35', 'number_of_visible_news' => '20', 'number_of_news_move' => '7', ), $pnewsattr);
	
	if ( of_get_option('popnsc', '1') == '2' ):
	$args = array(
    'orderby'         => 'comment_count post_date',
    'order'           => 'DESC',
    'post_status'     => 'publish',
	'ignore_sticky_posts'=> 1,
	'posts_per_page'  => $pnews['total_news'],
	'suppress_filters' => true );
	else:
	$args = array(
    'meta_key'        => 'post_views_count',
	'orderby'         => 'meta_value_num', 
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'ignore_sticky_posts'=> 1,
	'posts_per_page'  => $pnews['total_news'],
	'suppress_filters' => true );	
	endif;

 $my_query = new WP_Query($args);
 if (have_posts()) : ?>
 
 <aside class="widget">
	<h3 class="widget-title"><?php echo of_get_option('popularnews', 'Popular News'); ?></h3>
 <ul class="popularposts">
 
 <?php while ( $my_query->have_posts()) :  $my_query->the_post(); ?>

 <li><a href="<?php the_permalink() ?>" ><?php the_post_thumbnail('post-page', array('class' => 'mostdis')); ?><h4><?php the_title(); ?></h4></a></li>
 <div class="clear"> </div>
 <?php endwhile; ?>
 </ul>
 </aside>
 
 <script type="text/javascript">
jQuery(document).ready(function(jQuery) {
  jQuery('.popularposts').bxSlider({
  minSlides: <?php echo $pnews['number_of_visible_news']; ?>,
  maxSlides: <?php echo $pnews['number_of_visible_news']; ?>,
  slideWidth: 450,
  moveSlides: <?php echo $pnews['number_of_news_move']; ?>,
  adaptiveHeight: true,
  tickerHover: true,
  useCSS: false,
  auto: true,
  controls: false,
  mode: 'vertical',
  slideMargin: 15
});
});
</script>


 <?php endif; wp_reset_postdata(); 

	wp_enqueue_script( 'newspress-post-slider', get_template_directory_uri() . '/js/jquery.bxslider.min.js' );
	wp_enqueue_style('newspress-post-slider-css', get_template_directory_uri(). '/css/jquery.bxslider.css' );

}
	add_shortcode( 'mostpopularnews', 'newspress_fpmost' );
	
	