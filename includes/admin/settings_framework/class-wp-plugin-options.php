<?php
/**
 * The admin-specific functionality of the plugin.
 * @link [plugin_url]
 * @package [package]
 * @subpackage [package]/Admin
 * @since 3.0
 */
if ( ! defined( 'WPINC' ) ) { die; }

class WooCommerce_Plugin_Boiler_Plate_Admin_Settings_Options {

    public function __construct() {
    	add_filter('wc_pbp_settings_pages',array($this,'settings_pages'));
		add_filter('wc_pbp_settings_section',array($this,'settings_section'));
		add_filter('wc_pbp_settings_fields',array($this,'settings_fields'));
    }
	public function settings_pages($page){
		$page[] = array('id'=>'general','slug'=>'general','title'=>__('Fields',PLUGIN_TXT));
		$page[] = array('id'=>'addonssettings','slug'=>'addonssettings','title'=>__('Add-ons Options',PLUGIN_TXT));
		$page[] = array('id'=>'addons','slug'=>'wc_pbp_addons','title'=>__('Add-ons',PLUGIN_TXT));
		return $page;
	}
	public function settings_section($section){
		$section['general'][] = array( 'id'=>'general', 'title'=> __('Simple Fields',PLUGIN_TXT));
		$section['general'][] = array( 'id'=>'advanced', 'title'=> __('Advanced Fields',PLUGIN_TXT));
        $section['general'][] = array( 'id'=>'wpfields', 'title'=> __('WP Fields',PLUGIN_TXT));
		
        $section['addons'][] = array( 'id'=>'addons', 'title'=>'');
        
		$addonSettings = array(
            'addon_sample' => array( 'id'=>'addonssettings', 'title'=>__('No Addons Activated / Installed.',PLUGIN_TXT))
        );
		
        $addonSettings = apply_filters('wc_pbp_addon_sections',$addonSettings);

		if(count($addonSettings) > 1) 			
			unset($addonSettings['addon_sample']);
		$section['addonssettings']  = $addonSettings;
		return $section;
	}
	public function settings_fields($fields){
        global $fields;
        include(PLUGIN_SETTINGS.'fields.php'); 
        
		$addonSettings = array('addon_sample' => array());
		$addonSettings = apply_filters('wc_pbp_addon_fields',$addonSettings);
		unset($addonSettings['addon_sample']);
		$fields['addonssettings'] = $addonSettings;
	
		return $fields;
	}
}
return new WooCommerce_Plugin_Boiler_Plate_Admin_Settings_Options;