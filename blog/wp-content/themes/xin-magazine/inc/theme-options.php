<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Theme Options
 *
 * @package xinmag
 * @since xinmag 1.0
 */
add_action( 'admin_init', 'xinmag_options_init' );
add_action( 'admin_menu', 'xinmag_theme_options_admin_menu' );
function xinmag_admin_enqueue_scripts( $hook_suffix ) {
	global $xinwp_options;
	$xin_options = xinwp_get_options();
	
	$template_uri = get_template_directory_uri();
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style( 'xinwp-theme-options', $template_uri . '/xinwp/css/theme-options.css', false, '1.0' );
	wp_enqueue_script( 'xinwp-theme-options', $template_uri . '/xinwp/js/theme-options.js', array('jquery','wp-color-picker', 'jquery-ui-sortable'), '1.0' );
	
	global $xinwp_fonts;
	$xinwp_fonts = xinwp_fonts_array();
	foreach ( $xinwp_fonts as $font ) {
		if ( ! empty( $font['url'] ) )
			wp_enqueue_style( str_replace(' ', '', $font['label'] ), $font['url'], false, '1.0' );
	}
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'xinmag_admin_enqueue_scripts' );

function xinmag_options_init() {
    register_setting( 'xinmag_options', 'xinmag_theme_options', 'xinmag_theme_options_validate' );
}

function xinmag_theme_options_admin_menu() {
    add_theme_page( __( 'Theme Options', 'xinmag' ), __('Theme Options', 'xinmag' ), 'edit_theme_options', 'theme_options', 'xinmag_theme_options_display_page' );
	// Convert old widget id
	if ( get_option( 'widget_widget_xinmag_recent_post' ) ) {
		xinmag_update_options();
	}
}

function xinmag_update_options() {
	$recent_post = get_option( 'widget_widget_xinmag_recent_post' );
	if ( $recent_post ) {
// Change ID for Recent Post widget
		delete_option( 'widget_widget_xinmag_recent_post' );
		update_option( 'widget_xinwp_recent_post', $recent_post );
// Change ID for Navigation widget
		$navigation = get_option( 'widget_widget_xinmag_navigation' );
		if ( $navigation ) {
			delete_option( 'widget_widget_xinmag_navigation' );
			update_option( 'widget_xinwp_navigation', $navigation );
		}
// Update assigned widgets
		$sidebars = get_option( 'sidebars_widgets' );
		$changes = false;
		foreach ( $sidebars as $key => $sidebar ) {
			if ( $sidebar && $sidebar['0'] ) {
				$new_widget = str_replace( 'widget_xinmag', 'xinwp', $sidebar['0'] );
				$sidebars[ $key ]['0'] = $new_widget;
				$changes = true;
			}
		}
		if ( $changes )
			update_option( 'sidebars_widgets', $sidebars );
	}
}

