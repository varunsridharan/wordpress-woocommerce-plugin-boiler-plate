<?php
/**
 * Plugin Name:       WooCommerce Plugin Boiler Plate
 * Plugin URI:        https://wordpress.org/plugins/woocommerce-plugin-boiler-plate/
 * Description:       Sample Plugin For WooCommerce
 * Version:           0.1
 * Author:            Varun Sridharan
 * Author URI:        http://varunsridharan.in
 * Text Domain:       woocommerce-plugin-boiler-plate
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt 
 * GitHub Plugin URI: @TODO
 */

if ( ! defined( 'WPINC' ) ) { die; }
 
require_once(plugin_dir_path(__FILE__).'bootstrap.php');
require_once(plugin_dir_path(__FILE__).'includes/class-dependencies.php');


if(WooCommerce_Plugin_Boiler_Plate_Dependencies()){
	if(!function_exists('WooCommerce_Plugin_Boiler_Plate')){
		function WooCommerce_Plugin_Boiler_Plate(){
			return WooCommerce_Plugin_Boiler_Plate::get_instance();
		}
	}
	WooCommerce_Plugin_Boiler_Plate();
}

?>