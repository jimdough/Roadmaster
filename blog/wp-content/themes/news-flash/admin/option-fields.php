<?php

$section = isset($_GET['section'])?$_GET['section']:'newsflash_general_settings';


$settings_icons = array(
    'newsflash_general_settings' => 'fa-cogs',
    'newsflash_menu_settings' => 'fa-cog',  //will available from next update
    'newsflash_typo_settings' => 'fa-font',  //will available from next update
    'newsflash_custom_css' => 'fa-cog',



);

$settings_sections = array(
            'newsflash_general_settings' => 'General',
            'newsflash_menu_settings' => 'Menu Settings',
            'newsflash_typo_settings' => 'Typography',
            'newsflash_custom_css'       =>  'Custom CSS',

);         
$settings_fields = array(

/***  General Settings *******************/

            'site_logo' => array('id' => 'site_logo',
                                'section'=>'newsflash_general_settings',
                                'label'=>'Logo',
                                'name' => 'newsflash_theme_settings[site_logo]',
                                'type' => 'callback',
                                'value' => newsflash_get_theme_opts('site_logo'),
                                'validate' => 'str',
                                'dom_callback'=> 'newsflash_site_logo',
                                'dom_callback_params' => array('name'=>'newsflash_theme_settings[site_logo]','id'=>'site_logo','selected'=>newsflash_get_theme_opts('site_logo'))
                                ),
            
            'favicon' => array('id' => 'favicon',
                                'section'=>'newsflash_general_settings',
                                'label'=>'Fav Icon',
                                'name' => 'newsflash_theme_settings[favicon]',
                                'type' => 'callback',
                                'value' => newsflash_get_theme_opts('favicon'),
                                'validate' => 'str',
                                'dom_callback'=> 'newsflash_site_logo',
                                'dom_callback_params' => array('name'=>'newsflash_theme_settings[favicon]','id'=>'favicon','selected'=>newsflash_get_theme_opts('favicon'))
                                ),

            'color_scheme' => array('id' => 'color_scheme',
                                'section'=>'newsflash_general_settings',
                                'label'=>'Color Scheme',
                                'name' => 'newsflash_theme_settings[color_scheme]',
                                'type' => 'text',
                                'class' =>'colorpicker span2',
                                'value' => newsflash_get_theme_opts('color_scheme'),
                                'validate' => 'str'
            ),

    'menu_bg' => array('id' => 'menu_bg',
        'section'=>'newsflash_menu_settings',
        'label'=>'Top Menu Background',
        'name' => 'newsflash_theme_settings[menu_bg]',
        'type' => 'text',
        'class' =>'colorpicker span2',
        'value' => newsflash_get_theme_opts('menu_bg'),
        'validate' => 'str'
    ),



 

                                
/***  Custom CSS Settings *******************/

            'newsflash_custom_css_txt' => array('id' => 'newsflash_custom_css_opt',
                                'section'=>'newsflash_custom_css',
                                'label'=>'Custom CSS',
                                'name' => 'newsflash_theme_settings[newsflash_custom_css_txt]',
                                'type' => 'callback',
                                'validate' => 'array',
                                'dom_callback'=> 'newsflash_custom_css_option',
                                'dom_callback_params' => array('name'=>'newsflash_theme_settings[newsflash_custom_css_txt]','id'=>'newsflash_custom_css_opt','value'=>newsflash_get_theme_opts('newsflash_custom_css_txt'))
                                ),


/***  Typography Settings *******************/

            'typo_generic' => array('id' => 'typo_generic',
                                'section'=>'newsflash_typo_settings',
                                'label'=>'Generic Fonts',
                                'name' => 'typo_generic',
                                'type' => 'heading'
                                ),
            'typo_h1' => array('id' => 'typo_h1',
                                'section'=>'newsflash_typo_settings',
                                'label'=>'H1 Font',
                                'name' => 'newsflash_theme_settings[typo_h1]',
                                'type' => 'callback',
                                'validate' => 'array',
                                'dom_callback'=> 'newsflash_font_dropdown',
                                'dom_callback_params' => array('name'=>'newsflash_theme_settings[typo_h1]','id'=>'typo_h1','sel'=>newsflash_get_theme_opts('typo_h1'))
                                ),

            'typo_h2' => array('id' => 'typo_h2',
                                'section'=>'newsflash_typo_settings',
                                'label'=>'H2 Font',
                                'name' => 'newsflash_theme_settings[typo_h2]',
                                'type' => 'callback',
                                'validate' => 'array',
                                'dom_callback'=> 'newsflash_font_dropdown',
                                'dom_callback_params' => array('name'=>'newsflash_theme_settings[typo_h2]','id'=>'typo_h2','sel'=>newsflash_get_theme_opts('typo_h2'))
                                ),

            'typo_h3' => array('id' => 'typo_h3',
                                'section'=>'newsflash_typo_settings',
                                'label'=>'H3 Font',
                                'name' => 'newsflash_theme_settings[typo_h3]',
                                'type' => 'callback',
                                'validate' => 'array',
                                'dom_callback'=> 'newsflash_font_dropdown',
                                'dom_callback_params' => array('name'=>'newsflash_theme_settings[typo_h3]','id'=>'typo_h3','sel'=>newsflash_get_theme_opts('typo_h3'))
                                ),

            'typo_h4' => array('id' => 'typo_h4',
                                'section'=>'newsflash_typo_settings',
                                'label'=>'H4 Font',
                                'name' => 'newsflash_theme_settings[typo_h4]',
                                'type' => 'callback',
                                'validate' => 'array',
                                'dom_callback'=> 'newsflash_font_dropdown',
                                'dom_callback_params' => array('name'=>'newsflash_theme_settings[typo_h4]','id'=>'typo_h4','sel'=>newsflash_get_theme_opts('typo_h4'))
                                ),

            'typo_regular' => array('id' => 'typo_regular',
                                'section'=>'newsflash_typo_settings',
                                'label'=>'Regular Text Font',
                                'name' => 'newsflash_theme_settings[typo_regular]',
                                'type' => 'callback',
                                'validate' => 'array',
                                'dom_callback'=> 'newsflash_font_dropdown',
                                'dom_callback_params' => array('name'=>'newsflash_theme_settings[typo_regular]','id'=>'typo_regular','sel'=>newsflash_get_theme_opts('typo_regular'))
                                ),






);


