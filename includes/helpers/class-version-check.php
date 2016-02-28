<?php
/**
 * Check the version of WordPress
 *
 * @since  1.0.0
 */
class WooCommerce_Plugin_Boiler_Plate_Version_Check {
    static $version;
    /**
     * The primary sanity check, automatically disable the plugin on activation if it doesn't meet minimum requirements
     *
     * @since  1.0.0
     */
    public static function activation_check( $version ) {
        self::$version = $version;
        if ( ! self::compatible_version() ) {
            deactivate_plugins(PLUGIN_FILE);
            wp_die( __( PLUGIN_NAME . ' requires WordPress ' . self::$version . ' or higher!', PLUGIN_TXT ) );
        } 
    }
	
    /**
     * The backup sanity check, in case the plugin is activated in a weird way, or the versions change after activation
     *
     * @since  1.0.0
     */
    public function check_version() {
        if ( ! self::compatible_version() ) {
            if ( is_plugin_active(PLUGIN_FILE) ) {
                deactivate_plugins(PLUGIN_FILE);
                add_action( 'admin_notices', array( $this, 'disabled_notice' ) );
                if ( isset( $_GET['activate'] ) ) {
                    unset( $_GET['activate'] );
                }
            } 
        } 
    }
	
    /**
     * Text to display in the notice
     *
     * @since  1.0.0
     */
    public function disabled_notice() {
       echo '<strong>' . esc_html__( PLUGIN_NAME . ' requires WordPress ' . self::$version . ' or higher!', PLUGIN_TXT ) . '</strong>';
    } 
	
    /**
     * Check current version against $prefix_version_check
     *
     * @since  1.0.0
     */
    public static function compatible_version() {
        if ( version_compare( $GLOBALS['wp_version'], self::$version, '<' ) ) {
             return false;
         }
        return true;
    }
}