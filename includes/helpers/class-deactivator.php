<?php
/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @link       http://example.com
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
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
	
	
    /**
     * Flush rewrite rules for new Custom Post Types
     *
     * @since  1.0.0
     */
    public static function flush_rewrite_rules() {

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