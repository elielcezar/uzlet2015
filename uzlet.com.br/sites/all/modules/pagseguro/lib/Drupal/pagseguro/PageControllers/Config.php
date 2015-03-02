<?php

namespace Drupal\pagseguro\PageControllers;

class Config implements \Drupal\cool\Controllers\PageController {

  public static function getPath() {
    return 'admin/config/services/pagseguro';
  }

  public static function getDefinition() {
    return array(
      'title' => 'PagSeguro',
      'description' => t('Provides integration with PagSeguro, a Brazilian payment provider'),
    );
  }

  /**
   * Integrating with PagSeguro notifications API
   *
   * @see https://pagseguro.uol.com.br/v2/guia-de-integracao/api-de-notificacoes.html
   */
  public static function pageCallback() {
    return \Drupal\pagseguro\FormControllers\Config::getForm();
  }

  public static function accessCallback() {
    return user_access('administer pagseguro');
  }

}
