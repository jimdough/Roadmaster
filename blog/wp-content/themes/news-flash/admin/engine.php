<?php

global $newsflash_wf_data;


### SECTION
//Theme admin css & js
function newsflash_theme_admin_scripts($hook){
   // if($hook!='appearance_page_wpeden-themeopts') return;
    wp_enqueue_style('bootstrap-ui',get_template_directory_uri().'/admin/bootstrap/css/bootstrap.css');
    wp_enqueue_style('font-awesome',get_template_directory_uri().'/css/font-awesome-4.2.0/css/font-awesome.min.css');
    wp_enqueue_style('chosen-ui',get_template_directory_uri().'/admin/css/chosen.css');
    wp_enqueue_style('admincss',get_template_directory_uri().'/admin/css/base-admin-style.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js',get_template_directory_uri().'/admin/bootstrap/js/bootstrap.min.js',array('jquery'));
    wp_enqueue_script('chosen-js',get_template_directory_uri().'/admin/js/chosen.jquery.js',array('jquery'));
    wp_enqueue_script('blockui-js',get_template_directory_uri().'/admin/js/jquery.blockUI.js',array('jquery'));
    wp_enqueue_script('wpeden-js',get_template_directory_uri().'/admin/js/wpeden.js',array('jquery','chosen-js','blockui-js'));
    wp_enqueue_script("jquery-form", array('jquery'));
    wp_enqueue_media();
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
}

add_action( 'admin_print_scripts-appearance_page_wpeden-themeopts', 'newsflash_theme_admin_scripts');
//Theme admin css & js ends ^^
 
### SECTION
//Theme option menu function
function newsflash_theme_opt_menu(){                                                                                             /*Theme Option Menu*/
      add_theme_page( "WP Eden Theme Options", "Theme Options", 'edit_theme_options', 'wpeden-themeopts', 'newsflash_theme_options');
}

function newsflash_get_layout_type($default='wide'){
    echo newsflash_get_theme_opts('newsflash_layout_type',$default);
}

/**
* Generate theme option settings fields
* 
* @param mixed $data
*/

function newsflash_setting_field($data) {
    $data['placeholder'] = isset($data['placeholder'])?$data['placeholder']:'';
    switch($data['type']):
            case 'text':
                echo "<input type='text' name='$data[name]' class='input span12 {$data['class']}' value='$data[value]' placeholder='{$data['placeholder']}'  />";
                if(isset($data['description']))
                echo "<div class='note'>{$data['description']}</div>";
            break;
            case 'textarea':
                echo "<textarea name='$data[name]' class='input span12'>$data[value]</textarea>";
                if(isset($data['description']))
                echo "<div class='note'>{$data['description']}</div>";
            break;
            case 'callback':
                echo call_user_func($data['dom_callback'], $data['dom_callback_params']);
                if(isset($data['description']))
                echo "<div class='note'>{$data['description']}</div>";
            break;
            case 'heading':
                echo "<h3>".$data['label']."</h3>";
            break;
    endswitch;
}



 
global $wpede_data_fetched;
/**
* Get theme option value
* 
* @param mixed $index
* @param mixed $default
* @return mixed
*/
function newsflash_get_theme_opts($index = null, $default = null){
    global $newsflash_wf_data, $settings_sections, $wpede_data_fetched, $settings_fields;

     $newsflash_wf_data = get_option('newsflash_theme_settings',array());

    if(!$index)
    return $newsflash_wf_data;
    else  {
        if(isset($newsflash_wf_data[$index])&&is_array($newsflash_wf_data[$index]))   return $newsflash_wf_data[$index];
        if(!isset($newsflash_wf_data[$index])) return $default;
        $value = isset($newsflash_wf_data[$index])&&$newsflash_wf_data[$index]!=''?stripcslashes($newsflash_wf_data[$index]):$default;
        $value = newsflash_validate_singledata($value, $settings_fields[$index]['validate']);
        return $value;
    }
}

/**
* Generate theme option section heading
* 
* @param mixed $data
*/

function newsflash_subsection_heading($data){
    return "<h3>{$data}</h3>";
}



/**
* Theme Layout Selector ( wide / boxed)
* 
* @param mixed $params
*/
function newsflash_layout_type($params){
    $html = "<select  name='{$params['name']}' id='{$params['id']}'>";
    $html .= "<option value='wide'".selected($params['selected'],'wide',false).">Wide</option>";
    $html .= "<option value='boxed'".selected($params['selected'],'boxed',false).">Boxed</option>";
    $html .= "</select>";
    return $html;
}

