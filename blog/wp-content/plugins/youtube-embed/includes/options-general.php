<?php
/**
* General Options Page
*
* Screen for generic options
*
* @package	YouTube-Embed
* @since	2.0
*/
?>
<div class="wrap">
<?php
global $wp_version;
if ( ( float ) $wp_version >= 4.3 ) { $heading = '1'; } else { $heading = '2'; }
?>
<h<?php echo $heading; ?>><?php _e( 'YouTube Embed Options', 'youtube-embed' ); ?></h<?php echo $heading; ?>>

<?php

// If options have been updated on screen, update the database

if ( ( !empty( $_POST ) ) && ( check_admin_referer( 'youtube-embed-general', 'youtube_embed_general_nonce' ) ) ) {

	if ( isset( $_POST[ 'youtube_embed_editor_button' ] ) ) { $options[ 'editor_button' ] = $_POST[ 'youtube_embed_editor_button' ]; } else { $options[ 'editor_button' ] = ''; }
	if ( isset( $_POST[ 'youtube_embed_admin_bar' ] ) ) { $options[ 'admin_bar' ]	= $_POST[ 'youtube_embed_admin_bar' ]; } else { $options[ 'admin_bar' ] = ''; }

	$options[ 'profile_no' ] = $_POST[ 'youtube_embed_profile_no' ];
	$options[ 'list_no' ] = $_POST[ 'youtube_embed_list_no' ];
	$options[ 'alt_profile' ] = $_POST[ 'youtube_embed_alt_profile' ];
	$options[ 'feed' ] = $_POST[ 'youtube_embed_feed' ];
	$options[ 'thumbnail' ] = $_POST[ 'youtube_embed_thumbnail' ];
	$options[ 'privacy' ] = $_POST[ 'youtube_embed_privacy' ];
	$options[ 'menu_access' ] = $_POST[ 'youtube_embed_menu_access' ];
	$options[ 'language' ] = $_POST[ 'youtube_embed_language' ];
	$options[ 'script' ] = $_POST[ 'youtube_embed_script' ];

	if ( isset( $_POST[ 'youtube_embed_metadata' ] ) ) { $options[ 'metadata' ] = $_POST[ 'youtube_embed_metadata' ]; } else { $options[ 'metadata' ] = ''; }
	if ( isset( $_POST[ 'youtube_embed_frameborder' ] ) ) { $options[ 'frameborder' ] = $_POST[ 'youtube_embed_frameborder' ]; } else { $options[ 'frameborder' ] = ''; }
	if ( isset( $_POST[ 'youtube_embed_widgets' ] ) ) { $options[ 'widgets' ] = $_POST[ 'youtube_embed_widgets' ]; } else { $options[ 'widgets' ] = ''; }
	if ( isset( $_POST[ 'youtube_embed_debug' ] ) ) { $options[ 'debug' ] = $_POST[ 'youtube_embed_debug' ]; } else { $options[ 'debug' ] = ''; }
	if ( isset( $_POST[ 'youtube_embed_prompt' ] ) ) { $options[ 'prompt' ] = $_POST[ 'youtube_embed_prompt' ]; } else { $options[ 'prompt' ] = ''; }

	// If the number of profiles or lists is less than zero, put it to 0

	if ( $options[ 'profile_no' ] < 0 ) { $options[ 'profile_no' ] = 0; }
	if ( $options[ 'list_no' ] < 0 ) { $options[ 'list_no' ] = 0; }

	// Update the options

	update_option( 'youtube_embed_general', $options );
	$update_message = __( 'Settings Saved.', 'youtube-embed' );

	// Update the alternative shortcodes

	$shortcode = $_POST[ 'youtube_embed_shortcode' ];
	$shortcode = trim( $shortcode, '[]' );

	update_option( 'youtube_embed_shortcode', $shortcode );

	// If the option to clear the cache has been ticked run an SQL to clear them down

	if ( !empty( $_POST[ 'youtube_embed_clear_cache' ] ) ) {
		global $wpdb;
		$wpdb -> query( "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_%ye_video_%' OR option_name LIKE '_transient_%ye_type_%' OR option_name LIKE '_transient_%ye_title_%' OR option_name LIKE '_transient_%vye_comments_%'" );
		$update_message .= ' ' . __( 'Cache cleared.', 'youtube-embed' );
	}

	echo '<div class="updated fade"><p><strong>' . $update_message . "</strong></p></div>\n";
}

