<?php
global $fields;

/** General Settings **/
$fields['settings_general']['general'][] = array(
    'id'      =>  PLUGIN_DB.'redirect_user',
    'type'    => 'select',
    'label'   => __( 'Redirect User To', PLUGIN_TXT),
    'desc'    => __( 'After Donation Added To Cart',PLUGIN_TXT),
    'size '   => 'small',
    'options' => array('cart' => __('Cart Page',PLUGIN_TXT) , 'checkout' => __('Checkout Page',PLUGIN_TXT)),
    'attr'    => array('class' => 'wc-enhanced-select','style' => 'width:auto;max-width:35%;')
); 


/** Message Settings **/
$fields['settings_message']['message'][] =  array(
	'desc'  => sprintf(__( '<span> Add <code>%s</code> To Get Ented Amount By User.</span>  <br/>
               <span> Add <code>%s</code> To Get Minimum Required Amount From Selected Project </span>   <br/>
               <span> Add <code>%s</code> To Get Minimum Required Amount From Selected Project  </span>',PLUGIN_TXT),'{donation_amount}','{min_amount}','{max_amount}'),
	'id'    =>  PLUGIN_DB.'empty_donation_msg_1',
    'attr'  => array('style' => 'min-width:50%; width:auto;max-width:75%;'),
	'type'  => 'content'
);


$fields['settings_message']['message'][] =  array(
	'label' => __( 'Donation Conflict', PLUGIN_TXT),
	'desc'  => __( 'Custom Message To Show When User Trying To Add Donation With Other Products',PLUGIN_TXT),
	'id'    =>   PLUGIN_DB.'donation_with_other_products',
    'attr'  => array('style' => 'min-width:50%; width:auto;max-width:75%;'),
	'type'  => 'textarea'
);


/** Shortcode Settings **/
$fields['settings_shortcode']['shortcode'][] = array(
	'id'      =>  PLUGIN_DB.'default_render_type',
    'type'    => 'select',
    'label'   => __( 'Pre Selected Project Name', PLUGIN_TXT),
    'desc'    => __( 'default project render type',PLUGIN_TXT),
    'size '   => 'small',
    'options' => array('select' => __('Select Box',PLUGIN_TXT), 'radio' => __('Radio Button',PLUGIN_TXT)),
    'attr'    => array('class' => 'wc-enhanced-select','style' => 'width:auto;max-width:35%;')		
);

$fields['settings_shortcode']['shortcode'][] = array(
	'id'      =>  PLUGIN_DB.'shortcode_show_errors',
    'type'    => 'select',
    'label'   => __( 'Show Errors', PLUGIN_TXT),
    'desc'    => __( 'Set to hide errors when <code> wc_print_notice</code> called before loading dontion form',PLUGIN_TXT),
    'size '   => 'small',
    'options' => array('true' => __('Show Errors',PLUGIN_TXT), 'false' => __('Hide Errors',PLUGIN_TXT)),
    'attr'    => array('class' => 'wc-enhanced-select','style' => 'width:auto;max-width:35%;')		
);