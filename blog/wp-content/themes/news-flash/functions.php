<?php
 
if ( ! isset( $content_width ) ) $content_width = 960;


require_once(dirname(__FILE__)."/admin/engine.php"); 
require_once(dirname(__FILE__)."/libs/nav-menu-walker.class.php"); 


 
//generate thumbnail 
function newsflash_thumb($post, $size='', $extra = array(), $echo = true){
    $size = $size?$size:'large';   
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $size); 
    $large_image_url = $large_image_url[0];    
    $large_image_url = $large_image_url?$large_image_url:'';        
    $class = isset($extra['class'])?$extra['class']:'';
    if($echo&&has_post_thumbnail($post->ID ))
    echo get_the_post_thumbnail($post->ID, $size, $extra );
    else if(!$echo&&has_post_thumbnail($post->ID ))
    return get_the_post_thumbnail($post->ID, $size, $extra );  
    else if($echo)
    echo "";
    else
    return "";
    
}
    

//post thumbnail function
function newsflash_post_thumb($size='', $echo = true, $extra = null){
    global $post;
    $size = $size?$size:'thumbnail';
    $class = isset($extra['class'])?$extra['class']:'';

    if($echo&&has_post_thumbnail($post->ID ))
    echo get_the_post_thumbnail($post->ID, $size, $extra );    
    else if(!$echo&&has_post_thumbnail($post->ID ))
    return get_the_post_thumbnail($post->ID, $size, $extra );  
    else if($echo)
    echo "";
    else
    return "";
}



//custom excerpt length
function newsflash_excerpt_length( $length ) {
    return 14;
}


