<?php
/**
 * @file
 * uzlet_user.strongarm.inc
 */

/**
 * Implements hook_strongarm().
 */
function uzlet_user_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'commerce_extra_address_populate';
  $strongarm->value = 'field_user_address';
  $export['commerce_extra_address_populate'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'commerce_extra_address_populate_settings';
  $strongarm->value = array(
    'customer_profile_billing' => 'field_user_address',
    'customer_profile_shipping' => 'field_user_address',
  );
  $export['commerce_extra_address_populate_settings'] = $strongarm;

  return $export;
}
