<?php

namespace Drupal\pagseguro;

class PagSeguroDrupalCommerceNotification {

  private $notificationCode;
  private $previousData;
  private $paymentMethod = 'pagseguro_api';

  public function __construct($notification_code) {
    $this->notificationCode = $notification_code;
//    loadPreviousValues();
  }

  /**
   * check at table pagseguro_notifications if there's a previous register for 
   * this order
   */
  public function hasPreviousValue() {
    if (isset($this->previousData)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /**
   * load a previous notification history of an Order
   */
  public function loadPreviousValues() {
    $query = db_select('pagseguro_notification', 'pgs')
      ->fields('pgs')
      ->condition('order_id', $this->notificationCode)
      ->execute()
      ->fetchAssoc();
    $result = $query->execute();

    $this->previousData = $result;

    watchdog('pagseguro_notification_previous_value', '<pre>' . print_r($result, TRUE) . '</pre>');
  }

  public function saveToDatabase($transaction) {

    $order_amount = floatval($transaction->getGrossAmount()) * 100;
    $order_status = $transaction->getStatus()->getTypeFromValue();
    $order_reference = $transaction->getReference();
    $order_email_consumidor = ''; //TODO

    if ($this->hasPreviousValue()) {
      $changed = REQUEST_TIME;
    } else {
      $created = REQUEST_TIME;
    }

    $notification = array(
      'notification_code' => $this->notificationCode,
      'valor' => $order_amount,
      'status_pagamento' => $order_status,
      'email_consumidor' => $order_email_consumidor,
      'order_id' => $order_reference,
      'created' => $created,
      'changed' => $changed,
    );

    drupal_write_record('pagseguro_notification', $notification);
  }

  /**
   * create a transaction based on an array
   */
  public function createCommerceTransaction($transaction) {

    $order_reference = $transaction->getReference();
    $order_amount = floatval($transaction->getGrossAmount()) * 100;
    $order_status = $transaction->getStatus()->getTypeFromValue();

    $transaction = commerce_payment_transaction_new($this->paymentMethod, $order_reference);
    $transaction->instance_id = $this->paymentMethod;
    $transaction->remote_id = $this->notificationCode;
    $transaction->amount = $order_amount;

    // PagSeguro supports only Brazilian Reais.
    $transaction->currency_code = 'BRL';
    $transaction->payload[REQUEST_TIME] = time();

    // Set the transaction's statuses based on the NASP's status_pagamento.
    $transaction->remote_status = $order_status;

    $converted_status = self::convertStatus($transaction->remote_status);
    $transaction->status = $converted_status['transaction'];
    $transaction->message = $converted_status['description'];

    $order = commerce_order_load($order_reference);

    if (!is_object($order)) {
      return FALSE;
    }

    commerce_payment_transaction_save($transaction);
    commerce_order_status_update($order, $converted_status['order']);
  }

  /**
   * Convertes a numeric status from PagSeguroApi to an equivalent string status 
   * of commerce_payment
   */
  public function convertStatus($status) {
    $return = array();
    switch ($status) {
      case PAGSEGURO_STATUS_AWAITING: // Awaiting payment.
        $return['order'] = 'awaiting';
        $return['transaction'] = COMMERCE_PAYMENT_STATUS_PENDING;
        $return['description'] = t('The payment will be made or is waiting an offline payment.');
        break;
      case PAGSEGURO_STATUS_IN_ANALYSIS: // Payment in analysis.
        $return['order'] = 'awaiting';
        $return['transaction'] = COMMERCE_PAYMENT_STATUS_PENDING;
        $return['description'] = t('The customer has paid with a credit card, the payment is waiting manual review from PagSeguro team.');
        break;
      case PAGSEGURO_STATUS_PAID: // Paid.
        $return['order'] = 'payment_received';
        $return['transaction'] = COMMERCE_PAYMENT_STATUS_SUCCESS;
        $return['description'] = t('The payment authorized but not completed yet due to the normal flow of chosen payment method.');
        break;
      case PAGSEGURO_STATUS_AVAILABLE: // Available.
        $return['order'] = 'payment_available';
        $return['transaction'] = COMMERCE_PAYMENT_STATUS_SUCCESS;
        $return['description'] = t('The payment completed, the money was credited in the recipient account.');
        break;
      case PAGSEGURO_STATUS_DISPUTED: // Payment disputed.
        $return['order'] = 'payment_disputed';
        $return['transaction'] = COMMERCE_PAYMENT_STATUS_FAILURE;
        $return['description'] = t('The payment was disputed by customer.');
        break;
      case PAGSEGURO_STATUS_REFUNDED: // Payment refunded.
        $return['order'] = 'payment_refunded';
        $return['transaction'] = COMMERCE_PAYMENT_STATUS_FAILURE;
        $return['description'] = t('The payment was refunded to customer.');
        break;
      case PAGSEGURO_STATUS_CANCELED: // Payment canceled.
        $return['order'] = 'canceled';
        $return['transaction'] = COMMERCE_PAYMENT_STATUS_FAILURE;
        $return['description'] = t('The payment was canceled by the customer, payment institution, PagSeguro or recipient account.');
        break;
      case WAITING_PAYMENT:
        $return['order'] = 'awaiting';
        $return['transaction'] = COMMERCE_PAYMENT_STATUS_PENDING;
        $return['description'] = t('The payment will be made or is waiting an offline payment.');
        break;
      default:
        $return['order'] = 'awaiting';
        $return['transaction'] = COMMERCE_PAYMENT_STATUS_PENDING;
        $return['description'] = t('The payment will be made or is waiting an offline payment.');
    }
    return $return;
  }

}