function xinmag_theme_options_array() {	
	global $xinwp_fonts;
	
	$theme_options = array(
		'currenttab'	=> array(
			'name'	=> 'currenttab',
			'type'	=> 'hidden',			
		),	
		'section_order'	=> array(
			'name'	=> 'section_order',
			'type'	=> 'hidden',			
		),
// Layout
		'gridwidth'	=> array(
			'name'	=> 'gridwidth',
			'label'	=> __( 'Grid Width', 'xinmag' ),
			'type'	=> 'number',
			'desc'	=> __( 'Pixels', 'xinmag' ),
		),
		'content'	=> array(
			'name'	=> 'content',
			'label'	=> __( 'Content', 'xinmag' ),
			'type'	=> 'number',
			'fieldonly'	=> '1',
		),
		'sidebar1'	=> array(
			'name'	=> 'sidebar1',
			'label'	=> __( 'Sidebar 1', 'xinmag' ),
			'type'	=> 'number',
			'fieldonly'	=> '1',
		),
		'sidebar2'	=> array(
			'name'	=> 'sidebar2',
			'label'	=> __( 'Sidebar 2', 'xinmag' ),
			'type'	=> 'number',
			'desc' => __( 'Columns', 'xinmag' ),
			'fieldonly'	=> '1',
		),
		'sidebarpos'	=> array(
			'name'	=> 'sidebarpos',
			'label'	=> __( 'Sidebar Position', 'xinmag' ),
			'type'	=> 'radio',		
			'values' => array(
					array( 'key' => 1, 'label' => __( 'Right ', 'xinmag' ) ),
					array( 'key' => 2, 'label' => __( 'Left ', 'xinmag' ) ),
					array( 'key' => 3, 'label' => __( 'Left & Right ', 'xinmag' ) ),
						),
			'helptext' => __( 'Note: For Left & Right layout, Blog Widget Area (Full) will not be used. The total columns must be 12.', 'xinmag' ),
		),
		'sidebarresp'	=> array(
			'name'	=> 'sidebarresp',
			'label'	=> __( 'Responsive Sidebar', 'xinmag' ),
			'type'	=> 'checkbox',
			'desc'  => __( 'Check to activate responsive sidebars when screen width below breakpoints', 'xinmag' ),
		),
		'respbp'	=> array(
			'name'	=> 'respbp',
			'label'	=> __( 'Responsive Sidebar Breakpoint', 'xinmag' ),
			'type'	=> 'number',
			'desc'  => __( 'minimum 960 pixels', 'xinmag' ),
		),
		'column_footer1'	=> array(
			'name'	=> 'column_footer1',
			'type'	=> 'number',
			'fieldonly'	=> '1',
		),
		'column_footer2'	=> array(
			'name'	=> 'column_footer2',
			'type'	=> 'number',
			'fieldonly'	=> '1',
		),
		'column_footer3'	=> array(
			'name'	=> 'column_footer3',
			'type'	=> 'number',
			'fieldonly'	=> '1',
		),
		'column_footer4'	=> array(
			'name'	=> 'column_footer4',
			'type'	=> 'number',
			'desc' => __( 'Columns', 'xinmag' ),
			'fieldonly'	=> '1',
		),
//Home Page
		'homepage'	=> array(
			'name'	=> 'homepage',
			'label'	=> __( 'Home Page Style', 'xinmag' ),
			'type'	=> 'radio',
			'values' => array(
				array( 'key' => 1,
							   'label' => __( 'Featured Home', 'xinmag' ) ),
				array( 'key' => 2,
							   'label' => __( 'Blog', 'xinmag' ) ),
						),		
		),
		'fp_option'	=> array(
			'name'	=> 'fp_option',
			'label'	=> __( 'Posts for Carousel', 'xinmag' ),
			'type'	=> 'radio',
			'values' => array(
				array( 'key' => 1,
							   'label' => __( 'Featured Category', 'xinmag' ) ),
				array( 'key' => 2,
							   'label' => __( 'Featured Posts', 'xinmag' ) ),
						),		
		),
		'fp_effect'	=> array(
			'name'	=> 'fp_effect',
			'label'	=> __( 'Animation', 'xinmag' ),
			'type'	=> 'radio',
			'values' => array(
				array( 'key' => 'slide',
							   'label' => __( 'Slide', 'xinmag' ) ),
				array( 'key' => 'fade',
							   'label' => __( 'Fade', 'xinmag' ) ),
						),		
		),
		'fp_category'	=> array(
			'name'	=> 'fp_category',
			'label'	=> __( 'Featured Category', 'xinmag' ),
			'type'	=> 'category',	
		),		
		'fp_postnum'	=> array(
			'name'	=> 'fp_postnum',
			'label'	=> __( 'Number of Posts', 'xinmag' ),
			'type'	=> 'number',	
		),		
// Top Bar
		'brandname'	=> array(
			'name'	=> 'brandname',
			'label'	=> __( 'Brand Name', 'xinmag' ),
			'type'	=> 'text',
			'helptext'	=> __( 'Leave it blank to display Brand Logo.', 'xinmag' ),
		),
		'brandlogo'	=> array(
			'name'	=> 'brandlogo',
			'label'	=> __( 'Brand Logo', 'xinmag' ),
			'type'	=> 'image',
			'helptext'	=> __( 'Enter URL of the uploaded image.', 'xinmag' ),
		),
		'brandurl'	=> array(
			'name'	=> 'brandurl',
			'label'	=> __( 'Brand URL', 'xinmag' ),
			'type'	=> 'url',
			'helptext'	=> __( 'Enter URL of the main brand site.', 'xinmag' ),
		),
		'menupos'	=> array(
			'name'	=> 'menupos',
			'label'	=> __( 'Top Menu Position', 'xinmag' ),
			'type'	=> 'radio',
			'values' => array(
				array( 'key' => 'left',
							   'label' => __( 'Left', 'xinmag' ) ),
				array( 'key' => 'right',
							   'label' => __( 'Right', 'xinmag' ) ),
						),		
		),
// Sections
		'section_postnum'	=> array(
			'name'	=> 'section_postnum',
			'label'	=> __( '# of Posts Per Section', 'xinmag' ),
			'type'	=> 'number',
		),
// Skins
		'colorscheme'	=> array(
			'name'	=> 'colorscheme',
			'label'	=> __( 'Color Scheme', 'xinmag' ),
			'type'	=> 'select',
			'values' => xinmag_scheme_options(),
		),
		'schemecss'	=> array(
			'name'	=> 'schemecss',
			'type'	=> 'hidden',
		),
		'headerbg'	=> array(
			'name'	=> 'headerbg',
			'label'	=> __( 'Header Background', 'xinmag' ),
			'type'	=> 'color',
		),
		'titlebarbg'	=> array(
			'name'	=> 'titlebarbg',
			'label'	=> __( 'Title Bar Background', 'xinmag' ),
			'type'	=> 'color',
		),
		'contentbg'	=> array(
			'name'	=> 'contentbg',
			'label'	=> __( 'Content Background', 'xinmag' ),
			'type'	=> 'color',
		),
		'footerbg'	=> array(
			'name'	=> 'footerbg',
			'label'	=> __( 'Footer Background', 'xinmag' ),
			'type'	=> 'color',
		),
//Fonts
		'bodyfont'	=> array(
			'name'	=> 'bodyfont',
			'label'	=> __( 'Body / Paragraph', 'xinmag' ),
			'type'	=> 'font',	
			'values' => $xinwp_fonts,
		),
		'sitetitlefont'	=> array(
			'name'	=> 'sitetitlefont',
			'label'	=> __( 'Site Title', 'xinmag' ),
			'type'	=> 'font',	
			'values' => $xinwp_fonts,
		),
		'sitedescfont'	=> array(
			'name'	=> 'sitedescfont',
			'label'	=> __( 'Site Description', 'xinmag' ),
			'type'	=> 'font',	
			'values' => $xinwp_fonts,
		),
		'entrytitlefont'	=> array(
			'name'	=> 'entrytitlefont',
			'label'	=> __( 'Post/Page Title', 'xinmag' ),
			'type'	=> 'font',
			'values' => $xinwp_fonts,
		),
		'headingfont'	=> array(
			'name'	=> 'headingfont',
			'label'	=> __( 'Heading (H1 - H6)', 'xinmag' ),
			'type'	=> 'font',
			'values' => $xinwp_fonts,
		),
		'sidebarfont'	=> array(
			'name'	=> 'sidebarfont',
			'label'	=> __( 'Sidebar', 'xinmag' ),
			'type'	=> 'font',
			'values' => $xinwp_fonts,
		),
		'widgettitlefont'	=> array(
			'name'	=> 'widgettitlefont',
			'label'	=> __( 'Widget Title', 'xinmag' ),
			'type'	=> 'font',
			'values' => $xinwp_fonts,
		),
		'footerfont'	=> array(
			'name'	=> 'footerfont',
			'label'	=> __( 'Footer', 'xinmag' ),
			'type'	=> 'font',
			'values' => $xinwp_fonts,
		),
		'mainmenufont'	=> array(
			'name'	=> 'mainmenufont',
			'label'	=> __( 'Main Menu', 'xinmag' ),
			'type'	=> 'font',
			'values' => $xinwp_fonts,
		),

		'otherfont1'	=> array(
			'name'	=> 'otherfont1',
			'label'	=> __( 'Google Font 1', 'xinmag' ),
			'type'	=> 'text',
		),
		'otherfont2'	=> array(
			'name'	=> 'otherfont2',
			'label'	=> __( 'Google Font 2', 'xinmag' ),
			'type'	=> 'text',
		),
		'otherfont3'	=> array(
			'name'	=> 'otherfont3',
			'label'	=> __( 'Google Font 3', 'xinmag' ),
			'type'	=> 'text',
		),
		'otherfont4'	=> array(
			'name'	=> 'otherfont4',
			'label'	=> __( 'Google Font 4', 'xinmag' ),
			'type'	=> 'text',
			'helptext' => 'Enter Font Name only, e.g. Open Sans',	
		),
// Custom CSS
		'xinmag_inline_css'	=> array(
			'name'	=> 'xinmag_inline_css',
			'label'	=> __( 'Custom CSS Style', 'xinmag' ),
			'type'	=> 'textarea',
			'row'   => 40,
		),
		'xinmag_scheme_css'	=> array(
			'name'	=> 'xinmag_scheme_css',
			'type'	=> 'hidden',
		),
	);
	return apply_filters( 'xinwp_options_array', $theme_options );
}

