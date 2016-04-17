<?php 
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              [plugin_url]
 * @since             [version]
 * @package           [plugin_name]
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Plugin Boiler Plate
 * Plugin URI:        [plugin_url]
 * Description:       Sample Plugin For WooCommerce
 * Version:           [version]
 * Author:            Varun Sridharan
 * Author URI:        http://varunsridharan.in
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-plugin-boiler-plate
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) { die; }
 
define('PLUGIN_FILE',plugin_basename( __FILE__ ));
define('PLUGIN_PATH',plugin_dir_path( __FILE__ )); # Plugin DIR
define('PLUGIN_INC',PLUGIN_PATH.'includes/'); # Plugin INC Folder
define('PLUGIN_DEPEN','woocommerce/woocommerce.php');

register_activation_hook( __FILE__, 'wc_pbp_activate_plugin' );
register_deactivation_hook( __FILE__, 'wc_pbp_deactivate_plugin' );
register_deactivation_hook( PLUGIN_DEPEN, 'wc_pbp_dependency_deactivate' );



/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function wc_pbp_activate_plugin() {
	require_once(PLUGIN_INC.'helpers/class-activator.php');
	WooCommerce_Plugin_Boiler_Plate_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function wc_pbp_deactivate_plugin() {
	require_once(PLUGIN_INC.'helpers/class-deactivator.php');
	WooCommerce_Plugin_Boiler_Plate_Deactivator::deactivate();
}


/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function wc_pbp_dependency_deactivate() {
	require_once(PLUGIN_INC.'helpers/class-deactivator.php');
	WooCommerce_Plugin_Boiler_Plate_Deactivator::dependency_deactivate();
}




//if(WooCommerce_Plugin_Boiler_Plate_Dependencies()){
	
    require_once(PLUGIN_INC.'functions.php');
    require_once(plugin_dir_path(__FILE__).'bootstrap.php');
	
	if(!function_exists('WooCommerce_Plugin_Boiler_Plate')){
		function WooCommerce_Plugin_Boiler_Plate(){
			return WooCommerce_Plugin_Boiler_Plate::get_instance();
		}
	}
	WooCommerce_Plugin_Boiler_Plate();
//}

?>