<?php
/**
 * Plugin's Admin code
 *
 * @link [plugin_url]
 * @package [package]
 * @subpackage [package]/Admin
 * @since [version]
 */
if ( ! defined( 'WPINC' ) ) { die; }

class WooCommerce_Plugin_Boiler_Plate_Admin {

    /**
	 * Initialize the class and set its properties.
	 * @since      0.1
	 */
	public function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ),99);
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'admin_init', array( $this, 'admin_init' ));

        add_filter( 'plugin_row_meta', array($this, 'plugin_row_links' ), 10, 2 );
        add_filter( 'plugin_action_links_'.PLUGIN_FILE, array($this,'plugin_action_links'),10,10);
        add_filter( 'woocommerce_get_settings_pages',  array($this,'settings_page') ); 
        add_filter( 'woocommerce_screen_ids',array($this,'set_wc_screen_ids'),99);
	}

    public function set_wc_screen_ids($screens){ 
        $screen = $screens; 
      	$screen[] = wc_pbp_vars('settings_page');
        return $screen;
    }
    
    /**
     * Inits Admin Sttings
     */
    public function admin_init(){
        new WooCommerce_Plugin_Boiler_Plate_Admin_Ajax_Handler;
        new WooCommerce_Plugin_Boiler_Plate_Addons;
    }
    public function init_admin_notices(){
        $displayCallBack = array( WooCommerce_Plugin_Boiler_Plate_Admin_Notices::getInstance(), 'displayNotices' );
        $dismissCallBack = array( WooCommerce_Plugin_Boiler_Plate_Admin_Notices::getInstance(), 'ajaxDismissNotice' );
        
        if ( ! has_action( 'admin_notices', $displayCallBack ) ) { add_action( 'admin_notices', $displayCallBack ); }
            
        if ( ! has_action( 'admin_notices', $dismissCallBack ) ) {
            add_action( 'wp_ajax_' . WooCommerce_Plugin_Boiler_Plate_Admin_Notices::KILL_STICKY_NTC_AJAX_ACTION, $dismissCallBack );
        }        
    }
    
	/**
	 * Add a new integration to WooCommerce.
	 */
	public function settings_page( $integrations ) {
        foreach(glob(PLUGIN_ADMIN.'wc-settings/woocommerce-settings*.php' ) as $file){
            $integrations[] = require_once($file);
        }
		return $integrations;
	}
    
    /**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() {  
        $pages = wc_pbp_get_screen_ids();
        $current_screen = wc_pbp_current_screen();
        
        $addon_url = admin_url('admin-ajax.php?action=wc_pbp_addon_custom_css');
        wp_register_style(PLUGIN_SLUG.'_backend_style',PLUGIN_CSS.'backend.css' , array(), PLUGIN_V, 'all' );  
        wp_register_style(PLUGIN_SLUG.'_addons_style',$addon_url , array(), PLUGIN_V, 'all' );  

        
        if(in_array($current_screen ,$pages)) {
            wp_enqueue_style(PLUGIN_SLUG.'_backend_style');  
            wp_enqueue_style(PLUGIN_SLUG.'_addons_style');  
        }
        
        do_action('wc_pbp_admin_styles',$current_screen,$pages[]);
	}
    
    /**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {
        $pages = wc_pbp_get_screen_ids();
        $current_screen = wc_pbp_current_screen();
        
        $addon_url = admin_url('admin-ajax.php?action=wc_pbp_addon_custom_js');
        
        wp_register_script(PLUGIN_SLUG.'_backend_script', PLUGIN_JS.'backend.js', array('jquery'), PLUGIN_V, false ); 
        wp_register_script(PLUGIN_SLUG.'_addons_script', $addon_url, array('jquery'), PLUGIN_V, false ); 
        
        
        if(in_array($current_screen ,$pages)) {
            wp_enqueue_script(PLUGIN_SLUG.'_backend_script' ); 
            wp_enqueue_script(PLUGIN_SLUG.'_addons_script' ); 
        } 
        
        do_action('wc_pbp_admin_scripts',$current_screen); 
 	}
 
    /**
	 * Adds Some Plugin Options
	 * @param  array  $plugin_meta
	 * @param  string $plugin_file
	 * @since 0.11
	 * @return array
	 */
    public function plugin_action_links($action,$file,$plugin_meta,$status){
        $menu_link = admin_url('admin.php?page=woocommerce-plugin-boiler-plate-settings');
        $actions[] = sprintf('<a href="%s">%s</a>', $menu_link, __('Settings',PLUGIN_TXT) );
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