<?php
/**
 * WooCommerce General Settings
 *
 * @link [plugin_url]
 * @package [package]
 * @subpackage [package]/Admin/WC_Settings
 * @since [version]
 */
if ( ! defined( 'WPINC' ) ) { die; }

if ( ! class_exists( 'WooCommerce_Simple_Settings' ) ) :

/**
 * WC_Admin_Settings_General
 */
class WooCommerce_Simple_Settings extends WC_Settings_Page {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->id    = 'wc_intergation_simple';
		$this->label = __( 'WC Simple Intergation', PLUGIN_TXT );

		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
		add_action( 'woocommerce_settings_' . $this->id, array( $this, 'output' ) );
		add_action( 'woocommerce_settings_save_' . $this->id, array( $this, 'save' ) );
	}

	/**
	 * Get settings array
	 *
	 * @return array
	 */
	public function get_settings() {

		$settings = array(

			array( 
                'title' => __( 'Simple Options', PLUGIN_TXT ), 
                'type' => 'title', 
                'desc' => '', 
                'id' => 'wc_simple_intergation' 
            ),

			array(
				'title'    => __( 'Text Box', PLUGIN_TXT ),
				'desc'     => __( 'This is a simple textbox', PLUGIN_TXT ),
				'id'       =>'wc_simple_textbox',
				'css'      => 'min-width:350px;',
				'default'  => 'GB',
				'type'     => 'text',
				'desc_tip' =>  true,
			),

            array(
				'title'    => __( 'TextArea', PLUGIN_TXT ),
				'desc'     => '',
				'id'       => 'wc_simple_textarea',
				'default'  => __( 'SOme Value.', PLUGIN_TXT ),
				'type'     => 'textarea',
				'css'     => 'width:350px; height: 65px;',
				'autoload' => false
			),
            
			array(
				'title'    => __( 'Radio Buttons', PLUGIN_TXT ),
				'desc'     => __( 'A Simple Radio Button', PLUGIN_TXT ),
				'id'       => 'wc_simple_radio',
				'default'  => 'all',
				'type'     => 'radio',  
				'desc_tip' =>  true,
				'options'  => array(
					'all'      => __( 'Sell to all countries', PLUGIN_TXT ),
					'specific' => __( 'Sell to specific countries only', PLUGIN_TXT )
				)
			),

			  

			array(
				'title'   => __( 'Checbox', PLUGIN_TXT ),
				'desc'    => __( 'A Simple Checkbox', PLUGIN_TXT ),
				'id'      => 'wc_simple_checkboxx',
				'default' => 'no',
				'type'    => 'checkbox'
			),



			array( 'type' => 'sectionend', 'id' => 'wc_simple_intergation'),

			     

		);

		return $settings;
	}
 

	/**
	 * Save settings
	 */
	public function save() {
		$settings = $this->get_settings();

		WC_Admin_Settings::save_fields( $settings );
	}

}

endif;

return new WooCommerce_Simple_Settings();