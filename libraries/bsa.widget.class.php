<?php
/**
 * Widget Class Extends WP_Widget
 *
 * @package WordPress
 * @subpackage Buy Sell Ads
 * @since 1.0
 */
class BSA_Widget extends WP_Widget 
{
  
  /**
   * PHP5 constructor
   *
   * @since 1.0
   * @uses $bsa_lang global variable
   *
   * @param string $id_base Optional Base ID for the widget, lower case,
   * if left empty a portion of the widget's class name will be used. Has to be unique.
   * @param string $name Name for the widget displayed on the configuration page.
   * @param array $widget_options Optional Passed to wp_register_sidebar_widget()
   *	 - description: shown on the configuration page
   *	 - classname
   * @param array $control_options Optional Passed to wp_register_widget_control()
   *	 - width: required if more than 250px
   *	 - height: currently not used but may be needed in the future
   */
  function BSA_Widget() 
  {
    global $bsa_lang;
    
    $widget_ops = array('classname' => 'widget_bsa', 'description' => $bsa_lang->line('widget_description') );
    $this->WP_Widget('bsa', $bsa_lang->line('plugin_title'), $widget_ops);
  }
  
  /**
   * This function generates the widget code
   *
   * @since 1.0
   * @uses apply_filters()
   *
   * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
   * @param array $instance The settings for the particular instance of the widget
   */
  function widget($args, $instance) 
  {
    
    if ( !$site_key = get_option( 'bsa_site_key' ) )
    {
      return;
    }
    else
    { 
      extract($args, EXTR_SKIP);
   
      echo $before_widget;
      $title    = empty($instance['title']) ? '' : apply_filters('plugin_title', $instance['title']);
      $ad_zone  = empty($instance['ad_zone']) ? '' : apply_filters('widget_ad_zone', $instance['ad_zone']);
      
      if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
      echo ("
        <!-- BuySellAds.com Zone Code -->
        <div id=\"bsap_{$ad_zone}\" class=\"bsarocks bsap_{$site_key}\"></div>
        <!-- END BuySellAds.com Zone Code -->
      ");
      echo $after_widget;
    }
  }
  
  /**
   * This function should check that $new_instance is set correctly.
   * The newly calculated value of $instance should be returned.
   * If "false" is returned, the instance won't be saved/updated.
   *
   * @param array $new_instance New settings for this instance as input by the user via form()
   * @param array $old_instance Old settings for this instance
   * @return array Settings to save or bool false to cancel saving
   */
  function update($new_instance, $old_instance) 
  {
    $instance = $old_instance;
    $instance['title']    = strip_tags($new_instance['title']);
    $instance['ad_zone']  = strip_tags($new_instance['ad_zone']);
    
    return $instance;
  }
  
  /**
   * Echo the settings update form
   *
   * @since 1.0
   * @uses $bsa_lang global variable
   *
   * @param array $instance Current settings
   */
  function form($instance) 
  {
    global $bsa_lang;
    
    if (!$site_key = get_option('bsa_site_key')) 
    {
      echo '<p>'. sprintf( $bsa_lang->line('empty_site_key'), admin_url('admin.php?page=wp_buy_sell_ads') ) .'</p>';
			return;
    } 
    else 
    {
      $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'ad_zone' => '' ) );
      $title    = strip_tags($instance['title']);
      $ad_zone  = strip_tags($instance['ad_zone']);
      ?>	
      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo $bsa_lang->line('widget_title'); ?>: 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
        </label>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('ad_zone'); ?>"><?php echo $bsa_lang->line('widget_ad_zone'); ?>: 
          <select class="widefat" name="<?php echo $this->get_field_name('ad_zone'); ?>" id="<?php echo $this->get_field_id('ad_zone'); ?>" value="<?php echo attribute_escape($ad_zone); ?>">
          <?php
          $json_data = get_bsa_json();
          foreach($json_data['zones'] as $zone) 
          {
            $selected = ($zone['id'] == attribute_escape($ad_zone)) ? ' selected="selected"': '';
            echo '<option name="'.$zone['id'].'" value="'.$zone['id'].'"'.$selected.'>'.$zone['id'].' ('.$zone['width'].'x'.$zone['height'].')</option>';
          }
          ?>
          </select>
        </label>
      </p>
      <?php
    }
  }
  
}