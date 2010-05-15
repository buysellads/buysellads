<?php
/**
 * Language Class
 *
 * @package WordPress
 * @subpackage WP Buy Sell Ads
 * @since 1.0
 */
class BSA_Language 
{
	var $language	= array();
	var $is_loaded	= array();

	/**
	 * Load the language file
	 *
	 * @access	public
	 * @param	mixed	the name of the language file to be loaded. Can be an array
	 * @param	string	the language (english, etc.)
	 * @return	mixed
	 */
	function load($langfile = '', $idiom = '', $return = FALSE)
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
		if (file_exists(THIS_PLUGIN_DIR.'/language/'.$idiom.'/'.$langfile))
		{
			include(THIS_PLUGIN_DIR.'/language/'.$idiom.'/'.$langfile);
		}
		else
		{
			if (file_exists(THIS_PLUGIN_DIR.'/language/'.$idiom.'/'.$langfile))
			{
				include(THIS_PLUGIN_DIR.'/language/'.$idiom.'/'.$langfile);
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
	 * @access	public
	 * @param	string	$line 	the language line
	 * @return	string
	 */
	function line($line = '')
	{
		$line = ($line == '' OR ! isset($this->language[$line])) ? FALSE : $this->language[$line];
		return $line;
	}

}