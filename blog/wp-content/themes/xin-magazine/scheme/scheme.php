<?php
/**
 * Add scheme related options
 *
 * @package xinmag
 * @since xinmag 1.0
 */
if ( ! defined('ABSPATH') ) exit;

function xinmag_scheme_options( $scheme = NULL ) {
	$theme_uri = get_template_directory_uri();
	$scheme = array(
	'0' 		=>	array( 'key' => '0',
				   		'label' => __('Default','xinmag'),
						'css' => '',
						'demoimg' => '',
						'options' => array(),
				),
	'dark' 		=> array( 'key' => 'dark',
				   		'label' => __('Dark','xin'),
						'css' => $theme_uri . '/scheme/dark.css',
						'demoimg' => '',
				   		'options' => array(),
				),
	);
	return apply_filters( 'xinmag_colorscheme_array', $scheme );
}
?>