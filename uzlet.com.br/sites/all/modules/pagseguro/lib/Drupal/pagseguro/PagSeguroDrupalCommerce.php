<?php

namespace Drupal\pagseguro;

class PagSeguroDrupalCommerce {

  const PAGSEGURO_CURRENCY = 'BRL';

  private $pagSeguroPaymentRequest;
  private $paymentUrl;
  private $showIndividualItems;

  public function __construct(\PagSeguroPaymentRequest $pagSeguroPaymentRequestObject) {
    $this->pagSeguroPaymentRequest = $pagSeguroPaymentRequestObject;
    $this->showIndividualItems = variable_get('pagseguro_show_individual_items');
  }

  /**
   * Sets your customer information.   
   */
  public function setSender($payerData) {
    $payer = $payerData['name'];
    $email = $payerData['email'];

    $phone_ddd = NULL;
    $phone_number = NULL;

    //variable pagseguro_phone_token expects a value in format (99)999999999 
    $phone_token = variable_get('pagseguro_phone_token');

    if (isset($phone_token)) {
      $phone = token_replace($phone_token);
      $phone_ddd = substr($phone, 1, 2);
      $phone_number = substr($phone, 4, 9);
    }

    $this->pagSeguroPaymentRequest->setSender($payer, $email, $phone_ddd, $phone_number);
  }

  /**
   * Sets your customer shipping information   
   */
  public function setShippingAddress($data) {

    $CODIGO_SEDEX = \PagSeguroShippingType::getCodeByType('NOT_SPECIFIED');
    $this->pagSeguroPaymentRequest->setShippingType($CODIGO_SEDEX);

    $district = isset($data['district']) ? $data['district'] : NULL;
    $this->pagSeguroPaymentRequest->setShippingAddress($data['postalcode'], $data['street'], $data['number'], $data['complement'], $district, $data['city'], $data['state'], 'BRA');
  }

  /*
   * Receive an order and insert all items at PagSeguroPaymentRequest
   */

  public function addItemsToRequest($order) {
    $order_wrapper = entity_metadata_wrapper('commerce_order', $order);
    $this->pagSeguroPaymentRequest->setCurrency(self::PAGSEGURO_CURRENCY);
    $this->pagSeguroPaymentRequest->setReference($order->order_number);

    if ($this->showIndividualItems) {
      // case option "show individual items" is checked 
      foreach ($order->commerce_line_items['und'] as $item) {
        $line_item = commerce_line_item_load($item['line_item_id']);
        $product_id = $line_item->commerce_product['und'][0]['product_id'];
        $commerce_product = commerce_product_load($product_id);
        $line_item_quantity = round($line_item->quantity);
        $product_sku = $commerce_product->sku;
        $product_title = $commerce_product->title;
        $product_price_amount = $commerce_product->commerce_price['und'][0]['amount'];
        $product_price = round(commerce_currency_amount_to_decimal($product_price_amount, self::PAGSEGURO_CURRENCY), 2);

        //adding item to request
        $this->pagSeguroPaymentRequest->addItem($product_sku, $product_title, $line_item_quantity, $product_price);
      }
    } else {
      // case not showing individual items
      $order_number = $order_wrapper->order_number->value();
      $pagseguro_order_reason_token = variable_get('pagseguro_order_reason_token');

      if (empty($pagseguro_order_reason_token)) {
        $reason = t('Order @order_number at @store', array('@order_number' => $order_number, '@store' => variable_get('site_name', url('<front>', array('absolute' => TRUE)))));
      } else {
        $reason = token_replace($pagseguro_order_reason_token);
      }

      $amount_integer = $order_wrapper->commerce_order_total->amount->value();
      $order_total = round(commerce_currency_amount_to_decimal($amount_integer, self::PAGSEGURO_CURRENCY), 2);

      //adding item to request
      $this->pagSeguroPaymentRequest->addItem($order_number, $reason, '1', $order_total);
    }
  }

  /**
   * Register the payment request in PagSeguro, to obtain the payment URL for redirect your customer.
   */
  public function registerPaymentRequest() {
    try {
      $pagseguro_email = variable_get('pagseguro_email');
      $pagseguro_token = variable_get('pagseguro_token');
      $credentials = new \PagSeguroAccountCredentials($pagseguro_email, $pagseguro_token);
      $url = $this->pagSeguroPaymentRequest->register($credentials);
      $this->paymentUrl = $url;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  /**
   * Register a redirect url returning to origin site after payment
   */
  public function setRedirectUrl($url) {
    $this->pagSeguroPaymentRequest->setRedirectUrl($url);
  }

  /**
   * Returns a payment url    
   */
  public function getPaymentUrl() {
    if (isset($this->paymentUrl)) {
      return $this->paymentUrl;
    }
  }

}