function xinmag_theme_options_display_page() {
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
?>
    <div class="wrap">
<?php	screen_icon();
  		echo "<h2>" . __('Xinmag Theme Options', 'xinmag') . "</h2>";
		if ( false !== $_REQUEST['settings-updated'] ) { ?>
			<div class="updated fade"><p><strong><?php _e('Options Saved', 'xinmag'); ?></strong></p></div>
<?php	} ?>
		<p><a class="btn btn-primary" href="<?php _e('http://xinthemes.com/docs/','xinmag'); ?>" target="_blank"><strong><?php _e('Documentation','xinmag'); ?></strong></a>&nbsp;&nbsp;
		<a class="btn btn-success" href="<?php _e('http://xinthemes.com/support/','xinmag'); ?>" target="_blank"><strong><?php _e('Support Forum','xinmag'); ?></strong></a>&nbsp;&nbsp;
		<a class="btn btn-info" href="<?php _e('http://xinthemes.com/donate/','xinmag'); ?>" target="_blank"><strong><?php _e('Donate','xinmag'); ?></strong></a></p>
    <form method="post" action="options.php">
<?php
	global $xinwp_theme_options, $xinwp_options;
	
	$xinwp_theme_options = xinmag_theme_options_array();
	$xinwp_options = xinwp_get_options();
	settings_fields( 'xinmag_options' );
?>
	<div id="xin-wrapper" class="container_12">
		<input id="save-button" type="submit" class="button-primary" value="<?php _e('Save Options','xinmag'); ?>" />
	<div id="xin-tabs">
		<a><?php _e('Layout','xinmag'); ?></a>
		<a><?php _e('Section','xinmag'); ?></a>
		<a><?php _e('Scheme','xinmag'); ?></a>
		<a><?php _e('Fonts','xinmag'); ?></a>
		<a><?php _e('Custom CSS','xinmag'); ?></a>
<?php //Allow child them to add options.
		do_action( 'xinmag_options_tab_link' ); ?>
	</div>
<?php
/******************************************************************
*  Theme Options related to site layout
******************************************************************/
?>
	<div class="xin-pane clearfix"><div class="grid_12">
	<h3><?php _e('Site Layout (12 Columns)','xinmag'); ?></h3>	
<?php	xinwp_option_display( 'gridwidth' ); ?>
	<div class="grid_3 alpha">
		<p><b><?php _e('Content and Sidebar Width', 'xinmag'); ?></b></p>
	</div>
	<div class="grid_9">
<?php
		xinwp_option_display( 'content' );
		xinwp_option_display( 'sidebar1' );
		xinwp_option_display( 'sidebar2' );
?>
	</div><div class="clear"></div>
<?php
		xinwp_option_display( 'sidebarpos' );
		xinwp_option_display( 'sidebarresp' );
		xinwp_option_display( 'respbp' );
?>
	<div class="grid_3 alpha">
		<p><b><?php _e('Footer Widget Area Width', 'xinmag'); ?></b></p>
	</div>
	<div class="grid_9">
<?php
		xinwp_option_display( 'column_footer1' );
		xinwp_option_display( 'column_footer2' );
		xinwp_option_display( 'column_footer3' );
		xinwp_option_display( 'column_footer4' );
?>
	</div><div class="clear"></div>
		<h3><?php _e('Home Page','xinmag'); ?></h3>
<?php	xinwp_option_display( 'homepage' );
		xinwp_option_display( 'fp_option' );
		xinwp_option_display( 'fp_category' );
		xinwp_option_display( 'fp_postnum' );
		xinwp_option_display( 'fp_effect' );
?>
		<h3><?php _e('Top Bar','xinmag'); ?></h3>
<?php	xinwp_option_display( 'brandname' );
		xinwp_option_display( 'brandlogo' );
		xinwp_option_display( 'brandurl' );
		xinwp_option_display( 'menupos' );	
		do_action( 'xinmag_options_tab_layout' ); ?>			
	</div></div>
<?php
/******************************************************************
*  Theme Options: Section
******************************************************************/
?>
	<div class="xin-pane clearfix"><div class="grid_12">
	<div class="grid_6 alpha"><p><strong><?php _e('Available Categories:', 'xinmag'); ?></strong></p></div>
	<div class="grid_6"><p><strong><?php _e('Sections on Home Page:', 'xinmag'); ?></strong></p></div>
	<div class="clear"></div>
	<div class="grid_6 alpha">
	<ul id="section-available" class="section-sortable connected">	
<?php
	$sections = array();
	parse_str( $xinwp_options['section_order'], $sections );
	$cats = xinmag_top_categories();
	foreach ( $cats as $cat ) {
		if ( empty( $sections ) || ! in_array( $cat->term_id,  $sections['section']) ) {
			echo '<li id="section_' . $cat->term_id . '" style="background: ';
			echo $xinwp_options[ 'color_' . $cat->term_id ] . ';" >';	
			printf( '<input name="xinmag_theme_options[%1$s]" type="text" value="%2$s" class="xin-color-field" />',
					'color_' . $cat->term_id,
				 	esc_attr( $xinwp_options[ 'color_' . $cat->term_id ] ) );
			echo $cat->name . '</li>';		
		}
	}
?>
	</ul>
	<p><?php _e('Use drag & drop to select the categories to be display on home page and arrange the order.', 'xinmag'); ?></p>
	</div>
	<div class="grid_6">
	<ul id="section-active" class="section-sortable connected">	
<?php
	foreach ( $sections['section'] as $section ) {
		echo '<li id="section_' . $section. '" style="background: ';
		echo $xinwp_options[ 'color_' . $section ] . ';" >';
		printf( '<input name="xinmag_theme_options[%1$s]" type="text" value="%2$s" class="xin-color-field" />', 'color_' . $section, esc_attr( $xinwp_options[ 'color_' . $section ] ) );		
		echo get_the_category_by_ID( $section ) . '</li>';
	}
?>
	</ul>
	</div>
	<div class="clear"></div>
<?php
		xinwp_option_display( 'section_postnum' );		
?>
	</div></div>
<?php
/******************************************************************
*  Theme Options: Scheme
******************************************************************/
?>
	<div class="xin-pane clearfix"><div class="grid_12">
<?php	xinwp_option_display( 'colorscheme' ); ?>
		<p><?php _e('Change Background Image or Color : ','xinmag'); printf( __('<a href="%s">Click here</a>.', 'xinmag'), admin_url('themes.php?page=custom-background')); ?></p>
<?php	xinwp_option_display( 'headerbg' );
		xinwp_option_display( 'titlebarbg' );
		xinwp_option_display( 'contentbg' );
		xinwp_option_display( 'footerbg' );
		do_action( 'xinmag_options_tab_scheme' );
?>
	</div></div>	
<?php
/**************************************
* Theme Options - Fonts  *
**************************************/
?>
	<div class="xin-pane clearfix"><div class="grid_12">
	<p><?php _e( 'You do not need to select font for each element. For example. Body, paragraph and heading define the general fonts used. <span style="color:blue;font-weight:bold;">Please note that blue indicates webfonts (e.g Google Fonts) which may require additional load time.</span>', 'xinmag' ); ?></p>
<?php 
		xinwp_option_display( 'bodyfont' );
		xinwp_option_display( 'headingfont' );
?>
	<hr>
<?php
		xinwp_option_display( 'sitetitlefont' );
		xinwp_option_display( 'sitedescfont' );
?>
	<hr>
<?php
		xinwp_option_display( 'entrytitlefont' );
		xinwp_option_display( 'widgettitlefont' );
		xinwp_option_display( 'sidebarfont' );
		xinwp_option_display( 'mainmenufont' );
		xinwp_option_display( 'footerfont' );
?>
	<h3><?php _e( 'Additional Google Fonts', 'xinmag' ); ?></h3>
<?php
		xinwp_option_display( 'otherfont1' );
		xinwp_option_display( 'otherfont2' );
		xinwp_option_display( 'otherfont3' );
		xinwp_option_display( 'otherfont4' );
		do_action( 'xinmag_options_tab_fonts' );
?>
	</div></div>
<?php
/******************************************************************
*  Custom CSS
******************************************************************/
?>
	<div class="xin-pane clearfix"><div class="grid_12">
<?php
		xinwp_option_display( 'xinmag_inline_css' );	
?>
	</div></div>
<?php
/******************************************************************
*  Child Theme Options
******************************************************************/
	do_action( 'xinmag_options_tab_page' );
	xinwp_option_display( 'currenttab');
	xinwp_option_display( 'section_order' );
    xinwp_option_display( 'schemecss' );
	xinwp_option_display( 'xinmag_scheme_css' );
?>
	<p><input id="save-button-bottom" type="submit" class="button-primary" value="<?php _e( 'Save Options', 'xinmag' ); ?>" /></p>
	</div><!-- xinmag-wrapper -->
    </form>
    </div><!-- wrap -->
<?php
}
		
