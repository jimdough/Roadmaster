<?php

add_action( 'after_setup_theme', 'kopa_backend_after_setup_theme' );
function kopa_backend_after_setup_theme() {
    if ( is_admin() ) {
        add_action('admin_enqueue_scripts', 'kopa_admin_register_assets', 5);
    }
}


/**
 * @package Kopa
 * @subpackage Core
 * @author Kopatheme
 * @since 1.0.0
 */
function kopa_admin_register_assets() {
    wp_register_style('kopa-widget-css', get_template_directory_uri() . "/library/css/kopa.widget.css");
    wp_enqueue_style( 'kopa-widget-css');
    wp_register_script('kopa-widget-js', get_template_directory_uri() . "/library/js/kopa.widget.js", array('jquery'), NULL, TRUE);
    wp_enqueue_script('kopa-widget-js');
}

if ( ! function_exists('kopa_build_query')) {

    /**
     * @package Kopa
     * @subpackage Revant
     * @author: kopatheme
     * @description: build query args
     */
    function kopa_build_query($instance, $args_extra = array()) {
        $query_args = array(
            'post_type' => 'post',
            'number_of_article' => (int) $instance['number_of_article'],
            'post_status' => array('publish'),
            'ignore_sticky_posts' => true
        );

        if( isset($instance['categories']) && count($instance['categories']) == 1 && $instance['categories'][0] == '' ){
            $instance['categories'] = array();
        }

        if( isset($instance['tags']) && count($instance['tags']) == 1 && $instance['tags'][0] == '' ){
            $instance['tags'] = array();
        }

        if ( isset($instance['categories']) && $instance['categories'] ) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'category',
                'field'    => 'id',
                'terms'    => $instance['categories'],
            );
        }

       if ( isset($instance['tags']) && $instance['tags'] ) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'post_tag',
                'field'    => 'id',
                'terms'    => $instance['tags'],
            );
        }

        if ( isset($instance['post_format']) && !empty($instance['post_format']) ) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array( $instance['post_format'] )
            );
        }


        if ( isset( $query_args['tax_query'] ) && count( $query_args['tax_query'] ) > 1 ) {
            $query_args['tax_query']['relation'] = $instance['relation'];
        }


        if (isset($instance['orderby'])) {
            switch ($instance['orderby']) {
                case 'comment_count':
                    $args['orderby'] = 'comment_count';
                    break;
                case 'rand':
                    $args['orderby'] = 'rand';
                    break;
                case 'ID':
                    $args['orderby'] = 'ID';
                    break;
                case 'title':
                    $args['orderby'] = 'title';
                    break;
                default:
                    $args['orderby'] = 'date';
                    break;
            }
        }else{
            $query_args['orderby'] = 'date';
        }
        if (isset($instance['order'])) {
            $query_args['order'] = $instance['order'];
        }

        if ( isset($instance['paged']) ){
            $query_args['paged'] = $instance['paged'];
        }

        if ( isset($instance['author']) ) {
            $query_args['author'] = $instance['author'];
        }


        global $wp_version;

        if (version_compare($wp_version, '3.7', '>=')) {
            if (isset($instance['kopa_timestamp']) && !empty($instance['kopa_timestamp'])) {
                $timestamp = $instance['kopa_timestamp'];
                $y = date('Y', strtotime($timestamp));
                $m = date('m', strtotime($timestamp));
                $d = date('d', strtotime($timestamp));

                $query_args['date_query'] = array(
                    array(
                        'after' => array(
                            'year' => (int) $y,
                            'month' => (int) $m,
                            'day' => (int) $d
                        )
                    )
                );
            }
        }

        if (!empty($args_extra)) {
            return array_merge($query_args, $args_extra);
        } else {
            return $query_args;
        }

    }

}
