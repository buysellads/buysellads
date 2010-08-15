<?php
/*
Plugin Name: BuySellAds
Plugin URI: http://buysellads.com/
Description: Official BuySellAds.com WordPress plugin.
Version: 1.1
Author: Derek Herman
Author URI: http://valendesigns.com/
License: GPL3
*/

/*
  Copyright 2010  BuySellAds.com  (email : derek@valendesigns.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 3, as 
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
 * Define the plugin directory path & URL
 *
 * @since 1.0
 */
define( 'BSA_PLUGIN_DIR', WP_PLUGIN_DIR.'/'.dirname( plugin_basename( __FILE__ ) ) );
define( 'BSA_PLUGIN_URL', WP_PLUGIN_URL.'/'.dirname( plugin_basename( __FILE__ ) ) );

/**
 * BSA required files
 *
 * @since 1.0
 */
require_once('libraries/bsa.language.class.php');
require_once('libraries/bsa.plugin.class.php');
require_once('libraries/bsa.widget.class.php');
require_once('helpers/bsa.functions.php');

/**
 * Instantiate classes
 *
 * @since 1.0
 */
$bsa_plugin = new BSA_Plugin();
$bsa_lang  = new BSA_Language();

/**
 * Load Translations
 *
 * @uses BSA_Language class
 *
 * @since 1.0
 */
$bsa_lang->load('admin');

/**
 * Add required actions
 *
 * @uses add_action()
 * @uses get_option()
 *
 * @since 1.0
 */
add_action( 'widgets_init', array( $bsa_plugin, 'widget_init' ) );
add_action( 'admin_menu', array( $bsa_plugin, 'bsa_admin' ) );
add_action( ( (get_option( 'bsa_body_open' ) == 1) ? 'wp_body_open' : 'wp_footer' ), 'embed_bsa_async_js' );