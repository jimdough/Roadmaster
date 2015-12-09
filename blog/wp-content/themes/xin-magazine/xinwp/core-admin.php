<?php
/**
 * Xin Core Admin Functions
 * 
 * @package	xincore
 * @since   1.0
 * @author  XinThemes
 * @license GPL v3 or later
 * @link    http://www.xinthemes.com/
 */
if ( ! defined('ABSPATH') ) exit;

if ( ! function_exists( 'xinwp_admin_header_style_cb' ) ) :
function xinwp_admin_header_style_cb() {
?>
<style type="text/css">
.appearance_page_custom-header #headimg {
	background-repeat:no-repeat;
	border: none;
}
#headimg h1,
#desc {
	font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
}
#headimg h1 {
	margin: 0;
}
#headimg h1 a {
	font-size: 32px;
	line-height: 36px;
	text-decoration: none;
}
#desc {
	font-size: 14px;
	line-height: 23px;
	padding: 0 0 3em;
}
<?php
	if ( HEADER_TEXTCOLOR != get_header_textcolor() ) {
?>
#site-title a,
#site-description {
	color: #<?php echo get_header_textcolor(); ?>;
}
<?php } ?>
</style>
<?php
}
endif;

if ( ! function_exists( 'xinwp_admin_header_image_cb' ) ) :
function xinwp_admin_header_image_cb() { ?>
<div id="headimg">
<?php
	$color = get_header_textcolor();
	$image = get_header_image();
	if ( $color && $color != 'blank' )
		$style = ' style="color:#' . $color . '"';
	else
		$style = ' style="display:none"';
?>
	<?php if ( $image ) : ?>
		<img src="<?php echo esc_url( $image ); ?>" alt="" />
	<?php endif; ?>
	<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
</div>
<?php
}
endif;

function xinwp_load_template_scripts( $hooks ) {
	global $post_type;

	$tmp_path = get_template_directory_uri();	
	if ( 'page' == $post_type ) {
		wp_enqueue_script( 'xinwp-template', $tmp_path . '/xinwp/js/template.js', array( 'jquery') );	
	}
	if ( 'widgets.php' == $hooks ) {
		wp_enqueue_style( 'xinmp-widgets', $tmp_path . '/xinwp/css/widgets.css', null, '1.0' );	
		wp_enqueue_script( 'xinwp-widgets', $tmp_path . '/xinwp/js/widgets.js', array( 'jquery-ui-sortable' ) );			
	}
}
add_action( 'admin_enqueue_scripts', 'xinwp_load_template_scripts' );
//Add meta boxes to page/post
function xinwp_meta_box() {
	global $xinwp_meta_box;

	$prefix = '_' . XINWP_ID;	//Prefix for theme
	$xinwp_meta_box['page'] = array( 
		'id' => 'xinwp-page-meta',
		'title' => __('Template Options', 'xinwp'),  
		'context' => 'side',  //normal, advaned, side  
		'priority' => 'low', //high, core, default, low
		'fields' => array(
        	array(
            	'name' => __( 'Post Category :' ,'xinwp'),
            	'desc' => '',
            	'id' => $prefix . '_category',
            	'type' => 'category',
            	'default' => ''
        	),
        	array(
            	'name' => __( 'Posts per page :', 'xinwp' ),
            	'desc' => '',
            	'id' => $prefix . '_postperpage',
            	'type' => 'number',
            	'default' => '',
        	),
        	array(
            	'name' => __('Page Title :', 'xinwp'),
            	'desc' => __('check to hide page title','xinwp'),
            	'id' => $prefix . '_title',
            	'type' => 'checkbox',
            	'default' => '',
        	),
			array(
            	'name' => __('Sidebar :', 'xinwp'),
            	'desc' => __('check to display sidebar','xinwp'),
            	'id' => $prefix . '_sidebar',
            	'type' => 'checkbox',
            	'default' => '',
        	),
        	array(
            	'name' => __('Layout :', 'xinwp'),
            	'desc' => __('Columns','xinwp'),
            	'id' => $prefix . '_column',
            	'type' => 'select',
            	'default' => '',
				'options' => array( 
								array( 'key' => '1',
									   'name' => '1' ),
								array( 'key' => '2', 
									   'name' => '2' ),
								array( 'key' => '', //Dedault
									   'name' => '3' ),
								array( 'key' => '4', 
									   'name' => '4' ),
							 ),
        	),
        	array(
            	'name' => __('Image Size : ', 'xinwp'),
            	'desc' => '',
            	'id' => $prefix . '_thumbnail',
            	'type' => 'select',
            	'default' => '',
				'options' => xinwp_thumbnail_array(),
        	),
        	array(
            	'name' => __('Custom Size (Width) :', 'xinwp'),
            	'desc' => '',
            	'id' => $prefix . '_size_x',
            	'type' => 'number',
            	'default' => '',
        	),
        	array(
            	'name' => __('Custom Size (Height) :', 'xinwp'),
            	'desc' => '',
            	'id' => $prefix . '_size_y',
            	'type' => 'number',
            	'default' => '',
        	),
        	array(
            	'name' => __('Intro Text : <br />', 'xinwp'),
            	'desc' => '',
            	'id' => $prefix . '_intro',
            	'type' => 'radio',
            	'default' => '',
				'options' => array( 
								array( 'key' => '',
									   'name' => __('Excerpt<br />','xinwp') ),
								array( 'key' => '2', 
									   'name' => __('Content<br />','xinwp') ),
								array( 'key' => '3', 
									   'name' => __('None<br />','xinwp') ),
							 ),
        	),
        	array(
            	'name' => __('Post Meta :', 'xinwp'),
            	'desc' => __('check to display post meta','xinwp'),
            	'id' => $prefix . '_disp_meta',
            	'type' => 'checkbox',
            	'default' => '',
        	),
        	array(
            	'name' => 'Data',
            	'desc' => 'Data',
            	'id' => $prefix . '_pt_data',
            	'type' => 'hidden',
            	'default' => '',
        	),
    	)
	);
	$xinwp_meta_box['post'] = array( 
		'id' => 'xinwp-post-meta',
		'title' => __('Post Options', 'xinwp'),  
		'context' => 'side',  //normal, advaned, side  
		'priority' => 'high', //high, core, default, low
		'fields' => array(
        	array(
            	'name' => __('Layout :', 'xinwp'),
            	'desc' => '',
            	'id' => $prefix . '_layout',
            	'type' => 'select',
            	'default' => '',
				'options' => array( 
					array( 'key' => '', //Dedault
						   'name' => __( 'Default', 'xinwp' ) ),
					array( 'key' => '1', 
						   'name' => __( 'Fullwidth', 'xinwp' ) ),
					array( 'key' => '2', 
						   'name' => __( 'Fullscreen', 'xinwp' ) ) ),
        	),			
        	array(
            	'name' => '',
            	'desc' => __('Featured Post','xinwp'),
            	'id' => $prefix . '_featured',
            	'type' => 'checkbox',
            	'default' => '',
        	),
        	array(
            	'name' => __('Read More Label :', 'xinwp'),
            	'desc' => '',
            	'id' => $prefix . '_readmore',
            	'type' => 'text',
            	'default' => '',
        	),
    	)
	);

    foreach( $xinwp_meta_box as $post_type => $value ) {
    	add_meta_box( $value['id'], $value['title'], 'xinwp_meta_display', $post_type, $value['context'], $value['priority'] );
    }
}
add_action( 'admin_menu', 'xinwp_meta_box' );

