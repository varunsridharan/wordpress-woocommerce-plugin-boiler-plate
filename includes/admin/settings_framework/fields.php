<?php
global $fields;

$fields['general']['general'][] = array(
    'id' => PLUGIN_DB.'textbox',
    'multiple' => 'true',
    'type'    => 'text',
    'label' => __('TextBox',PLUGIN_TXT),
    'desc' => __('Simple TextBox',PLUGIN_TXT), 
    'attr'    => array( 
        'multiple' => 'multiple'
    ),
);

$fields['general']['general'][] = array(
    'id' => PLUGIN_DB.'textarea',
    'type'    => 'textarea', 
    'label' => __('Textarea',PLUGIN_TXT), 
    'attr'    => array(
        'class' => 'wc-pbp-enhanced-select',
        'multiple' => 'multiple'
    ),
);

$fields['general']['general'][] = array(
    'id' => PLUGIN_DB.'checkbox',
    'type'    => 'checkbox', 
    'label' => __('Checkbox',PLUGIN_TXT), 
    'attr'    => array(
        'class' => 'wc-pbp-enhanced-select',
        'multiple' => 'multiple'
    ),
);

$fields['general']['general'][] = array(
    'id' => PLUGIN_DB.'radio',
    'type'    => 'radio', 
    'label' => __('radio',PLUGIN_TXT), 
    'options' => array(1,2,3),
    'attr'    => array( 
        'multiple' => 'multiple'
    ),
);

$fields['general']['general'][] = array(
    'id' => PLUGIN_DB.'select',
    'type'    => 'select', 
    'label' => __('Select',PLUGIN_TXT), 
    'options' => array(1,2,3),
    'attr'    => array(),
);

$fields['general']['general'][] = array(
    'id' => PLUGIN_DB.'mselect',
    'type'    => 'select', 
    'label' => __('Multi Select',PLUGIN_TXT), 
    'options' => array(1,2,3),
    'attr'    => array(
        'multiple' => 'multiple'
    ),
);





$fields['general']['advanced'][] = array(
    'id' => PLUGIN_DB.'richtext',
    'type'    => 'richtext', 
    'label' => __('RichText Editor',PLUGIN_TXT), 
    'richtext_settings' => array('textarea_rows' => 5),
    'attr'    => array( 
        'multiple' => 'multiple'
    ),
);

$fields['general']['wpfields'][] = array(
    'id' => PLUGIN_DB.'userrole',
    'type'    => 'select',
    'select_type' => 'userrole',
    'label' => __('User Roles',PLUGIN_TXT),
    'attr'    => array( 
        'multiple' => 'multiple'
    ),
);




