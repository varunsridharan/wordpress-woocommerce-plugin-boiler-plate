<?php
/**
 * Integration Demo Integration.
 *
 * @link [plugin_url]
 * @package [package]
 * @subpackage [package]/Admin/WC_Settings
 * @since [version]
 */
if ( ! defined( 'WPINC' ) ) { die; }
if ( class_exists( 'WC_Integration' ) ) :

class WooCommerce_Plugin_Boiler_Plate_Settings_Intergation extends WC_Integration {

	/**
	 * Init and hook in the integration.
	 */
	public function __construct() {
		global $woocommerce;

		$this->id                 = 'integration-demo';
		$this->method_title       = __( 'Integration Demo', PLUGIN_TXT );
		$this->method_description = __( 'An integration demo to show you how easy it is to extend WooCommerce.', PLUGIN_TXT );

		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();

		// Define user set variables.
		$this->api_key          = $this->get_option( 'api_key' );
		$this->debug            = $this->get_option( 'debug' );

		// Actions.
		add_action( 'woocommerce_update_options_integration_' .  $this->id, array( $this, 'process_admin_options' ) );

	}

	/**
	 * Initialize integration settings form fields.
	 */
	public function init_form_fields() {
		$this->form_fields = array(
			'api_key' => array(
				'title'             => __( 'API Key', PLUGIN_TXT ),
				'type'              => 'text',
				'description'       => __( 'Enter with your API Key. You can find this in "User Profile" drop-down (top right corner) > API Keys.', PLUGIN_TXT ),
				'desc_tip'          => true,
				'default'           => ''
			),
			'debug' => array(
				'title'             => __( 'Debug Log', PLUGIN_TXT ),
				'type'              => 'checkbox',
				'label'             => __( 'Enable logging', PLUGIN_TXT ),
				'default'           => 'no',
				'description'       => __( 'Log events such as API requests', PLUGIN_TXT ),
			),
		);
	}

}

endif;