//Display Meta Box
function xinwp_meta_display() {
	global $xinwp_meta_box, $post;
 
	// Use nonce for verification
	echo '<input type="hidden" name="xinwp_meta_box_nonce" value="', wp_create_nonce( basename( __FILE__ ) ), '" />';
 
	foreach ( $xinwp_meta_box[ $post->post_type ]['fields'] as $field ) {
		$meta = get_post_meta( $post->ID, $field['id'], true);

		if ( 'hidden' != $field['type'] ) {
			$fldid = str_replace( XINWP_ID, "xinwp",  $field['id']);
			echo '<p id="p' . $fldid . '"><strong>' . $field['name'] . ' </strong>';
		}
		switch ( $field['type'] ) {
			case 'text':
				echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . ( $meta ? $meta : $field['default'] ) . '" size="30" />';
				break;
			case 'hidden':
				echo '<input type="hidden" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . ( $meta ? $meta : $field['default'] ) . '" />';
				break;
			case 'textarea':
				echo '<textarea name="' . $field['id'] . '" id="'. $field['id'] . '" cols="60" rows="4" >' . ( $meta ? $meta : $field['default'] ) . '</textarea>' . '<br />' . $field['desc'];
				break;
			case 'number':
				echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . ( $meta ? $meta : $field['default'] ) . '" size="4" />';
				break;
			case 'select':
				echo '<select name="'. $field['id'] . '" id="'. $field['id'] . '">';
				foreach ( $field['options'] as $option ) {
					echo '<option value="' . $option['key'] . '" ' . ( $meta == $option['key'] ? ' selected="selected"' : '' ) . '>' . $option['name'] . '</option>';
				}
				echo '</select> ' . $field['desc'];
				break;
			case 'category':
				echo '<select name="'. $field['id'] . '" id="'. $field['id'] . '">';		  
				echo '<option value="" ' . ( $meta ? '' : 'selected="selected"' ) . '>' . __('All Categories','xinwp') . '</option>';
				foreach ( xinwp_categories() as $category ) {
					echo '<option value="' . $category->term_id . '" ' . ( $meta == $category->term_id ? ' selected="selected"' : '' ) . '>' . $category->name . '</option>';
				}
				echo '</select>';
				break;
			case 'radio':
				foreach ( $field['options'] as $option ) {
					echo '<label class="description"><input type="radio" name="' . $field['id'] . '" value="' . $option['key'] . '"' . ( $meta == $option['key'] ? ' checked="checked"' : '' ) . ' /> ' . $option['name'] . '</label>';
				}
				break;
			case 'checkbox':
				echo '<label class="description"><input type="checkbox" name="' . $field['id'] . '" id="' . $field['id'] . '" value="1"' . ( $meta ? ' checked="checked"' : '' ) . ' /> ' . $field['desc'] . '</label>';
				 break;
		}
		echo '</p>';
	}
}
// Save data from meta box
function xinwp_meta_save( $post_id ) {
    global $xinwp_meta_box,  $post;
    
    //Verify nonce
	if ( ! isset( $_POST['xinwp_meta_box_nonce'] ) )
		return $post_id;
	if ( ! wp_verify_nonce( $_POST['xinwp_meta_box_nonce'], basename( __FILE__ ) ) )
        return $post_id; 
    //Check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;
 
    //Check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;
    } elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
    
    foreach ( $xinwp_meta_box[ $post->post_type ]['fields'] as $field ) {
        $old = get_post_meta( $post_id, $field['id'], true );
		if ( isset( $_POST[ $field['id'] ] ) ) {
			$new = $_POST[ $field['id'] ];
			if ( $field['type'] == 'number')
				$new = (int) $new;
		}
		else
        	$new = '';			

        if ( $new && $new != $old )
            update_post_meta( $post_id, $field['id'], $new );
        elseif ( '' == $new && $old )
            delete_post_meta( $post_id, $field['id'], $old );
    }
}
add_action( 'save_post', 'xinwp_meta_save' );
