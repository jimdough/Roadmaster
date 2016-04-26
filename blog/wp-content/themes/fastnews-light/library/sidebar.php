<?php

add_filter( 'kopa_sidebar_default', 'kopa_extra_sidebar_manager_settings' );

function kopa_extra_sidebar_manager_settings( $options ) {

    $options['sidebar_1'] = array(
        'name' => esc_attr__('Sidebar 1', 'fastnews-light'),
        'description' => '',
    );
    $options['sidebar_2'] = array(
        'name' => esc_attr__('Sidebar 2', 'fastnews-light'),
        'description' => ''
    );
    $options['sidebar_3'] = array(
        'name' => esc_attr__('Sidebar 3', 'fastnews-light'),
        'description' => ''
    );
    $options['sidebar_4'] = array(
        'name' => esc_attr__('Sidebar 4', 'fastnews-light'),
        'description' => ''
    );
    $options['sidebar_5'] = array(
        'name' => esc_attr__('Sidebar 5', 'fastnews-light'),
        'description' => ''
    );
    $options['sidebar_6'] = array(
        'name' => esc_attr__('Sidebar 6', 'fastnews-light'),
        'description' => ''
    );
    $options['sidebar_7'] = array(
        'name' => esc_attr__('Sidebar 7', 'fastnews-light'),
        'description' => ''
    );
    $options['sidebar_8'] = array(
        'name' => esc_attr__('Sidebar 8', 'fastnews-light'),
        'description' => ''
    );
    $options['sidebar_9'] = array(
        'name' => esc_attr__('Sidebar 9', 'fastnews-light'),
        'description' => ''
    );
    $options['sidebar_10'] = array(
        'name' => esc_attr__('Sidebar 10', 'fastnews-light'),
        'description' => ''
    );
    $options['sidebar_11'] = array(
        'name' => esc_attr__('Sidebar 11', 'fastnews-light'),
        'description' => ''
    );
    $options['sidebar_12'] = array(
        'name' => esc_attr__('Sidebar 12', 'fastnews-light'),
        'description' => ''
    );
    $options['sidebar_13'] = array(
        'name' => esc_attr__('Sidebar 13', 'fastnews-light'),
        'description' => ''
    );
    $options['sidebar_14'] = array(
        'name' => esc_attr__('Sidebar 14', 'fastnews-light'),
        'description' => ''
    );
    $options['sidebar_15'] = array(
        'name' => esc_attr__('Sidebar 15', 'fastnews-light'),
        'description' => ''
    );
    $options['sidebar_17'] = array(
        'name' => esc_attr__('Sidebar 17', 'fastnews-light'),
        'description' => ''
    );
    return $options;
}

add_filter( 'kopa_sidebar_default_attributes', 'kopa_edit_common_attributes' );

function kopa_edit_common_attributes( $options ) {
    $options['before_widget'] = '<div id="%1$s" class="widget %2$s">';
    $options['after_widget'] = '</div>';
    $options['before_title'] = '<h3 class="widget-title">';
    $options['after_title'] = '</h3>';

    return $options;
}

add_action('widgets_init', 'revant_register_fixed_sidebar');

function revant_register_fixed_sidebar(){
	$wrap = kopa_edit_common_attributes(array());

	$fixed_sidebars  = array(
        'sidebar_16' => array(
            'name' => esc_attr__('Sidebar 16 ( right sidebar)', 'fastnews-light'),
            'description' => ''
        ),
        'sidebar_ads'    => array(
            'name' => esc_attr__('Sidebar advertisement', 'fastnews-light'),
            'description' => esc_attr__(' your Adsense, BSA or other ad code here to show ads on top banner.', 'fastnews-light')
        )
	);

	foreach($fixed_sidebars as $id => $name){
		$args         = $wrap;
		$args['id']   = $id;
		$args['name'] = $name['name'];
		$args['description'] = $name['description'];

		register_sidebar($args);
	}
}

