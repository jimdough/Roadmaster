jQuery(document).ready(function($){
	
	$( "#page_template" ).change(function(){
		XinWPTemplate( $(this).val() );
	});

	function XinWPTemplate( template ){
		$( "#xinwp-page-meta" ).hide();

		if ( 'pages/portfolio.php' == template
			|| 'pages/blog-summary.php' == template
			|| 'pages/portfolio-ajax.php' == template
			) {
			$( "#p_xinwp_category" ).show();
			$( "#p_xinwp_postperpage" ).show();
			$( "#p_xinwp_sidebar" ).show();
			$( "#p_xinwp_title" ).show();
			$( "#p_xinwp_column" ).show();
			$( "#p_xinwp_thumbnail" ).show();
			$( "#p_xinwp_size_x" ).show();
			$( "#p_xinwp_size_y" ).show();
			$( "#p_xinwp_intro" ).show();
			$( "#p_xinwp_disp_meta" ).show();

			$( "#xinwp-page-meta" ).show();
		}
		else if ( 'pages/blog.php' == template ) {
			$( "#p_xinwp_category" ).show();
			$( "#p_xinwp_postperpage" ).show();
			$( "#p_xinwp_sidebar" ).show();
			$( "#p_xinwp_title" ).show();
			$( "#p_xinwp_column" ).hide();
			$( "#p_xinwp_thumbnail" ).hide();
			$( "#p_xinwp_size_x" ).hide();
			$( "#p_xinwp_size_y" ).hide();
			$( "#p_xinwp_intro" ).hide();
			$( "#p_xinwp_disp_meta" ).hide();

			$( "#xinwp-page-meta" ).show();
		}
		else if ( 'pages/imageslider.php' == template ) {
			$( "#p_xinwp_category" ).show();
			$( "#p_xinwp_postperpage" ).show();
			$( "#p_xinwp_sidebar" ).show();
			$( "#p_xinwp_title" ).hide();
			$( "#p_xinwp_column" ).hide();
			$( "#p_xinwp_thumbnail" ).show();
			$( "#p_xinwp_size_x" ).show();
			$( "#p_xinwp_size_y" ).show();
			$( "#p_xinwp_intro" ).hide();
			$( "#p_xinwp_disp_meta" ).hide();

			$( "#xinwp-page-meta" ).show();
		}
	}
	
	XinWPTemplate( $( "#page_template" ).val() );
});
