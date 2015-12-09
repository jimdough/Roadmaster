<?php
/**
 * Xin Options
 * 
 * @package	xincore
 * @since   1.0
 * @author  XinThemes
 * @license GPL v3 or later
 * @link    http://www.xinthemes.com/
 */
function xinwp_option_display( $option_name ) {
	global $xinwp_theme_options, $xinwp_options, $xinwp_fonts;
	
	$theme_option = $xinwp_theme_options[ $option_name ];
	$options = $xinwp_options;
	$name = XINWP_ID . '_theme_options[' . $theme_option['name'] . ']';
	if ( $theme_option['type'] != 'hidden' && empty( $theme_option['fieldonly'] ) ) {
		if ( isset( $theme_option['label'] ) ) {
			echo '<div class="grid_3 alpha">';	
			echo '<p><b>' . $theme_option['label'] . '</b></p></div>';		
		}
		echo '<div class="grid_9"><p>';		
	}
	switch ( $theme_option['type'] ) {
		case 'radio':
			$values = $theme_option['values'];
			foreach ( $values as $value ) {
				printf( '<input id="%1$s_%2$s" name="%1$s" type="radio" value="%2$s" %3$s />',
					$name,
				 	$value['key'],
				 	checked( $value['key'], $options[$theme_option['name']], false ) );
				printf( '<label class="description" for="%1$s_%2$s">%3$s</label>',
					$name,
					$value['key'],
					esc_attr( $value['label'] )	);
			}
			break;
		case 'checkbox':
			printf( '<input id="%1$s" name="%1$s" type="checkbox" value="1" %2$s />',
					$name,
				 	checked( '1', $options[$theme_option['name']], false ) );
				printf( '<label class="description" for="%1$s">%2$s</label>',
					$name,
					esc_attr( $theme_option['desc'] )	);
			break;				
		case 'url':
		case 'text':
			printf( '<input id="%1$s" name="%1$s" type="text" value="%2$s" size="80" />',
					$name,
				 	esc_attr( $options[$theme_option['name']] ) );
			break;
		case 'image':
			printf( '<input id="%1$s" name="%1$s" type="text" value="%2$s" size="80" />',
					$name,
				 	esc_attr( $options[$theme_option['name']] ) );
			break;
		case 'color':
			printf( '<input name="%1$s" type="text" value="%2$s" class="xin-color-field" />',
					$name,
				 	esc_attr( $options[$theme_option['name']] ) );
			break;
		case 'textarea':
			printf( '<textarea name="%1$s" cols="120" rows="%2$s">%3$s</textarea>',
					$name,
					$theme_option['row'], 
				 	esc_textarea( $options[ $theme_option['name'] ] ) );
			break;
		case 'number':
			if ( ! empty( $theme_option['fieldonly'] ) && ! empty( $theme_option['label'] ) )
				printf( '<label class="description">%s</label>', esc_attr( $theme_option['label'] ) );
			printf( '<input name="%1$s" type="text" value="%2$s" size="4" />',
					$name,
				 	esc_attr( $options[ $theme_option['name'] ] ) );
			if ( ! empty( $theme_option['desc'] ) )
				printf( '<label class="description">%s</label>', esc_attr( $theme_option['desc'] ) );
			echo '&nbsp;&nbsp;&nbsp;&nbsp;';
			break;
		case 'select':
			printf( '<select name="%1$s" >', $name );
			foreach ( $theme_option['values'] as $value ) {
				printf ('<option value="%1$s" %2$s>%3$s</option>',
					$value['key'],
					selected( $options[$theme_option['name']], $value['key'], false ),
					$value['label'] );
			}
			echo '</select>';
			break;
		case 'font':
			printf( '<select style="font-family:%2$s;font-size:14px;" name="%1$s" >',
				$name,
				$xinwp_fonts[ $options[ $theme_option['name'] ] ]['family'] );
			$old_font_type = '';
			foreach ( $theme_option['values'] as $value ) {
				if ( $value['type'] != $old_font_type ) {
					if ( $old_font_type != '' )
						echo '</optgroup>';
					printf( '<optgroup label="%1$s">', $value['type'] );					
				}
				printf( '<option style="font-family: %4$s;%5$s" value="%1$s" %2$s>%3$s</option>',
					$value['key'],
					selected( $options[ $theme_option['name'] ], $value['key'], false ),
					$value['label'],
					$value['family'],
					( empty( $value['url'] ) ? '' : 'color:blue;' ) );
				$old_font_type = $value['type'];	
			}
			echo '</optgroup>';
			echo '</select>';
			printf( '&nbsp;&nbsp;<span style="font-family:%2$s;font-size:16px;%3$s">%1$s</span>',
				'The quick brown fox jumps over the lazy dog.',
				$xinwp_fonts[$options[$theme_option['name']]]['family'],
				( empty($xinwp_fonts[ $options[ $theme_option['name'] ] ]['url'] ) ? '' : 'color:blue;' ) );
			break;
		case 'category':
			printf( '<select name="%1$s" >', $name );
			$selected_category = $options[ $theme_option['name'] ];
			printf( '<option value="0" %1$s>%2$s</option>',
					selected( $options[ $theme_option['name'] ], 0, false ),
					__('All Categories','xinwp') );

			foreach ( xinwp_categories() as $option ) {
				printf( '<option value="%1$s" %2$s>%3$s</option>',
					$option->term_id,
					selected( $selected_category, $option->term_id, false ),
					$option->name );
			}
			echo '</select>';
			break;
		case 'hidden':
			printf( '<input id="%1$s" name="%2$s" type="hidden" value="%3$s" />',
					$theme_option['name'],
					$name,
				 	esc_attr( $options[ $theme_option['name'] ] ) );
			break;
		default:
			echo __( 'Not Availavle Yet', 'xinwp' );			
	}
	if ( $theme_option['type'] != 'hidden' && empty( $theme_option['fieldonly'] ) ) {
		echo '</p>';
		if ( ! empty( $theme_option['helptext'] ) )
			printf( '<p><label class="helptext">%s</label></p>', $theme_option['helptext']);
		echo '</div><div class="clear"></div>';	
	}
}
