=== Buy Sell Ads ===
Contributors: valendesigns
Donate link: http://bit.ly/c79XHw
Tags: bsa, buy sell ads, ads, ad, ad management, widget, callback, backfill, adsense
Requires at least: 2.8
Tested up to: 3.0
Stable tag: 1.0

Official BuySellAds.com WordPress plugin.

== Description ==

This official BuySellAds.com WordPress plugin gives you two extremely simple ways to insert your BSA code. You have the option to use Widgets or manually insert a single function that returns your desired Ad Zone. Also, you can now backfill your CPM based Ad Zones with other Ad Network code snippets or your own custom HTML.

== Installation ==

* Download and install the plugin in the `wp-content/plugins` directory.
* Activate the plugin in WordPress. 
* Go to `Buy Sell Ads->Settings` and insert your Site Key.
* Display your Ad Zones via the widgets menu found at `Appearance->Widgets`.
* If you don't want to use Widgets, you can also add the following code to any one of your theme files with a .php extension:
  * `<?php if (function_exists('buysellads')) { buysellads($ad_zone); } ?>`
  * `$ad_zone` signifies the zone ID, you must have a Site Key before the code will work.
* In order for this plugin to work properly and to utilize the Asynchronous ad code, you'll need to insert a snippet into the header.php of your theme. Directly after the opening `<body>` tag insert `<?php if (function_exists('wp_body_open')) { wp_body_open(); } ?>`. 
* In the future, support for Asynchronous code insertion will be possible using `wp_head`. However, until IE 6 & 7 have significantly less market share, we're just going to have to make due with adding a simple hook to the header.php. If you don't want to use the `wp_body_open()` code in the header.php the plugin will use `wp_footer()` instead to insert the necessary BSA JavaScript code. However, you will need to verify your theme is using one of the two options available above.

== Frequently Asked Questions ==

= Is this plugin PHP5 only? =

Yes!

= Why is the Spanish Translation in English? =

I will modify the translation once people have used the plugin. I want to make sure that the text is clear & concise in English first, then I'll add support for other languages shortly after.

== Screenshots ==
1. Settings Page
2. Widgets Menu

== Changelog ==

= 1.0 =
* First Release 7/19/2010

== Upgrade Notice ==

= None =

== Translations ==

= Using another language =

If you haven't already, you'll need to modify your `wp-config.php` file. Open it up and look for the line: `define('WPLANG', '');`

You should change it to `define('WPLANG', 'es_ES')` of course, you'll replace `es_ES` with the language extension that you want to use, unless you actually did want the Spanish language translation. 

* List of currently available translations.
  * Spanish translation: es_ES