<?php
/**
 * @file
 * uzletshop_payment_fixes.strongarm.inc
 */

/**
 * Implements hook_strongarm().
 */
function uzletshop_payment_fixes_strongarm() {
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

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'commerce_payment_pane_require_method';
  $strongarm->value = 1;
  $export['commerce_payment_pane_require_method'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'moip_cpf_token';
  $strongarm->value = '[current-user:profile-main:field_cpf]';
  $export['moip_cpf_token'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'moip_name_token';
  $strongarm->value = '[commerce-order:commerce-customer-billing:user:name]';
  $export['moip_name_token'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'moip_phone_token';
  $strongarm->value = '[commerce-order:owner:profile-main:field_telefone]';
  $export['moip_phone_token'] = $strongarm;

  return $export;
}
