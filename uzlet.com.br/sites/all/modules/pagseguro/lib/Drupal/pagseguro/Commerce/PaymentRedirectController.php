<?php

namespace Drupal\pagseguro\Commerce;

class PaymentRedirectController {

  static public function processData($form, &$form_state, $order, $payment_method) {
    try {

      $PagSeguroAPI = new \Drupal\pagseguro\PagSeguroAPI();
      $pagSeguroPaymentRequestObject = $PagSeguroAPI->createPaymentRequestObject();
      $PagSeguroDrupalCommerce = new \Drupal\pagseguro\PagSeguroDrupalCommerce($pagSeguroPaymentRequestObject);

      $PagSeguroDrupalCommerce->addItemsToRequest($order);

      // Sets a redirect url to forward after payment
      $url = url('checkout/' . $order->order_id . '/payment/return/' . $order->data['payment_redirect_key'], array('absolute' => TRUE));
      $PagSeguroDrupalCommerce->setRedirectUrl($url);

      $order_wrapper = entity_metadata_wrapper('commerce_order', $order);

      if (isset($order_wrapper->commerce_customer_billing->commerce_customer_address)) {
        //Sets your customer information.
        $payer = array(
          'name' => $order_wrapper->commerce_customer_billing->commerce_customer_address->name_line->value(),
          'email' => $order_wrapper->mail->value(),
        );
        $PagSeguroDrupalCommerce->setSender($payer);

        $thoroughfare = explode(',', $order_wrapper->commerce_customer_billing->commerce_customer_address->thoroughfare->value());

        //Sets your customer shipping address.       
        $shipping = array(
          'postalcode' => $order_wrapper->commerce_customer_billing->commerce_customer_address->postal_code->value(),
          'street' => trim($thoroughfare[0]),
          'number' => trim($thoroughfare[1]),
          'complement' => $order_wrapper->commerce_customer_billing->commerce_customer_address->premise->value(),
          'city' => $order_wrapper->commerce_customer_billing->commerce_customer_address->locality->value(),
          'state' => $order_wrapper->commerce_customer_billing->commerce_customer_address->administrative_area->value(),
        );

        /*
         * Sub-premise is commonly used in the brazilian shipping services, but
         * Addresfield module doesn't know it yet(see more in http://drupal.org/node/973056)
         */
        if (isset($order_wrapper->commerce_customer_billing->commerce_customer_address->sub_premise)) {
          $shipping['district'] = $order_wrapper->commerce_customer_billing->commerce_customer_address->dependent_locality->value();
        }

        $PagSeguroDrupalCommerce->setShippingAddress($shipping);
      }

      $PagSeguroDrupalCommerce->registerPaymentRequest();
      drupal_goto($PagSeguroDrupalCommerce->getPaymentUrl());
    } catch (Exception $e) {
      drupal_set_message(t("There was an error in the communication between us and PagSeguro. Our development team was informed. Please try again another time."), 'error');
      watchdog('pagseguro', $e->getMessage());
      return false;
    }
  }

}
