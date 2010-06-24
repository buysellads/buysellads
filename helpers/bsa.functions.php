<?php
/**
 * Functions
 *
 * @package WordPress
 * @subpackage Buy Sell Ads
 * @since 1.0
 */

/**
 * Embeds BSA Asynchronous JavaScript
 *
 * @since 1.0
 *
 * @return string
 */
if (!function_exists('embed_bsa_async_js')) 
{
  function embed_bsa_async_js() 
  {
    if (!is_admin()) {
      printf("
        <!-- BuySellAds.com Ad Code -->
        <script type=\"text/javascript\">
        (function(){
          var bsa = document.createElement('script');
             bsa.type = 'text/javascript';
             bsa.async = true;
             bsa.src = '//s3.buysellads.com/ac/bsa.js';
          (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);
        })();
        </script>
        <!-- END BuySellAds.com Ad Code --> 
      ");
    }
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

/**
 * Returns BSA zone code
 *
 * @since 1.0
 *
 * @param int $ad_zone
 * @param string $site_key
 *
 * @return string
 */
if (!function_exists('get_buysellads')) 
{
  function get_buysellads($ad_zone = '', $site_key = '') 
  {
    return ("
      <!-- BuySellAds.com Zone Code -->
      <div id=\"bsap_{$ad_zone}\" class=\"bsarocks bsap_{$site_key}\"></div>
      <!-- END BuySellAds.com Zone Code -->
    ");
  }
}
  
/**
 * Function to display BSA zone
 *
 * @since 1.0
 * @uses get_buysellads()
 *
 * @param int $ad_zone
 * @param string $site_key
 *
 * @return string
 */
if (!function_exists('buysellads')) 
{
  function buysellads($ad_zone = '', $site_key = '') 
  {
    echo get_buysellads($ad_zone, $site_key);
  }
}

/**
 * Function to grab BSA zones
 *
 * @since 1.0
 * @uses file_get_contents()
 * @uses json_decode()
 *
 * @return JSON array
 */
if (!function_exists('get_buysellads_json'))
{
  function get_buysellads_json()
  {
    if ($bsa_site_key = get_option('bsa_site_key'))
    {
      $json_url = "http://s3.buysellads.com/r/s_".$bsa_site_key.".js";
      $json_contents = @file_get_contents($json_url);
      
      // If @file_get_contents($json_url) returns true
      if ($json_contents) 
      {
        // Decode & return json data
        return json_decode(substr( $json_contents, 21, -2), true);
      }
    }
  }
}