/**
* Site Logo
* 
* @param mixed $params
*/
function newsflash_site_logo($params){
    extract($params);
    
    $html = "<div class='input-append'><input class='{$id}' type='text' name='{$name}' id='{$id}_image' value='{$selected}' /><button rel='#{$id}_image' class='btn btn-media-upload' type='button'><i class='fa fa-folder-open'></i></button></div>";
    $html .="<div style='clear:both'></div>";
    return $html;
}

function newsflash_get_site_logo(){
    $logourl = newsflash_get_theme_opts('site_logo');
    if($logourl) echo "<img src='{$logourl}' title='".get_bloginfo('sitename')."' alt='".get_bloginfo('sitename')."' />";
    else echo get_bloginfo('sitename'); 
}

/**
* Generate color picker
* 
* @param mixed $params
*/
function newsflash_color_picker($params){
    extract($params);
    $html = '<div class="input-prepend std-colorpicker"><span style="background-color:'.$value.'" class="add-on" id="'.$id.'_preview" >&nbsp;</span><input class="'.$id.' colorpicker input-small" type="text" name="'.$name.'" id="'.$id.'" size=10 placeholder="Color" value="'.$value.'" ></div>';
    return $html;
}


function newsflash_custom_css(){
    //return;
    $data = newsflash_get_theme_opts('page_title_bg');
    $ptcolor = newsflash_get_theme_opts('page_title_clr');
    $btnbgcolor = newsflash_get_theme_opts('button_bg');
    $btntxtcolor = newsflash_get_theme_opts('button_txt');
    $nvbg = newsflash_get_theme_opts('menu_bg');
    $ftbg = newsflash_get_theme_opts('footer_bg');
    $nvclr = newsflash_get_theme_opts('menu_txt');
    $ftclr = newsflash_get_theme_opts('footer_txt');
    $headertxtcolor = newsflash_get_theme_opts('header_txt_color');
    $typos = array('typo_h1','typo_h2','typo_h3','typo_h4','typo_regular');
    $fonts = get_option('newsflash_theme_settings',array());
    foreach($typos as $font){
        $font = newsflash_get_theme_opts($font);
        if($font['family']!='')
        $family[] = $font['family'];
    }


    $family[] = "Open+Sans:300,400,700";

    $family = array_filter(array_unique($family));
    
    $cssimport = "@import url(http://fonts.googleapis.com/css?family=".implode("|",$family).");";
    $header_image =  get_header_image();
    $header_image = $header_image?"background-image: url($header_image);":"";
    $nvbg = $nvbg!=''?"background: $nvbg !important;":''; /* rgba(".newsflash_hex2rgb($nvbg).",0.8) */
    $ftbg = $nvbg!=''?"background-color: $ftbg !important;":'';
    $nvcolor = $nvclr!=''?"color: $nvclr !important;":'';
    $ftcolor = $nvclr!=''?"color: $ftclr !important;":'';
    $bgcolor = $data['color']!=''?"background-color: $data[color];":'';
    $ptcolor = $ptcolor!=''?"color: $ptcolor !important;":'';
    $newsflash_custom_css_txt = newsflash_get_theme_opts('newsflash_custom_css_txt');
    $bgimage = $data['image']!=''?"background-image: url($data[image]); background-position: $data[position_h] $data[position_v]; background-repeat:  $data[repeat]; background-attachment: $data[attachment];":'';

    echo "<style>
    $cssimport
    $newsflash_custom_css_txt
    body,p, a.readmore, .widget *{".newsflash_font_css('typo_regular')."}
    .brand, h1, h1 a{".newsflash_font_css('typo_h1')."}
    h2, h2 a{".newsflash_font_css('typo_h2')."}
    h3, h3 a, .widget-title{".newsflash_font_css('typo_h3')."}
    h4, h4 a{".newsflash_font_css('typo_h4')."}
    .branding{ $header_image }
    .archive-top {  $bgcolor $bgimage }
    .archive-top h1.entry-title,.archive-top, .archive-top *{  $ptcolor }
     #topnav-area .dropdown-menu { text-shadow:none !important; $nvbg $nvcolor }
     #topnav-area .dropdown-menu *, #topnav-area .dropdown-menu a { $nvcolor }
    .dropdown-menu .active > a,.current-menu-item>a,.dropdown-menu a:hover,.dropdown-menu li > a:hover { background: rgba(0,0,0,0.2) !important; $nvcolor  }
    .footer {  $ftbg $ftcolor } 
    .widget-footer h3,.footer *,.footer a{  $ftcolor } 
    #menu-top-menu>li>a {  $nvcolor } 
    .btn-info, .btn-info:hover { background: $btnbgcolor; color: $btntxtcolor; }
    .aios-slider *{ color: $headertxtcolor !important; }
    .wpeden-bs-services:hover  .service.well:hover, .service.well:hover{ border-color: $btnbgcolor !important; }
    .entry-title,.entry-title a {".newsflash_font_css('newsflash_post_title')."}
    .meta,.meta a {".newsflash_font_css('typo_post_meta')."}
    .entry-content,.entry-content p {".newsflash_font_css('newsflash_post_content')."}
    .box.widget, .box.widget li, .box.widget p, .box.widget a {".newsflash_font_css('newsflash_widget_content')."; line-height:2; }
    .box.widget h3 {".newsflash_font_css('newsflash_widget_title')."}
    ul#menu-top-menu a {".newsflash_font_css('typo_top_menu')."}
    ul#menu-top-menu .dropdown-menu > li > a {".newsflash_font_css('typo_dropdown_menu')."}
    ul#menu-top-menu .dropdown-menu > li.current-menu-item > a,
    ul#menu-top-menu .dropdown-menu > li:hover > a {color:#ffffff !important;}

    </style>";
}




