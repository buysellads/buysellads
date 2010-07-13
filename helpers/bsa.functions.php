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
      $zones = get_backfill_zones();
      if ($zones) {
        $write_zones = "
        var BSACallback = function(zoneid){
          $zones
        };";
      }  
      printf("
        <!-- BuySellAds.com Ad Code -->
        <script type=\"text/javascript\">
        $write_zones
        (function(){
          var bsa = document.createElement('script');
              bsa.type= 'text/javascript';
              bsa.async = true;
              bsa.src='//s3.buysellads.com/ac/bsa.js';
          (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);
        })();
        </script>
        <!-- END BuySellAds.com Ad Code --> 
      ");
    }
  }
}

/**
 * Get Backfill zones content
 *
 * @since 1.0
 * @uses BSA_PLUGIN_URL
 * @uses get_option()
 *
 * @return string
 */
if (!function_exists('get_backfill_zones'))
{
  function get_backfill_zones()
  {
    $path = BSA_PLUGIN_URL;
    $buysellads_callbacks = get_option( 'buysellads_callbacks' );
    foreach($buysellads_callbacks as $id => $zone)
    {
      if ($zone['code'] && $zone['type']) {
        switch ($zone['type']) {
          case "html":
            $zones .= "
              if (zoneid == {$id})
                var str = escape('{$zone['code']}');
                return unescape(str);
              ";
            break;
          default:
            $zones .= "
              if (zoneid == {$id})
                var str = escape('<iframe src=\"{$path}/callback.php?callback=ads&id={$id}\" width=\"{$zone['width']}\" height=\"{$zone['height']}\" scrolling=\"no\" border=\"0\" style=\"border:none;overflow:hidden;\" class=\"backfill-{$id} bsa-iframe\"></iframe>');
                return unescape(str);
              ";
            break;
        }
      }
    }
    return $zones;
  }
}

/**
 * Backfill Callback
 *
 * @since 1.0
 * @uses get_option()
 *
 * @return string
 */
if (!function_exists('backfill_callback'))
{
  function backfill_callback($id = 0)
  {
    $buysellads_callbacks = get_option( 'buysellads_callbacks' );
    printf('
    <html>
      <head>
        <style type="text/css">html,body,iframe{margin:0;padding:0;border:0;outline:0;}</style>
      </head>
      <body>
        %s
      </body>
    </html>
    ',
    $buysellads_callbacks[$id]['code']
    );
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