function xinmag_theme_options_validate( $input ) {
	$theme_options = xinmag_theme_options_array();
	foreach ( $theme_options as $theme_option ) {
		switch ( $theme_option['type'] ) {
			case 'checkbox':
				if ( ! isset( $input[ $theme_option['name'] ] ) )
					$input[$theme_option['name']] = null;
		    	$input[ $theme_option['name'] ] = ( $input[ $theme_option['name'] ] == 1 ? 1 : 0 );
				break;
			case 'text':
			case 'textarea':
				$input[ $theme_option['name'] ] = wp_kses_stripslashes( $input[ $theme_option['name'] ] );
				break;
			case 'number':	
				$input[ $theme_option['name'] ] = intval( $input[ $theme_option['name'] ] );	
				break;				
			case 'url':	
			case 'image':	
				$input[ $theme_option['name'] ] = esc_url_raw( $input[$theme_option['name'] ] );	
				break;
			case 'color':
				$input[ $theme_option['name'] ] = sanitize_text_field( $input[ $theme_option['name'] ] );	
				break;
		}
	}
	if ( $input['respbp'] < 960 )
		$input['respbp'] = 960;
	$input['xinmag_scheme_css'] = xinmag_scheme_css( $input );
	//Update Scheme Options
	$options = xinwp_get_options();
	if ( $input['colorscheme'] != $options['colorscheme'] ) {
		$scheme = $theme_options['colorscheme']['values'][ $input['colorscheme'] ];
		$input['schemecss'] = $scheme['css']; 
		foreach ( $scheme['options'] as $scheme_options )
			$input[ $scheme_options['name'] ] = $scheme_options['value'];
	}
	return $input;
}

