<?php

class WDWT_homepage_page_class{
	
	public $options;
	
	function __construct(){
		$this->shorthomepage = "";
		$frst_post_wordpress=array();
		$post_in_array=get_posts( array('posts_per_page' => 1));
		if($post_in_array)
			$frst_post_wordpress=array($post_in_array[0]->ID);
		else
			$frst_post_wordpress=array();
		unset($post_in_array);	
		
		$this->options = array(
		
			
			
			"hide_top_posts" => array(
				"name" => "hide_top_posts",
				"title" => __("Top Posts","news-magazine"),
				'type' => 'checkbox_open',
				'show' => array("top_post_cat_name","top_post_categories","top_post_count"),
				'hide' => array(),
				"description" => __("Display top posts on the homepage.","news-magazine"),
				'section' => 'homepage',
				'tab' => 'homepage',
				'default' => true,
				'customizer' => array()				
			),
			
			"top_post_cat_name" => array(
				"name" => "top_post_cat_name",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Name of top post category", "news-magazine"),
				'section' => 'homepage',
				'tab' => 'homepage',
				'default' => '',
				'customizer' => array()	
			),
			"top_post_count" => array(
				"name" => "top_post_count",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Count of top posts", "news-magazine"),
				'section' => 'homepage',
				'tab' => 'homepage',
				'default' => '2',
				'customizer' => array()	
			),
			
			"top_post_categories" => array(
				"name" => "top_post_categories",
				"title" => "",
				'type' => 'select',
				'multiple' => "true",
				"valid_options" => $this->get_categories(),
				"description" => __("Show posts only from these categories.","news-magazine"),
				'section' => 'homepage',
				'tab' => 'homepage',
				'default' => array(''),
				'customizer' => array()	
			),
			
			"hide_content_posts" => array(
				"name" => "hide_content_posts",
				"title" => __("Content Posts", "news-magazine"),
				'type' => 'checkbox_open',
				'show' => array("content_post_cat_name","content_post_categories"),
				'hide' => array(),
				"description" => __("Check the box to select the categories from which top posts will be displayed.", "news-magazine"),
				'section' => 'homepage',
				'tab' => 'homepage',
				'default' => true,
				'customizer' => array()
			),
			
			"content_post_cat_name" => array(
				"name" => "content_post_cat_name",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Name of content posts category", "news-magazine"),
				'section' => 'homepage',
				'tab' => 'homepage',
				'default' => '',
				'customizer' => array()
			),
			
			"content_post_categories" => array(
				"name" => "content_post_categories",
				"title" => "",
				'type' => 'select',
				'multiple' => "true",
				"valid_options" => $this->get_categories(),
				"description" => __("Show posts only from these categories.", "news-magazine"),
				'section' => 'homepage',
				'tab' => 'homepage',
				'default' => array(''),
				'customizer' => array()
			),
			
			"hide_categories_vertical_tabs" => array(
				"name" => "hide_categories_vertical_tabs",
				"title" => __("Vertical tabs", "news-magazine"),
				'type' => 'checkbox_open',
				'show' => array("categories_vertical_tabs_name", "categories_vertical_tabs_count", "categories_vertical_tabs_categories"),
				'hide' => array(),
				"description" => __("Check the box to display the vertical tabs from the homepage.", "news-magazine"),
				'section' => 'homepage',
				'tab' => 'homepage',
				'default' => true,
				'customizer' => array()				
			),

			"categories_vertical_tabs_name" => array(
				"name" => "categories_vertical_tabs_name",
				"title" => "",
				'type' => 'text',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Name of vertical tabs category", "news-magazine"),
				'section' => 'homepage',
				'tab' => 'homepage',
				'default' => '',
				'customizer' => array()	
			),
			
			"categories_vertical_tabs_count" => array(
				"name" => "categories_vertical_tabs_count",
				"title" => "",
				'type' => 'text',
				'input_size' => 2,
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Count of vertical tabs posts", "news-magazine"),
				'section' => 'homepage',
				'tab' => 'homepage',
				'default' => '5',
				'customizer' => array()	
			),

			"categories_vertical_tabs_categories" => array(
				"name" => "categories_vertical_tabs_categories",
				"title" => "",
				'type' => 'select',
				'multiple' => "true",
				"valid_options" => $this->get_categories(),
				"description" => __("Show posts only from these categories","news-magazine"),
				'section' => 'homepage',
				'tab' => 'homepage',
				'default' => array(''),
				'customizer' => array()	
			),
		);
	}


	private function get_posts(){
		$args= array(
				'posts_per_page'   => 3000,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				 );

		$posts_array_custom=array();
		$posts_array = get_posts( $args );

		foreach($posts_array as $post){
			$key = $post->ID;
		  $posts_array_custom[$key] = $post->post_title;
		}
		return $posts_array_custom;
	}

	private function get_categories($custom = false){
		$args= array(
				'hide_empty' => 0,
				'orderby' => 'name',
				'order' => 'ASC',
			);
		
		$categories_array_custom=array();
		$categories_array = get_categories( $args );
    if($custom===true){
			$categories_array_custom["random"] = __("Random Posts","news-magazine");
			$categories_array_custom["popular"] = __("Popular Posts","news-magazine");
			$categories_array_custom["recent"] = __("Recent Posts","news-magazine");
		}
		foreach($categories_array as $category){
		  $categories_array_custom[$category->term_id] = $category->name;
		}
		return $categories_array_custom;
	}

	private function get_categories_ids(){
		$args= array(
				'hide_empty' => 0,
				'orderby' => 'name',
				'order' => 'ASC',
			);
		
		$categories_array_custom=array();
		$categories_array = get_categories( $args );
		foreach($categories_array as $category){
		  array_push($categories_array_custom,$category->term_id);
		}
		return $categories_array_custom;
	}

	

}
 