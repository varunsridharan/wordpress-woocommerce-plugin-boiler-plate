<?php
global $send_fields;

if (empty($send_fields[PLUGIN_DB.'payment_gateway'])) {
    add_settings_error(PLUGIN_DB.'payment_gateway','', __( 'Error: Please Select Atlest 1 Payment Gateway.', PLUGIN_TXT ),'error');
}