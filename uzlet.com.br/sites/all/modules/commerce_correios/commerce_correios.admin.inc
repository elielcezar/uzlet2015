<?php

/**
 * @file
 * Handles admin settings page for Commerce Brazilian Correios module.
 */

/**
 * Module settings form.
 */
function commerce_correios_settings_form($form, &$form_state) {
  $form['commerce_correios_info'] = array(
    '#markup' => '<fieldset style="padding:10px"><legend>'
    . t('Documentation about Correios Shipping Services') . '</legend>'
    . '<p>' . t('For more information about Correios Shipping Services, go to ')
    . 'http://www.correios.com.br/voce/enviar/encomendas.cfm</p>'
    . '<p>' . t('For more information about Correios Shipping Services webservice, go to ')
    . 'http://www.correios.com.br/webServices/PDF/SCPP_manual_implementacao_calculo_remoto_de_precos_e_prazos.pdf</p></fieldset>'
  );
  $form['commerce_correios_store_postal_code'] = array(
    '#type' => 'textfield',
    '#title' => t('Store postal code'),
    '#description' => t('Enter store location postal code. Only numbers.'),
    '#default_value' => variable_get('commerce_correios_store_postal_code', ''),
    '#required' => TRUE,
  );
  $services_available = _commerce_correios_services_types();
  $options = array();
  foreach ($services_available as $id => $service) {
    $options[$id] = $service['title'] . ' (' . $service['description'] . ')';
  }
  $form['commerce_correios_services'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Services'),
    '#description' => t('Choose what services to enable. You can find more information about Correios services in <a href="http://www.correios.com.br/voce/enviar/encomendas.cfm">this page</a>.'),
    '#options' => $options,
    '#default_value' => variable_get('commerce_correios_services', array()),
    '#required' => TRUE,
  );
  $form['commerce_correios_default_weight'] = array(
    '#type' => 'textfield',
    '#title' => t('Default package weight'),
    '#description' => t('In kilograms. Enter an integer or decimal value.'),
    '#default_value' => variable_get('commerce_correios_default_weight', 1),
  );
  $form['commerce_correios_default_width'] = array(
    '#type' => 'textfield',
    '#title' => t('Default package width'),
    '#description' => t('Enter an integer between 11 and 105.'),
    '#default_value' => variable_get('commerce_correios_default_width', 16),
  );
  $form['commerce_correios_default_height'] = array(
    '#type' => 'textfield',
    '#title' => t('Default package height'),
    '#description' => t('Enter an integer between 2 and 105.'),
    '#default_value' => variable_get('commerce_correios_default_height', 2),
  );
  $form['commerce_correios_default_length'] = array(
    '#type' => 'textfield',
    '#title' => t('Default package length'),
    '#description' => t('Enter an integer between 16 and 105.'),
    '#default_value' => variable_get('commerce_correios_default_length', 5),
  );

  $form['#validate'][] = 'commerce_correios_settings_form_validate';

  return system_settings_form($form);
}

/**
 * Module settings form validation callback.
 */
function commerce_correios_settings_form_validate($form, &$form_state) {
  // @todo Add validation for dimensions min/max values.
}
