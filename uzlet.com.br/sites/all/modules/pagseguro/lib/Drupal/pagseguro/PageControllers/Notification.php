<?php

namespace Drupal\pagseguro\PageControllers;

class Notification implements \Drupal\cool\Controllers\PageController {

  public static function getPath() {
    return 'pagseguro/notification';
  }

  public static function getDefinition() {
    return array(
      'type' => MENU_CALLBACK,
    );
  }

  /**
   * Integrating with PagSeguro notifications API
   *
   * @see https://pagseguro.uol.com.br/v2/guia-de-integracao/api-de-notificacoes.html
   */
  public static function pageCallback() {
    try {

      if (isset($_POST['notificationCode'])) {
        $notification_code = trim($_POST['notificationCode']);
        if (empty($notification_code)) {
          throw new \Exception("pagseguro_notification_page: notificationCode wasn't informed");
        }
      }
      if (isset($_POST['notificationType'])) {
        $notification_type = trim($_POST['notificationType']);
        if (empty($notification_code)) {
          throw new \Exception("pagseguro_notification_page: notificationType wasn't informed");
        }
      }

      $PagSeguroAPI = new \Drupal\pagseguro\PagSeguroAPI();
      $transaction = $PagSeguroAPI->processNotification($notification_code, $notification_type);
      $PagSeguroDrupalCommerceNotification = new \Drupal\pagseguro\PagSeguroDrupalCommerceNotification($notification_code);
      $PagSeguroDrupalCommerceNotification->createCommerceTransaction($transaction);
      $PagSeguroDrupalCommerceNotification->saveToDatabase($transaction);
    } catch (\Exception $e) {
      watchdog('pagseguro', $e->getMessage());
    }
  }

  public static function accessCallback() {
    return TRUE;
  }

}
