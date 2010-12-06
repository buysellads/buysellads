<?php
/**
 * Plugin Class
 *
 * @package WordPress
 * @subpackage BuySellAds
 * @since 1.0
 */
class BSA_Plugin 
{

  /**
   * Initiate the widget class
   *
   * @since 1.0
   * @uses register_widget() Calls 'BSA_Widget' class.
   *
   * @return void
   */
  function widget_init() 
  {
    register_widget('BSA_Widget');
  }
  
  /**
   * Add Menu Item
   *
   * @since 1.0
   * @uses add_object_page()
   * @uses add_submenu_page()
   *
   * @return void
   */
  function bsa_admin() 
  {
    global $bsa_lang;
    
    // Grab language text
    $plugin_title = $bsa_lang->line('plugin_title');
    $setting_title = $bsa_lang->line('setting_title');
    
    // Set Menu Icon
    $icon = BSA_PLUGIN_URL.'/assets/images/icon.png';
    
    // Create Menu Items
    add_object_page( $plugin_title, $plugin_title, 'upload_files', 'bsa_settings', array( $this, 'bsa_admin_settings' ), $icon );
    $bsa_admin_page = add_submenu_page( 'bsa_settings', $plugin_title, $setting_title, 'upload_files', 'bsa_settings', array( $this, 'bsa_admin_settings' ) );
    
    // Add Menu Items
    add_action("admin_print_styles-$bsa_admin_page", array( $this, 'bsa_admin_load' ) );
  
  }
  
  /**
   * Load Scripts & Styles
   *
   * @since 1.0
   * @uses wp_enqueue_style()
   * @uses wp_enqueue_script()
   *
   * @return void
   */
  function bsa_admin_load()
  {
    // Enqueue Styles
    wp_enqueue_style('bsa-css', BSA_PLUGIN_URL.'/assets/css/buysellads.css', false, false, 'screen');
    
    // Enqueue Scripts
    wp_enqueue_script('bsa-js', BSA_PLUGIN_URL.'/assets/js/buysellads.js', array('jquery'), false);
    
  }
  
  /**
   * Update/Save Callback Data
   *
   * @since 1.0
   * @uses stripslashes_deep()
   * @uses get_option()
   * @uses update_option()
   *
   * @return void
   */
  function bsa_update_callbacks()
  {
    // new options
    $buysellads_callbacks_new = stripslashes_deep( $_POST['buysellads_callbacks'] );

    // current options
    $buysellads_callbacks_current = get_option( 'buysellads_callbacks' );
    
    // Update options
    foreach($buysellads_callbacks_new as $key => $value) {
      $buysellads_callbacks_current[$key] = $value;
    }

    update_option( 'buysellads_callbacks' , $buysellads_callbacks_current);
  }
  
  /**
   * Delete Callback Data
   *
   * @since 1.0
   * @uses delete_option()
   *
   * @return void
   */
  function bsa_delete_callbacks()
  {
    delete_option( 'buysellads_callbacks' );
  }
  
  /**
   * Load Scripts & Styles
   *
   * @since 1.0
   *
   * @return string
   */
  function bsa_admin_settings()
  {
    global $bsa_lang;
    
    if( isset($_POST[ 'option_values' ]) && $_POST[ 'option_values' ] == 'save' ) 
    {
      // Check Referer
      check_admin_referer( 'buysellads_settings' );
      
      // Read posted value
      $bsa_site_key = $_POST[ 'bsa_site_key' ];
      $bsa_body_open = $_POST[ 'bsa_body_open' ];

      // Save posted values
      update_option( 'bsa_site_key', $bsa_site_key );
      update_option( 'bsa_body_open', $bsa_body_open );
	  
	  // new cdn
	  $buysellads_cdn = $_POST['buysellads_cdn'];
	  $cdns = buysellads_cdns();
	
	  // Make sure the CDN is valid before saving it.
      update_option( 'buysellads_cdn' , (in_array($buysellads_cdn, $cdns) ? $buysellads_cdn : 's3.buysellads.com'));
      
      $json_data = get_buysellads_json();
      if ($json_data)
      {
        // Success Message
        printf( '<div class="updated fade"><p>%s</p></div>', $bsa_lang->line('settings_updated') );
      }
      else
      {
        // Error Message
        printf( '<div class="error fade"><p>%s</p></div>', $bsa_lang->line('settings_error') );
        delete_option( 'bsa_site_key' );
      }
    }
    ?>
    <div class="wrap" id="buysellads">
      <h2><?php echo $bsa_lang->line('plugin_title'); ?></h2>
      <form method="post" action="">
        <table class="form-table">
          <tbody>
            <tr valign="top">
              <th scope="row">
                <label for="bsa_site_key"><?php echo $bsa_lang->line('site_key'); ?></label>
              </th>
              <td>
                <input type="text" class="regular-text" value="<?php echo get_option('bsa_site_key'); ?>" id="bsa_site_key" name="bsa_site_key">
                <span class="description"><?php echo $bsa_lang->line('site_key_desc'); ?></span>
              </td>
            </tr>

            <tr valign="top">
              <th scope="row">
                <label for="bsa_network"><?php echo $bsa_lang->line('network'); ?></label>
              </th>
              <td>
				<select  id="bsa_network" name="buysellads_cdn">
				<?php foreach(get_privatelabel_json() as $network): ?>
					  <option <?php echo(stripos($network['cdn'], get_option('buysellads_cdn', 's3.buysellads.com')) === false ? '' : 'selected'); ?> value=<?php echo("\"{$network['cdn']}\""); ?> ><?php echo (htmlspecialchars($network['title'])); ?></option>
				<?php endforeach; ?>
				</select>
              </td>
            </tr>

            <tr valign="top">
              <th scope="row"><?php echo $bsa_lang->line('bsa_body_open'); ?></th>
              <td> 
                <fieldset>
                  <legend class="screen-reader-text"><span><?php echo $bsa_lang->line('bsa_body_open'); ?></span></legend>
                  <label for="bsa_body_open">
                    <input type="checkbox" value="1" id="bsa_body_open" name="bsa_body_open"<?php echo (get_option('bsa_body_open') == 1) ? ' checked="checked"': ''; ?>> Use <strong>wp_body_open()</strong>
                  </label>
                  <p><span class="description"><?php echo $bsa_lang->line('bsa_body_open_desc'); ?></span></p>
                </fieldset>
              </td>
            </tr>
          </tbody>
        </table>
        <?php 
        if ( function_exists( 'wp_nonce_field' ) && wp_nonce_field( 'buysellads_settings' ) ) {
          printf('
          <p class="submit">
            <input type="submit" name="submit_settings" class="button-primary" value="Save Settings" />
          </p>
          ',
          $bsa_lang->line('submit_settings')
          );
        }
        ?>
        <input type="hidden" name="option_values" value="save" />
      </form>
    </div><!-- buysellads -->
  <?php
  }
  
}