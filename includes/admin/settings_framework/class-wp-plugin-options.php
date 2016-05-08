<?php
/**
 * The admin-specific functionality of the plugin.
 * @link https://wordpress.org/plugins/woocommerce-role-based-price/
 * @package WooCommerce Role Based Price
 * @subpackage WooCommerce Role Based Price/Admin
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
		$page[] = array('id'=>'general','slug'=>'general','title'=>__('General',PLUGIN_TXT));
		$page[] = array('id'=>'addonssettings','slug'=>'addonssettings','title'=>__('Add-ons Options',PLUGIN_TXT));
		$page[] = array('id'=>'addons','slug'=>'wc_pbp_addons','title'=>__('Add-ons',PLUGIN_TXT));
		return $page;
	}
	public function settings_section($section){
		$section['general'][] = array( 'id'=>'general', 'title'=> __('General',PLUGIN_TXT));
		$section['general'][] = array( 'id'=>'price_edit_view', 'title'=> __('Popup Editor View',PLUGIN_TXT));
		$section['addons'][] = array( 'id'=>'addons', 'title'=>'');
		$addonSettings = array('addon_sample' => array( 'id'=>'addonssettings', 'title'=>__('No Addons Activated / Installed.',PLUGIN_TXT)));
		$addonSettings = apply_filters('wc_pbp_addon_sections',$addonSettings);

		if(count($addonSettings) > 1) 			
			unset($addonSettings['addon_sample']);
		$section['addonssettings']  = $addonSettings;
		return $section;
	}
	
	public function settings_fields($fields){
		$fields['general']['general'][] = array(
			'id' => PLUGIN_DB.'allowed_roles',
			'multiple' => 'true',
			'type'    => 'text',
			'label' => __('Allowed User Roles',PLUGIN_TXT),
			'desc' => __('User Roles To List In Product Edit Page',PLUGIN_TXT), 
			'attr'    => array(
				'class' => 'wc-pbp-enhanced-select',
				'multiple' => 'multiple'
			),
		);
		  
		 
		$addonSettings = array('addon_sample' => array());
		$addonSettings = apply_filters('wc_pbp_addon_fields',$addonSettings);
		unset($addonSettings['addon_sample']);
		$fields['addonssettings'] = $addonSettings;
	
		return $fields;
	}
	
}

return new WooCommerce_Plugin_Boiler_Plate_Admin_Settings_Options;
?>