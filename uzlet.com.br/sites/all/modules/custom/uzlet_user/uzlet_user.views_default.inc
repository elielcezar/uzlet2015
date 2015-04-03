<?php
/**
 * @file
 * uzlet_user.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function uzlet_user_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'perfil_usuario_endereco';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'profile';
  $view->human_name = 'perfil_usuario_endereco';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['use_more_text'] = 'mais';
  $handler->display->display_options['access']['type'] = 'none';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['exposed_form']['options']['submit_button'] = 'Aplicar';
  $handler->display->display_options['exposed_form']['options']['reset_button_label'] = 'Reiniciar';
  $handler->display->display_options['exposed_form']['options']['exposed_sorts_label'] = 'Ordenar por';
  $handler->display->display_options['exposed_form']['options']['sort_asc_label'] = 'Ascendente';
  $handler->display->display_options['exposed_form']['options']['sort_desc_label'] = 'Decrescente';
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['pager']['options']['expose']['items_per_page_label'] = 'Itens por página';
  $handler->display->display_options['pager']['options']['expose']['items_per_page_options_all_label'] = '- Tudo -';
  $handler->display->display_options['pager']['options']['tags']['first'] = '« início';
  $handler->display->display_options['pager']['options']['tags']['previous'] = '‹ anterior';
  $handler->display->display_options['pager']['options']['tags']['next'] = 'próximo ›';
  $handler->display->display_options['pager']['options']['tags']['last'] = 'fim »';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['row_plugin'] = 'fields';
  /* Rodapé: Global: Unfiltered text */
  $handler->display->display_options['footer']['area_text_custom']['id'] = 'area_text_custom';
  $handler->display->display_options['footer']['area_text_custom']['table'] = 'views';
  $handler->display->display_options['footer']['area_text_custom']['field'] = 'area_text_custom';
  /* Relationship: Perfil: Usuário uid */
  $handler->display->display_options['relationships']['user']['id'] = 'user';
  $handler->display->display_options['relationships']['user']['table'] = 'profile';
  $handler->display->display_options['relationships']['user']['field'] = 'user';
  /* Campo: Usuário: Endereço - Endereço */
  $handler->display->display_options['fields']['field_user_address_thoroughfare']['id'] = 'field_user_address_thoroughfare';
  $handler->display->display_options['fields']['field_user_address_thoroughfare']['table'] = 'field_data_field_user_address';
  $handler->display->display_options['fields']['field_user_address_thoroughfare']['field'] = 'field_user_address_thoroughfare';
  $handler->display->display_options['fields']['field_user_address_thoroughfare']['relationship'] = 'user';
  $handler->display->display_options['fields']['field_user_address_thoroughfare']['label'] = 'Logradouro';
  /* Campo: Usuário: Endereço - Premise (i.e. Apartment / Suite number) */
  $handler->display->display_options['fields']['field_user_address_premise']['id'] = 'field_user_address_premise';
  $handler->display->display_options['fields']['field_user_address_premise']['table'] = 'field_data_field_user_address';
  $handler->display->display_options['fields']['field_user_address_premise']['field'] = 'field_user_address_premise';
  $handler->display->display_options['fields']['field_user_address_premise']['relationship'] = 'user';
  $handler->display->display_options['fields']['field_user_address_premise']['label'] = 'Complemento';
  /* Campo: Usuário: Endereço - CEP */
  $handler->display->display_options['fields']['field_user_address_postal_code']['id'] = 'field_user_address_postal_code';
  $handler->display->display_options['fields']['field_user_address_postal_code']['table'] = 'field_data_field_user_address';
  $handler->display->display_options['fields']['field_user_address_postal_code']['field'] = 'field_user_address_postal_code';
  $handler->display->display_options['fields']['field_user_address_postal_code']['relationship'] = 'user';
  $handler->display->display_options['fields']['field_user_address_postal_code']['label'] = 'CEP';
  /* Campo: Usuário: Endereço - Locality (i.e. City) */
  $handler->display->display_options['fields']['field_user_address_locality']['id'] = 'field_user_address_locality';
  $handler->display->display_options['fields']['field_user_address_locality']['table'] = 'field_data_field_user_address';
  $handler->display->display_options['fields']['field_user_address_locality']['field'] = 'field_user_address_locality';
  $handler->display->display_options['fields']['field_user_address_locality']['relationship'] = 'user';
  $handler->display->display_options['fields']['field_user_address_locality']['label'] = 'Cidade';
  /* Campo: Usuário: Endereço - Administrative area (i.e. State / Province) */
  $handler->display->display_options['fields']['field_user_address_administrative_area']['id'] = 'field_user_address_administrative_area';
  $handler->display->display_options['fields']['field_user_address_administrative_area']['table'] = 'field_data_field_user_address';
  $handler->display->display_options['fields']['field_user_address_administrative_area']['field'] = 'field_user_address_administrative_area';
  $handler->display->display_options['fields']['field_user_address_administrative_area']['relationship'] = 'user';
  $handler->display->display_options['fields']['field_user_address_administrative_area']['label'] = 'Estado';
  /* Contextual filter: Perfil: Usuário uid */
  $handler->display->display_options['arguments']['user']['id'] = 'user';
  $handler->display->display_options['arguments']['user']['table'] = 'profile';
  $handler->display->display_options['arguments']['user']['field'] = 'user';
  $handler->display->display_options['arguments']['user']['exception']['title'] = 'Tudo';
  $handler->display->display_options['arguments']['user']['default_argument_type'] = 'fixed';
  $handler->display->display_options['arguments']['user']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['user']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['user']['summary_options']['items_per_page'] = '25';
  $translatables['perfil_usuario_endereco'] = array(
    t('Master'),
    t('mais'),
    t('Aplicar'),
    t('Reiniciar'),
    t('Ordenar por'),
    t('Ascendente'),
    t('Decrescente'),
    t('Itens por página'),
    t('- Tudo -'),
    t('Offset'),
    t('« início'),
    t('‹ anterior'),
    t('próximo ›'),
    t('fim »'),
    t('Usuário'),
    t('Logradouro'),
    t('Complemento'),
    t('CEP'),
    t('Cidade'),
    t('Estado'),
    t('Tudo'),
  );
  $export['perfil_usuario_endereco'] = $view;

  return $export;
}
