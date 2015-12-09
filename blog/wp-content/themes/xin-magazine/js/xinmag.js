jQuery(document).ready(function($){

	$(document).foundation( 
		'topbar', {stickyClass: 'sticky-topbar'}
	);
	$(document).foundation( 
		'section'
	);	
	var lists = $("#featured-list li");
	if ( lists.length > 1) {
		$(lists).removeClass("active");
		$(lists[0]).addClass("active");
	}
	
	var slideAnimation = $("#slider-animation").val();
	$('.flexslider').flexslider({
		animation: slideAnimation,
		controlNav: false,
		animationSpeed: Modernizr.touch ? 400 : 1000,
//		pauseOnAction: false,
		before: function(slider){
			var nextItem = slider.animatingTo;
			var activeItem = slider.currentSlide;
			if ( ( lists.length > 0 ) && ( nextItem != activeItem ) ) {
				$(lists[activeItem]).removeClass("active");
				$(lists[nextItem]).addClass("active");
			}
		}
	});
	$('#featured-list li').hover(function () {
		var slideNum = $(lists).index( $(this) );
		$('.flexslider').flexslider(slideNum);
//		$('.flexslider').flexslider('play');
	});
	// Back-to-top Script
	$(".back-to-top").hide();
	// fade in back-to-top 
	$(window).scroll(function () {
		if ($(this).scrollTop() > 500) {
			$('.back-to-top').fadeIn();
		} else {
			$('.back-to-top').fadeOut();
		}
	});
	// scroll body to 0px on click
	$('.back-to-top a').click(function () {
		$('body,html,header').animate({
			scrollTop: 0
		}, 800);
		return false;
	});
		
});

(function($) {
  $(function(){	

	var $col = $('#portfolio-column').val();
	
	if ($col > 0) {
		
	var $container = $('.portfolio');
    $container.imagesLoaded(function(){
		$container.masonry({
    		itemSelector : '.item',
	  		isAnimated: true,
  			columnWidth: function( containerWidth ) {
				return containerWidth / $col;
  			},
  		});
    });
		
	$container.infinitescroll({
      navSelector  : '#nav-below',
      nextSelector : '#nav-below a.next.page-numbers',
      itemSelector : '.item',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: '<em>All items are loaded.</em>',
		  msgText: '<em>Loading...</em>'
        		}
     },
     // trigger Masonry as a callback
	function( newElements ) {
        // hide new items while they are loading
        var $newElems = $( newElements ).css({ opacity: 0 });
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
          // show elems now they're ready
          $newElems.animate({ opacity: 1 });
          $container.masonry( 'appended', $newElems, true ); 
        });
    });		
		
	}		

  });	
})(jQuery);