/**
*  Get font list  from fonts.ini 
*/            

function newsflash_get_fonts(){

    $font_array = array (
        'Arial' =>
            array (
                'family' => 'arial',
                'name' => 'Arial',
                'type' => 'regular',
            ),
        'Noto+Sans:400,400italic,700' =>
            array (
                'family' => '\'Noto Sans\', sans-serif',
                'name' => 'Noto Sans ',
                'type' => 'google',
            ),
        'Quicksand:400,300,700' =>
            array (
                'family' => '\'Quicksand\', sans-serif',
                'name' => 'Quicksand',
                'type' => 'google',
            ),
        'Oldenburg' =>
            array (
                'family' => '\'Oldenburg\', cursive',
                'name' => 'Oldenburg',
                'type' => 'google',
            ),
        'Habibi' =>
            array (
                'family' => '\'Habibi\', serif',
                'name' => 'Habibi',
                'type' => 'google',
            ),
        'Bad+Script' =>
            array (
                'family' => '\'Bad Script\', cursive',
                'name' => 'Bad Script',
                'type' => 'google',
            ),
        'Inika' =>
            array (
                'family' => '\'Inika\', serif',
                'name' => 'Inika',
                'type' => 'google',
            ),
        'Kavoon' =>
            array (
                'family' => '\'Kavoon\', cursive',
                'name' => 'Kavoon',
                'type' => 'google',
            ),
        'Snippet' =>
            array (
                'family' => '\'Snippet\', sans-serif',
                'name' => 'Snippet',
                'type' => 'google',
            ),
        'Acme' =>
            array (
                'family' => '\'Acme\', sans-serif',
                'name' => 'Acme',
                'type' => 'google',
            ),
        'Alegreya:400,400italic,700,700italic' =>
            array (
                'family' => '\'Alegreya\', serif',
                'name' => 'Alegreya',
                'type' => 'google',
            ),
        'Racing+Sans+One' =>
            array (
                'family' => '\'Racing Sans One\', cursive',
                'name' => 'Racing Sans One',
                'type' => 'google',
            ),
        'Inder' =>
            array (
                'family' => '\'Inder\', sans-serif',
                'name' => 'Inder',
                'type' => 'google',
            ),
        'Skranji:400,700' =>
            array (
                'family' => '\'Skranji\', cursive',
                'name' => 'Skranji',
                'type' => 'google',
            ),
        'Lemon' =>
            array (
                'family' => '\'Lemon\', cursive',
                'name' => 'Lemon',
                'type' => 'goole',
            ),
        'Wellfleet' =>
            array (
                'family' => '\'Wellfleet\', cursive',
                'name' => 'Wellfleet',
                'type' => 'google',
            ),
        'Armata' =>
            array (
                'family' => '\'Armata\', sans-serif',
                'name' => 'Armata',
                'type' => 'google',
            ),
        'Fugaz+One' =>
            array (
                'family' => '\'Fugaz One\', cursive',
                'name' => 'Fugaz One',
                'type' => 'google',
            ),
        'Roboto:400,300' =>
            array (
                'family' => '\'Roboto\', sans-serif',
                'name' => 'Roboto',
                'type' => 'google',
            ),
        'Roboto+Slab:400,300,700' =>
            array (
                'family' => '\'Roboto Slab\', sans-serif',
                'name' => 'Roboto Slab',
                'type' => 'google',
            ),
        'Tauri' =>
            array (
                'family' => '\'Tauri\', sans-serif',
                'name' => 'Tauri',
                'type' => 'google',
            ),
        'Telex' =>
            array (
                'family' => '\'Telex\', sans-serif',
                'name' => 'Telex',
                'type' => 'google',
            ),
        'Contrail+One' =>
            array (
                'family' => '\'Contrail One\', cursive',
                'name' => 'Contrail One',
                'type' => 'google',
            ),
        'Raleway:100,200,300,600,400' =>
            array (
                'family' => '\'Raleway\', sans-serif',
                'name' => 'Raleway',
                'type' => 'google',
            ),
        'Abel' =>
            array (
                'family' => '\'Abel\', sans-serif',
                'name' => 'Abel',
                'type' => 'google',
            ),
        'Sail' =>
            array (
                'family' => '\'Sail\', cursive',
                'name' => 'Sail',
                'type' => 'google',
            ),
        'Rokkitt:400,700' =>
            array (
                'family' => '\'Rokkitt\', serif',
                'name' => 'Rokkitt',
                'type' => 'google',
            ),
        'Cinzel:400,900' =>
            array (
                'family' => '\'Cinzel\', serif',
                'name' => 'Cinzel',
                'type' => 'google',
            ),
        'Kaushan+Script' =>
            array (
                'family' => '\'Kaushan Script\', cursive',
                'name' => 'Kaushan Script',
                'type' => 'google',
            ),
        'Viga' =>
            array (
                'family' => '\'Viga\', sans-serif',
                'name' => 'Viga',
                'type' => 'google',
            ),
        'Source+Sans+Pro:400,200,300,900,200italic,300italic,400italic,900italic,600' =>
            array (
                'family' => '\'Source Sans Pro\', sans-serif',
                'name' => 'Source Sans Pro',
                'type' => 'google',
            ),
        'Bubbler+One' =>
            array (
                'family' => '\'Bubbler One\', sans-serif',
                'name' => 'Bubbler One',
                'type' => 'google',
            ),
        'Julius+Sans+One' =>
            array (
                'family' => '\'Julius Sans One\', sans-serif',
                'name' => 'Julius Sans One',
                'type' => 'google',
            ),
        'Stint+Ultra+Expanded' =>
            array (
                'family' => '\'Stint Ultra Expanded\', cursive',
                'name' => 'Stint Ultra Expanded',
                'type' => 'google',
            ),
        'Graduate' =>
            array (
                'family' => '\'Graduate\', cursive',
                'name' => 'Graduate',
                'type' => 'google',
            ),
        'Ultra' =>
            array (
                'family' => '\'Ultra\', serif',
                'name' => 'Ultra',
                'type' => 'google',
            ),
        'Mate+SC' =>
            array (
                'family' => '\'Mate SC\', serif',
                'name' => 'Mate SC',
                'type' => 'google',
            ),
        'Josefin+Slab:400,300,300italic,400italic,700italic,700' =>
            array (
                'family' => '\'Josefin Slab\', serif',
                'name' => 'Josefin Slab',
                'type' => 'google',
            ),
        'Nothing+You+Could+Do' =>
            array (
                'family' => '\'Nothing You Could Do\', cursive',
                'name' => 'Nothing You Could Do',
                'type' => 'google',
            ),
        'Italianno' =>
            array (
                'family' => '\'Italianno\', cursive',
                'name' => 'Italianno',
                'type' => 'google',
            ),
        'Overlock+SC' =>
            array (
                'family' => '\'Overlock SC\', cursive',
                'name' => 'Overlock SC',
                'type' => 'google',
            ),
        'Kreon:400,300,700' =>
            array (
                'family' => '\'Kreon\', serif',
                'name' => 'Kreon',
                'type' => 'google',
            ),
        'Nixie+One' =>
            array (
                'family' => '\'Nixie One\', cursive',
                'name' => 'Nixie One',
                'type' => 'google',
            ),
        'Holtwood+One+SC' =>
            array (
                'family' => '\'Holtwood One SC\', serif',
                'name' => 'Holtwood One SC',
                'type' => 'google',
            ),
        'Kite+One' =>
            array (
                'family' => '\'Kite One\', sans-serif',
                'name' => 'Kite One',
                'type' => 'google',
            ),
        'Sanchez:400,400italic' =>
            array (
                'family' => '\'Sanchez\', serif',
                'name' => 'Sanchez',
                'type' => 'google',
            ),
        'Simonetta:400,900' =>
            array (
                'family' => '\'Simonetta\', cursive',
                'name' => 'Simonetta',
                'type' => 'google',
            ),
        'Shadows+Into+Light+Two' =>
            array (
                'family' => '\'Shadows Into Light Two\', cursive',
                'name' => 'Shadows Into Light Two',
                'type' => 'google',
            ),
        'Glass+Antiqua' =>
            array (
                'family' => '\'Glass Antiqua\', cursive',
                'name' => 'Glass Antiqua',
                'type' => 'google',
            ),
        'Ledger' =>
            array (
                'family' => '\'Ledger\', serif',
                'name' => 'Ledger',
                'type' => 'google',
            ),
        'Voces' =>
            array (
                'family' => '\'Voces\', cursive',
                'name' => 'Voces',
                'type' => 'google',
            ),
        'Doppio+One' =>
            array (
                'family' => '\'Doppio One\', sans-serif',
                'name' => 'Doppio One',
                'type' => 'google',
            ),
        'Sevillana' =>
            array (
                'family' => '\'Sevillana\', cursive',
                'name' => 'Sevillana',
                'type' => 'google',
            ),
        'Henny+Penny' =>
            array (
                'family' => '\'Henny Penny\', cursive',
                'name' => 'Henny Penny',
                'type' => 'google',
            ),
        'Krona+One' =>
            array (
                'family' => '\'Krona One\', cursive',
                'name' => 'Krona One',
                'type' => 'google',
            ),
        'Butterfly+Kids' =>
            array (
                'family' => '\'Butterfly Kids\', cursive',
                'name' => 'Butterfly Kids',
                'type' => 'google',
            ),
        'Open+Sans:300,400,700' =>
            array (
                'family' => '\'Open Sans\', sans-serif',
                'name' => 'Open Sans',
                'type' => 'google',
            ),
        'Open+Sans+Condensed:700,300' =>
            array (
                'family' => '\'Open Sans Condensed\', sans-serif',
                'name' => 'Open Sans Condensed',
                'type' => 'google',
            ),
        'Belgrano' =>
            array (
                'family' => '\'Belgrano\', serif',
                'name' => 'Belgrano',
                'type' => 'google',
            ),
        'Bree+Serif' =>
            array (
                'family' => '\'Bree Serif\', serif',
                'name' => 'Bree Serif',
                'type' => 'google',
            ),
        'Droid+Sans:400,700' =>
            array (
                'family' => '\'Droid Sans\', sans-serif',
                'name' => 'Droid Sans',
                'type' => 'google',
            ),
        'Overlock:400,400italic,700' =>
            array (
                'family' => '\'Overlock\', cursive',
                'name' => 'Overlock',
                'type' => 'google',
            ),
        'Dosis:600,400,300' =>
            array (
                'family' => '\'Dosis\', sans-serif',
                'name' => 'Dosis',
                'type' => 'google',
            ),
        'Enriqueta:400,700' =>
            array (
                'family' => '\'Enriqueta\', serif',
                'name' => 'Enriqueta',
                'type' => 'google',
            ),
        'Petrona' =>
            array (
                'family' => '\'Petrona\', serif',
                'name' => 'Petrona',
                'type' => 'google',
            ),
        'Bitter:400,700' =>
            array (
                'family' => '\'Bitter\', serif',
                'name' => 'Bitter',
                'type' => 'google',
            ),
        'Fenix' =>
            array (
                'family' => '\'Fenix\', serif',
                'name' => 'Fenix',
                'type' => 'google',
            ),
        'Arvo' =>
            array (
                'family' => '\'Arvo\', serif',
                'name' => 'Arvo',
                'type' => 'google',
            ),
        'PT+Serif+Caption' =>
            array (
                'family' => '\'PT Serif Caption\', serif',
                'name' => 'PT Serif Caption',
                'type' => 'google',
            ),
        'Rosarivo' =>
            array (
                'family' => '\'Rosarivo\', serif',
                'name' => 'Rosarivo',
                'type' => 'google',
            ),
        'Port+Lligat+Slab' =>
            array (
                'family' => '\'Port Lligat Slab\', serif',
                'name' => 'Port Lligat Slab',
                'type' => 'google',
            ),
    );

    return $font_array;    
}


  /**
  * Generate drop download list of webfonts 
  * 
  * @param mixed $params
  * @return mixed
  */


