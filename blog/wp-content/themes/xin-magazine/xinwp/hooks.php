<?php
if ( ! defined( 'ABSPATH' )) exit;
/**
 * Xin Action Hooks
 * 
 * @package	xincore
 * @since   1.0
 * @author  XinThemes
 * @license GPL v3 or later
 * @link    http://www.xinthemes.com/
 */
function xinwp_header_branding() {
	do_action( 'xinwp_header_branding' );
}

function xinwp_header_before_main() {
	do_action( 'xinwp_header_before_main' );
}
/**
 * WooCommerce Support
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'xinwp_woocommerce_content_wrapper', 10);
add_action( 'woocommerce_after_main_content', 'xinwp_woocommerce_content_wrapper_end', 10);

function xinwp_woocommerce_content_wrapper() {
  echo '<div id="content" class="' . xinwp_content_class() . '">';
}
 
function xinwp_woocommerce_content_wrapper_end() {
  echo '</div><!-- end of #content -->';
}

/**
 * Jigoshop Support
 */
remove_action( 'jigoshop_before_main_content', 'jigoshop_output_content_wrapper', 10 );
remove_action( 'jigoshop_after_main_content', 'jigoshop_output_content_wrapper_end', 10 );

add_action( 'jigoshop_before_main_content', 'xinwp_jigoshop_content_wrapper', 10 );
add_action( 'jigoshop_after_main_content', 'xinwp_jigoshop_content_wrapper_end', 10 );

function xinwp_jigoshop_content_wrapper() {
  echo '<div id="content" class="' . xinwp_cotent_class() . '">';
}
 
function xinwp_jigoshop_content_wrapper_end() {
  echo '</div><!-- end of #content -->';
}
?>