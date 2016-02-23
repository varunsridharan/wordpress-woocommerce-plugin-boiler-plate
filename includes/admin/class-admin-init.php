<?php
/**
 * Plugin's Admin code
 *
 * @link [plugin_url]
 *
 * @package [package]
 * @subpackage [package]/core
 * @since [version]
 */
if ( ! defined( 'WPINC' ) ) { die; }

class WooCommerce_Plugin_Boiler_Plate_Admin extends WooCommerce_Plugin_Boiler_Plate {

    /**
	 * Initialize the class and set its properties.
	 * @since      0.1
	 */
	public function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ),99);
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'admin_init', array( $this, 'admin_init' ));

        add_filter( 'plugin_row_meta', array($this, 'plugin_row_links' ), 10, 2 );
        add_filter('plugin_action_links_'.PLUGIN_FILE, array($this,'plugin_action_links'),10,10);
        add_filter( 'woocommerce_get_settings_pages',  array($this,'settings_page') ); 
        new WooCommerce_Plugin_Boiler_Plate_Admin_Options;
	}

    /**
     * Inits Admin Sttings
     */
    public function admin_init(){
       # new WooCommerce_Plugin_Boiler_Plate_Admin_Sample_Class;
    }
 
    
	/**
	 * Add a new integration to WooCommerce.
	 */
	public function settings_page( $integrations ) {
        foreach(glob(PLUGIN_ADMIN.'woocommerce-settings*.php' ) as $file){
            $integrations[] = require_once($file);
        }
		return $integrations;
	}
    
    /**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() { 
        if(in_array($this->current_screen() , $this->get_screen_ids())) {
            wp_enqueue_style(PLUGIN_SLUG.'_core_style',PLUGIN_CSS.'admin-style.css' , array(), PLUGIN_V, 'all' );  
        }
	}
	
    
    /**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {
        if(in_array($this->current_screen() , $this->get_screen_ids())) {
            wp_enqueue_script(PLUGIN_SLUG.'_core_script', PLUGIN_JS.'admin-script.js', array('jquery'), PLUGIN_V, false ); 
        }
 
	}
    
    /**
     * Gets Current Screen ID from wordpress
     * @return string [Current Screen ID]
     */
    public function current_screen(){
       $screen =  get_current_screen();
       return $screen->id;
    }
    
    /**
     * Returns Predefined Screen IDS
     * @return [Array] 
     */
    public function get_screen_ids(){
        $screen_ids = array();
        return $screen_ids;
    }
    
    public function plugin_action_links($action,$file,$plugin_meta,$status){
        $actions[] = sprintf('<a href="%s">%s</a>', '#', __('Settings',PLUGIN_TXT) );
        $actions[] = sprintf('<a href="%s">%s</a>', 'http://varunsridharan.in/plugin-support/', __('Contact Author',PLUGIN_TXT) );
        $action = array_merge($actions,$action);
        return $action;
    }
    
    /**
	 * Adds Some Plugin Options
	 * @param  array  $plugin_meta
	 * @param  string $plugin_file
	 * @since 0.11
	 * @return array
	 */
	public function plugin_row_links( $plugin_meta, $plugin_file ) {
		if ( PLUGIN_FILE == $plugin_file ) {
            $plugin_meta[] = sprintf('<a href="%s">%s</a>', '#', __('F.A.Q',PLUGIN_TXT) );
            $plugin_meta[] = sprintf('<a href="%s">%s</a>', '#', __('View On Github',PLUGIN_TXT) );
            $plugin_meta[] = sprintf('<a href="%s">%s</a>', '#', __('Report Issue',PLUGIN_TXT) );
            $plugin_meta[] = sprintf('&hearts; <a href="%s">%s</a>', '#', __('Donate',PLUGIN_TXT) );
		}
		return $plugin_meta;
	}	    
}

?>