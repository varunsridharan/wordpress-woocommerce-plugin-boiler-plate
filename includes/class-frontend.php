<?php
/**
 * Dependency Checker
 *
 * Checks if required Dependency plugin is enabled
 *
 * @link [plugin_url]
 *
 * @package [package]
 * @subpackage [package]/core
 * @since [version]
 */
if ( ! defined( 'WPINC' ) ) { die; }

class WooCommerce_Plugin_Boiler_Plate_Functions {

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
        add_action( 'wp_enqueue_scripts', array($this,'enqueue_styles') );
        add_action( 'wp_enqueue_scripts', array($this,'enqueue_scripts') );
    }
    
    
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() { 
		wp_enqueue_style(PLUGIN_NAME.'frontend_style', PLUGIN_CSS. 'frontend.css', array(), PLUGIN_V, 'all' );
	}
    
	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() { 
		wp_enqueue_script(PLUGIN_NAME.'frontend_script', PLUGIN_JS.'frontend.js', array( 'jquery' ), PLUGIN_V, false );
	}

}
