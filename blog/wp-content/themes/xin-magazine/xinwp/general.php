<?php
/**
 * Xin General Functions
 * 
 * @package	xincore
 * @since   1.0
 * @author  XinThemes
 * @license GPL v3 or later
 * @link    http://www.xinthemes.com/
 */
if ( ! defined('ABSPATH') ) exit;

//Sorting array by key
function xinwp_sort_array( &$array, $key ) {
    $sorter = array();
    $ret = array();
    reset( $array );
    foreach ( $array as $ii => $va ) {
        $sorter[ $ii ] = $va[ $key ];
    }
    asort( $sorter );
    foreach ( $sorter as $ii => $va ) {
        $ret[ $ii ] = $array[ $ii ];
    }
    $array = $ret;
}
//Thumbal Array
function xinwp_thumbnail_array() {
	$sizes = array (
		array(	'key' => '',
				'name' => __( 'Thumbnail', 'xinmag' ) ),
		array(	'key' => 'medium',
				'name' => __( 'Medium', 'xinmag' ) ),
		array(	'key' => 'large',
				'name' => __( 'Large', 'xinmag' ) ),
		array(	'key' => 'full',
				'name' => __( 'Full', 'xinmag' ) ),
		array(	'key' => 'custom',
				'name' => __( 'Custom', 'xinmag' ) ),
		array(	'key' => 'none',
				'name' => __( 'None', 'xinmag' ) ),
	);
	global $_wp_additional_image_sizes;

	if ( isset( $_wp_additional_image_sizes ) )
		foreach( $_wp_additional_image_sizes as $name => $item) 
			$sizes[] = array( 'key' => $name, 'name' => $name );
	return apply_filters( 'xinwp_thumbnail_array', $sizes );
}
// Return Thumbnail
if ( ! function_exists( 'xinwp_thumbnail_size' ) ) : 
function xinwp_thumbnail_size( $option, $x = 96, $y = 96 ) {

	if ( empty( $option ) )
		return 'thumbnail';
	elseif ( 'custom' == $option ) {
		if ( ($x > 0) && ($y > 0) )
			return array( $x, $y);
		else
			return 'thumbnail';		
	}
	else 
		return $option;
}
endif;
// Return Post Type array
function xinwp_post_types() { 
	$args = array(
  		'public'   => true,
  		'_builtin' => false ); 
	$post_types = get_post_types( $args ); 
	$types = array( 
		array(	'key' => 'post',
				'name' => __( 'post', 'xinmag' ) ),
		array(	'key' => 'page',
				'name' => __( 'page', 'xinmag' ) ),
	);
	foreach ( $post_types as $post_type ) {
		$types[] = array( 'key' => $post_type, 'name' => $post_type );
	}
	return apply_filters( 'xinwp_post_types', $types );
}
/* Category Array */
function xinwp_categories() {
	$category = get_categories();
	return apply_filters( 'xinwp_categories', $category );
}

function xinwp_gallery_image_ids( $content ) {
	$image_ids = array();
    preg_match_all( '/\[gallery.*.\]/' , $content, $matches);
	foreach ( $matches[0] as $match ) {
        $str = str_replace (" ", "&", trim ($match));
        $str = str_replace ('"', '', $str);
		$attrs = wp_parse_args( $str );
		if ( isset( $attrs['ids'] ) ) {
			$ids = explode( ',', $attrs['ids'] );	
			$image_ids = array_merge( $image_ids, $ids );	
		}
	}
	return $image_ids;
}

function xinwp_skitter_content( $images, $size = 'full' ) {
	$slider = '<div class="border_box">';
	$slider .= '<div class="box_skitter box_skitter_inline box_skitter_custom">';
	$slider .= '<ul>';
	foreach ( $images as $id ) {
		$slider .= '<li>';
		$image = wp_get_attachment_image_src( $id, $size );
		$slider .=  '<img src="' . esc_url( $image[0] ) . '" class="random">';
		$alt_text = get_post_meta( $id, '_wp_attachment_image_alt', true );
		$slider .=  '<div class="label_text"><p>' .  $alt_text . '</p></div>';
		$slider .=  '</li>';		
	}
	$slider .= '</ul></div></div>';
	return apply_filters( 'xinwp_skitter_content', $slider );
}

function xinwp_skitter_inline( $images, $size = 'full' ) {
	$height = 99999;

	foreach ( $images as $id ) {
		$image = wp_get_attachment_image_src( $id, $size );
		if ( $image[2] < $height )
			$height = $image[2];
	}
	$css = "<!-- XinThemes Skitter Inline CSS -->\n";
	$css .= "<style>\n";
	$css .= '.box_skitter_inline {' . "\n";
	$css .= '  height: ' . $height . 'px;' . "\n";
	$css .= "}\n";
	$css .= "</style>\n<!-- XinThemes Skitter Inline CSS -->\n";
	echo apply_filters( 'xinwp_skitter_inline', $css );
}

/* Content Filter: Remove image from post*/
function xinwp_remove_images( $content ) {
   $postOutput = preg_replace('/<img[^>]+./','', $content);
   return $postOutput;
}
// Read tag ids by category
function xinwp_get_category_tags( $category_id ) {
	global $wpdb;
	$tags = $wpdb->get_results("
	SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, null as tag_link FROM wp_posts as p1
		LEFT JOIN wp_term_relationships as r1 ON p1.ID = r1.object_ID
		LEFT JOIN wp_term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
		LEFT JOIN wp_terms as terms1 ON t1.term_id = terms1.term_id,
			wp_posts as p2
		LEFT JOIN wp_term_relationships as r2 ON p2.ID = r2.object_ID
		LEFT JOIN wp_term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
		LEFT JOIN wp_terms as terms2 ON t2.term_id = terms2.term_id
		WHERE
			t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id = ". $category_id. " AND
			t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
			AND p1.ID = p2.ID
		ORDER by tag_name");
	$count = 0;
	foreach ($tags as $tag) {
		$tags[$count]->tag_link = get_tag_link($tag->tag_id);
		$count++;
	}
	return $tags;
}

/**
 * Returns a "Continue Reading" link for excerpts
 */
function xinwp_readmore_link() {
	global $post;
	
	$readmore_meta = '_' . XINWP_ID . '_readmore';
	$readmore = get_post_meta( $post->ID, $readmore_meta, true );
	if ( empty( $readmore ) )
		$readmore = __( 'read more', 'xinwp' );
	$link = ' <a class="more-link" href="'. get_permalink() . '">' . $readmore . '</a>';
	return apply_filters( 'xinwp_readmore_link', $link );
}

/* Return menu name */
function xinwp_menu_name( $theme_location ) {
	if( ! $theme_location )
		return false;
 
	$theme_locations = get_nav_menu_locations();
	if( ! isset( $theme_locations[$theme_location] ) )
		return false;
 
	$menu_obj = get_term( $theme_locations[$theme_location], 'nav_menu' );
	if( ! $menu_obj )
		$menu_obj = false;
	if( ! isset( $menu_obj->name ) )
		return false;
 
	return $menu_obj->name;
}