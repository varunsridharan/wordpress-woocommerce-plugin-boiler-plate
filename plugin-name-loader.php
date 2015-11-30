<?php 

if ( ! defined( 'WPINC' ) ) { die; }
 
class Broken_Url_Notifier {
	/**
	 * @var string
	 */
	public $version = '0.1';
	public $plugin_vars = array();

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
		$this->set_vars();
        $this->load_required_files();
        $this->init_class();
        add_action( 'init', array( $this, 'init' )); 
    }
    
    /**
     * Triggers When INIT Action Called
     */
    public function init(){
        add_action('plugins_loaded', array( $this, 'after_plugins_loaded' ));
        add_filter('load_textdomain_mofile',  array( $this, 'load_plugin_mo_files' ), 10, 2);
    }
    
    /**
     * Loads Required Plugins For Plugin
     */
    private function load_required_files(){
       $this->load_files(BUN_PATH.'includes/class-common-*.php');
        
       if($this->is_request('admin')){
           $this->load_files(BUN_PATH.'admin/class-*.php');
       } 

    }
    
    /**
     * Inits loaded Class
     */
    private function init_class(){
        self::$functions = new Broken_Url_Notifier_Functions;
        
        if($this->is_request('admin')){
            $this->admin = new Broken_Url_Notifier_Admin;
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
        load_plugin_textdomain(BUN_TEXT_DOMAIN, false, BUN_LANGUAGE_PATH );
    }
    
    /**
     * load translated mo file based on wp settings
     */
    public function load_plugin_mo_files($mofile, $domain) {
        if (BUN_TEXT_DOMAIN === $domain)
            return BUN_LANGUAGE_PATH.'/'.get_locale().'.mo';

        return $mofile;
    }
    
    /**
     * Define Required Constant
     */
    private function define_constant(){
        $this->define('BUN_NAME', 'broken url notifier'); # Plugin Name
        $this->define('BUN_SLUG','broken-url-notifier'); # Plugin Slug
        $this->define('BUN_PATH',plugin_dir_path( __FILE__ )); # Plugin DIR
        $this->define('BUN_LANGUAGE_PATH',BUN_PATH.'languages');
        $this->define('BUN_TEXT_DOMAIN','broken-url-notifier'); #plugin lang Domain
        $this->define('BUN_URL',plugins_url('', __FILE__ )); 
        $this->define('BUN_FILE',plugin_basename( __FILE__ ));
    }
	
	private function set_vars(){
		
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
    
	
	private function get_vars($key){
		if(isset($this->plugin_vars[$key])){
			return $this->plugin_vars[$key];
		}
									
		return false;
	}
	
	private function add_vars($key,$value){
		if(!isset($this->plugin_vars[$key])){
			$this->plugin_vars[$key] = $value;
		}
	}
									 
									 
									 
        
    protected function __($string){
        return __($string,BUN_TEXT_DOMAIN);
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

?>