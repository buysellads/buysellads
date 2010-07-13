<?php
/**
 * English Language
 *
 * @package WordPress
 * @subpackage Buy Sell Ads
 * @since 1.0
 */
$lang['plugin_title'] = 'Buy Sell Ads';
$lang['setting_title'] = 'Settings';

$lang['widget_description'] = 'Display your ad zones from BuySellAds.com';
$lang['widget_title'] = 'Title';
$lang['widget_ad_zone'] = 'Ad Zone';

$lang['settings_updated'] = 'Settings <strong>Updated</strong>.';
$lang['settings_error'] = '<strong>Error</strong>! Your Site Key could not be verified.';

$lang['site_key'] = 'Site Key';
$lang['site_key_desc'] = 'Paste your <a href="http://buysellads.com/publishers" rel="external">BuySellAds.com</a> Site Key here.';
$lang['empty_site_key'] = 'A Site key has not been added yet. <a href="%s">Add One</a>.';

$lang['bsa_body_open'] = 'Asynchronous Code';
$lang['bsa_body_open_desc'] = 'Directly after the opening <strong>&lt;body&gt;</strong> tag insert <strong>&lt;?php if (function_exists(\'wp_body_open\')) { wp_body_open(); } ?&gt;</strong>. Otherwise, the necessary code snippet will be inserted using <strong>&lt;?php wp_footer(); ?&gt;</strong>';

$lang['submit_settings'] = 'Save Settings';

$lang['callbacks_title'] = 'Ad Zone Callbacks';
$lang['callbacks_desc'] = '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>';
$lang['callbacks_id'] = 'Zone ID';
$lang['callbacks_size'] = 'Ad Size';
$lang['callbacks_type'] = 'Callback Type';
$lang['callbacks_code'] = 'Code Block';
$lang['submit_callbacks'] = 'Save Callbacks';
$lang['reset_callbacks'] = 'Reset Callbacks';
$lang['callbacks_message'] = 'Are you sure you want to reset ALL of your callback settings?';
$lang['callbacks_updated'] = 'Ad Zone Callbacks <strong>Updated</strong>.';
$lang['callbacks_error'] = 'Ad Zone Callbacks <strong>Deleted</strong>.';