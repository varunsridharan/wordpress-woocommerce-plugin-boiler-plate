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
 
class WooCommerce_Plugin_Boiler_Plate {
	/**
	 * @var string
	 */
	public $version = '0.1';

	/**
	 * @var WooCommerce The single instance of the class
	 * @since 2.1
	 */
	protected static $_instance = null;
    
    protected static $functions = null;

    /**
     * Creates or returns an instance of this class.
     */
    public static function get_instance() {
        if ( null == self::$_instance ) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    
    /**
     * Class Constructor
     */
    public function __construct() {
        $this->define_constant();
        $this->load_required_files();
        $this->init_class();
        $this->func()->add_action( 'init', array( $this, 'init' ));
    }
    
    /**
     * Triggers When INIT Action Called
     */
    public function init(){
        $this->func()->add_action('plugins_loaded', array( $this, 'after_plugins_loaded' ));
        $this->func()->add_filter('load_textdomain_mofile',  array( $this, 'load_plugin_mo_files' ), 10, 2);
    }
    
    /**
     * Loads Required Plugins For Plugin
     */
    private function load_required_files(){
       $this->load_files(PLUGIN_PATH.'includes/common-class-*.php');
        
       if($this->is_request('admin')){
           $this->load_files(PLUGIN_PATH.'admin/class-*.php');
       } 

    }
    
    /**
     * Inits loaded Class
     */
    private function init_class(){
        self::$functions = new WooCommerce_Plugin_Boiler_Plate_Functions;
        
        if($this->is_request('admin')){
            $this->admin = new WooCommerce_Plugin_Boiler_Plate_Admin;
        }
    }
    
    
    protected function func(){
        return self::$functions;
    }
    

    protected function load_files($path,$type = 'require'){
        foreach( glob( $path ) as $files ){

            if($type == 'require'){
                require_once( $files );
            } else if($type == 'include'){
                include_once( $files );
            }
            
        } 
    }
    
    /**
     * Set Plugin Text Domain
     */
    public function after_plugins_loaded(){
        load_plugin_textdomain(PLUGIN_TEXT_DOMAIN, false, PLUGIN_LANGUAGE_PATH );
    }
    
    /**
     * load translated mo file based on wp settings
     */
    public function load_plugin_mo_files($mofile, $domain) {
        if (PLUGIN_TEXT_DOMAIN === $domain)
            return PLUGIN_LANGUAGE_PATH.'/'.get_locale().'.mo';

        return $mofile;
    }
    
    /**
     * Define Required Constant
     */
    private function define_constant(){
        $this->define('PLUGIN_NAME','WooCommerce Plugin Boiler Plate'); # Plugin Name
        $this->define('PLUGIN_SLUG','wc-pbp'); # Plugin Slug
        $this->define('PLUGIN_PATH',plugin_dir_path( __FILE__ )); # Plugin DIR
        $this->define('PLUGIN_LANGUAGE_PATH',PLUGIN_PATH.'languages');
        $this->define('PLUGIN_TEXT_DOMAIN','woocommerce-plugin-boiler-plate'); #plugin lang Domain
        $this->define('PLUGIN_URL',plugins_url('', __FILE__ )); 
        $this->define('PLUGIN_FILE',plugin_basename( __FILE__ ));
    }
    
    /**
	 * Define constant if not already set
	 * @param  string $name
	 * @param  string|bool $value
	 */
    protected function define($key,$value){
        if(!defined($key)){
            define($key,$value);
        }
    }
    
        
    protected function __($string){
        return __($string,PLUGIN_TEXT_DOMAIN);
    }
    /**
     * Adds Filter / Action
     */
    protected function add_filter_action($key,$value,$type = 'action' , $priority = 10, $variable = 1){
        if($type == 'action'){
            add_action($key,$value,$priority,$variable);        
        } else if($type == 'filter'){
            add_filter($key,$value,$priority,$variable);        
        } else {
            return false;
        }
    }

    
	/**
	 * What type of request is this?
	 * string $type ajax, frontend or admin
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin' :
				return is_admin();
			case 'ajax' :
				return defined( 'DOING_AJAX' );
			case 'cron' :
				return defined( 'DOING_CRON' );
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}
    
    
    
}
new WooCommerce_Plugin_Boiler_Plate;
?>