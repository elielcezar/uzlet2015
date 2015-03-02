<?php

namespace Drupal\pagseguro_dashboard\PageControllers;

class Dashboard implements \Drupal\cool\Controllers\PageController {

  public static function getPath() {
    return 'admin/pagseguro';
  }

  public static function getDefinition() {
    return array(
      'title' => t('PagSeguro'),
    );
  }

  /**
   * Integrating with PagSeguro notifications API
   *
   * @see https://pagseguro.uol.com.br/v2/guia-de-integracao/api-de-notificacoes.html
   */
  public static function pageCallback() {
    $PagSeguroAPI = new \Drupal\pagseguro\PagSeguroAPI();
    $transactions = $PagSeguroAPI->getTransactionsFromLastMonth();
    $transactions += $PagSeguroAPI->getTransactionsFromCurrentMonth();

    if (!empty($transactions)) {

      $items = array();
      foreach ($transactions as $transaction) {
        $items[] = array(
          'code' => $transaction->getCode(),
          'gross_amount' => $transaction->getGrossAmount(),
          'pagseguro_tax' => $transaction->getFeeAmount(),
          'status' => $transaction->getStatus()->getTypeFromValue(),
          'created' => format_date(strtotime($transaction->getDate()), 'short'),
          'reference' => l('view order', 'admin/commerce/orders/' . $transaction->getReference()),
        );
      }

      return array(
        '#theme' => 'table',
        '#caption' => t('Total of transaction: @total', array('@total' => count($items))),
        '#header' => array(
          t('Transaction Code'),
          t('Gross amount'),
          t('PagSeguro Tax'),
          t('Status'),
          t('Created on'),
          t('Related Order'),
        ),
        '#rows' => $items,
        '#empty' => t('Your table is empty'),
        '#prefix' => l('Pagseguro settings', 'admin/config/services/pagseguro'),
      );
    } else {
      drupal_set_message(t("Any transactions were made in the current month"));
      return '';
    }
  }

  public static function accessCallback() {
    return user_access('administer pagseguro');
  }

}
