/**
 * http://kopatheme.com
 * Copyright (c) 2014 Kopatheme
 *
 * Licensed under the GPL license:
 *  http://www.gnu.org/licenses/gpl.html
 **/
jQuery(document).ready(function($) {
    if (jQuery('#widget-list').length > 0) {
        var draggable = jQuery('.widget');
        if (draggable.length > 0) {
            jQuery.each(draggable, function() {
                var caption = jQuery(this).find(".widget-title h4:contains('Kopa')");
                if (1 === caption.length) {
                    caption.parent().addClass('widget-made-by-kopa');
                }
            });
        }
    }
});