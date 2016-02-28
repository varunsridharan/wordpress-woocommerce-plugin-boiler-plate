<?php
if(!function_exists('wc_pbp_is_request')){
    /**
	 * What type of request is this?
	 * string $type ajax, frontend or admin
	 * @return bool
	 */
    function wc_pbp_is_request( $type ) {
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


if(!function_exists('wc_pbp_current_screen')){
    /**
     * Gets Current Screen ID from wordpress
     * @return string [Current Screen ID]
     */
    function wc_pbp_current_screen(){
       $screen =  get_current_screen();
       return $screen->id;
    }
}

if(!function_exists('wc_pbp_get_screen_ids')){
    /**
     * Returns Predefined Screen IDS
     * @return [Array] 
     */
    function wc_pbp_get_screen_ids(){
        $screen_ids = array();
        return $screen_ids;
    }
}


if(!function_exists('wc_pbp_dependency_message')){
	function wc_pbp_dependency_message(){
		$text = __( PLUGIN_NAME . ' requires <b> WooCommerce </b> To Be Installed..  <br/> <i>Plugin Deactivated</i> ', PLUGIN_TXT);
		return $text;
	}
}

?>