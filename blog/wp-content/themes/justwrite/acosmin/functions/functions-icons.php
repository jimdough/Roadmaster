<?php
/* ------------------------------------------------------------------------- *
 *  Icons API
 *	____________
 *
 *	We created a little function in case FontAwesome gets updated.
 *	Updates are made via Framework Update.
/* ------------------------------------------------------------------------- */



/*  Echo or return an icon.
/*	You only need the icon's name witout "fa-" prefix.
/*	Example ac_icon( "play" );
/*	Set the second parameter to false to return the icon.
/*	Example ac_icon( "play", false );
/* ------------------------------------------------------------------------- */
function ac_icon($icon = '', $output = true) {
	if($icon != '') {
		if( $output ) { 
			echo '<i class="fa fa-'. $icon .'"></i> ';
		} else {
			return '<i class="fa fa-'. $icon .'"></i> ';
		}
	}
	return;
}



/*  In case we're working with loops
/* ------------------------------------ */
function ac_icon_output($icon = '') {
	global $post, $ac_icons;
	$icon_info = get_post_meta( $post->ID, $icon, true );
	if($icon_info != '') { 
		echo '<i class="fa fa-'. $icon_info .'"></i> ';
	}
	return;
}



//  -- List of icons
$ac_icons = array(array('name' => 'Glass', 'value' => 'fa-glass'), array('name' => 'Music', 'value' => 'fa-music'), array('name' => 'Search', 'value' => 'fa-search'), array('name' => 'Envelope O', 'value' => 'fa-envelope-o'), array('name' => 'Heart', 'value' => 'fa-heart'), array('name' => 'Star', 'value' => 'fa-star'), array('name' => 'Star O', 'value' => 'fa-star-o'), array('name' => 'User', 'value' => 'fa-user'), array('name' => 'Film', 'value' => 'fa-film'), array('name' => 'Th Large', 'value' => 'fa-th-large'), array('name' => 'Th', 'value' => 'fa-th'), array('name' => 'Th List', 'value' => 'fa-th-list'), array('name' => 'Check', 'value' => 'fa-check'), array('name' => 'Remove', 'value' => 'fa-remove'), array('name' => 'Close', 'value' => 'fa-close'), array('name' => 'Times', 'value' => 'fa-times'), array('name' => 'Search Plus', 'value' => 'fa-search-plus'), array('name' => 'Search Minus', 'value' => 'fa-search-minus'), array('name' => 'Power Off', 'value' => 'fa-power-off'), array('name' => 'Signal', 'value' => 'fa-signal'), array('name' => 'Gear', 'value' => 'fa-gear'), array('name' => 'Cog', 'value' => 'fa-cog'), array('name' => 'Trash O', 'value' => 'fa-trash-o'), array('name' => 'Home', 'value' => 'fa-home'), array('name' => 'File O', 'value' => 'fa-file-o'), array('name' => 'Clock O', 'value' => 'fa-clock-o'), array('name' => 'Road', 'value' => 'fa-road'), array('name' => 'Download', 'value' => 'fa-download'), array('name' => 'Arrow Circle O Down', 'value' => 'fa-arrow-circle-o-down'), array('name' => 'Arrow Circle O Up', 'value' => 'fa-arrow-circle-o-up'), array('name' => 'Inbox', 'value' => 'fa-inbox'), array('name' => 'Play Circle O', 'value' => 'fa-play-circle-o'), array('name' => 'Rotate Right', 'value' => 'fa-rotate-right'), array('name' => 'Repeat', 'value' => 'fa-repeat'), array('name' => 'Refresh', 'value' => 'fa-refresh'), array('name' => 'List Alt', 'value' => 'fa-list-alt'), array('name' => 'Lock', 'value' => 'fa-lock'), array('name' => 'Flag', 'value' => 'fa-flag'), array('name' => 'Headphones', 'value' => 'fa-headphones'), array('name' => 'Volume Off', 'value' => 'fa-volume-off'), array('name' => 'Volume Down', 'value' => 'fa-volume-down'), array('name' => 'Volume Up', 'value' => 'fa-volume-up'), array('name' => 'Qrcode', 'value' => 'fa-qrcode'), array('name' => 'Barcode', 'value' => 'fa-barcode'), array('name' => 'Tag', 'value' => 'fa-tag'), array('name' => 'Tags', 'value' => 'fa-tags'), array('name' => 'Book', 'value' => 'fa-book'), array('name' => 'Bookmark', 'value' => 'fa-bookmark'), array('name' => 'Print', 'value' => 'fa-print'), array('name' => 'Camera', 'value' => 'fa-camera'), array('name' => 'Font', 'value' => 'fa-font'), array('name' => 'Bold', 'value' => 'fa-bold'), array('name' => 'Italic', 'value' => 'fa-italic'), array('name' => 'Text Height', 'value' => 'fa-text-height'), array('name' => 'Text Width', 'value' => 'fa-text-width'), array('name' => 'Align Left', 'value' => 'fa-align-left'), array('name' => 'Align Center', 'value' => 'fa-align-center'), array('name' => 'Align Right', 'value' => 'fa-align-right'), array('name' => 'Align Justify', 'value' => 'fa-align-justify'), array('name' => 'List', 'value' => 'fa-list'), array('name' => 'Dedent', 'value' => 'fa-dedent'), array('name' => 'Outdent', 'value' => 'fa-outdent'), array('name' => 'Indent', 'value' => 'fa-indent'), array('name' => 'Video Camera', 'value' => 'fa-video-camera'), array('name' => 'Photo', 'value' => 'fa-photo'), array('name' => 'Image', 'value' => 'fa-image'), array('name' => 'Picture O', 'value' => 'fa-picture-o'), array('name' => 'Pencil', 'value' => 'fa-pencil'), array('name' => 'Map Marker', 'value' => 'fa-map-marker'), array('name' => 'Adjust', 'value' => 'fa-adjust'), array('name' => 'Tint', 'value' => 'fa-tint'), array('name' => 'Edit', 'value' => 'fa-edit'), array('name' => 'Pencil Square O', 'value' => 'fa-pencil-square-o'), array('name' => 'Share Square O', 'value' => 'fa-share-square-o'), array('name' => 'Check Square O', 'value' => 'fa-check-square-o'), array('name' => 'Arrows', 'value' => 'fa-arrows'), array('name' => 'Step Backward', 'value' => 'fa-step-backward'), array('name' => 'Fast Backward', 'value' => 'fa-fast-backward'), array('name' => 'Backward', 'value' => 'fa-backward'), array('name' => 'Play', 'value' => 'fa-play'), array('name' => 'Pause', 'value' => 'fa-pause'), array('name' => 'Stop', 'value' => 'fa-stop'), array('name' => 'Forward', 'value' => 'fa-forward'), array('name' => 'Fast Forward', 'value' => 'fa-fast-forward'), array('name' => 'Step Forward', 'value' => 'fa-step-forward'), array('name' => 'Eject', 'value' => 'fa-eject'), array('name' => 'Chevron Left', 'value' => 'fa-chevron-left'), array('name' => 'Chevron Right', 'value' => 'fa-chevron-right'), array('name' => 'Plus Circle', 'value' => 'fa-plus-circle'), array('name' => 'Minus Circle', 'value' => 'fa-minus-circle'), array('name' => 'Times Circle', 'value' => 'fa-times-circle'), array('name' => 'Check Circle', 'value' => 'fa-check-circle'), array('name' => 'Question Circle', 'value' => 'fa-question-circle'), array('name' => 'Info Circle', 'value' => 'fa-info-circle'), array('name' => 'Crosshairs', 'value' => 'fa-crosshairs'), array('name' => 'Times Circle O', 'value' => 'fa-times-circle-o'), array('name' => 'Check Circle O', 'value' => 'fa-check-circle-o'), array('name' => 'Ban', 'value' => 'fa-ban'), array('name' => 'Arrow Left', 'value' => 'fa-arrow-left'), array('name' => 'Arrow Right', 'value' => 'fa-arrow-right'), array('name' => 'Arrow Up', 'value' => 'fa-arrow-up'), array('name' => 'Arrow Down', 'value' => 'fa-arrow-down'), array('name' => 'Mail Forward', 'value' => 'fa-mail-forward'), array('name' => 'Share', 'value' => 'fa-share'), array('name' => 'Expand', 'value' => 'fa-expand'), array('name' => 'Compress', 'value' => 'fa-compress'), array('name' => 'Plus', 'value' => 'fa-plus'), array('name' => 'Minus', 'value' => 'fa-minus'), array('name' => 'Asterisk', 'value' => 'fa-asterisk'), array('name' => 'Exclamation Circle', 'value' => 'fa-exclamation-circle'), array('name' => 'Gift', 'value' => 'fa-gift'), array('name' => 'Leaf', 'value' => 'fa-leaf'), array('name' => 'Fire', 'value' => 'fa-fire'), array('name' => 'Eye', 'value' => 'fa-eye'), array('name' => 'Eye Slash', 'value' => 'fa-eye-slash'), array('name' => 'Warning', 'value' => 'fa-warning'), array('name' => 'Exclamation Triangle', 'value' => 'fa-exclamation-triangle'), array('name' => 'Plane', 'value' => 'fa-plane'), array('name' => 'Calendar', 'value' => 'fa-calendar'), array('name' => 'Random', 'value' => 'fa-random'), array('name' => 'Comment', 'value' => 'fa-comment'), array('name' => 'Magnet', 'value' => 'fa-magnet'), array('name' => 'Chevron Up', 'value' => 'fa-chevron-up'), array('name' => 'Chevron Down', 'value' => 'fa-chevron-down'), array('name' => 'Retweet', 'value' => 'fa-retweet'), array('name' => 'Shopping Cart', 'value' => 'fa-shopping-cart'), array('name' => 'Folder', 'value' => 'fa-folder'), array('name' => 'Folder Open', 'value' => 'fa-folder-open'), array('name' => 'Arrows V', 'value' => 'fa-arrows-v'), array('name' => 'Arrows H', 'value' => 'fa-arrows-h'), array('name' => 'Bar Chart O', 'value' => 'fa-bar-chart-o'), array('name' => 'Bar Chart', 'value' => 'fa-bar-chart'), array('name' => 'Twitter Square', 'value' => 'fa-twitter-square'), array('name' => 'Facebook Square', 'value' => 'fa-facebook-square'), array('name' => 'Camera Retro', 'value' => 'fa-camera-retro'), array('name' => 'Key', 'value' => 'fa-key'), array('name' => 'Gears', 'value' => 'fa-gears'), array('name' => 'Cogs', 'value' => 'fa-cogs'), array('name' => 'Comments', 'value' => 'fa-comments'), array('name' => 'Thumbs O Up', 'value' => 'fa-thumbs-o-up'), array('name' => 'Thumbs O Down', 'value' => 'fa-thumbs-o-down'), array('name' => 'Star Half', 'value' => 'fa-star-half'), array('name' => 'Heart O', 'value' => 'fa-heart-o'), array('name' => 'Sign Out', 'value' => 'fa-sign-out'), array('name' => 'Linkedin Square', 'value' => 'fa-linkedin-square'), array('name' => 'Thumb Tack', 'value' => 'fa-thumb-tack'), array('name' => 'External Link', 'value' => 'fa-external-link'), array('name' => 'Sign In', 'value' => 'fa-sign-in'), array('name' => 'Trophy', 'value' => 'fa-trophy'), array('name' => 'Github Square', 'value' => 'fa-github-square'), array('name' => 'Upload', 'value' => 'fa-upload'), array('name' => 'Lemon O', 'value' => 'fa-lemon-o'), array('name' => 'Phone', 'value' => 'fa-phone'), array('name' => 'Square O', 'value' => 'fa-square-o'), array('name' => 'Bookmark O', 'value' => 'fa-bookmark-o'), array('name' => 'Phone Square', 'value' => 'fa-phone-square'), array('name' => 'Twitter', 'value' => 'fa-twitter'), array('name' => 'Facebook F', 'value' => 'fa-facebook-f'), array('name' => 'Facebook', 'value' => 'fa-facebook'), array('name' => 'Github', 'value' => 'fa-github'), array('name' => 'Unlock', 'value' => 'fa-unlock'), array('name' => 'Credit Card', 'value' => 'fa-credit-card'), array('name' => 'Rss', 'value' => 'fa-rss'), array('name' => 'Hdd O', 'value' => 'fa-hdd-o'), array('name' => 'Bullhorn', 'value' => 'fa-bullhorn'), array('name' => 'Bell', 'value' => 'fa-bell'), array('name' => 'Certificate', 'value' => 'fa-certificate'), array('name' => 'Hand O Right', 'value' => 'fa-hand-o-right'), array('name' => 'Hand O Left', 'value' => 'fa-hand-o-left'), array('name' => 'Hand O Up', 'value' => 'fa-hand-o-up'), array('name' => 'Hand O Down', 'value' => 'fa-hand-o-down'), array('name' => 'Arrow Circle Left', 'value' => 'fa-arrow-circle-left'), array('name' => 'Arrow Circle Right', 'value' => 'fa-arrow-circle-right'), array('name' => 'Arrow Circle Up', 'value' => 'fa-arrow-circle-up'), array('name' => 'Arrow Circle Down', 'value' => 'fa-arrow-circle-down'), array('name' => 'Globe', 'value' => 'fa-globe'), array('name' => 'Wrench', 'value' => 'fa-wrench'), array('name' => 'Tasks', 'value' => 'fa-tasks'), array('name' => 'Filter', 'value' => 'fa-filter'), array('name' => 'Briefcase', 'value' => 'fa-briefcase'), array('name' => 'Arrows Alt', 'value' => 'fa-arrows-alt'), array('name' => 'Group', 'value' => 'fa-group'), array('name' => 'Users', 'value' => 'fa-users'), array('name' => 'Chain', 'value' => 'fa-chain'), array('name' => 'Link', 'value' => 'fa-link'), array('name' => 'Cloud', 'value' => 'fa-cloud'), array('name' => 'Flask', 'value' => 'fa-flask'), array('name' => 'Cut', 'value' => 'fa-cut'), array('name' => 'Scissors', 'value' => 'fa-scissors'), array('name' => 'Copy', 'value' => 'fa-copy'), array('name' => 'Files O', 'value' => 'fa-files-o'), array('name' => 'Paperclip', 'value' => 'fa-paperclip'), array('name' => 'Save', 'value' => 'fa-save'), array('name' => 'Floppy O', 'value' => 'fa-floppy-o'), array('name' => 'Square', 'value' => 'fa-square'), array('name' => 'Navicon', 'value' => 'fa-navicon'), array('name' => 'Reorder', 'value' => 'fa-reorder'), array('name' => 'Bars', 'value' => 'fa-bars'), array('name' => 'List Ul', 'value' => 'fa-list-ul'), array('name' => 'List Ol', 'value' => 'fa-list-ol'), array('name' => 'Strikethrough', 'value' => 'fa-strikethrough'), array('name' => 'Underline', 'value' => 'fa-underline'), array('name' => 'Table', 'value' => 'fa-table'), array('name' => 'Magic', 'value' => 'fa-magic'), array('name' => 'Truck', 'value' => 'fa-truck'), array('name' => 'Pinterest', 'value' => 'fa-pinterest'), array('name' => 'Pinterest Square', 'value' => 'fa-pinterest-square'), array('name' => 'Google Plus Square', 'value' => 'fa-google-plus-square'), array('name' => 'Google Plus', 'value' => 'fa-google-plus'), array('name' => 'Money', 'value' => 'fa-money'), array('name' => 'Caret Down', 'value' => 'fa-caret-down'), array('name' => 'Caret Up', 'value' => 'fa-caret-up'), array('name' => 'Caret Left', 'value' => 'fa-caret-left'), array('name' => 'Caret Right', 'value' => 'fa-caret-right'), array('name' => 'Columns', 'value' => 'fa-columns'), array('name' => 'Unsorted', 'value' => 'fa-unsorted'), array('name' => 'Sort', 'value' => 'fa-sort'), array('name' => 'Sort Down', 'value' => 'fa-sort-down'), array('name' => 'Sort Desc', 'value' => 'fa-sort-desc'), array('name' => 'Sort Up', 'value' => 'fa-sort-up'), array('name' => 'Sort Asc', 'value' => 'fa-sort-asc'), array('name' => 'Envelope', 'value' => 'fa-envelope'), array('name' => 'Linkedin', 'value' => 'fa-linkedin'), array('name' => 'Rotate Left', 'value' => 'fa-rotate-left'), array('name' => 'Undo', 'value' => 'fa-undo'), array('name' => 'Legal', 'value' => 'fa-legal'), array('name' => 'Gavel', 'value' => 'fa-gavel'), array('name' => 'Dashboard', 'value' => 'fa-dashboard'), array('name' => 'Tachometer', 'value' => 'fa-tachometer'), array('name' => 'Comment O', 'value' => 'fa-comment-o'), array('name' => 'Comments O', 'value' => 'fa-comments-o'), array('name' => 'Flash', 'value' => 'fa-flash'), array('name' => 'Bolt', 'value' => 'fa-bolt'), array('name' => 'Sitemap', 'value' => 'fa-sitemap'), array('name' => 'Umbrella', 'value' => 'fa-umbrella'), array('name' => 'Paste', 'value' => 'fa-paste'), array('name' => 'Clipboard', 'value' => 'fa-clipboard'), array('name' => 'Lightbulb O', 'value' => 'fa-lightbulb-o'), array('name' => 'Exchange', 'value' => 'fa-exchange'), array('name' => 'Cloud Download', 'value' => 'fa-cloud-download'), array('name' => 'Cloud Upload', 'value' => 'fa-cloud-upload'), array('name' => 'User Md', 'value' => 'fa-user-md'), array('name' => 'Stethoscope', 'value' => 'fa-stethoscope'), array('name' => 'Suitcase', 'value' => 'fa-suitcase'), array('name' => 'Bell O', 'value' => 'fa-bell-o'), array('name' => 'Coffee', 'value' => 'fa-coffee'), array('name' => 'Cutlery', 'value' => 'fa-cutlery'), array('name' => 'File Text O', 'value' => 'fa-file-text-o'), array('name' => 'Building O', 'value' => 'fa-building-o'), array('name' => 'Hospital O', 'value' => 'fa-hospital-o'), array('name' => 'Ambulance', 'value' => 'fa-ambulance'), array('name' => 'Medkit', 'value' => 'fa-medkit'), array('name' => 'Fighter Jet', 'value' => 'fa-fighter-jet'), array('name' => 'Beer', 'value' => 'fa-beer'), array('name' => 'H Square', 'value' => 'fa-h-square'), array('name' => 'Plus Square', 'value' => 'fa-plus-square'), array('name' => 'Angle Double Left', 'value' => 'fa-angle-double-left'), array('name' => 'Angle Double Right', 'value' => 'fa-angle-double-right'), array('name' => 'Angle Double Up', 'value' => 'fa-angle-double-up'), array('name' => 'Angle Double Down', 'value' => 'fa-angle-double-down'), array('name' => 'Angle Left', 'value' => 'fa-angle-left'), array('name' => 'Angle Right', 'value' => 'fa-angle-right'), array('name' => 'Angle Up', 'value' => 'fa-angle-up'), array('name' => 'Angle Down', 'value' => 'fa-angle-down'), array('name' => 'Desktop', 'value' => 'fa-desktop'), array('name' => 'Laptop', 'value' => 'fa-laptop'), array('name' => 'Tablet', 'value' => 'fa-tablet'), array('name' => 'Mobile Phone', 'value' => 'fa-mobile-phone'), array('name' => 'Mobile', 'value' => 'fa-mobile'), array('name' => 'Circle O', 'value' => 'fa-circle-o'), array('name' => 'Quote Left', 'value' => 'fa-quote-left'), array('name' => 'Quote Right', 'value' => 'fa-quote-right'), array('name' => 'Spinner', 'value' => 'fa-spinner'), array('name' => 'Circle', 'value' => 'fa-circle'), array('name' => 'Mail Reply', 'value' => 'fa-mail-reply'), array('name' => 'Reply', 'value' => 'fa-reply'), array('name' => 'Github Alt', 'value' => 'fa-github-alt'), array('name' => 'Folder O', 'value' => 'fa-folder-o'), array('name' => 'Folder Open O', 'value' => 'fa-folder-open-o'), array('name' => 'Smile O', 'value' => 'fa-smile-o'), array('name' => 'Frown O', 'value' => 'fa-frown-o'), array('name' => 'Meh O', 'value' => 'fa-meh-o'), array('name' => 'Gamepad', 'value' => 'fa-gamepad'), array('name' => 'Keyboard O', 'value' => 'fa-keyboard-o'), array('name' => 'Flag O', 'value' => 'fa-flag-o'), array('name' => 'Flag Checkered', 'value' => 'fa-flag-checkered'), array('name' => 'Terminal', 'value' => 'fa-terminal'), array('name' => 'Code', 'value' => 'fa-code'), array('name' => 'Mail Reply All', 'value' => 'fa-mail-reply-all'), array('name' => 'Reply All', 'value' => 'fa-reply-all'), array('name' => 'Star Half Empty', 'value' => 'fa-star-half-empty'), array('name' => 'Star Half Full', 'value' => 'fa-star-half-full'), array('name' => 'Star Half O', 'value' => 'fa-star-half-o'), array('name' => 'Location Arrow', 'value' => 'fa-location-arrow'), array('name' => 'Crop', 'value' => 'fa-crop'), array('name' => 'Code Fork', 'value' => 'fa-code-fork'), array('name' => 'Unlink', 'value' => 'fa-unlink'), array('name' => 'Chain Broken', 'value' => 'fa-chain-broken'), array('name' => 'Question', 'value' => 'fa-question'), array('name' => 'Info', 'value' => 'fa-info'), array('name' => 'Exclamation', 'value' => 'fa-exclamation'), array('name' => 'Superscript', 'value' => 'fa-superscript'), array('name' => 'Subscript', 'value' => 'fa-subscript'), array('name' => 'Eraser', 'value' => 'fa-eraser'), array('name' => 'Puzzle Piece', 'value' => 'fa-puzzle-piece'), array('name' => 'Microphone', 'value' => 'fa-microphone'), array('name' => 'Microphone Slash', 'value' => 'fa-microphone-slash'), array('name' => 'Shield', 'value' => 'fa-shield'), array('name' => 'Calendar O', 'value' => 'fa-calendar-o'), array('name' => 'Fire Extinguisher', 'value' => 'fa-fire-extinguisher'), array('name' => 'Rocket', 'value' => 'fa-rocket'), array('name' => 'Maxcdn', 'value' => 'fa-maxcdn'), array('name' => 'Chevron Circle Left', 'value' => 'fa-chevron-circle-left'), array('name' => 'Chevron Circle Right', 'value' => 'fa-chevron-circle-right'), array('name' => 'Chevron Circle Up', 'value' => 'fa-chevron-circle-up'), array('name' => 'Chevron Circle Down', 'value' => 'fa-chevron-circle-down'), array('name' => 'Html5', 'value' => 'fa-html5'), array('name' => 'Css3', 'value' => 'fa-css3'), array('name' => 'Anchor', 'value' => 'fa-anchor'), array('name' => 'Unlock Alt', 'value' => 'fa-unlock-alt'), array('name' => 'Bullseye', 'value' => 'fa-bullseye'), array('name' => 'Ellipsis H', 'value' => 'fa-ellipsis-h'), array('name' => 'Ellipsis V', 'value' => 'fa-ellipsis-v'), array('name' => 'Rss Square', 'value' => 'fa-rss-square'), array('name' => 'Play Circle', 'value' => 'fa-play-circle'), array('name' => 'Ticket', 'value' => 'fa-ticket'), array('name' => 'Minus Square', 'value' => 'fa-minus-square'), array('name' => 'Minus Square O', 'value' => 'fa-minus-square-o'), array('name' => 'Level Up', 'value' => 'fa-level-up'), array('name' => 'Level Down', 'value' => 'fa-level-down'), array('name' => 'Check Square', 'value' => 'fa-check-square'), array('name' => 'Pencil Square', 'value' => 'fa-pencil-square'), array('name' => 'External Link Square', 'value' => 'fa-external-link-square'), array('name' => 'Share Square', 'value' => 'fa-share-square'), array('name' => 'Compass', 'value' => 'fa-compass'), array('name' => 'Toggle Down', 'value' => 'fa-toggle-down'), array('name' => 'Caret Square O Down', 'value' => 'fa-caret-square-o-down'), array('name' => 'Toggle Up', 'value' => 'fa-toggle-up'), array('name' => 'Caret Square O Up', 'value' => 'fa-caret-square-o-up'), array('name' => 'Toggle Right', 'value' => 'fa-toggle-right'), array('name' => 'Caret Square O Right', 'value' => 'fa-caret-square-o-right'), array('name' => 'Euro', 'value' => 'fa-euro'), array('name' => 'Eur', 'value' => 'fa-eur'), array('name' => 'Gbp', 'value' => 'fa-gbp'), array('name' => 'Dollar', 'value' => 'fa-dollar'), array('name' => 'Usd', 'value' => 'fa-usd'), array('name' => 'Rupee', 'value' => 'fa-rupee'), array('name' => 'Inr', 'value' => 'fa-inr'), array('name' => 'Cny', 'value' => 'fa-cny'), array('name' => 'Rmb', 'value' => 'fa-rmb'), array('name' => 'Yen', 'value' => 'fa-yen'), array('name' => 'Jpy', 'value' => 'fa-jpy'), array('name' => 'Ruble', 'value' => 'fa-ruble'), array('name' => 'Rouble', 'value' => 'fa-rouble'), array('name' => 'Rub', 'value' => 'fa-rub'), array('name' => 'Won', 'value' => 'fa-won'), array('name' => 'Krw', 'value' => 'fa-krw'), array('name' => 'Bitcoin', 'value' => 'fa-bitcoin'), array('name' => 'Btc', 'value' => 'fa-btc'), array('name' => 'File', 'value' => 'fa-file'), array('name' => 'File Text', 'value' => 'fa-file-text'), array('name' => 'Sort Alpha Asc', 'value' => 'fa-sort-alpha-asc'), array('name' => 'Sort Alpha Desc', 'value' => 'fa-sort-alpha-desc'), array('name' => 'Sort Amount Asc', 'value' => 'fa-sort-amount-asc'), array('name' => 'Sort Amount Desc', 'value' => 'fa-sort-amount-desc'), array('name' => 'Sort Numeric Asc', 'value' => 'fa-sort-numeric-asc'), array('name' => 'Sort Numeric Desc', 'value' => 'fa-sort-numeric-desc'), array('name' => 'Thumbs Up', 'value' => 'fa-thumbs-up'), array('name' => 'Thumbs Down', 'value' => 'fa-thumbs-down'), array('name' => 'Youtube Square', 'value' => 'fa-youtube-square'), array('name' => 'Youtube', 'value' => 'fa-youtube'), array('name' => 'Xing', 'value' => 'fa-xing'), array('name' => 'Xing Square', 'value' => 'fa-xing-square'), array('name' => 'Youtube Play', 'value' => 'fa-youtube-play'), array('name' => 'Dropbox', 'value' => 'fa-dropbox'), array('name' => 'Stack Overflow', 'value' => 'fa-stack-overflow'), array('name' => 'Instagram', 'value' => 'fa-instagram'), array('name' => 'Flickr', 'value' => 'fa-flickr'), array('name' => 'Adn', 'value' => 'fa-adn'), array('name' => 'Bitbucket', 'value' => 'fa-bitbucket'), array('name' => 'Bitbucket Square', 'value' => 'fa-bitbucket-square'), array('name' => 'Tumblr', 'value' => 'fa-tumblr'), array('name' => 'Tumblr Square', 'value' => 'fa-tumblr-square'), array('name' => 'Long Arrow Down', 'value' => 'fa-long-arrow-down'), array('name' => 'Long Arrow Up', 'value' => 'fa-long-arrow-up'), array('name' => 'Long Arrow Left', 'value' => 'fa-long-arrow-left'), array('name' => 'Long Arrow Right', 'value' => 'fa-long-arrow-right'), array('name' => 'Apple', 'value' => 'fa-apple'), array('name' => 'Windows', 'value' => 'fa-windows'), array('name' => 'Android', 'value' => 'fa-android'), array('name' => 'Linux', 'value' => 'fa-linux'), array('name' => 'Dribbble', 'value' => 'fa-dribbble'), array('name' => 'Skype', 'value' => 'fa-skype'), array('name' => 'Foursquare', 'value' => 'fa-foursquare'), array('name' => 'Trello', 'value' => 'fa-trello'), array('name' => 'Female', 'value' => 'fa-female'), array('name' => 'Male', 'value' => 'fa-male'), array('name' => 'Gittip', 'value' => 'fa-gittip'), array('name' => 'Gratipay', 'value' => 'fa-gratipay'), array('name' => 'Sun O', 'value' => 'fa-sun-o'), array('name' => 'Moon O', 'value' => 'fa-moon-o'), array('name' => 'Archive', 'value' => 'fa-archive'), array('name' => 'Bug', 'value' => 'fa-bug'), array('name' => 'Vk', 'value' => 'fa-vk'), array('name' => 'Weibo', 'value' => 'fa-weibo'), array('name' => 'Renren', 'value' => 'fa-renren'), array('name' => 'Pagelines', 'value' => 'fa-pagelines'), array('name' => 'Stack Exchange', 'value' => 'fa-stack-exchange'), array('name' => 'Arrow Circle O Right', 'value' => 'fa-arrow-circle-o-right'), array('name' => 'Arrow Circle O Left', 'value' => 'fa-arrow-circle-o-left'), array('name' => 'Toggle Left', 'value' => 'fa-toggle-left'), array('name' => 'Caret Square O Left', 'value' => 'fa-caret-square-o-left'), array('name' => 'Dot Circle O', 'value' => 'fa-dot-circle-o'), array('name' => 'Wheelchair', 'value' => 'fa-wheelchair'), array('name' => 'Vimeo Square', 'value' => 'fa-vimeo-square'), array('name' => 'Turkish Lira', 'value' => 'fa-turkish-lira'), array('name' => 'Try', 'value' => 'fa-try'), array('name' => 'Plus Square O', 'value' => 'fa-plus-square-o'), array('name' => 'Space Shuttle', 'value' => 'fa-space-shuttle'), array('name' => 'Slack', 'value' => 'fa-slack'), array('name' => 'Envelope Square', 'value' => 'fa-envelope-square'), array('name' => 'Wordpress', 'value' => 'fa-wordpress'), array('name' => 'Openid', 'value' => 'fa-openid'), array('name' => 'Institution', 'value' => 'fa-institution'), array('name' => 'Bank', 'value' => 'fa-bank'), array('name' => 'University', 'value' => 'fa-university'), array('name' => 'Mortar Board', 'value' => 'fa-mortar-board'), array('name' => 'Graduation Cap', 'value' => 'fa-graduation-cap'), array('name' => 'Yahoo', 'value' => 'fa-yahoo'), array('name' => 'Google', 'value' => 'fa-google'), array('name' => 'Reddit', 'value' => 'fa-reddit'), array('name' => 'Reddit Square', 'value' => 'fa-reddit-square'), array('name' => 'Stumbleupon Circle', 'value' => 'fa-stumbleupon-circle'), array('name' => 'Stumbleupon', 'value' => 'fa-stumbleupon'), array('name' => 'Delicious', 'value' => 'fa-delicious'), array('name' => 'Digg', 'value' => 'fa-digg'), array('name' => 'Pied Piper', 'value' => 'fa-pied-piper'), array('name' => 'Pied Piper Alt', 'value' => 'fa-pied-piper-alt'), array('name' => 'Drupal', 'value' => 'fa-drupal'), array('name' => 'Joomla', 'value' => 'fa-joomla'), array('name' => 'Language', 'value' => 'fa-language'), array('name' => 'Fax', 'value' => 'fa-fax'), array('name' => 'Building', 'value' => 'fa-building'), array('name' => 'Child', 'value' => 'fa-child'), array('name' => 'Paw', 'value' => 'fa-paw'), array('name' => 'Spoon', 'value' => 'fa-spoon'), array('name' => 'Cube', 'value' => 'fa-cube'), array('name' => 'Cubes', 'value' => 'fa-cubes'), array('name' => 'Behance', 'value' => 'fa-behance'), array('name' => 'Behance Square', 'value' => 'fa-behance-square'), array('name' => 'Steam', 'value' => 'fa-steam'), array('name' => 'Steam Square', 'value' => 'fa-steam-square'), array('name' => 'Recycle', 'value' => 'fa-recycle'), array('name' => 'Automobile', 'value' => 'fa-automobile'), array('name' => 'Car', 'value' => 'fa-car'), array('name' => 'Cab', 'value' => 'fa-cab'), array('name' => 'Taxi', 'value' => 'fa-taxi'), array('name' => 'Tree', 'value' => 'fa-tree'), array('name' => 'Spotify', 'value' => 'fa-spotify'), array('name' => 'Deviantart', 'value' => 'fa-deviantart'), array('name' => 'Soundcloud', 'value' => 'fa-soundcloud'), array('name' => 'Database', 'value' => 'fa-database'), array('name' => 'File Pdf O', 'value' => 'fa-file-pdf-o'), array('name' => 'File Word O', 'value' => 'fa-file-word-o'), array('name' => 'File Excel O', 'value' => 'fa-file-excel-o'), array('name' => 'File Powerpoint O', 'value' => 'fa-file-powerpoint-o'), array('name' => 'File Photo O', 'value' => 'fa-file-photo-o'), array('name' => 'File Picture O', 'value' => 'fa-file-picture-o'), array('name' => 'File Image O', 'value' => 'fa-file-image-o'), array('name' => 'File Zip O', 'value' => 'fa-file-zip-o'), array('name' => 'File Archive O', 'value' => 'fa-file-archive-o'), array('name' => 'File Sound O', 'value' => 'fa-file-sound-o'), array('name' => 'File Audio O', 'value' => 'fa-file-audio-o'), array('name' => 'File Movie O', 'value' => 'fa-file-movie-o'), array('name' => 'File Video O', 'value' => 'fa-file-video-o'), array('name' => 'File Code O', 'value' => 'fa-file-code-o'), array('name' => 'Vine', 'value' => 'fa-vine'), array('name' => 'Codepen', 'value' => 'fa-codepen'), array('name' => 'Jsfiddle', 'value' => 'fa-jsfiddle'), array('name' => 'Life Bouy', 'value' => 'fa-life-bouy'), array('name' => 'Life Buoy', 'value' => 'fa-life-buoy'), array('name' => 'Life Saver', 'value' => 'fa-life-saver'), array('name' => 'Support', 'value' => 'fa-support'), array('name' => 'Life Ring', 'value' => 'fa-life-ring'), array('name' => 'Circle O Notch', 'value' => 'fa-circle-o-notch'), array('name' => 'Ra', 'value' => 'fa-ra'), array('name' => 'Rebel', 'value' => 'fa-rebel'), array('name' => 'Ge', 'value' => 'fa-ge'), array('name' => 'Empire', 'value' => 'fa-empire'), array('name' => 'Git Square', 'value' => 'fa-git-square'), array('name' => 'Git', 'value' => 'fa-git'), array('name' => 'Hacker News', 'value' => 'fa-hacker-news'), array('name' => 'Tencent Weibo', 'value' => 'fa-tencent-weibo'), array('name' => 'Qq', 'value' => 'fa-qq'), array('name' => 'Wechat', 'value' => 'fa-wechat'), array('name' => 'Weixin', 'value' => 'fa-weixin'), array('name' => 'Send', 'value' => 'fa-send'), array('name' => 'Paper Plane', 'value' => 'fa-paper-plane'), array('name' => 'Send O', 'value' => 'fa-send-o'), array('name' => 'Paper Plane O', 'value' => 'fa-paper-plane-o'), array('name' => 'History', 'value' => 'fa-history'), array('name' => 'Genderless', 'value' => 'fa-genderless'), array('name' => 'Circle Thin', 'value' => 'fa-circle-thin'), array('name' => 'Header', 'value' => 'fa-header'), array('name' => 'Paragraph', 'value' => 'fa-paragraph'), array('name' => 'Sliders', 'value' => 'fa-sliders'), array('name' => 'Share Alt', 'value' => 'fa-share-alt'), array('name' => 'Share Alt Square', 'value' => 'fa-share-alt-square'), array('name' => 'Bomb', 'value' => 'fa-bomb'), array('name' => 'Soccer Ball O', 'value' => 'fa-soccer-ball-o'), array('name' => 'Futbol O', 'value' => 'fa-futbol-o'), array('name' => 'Tty', 'value' => 'fa-tty'), array('name' => 'Binoculars', 'value' => 'fa-binoculars'), array('name' => 'Plug', 'value' => 'fa-plug'), array('name' => 'Slideshare', 'value' => 'fa-slideshare'), array('name' => 'Twitch', 'value' => 'fa-twitch'), array('name' => 'Yelp', 'value' => 'fa-yelp'), array('name' => 'Newspaper O', 'value' => 'fa-newspaper-o'), array('name' => 'Wifi', 'value' => 'fa-wifi'), array('name' => 'Calculator', 'value' => 'fa-calculator'), array('name' => 'Paypal', 'value' => 'fa-paypal'), array('name' => 'Google Wallet', 'value' => 'fa-google-wallet'), array('name' => 'Cc Visa', 'value' => 'fa-cc-visa'), array('name' => 'Cc Mastercard', 'value' => 'fa-cc-mastercard'), array('name' => 'Cc Discover', 'value' => 'fa-cc-discover'), array('name' => 'Cc Amex', 'value' => 'fa-cc-amex'), array('name' => 'Cc Paypal', 'value' => 'fa-cc-paypal'), array('name' => 'Cc Stripe', 'value' => 'fa-cc-stripe'), array('name' => 'Bell Slash', 'value' => 'fa-bell-slash'), array('name' => 'Bell Slash O', 'value' => 'fa-bell-slash-o'), array('name' => 'Trash', 'value' => 'fa-trash'), array('name' => 'Copyright', 'value' => 'fa-copyright'), array('name' => 'At', 'value' => 'fa-at'), array('name' => 'Eyedropper', 'value' => 'fa-eyedropper'), array('name' => 'Paint Brush', 'value' => 'fa-paint-brush'), array('name' => 'Birthday Cake', 'value' => 'fa-birthday-cake'), array('name' => 'Area Chart', 'value' => 'fa-area-chart'), array('name' => 'Pie Chart', 'value' => 'fa-pie-chart'), array('name' => 'Line Chart', 'value' => 'fa-line-chart'), array('name' => 'Lastfm', 'value' => 'fa-lastfm'), array('name' => 'Lastfm Square', 'value' => 'fa-lastfm-square'), array('name' => 'Toggle Off', 'value' => 'fa-toggle-off'), array('name' => 'Toggle On', 'value' => 'fa-toggle-on'), array('name' => 'Bicycle', 'value' => 'fa-bicycle'), array('name' => 'Bus', 'value' => 'fa-bus'), array('name' => 'Ioxhost', 'value' => 'fa-ioxhost'), array('name' => 'Angellist', 'value' => 'fa-angellist'), array('name' => 'Cc', 'value' => 'fa-cc'), array('name' => 'Shekel', 'value' => 'fa-shekel'), array('name' => 'Sheqel', 'value' => 'fa-sheqel'), array('name' => 'Ils', 'value' => 'fa-ils'), array('name' => 'Meanpath', 'value' => 'fa-meanpath'), array('name' => 'Buysellads', 'value' => 'fa-buysellads'), array('name' => 'Connectdevelop', 'value' => 'fa-connectdevelop'), array('name' => 'Dashcube', 'value' => 'fa-dashcube'), array('name' => 'Forumbee', 'value' => 'fa-forumbee'), array('name' => 'Leanpub', 'value' => 'fa-leanpub'), array('name' => 'Sellsy', 'value' => 'fa-sellsy'), array('name' => 'Shirtsinbulk', 'value' => 'fa-shirtsinbulk'), array('name' => 'Simplybuilt', 'value' => 'fa-simplybuilt'), array('name' => 'Skyatlas', 'value' => 'fa-skyatlas'), array('name' => 'Cart Plus', 'value' => 'fa-cart-plus'), array('name' => 'Cart Arrow Down', 'value' => 'fa-cart-arrow-down'), array('name' => 'Diamond', 'value' => 'fa-diamond'), array('name' => 'Ship', 'value' => 'fa-ship'), array('name' => 'User Secret', 'value' => 'fa-user-secret'), array('name' => 'Motorcycle', 'value' => 'fa-motorcycle'), array('name' => 'Street View', 'value' => 'fa-street-view'), array('name' => 'Heartbeat', 'value' => 'fa-heartbeat'), array('name' => 'Venus', 'value' => 'fa-venus'), array('name' => 'Mars', 'value' => 'fa-mars'), array('name' => 'Mercury', 'value' => 'fa-mercury'), array('name' => 'Transgender', 'value' => 'fa-transgender'), array('name' => 'Transgender Alt', 'value' => 'fa-transgender-alt'), array('name' => 'Venus Double', 'value' => 'fa-venus-double'), array('name' => 'Mars Double', 'value' => 'fa-mars-double'), array('name' => 'Venus Mars', 'value' => 'fa-venus-mars'), array('name' => 'Mars Stroke', 'value' => 'fa-mars-stroke'), array('name' => 'Mars Stroke V', 'value' => 'fa-mars-stroke-v'), array('name' => 'Mars Stroke H', 'value' => 'fa-mars-stroke-h'), array('name' => 'Neuter', 'value' => 'fa-neuter'), array('name' => 'Facebook Official', 'value' => 'fa-facebook-official'), array('name' => 'Pinterest P', 'value' => 'fa-pinterest-p'), array('name' => 'Whatsapp', 'value' => 'fa-whatsapp'), array('name' => 'Server', 'value' => 'fa-server'), array('name' => 'User Plus', 'value' => 'fa-user-plus'), array('name' => 'User Times', 'value' => 'fa-user-times'), array('name' => 'Hotel', 'value' => 'fa-hotel'), array('name' => 'Bed', 'value' => 'fa-bed'), array('name' => 'Viacoin', 'value' => 'fa-viacoin'), array('name' => 'Train', 'value' => 'fa-train'), array('name' => 'Subway', 'value' => 'fa-subway'), array('name' => 'Medium', 'value' => 'fa-medium'), );

global $ac_icons;
?>