function xinmag_scheme_css($input) {
	$xinwp_fonts = xinwp_fonts_array();
	$css = '';
	if ( 1080 != $input['gridwidth'] ) {
		$css .= '.row, .contain-to-grid .top-bar {max-width: ' . $input['gridwidth'] . 'px; }' . "\n";
	}
	if ( 1 == $input['sidebarresp'] && 3 != $input['sidebarpos'] ) {
		if ( ( $input['content'] + $input['sidebar1'] + $input['sidebar2']) <= 12 ) {
			$pct = 100 / 12 * ( $input['sidebar1'] + $input['sidebar2'] );
			$pct = (int) $pct * 100000;
			$pct = $pct / 100000;
			$css .= '@media only screen and (min-width: 768px) ';
			$css .= 'and (max-width: ' . $input['respbp'] . 'px) {' . "\n";
			$css .= '#sidebar_one,#sidebar_two { width: ' . $pct;
			$css .= '%; border-right: none; }}' . "\n";
		}
	}
	if ( 1 == $input['sidebarresp'] ) {
		$pct = 50;
			$css .= '@media only screen and (min-width: 481px) ';
			$css .= 'and (max-width: 767px) {' . "\n";
		$css .= '#sidebar_one,#sidebar_two { width: ' . $pct;
		$css .= '%; }}' . "\n";		
	}
// Magazin Section Color
	$sections = array();
	parse_str( $input['section_order'], $sections );
	if ( isset( $sections['section'] ) ) {

	foreach ($sections['section'] as $section) {
		$color = $input[ 'color_' . $section ];
		$css .= '.color_' . $section . ' { color:' . $color . '; } ' . "\n";
		$css .= '.bdcolor_' . $section . ' { border-color:' . $color . '; } ' . "\n";
		$css .= '.bgcolor_' . $section . ' { background-color:' . $color . '; } ' . "\n";
	}
		
	}
// Fonts
	if ( $input['bodyfont'] > 0 )
		$css .= 'body {font-family:' . $xinwp_fonts[ $input['bodyfont'] ]['family'] . ';}' . "\n";
	if ( $input['headingfont'] > 0 )
		$css .= 'h1, h2, h3, h4, h5, h6 {font-family:' . $xinwp_fonts[$input['headingfont']]['family'] . ';}' . "\n";
	if ( $input['entrytitlefont'] > 0 )
		$css .= '.entry-title {font-family:' . $xinwp_fonts[$input['entrytitlefont']]['family'] . ';}' . "\n";
	if ( $input['sitetitlefont'] > 0 )
		$css .= '#site-title {font-family:' . $xinwp_fonts[$input['sitetitlefont']]['family'] . ';}' . "\n";
	if ( $input['sitedescfont'] > 0 )
		$css .= '#site-description {font-family:' . $xinwp_fonts[$input['sitedescfont']]['family'] . ';}' . "\n";
	if ( $input['widgettitlefont'] > 0 )
		$css .= '.widget-title {font-family:' . $xinwp_fonts[$input['widgettitlefont']]['family'] . ';}' . "\n";
	if ( $input['sidebarfont'] > 0 )
		$css .= '.blog-widgets {font-family:' . $xinwp_fonts[$input['sidebarfont']]['family'] . ';}' . "\n";
	if ( $input['footerfont'] > 0 )
		$css .= '#footer {font-family:' . $xinwp_fonts[$input['footerfont']]['family'] . ';}' . "\n";
	if ( $input['mainmenufont'] > 0 )
		$css .= '#topbar {font-family:' . $xinwp_fonts[$input['mainmenufont']]['family'] . ';}' . "\n";
//Background
	if ( ! empty( $input['headerbg'] ) )
		$css .= '.custom-background .site-header,.site-header {background:' .  $input['headerbg'] . ';}' . "\n";
	if ( ! empty( $input['titlebarbg'] ) )
		$css .= '.custom-background .titlebar,.titlebar {background:' .  $input['titlebarbg'] . ';}' . "\n";
	if ( ! empty( $input['contentbg'] ) )
		$css .= '.custom-background .row-container,.row-container {background:' .  $input['contentbg'] . ';}' . "\n";
	if ( ! empty( $input['footerbg'] ) )
		$css .= '.custom-background #footer,#footer {background:' .  $input['footerbg'] . ';}' . "\n";
	return apply_filters( 'xinmag_scheme_css', $css );
}

