<?php
/**
 * Plugin Name:       broken url notifier
 * Plugin URI:        https://wordpress.org/plugins/broken-url-notifier/
 * Description:       Sample Plugin For WooCommerce
 * Version:           0.1
 * Author:            Varun Sridharan
 * Author URI:        http://varunsridharan.in
 * Text Domain:       broken-url-notifier
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt 
 * GitHub Plugin URI: @TODO
 */

if ( ! defined( 'WPINC' ) ) { die; }
 

require_once(plugin_dir_path(__FILE__).'plugin-name.php');
require_once(plugin_dir_path(__FILE__).'includes/class-dependencies.php');


if(Broken_Url_Notifier_Dependencies()){
	if(!function_exists('Broken_Url_Notifier')){
		function Broken_Url_Notifier(){
			return Broken_Url_Notifier::get_instance();
		}
	}
	
}

?>