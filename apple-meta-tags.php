<?php
/*
 * Plugin Name: Apple Meta Tags
 * Plugin URI: http://www.sebs-studio.com/wp-plugins/wordpress-apple-tags/
 * Description: Helps inserts the Apple Meta Tags you require in the header of your site.
 * Version: 1.0.0
 * Author: Sebs Studio
 * Author URI: http://www.sebs-studio.com
 *
 * Text Domain: apple_meta_tags
 * Domain Path: /languages/
 *
 * Copyright 2013  Sebastien Dumont  (email : sebastien@sebs-studio.com)
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 */

/* Localisation */
$locale = apply_filters('plugin_locale', get_locale(), 'apple-meta-tags');
load_textdomain('apple_meta_tags', WP_PLUGIN_DIR."/".plugin_basename(dirname(__FILE__)).'/languages/'.$locale.'.mo');
load_plugin_textdomain('apple_meta_tags', false, dirname(plugin_basename(__FILE__)).'/languages/');

/* Create plugin settings menu. */
add_action('admin_menu', 'apple_meta_tags_create_menu');
function apple_meta_tags_create_menu(){
	//create new settings menu
	add_options_page(__('Apple Meta Tags Settings', 'apple_meta_tags'), __('Apple Meta Tags', 'apple_meta_tags'), 'administrator', __FILE__, 'apple_meta_tags_settings_page');

	//call register settings function
	add_action('admin_init', 'register_apple_meta_tags_settings');
}

/* Register plugin options. */
function register_apple_meta_tags_settings(){
	/* Web App Mode */
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_web_app_mode');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_web_app_status_bar_style');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_web_app_title');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_use_viewport');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_viewport');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_telephone');
	/* Fav Icons */
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_favicon');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_favicon_png');
	/* Touch Icons */
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_touch_icon_precomposed');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_default_touch_icon');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_touch_icon_57');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_touch_icon_72');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_touch_icon_114');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_touch_icon_144');
	/* Startup Screens */
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_use_startup_screen');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_startup_screen_320_460');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_startup_screen_640_920');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_startup_screen_640_1096');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_startup_screen_768_1004');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_startup_screen_1024_748');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_startup_screen_1536_2008');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_startup_screen_2048_1496');
	/* Apple App Store */
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_use_smart_app_banner');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_app_store_id');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_affiliate_id');
	register_setting('apple-meta-tags-settings-group', 'apple_meta_tags_app_argument');
}

/* Plugin settings page. */
function apple_meta_tags_settings_page(){
?>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('.upload').click(function(){
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);

		wp.media.editor.send.attachment = function(props, attachment){
			$(button).prev().prev().attr('src', attachment.url);
			$(button).prev().val(attachment.url);
			wp.media.editor.send.attachment = send_attachment_bkp;
		}

		wp.media.editor.open(button);

		return false;
	});
});
</script>
<div class="wrap">
<?php screen_icon(); ?>
<h2><?php echo __('Apple Meta Tags Settings', 'apple_meta_tags'); ?></h2>

