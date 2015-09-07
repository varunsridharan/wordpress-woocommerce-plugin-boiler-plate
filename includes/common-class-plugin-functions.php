<?php
/**
 * functionality of the plugin.
 *
 * @link       @TODO
 * @since      1.0
 *
 * @package    @TODO
 * @subpackage @TODO
 *
 * @package    @TODO
 * @subpackage @TODO
 * @author     Varun Sridharan <varunsridharan23@gmail.com>
 */
if ( ! defined( 'WPINC' ) ) { die; }

class WooCommerce_Plugin_Boiler_Plate_Functions {

    
    public function add_action($key,$value,$priority = 10,$variable = 1){
        add_action($key,$value,$priority, $variable) ;
    }
    
    public function add_filter($key,$value,$priority = 10,$variable = 1){
        add_filter($key,$value,$priority,$variable);          
    }
}
