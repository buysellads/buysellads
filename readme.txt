=== WP Buy Sell Ads ===
Contributors: valendesigns
Tags: bsa, buy sell ads, ads, ad, ad management, widget
Requires at least: 2.8
Tested up to: 3.0
Stable tag: 1.0

Official Buy Sell Ads WordPress plugin.

== Description ==

This plugin give you a simple way to insert your BSA code. You have the option to use widgets or manually insert a single function that returns your ad zone. 

== Translations ==

= Using another language =

If you haven't already, you'll need to modify your `wp-config.php` file. Open it up and look for the line: `define('WPLANG', '');`

You'll want `define('WPLANG', 'es_ES')`

Of course, you'll replace `es_ES` with the language extension that you want to use, unless of course you actually did want the Spanish language translation. Below is a list of currently available translations.

 * Spanish translation: es_ES


== Installation ==

Download and install in the plugin in the `wp-content/plugins` directory.

Activate the plugin and display your Ad Zones via the widgets menu.

If you don't want to use a widget, you can also add the following code to any one of your theme files with a .php extension:

`<?php if (function_exists('bsa_zone')) { bsa_zone($ad_zone, $site_key); } ?>`

* `$ad_zone` is the zone ID
* `$site_key` is the site key for that zone

In order for this plugin to work properly and to utilize the Asynchronous ad code, you'll need to insert a snippet into the header.php of your theme. Directly after the opening `<body>` tag insert `<?php wp_body_open(); ?>`. 

In the future, support for Asynchronous code insertion will be possible using `wp_head`. However, until IE gets on board we're just going to have to make due.


== Frequently Asked Questions ==

= How do I show the same zone in multiple locations on my webs site? =

Add a `_1`, `_2`, or `_3` ect. after the ad zone. For example, if my ad zone was `1234`, I would do `1234_1` for the the first instance, and so on.


== Screenshots ==
1. Widgets Menu

== Changelog ==

Beta Version 5/15/2010