function newsflash_font_dropdown($params = array()){
        extract($params);
        $fonts = newsflash_get_fonts();
        $sel['family'] = isset($sel['family'])?$sel['family']:"";
        $sel['size'] = isset($sel['size'])?$sel['size']:"";
        $sel['weight'] = isset($sel['weight'])?$sel['weight']:"";
        $sel['pxpt'] = isset($sel['pxpt'])?$sel['pxpt']:"";
        $sel['color'] = isset($sel['color'])?$sel['color']:"";
        $sel['i'] = isset($sel['i'])?$sel['i']:"";
        $sel['u'] = isset($sel['u'])?$sel['u']:"";
        $html = '<div class="row-fluid"><div class="pull-left" style="min-width:180px"><select style="max-width:180px" id="ff_'.$id.'" class="typography_font_family" name="'.$name.'[family]"><option value="">Default</option>';
        foreach($fonts as $key => $font){
            if($sel['family']==$key) { $cff = $font['family']; }
            $html .= '<option value="'.$key.'" '. selected($sel['family'], $key, false).'>'.$font['name'].'</option>';
        }
       $html .= '</select>&nbsp;</div>';
       
       $html .= '<div class="pull-left" style="min-width:120px"><select style="width:70px" id="fs_'.$id.'" class="typography_font_size" name="'.$name.'[size]"><option value="">Size</option>';

       for($i=9;$i<=200;$i++){
             $html .= '<option value="'.$i.'" '.selected($sel['size'], $i, false).'>'.$i.'</option>';
         }
       $html .= '</select>&nbsp;';
       
       $html .= '<select  id="fss_'.$id.'" style="width:70px" class="typography_font_size" name="'.$name.'[pxpt]">';
       $html .= '<option value="pt">pt</option><option value="px"'.selected($sel['pxpt'],'px', false).'>px</option>';
       $html .= '</select></div>';
       
       $html .= '<div class="pull-left" style="max-width:110px;margin-right:10px"><select id="fw_'.$id.'"  style="width:80px" class="typography_font_weight" name="'.$name.'[weight]"><option value="">Weight</option>';
       for($i=300;$i<=700;$i+=100){
             $html .= '<option value="'.$i.'" '.selected($sel['weight'], $i, false).'>'.$i.'</option>';
         }
       $html .= '</select></div>'; 
      
       $selu = isset($sel['u']) && $sel['u']==1?'active':'';
       $seli = isset($sel['i']) && $sel['i']==1?'active':'';
       $fnts = isset($sel['i']) && $sel['i']==1?'font-style:italic':'';
       $gflink = $sel['family']?"http://fonts.googleapis.com/css?family={$sel['family']}":"";
       if(isset($cff))
       $ccss = "font-family:$cff;font-weight:{$sel['weight']};font-size:{$sel['size']}{$sel['pxpt']};$fnts";
        else $ccss = '';
       $html .= '<div class="pull-left" style="max-width:110px"><input size="12" style="width:90px !important"  type="text" class="colorpicker" id="'.$id.'_color" name="'.$name.'[color]" placeholder="Color" value="'.$sel['color'].'" /></div>';
       $html .= '<div class="span1" style="min-width:80px"><div class="btn-group" data-toggle="buttons-checkbox">
                 <button name="" type="button" class="btn '.$seli.' typocb" id="ib-'.$id.'">I</button>
                 <button type="button" class="btn '.$selu.' typocb" id="ub-'.$id.'">U</button>
                 </div><input id="ib-'.$id.'-x" type="hidden" value="'.$sel['i'].'" name="'.$name.'[i]" /><input id="ub-'.$id.'-x" type="hidden" value="'.$sel['u'].'" name="'.$name.'[u]" /></div></div>';
       $html .= '<div class="row-fluid"><div class="span12">
                 <link id="lnk_'.$id.'" href="'.$gflink.'" rel="stylesheet" type="text/css">
                 <div id="ptxt_'.$id.'" contenteditable="true" type="text" style="'.$ccss.'">Font Preview Text</div></div></div>
                 <script>
                        jQuery("#ff_'.$id.'").change(function(){ jQuery("#lnk_'.$id.'").attr("href","http://fonts.googleapis.com/css?family="+this.value); jQuery("#ptxt_'.$id.'").css("font-family",jQuery("#ff_'.$id.' option:selected").text()); });
                        jQuery("#fw_'.$id.'").change(function(){ jQuery("#ptxt_'.$id.'").css("font-weight",jQuery(this).val()); });
                        jQuery("#fs_'.$id.'").change(function(){ jQuery("#ptxt_'.$id.'").css("font-size",jQuery(this).val()+jQuery("#fss_'.$id.'").val()); });
                        jQuery("#fss_'.$id.'").change(function(){ jQuery("#ptxt_'.$id.'").css("font-size",jQuery("#fs_'.$id.'").val()+jQuery(this).val()); });
                        jQuery("#'.$id.'_color").change(function(){ jQuery("#ptxt_'.$id.'").css("color",jQuery(this).val()); });
                 </script>';
       return $html;
}

