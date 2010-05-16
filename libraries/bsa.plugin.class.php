<?php
/**
 * Plugin Class
 *
 * @package WordPress
 * @subpackage WP Buy Sell Ads
 * @since 1.0
 */
class BSA_Plugin 
{
  
  /**
   * Embeds BSA AsyncJavaScript to the beginning of the body
   *
   * @since 1.0
   *
   * @return string
   */
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
  
  /**
   * Initiate the widget class
   *
   * @since 1.0
   * @uses register_widget() Calls 'BSA_Widget' class.
   *
   */
  function widget_init() 
  {
    register_widget('BSA_Widget');
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
  function get_bsa_zone($ad_zone = '', $site_key = '') 
  {
    return ("
      <!-- BuySellAds.com Zone Code -->
      <div id=\"bsap_{$ad_zone}\" class=\"bsarocks bsap_{$site_key}\"></div>
      <!-- END BuySellAds.com Zone Code -->
    ");
  }
  
}