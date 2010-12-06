<?php
/**
 * Functions
 *
 * @package WordPress
 * @subpackage BuySellAds
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
	  $cdn = get_option( 'buysellads_cdn', 's3.buysellads.com');
      printf("
        <!-- BuySellAds.com Ad Code -->
        <script type=\"text/javascript\">
        (function(){
          var bsa = document.createElement('script');
              bsa.type= 'text/javascript';
              bsa.async = true;
              bsa.src='//{$cdn}/ac/bsa.js';
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
 *
 * @return void
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
 * @uses get_option()
 *
 * @param int $ad_zone
 *
 * @return string
 */
if (!function_exists('get_buysellads')) 
{
  function get_buysellads($ad_zone = '') 
  {
    if ($site_key = get_option('bsa_site_key') ) 
    {
      return ("
        <!-- BuySellAds.com Zone Code -->
        <div id=\"bsap_{$ad_zone}\" class=\"bsarocks bsap_{$site_key}\"></div>
        <!-- END BuySellAds.com Zone Code -->
      ");
    }
  }
}
  
/**
 * Function to display BSA zone
 *
 * @since 1.0
 * @uses get_buysellads()
 *
 * @param int $ad_zone
 *
 * @return string
 */
if (!function_exists('buysellads')) 
{
  function buysellads($ad_zone = '') 
  {
    echo get_buysellads($ad_zone);
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
      $cdn = get_option( 'buysellads_cdn', 's3.buysellads.com');
      $json_url = "http://{$cdn}/r/s_".$bsa_site_key.".js";
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

/**
 * Function to grab the configuration information for private labels
 *
 * @since 2.0
 * @uses file_get_contents()
 * @uses json_decode()
 *
 * @return JSON array
 */
if (!function_exists('get_privatelabel_json'))
{
  function get_privatelabel_json()
  {
    $json_url = "http://s3.buysellads.com/config/wordpress.js";
    $json_contents = @file_get_contents($json_url);
    $json = json_decode($json_contents, true);
		
    // If @file_get_contents($json_url) returns true
    return $json_contents  && isset($json['networks']) ? $json['networks'] : array("title"=>"BuySellAds.com","cdn"=>"s3.buysellads.com");
  }
}

/**
 * Returns an array of CDNs for the private labels
 *
 * @since 2.0
 * @uses get_privatelabel_json()
 *
 * @return Array
 */
if (!function_exists('buysellads_cdns'))
{
  function buysellads_cdns()
  {
    $json = get_privatelabel_json();
    return array_map('buysellads_cdns_helper', $json);
  }
}

/**
 * Helper function to filter the CDNs
 *
 * @since 2.0
 *
 * @return String
 */
if (!function_exists('buysellads_cdns_helper'))
{
  function buysellads_cdns_helper($network)
  {
    return $network['cdn'];
  }
}