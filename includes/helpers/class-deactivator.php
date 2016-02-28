<?php
/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @link [plugin_url]
 * @package [package]
 * @subpackage [package]/core
 * @since [version]
 */
class WooCommerce_Plugin_Boiler_Plate_Deactivator {
	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

	}

	public static function dependency_deactivate(){ 
		if ( is_plugin_active(PLUGIN_FILE) ) {
			add_action('update_option_active_plugins', array(__CLASS__,'deactivate_dependent'));
		}
	}
	
	public static function deactivate_dependent(){
		deactivate_plugins(PLUGIN_FILE);
	}

}