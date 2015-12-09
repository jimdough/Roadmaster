<?php
/**
 * Xin Google Fonts
 * 
 * @package	xincore
 * @since   1.0
 * @author  XinThemes
 * @license GPL v3 or later
 * @link    http://www.xinthemes.com/
 */

function xinwp_fonts_array() {
	global $xinwp_options;
	$fonts = array(
	'0' => array( 'key' => '0',
			'label' => 'Default',
			'url'  => '',
			'family' => "'Helvetica Neue', Helvetica, Arial, sans-serif",
			'type' => 'Sans' ),
//Sans
	'100' => array(	'key' => '100',
			'label' => 'Arial',
			'url'  => '',
			'family' => "Arial, Helvetica, sans-serif",
			'type' => 'Sans' ),
	'101' => array(	'key' => '101',
			'label' => 'Arial Black',
			'url'  => '',
			'family' => "Arial Black, Gadget, sans-serif",
			'type' => 'Sans' ),
	'102' => array(	'key' => '102',
			'label' => 'Impact',
			'url'  => '',
			'family' => "Impact, Charcoal, sans-serif",
			'type' => 'Sans' ),		
	'103' => array(	'key' => '103',
			'label' => 'Lucida Sans',
			'url'  => '',
			'family' => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
			'type' => 'Sans' ),		
	'104' => array(	'key' => '104',
			'label' => 'Tahoma',
			'url'  => '',
			'family' => "Tahoma, Geneva, sans-serif",
			'type' => 'Sans' ),
	'105' => array(	'key' => '105',
			'label' => 'Trebuchet MS',
			'url'  => '',
			'family' => "'Trebuchet MS', sans-serif",
			'type' => 'Sans' ),
	'106' => array(	'key' => '106',
			'label' => 'Verdana',
			'url'  => '',
			'family' => "Verdana, Geneva, sans-serif",
			'type' => 'Sans' ),
	'107' => array(	'key' => '107',
			'label' => 'MS Sans Serif',
			'url'  => '',
			'family' => "'MS Sans Serif', Geneva, sans-serif",
			'type' => 'Sans' ),		
//Sans Webs
	'200' => array(	'key' => '200',
			'label' => 'Open Sans',
			'url'  => '//fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic',
			'family' => "'Open Sans', sans-serif",
			'type' => 'Sans' ),
	'201' => array(	'key' => '201',
			'label' => 'Ubuntu',
			'url'  => '//fonts.googleapis.com/css?family=Ubuntu:400,400italic,700italic,700',
			'family' => "'Ubuntu', sans-serif;",
			'type' => 'Sans' ),	
/* Other popular google font
    Myriad Pro, League Gothic, Cabin, Corbel, Museo Slab
    Bebas Neue, Lobster, Franchise, PT Serif
*/		
//Serif
	'400' => array(	'key' => '400',
			'label' => 'Georgia',
			'url'  => '',
			'family' => "Georgia, serif",
			'type' => 'Serif' ),
	'401' => array(	'key' => '401',
			'label' => 'Palatino',
			'url'  => '',
			'family' => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
			'type' => 'Serif' ),
	'402' => array(	'key' => '402',
			'label' => 'Times New Roman',
			'url'  => '',
			'family' => "'Times New Roman', Times, serif",
			'type' => 'Serif' ),	
	'403' => array(	'key' => '403',
			'label' => 'MS Serif',
			'url'  => '',
			'family' => "'MS Serif', 'New York', serif",
			'type' => 'Serif' ),		
//Serif Webfonts

//Monospae
	'600' => array(	'key' => '600',
			'label' => 'Courier New',
			'url'  => '',
			'family' => "'Courier New', monospace",
			'type' => 'Monospace' ),
	'601' => array(	'key' => '601',
			'label' => 'Lucida Console',
			'url'  => '',
			'family' => "'Lucida Console', Monaco, monospace",
			'type' => 'Monospace' ),
//Monospae Webfonts

//Cursive
	'800' => array(	'key' => '800',
			'label' => 'Comic Sans MS',
			'url'  => '',
			'family' => "'Comic Sans MS', cursive",
			'type' => 'Cursive' ),
//Cursive Webfonts
	);
//User defined google fonts
	if ( ! empty( $xinwp_options['otherfont1'] ) ) {
		$fonts['1001'] = 	array(	'key' => '1001',
			'label' => $xinwp_options['otherfont1'],
			'url'  => xinwp_google_font_url( $xinwp_options['otherfont1']),
			'family' => "'" . $xinwp_options['otherfont1'] ."', Helvetica, Arial, sans-serif",
			'type' => 'Others' );
	}
	else {
		$fonts['1001'] = 	array(	'key' => '1001',
			'label' => __( 'Other Font 1', 'xinwp' ),
			'url'  => '',
			'family' => "Helvetica, Arial, sans-serif",
			'type' => 'Others' );		
	}	
	if ( ! empty( $xinwp_options['otherfont2'] ) ) {
		$fonts['1002'] = 	array(	'key' => '1002',
				'label' => $xinwp_options['otherfont2'],
				'url'  => xinwp_google_font_url( $xinwp_options['otherfont2']),
				'family' => "'" . $xinwp_options['otherfont2'] ."', Helvetica, Arial, sans-serif",
				'type' => 'Others' );
	}
	else {
		$fonts['1002'] = 	array(	'key' => '1002',
				'label' => __( 'Other Font 2', 'xinwp' ),
				'url'  => '',
				'family' => "Helvetica, Arial, sans-serif",
				'type' => 'Others' );		
	}	
	if ( ! empty( $xinwp_options['otherfont3'] ) ) {
		$fonts['1003'] = 	array(	'key' => '1003',
				'label' => $xinwp_options['otherfont3'],
				'url'  => xinwp_google_font_url( $xinwp_options['otherfont3']),
				'family' => "'" . $xinwp_options['otherfont3'] ."', Helvetica, Arial, sans-serif",
				'type' => 'Others' );
	}
	else {
		$fonts['1003'] = 	array(	'key' => '1003',
				'label' => __( 'Other Font 3', 'xinwp' ),
				'url'  => '',
				'family' => "Helvetica, Arial, sans-serif",
				'type' => 'Others' );		
	}	
	if ( ! empty( $xinwp_options['otherfont4'] ) ) {
		$fonts['1004'] = 	array(	'key' => '1004',
				'label' => $xinwp_options['otherfont4'],
				'url'  => xinwp_google_font_url( $xinwp_options['otherfont4']),
				'family' => "'" . $xinwp_options['otherfont4'] ."', Helvetica, Arial, sans-serif",
				'type' => 'Others' );
	}	
	else {
		$fonts['1004'] = 	array(	'key' => '1004',
				'label' => __( 'Other Font 4', 'xinwp' ),
				'url'  => '',
				'family' => "Helvetica, Arial, sans-serif",
				'type' => 'Others' );		
	}	
	return apply_filters( 'xinwp_fonts_array', $fonts );	
}

if ( ! function_exists( 'xinwp_google_font_url' ) ) :
// Change in child theme if other font variants are desired.
function xinwp_google_font_url( $name ) {
	return '//fonts.googleapis.com/css?family=' . str_replace(' ', '+', $name) . ':400,400italic,700italic,700';
}
endif;
