<?php
/**
 * Plugin Class
 *
 * @package WordPress
 * @subpackage Buy Sell Ads
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
   *
   * @return void
   */
  function bsa_admin_load()
  {
  
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
      // Read posted value
      $bsa_site_key = $_POST[ 'bsa_site_key' ];
      $bsa_body_open = $_POST[ 'bsa_body_open' ];

      // Save posted values
      update_option( 'bsa_site_key', $bsa_site_key );
      update_option( 'bsa_body_open', $bsa_body_open );
      
      $json_data = get_buysellads_json();
      if ($json_data)
      {
        // Update Message
        echo '<div class="updated"><p><strong>'.$bsa_lang->line('settings_updated').'</strong></p></div>';
      }
      else
      {
        // Update Error
        echo '<div class="message error"><p><strong>'.$bsa_lang->line('settings_error').'</strong></p></div>';
        update_option( 'bsa_site_key', '' );
      }
    }
    ?>
    <div class="wrap">
      <h2><?php echo $bsa_lang->line('plugin_title'); ?></h2>
      
      <form method="post" action="">
        
        <input type="hidden" name="option_values" value="save" />
        
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
  
        <p class="submit">
          <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
        </p>
      </form>
    </div>
    <?php
  }
  
}