<?php
/**
* Add Scripts
*
* Add JS and CSS to the main theme and to admin
*
* @package	YouTube-Embed
*/

// Switch on shortcodes in widgets, if requested

if ( !is_admin() ) {
	$options = get_option( 'youtube_embed_general' );
	if ( $options[ 'widgets' ] == 1 ) { add_filter( 'widget_text', 'do_shortcode' ); }
}

/**
* Plugin initialisation
*
* Loads the plugin's translated strings
*
* @since	2.5.5
*/

function vye_plugin_init() {

	$language_dir = plugin_basename( dirname( __FILE__ ) ) . '/languages/';

	load_plugin_textdomain( 'youtube-embed', false, $language_dir );

}

add_action( 'init', 'vye_plugin_init' );

/**
* Add scripts to theme
*
* Add styles and scripts to the main theme
*
* @since		2.4
*/

function vye_main_scripts() {

	wp_register_style( 'vye_dynamic', plugins_url( '/youtube-embed/css/main.min.css' ) );

	wp_enqueue_style( 'vye_dynamic' );

}

add_action( 'wp_enqueue_scripts', 'vye_main_scripts' );

/**
* Add CSS to admin
*
* Add stylesheets to the admin screens
*
* @since	2.0
*/

function vye_admin_css() {

	wp_enqueue_style( 'tinymce_button', plugins_url() . '/youtube-embed/css/admin.min.css' );

}

add_action( 'admin_print_styles', 'vye_admin_css' );

/**
* Add option to Admin Bar
*
* Add link to YouTube Embed profile options to Admin Bar.
* With help from http://technerdia.com/1140_wordpress-admin-bar.html
*
* @uses     vye_set_general_default     Set default options
*
* @since	2.5
*/

function vye_admin_bar_render( $meta = TRUE ) {

	$options = vye_set_general_defaults();

	if ( $options[ 'admin_bar' ] != '' ) {

		global $wp_admin_bar;

		if ( !is_user_logged_in() ) { return; }
		if ( !is_admin_bar_showing() ) { return; }
		if ( !current_user_can( $options[ 'menu_access' ] ) ) { return; }

		$wp_admin_bar -> add_menu( array(
			'id' => 'aye-menu',
			'title' => __( 'YouTube Embed', 'youtube-embed' ) ) );

		$wp_admin_bar -> add_menu( array(
			'parent' => 'aye-menu',
			'id' => 'aye-options',
			'title' => __( 'Options', 'youtube-embed' ),
			'href' => admin_url( 'admin.php?page=ye-general-options' ),
			'meta' => array( 'target' => '_blank' ) ) );

		$wp_admin_bar -> add_menu( array(
			'parent' => 'aye-menu',
			'id' => 'aye-profile',
			'title' => __( 'Profiles', 'youtube-embed' ),
			'href' => admin_url( 'admin.php?page=ye-profile-options' ),
			'meta' => array( 'target' => '_blank' ) ) );

		$wp_admin_bar -> add_menu( array(
			'parent' => 'aye-menu',
			'id' => 'aye-lists',
			'title' => __( 'Lists', 'youtube-embed' ),
			'href' => admin_url( 'admin.php?page=ye-list-options' ),
			'meta' => array( 'target' => '_blank' ) ) );
	}
}

add_action( 'admin_bar_menu', 'vye_admin_bar_render', 99 );

/**
* Add to site header
*
* Perform main site head processing
*
* @uses     youtube_embed_head_checks	Perform the actual checks
*
* @since	4.1
*/

function youtube_embed_add_to_head() {

	youtube_embed_shortcode_checks( 'site' );

	$options = vye_set_general_defaults();

	if ( $options[ 'script' ] == 'f' ) {

		$tab = "\t";
		$newline = "\n";

		echo '<script type="text/javascript" src="' . plugins_url() . '/youtube-embed/js/jquery.fitvids.js"></script>' . $newline;
		echo '<script>' . $newline;
		echo $tab . '$(".youtube-embed").fitVids();' . $newline;
		echo '</script>' . $newline;

	}

	if ( $options[ 'script' ] == 'i' ) {
		wp_enqueue_script( 'youtube-embed-iframe-resizer', plugins_url() . '/youtube-embed/js/iframeResizer.min.js' );
	}
}

add_action( 'wp_head', 'youtube_embed_add_to_head' );

/**
* Admin Head Checks
*
* Perform admin head processing
*
* @uses     youtube_embed_head_checks	Perform the actual checks
*
* @since	4.1
*/

function youtube_embed_admin_head_checks() {

	youtube_embed_shortcode_checks( 'admin' );

}


add_action( 'admin_head', 'youtube_embed_admin_head_checks' );

/**
* Shortcode Checking
*
* Check if the shortcode is in use by another plugin. If so, note it
* in the options.
*
* @param	string	$source		Where the checks are coming from
*
* @since	4.1
*/

function youtube_embed_shortcode_checks( $source ) {

	global $shortcode_tags;
	if ( isset( $shortcode_tags[ 'youtube' ] ) ) {
		$shortcode_usage = $shortcode_tags[ 'youtube' ];
	} else {
		$shortcode_usage = '';
	}

	$shortcode = 1;

	// All is fine

	if ( substr( $shortcode_usage, 0, 20 ) == 'vye_video_shortcode_' ) {

		$shortcode = 0;

	} else {

		// Jetpack is overriding

		if ( $shortcode_usage == 'youtube_shortcode' ) {

			$shortcode = 2;

		} else {

			// If the shortcode is empty, it's fine in admin but elsewhere
			// is another fail.

			if ( $shortcode_usage == '' ) {

				if ( $source == 'admin' )  {
					$shortcode = 0;
				} else {
					$shortcode = 3;
				}
			}
		}
	}

	update_option( 'youtube_embed_shortcode_' . $source, $shortcode );
}
?>