// Get options

$options = vye_set_general_defaults();
$shortcode = vye_set_shortcode_option();
?>

<p><?php _e( 'These are the general settings for YouTube Embed. Please select <a href="admin.php?page=ye-profile-options">Profiles</a> for default embedding settings.', 'youtube-embed' ); ?></p>

<form method="post" action="<?php echo get_bloginfo( 'wpurl' ).'/wp-admin/admin.php?page=ye-general-options' ?>">

<h3 class="title"><?php _e( 'Embedding', 'youtube-embed' ); ?></h3><table class="form-table">

<!-- Add Metadata -->

<tr>
<th scope="row"><label for="youtube_embed_metadata"><?php _e( 'Add Metadata', 'youtube-embed' ); ?></label></th>
<td><input type="checkbox" name="youtube_embed_metadata" value="1"<?php if ( $options[ 'metadata' ] == "1" ) { echo ' checked="checked"'; } ?>/>
<?php _e( 'Allow rich metadata to be added to code', 'youtube-embed' ); ?></td>
</tr>

<!-- Feed -->

<tr>
<th scope="row"><?php _e( 'Feed', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_feed"><select name="youtube_embed_feed">
<option value="t"<?php if ( $options[ 'feed' ] == "t" ) { echo " selected='selected'"; } ?>><?php _e ( 'Text link', 'youtube-embed' ); ?></option>
<option value="v"<?php if ( $options[ 'feed' ] == "v" ) { echo " selected='selected'"; } ?>><?php _e ( 'Thumbnail', 'youtube-embed' ); ?></option>
<option value="b"<?php if ( $options[ 'feed' ] == "b" ) { echo " selected='selected'"; } ?>><?php _e ( 'Thumbnail &amp; Text Link', 'youtube-embed' ); ?></option>
</select></label>
<p class="description"><?php _e( 'Videos cannot be embedded in feeds. Select how you wish them to be shown instead.', 'youtube-embed' ); ?></p></td>
</tr>

<!-- Feed Thumbnail -->

<tr>
<th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;<?php _e( 'Thumbnail to use', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_thumbnail"><select name="youtube_embed_thumbnail">
<option value="default"<?php if ( $options[ 'thumbnail' ] == "default" ) { echo " selected='selected'"; } ?>><?php _e ( 'Default', 'youtube-embed' ); ?></option>
<option value="hqdefault"<?php if ( $options[ 'thumbnail' ] == "hqdefault" ) { echo " selected='selected'"; } ?>><?php _e ( 'Default (HQ)', 'youtube-embed' ); ?></option>
<option value="1"<?php if ( $options[ 'thumbnail' ] == "1" ) { echo " selected='selected'"; } ?>><?php _e ( 'Start', 'youtube-embed' ); ?></option>
<option value="2"<?php if ( $options[ 'thumbnail' ] == "2" ) { echo " selected='selected'"; } ?>><?php _e ( 'Middle', 'youtube-embed' ); ?></option>
<option value="3"<?php if ( $options[ 'thumbnail' ] == "3" ) { echo " selected='selected'"; } ?>><?php _e ( 'End', 'youtube-embed' ); ?></option>
</select></label>
<p class="description"><?php _e( 'Choose which thumbnail to use.', 'youtube-embed' ); ?></p></td>
</tr>

<!-- Content Resizing Scripts -->

<tr>
<th scope="row"><?php _e( 'Content Resizing Script', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_script"><select name="youtube_embed_script">
<option value=""<?php if ( $options[ 'script' ] == "" ) { echo " selected='selected'"; } ?>><?php _e ( 'None', 'youtube-embed' ); ?></option>
<option value="f"<?php if ( $options[ 'script' ] == "f" ) { echo " selected='selected'"; } ?>><?php _e ( 'FitVids.js', 'youtube-embed' ); ?></option>
<option value="i"<?php if ( $options[ 'script' ] == "i" ) { echo " selected='selected'"; } ?>><?php _e ( 'iFrame Resizer', 'youtube-embed' ); ?></option>
</select></label>
<p class="description"><?php _e( 'Use a third party content resizing script?', 'youtube-embed' ); ?></p></td>
</tr>

</table><hr><h3 class="title"><?php _e( 'Shortcodes', 'youtube-embed' ); ?></h3><table class="form-table">

<!-- Shortcodes in Widgets -->

<tr>
<th scope="row"><?php _e( 'Allow shortcodes in widgets', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_widgets"><input type="checkbox" name="youtube_embed_widgets" value="1"<?php if ( $options[ 'widgets' ] == "1" ) { echo ' checked="checked"'; } ?>/>
<?php _e( 'Allow shortcodes to be used in widgets', 'youtube-embed' ); ?></label>
<p class="description"><?php _e( 'This will apply to <strong>all</strong> widgets.', 'youtube-embed' ); ?></p></td>
</tr>

<!-- Alternative Shortcode -->

<tr>
<th scope="row"><?php _e( 'Alternative Shortcode', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_shortcode"><input type="text" size="30" name="youtube_embed_shortcode" value="<?php echo $shortcode; ?>"/></label>
<p class="description"><?php _e( 'An alternative shortcode to use.', 'youtube-embed' ); ?></p></td>
</tr>

<!-- Alternative Shortcode Profile -->

<tr>
<th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;<?php _e( 'Profile to use', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_alt_profile"><select name="youtube_embed_alt_profile">
<?php vye_generate_profile_list( $options[ 'alt_profile' ], $options[ 'profile_no' ] ) ?>
</select></label></td>
</tr>

<!-- Shortcode Re-Use Prompt -->

<tr>
<th scope="row"><?php _e( 'Show Shortcode Re-use Prompt', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_prompt"><input type="checkbox" name="youtube_embed_prompt" value="1"<?php if ( $options[ 'prompt' ] == "1" ) { echo ' checked="checked"'; } ?>/>
<?php _e( 'Show a prompt if the main shortcode is being re-used by another plugin', 'youtube-embed' ); ?></label></td>
</tr>

</table><hr><h3 class="title"><?php _e( 'Administration Options', 'youtube-embed' ); ?></h3><table class="form-table">

<!-- Editor Button -->

<tr>
<th scope="row"><?php _e( 'Show Editor Button', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_editor_button"><input type="checkbox" name="youtube_embed_editor_button" value="1"<?php if ( $options[ 'editor_button' ] == "1" ) { echo ' checked="checked"'; } ?>/>
<?php _e( 'Show the YouTube button on the post editor', 'youtube-embed' ); ?></label></td>
</tr>

<!-- Admin Bar -->

<tr>
<th scope="row"><?php _e( 'Show Editor Button', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_admin_bar"><input type="checkbox" name="youtube_embed_admin_bar" value="1"<?php if ( $options[ 'admin_bar' ] == "1" ) { echo ' checked="checked"'; } ?>/>
<?php _e( 'Add link to options screen to Admin Bar', 'youtube-embed' ); ?></label></td>
</tr>

<!-- Menu Screen Access -->

<tr>
<th scope="row"><?php _e( 'Menu Screen Access', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_menu_access"><select name="youtube_embed_menu_access">
<option value="list_users"<?php if ( $options[ 'menu_access' ] == "list_users" ) { echo " selected='selected'"; } ?>><?php _e ( 'Administrator', 'youtube-embed' ); ?></option>
<option value="edit_pages"<?php if ( $options[ 'menu_access' ] == "edit_pages" ) { echo " selected='selected'"; } ?>><?php _e ( 'Editor', 'youtube-embed' ); ?></option>
<option value="publish_posts"<?php if ( $options[ 'menu_access' ] == "publish_posts" ) { echo " selected='selected'"; } ?>><?php _e ( 'Author', 'youtube-embed' ); ?></option>
<option value="edit_posts"<?php if ( $options[ 'menu_access' ] == "edit_posts" ) { echo " selected='selected'"; } ?>><?php _e ( 'Contributor', 'youtube-embed' ); ?></option>
</select></label>
<p class="description"><?php _e( 'Specify the user access required for the menu screens.', 'youtube-embed' ); ?></p></td>
</tr>

</table><hr><h3 class="title"><?php _e( 'Profile &amp; List Sizes', 'youtube-embed' ); ?></h3><table class="form-table">

<!-- Number of Profiles -->

<tr>
<th scope="row"><?php _e( 'Number of Profiles', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_profile_no"><input type="text" size="2" maxlength="2" name="youtube_embed_profile_no" value="<?php echo $options[ 'profile_no' ]; ?>"/></label>
<p class="description"><?php _e( 'Maximum number of profiles.', 'youtube-embed' ); ?></p></td>
</tr>

<!-- Number of Lists -->

<tr>
<th scope="row"><?php _e( 'Number of Lists', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_list_no"><input type="text" size="2" maxlength="2" name="youtube_embed_list_no" value="<?php echo $options[ 'list_no' ]; ?>"/></label>
<p class="description"><?php _e( 'Maximum number of lists.', 'youtube-embed' ); ?></p></td>
</tr>

</table><hr><h3 class="title"><?php _e( 'Security', 'youtube-embed' ); ?></h3><table class="form-table">

<!-- Privacy-Enhanced Mode -->

<tr>
<th scope="row"><?php _e( 'Privacy-Enhanced Mode', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_menu_access"><select name="youtube_embed_privacy">
<option value="0"<?php if ( $options[ 'privacy' ] == "0" ) { echo " selected='selected'"; } ?>><?php _e ( 'Cookies should always be stored', 'youtube-embed' ); ?></option>
<option value="1"<?php if ( $options[ 'privacy' ] == "1" ) { echo " selected='selected'"; } ?>><?php _e ( 'Cookies should never be stored', 'youtube-embed' ); ?></option>
<option value="2"<?php if ( $options[ 'privacy' ] == "2" ) { echo " selected='selected'"; } ?>><?php _e ( "Cookies should be stored based on user's Do Not Track setting", 'youtube-embed' ); ?></option>
</select></label>
<p class="description"><?php _e( 'Read more about <a href="http://donottrack.us/">Do Not Track</a>.', 'youtube-embed' ); ?></p></td>
</tr>

<!-- Show debug output -->

<tr>
<th scope="row"><?php _e( 'Show debug output', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_debug"><input type="checkbox" name="youtube_embed_debug" value="1"<?php if ( $options[ 'debug' ] == "1" ) { echo ' checked="checked"'; } ?>/>
<?php _e( 'Show debug output as HTML comments', 'youtube-embed' ); ?></label></td>
</tr>

</table><hr><h3 class="title"><?php _e( 'Miscellaneous', 'youtube-embed' ); ?></h3><table class="form-table">

<!-- Validation -->

<tr>
<th scope="row"><?php _e( 'Improve Validation', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_frameborder"><input type="checkbox" name="youtube_embed_frameborder" value="1"<?php if ( $options[ 'frameborder' ] == '1' ) { echo ' checked="checked"'; } ?>/>
<?php _e( 'Improve the validity of the generated markup', 'youtube-embed' ); ?></label>
<p class="description"><?php _e( 'Will extend the length of the URL, limiting the number of videos in a manual playlist. Switch off metadata for even better validation results.', 'youtube-embed' ); ?></p></td>
</tr>

<!-- Interface language -->

<tr>
<th scope="row"><?php _e( 'Interface language', 'youtube-embed' ); ?></th>
<td><label for="youtube_embed_language"><input type="text" size="5" maxlength="5" name="youtube_embed_language" value="<?php echo $options[ 'language' ]; ?>"/><?php _e( 'The player\'s interface language', 'youtube-embed' ); ?></label>
<p class="description"><?php echo __( 'The parameter value is an <a href="http://www.loc.gov/standards/iso639-2/php/code_list.php">ISO 639-1 two-letter language code</a> or a fully specified locale. For example, the current locale is ', 'youtube-embed' ) . strtolower( str_replace( '_', '-', get_locale() ) ) . '.'; ?></p></td>
</tr>

</table>

<?php wp_nonce_field( 'youtube-embed-general','youtube_embed_general_nonce', true, true ); ?>

<p class="submit"><input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save Changes', 'youtube-embed' ); ?>"/></p>

</form>

</div>