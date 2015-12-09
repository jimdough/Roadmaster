<?php
/**
 * Xin Core: Foundation Framework
 * 
 * @package	xincore
 * @since   1.0
 * @author  XinThemes
 * @license GPL v3 or later
 * @link    http://www.xinthemes.com/
 */
class xinwp_topbar_walker extends Walker_Nav_Menu {
 
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		$element->has_children = ! empty( $children_elements[ $element->ID ] );
		$element->classes[] = ( $element->current || $element->current_item_ancestor) ? 'active' : '';
		$element->classes[] = ( $element->has_children ) ? 'has-dropdown' : '';
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item_html = '';
		parent::start_el( $item_html, $item, $depth, $args );	
		$output .= ( 0 == $depth) ? '<li class="divider"></li>' : '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;	
		if( in_array( 'section', $classes ) ) {
			$output .= '<li class="divider"></li>';
			$item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '<label>$1</label>', $item_html);
		}
		$output .= $item_html;
	}

	function start_lvl(&$output, $depth = 0, $args = array() ) {
		$output .= "\n<ul class=\"sub-menu dropdown\">\n";
	}
}

function xinwp_nav_fb() {
	echo '<ul class="nav-bar">';
	wp_list_pages(array(
			'echo' => 1,
			'title_li'     => '',
			'sort_column' => 'menu_order, post_title',
			'walker' => new xinwp_page_walker(),
			'post_type' => 'page',
			'post_status' => 'publish'
	));
	echo '</ul>';
}

class xinwp_page_walker extends Walker_Page {
	
	function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		$item_html = '';
		parent::start_el( $item_html, $page, $depth, $args, $current_page );
		$css_class = array( 'page_item', 'page-item-'.$page->ID );
		if ( $args['has_children'] ) {
			$css_class[] = 'has-dropdown';
		}
		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
		$item_html = '<li class="' . $css_class . '"><a href="' . get_permalink($page->ID) . '">' . apply_filters( 'the_title', $page->post_title, $page->ID ) . '</a>';
		$output .= $item_html;
	}
 
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "\n<ul class=\"dropdown\">\n";
	}
}

if ( ! function_exists( 'xinwp_content_class' ) ) :
function xinwp_content_class() {
    global $xinwp_options;
	$class = "large-" . $xinwp_options['content'] . ' ' ;
	if ( 2 == $xinwp_options['sidebarpos'] && ( $xinwp_options['sidebar1'] > 0 || $xinwp_options['sidebar2'] > 0 ) ) {
		if ( ( $xinwp_options['content'] + $xinwp_options['sidebar1'] + $xinwp_options['sidebar2'] ) > 12 ) {
			if ($xinwp_options['sidebar1'] > $xinwp_options['sidebar2'])
				$push_col = $xinwp_options['sidebar1']; 
			else
				$push_col = $xinwp_options['sidebar2'];
		}
		else {
			$push_col = $xinwp_options['sidebar1'] + $xinwp_options['sidebar2']; 			
		}
		$class = $class . "push-" . $push_col . ' ';
	}
	elseif ( 3 == $xinwp_options['sidebarpos'] && $xinwp_options['sidebar1'] > 0 ) {
		$push_col = $xinwp_options['sidebar1']; 
		$class = $class . "push-" . $push_col . ' ';		
	}
	$class .= 'columns';
	return $class;
}
endif;

if ( ! function_exists( 'xinwp_grid_columns' ) ) :
function xinwp_grid_columns( $col ) {
	return 'large-' . $col . ' columns';
}
endif; 

if ( ! function_exists( 'xinwp_grid_full' ) ) :
function xinwp_grid_full() {
	return "large-12 columns";
}
endif;

if ( ! function_exists( 'xinwp_bbp_class' ) ) :
/** return grid class for bbPress & BuddyPress page */
function xinwp_bbp_class() {
    global $xinwp_options;

	$class = "large-" . $xinwp_options['bbp_column1'] . ' columns ' ;
	if ( 1 == $xinwp_options['bbp_position'] && $xinwp_options['bbp_column2'] > 0 ) {
			$push_col = $xinwp_options['bbp_column2']; 	
		$class = $class . "push-" . $push_col . ' ';
	}
	$class = $class . 'bbp-content';
	return $class;
}
endif;

function xinwp_add_search_box($items, $args) {
	ob_start();
    get_search_form();
	$searchform = ob_get_contents();
	ob_end_clean();

	$items .= '<li class="has-form">' . $searchform . '</li>';
    return $items;
}

if ( ! function_exists( 'xinwp_top_menu' ) ):
function xinwp_top_menu( $search = true ) {
?>
<div id="topbar" class="contain-to-grid sticky-topbar">
<nav class="top-bar">
  <ul class="title-area">
	<li class="name">
<?php
	global $xinwp_options;

	if ( ! empty( $xinwp_options['brandurl'] ) )
		$url =  $xinwp_options['brandurl'];
	else
		$url = home_url( '/' );
	if ( ! empty( $xinwp_options['brandname'] ) ) {
		echo '<h3><a href="' . esc_url( $url ) . '">';
		echo esc_attr( $xinwp_options['brandname'] ) . '</a></h3>';
	} elseif ( ! empty( $xinwp_options['brandlogo'] ) ) {
		echo '<a href="' . esc_url( $url ) . '"><img src="';
		echo esc_url( $xinwp_options['brandlogo'] ) . '" alt="';
		echo get_bloginfo( 'name' ) . '"></a>';
	}
?>
	</li>
	<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>
  <section class="top-bar-section">
<?php
	if ( 'right' == $xinwp_options['menupos'] & $search )
		add_filter( 'wp_nav_menu_items', 'xinwp_add_search_box', 10, 2);
	wp_nav_menu(array(
		'container' => false,
		'container_class' => 'menu',
		'menu_class' => 'top-bar-menu ' . $xinwp_options['menupos'],
		'theme_location' => 'top-bar', // where it's located in the theme
		'fallback_cb' => 'xinwp_nav_fb', // fallback function (see below)
		'walker' => new xinwp_topbar_walker()
	));
	if ( $search ) {
		if ( 'right' == $xinwp_options['menupos'] )
			remove_filter('wp_nav_menu_items','xinwp_add_search_box', 10, 2);
		else {
?>
		<section class="top-bar-section">
		<ul class="right">
			<li class="has-form"><?php get_search_form(); ?></li>
		</ul>
		</section>
<?php	
		}
	}
?>
  </section>
</nav></div>
<?php
}
endif;