//comments
function newsflash_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; 
   $GLOBALS['comment'] = $comment;
    
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        ?>
    <li class="post pingback">
        <p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?></p>
    <?php
        break;
        default :
   ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">         
            <div class="comment-body">
               <div id="comment-<?php comment_ID(); ?>" class="clearfix media">
                    <div class="author-box pull-left">
                        <?php echo str_replace("avatar-100","avatar-100 thumbnail", get_avatar($comment,100)); ?>
                         
                    </div> <!-- end .avatar-box -->
                    <div class="comment-wrap clearfix media-body">                        
                        <div class="comment-meta commentmetadata">
                        <?php printf('<span class="fn">%s</span>', get_comment_author_link()) ?>
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                            <?php
                                /* translators: 1: date, 2: time */
                                printf(  '%1$s at %2$s', get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( '(Edit)', ' ' );
                            ?>
                        </div><!-- .comment-meta .commentmetadata -->

                        <?php if ($comment->comment_approved == '0') : ?>
                            <em class="moderation">Your comment is awaiting moderation.</em>
                            <br />
                        <?php endif; ?>

                        <div class="comment-content"><?php comment_text() ?></div> <!-- end comment-content-->
                        <div class="reply-container"><?php comment_reply_link(array_merge( $args, array('reply_text' => 'Reply','depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
                    </div> <!-- end comment-wrap-->
                    <div class="comment-arrow"></div>
                </div> <!-- end comment-body-->
            </div> <!-- end comment-body-->
         
 
<?php 
        break;
    endswitch;    
 }
 
 
 
//Sidebars
function newsflash_widget_init(){
     
    register_sidebar(array(
      'name' => 'Header',
      'id' => 'header',
      'description' => 'Sidebar For Header.',
      'before_widget' => '<div class="header-widget">',
      'after_widget' => '</div>',
      'before_title' => '<h3><span>',
      'after_title' => '</span></h3>'
    ));
    register_sidebar(array(
      'name' => 'Single Post',
      'id' => 'single_post_sidebar',
      'description' => 'Sidebar For Single post.',
      'before_widget' => '<div class="widget">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title"><span>',
      'after_title' => '</span></h3>'
    ));

    register_sidebar(array(
      'name' => 'Page - Left Sidebar',
      'id' => 'page_left_sidebar',
      'description' => 'Page - Left Sidebar',
      'before_widget' => '<div class="widget">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title"><span>',
      'after_title' => '</span></h3>'
    ));

    register_sidebar(array(
      'name' => 'Page - Right Sidebar',
      'id' => 'page_right_sidebar',
      'description' => 'Page - Right Sidebar',
      'before_widget' => '<div class="widget">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widget-title"><span>',
      'after_title' => '</span></h3>'
    ));

     register_sidebar(array(
      'name' => 'Homepage Right',
      'id' => 'homepage_sidebar_right',
      'description' => 'Right Sidebar For Homepage.',
         'before_widget' => '<div class="widget">',
         'after_widget' => '</div>',
         'before_title' => '<h3 class="widget-title"><span>',
         'after_title' => '</span></h3>'
    ));

    register_sidebar(array(
        'name' => 'Homepage Ads: Left Top',
        'id' => 'homepage_ads_left_top',
        'description' => 'Left Sidebar Ads On Homepage.',
        'before_widget' => '<div class="ads">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ));
    register_sidebar(array(
        'name' => 'Homepage Ads: Left Bottom',
        'id' => 'homepage_ads_left_bottom',
        'description' => 'Left Sidebar Ads On Homepage.',
        'before_widget' => '<div class="ads">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ));

    register_sidebar(array(
        'name' => 'Homepage Ads: Right Top',
        'id' => 'homepage_ads_right_top',
        'description' => 'Right Sidebar Ads On Homepage.',
        'before_widget' => '<div class="ads">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ));

    register_sidebar(array(
        'name' => 'Homepage Ads: Right Bottom',
        'id' => 'homepage_ads_right_bottom',
        'description' => 'Right Sidebar Ads On Homepage.',
        'before_widget' => '<div class="ads">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ));

    register_sidebar(array(
        'name' => 'Homepage Left',
        'id' => 'homepage_sidebar_left',
        'description' => 'Left Sidebar For Homepage.',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>'
    ));

     register_sidebar(array(
      'name' => 'Archive Page',
      'id' => 'archive_page_sidebar',
      'description' => 'Sidebar For Archive Page.',
         'before_widget' => '<div class="widget">',
         'after_widget' => '</div>',
         'before_title' => '<h3 class="widget-title"><span>',
         'after_title' => '</span></h3>'
    ));    
       
    

 }
 
// wp_title filter
function newsflash_filter_wp_title( $old_title, $sep, $sep_location ){
    $ssep = ' ' . $sep . ' ';
    // find the type of index page this is
    if( is_category() ) $insert = $ssep . 'Category';
    elseif( is_tag() ) $insert = $ssep . 'Tag';
    elseif( is_author() ) $insert = $ssep . 'Author';
    elseif( is_year() || is_month() || is_day() ) $insert = $ssep . 'Archives';
    else $insert = NULL;
     
    // get the page number we're on (index)
    if( get_query_var( 'paged' ) )
    $num = $ssep . 'page ' . get_query_var( 'paged' );
     
    // get the page number we're on (multipage post)
    elseif( get_query_var( 'page' ) )
    $num = $ssep . 'page ' . get_query_var( 'page' );
     
    // else
    else $num = NULL;
    
    $site_description = get_bloginfo( 'description', 'display' );
    if ( is_home() && $site_description )
    $old_title .=  $ssep  . $site_description;
     
    // concoct and return new title
    return get_bloginfo( 'name' ) . $insert . $old_title . $num;
}
 
 
//Theme setup function 
function newsflash_setup(){
    register_nav_menus( array(
        'primary' => 'Top Menu',
        'footer' => 'Footer Menu'

    ) );
    
    
    add_theme_support( 'post-thumbnails' );
    //if(has_post_format('aside'))
    add_theme_support( 'post-formats', array( 'aside','image','chat', 'gallery','audio','video','quote','link' ) );
    add_post_type_support( 'post', 'post-formats' );
    add_theme_support("automatic-feed-links");
    add_theme_support("excerpt",array('post','page'));
    add_theme_support('custom-background');

    $default_header = array(
        'width'         => 1140,
        'height'        => 80,
        'flex-width'    => true,
        'flex-height'    => true,
        'header-text'            => false,
        'default-image' => get_template_directory_uri() . '/images/header.png',
        'uploads'       => true
    );

    add_theme_support( 'custom-header', $default_header);

    add_image_size( 'newsflash-post-thumb', 960, 99999, false );
    add_image_size( 'newsflash-slider-thumb', 600, 300, true );
    add_image_size( 'newsflash-archive-thumb', 150, 120, true );

 }

/**
 * @usage Enqueue javascripts & css
 */
 function newsflash_enqueue_scripts(){
    wp_enqueue_style('newsflash-main',get_stylesheet_uri());
    wp_register_style( 'news-flash-fonts', '//fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700|PT+Sans+Caption:400,700');
    wp_enqueue_style( 'news-flash-fonts' );
    wp_enqueue_style( 'news-flash-fontawesome',  get_template_directory_uri().'/css/font-awesome-4.2.0/css/font-awesome.min.css');
    wp_enqueue_style('newsflash-less',get_template_directory_uri().'/css/style.less');
    wp_enqueue_script('newsflash-less',get_template_directory_uri().'/js/less.js',array('jquery'));
    wp_enqueue_script('newsflash-bootstrap',get_template_directory_uri().'/bootstrap/js/bootstrap.min.js',array('jquery'));
    wp_enqueue_script('newsflash-site',get_template_directory_uri().'/js/site.js',array('jquery'));
    wp_enqueue_script( 'comment-reply' );
 }

function newsflash_enqueue_less_styles($tag, $handle) {
    global $wp_styles;
    $match_pattern = '/\.less$/U';
    if ( preg_match( $match_pattern, $wp_styles->registered[$handle]->src ) ) {
        $handle = $wp_styles->registered[$handle]->handle;
        $media = $wp_styles->registered[$handle]->args;
        $href = $wp_styles->registered[$handle]->src . '?ver=' . $wp_styles->registered[$handle]->ver;
        $rel = isset($wp_styles->registered[$handle]->extra['alt']) && $wp_styles->registered[$handle]->extra['alt'] ? 'alternate stylesheet' : 'stylesheet';
        $title = isset($wp_styles->registered[$handle]->extra['title']) ? "title='" . esc_attr( $wp_styles->registered[$handle]->extra['title'] ) . "'" : '';

        $tag = "<link rel='stylesheet' id='$handle' $title href='$href' type='text/less' media='$media' />";
    }
    return $tag;
}

function newsflash_less_var(){
    ?>
    <script type="text/javascript">
        less.modifyVars({
            '@color': '<?php echo newsflash_get_theme_opts('color_scheme','#3399ff'); ?>',
            '@menubgcolor': '<?php echo newsflash_get_theme_opts('menu_bg','#3399ff'); ?>'
        });
    </script>
    <?php
}

add_action( 'wp_enqueue_scripts', 'newsflash_enqueue_scripts');
add_filter( 'wp_title', 'newsflash_filter_wp_title', 10, 3 );
add_action( 'widgets_init', 'newsflash_widget_init' );
add_action( 'after_setup_theme', 'newsflash_setup' );
add_filter( 'style_loader_tag', 'newsflash_enqueue_less_styles', 5, 2);
add_action('wp_head','newsflash_less_var',99);
add_filter( 'excerpt_length', 'newsflash_excerpt_length', 999 );

