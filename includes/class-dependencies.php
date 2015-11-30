<?php
/**
 * WC Dependency Checker
 *
 * Checks if WooCommerce is enabled
 */
if ( ! class_exists( 'Broken_Url_Notifier_Dependencies' ) ){
    class Broken_Url_Notifier_Dependencies {
        private static $active_plugins;
        public static function init() {
            self::$active_plugins = (array) get_option( 'active_plugins', array() );
            if ( is_multisite() )
                self::$active_plugins = array_merge( self::$active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
        }
        public static function woocommerce_active_check($pluginToCheck = '') {
            if ( ! self::$active_plugins ) self::init();
            return in_array($pluginToCheck, self::$active_plugins) || array_key_exists($pluginToCheck, self::$active_plugins);
        }
    }
}
/**
 * WC Detection
 */
if(! function_exists('Broken_Url_Notifier_Dependencies')){
    function Broken_Url_Notifier_Dependencies($pluginToCheck = 'woocommerce/woocommerce.php') {
        return Broken_Url_Notifier_Dependencies::woocommerce_active_check($pluginToCheck);
    }
}
?>