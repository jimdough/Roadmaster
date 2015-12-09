<?php
/* 	NewsPress Theme's General Page to display WooCommerce Pages
	Copyright: 2014, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since NewsPress 1.0
*/

 get_header(); ?>
	<div id="container">
	
    <?php if ( of_get_option('woo-page-full', '1') == '1'): echo '<div id="content-full">'; else: echo '<div id="content">'; endif; ?>
	<?php woocommerce_content(); ?>
	</div>


<?php if ( of_get_option('woo-page-full', '1') != '1'): get_sidebar(); endif; ?>

<?php get_footer(); ?>