<?php

/**
 * PagSeguro integration settings.
 */
function pagseguro_admin_settings_form() {
  $form = array();
  $form['basic_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('PagSeguro API integration basic settings')
  );
  $form['basic_settings']['pagseguro_token'] = array(
    '#title' => t('PagSeguro Token'),
    '#type' => 'textfield',
    '#default_value' => variable_get('pagseguro_token')
  );
  $form['basic_settings']['pagseguro_email'] = array(
    '#title' => t('E-mail registered in PagSeguro'),
    '#type' => 'textfield',
    '#default_value' => variable_get('pagseguro_email')
  );
  $form['basic_settings']['pagseguro_show_individual_items'] = array(
    '#title' => t('Show individual items at order ?'),
    '#description' => t('Check as "Yes" if you want to show a individually description of items from an order'),
    '#type' => 'radios',
    '#options' => array('1' => t('Yes'), '0' => t('No')),
    '#default_value' => variable_get('pagseguro_show_individual_items')
  );
  $form['basic_settings']['pagseguro_display_title'] = array(
    '#type' => 'textfield',
    '#title' => t('Display title'),
    '#description' => t('Text used on the checkout page description of the payment method.'),
    '#default_value' => variable_get('pagseguro_display_title', 'PagSeguro'),
    '#required' => TRUE,
  );
  $form['basic_settings']['pagseguro_debug'] = array(
    '#type' => 'radios',
    '#title' => t('Do you want to debug every action of this module?'),
    '#options' => array(
      0 => t('No'),
      1 => t('Yes'),
    ),
    '#default_value' => variable_get('pagseguro_debug', FALSE),
    '#required' => TRUE,
  );
  // $form['basic_settings']['pagseguro_development_server'] = array(
  //   '#type' => 'radios',
  //   '#title' => t('Do you want to use a development server to work with notifications?'),
  //   '#description' => t('You can use https://github.com/bcarneiro/pagseguro-ambiente-testes (place it on http://localhost/pagseguro_server)'),
  //   '#options' => array(
  //     0 => t('No'),
  //     1 => t('Yes'),
  //   ),
  //   '#default_value' => variable_get('pagseguro_development_server', FALSE),
  //   '#required' => TRUE,
  // );
  $form['advanced_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Advanced settings')
  );
  $form['advanced_settings']['display'] = array(
    '#type' => 'fieldset',
    '#title' => t('Order display'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE
  );
  $form['advanced_settings']['display']['pagseguro_order_reason_token'] = array(
    '#type' => 'textfield',
    '#title' => t('Order Reason Token'),
    '#description' => t('What title do you want to use for the orders sent to PagSeguro. The default is "Order @order_number at @store". <strong>You can use tokens</strong> here(see the tokens browser above).'),
    '#default_value' => variable_get('pagseguro_order_reason_token'),
  );
  $form['advanced_settings']['display']['tokens'] = array(
    '#theme' => 'token_tree',
    '#token_types' => array('commerce-order'),
  );
  return system_settings_form($form);
}