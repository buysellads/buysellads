<?php
/**
 * Language Class
 *
 * @package WordPress
 * @subpackage BuySellAds
 * @since 1.0
 * @author Derek Herman
 */
class BSA_Language 
{
  var $language	= array();
  var $is_loaded	= array();
  
  /**
   * Load language files
   *
   * @since 1.0
   *
   * @access	public
   * @param   mixed   $langfile the name of the language file to be loaded. Can be an array
   * @param   string  $idiom the language (en_US, etc.)
   * @param   bool    $return default FALSE
   * @return  void
   */
  function load($langfile = '', $idiom = '', $return = FALSE)
  {
    // load $langfile array
    if (is_array($langfile))
    {
      foreach ($langfile as $class)
      {
      $this->_load_language($class, $idiom, $return);
      }
    }
    // load one $langfile
    else
    {
      $this->_load_language($langfile, $idiom, $return);
    }
  }
  
  /**
   * Load each language file
   *
   * @since 1.0
   *
   * @access	private
   * @param   string   $langfile the name of the language file to be loaded.
   * @param   string  $idiom the language (en_US, etc.)
   * @param   bool    $return default FALSE
   * @return  array
   */
  function _load_language($langfile, $idiom, $return)
  {
    $langfile = str_replace('.php', '', str_replace('_lang.', '', $langfile)).'_lang.php';
    
    if (in_array($langfile, $this->is_loaded, TRUE))
    {
      return;
    }
    
    if ($idiom == '')
    {
      $deft_lang = get_locale();
      $idiom = ($deft_lang == '') ? 'en_US' : $deft_lang;
    }
    
    // Determine where the language file is and load it
    if (file_exists(BSA_PLUGIN_DIR.'/language/'.$idiom.'/'.$langfile))
    {
      include(BSA_PLUGIN_DIR.'/language/'.$idiom.'/'.$langfile);
    }
    // failed to load
    else
    {
      // load English
      if (file_exists(BSA_PLUGIN_DIR.'/language/en_US/'.$langfile))
      {
        include(BSA_PLUGIN_DIR.'/language/en_US/'.$langfile);
      }
      // total failure
      else 
      {
        return FALSE;
      }
    }
    
    if ($return == TRUE)
    {
      return $lang;
    }
    
    $this->is_loaded[] = $langfile;
    $this->language = array_merge($this->language, $lang);
    unset($lang);
    
    return TRUE;
  }
  
  /**
   * Fetch a single line of text from the language array
   *
   * @since 1.0
   *
   * @access	public
   * @param   string $line the language line
   * @return  string
   */
  function line($line = '')
  {
    $line = ($line == '' OR ! isset($this->language[$line])) ? FALSE : $this->language[$line];
    return $line;
  }
  
}