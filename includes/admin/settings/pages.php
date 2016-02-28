<?php
/**
 * class for form fields display.
 * For detailed instructions see: https://github.com/keesiemeijer/WP-Settings
 *
 * @link [plugin_url]
 * @package [package]
 * @subpackage [package]/WordPress/Settings
 * @since [version]
 */
if ( ! defined( 'WPINC' ) ) { die; }
global $pages;
$pages[] = array('id'=>'settings_general','slug'=>'general','title'=>__('General',PLUGIN_TXT));
$pages[] = array('id'=>'settings_message','slug'=>'message','title'=>__('Message',PLUGIN_TXT));
$pages[] = array('id'=>'settings_shortcode','slug'=>'shortcode','title'=>__('ShortCode',PLUGIN_TXT));