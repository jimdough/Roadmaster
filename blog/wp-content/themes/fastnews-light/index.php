<?php
$kopa_setting = fastnews_get_template_setting();
if( $kopa_setting ){
    get_template_part( 'library/templates/' . $kopa_setting['layout_id'] );
}else{
    get_template_part('library/templates/archive');
}