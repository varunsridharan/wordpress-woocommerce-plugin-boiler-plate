<?php
/**
 * Integration Demo Integration.
 *
 * @package  WC_Integration_Demo_Integration
 * @category Integration
 * @author   Patrick Rauland
 */

if ( class_exists( 'WC_Integration' ) ) :

class Broken_Url_Notifier_Settings_Intergation extends WC_Integration {

	/**
	 * Init and hook in the integration.
	 */
	public function __construct() {
		global $woocommerce;

		$this->id                 = 'integration-demo';
		$this->method_title       = __( 'Integration Demo', 'woocommerce-integration-demo' );
		$this->method_description = __( 'An integration demo to show you how easy it is to extend WooCommerce.', 'woocommerce-integration-demo' );

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
				'title'             => __( 'API Key', 'woocommerce-integration-demo' ),
				'type'              => 'text',
				'description'       => __( 'Enter with your API Key. You can find this in "User Profile" drop-down (top right corner) > API Keys.', 'woocommerce-integration-demo' ),
				'desc_tip'          => true,
				'default'           => ''
			),
			'debug' => array(
				'title'             => __( 'Debug Log', 'woocommerce-integration-demo' ),
				'type'              => 'checkbox',
				'label'             => __( 'Enable logging', 'woocommerce-integration-demo' ),
				'default'           => 'no',
				'description'       => __( 'Log events such as API requests', 'woocommerce-integration-demo' ),
			),
		);
	}

}

endif;