function newsflash_font_css($oname){
    $font = newsflash_get_theme_opts($oname);
    if(!$font) return;
    $fonts = newsflash_get_fonts();
    extract($font);
    $italic = isset($i) && $i==1?'font-style:italic;':'';
    $underline = isset($u) &&  $u==1?'text-decoration:underline;':'';
    $font_family = isset($family) && $family!="" && $fonts[$family]['family']!=''?"font-family:{$fonts[$family]['family']};":"";
    $font_size = isset($size) &&  $size!=''?"font-size:{$size}{$pxpt} !important;":"";
    $text_color = isset($color) &&  $color?"color:{$color} !important;":"";
    $font_weight = isset($weight) &&  $weight?"font-weight:{$weight};":"";
    $css = "{$font_family}{$font_size}{$text_color}{$font_weight}{$italic}{$underline}" ;
    return $css;
}



//FAV ICON
function newsflash_favicon(){
    $icon = newsflash_get_theme_opts('favicon');
    if($icon!=""){
    ?>
    <link rel="shortcut icon" type="image/png" href="<?php echo $icon; ?>" />
    <?php
    }
}


//CLEAR THEME OPTS
function newsflash_reset_theme_opts(){
    if ( isset($_REQUEST['_wtodr_nonce'])&&wp_verify_nonce( $_REQUEST['_wtodr_nonce'], 'wpeden-reset-data' )) {
        delete_option('newsflash_theme_settings');
        header('location: '.$_SERVER['HTTP_REFERER']);
        die();
    }
}


