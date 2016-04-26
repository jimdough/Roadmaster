<?php
add_action('tgmpa_register', 'fastnew_register_required_plugins');

function fastnew_register_required_plugins() {
    $plugins = array(
        array(
            'name' => 'Kopa Framework',
            'slug' => 'kopatheme',
            'source' => 'https://downloads.wordpress.org/plugin/kopatheme.zip',
            'required' => false,
            'version' => '1.0.10',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => ''
        ),
        array(
            'name'               => 'Fastnews Light Toolkit',
            'slug'               => 'fastnews-light-toolkit',
            'source'             => 'https://wordpress.org/plugins/fastnews-light-toolkit/',
            'required'           => false,
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => ''
        ),
    );
    

    $config = array(        
        'has_notices'  => true,
        'is_automatic' => false
    );
    
    tgmpa($plugins, $config);    
}
