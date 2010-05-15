<?php
/*
Plugin Name: WP Buy Sell Ads
Plugin URI: http://buysellads.com/
Description: Official Buy Sell Ads WordPress plugin.
Version: 1.0
Author: Derek Herman
Author URI: http://valendesigns.com/
License: GPL2
Text Domain: buy-sell-ads
*/

/*
  Copyright 2010  Derek Herman  (email : derek@valendesigns.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.
  
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
  
  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * BSA required files
 *
 * @since 1.0
 */
require_once('bsa.plugin.class.php');
require_once('bsa.widget.class.php');
require_once('bsa.functions.php');

/**
 * Instantiate new Buy_Sell_Ads class
 *
 * @since 1.0
 */
$buy_sell_ads = new Buy_Sell_Ads();

/**
 * Add required actions
 *
 * @uses add_action()
 *
 * @since 1.0
 */
add_action('wp_body_open', array($buy_sell_ads, 'embed_bsa_async_js'));
add_action('widgets_init', array($buy_sell_ads, 'widget_init'));

/**
 * Load i18n
 *
 * @uses load_plugin_textdomain()
 *
 * @since 1.0
 */
load_plugin_textdomain('buy-sell-ads', false, dirname( plugin_basename( __FILE__ ) ) . '/lang');