function newsflash_custom_css_option($params){
    ?>
<textarea style="max-width: 100%;min-width: 100%;height: 600px;font-family: 'courier new'" name="<?php echo $params['name']; ?>" id="<?php echo $params['id']; ?>"><?php echo esc_html($params['value']); ?></textarea>
    <script>jQuery('#newsflash_custom_css th').hide();</script>
<?php
}



/**
* Include options fields file
*/
require_once(dirname(__FILE__).'/option-fields.php');

/**
* Setup theme
* 
*/

function newsflash_setup_theme_options(){
    global $settings_fields, $settings_sections;

    $settings_sections = apply_filters("themeopt_section",$settings_sections);
    $settings_fields = apply_filters("themeopt_fields",$settings_fields);


        register_setting('newsflash_theme_settings', 'newsflash_theme_settings', 'newsflash_validate_optdata');

        foreach($settings_fields as $id=>$field){
        if($field['type']=='heading')
        add_settings_field($id, '', 'newsflash_setting_field', 'wpeden-themeopts', $field['section'], $field);
        else
        add_settings_field($id, $field['label'], 'newsflash_setting_field', 'wpeden-themeopts', $field['section'], $field);
    }

}

add_action('admin_init','newsflash_setup_theme_options');

/**
* Validate theme option data
* 
* @param mixed $data
*/
function newsflash_validate_optdata($data){
    global $settings_fields;

    $settings_fields = apply_filters("themeopt_fields",$settings_fields);
    $error = array();     
    foreach($settings_fields as $id=>$field){                   
         if(!isset($data[$id])) continue;
         if(!isset($field['validate'])) $field['validate'] = 'str';
         switch($field['validate']){
             case 'int':
                $data[$id] = intval($data[$id]);
             break;
             case 'double':
                $data[$id] = doubleval($data[$id]);
             break;
             case 'str':
                $data[$id] = esc_attr(strval($data[$id]));
             break;
             case 'email':
                $data[$id] = is_email($data[$id])?$data[$id]:'';
                $error[$id] = __('Invalid Email Address','wpeden');
             break;
             case 'array':
                $data[$id] = $data[$id]; 
             break;
             case "callback":
                 $data[$id] = call_user_func($field['validate_callback'],$data[$id]);
             break;
         }
    }
    if($error) return $data['__error__'] = $error;
    //if($_POST) {print_r($data); die();  }
    return $data;
}

