<?php
/**
 * NewsPress Options Page
 * @ Copyright: D5 Creation, www.d5creation.com
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = 'newspress';
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'newspresslite'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	
	// add_filter( 'wp_default_editor', create_function('', 'return "html";') ); 
	
	$wp_editor_settings = array(
		'wpautop' => false, // Default
		'textarea_rows' => 9,
		'editor_css' => '<style>.wp-editor-tools, .quicktags-toolbar { visibility: hidden; display:none; height:0px;} </style>',
		'teeny' => true,
		'tinymce' => false,
		'quicktags' => false
	);	
	
	$wp_editor_settings_one = array(
		'wpautop' => false, // Default
		'textarea_rows' => 1,
		'editor_css' => '<style>.wp-editor-tools, .quicktags-toolbar { visibility: hidden; display:none; height:0px;} </style>',
		'teeny' => true,
		'tinymce' => false,
		'quicktags' => false
	);	
	
// Maintenance Page Settings	
	$options[] = array(
		'name' => 'Maintenance Mode', 
		'type' => 'heading');
		
	$options[] = array(
		'name' => 'Activate Maintenance Mode',
		'desc' => 'Check it if you want to Activate Maintenance Mode', 
		'id' => 'mmactive',
		'std' => '0',
		'type' => 'checkbox' );	
		
	$options[] = array(
		'name' => 'Timeline', 
		'desc' => 'Set the Timeline Year. Such As: '.date('Y'), 
		'id' => 'timeliney',
		'std' => date('Y'),
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'desc' => 'Set the Timeline Month. Such As: '.date('m'),  
		'id' => 'timelinem',
		'std' => date('m'),
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'desc' => 'Set the Timeline Day. Such As: '.date('d'),  
		'id' => 'timelined',
		'std' => date('d'),
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Heading Text',
		'desc' => 'Set the Heading Text',  
		'id' => 'uct1',
		'std' => 'We are working our butts off to finish this website',
		'type' => 'text');
		
	$options[] = array(
		'name' => 'Heading Description',
		'desc' => 'Set the Heading Description',  
		'id' => 'uct2',
		'std' => 'Our developers, are doing their best to finish this website before the counter, but we can not help them.',
		'type' => 'text');
		
	$options[] = array(
		'name' => 'E-Mail Box Text',
		'desc' => 'Set the E-Mail Box Text',  
		'id' => 'uct3',
		'std' => 'Input your e-mail address here...',
		'type' => 'text');
		
	$options[] = array(
		'name' => 'E-Mail Button Text',
		'desc' => 'Set the E-Mail Button Text',  
		'id' => 'uct4',
		'std' => 'Let Me Notified',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Social Items Text',
		'desc' => 'Set the Social Items Text',  
		'id' => 'uct5',
		'std' => 'Learn More from our Social Pages',
		'type' => 'text');	
		
	
// General Options	
	$options[] = array(
		'name' => 'General Options', 
		'type' => 'heading');
		
	$options[] = array(
		'name' => 'Set Auto Refresh Time of the Browser', 
		'desc' => 'Set the Second Value for auto refreshing the browser. Leave blank for no auto refresh.', 
		'id' => 'auto-refresh',
		'std' => '',
		'type' => 'text',
		'class' => 'mini' );
	
	$options[] = array(
		'name' => 'NewsPress Date', 
		'desc' => 'Input Date.  Leave Blank if you want automatic Date.', 
		'id' => 'website-date',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings_one );
	
	$options[] = array(
		'name' => 'Site Favicon', 
		'desc' => 'Upload an Icon for the Site Favicon. 16px X 16px image is recommended.', 
		'id' => 'favicon',
		'std' => get_template_directory_uri() . '/images/favicon.ico',
		'type' => 'upload');	

	$options[] = array(
		'name' => 'Company Logo', 
		'desc' => 'Upload an image for the Company Logo. 250px X 70px image is recommended.', 
		'id' => 'site-logo',
		'std' => get_template_directory_uri() . '/images/logo.png',
		'type' => 'upload');
		
	$options[] = array(
		'name' => 'Show Site TagLine/Description',
		'desc' => 'Check it if you want to Show the Site TagLine/Description', 
		'id' => 'site-descrip',
		'std' => '0',
		'type' => 'checkbox' );		
		
	$options[] = array(
		'name' => 'Show Site Logo in Login Page',
		'desc' => 'Check it if you want to show Site Logo in Login Page', 
		'id' => 'login-logo',
		'std' => '1',
		'type' => 'checkbox' );		
	
	$options[] = array(
		'name' => 'Full Width Layout for WooCommerce Pages',
		'desc' => 'Check it if you want to show Full Width Layout for WooCommerce Pages', 
		'id' => 'woo-page-full',
		'std' => '1',
		'type' => 'checkbox' );	
	
	$options[] = array(
		'name' => 'Use Responsive Layout', 
		'desc' => 'Check the Box if you want the Responsive Layout of your Website', 
		'id' => 'responsive',
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array(
		'desc' => '<span class="featured-area-title">Other Settings</span>', 
		'type' => 'info');
	
	$options[] = array(
		'name' => 'Custom Code within Head Area', 
		'desc' => 'You can input any Custom Code Here like Google Analytics Code, CSS, Java Script etc.', 
		'id' => 'headcode',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Show Log In Panel on the Top',
		'desc' => 'Show Log In and Membership Panel to the Top.',
		'id' => 'lbox-check',
		'std' => '1',
		'type' => 'checkbox' );	
		
	$options[] = array(
		'name' => 'Show Search Box on the Top Right Corner',
		'desc' => 'Show Search Box on the Top Right Corner of the Site.',
		'id' => 'sbox-check',
		'std' => '1',
		'type' => 'checkbox' );	
		
	$contype = array( '1' => 'Full Content in News Page. Also Support Read More Button if inserted during Editing.', '2' => 'Some Words and Read More Button in the News Page' );
	
	$options[] = array(
		'name' => 'Select the Content Type in the All News Page, Archive Page and Search Page.',
		'desc' => 'Select whether you want to show the Full / Selected Content or Some Words and Read More Button Automatically.', 
		'id' => 'contype',
		'std' => '2',
		'type' => 'radio',
		'options' => $contype);
		
	$options[] = array(
		'name' => 'Number of Words before Read More', 
		'desc' => 'Set the Number of Words before Read More. Default is 90.', 
		'id' => 'num-wrds',
		'std' => '90',
		'type' => 'text',
		'class' => 'mini' );
	
	$options[] = array(
		'name' => 'Copyright Notice',
		'desc' => 'You can input your copyright notice or other links like sitemap here.',
		'id' => 'copyright',
		'std' => '&copy; ' . date("Y"). ': ' . get_bloginfo( 'name' ) . ', All Rights Reserved',
		'type' => 'editor',
		'settings' => $wp_editor_settings_one );

	$options[] = array(
		'name' => 'Author and WordPress Credit', 
		'desc' => 'Hide Author and CMS Credit from Footer', 
		'id' => 'credit',
		'std' => '0',
		'type' => 'checkbox' );	
		
	$options[] = array(
		'name' => 'Page Comments Box',
		'desc' => 'Hide WordPress Comments Box from All Pages',
		'id' => 'cpage',
		'std' => '0',
		'type' => 'checkbox' );	
		
	$options[] = array(
		'name' => 'News Post Comments Box',
		'desc' => 'Hide WordPress Comments Box from All News Posts',
		'id' => 'cpost',
		'std' => '0',
		'type' => 'checkbox' );	
		
	$options[] = array(
		'name' => 'Hide Admin Bar',
		'desc' => 'Hide WordPress Admin Bar for Logged In Users',
		'id' => 'admin-bar',
		'std' => '0',
		'type' => 'checkbox' );	
		
	$options[] = array(
		'name' => 'Hide Author and Date from News',
		'desc' => 'Hide Author and Date from News',
		'id' => 'wpad',
		'std' => '0',
		'type' => 'checkbox' );	
		
	$options[] = array(
		'name' => 'Hide Posted in, Comments Off, Tag etc. from News',
		'desc' => 'Hide Posted in, Comments Off, Tag etc. from News',
		'id' => 'wppct',
		'std' => '0',
		'type' => 'checkbox' );	
		
	$options[] = array(
		'desc' => '<span class="featured-area-title">Single Page News</span>', 
		'type' => 'info'); 
					
	$options[] = array(
		'name' => 'Number of Related News in Single Page News', 
		'desc' => 'Set the Number of Number of Related News in Single Page News. Default is 10. Leave Blank for No Items', 
		'id' => 'num-cat-related-news',
		'std' => '10',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Number of Words for First Two News before Read More for Related News', 
		'desc' => 'Set the Number of Words for First Two News before Read More for Related News. Default is 15.', 
		'id' => 'num-rnrm',
		'std' => '15',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'desc' => '<span class="featured-area-title">Category News Page</span>', 
		'type' => 'info');
			
	$options[] = array(
		'name' => 'Number of Heading for Category News Page', 
		'desc' => 'Set the Number of Lead Heading. Leave Blank for No Heading. Default is 1', 
		'id' => 'num-heading-cat',
		'std' => '1',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Number of Words for Category Heading News before Read More', 
		'desc' => 'Set the Number of Words before Read More for Heading News. Default is 100.', 
		'id' => 'num-rnrmcph',
		'std' => '100',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Number of Words for Category Sub Heading News before Read More', 
		'desc' => 'Set the Number of Words before Read More for Sub Heading News. Default is 30.', 
		'id' => 'num-rnrmcpsh',
		'std' => '30',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'desc' => '<span class="featured-area-title">Font Family</span>', 
		'type' => 'info');
		
	$options[] = array(
		'desc' => 'Set the Font Family without using last <b>;</b>, All default Font Family will be overwritten. Sample: <b>Arial, Helvetica, Genericons, sans-serif</b>', 
		'id' => 'fontfamily',
		'std' => '',
		'type' => 'text');
		

// Featured Image Settings	
	$options[] = array(
		'name' => 'Featured Image', 
		'type' => 'heading');
		
	$options[] = array(
		'name' => 'Hide Featured/ Thumbnail Images from All Pages',
		'desc' => 'Hide Featured/ Thumbnail Images from All Pages',
		'id' => 'tpage',
		'std' => '1',
		'type' => 'checkbox' );	
		
	$options[] = array(
		'name' => 'Hide Featured/ Thumbnail Images from All Single Page News',
		'desc' => 'Hide Featured/ Thumbnail Images from All Single Page News',
		'id' => 'tspost',
		'std' => '0',
		'type' => 'checkbox' );	

	$options[] = array(
		'name' => 'Set Automatic Featured Image with Every News if not Selected One',
		'desc' => 'Set Automatic Featured Image with Every News if not Selected One',
		'id' => 'auto-featured-image',
		'std' => '1',
		'type' => 'checkbox' );	
		
	$afis = array( '1' => 'Set the First Attached Image from the News', '2' => 'Set the Image from the Following Link' );
	
	$options[] = array(
		'name' => 'Automatic Featured Image Source',
		'desc' => 'Select the Automatic Featured Image Source', 
		'id' => 'auto-featured-image-source',
		'std' => '2',
		'type' => 'radio',
		'options' => $afis);
		
	$options[] = array(
		'name' => 'Automatic Featured Image', 
		'desc' => 'Upload an image for the Automatic Featured Image. 900px X 450px image is recommended.', 
		'id' => 'auto-featured-image-url',
		'std' => '',
		'type' => 'upload');
		
		
// Front Page Settings	
	$options[] = array(
		'name' => 'Front Page Settings', 
		'type' => 'heading');
		
	$options[] = array(
		'desc' => '<span class="featured-area-title">Heading Slider</span>', 
		'type' => 'info'); 
					
	$options[] = array(
		'name' => 'Number of Slide Posts/Images', 
		'desc' => 'Set the Number of Slide News/Images. Leave Blank for No Slide. Default is 5', 
		'id' => 'num-heading-slide',
		'std' => '5',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Set the Slider 70%', 
		'desc' => 'Check this if you want 70% Width Slider and Slider Sidebar', 
		'id' => '50-slider',
		'std' => '0',
		'type' => 'checkbox' );	
		
	$truefalse = array( 'true' => 'Yes', 'false' => 'No' );
		
	$options[] = array(
		'name' => 'Show Slide Navigation',
		'desc' => 'Select whether you want to Show the Slide Navigation or Not', 
		'id' => 'slide-nav',
		'std' => 'true',
		'type' => 'radio',
		'options' => $truefalse);
		
	$options[] = array(
		'name' => 'Show Slide Pager',
		'desc' => 'Select whether you want to Show the Slide Pager or Not', 
		'id' => 'slide-navdots',
		'std' => 'true',
		'type' => 'radio',
		'options' => $truefalse);
		
	$options[] = array(
		'name' => 'Show AutoPlay?',
		'desc' => 'Select whether you want Show AutoPlay or Not', 
		'id' => 'slide-autoplay',
		'std' => 'true',
		'type' => 'radio',
		'options' => $truefalse);
		
	$options[] = array(
		'name' => 'Slide Auto Change Speed', 
		'desc' => 'Set the Slide Auto Change Speed in Millisecond. Default is 3500', 
		'id' => 'slide-interval',
		'std' => '3500',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Slide In Speed', 
		'desc' => 'Set the Slide In Speed in Millisecond. Default is 1500', 
		'id' => 'slide-inspeed',
		'std' => '1500',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Slide Out Speed', 
		'desc' => 'Set the Slide Out Speed in Millisecond. Default is 1000', 
		'id' => 'slide-outspeed',
		'std' => '1000',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'desc' => '<span class="featured-area-title">Heading</span>', 
		'type' => 'info');
		
	$options[] = array(
		'name' => 'Number of Heading', 
		'desc' => 'Set the Number of Lead Heading. Leave Blank for No Heading. Default is 1', 
		'id' => 'num-heading',
		'std' => '1',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Number of Words for Heading News before Read More', 
		'desc' => 'Set the Number of Words before Read More for Heading News. Default is 100.', 
		'id' => 'num-rnrmfh',
		'std' => '100',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'desc' => '<span class="featured-area-title">Sub Headings</span>', 
		'type' => 'info');
		
	$options[] = array(
		'name' => 'Number of Sub Heading', 
		'desc' => 'Set the Number of Sub Heading. It must be more than 1. Default is 6', 
		'id' => 'num-sub-heading',
		'std' => '6',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Number of Words for Sub Heading News before Read More', 
		'desc' => 'Set the Number of Words before Read More for Sub Heading News. Default is 30.', 
		'id' => 'num-rnrmsh',
		'std' => '30',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Common Minimum Height for Individual Sub Heading', 
		'desc' => 'You can set a Minimum Height in Pixels so that the Sub Headings be adjusted in Line. This will also be applicable for the Category Pages.', 
		'id' => 'heightsh',
		'std' => '',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'desc' => '<span class="featured-area-title">Special Categories</span>', 
		'type' => 'info');
		
	$options[] = array(
		'name' => 'News in Each Special Category in Front Page',
		'desc' => 'Set Number of News in Each Special Category in Front Page. Default is 7',
		'id' => 'num-cat-special-news',
		'std' => '7',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Number of Words for Special Category News before Read More', 
		'desc' => 'Set the Number of Words before Read More for Special Category News. Default is 15.', 
		'id' => 'num-rnrmsc',
		'std' => '15',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'desc' => '<span class="featured-area-title">Categories</span>', 
		'type' => 'info');
		
	$options[] = array(
		'name' => 'News in Each Category in Front Page',
		'desc' => 'Set Number of News in Each Category in Front Page. Default is 5',
		'id' => 'num-cat-news',
		'std' => '5',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Number of Words for Category News before Read More', 
		'desc' => 'Set the Number of Words before Read More for Category News. Default is 15.', 
		'id' => 'num-rnrmfc',
		'std' => '15',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Common Minimum Height for Individual Category', 
		'desc' => 'You can set a Minimum Height in Pixels so that the Categories be adjusted in Line.', 
		'id' => 'heightcat',
		'std' => '',
		'type' => 'text',
		'class' => 'mini' );
		

// Front Page Gallery Block	
	$options[] = array(
		'name' => 'Gallery Block', 
		'type' => 'heading');
		
	$fpgallerya = array( '1' => 'Show the Gallery Block over the Category Items', '2' => 'Show the Gallery Block under the Category Items', '3' => 'Do not Show the Gallery Block' );
	
	$options[] = array(
		'name' => 'Gallery Block Position',
		'desc' => 'Select the Position of the Front Page Gallery Block.', 
		'id' => 'fpgallery',
		'std' => '1',
		'type' => 'radio',
		'options' => $fpgallerya);
		
	$options[] = array(
		'name' => 'Front Page Gallery Image Source (Post ID, If Any)', 
		'desc' => 'Input the Post ID of Gallery Items. Leave blank for detecting the Post ID automatically from the last Gallery Items. Default is Blank.', 
		'id' => 'fpgalid',
		'std' => '',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'More Galleries',
		'desc' => 'Change the Text <b>More Galleries</b>.',
		'id' => 'moregalleries',
		'std' => 'More Galleries',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'All Galleries Page Link', 
		'desc' => 'Input the URL of All Galleries Page. You can set a Page for All Galleries setting the Template of the Page as All Galleries', 
		'id' => 'allgalpl',
		'std' => '',
		'type' => 'text' );
		
	$options[] = array(
		'name' => 'All Galleries',
		'desc' => 'Change the Text <b>All Galleries</b>.',
		'id' => 'allgalleries',
		'std' => 'All Galleries',
		'type' => 'text',
		'class' => 'mini');	
	
	$options[] = array(
		'name' => 'Number of Galleries in each Page of All Galleries Page',
		'desc' => 'Set the Number of Galleries for each All Galleries Page',
		'id' => 'num-gal-items',
		'std' => '27',
		'type' => 'text',
		'class' => 'mini');	
		
	$fpgallerypn = array( '1' => 'Show Popular News by Views', '2' => 'Show Popular News by Readers Comments' );
	
	$options[] = array(
		'name' => 'Popular News Selection Category', 
		'desc' => 'Select the Position of the Front Page Gallery Block.', 
		'id' => 'popnsc',
		'std' => '1',
		'type' => 'radio',
		'options' => $fpgallerypn);
		
	$options[] = array(
		'name' => 'Number of Popular News', 
		'desc' => 'Input the Number of Popular News. Default is 20.', 
		'id' => 'num-post-pn',
		'std' => '20',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Popular News',
		'desc' => 'Change the Text <b>Popular News</b>.',
		'id' => 'popularnews',
		'std' => 'Popular News',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Number of Editors Choice News', 
		'desc' => 'Input the Number of Editors Choice News. Default is 10.', 
		'id' => 'num-post-ec',
		'std' => '10',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Editors Choice',
		'desc' => 'Change the Text <b>Editors Choice</b>.',
		'id' => 'editorschoice',
		'std' => 'Editors Choice',
		'type' => 'text',
		'class' => 'mini');	
		
	
		
// Breaking News Section
	$options[] = array(
		'name' => 'Breaking News', 
		'type' => 'heading');
		
	$bnsour = array( '1' => 'Show the Breaking News from a Selected Page "Breaking News Page ID"', '2' => 'Show the Breaking News from the following "Breaking News from This Box"', '3' => 'Show the Breaking News from Selected News during Editing/Creating', '4' => 'Do not Show any Breaking News' );
	
	$options[] = array(
		'name' => 'Breaking News Source',
		'desc' => 'Select the Breaking News Source. Recommended <b>"Do not Show any Breaking News"</b>', 
		'id' => 'breakingnews-source',
		'std' => '4',
		'type' => 'radio',
		'options' => $bnsour );
		
	$options[] = array(
		'name' => 'Number of Breaking News', 
		'desc' => 'Input the Number of Breaking News. Default is 10. It is applicable for the Options 03 only', 
		'id' => 'num-bn',
		'std' => '10',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Breaking News Page ID', 
		'desc' => 'Input the Page ID for Breaking News. Leave blank for collecting from the following box. Default is Blank. If you select this you should insert the News Line by Line in the Page Content. After one Line Press the Enter Key and Input the Next Line', 
		'id' => 'brnewspid',
		'std' => '',
		'type' => 'text',
		'class' => 'mini' );
		
	$options[] = array(
		'name' => 'Breaking News from This Box', 
		'desc' => 'Insert the News Line by Line. After one Line Press the Enter Key and Input the Next Line', 
		'id' => 'breaking-news',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Breaking News Text', 
		'desc' => 'Input the Breaking News Text.', 
		'id' => 'brnewstext',
		'std' => 'Breaking News: ',
		'type' => 'text',
		'class' => 'mini' );
		
		
// Categories		
	$options[] = array(
		'name' => 'Categories', 
		'type' => 'heading');
		
	// Pull all the categories into an array
	$options_categories_obj = get_categories(array('orderby' => 'slug','parent' => 0));
	
	foreach ($options_categories_obj as $category) {
		
		$options[] = array(
		'desc' => '<span class="featured-area-title">Category: ' .$category->cat_name . '</span>', 
		'type' => 'info'); 
		
		$options[] = array(
		'name' => 'Color for Category: ' .$category->cat_name,
		'desc' => 'Select any Special Color for Category: ' .$category->cat_name,
		'id' => 'cat-'.$category->cat_ID,
		'std' => '#777777',
		'type' => 'color');
		
		$options[] = array(
		'name' => 'Category Visibility in Front Page',
		'desc' => 'Show This Category and News in Front Page',
		'id' => 'cats-'.$category->cat_ID,
		'std' => '1',
		'type' => 'checkbox' );	
		
		$options[] = array(
		'desc' => 'Set Number of News in this Category in Front Page',
		'id' => 'num-cat-news'.$category->cat_ID,
		'std' => '5',
		'type' => 'text',
		'class' => 'mini');	
		
		$options[] = array(
		'name' => 'Special Category for Front Page?',
		'desc' => 'Show This Category as a Special Category for Front Page',
		'id' => 'catsp-'.$category->cat_ID,
		'std' => '0',
		'type' => 'checkbox' );	
		
		$options[] = array(
		'desc' => 'Set Number of News in this Special Category in Front Page',
		'id' => 'num-catsp-news'.$category->cat_ID,
		'std' => '7',
		'type' => 'text',
		'class' => 'mini');
		
		$options[] = array(
		'name' => 'Advertisement Code with Category',
		'desc' => 'If you input HTML, JavaScripts, ShortCode here those will be shown under the Category. ',
		'id' => 'num-cat-ad'.$category->cat_ID,
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	}
	

// Social Links	
	$options[] = array(
		'name' => 'Social Links', 
		'type' => 'heading');

	$options[] = array(
		'name' => 'Number of Social Links', 
		'desc' => 'Set the Number of Social Links you want.', 
		'id' => 'nslinks',
		'std' => '5',
		'type' => 'text',
		'class' => 'mini');
		
	$numslinks = of_get_option('nslinks', '5');
	foreach (range(1, $numslinks ) as $numslinksn) {
		
	$options[] = array(
		'name' => 'Social Link - '. $numslinksn, 
		'desc' => 'Input Your Social Page Link. Example: <b>http://facebook.com/d5creation</b>.  If you do not want to show anything here leave the box blank.', 
		'id' => 'sl' . $numslinksn,
		'std' => '#',
		'type' => 'text');	
		
	}
	
	// Advertisement	
	$options[] = array(
		'name' => 'Advertisement', 
		'type' => 'heading');

	$options[] = array(
		'name' => 'Advertisement 01: Top of the Site', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv01',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 02: Over the Logo', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv02',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 03: Left of Logo', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: 250px X 90px', 
		'id' => 'adv03',
		'std' => '<a href="#" target="_blank"><img src ="'. get_template_directory_uri() . '/images/ad3.png" /></a>',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 04: Right of Logo', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: 250px X 90px', 
		'id' => 'adv04',
		'std' => '<a href="#" target="_blank"><img src ="'. get_template_directory_uri() . '/images/ad3.png" /></a>',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 05: Over the Heading and Under the Heading Slider', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv05',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 06: Under the first two Sub Heading News of Front Page', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv06',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 07: Under Sub Headings of Front Page', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv07',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 08: Under the Gallery Block of Front Page', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv08',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 09: Over Single News Page Title', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv09',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 10: Under Single News Page Title', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv10',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 11: Bottom of Single News Page Content', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv11',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 12: Top of Category Page', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv12',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 13: Under the Featured News of Category Page', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv13',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 14: Under the Category Page', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv14',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 15: Top of Archive Page', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv15',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 16: Under the Archive Page', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv16',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 17: Top of All Gallery Page', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv17',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	$options[] = array(
		'name' => 'Advertisement 18: Under the All Gallery Page', 
		'desc' => 'Input Advertisement Code Here. You can use HTML, JavaScripts etc. Recommended Size: Large Size', 
		'id' => 'adv18',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
		
	// Language Settings
	$options[] = array(
		'name' => 'Language',
		'type' => 'heading');		
	
	$options[] = array(
		'desc' => 'You can change the texts as your own language. These are only the Front End Texts which your visitors will see.',
		'type' => 'info');	
		
	$options[] = array(
		'name' => 'Search...',
		'desc' => 'Change the Text <b>Search...</b>.',
		'id' => 'src',
		'std' => 'Search...',
		'type' => 'text',
		'class' => 'mini');	
	
	$options[] = array(
		'name' => 'Read More',
		'desc' => 'Change the Text <b>Read More</b>.',
		'id' => 'readmore',
		'std' => 'Read More',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Read All',
		'desc' => 'Change the Text <b>Read All</b>.',
		'id' => 'readall',
		'std' => 'Read All',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'No Comments',
		'desc' => 'Change the Text <b>No Comments</b>.',
		'id' => 'nocomments',
		'std' => 'No Comments',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Comments',
		'desc' => 'Change the Text <b>Comments</b>.',
		'id' => 'comments',
		'std' => 'Comments',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'One Comment',
		'desc' => 'Change the Text <b>One Comment</b>.',
		'id' => '1comment',
		'std' => 'One Comment',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Comments are Closed',
		'desc' => 'Change the Text <b>Comments are Closed</b>.',
		'id' => 'cac',
		'std' => 'Comments are Closed',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'To',
		'desc' => 'Change the Text <b>to</b>.',
		'id' => 'to2',
		'std' => 'to',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Leave a Reply',
		'desc' => 'Change the Text <b>Leave a Reply</b>.',
		'id' => 'lar',
		'std' => 'Leave a Reply',
		'type' => 'text');	
		
	$options[] = array(
		'name' => 'Leave a Reply to',
		'desc' => 'Change the Text <b>Leave a Reply to</b>.',
		'id' => 'lart',
		'std' => 'Leave a Reply to',
		'type' => 'text');
		
	$options[] = array(
		'name' => 'Cancel Reply',
		'desc' => 'Change the Text <b>Cancel Reply</b>.',
		'id' => 'crply',
		'std' => 'Cancel Reply',
		'type' => 'text');
		
	$options[] = array(
		'name' => 'Post Comment',
		'desc' => 'Change the Text <b>Post Comment</b>.',
		'id' => 'pcmnt',
		'std' => 'Post Comment',
		'type' => 'text');
		
	$options[] = array(
		'name' => 'Comment:',
		'desc' => 'Change the Text <b>Comment:</b>.',
		'id' => 'commentsin',
		'std' => 'Comment:',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'For Posting a Comment You must be',
		'desc' => 'Change the Text <b>For Posting a Comment You must be</b>.',
		'id' => 'mbli',
		'std' => 'For Posting a Comment You must be',
		'type' => 'text');	
		
	$options[] = array(
		'name' => 'Logged In',
		'desc' => 'Change the Text <b>Logged In</b>.',
		'id' => 'loggedin',
		'std' => 'Logged In',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'logged In as',
		'desc' => 'Change the Text <b>logged In as</b>.',
		'id' => 'lias',
		'std' => 'Logged In as',
		'type' => 'text');
		
	$options[] = array(
		'name' => 'Log out of this account',
		'desc' => 'Change the Text <b>Log out of this account</b>.',
		'id' => 'lota',
		'std' => 'Log out of this account',
		'type' => 'text');
		
	$options[] = array(
		'name' => 'Log out?',
		'desc' => 'Change the Text <b>Log out?</b>.',
		'id' => 'loout',
		'std' => 'Log out?',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Name:',
		'desc' => 'Change the Text <b>Name:</b>.',
		'id' => 'comntname',
		'std' => 'Name:',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'E-Mail:',
		'desc' => 'Change the Text <b>E-Mail:</b>.',
		'id' => 'comntemail',
		'std' => 'E-Mail:',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Website:',
		'desc' => 'Change the Text <b>Website:</b>.',
		'id' => 'comntweb',
		'std' => 'Website:',
		'type' => 'text',
		'class' => 'mini');	
		

	$options[] = array(
		'name' => 'Previous Image',
		'desc' => 'Change the Text <b>Previous Image</b>.',
		'id' => 'pi3',
		'std' => 'Previous Image',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Next Image',
		'desc' => 'Change the Text <b>Next Image</b>.',
		'id' => 'ni3',
		'std' => 'Next Image',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Previous News',
		'desc' => 'Change the Text <b>Previous News</b>.',
		'id' => 'pe3',
		'std' => 'Previous News',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Next News',
		'desc' => 'Change the Text <b>Next News</b>.',
		'id' => 'ne3',
		'std' => 'Next News',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Pages:',
		'desc' => 'Change the Text <b>Pages:</b>.',
		'id' => 'pagesn',
		'std' => 'Pages:',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Search Results',
		'desc' => 'Change the Text <b>Search Results</b>.',
		'id' => 'srslt',
		'std' => 'Search Results',
		'type' => 'text',
		'class' => 'mini');	

	
	$options[] = array(
		'name' => 'Search Term',
		'desc' => 'Change the Text <b>Search Term</b>.',
		'id' => 'strm',
		'std' => 'Search Term',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Number of Results',
		'desc' => 'Change the Text <b>Number of Results</b>.',
		'id' => 'nosrc',
		'std' => 'Number of Results',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Sorry, we could not find anything that matched your search.',
		'desc' => 'Change the Text <b>Sorry, we could not find anything that matched your search.</b>.',
		'id' => 'swcf',
		'std' => 'Sorry, we could not find anything that matched your search.',
		'type' => 'text');	
		
	$options[] = array(
		'name' => 'You Can Try Another Search...',
		'desc' => 'Change the Text <b>You Can Try Another Search...</b>.',
		'id' => 'yctas',
		'std' => 'You Can Try Another Search...',
		'type' => 'text');	

	$options[] = array(
		'name' => 'Or Return to the Home Page',
		'desc' => 'Change the Text <b>Or Return to the Home Page</b>.',
		'id' => 'orhp',
		'std' => 'Or Return to the Home Page',
		'type' => 'text');	
		
	$options[] = array(
		'name' => '404: Not Found',
		'desc' => 'Change the Text <b>404: Not Found</b>.',
		'id' => 'notf',
		'std' => '404: Not Found',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Related News',
		'desc' => 'Change the Text <b>Related News</b>.',
		'id' => 'related-news',
		'std' => 'Related News',
		'type' => 'text',
		'class' => 'mini');	
		
	$options[] = array(
		'name' => 'Archives',
		'desc' => 'Change the Text <b>Archives</b>.',
		'id' => 'arc-text',
		'std' => 'Archives',
		'type' => 'text',
		'class' => 'mini');				
		
		
// 	Color Settings
	$options[] = array(
		'name' => 'Color', 
		'type' => 'heading');		

	
	$options[] = array(
		'desc' => 'You can edit the color of your site from here. We recommend you to do any customization here. It is just like CSS. If you are not familiar with CSS you should not touch this.',
		'type' => 'info');
		
	$options[] = array(
		'name' => 'Use This Customized Design', 
		'desc' => 'Check this box if you want to use the following Custom Style Code', 
		'id' => 'colorcssaccept',
		'std' => '0',
		'type' => 'checkbox' );	
	
	$options[] = array(
		'name' => 'Color 01', 
		'desc' => 'Change the Color <b>#F90909</b>', 
		'id' => 'color1',
		'std' => '#F90909',
		'type' => 'color' );
	
	$options[] = array(
		'name' => 'Color 02', 
		'desc' => 'Change the Color <b>#000000</b>', 
		'id' => 'color2',
		'std' => '#000000',
		'type' => 'color' );
		
	$options[] = array(
		'name' => 'Color 03', 
		'desc' => 'Change the Color <b>#111111</b>', 
		'id' => 'color3',
		'std' => '#111111',
		'type' => 'color' );
		
	$options[] = array(
		'name' => 'Color 04', 
		'desc' => 'Change the Color <b>#333333</b>', 
		'id' => 'color4',
		'std' => '#333333',
		'type' => 'color' );	
		
	$options[] = array(
		'name' => 'Color 05', 
		'desc' => 'Change the Color <b>#555555</b>', 
		'id' => 'color5',
		'std' => '#555555',
		'type' => 'color' );
		
	$options[] = array(
		'name' => 'Color 06', 
		'desc' => 'Change the Color <b>#777777</b>', 
		'id' => 'color6',
		'std' => '#777777',
		'type' => 'color' );	
	
	$options[] = array(
		'name' => 'Color 07', 
		'desc' => 'Change the Color <b>#AAAAAA</b>', 
		'id' => 'color7',
		'std' => '#AAAAAA',
		'type' => 'color' );
		
	$options[] = array(
		'name' => 'Color 08', 
		'desc' => 'Change the Color <b>#BBBBBB</b>', 
		'id' => 'color8',
		'std' => '#BBBBBB',
		'type' => 'color' );	
		
	$options[] = array(
		'name' => 'Color 09', 
		'desc' => 'Change the Color <b>#CCCCCC</b>', 
		'id' => 'color9',
		'std' => '#CCCCCC',
		'type' => 'color' );
		
	$options[] = array(
		'name' => 'Color 10', 
		'desc' => 'Change the Color <b>#DDDDDD</b>', 
		'id' => 'color10',
		'std' => '#DDDDDD',
		'type' => 'color' );		
		
	$options[] = array(
		'name' => 'Color 11', 
		'desc' => 'Change the Color <b>#EEEEEE</b>', 
		'id' => 'color11',
		'std' => '#EEEEEE',
		'type' => 'color' );	
		
	$options[] = array(
		'name' => 'Color 12', 
		'desc' => 'Change the Color <b>#F6F6F6</b>', 
		'id' => 'color12',
		'std' => '#F6F6F6',
		'type' => 'color' );
		
	$options[] = array(
		'name' => 'Color 13', 
		'desc' => 'Change the Color <b>#FFFFFF</b>', 
		'id' => 'color13',
		'std' => '#FFFFFF',
		'type' => 'color' );	
	
	$options[] = array(
		'name' => 'Color CSS of your Site', 
		'desc' => 'You can set your own colors and image locations for your site. You can also pste Custom CSS in the following Box. You need not use starting and closing <b>style</b> tag.', 
		'type' => 'info' );
	$coldefault = '
img.site-logo, h1.site-title { text-shadow: 0 0 0 #DDDDDD, 1px 1px 0 #DDDDDD, 2px 2px 1px rgba(0, 0, 0, 0.75), 2px 2px 1px rgba(0, 0, 0, 0.5), 0 0 1px rgba(0, 0, 0, 0.2); }

.fpage-catg span:hover { background: rgba(0, 0, 0, 0.3); }

.sub-menu, .sub-menu ul ul { background: rgba(250, 10, 10, .3); }

#newspress-main-menu .current_page_ancestor > a { background: rgba(250, 10, 10, .9); }

#newspress-main-menu ul ul .current_page_ancestor > a { background: rgba(85, 85, 85, .9); }

th {text-shadow: 0 1px 0 rgba(255, 255, 255, 0.7); }

.slide-title { background: rgba(250, 10, 10, 0.75); }

.slide-des { background: rgba(250, 10, 10, 0.75); }
		';
		
	$options[] = array(
		'id' => 'color-setting',
		'std' => $coldefault,
		'type' => 'editor',
		'settings' => $wp_editor_settings );
		
	
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<?php
}
