<?php
/**
 * The admin-specific functionality of the plugin.
 * @link https://wordpress.org/plugins/woocommerce-role-based-price/
 * @package WooCommerce Role Based Price
 * @subpackage WooCommerce Role Based Price/Admin
 * @since 3.0
 */
if ( ! defined( 'WPINC' ) ) { die; }

class WooCommerce_Plugin_Boiler_Plate_Admin_Ajax_Handler {
    
    public function __construct() { 
		add_action( 'wp_ajax_nopriv_wc_pbp_addon_custom_css',array($this,'render_addon_css'));
		add_action( 'wp_ajax_wc_pbp_addon_custom_css',array($this,'render_addon_css'));

        add_action( 'wp_ajax_nopriv_wc_pbp_addon_custom_js',array($this,'render_addon_js'));
		add_action( 'wp_ajax_wc_pbp_addon_custom_js',array($this,'render_addon_js'));
    }
	
	public function render_addon_css(){ 
        header('Content-Type: text/css');
		do_action('wc_pbp_addon_styles');
		wp_die();
	}
    
	public function render_addon_js(){ 
        header('Content-Type: text/javascript'); 
		do_action('wc_pbp_addon_scripts'); 
		wp_die();
	}
	

}
?>