/**
* Validate theme option single data
*
* @param mixed $data
*/
function newsflash_validate_singledata($data, $type = 'str'){

         switch($type){
             case 'int':
                $data = intval($data);
             break;
             case 'double':
                $data = doubleval($data);
             break;
             case 'str':
                $data = esc_attr(strval($data));
             break;
             case 'email':
                $data = is_email($data)?$data:'';
             break;
             case 'url':
                $data = esc_url($data);
             break;
             default:
                 $data = esc_attr($data);
             break;

         }

    return $data;
}
    
/**
* Generate theme admin options
*     
*/
function newsflash_theme_options(){
global $settings_sections, $section, $settings_icons;
$settings_sections = apply_filters("themeopt_section",$settings_sections);
    $tbc = 0;
    /*Theme Option Function*/
?>
    <div class="wrap wpeden-theme-options w3eden">
            <div class="container-fluid">
                <div class="row-fluid theader">
                    <div class="span12">

                        <h2 class="thm_heading"><img src="<?php echo get_template_directory_uri(); ?>/admin/images/logo-min.png" /></h2>
                    </div>

                </div>
                <div class="row-fluid">
                    <div class="span12">

                        <form id="theme-admin-form-"  class="form-horizontal wpeden-theme-opt-form" action="options.php" method="post">
                            <?php
                            settings_fields( 'newsflash_theme_settings' );
                            ?>
                        <div class=" tabbable tabs-left">
                        <!-- Theme Option Sections -->
                        <ul class="nav nav-tabs smn">

                            <?php foreach($settings_sections as $section_id=>$section_name){ $settings_sections_tmp[$section_id] = $section_name; ?>
                            <li class="<?php echo $section_id; ?> <?php echo $section==$section_id?'active':''; ?>"><a href="#<?php echo $section_id; ?>" id="tab_<?php echo ++$tbc;?>" data-toggle='tab'><i class="icon-section fa <?php echo $settings_icons[$section_id]?$settings_icons[$section_id]:'icon-cog' ?>"></i> <?php echo $section_name; ?></a></li>
                            <?php } ?>

                        </ul>
                        <!-- Theme Option Sections Ends -->


                        <!-- Theme Option Fields for section # -->
                        <div class="tab-content">

                          <?php foreach($settings_sections_tmp as $section_id=>$section_name){ ?>
                            <div class="tab-pane <?php echo $section_id==$section?'active':''; ?>" id="<?php echo $section_id; ?>">

                                <div class="xbtn pull-right">
                                <button type="submit" class="btn btn-submit btn-large" id="<?php echo $section_id; ?>-submit" name="form_submit"><i class="fa fa-save"></i> Save Changes</button>
                                </div>
                                <div class="xbtn pull-right" style="margin-right: 195px">
                                <button type="button" onclick="if(confirm('Are you sure?')) location.href='themes.php?_wtodr_nonce=<?php echo wp_create_nonce('wpeden-reset-data'); ?>';" class="btn btn-submit btn-large" id="<?php echo $section_id; ?>-submit" name="form_submit"><i class="fa fa-refresh"></i> Reset to Default</button>
                                </div>
                                <table class="table">
                                <?php 

                                  do_settings_fields( 'wpeden-themeopts',$section_id );
                                ?></table>

                                         

                            <div class="clear"></div>


                            </div>
                           <?php } ?>

              
                        </div> 
                        <!-- Theme Option Fields for section # Ends -->
                        </div></form>
                    </div>
                <script>jQuery('.ttip').tooltip({placement:'right',animation:false, container:'ul.nav-pills'}); jQuery('.nav-pills a').click(function(e){e.preventDefault(); jQuery('.nav-tabs li').slideUp();jQuery(jQuery(this).attr('rel')).slideDown(); });</script>
</div>
</div>
 
</div>
<?php
        
}

add_action('admin_menu', 'newsflash_theme_opt_menu');
add_action('wp_head', 'newsflash_custom_css');
add_action('wp_head', 'newsflash_favicon');
add_action('init', 'newsflash_reset_theme_opts');
