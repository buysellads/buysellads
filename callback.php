<?php
/**
 * Callback
 *
 * @package WordPress
 * @subpackage Buy Sell Ads
 * @since 1.0
 */
 
/**
 * Loads the WordPress environment and template.
 * If callback & id isset run callback function.
 *
 * @since 1.0
 * @uses backfill_callback()
 *
 * @param int $id
 *
 * @return string
 */
$script_directory = preg_replace('/\wp-content(.*)/', 'wp-blog-header.php', $_SERVER['SCRIPT_FILENAME']);
include($script_directory);

if (isset($_REQUEST['callback']) && isset($_REQUEST['id'])) 
  backfill_callback($_REQUEST['id']);