<form method="post" action="options.php">

	<?php settings_fields('apple-meta-tags-settings-group'); ?>
	<?php do_settings_sections('apple-meta-tags-settings-group'); ?>

	<table class="form-table">

		<tr valign="top">
			<th scope="row"><?php echo __('Enable iOS Web-App Mode', 'apple_meta_tags'); ?></th>
			<td>
			<select name="apple_meta_tags_web_app_mode">
				<option value="no"<?php if(get_option('apple_meta_tags_web_app_mode') == 'no'){ echo ' selected="selected"'; } ?>><?php echo __('No', 'apple_meta_tags'); ?></option>
				<option value="yes"<?php if(get_option('apple_meta_tags_web_app_mode') == 'yes'){ echo ' selected="selected"'; } ?>><?php echo __('Yes', 'apple_meta_tags'); ?></option>
			</select>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('Web App Status Bar Color', 'apple_meta_tags'); ?></th>
			<td>
			<select name="apple_meta_tags_web_app_status_bar_style">
				<option value="default"<?php if(get_option('apple_meta_tags_web_app_status_bar_style') == 'default'){ echo ' selected="selected"'; } ?>><?php echo __('Default (Grey)', 'apple_meta_tags'); ?></option>
				<option value="black"<?php if(get_option('apple_meta_tags_web_app_status_bar_style') == 'black'){ echo ' selected="selected"'; } ?>><?php echo __('Black', 'apple_meta_tags'); ?></option>
				<option value="black-translucent"<?php if(get_option('apple_meta_tags_web_app_status_bar_style') == 'black-translucent'){ echo ' selected="selected"'; } ?>><?php echo __('Black Translucent', 'apple_meta_tags'); ?></option>
			</select>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('Web App Title', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_web_app_title" value="<?php echo get_option('apple_meta_tags_web_app_title'); ?>" /></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('Use Viewport', 'apple_meta_tags'); ?></th>
			<td>
			<select name="apple_meta_tags_use_viewport">
				<option value="no"<?php if(get_option('apple_meta_tags_use_viewport') == 'no'){ echo ' selected="selected"'; } ?>><?php echo __('No', 'apple_meta_tags'); ?></option>
				<option value="yes"<?php if(get_option('apple_meta_tags_use_viewport') == 'yes'){ echo ' selected="selected"'; } ?>><?php echo __('Yes', 'apple_meta_tags'); ?></option>
			</select>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('Viewport', 'apple_meta_tags'); ?></th>
			<td>
			<select name="apple_meta_tags_viewport">
				<option value="default"<?php if(get_option('apple_meta_tags_viewport') == 'default'){ echo ' selected="selected"'; } ?>><?php echo 'width=device-width, initial-scale=1.0'; ?></option>
				<option value="initial-one-max-one"<?php if(get_option('apple_meta_tags_viewport') == 'initial-one-max-one'){ echo ' selected="selected"'; } ?>><?php echo 'initial-scale=1.0, maximum-scale=1.0'; ?></option>
				<option value="initial-one-max-one-user-no"<?php if(get_option('apple_meta_tags_viewport') == 'initial-one-max-one-user-no'){ echo ' selected="selected"'; } ?>><?php echo 'initial-scale=1.0; maximum-scale=1.0; user-scalable=no'; ?></option>
				<option value="initial-one-max-one-user-yes"<?php if(get_option('apple_meta_tags_viewport') == 'initial-one-max-one-user-yes'){ echo ' selected="selected"'; } ?>><?php echo 'initial-scale=1.0; maximum-scale=1.0; user-scalable=yes'; ?></option>
				<option value="width-device-initial-one-max-one-user-no"<?php if(get_option('apple_meta_tags_viewport') == 'width-device-initial-one-max-one-user-no'){ echo ' selected="selected"'; } ?>><?php echo 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'; ?></option>
				<option value="width-device-initial-one-max-one-user-yes"<?php if(get_option('apple_meta_tags_viewport') == 'width-device-initial-one-max-one-user-yes'){ echo ' selected="selected"'; } ?>><?php echo 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes'; ?></option>
			</select>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('Detect Telephone Numbers', 'apple_meta_tags'); ?></th>
			<td>
			<select name="apple_meta_tags_telephone">
				<option value="no"<?php if(get_option('apple_meta_tags_telephone') == 'no'){ echo ' selected="selected"'; } ?>><?php echo __('No', 'apple_meta_tags'); ?></option>
				<option value="yes"<?php if(get_option('apple_meta_tags_telephone') == 'yes'){ echo ' selected="selected"'; } ?>><?php echo __('Yes', 'apple_meta_tags'); ?></option>
			</select>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">Favicon (.favicon)</th>
			<td><input type="text" name="apple_meta_tags_favicon" value="<?php echo get_option('apple_meta_tags_favicon'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a></td>
		</tr>

		<tr valign="top">
			<th scope="row">Favicon (.png)</th>
			<td><input type="text" name="apple_meta_tags_favicon_png" value="<?php echo get_option('apple_meta_tags_favicon_png'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('Touch Icon Precomposed', 'apple_meta_tags'); ?></th>
			<td>
			<select name="apple_meta_tags_touch_icon_precomposed">
				<option value="no"<?php if(get_option('apple_meta_tags_touch_icon_precomposed') == 'no'){ echo ' selected="selected"'; } ?>><?php echo __('No', 'apple_meta_tags'); ?></option>
				<option value="yes"<?php if(get_option('apple_meta_tags_touch_icon_precomposed') == 'yes'){ echo ' selected="selected"'; } ?>><?php echo __('Yes', 'apple_meta_tags'); ?></option>
			</select>
			<span><?php echo __('Use glossy bookmark icon.', 'apple_meta_tags'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('URL to iPod Touch Icon', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_default_touch_icon" value="<?php echo get_option('apple_meta_tags_default_touch_icon'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>(.png)</span></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('URL to iPad Touch Icon', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_touch_icon_57" value="<?php echo get_option('apple_meta_tags_touch_icon_57'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>(57x57) (.png)</span></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('URL to iPad Touch Icon', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_touch_icon_72" value="<?php echo get_option('apple_meta_tags_touch_icon_72'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>(72x72) (.png)</span></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('URL to iPhone 4 Touch Icon', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_touch_icon_114" value="<?php echo get_option('apple_meta_tags_touch_icon_114'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>(114x114) (.png)</span></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('URL to iPhone 5 Touch Icon', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_touch_icon_144" value="<?php echo get_option('apple_meta_tags_touch_icon_144'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>(144x144) (.png) (iOS 5+)</span></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('Use Startup Screens', 'apple_meta_tags'); ?></th>
			<td>
			<select name="apple_meta_tags_use_startup_screen">
				<option value="no"<?php if(get_option('apple_meta_tags_use_startup_screen') == 'no'){ echo ' selected="selected"'; } ?>><?php echo __('No', 'apple_meta_tags'); ?></option>
				<option value="yes"<?php if(get_option('apple_meta_tags_use_startup_screen') == 'yes'){ echo ' selected="selected"'; } ?>><?php echo __('Yes', 'apple_meta_tags'); ?></option>
			</select>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('URL to iPhone Portrait startup screen', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_startup_screen_320_460" value="<?php echo get_option('apple_meta_tags_startup_screen_320_460'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>(320x460) (.png)</span></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('URL to Retina Portrait iPhone startup screen', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_startup_screen_640_920" value="<?php echo get_option('apple_meta_tags_startup_screen_640_920'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>(640x920) (.png) (iOS 5+)</span></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('URL to 4-inch Portrait Retina iPhone startup screen', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_startup_screen_640_1096" value="<?php echo get_option('apple_meta_tags_startup_screen_640_1096'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>(640x1096) (.png) (iOS 6+)</span></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('URL to iPad Portrait startup screen', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_startup_screen_768_1004" value="<?php echo get_option('apple_meta_tags_startup_screen_768_1004'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>(768x1004) (.png)</span></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('URL to iPad Landscape startup screen', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_startup_screen_1024_748" value="<?php echo get_option('apple_meta_tags_startup_screen_1024_748'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>(1024x748) (.png) (iOS 5+)</span></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('URL to Retina iPad Portrait startup screen', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_startup_screen_1536_2008" value="<?php echo get_option('apple_meta_tags_startup_screen_1536_2008'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>(1536x2008) (.png) (iOS 5+)</span></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('URL to Retina iPad Landscape startup screen', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_startup_screen_2048_1496" value="<?php echo get_option('apple_meta_tags_startup_screen_2048_1496'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>(2048x1496) (.png) (iOS 5+)</span></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('Use Smart App Banner (iOS6+)', 'apple_meta_tags'); ?></th>
			<td>
			<select name="apple_meta_tags_use_smart_app_banner">
				<option value="no"<?php if(get_option('apple_meta_tags_use_smart_app_banner') == 'no'){ echo ' selected="selected"'; } ?>><?php echo __('No', 'apple_meta_tags'); ?></option>
				<option value="yes"<?php if(get_option('apple_meta_tags_use_smart_app_banner') == 'yes'){ echo ' selected="selected"'; } ?>><?php echo __('Yes', 'apple_meta_tags'); ?></option>
			</select>
			  <span><?php echo __('Safari has a Smart App Banner feature in iOS 6 and later that provides a standardized method of promoting apps on the App Store from your website.', 'apple_meta_tags'); ?> <a href="http://developer.apple.com/library/ios/#documentation/AppleApplications/Reference/SafariWebContent/PromotingAppswithAppBanners/PromotingAppswithAppBanners.html" target="_blank"><?php echo __('Read for more information', 'apple_meta_tags'); ?></a></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('App Store ID', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_app_store_id" value="<?php echo get_option('apple_meta_tags_app_store_id'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>e.g. app-id=362872995</span></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('Affiliate ID', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_affiliate_id" value="<?php echo get_option('apple_meta_tags_affiliate_id'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>e.g. bevbOqLt02I</span></td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php echo __('App Argument', 'apple_meta_tags'); ?></th>
			<td><input type="text" name="apple_meta_tags_app_argument" value="<?php echo get_option('apple_meta_tags_app_argument'); ?>" /> <a href="#" class="button upload"><?php echo __('Upload', 'apple_meta_tags'); ?></a> <span>e.g. digg://</span></td>
		</tr>

	</table>
    
	<?php submit_button(); ?>

</form>
</div>
<?php
}

/* Register WordPress Media Manager/Uploader */
function register_media_uploader(){
	if(function_exists('wp_enqueue_media')){
		wp_enqueue_media();
	}
	else{
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}
}
add_action('admin_enqueue_scripts', 'register_media_uploader');

/* Display the meta tags in the header. */
function display_wordpress_apple_tags(){
	/* Web App Mode */
	$web_app_mode = get_option('apple_meta_tags_web_app_mode');
	$web_app_status_bar_style = get_option('apple_meta_tags_web_app_status_bar_style');
	$web_app_title = get_option('apple_meta_tags_web_app_title');
	$viewport = get_option('apple_meta_tags_viewport');
	$use_viewport = get_option('apple_meta_tags_use_viewport');
	$telephone = get_option('apple_meta_tags_telephone');
	/* Fav Icons */
	$favicon = get_option('apple_meta_tags_favicon');
	$favicon_png = get_option('apple_meta_tags_favicon_png');
	/* Touch Icons */
	$touch_icon_precomposed = get_option('apple_meta_tags_touch_icon_precomposed');
	$default_touch_icon = get_option('apple_meta_tags_default_touch_icon');
	$touch_icon_57 = get_option('apple_meta_tags_touch_icon_57');
	$touch_icon_72 = get_option('apple_meta_tags_touch_icon_72');
	$touch_icon_114 = get_option('apple_meta_tags_touch_icon_114');
	$touch_icon_144 = get_option('apple_meta_tags_touch_icon_144');
	/* Startup Screens */
	$use_startup_screen = get_option('apple_meta_tags_use_startup_screen');
	$startup_screen_460 = get_option('apple_meta_tags_startup_screen_320_460');
	$startup_screen_920 = get_option('apple_meta_tags_startup_screen_640_920');
	$startup_screen_1096 = get_option('apple_meta_tags_startup_screen_640_1096');
	$startup_screen_1004 = get_option('apple_meta_tags_startup_screen_768_1004');
	$startup_screen_1024 = get_option('apple_meta_tags_startup_screen_1024_748');
	$startup_screen_2008 = get_option('apple_meta_tags_startup_screen_1536_2008');
	$startup_screen_1496 = get_option('apple_meta_tags_startup_screen_2048_1496');
	/* Apple App Store */
	$smart_app_banner = get_option('apple_meta_tags_use_smart_app_banner');
	$app_store_id = get_option('apple_meta_tags_app_store_id');
	$affiliate_id = get_option('apple_meta_tags_affiliate_id');
	$app_argument = get_option('apple_meta_tags_app_argument');

	if($touch_icon_precomposed == 'yes'){ $touch_icon_precomposed = '-precomposed'; }else{ $touch_icon_precomposed = ''; }

	/* Apple App Store */
	if($smart_app_banner == 'yes'){ echo '<meta name="apple-itunes-app" content="app-id='.$app_store_id.', affiliate-data='.$affiliate_id.', app-argument='.$app_argument.'">'."\n"; }
	/* Web App Mode */
	if($web_app_mode == 'yes'){
		echo '<meta name="apple-mobile-web-app-capable" content="yes" />'."\n".
		'<meta name="apple-mobile-web-app-status-bar-style" content="'.$web_app_status_bar_style.'" />'."\n";
		if($web_app_title){ echo '<meta name="apple-mobile-web-app-title" content="'.$web_app_title.'" />'."\n"; }
	}
	/* Viewport */
	if($viewport && $use_viewport == 'yes'){
		echo '<!-- standard viewport tag. -->'."\n";
		if($viewport == 'default'){ echo '<meta name="viewport" content="width=device-width, initial-scale=1" />'."\n"; }
		if($viewport == 'initial-one-max-one'){ echo '<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0" />'."\n"; }
		if($viewport == 'initial-one-max-one-user-no'){ echo '<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; user-scalable=no" />'."\n"; }
		if($viewport == 'initial-one-max-one-user-yes'){ echo '<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; user-scalable=yes" />'."\n"; }
		if($viewport == 'width-device-initial-one-max-one-user-no'){ echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />'."\n"; }
		if($viewport == 'width-device-initial-one-max-one-user-yes'){ echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />'."\n"; }
		if($web_app_mode == 'yes'){
			echo '<!-- width=device-width causes the iPhone 5 to letterbox the web app, so we want to exclude it for iPhone 5 to allow the web app use the full screen. -->'."\n";
			echo '<meta name="viewport" id="vp" content="initial-scale=1.0,user-scalable=no,maximum-scale=1" media="(device-height: 568px)" />'."\n";
		}
	}
	/* Telephone Detection */
	if($telephone){ echo '<meta name="format-detection" content="telephone='.$telephone.'" />'."\n"; }
	/* Touch Icons */
	if($default_touch_icon){ echo '<link rel="apple-touch-icon'.$touch_icon_precomposed.'" href="'.$default_touch_icon.'" />'."\n"; }
	if($touch_icon_57){ echo '<link rel="apple-touch-icon'.$touch_icon_precomposed.'" sizes="57x57" href="'.$touch_icon_57.'">'."\n"; }
	if($touch_icon_72){ echo '<link rel="apple-touch-icon'.$touch_icon_precomposed.'" sizes="72x72" href="'.$touch_icon_72.'" />'."\n"; }
	if($touch_icon_114){ echo '<link rel="apple-touch-icon'.$touch_icon_precomposed.'" sizes="114x114" href="'.$touch_icon_114.'" />'."\n"; }
	if($touch_icon_144){ echo '<link rel="apple-touch-icon'.$touch_icon_precomposed.'" sizes="144x144" href="'.$touch_icon_144.'" />'."\n"; }
	/* Favicon */
	if($favicon){
		echo '<link rel="shortcut icon" href="'.$favicon.'" type="image/x-icon" />'."\n".
		'<link rel="shortcut icon" href="'.$favicon.'" type="image/ico" />'."\n";
	}
	if($favicon_png){ echo '<link rel="icon" type="image/png" href="'.$favicon_png.'" />'."\n"; }
	/* Startup Screens */
	if($use_startup_screen == 'yes'){
		if($startup_screen_460){ echo '<link href="'.$startup_screen_460.'" sizes="320x460" media="screen and (device-width : 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image" />'."\n"; }
		if($startup_screen_920){ echo '<link href="'.$startup_screen_920.'" sizes="640x920" media="screen and (device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />'."\n"; }
		if($startup_screen_1096){ echo '<link href="'.$startup_screen_1096.'" sizes="640x1096" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />'."\n"; }
		if($startup_screen_1004){ echo '<link href="'.$startup_screen_1004.'" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait)" rel="apple-touch-startup-image" />'."\n"; }
		if($startup_screen_2008){ echo '<link href="'.$startup_screen_2008.'" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />'."\n"; }
		if($startup_screen_1024){ echo '<link href="'.$startup_screen_1024.'" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape)" rel="apple-touch-startup-image" />'."\n"; }
		if($startup_screen_1496){ echo '<link href="'.$startup_screen_1496.'" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />'."\n"; }
	}
}
add_action('wp_head', 'display_wordpress_apple_tags');
?>