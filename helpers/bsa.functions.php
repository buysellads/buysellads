<?php
/**
 * BSA Functions
 *
 * @package WordPress
 * @subpackage WP Buy Sell Ads
 * @since 1.0
 */
 
/**
 * Function to echo BSA zone code
 *
 * @since 1.0
 * @uses $bsa_plugin global variable
 *
 * @param int $ad_zone
 * @param string $site_key
 *
 * @return string
 */
if (!function_exists('bsa_zone')) 
{
  function bsa_zone($ad_zone = '', $site_key = '') 
  {
    global $bsa_plugin;
    echo $bsa_plugin->get_bsa_zone($ad_zone, $site_key);
  }
}

/**
 * Fire the wp_body_open action
 *
 * @since 1.0
 * @uses do_action() Calls 'wp_body_open' hook.
 */
if (!function_exists('wp_body_open')) 
{
  function wp_body_open() 
  {
    do_action('wp_body_open');
  }
}