<?php
/**
 * Spanish Language
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


$lang['settings_updated'] = 'Settings Updated';

$lang['site_key'] = 'Site Key';
$lang['site_key_desc'] = 'Paste your BuySellAds.com Site Key here.';
$lang['empty_site_key'] = 'A Site key has not been added yet. <a href="%s">Add One</a>.';

$lang['bsa_body_open'] = 'Asynchronous Code';
$lang['bsa_body_open_desc'] = 'Directly after the opening <strong>&lt;body&gt;</strong> tag insert <strong>&lt;?php if (function_exists(\'wp_body_open\')) { wp_body_open(); } ?&gt;</strong>. Otherwise, the necessary code snippet will be inserted using <strong>&lt;?php wp_footer(); ?&gt;</strong>';