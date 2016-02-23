<?php 
/**
 * Plugin Main File
 *
 * @link [plugin_url]
 *
 * @package [package]
 * @subpackage [package]/core
 * @since [version]
 */
if ( ! defined( 'WPINC' ) ) { die; }
 
class WooCommerce_Plugin_Boiler_Plate {
	public $version = '0.1';
	public $plugin_vars = array();
	
	protected static $_instance = null; # Required Plugin Class Instance
    protected static $functions = null; # Required Plugin Class Instance
	protected static $admin = null;     # Required Plugin Class Instance
	protected static $settings = null;  # Required Plugin Class Instance

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
        add_action('plugins_loaded', array( $this, 'after_plugins_loaded' ));
        add_filter('load_textdomain_mofile',  array( $this, 'load_plugin_mo_files' ), 10, 2);
    }
    
    /**
     * Loads Required Plugins For Plugin
     */
    private function load_required_files(){
       $this->load_files(PLUGIN_INC.'class-common-*.php');
	   $this->load_files(PLUGIN_ADMIN.'class-wp-*.php');
        
       if($this->is_request('admin')){
           $this->load_files(PLUGIN_ADMIN.'class-*.php');
       } 

    }
    
    /**
     * Inits loaded Class
     */
    private function init_class(){
        self::$functions = new WooCommerce_Plugin_Boiler_Plate_Functions;
		self::$settings = new WooCommerce_Plugin_Boiler_Plate_WP_Settings; 

        if($this->is_request('admin')){
            self::$admin = new WooCommerce_Plugin_Boiler_Plate_Admin;
        }
    }
    
	# Returns Plugin's Functions Instance
	public function func(){
		return self::$functions;
	}
	
	# Returns Plugin's Settings Instance
	public function settings(){
		return self::$settings;
	}
	
	# Returns Plugin's Admin Instance
	public function admin(){
		return self::$admin;
	}
    
    /**
     * Loads Files Based On Give Path & regex
     */
    protected function load_files($path,$type = 'require'){
        foreach( glob( $path ) as $files ){
            if($type == 'require'){ require_once( $files ); } 
			else if($type == 'include'){ include_once( $files ); }
        } 
    }
    
    /**
     * Set Plugin Text Domain
     */
    public function after_plugins_loaded(){
        load_plugin_textdomain(PLUGIN_TXT, false, PLUGIN_LANGUAGE_PATH );
    }
    
    /**
     * load translated mo file based on wp settings
     */
    public function load_plugin_mo_files($mofile, $domain) {
        if (PLUGIN_TXT === $domain)
            return PLUGIN_LANGUAGE_PATH.'/'.get_locale().'.mo';

        return $mofile;
    }
    
    /**
     * Define Required Constant
     */
    private function define_constant(){
        $this->define('PLUGIN_NAME', 'WooCommerce Plugin Boiler Plate'); # Plugin Name
        $this->define('PLUGIN_SLUG', 'woocommerce-plugin-boiler-plate'); # Plugin Slug
        $this->define('PLUGIN_TXT',  'woocommerce-plugin-boiler-plate'); #plugin lang Domain
		$this->define('PLUGIN_DB', 'wc_pbp_');
		$this->define('PLUGIN_V',$this->version); # Plugin Version
		$this->define('PLUGIN_PATH',plugin_dir_path( __FILE__ )); # Plugin DIR
		$this->define('PLUGIN_LANGUAGE_PATH',PLUGIN_PATH.'languages'); # Plugin Language Folder
		$this->define('PLUGIN_INC',PLUGIN_PATH.'includes/'); # Plugin INC Folder
		$this->define('PLUGIN_ADMIN',PLUGIN_INC.'admin/'); # Plugin Admin Folder
		$this->define('PLUGIN_SETTINGS',PLUGIN_INC.'admin/settings/'); # Plugin Settings Folder
		$this->define('PLUGIN_URL',plugins_url('', __FILE__ ).'/');  # Plugin URL
		$this->define('PLUGIN_CSS',PLUGIN_URL.'includes/css/'); # Plugin CSS URL
		$this->define('PLUGIN_IMG',PLUGIN_URL.'includes/img/'); # Plugin IMG URL
		$this->define('PLUGIN_JS',PLUGIN_URL.'includes/js/'); # Plugin JS URL
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
?>