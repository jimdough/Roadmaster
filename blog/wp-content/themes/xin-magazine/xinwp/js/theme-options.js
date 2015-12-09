// JavaScript Document
jQuery(document).ready(function($){	
	// Tabs
	listsTab = $("#xin-tabs a");
	if ( listsTab.length > 0 ) {
		currentTab = $('#currenttab').val();	
		$(listsTab[currentTab]).addClass("xin-current");
	}

	$('#xin-wrapper .xin-pane').eq($('.xin-current').index()).show();
		
	$('#xin-tabs a').click(function() {
		$('#xin-tabs a').removeClass('xin-current');
		$(this).addClass('xin-current');
		$('#xin-wrapper .xin-pane').hide();
		$('#xin-wrapper .xin-pane').eq($(this).index()).show();
		$('#currenttab').val($(this).index());
	});
	
	$('.xin-color-field').wpColorPicker();
	 
    setTimeout(function () {
        $(".fade").fadeOut("slow", function () {
            $(".fade").remove();
        });

    }, 3000);

	$( '.section-sortable' ).sortable({
		connectWith: '.connected',
		update: function( event, ui ){ updateData(event, ui) }
	});
	
	function updateData(event, ui) {
		var $target = $(event.target);
		
		var $data = $target.sortable('serialize');
		if ( $target.is('#section-active') ) {
	
			$('#section_order').val( $data );
		}
	}
		
});
