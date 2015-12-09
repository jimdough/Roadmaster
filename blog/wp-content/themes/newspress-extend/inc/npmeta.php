<?php
/*
	NewsPress Theme's Meta Options
	Copyright: 2014, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since NewsPress 1.0
*/


$prefix = 'np_';
$meta_box = array(
    'id' => 'np-meta-box',
    'title' => 'News Press Options',
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        
		 array(
            'name' => 'News Author:',
            'desc' => 'Insert the News Author if Applicable.',
            'id' => $prefix . 'author',
            'type' => 'text',
            'std' => ''
        ),
		
		array(
            'name' => 'News Sub Title:',
            'desc' => 'Insert the News Sub Title if Applicable.',
            'id' => $prefix . 'subtitle',
            'type' => 'text',
            'std' => ''
        ),
        
		array(
            'name' => 'Show in Front Page Heading Slider',
            'id' => $prefix . 'fps',
            'type' => 'checkbox'
        ),
		
        array(
            'name' => 'Front Page Heading:',
            'id' => $prefix . 'fph',
            'type' => 'radio',
            'options' => array(
                array('name' => 'Heading &nbsp; &nbsp;', 'value' => '1'),
                array('name' => 'Sub Heading &nbsp; &nbsp;', 'value' => '2'),
				 array('name' => 'None', 'value' => '3')
        )
		),
		
		array(
            'name' => 'Breaking News',
            'id' => $prefix . 'brkn',
            'type' => 'checkbox'
        ),
		
		array(
            'name' => 'Very Important Heading',
            'id' => $prefix . 'vih',
            'type' => 'checkbox'
        ),
		
		array(
            'name' => '100% Width of Heading Featured Image',
            'id' => $prefix . 'fi100',
            'type' => 'checkbox'
        ),
		
		array(
            'name' => 'Editors Choice',
            'id' => $prefix . 'ec',
            'type' => 'checkbox'
        ),
		
		array(
            'name' => 'Category HeadLine',
            'id' => $prefix . 'ch',
            'type' => 'checkbox'
        ),
				
		array(
 			'name' => 'Do not Show Featured Image in Single Page News',
            'id' => $prefix . 'dsfisp',
            'type' => 'checkbox'
        )
		
    )
);

add_action('admin_menu', 'newspress_add_box');
// Add meta box
function newspress_add_box() {
    global $meta_box;
    add_meta_box($meta_box['id'], $meta_box['title'], 'newspress_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}


// Callback function to show fields in meta box
function newspress_show_box() {
    global $meta_box, $post;
    // Use nonce for verification
    echo '<input type="hidden" name="newspress_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<table class="form-table">';
    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
                break;
			case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="unchecked"' : '', ' />';
                break;			
				
        }
        echo     '</td><td>',
            '</td></tr>';
    }
    echo '</table>';
}


add_action('save_post', 'newspress_save_data');
// Save data from meta box
function newspress_save_data($post_id) {
    global $meta_box;
    // verify nonce
	if(isset($_POST['newspress_meta_box_nonce'])):
    if (!wp_verify_nonce($_POST['newspress_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }
	endif;
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    // check permissions
	if(isset($_POST['post_type'])):
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    endif;
	
	
	foreach($meta_box['fields'] as $field){
    if(isset($_POST[$field['id']])){
        // POST field sent - update
        $new = $_POST[$field['id']];
        update_post_meta($post_id, $field['id'], $new);

    } else {
        // POST field not sent - delete
        $old = get_post_meta($post_id, $field['id'], true);
        delete_post_meta($post_id, $field['id'], $old);
    }
}



}


?>