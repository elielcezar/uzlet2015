<?php
/**
 * @file
 * uzlet_payment_fixes.features.field_base.inc
 */

/**
 * Implements hook_field_default_field_bases().
 */
function uzlet_payment_fixes_field_default_field_bases() {
  $field_bases = array();

  // Exported field_base: 'commerce_customer_address'
  $field_bases['commerce_customer_address'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(
      0 => 'commerce_customer_profile',
    ),
    'field_name' => 'commerce_customer_address',
    'foreign keys' => array(),
    'indexes' => array(),
    'locked' => 0,
    'module' => 'addressfield',
    'settings' => array(
      'profile2_private' => FALSE,
    ),
    'translatable' => 0,
    'type' => 'addressfield',
  );

  return $field_bases;
}
