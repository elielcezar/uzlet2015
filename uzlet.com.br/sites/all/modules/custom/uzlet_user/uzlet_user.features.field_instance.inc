<?php
/**
 * @file
 * uzlet_user.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function uzlet_user_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance: 'user-user-field_user_address'
  $field_instances['user-user-field_user_address'] = array(
    'bundle' => 'user',
    'default_value' => array(
      0 => array(
        'element_key' => 'user|user|field_user_address|und|0',
        'thoroughfare' => '',
        'premise' => '',
        'dependent_locality' => '',
        'locality' => '',
        'administrative_area' => '',
        'postal_code' => '',
        'country' => 'BR',
        'name_line' => '',
      ),
    ),
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'addressfield',
        'settings' => array(
          'format_handlers' => array(
            0 => 'address',
          ),
          'use_widget_handlers' => 1,
        ),
        'type' => 'addressfield_default',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'user',
    'field_name' => 'field_user_address',
    'label' => 'Endereço',
    'required' => 1,
    'settings' => array(
      'user_register_form' => 1,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'addressfield',
      'settings' => array(
        'available_countries' => array(
          'BR' => 'BR',
        ),
        'br_address_options' => array(
          'autocomplete_city' => 1,
          'cep_query' => 1,
        ),
        'format_handlers' => array(
          'br-address' => 'br-address',
          'name-oneline' => 'name-oneline',
          'address' => 0,
          'address-hide-country' => 0,
          'organisation' => 0,
          'name-full' => 0,
        ),
      ),
      'type' => 'addressfield_standard',
      'weight' => 3,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Endereço');

  return $field_instances;
}
