<?php

class PagSeguroAPI {

  // Setting private variables needed by the API
    var $email, $token;
  // Setting private variables that could use default values
    var $page_number = 1, $max_page_results = 20;

  public function __construct() {
    $this->email = variable_get('pagseguro_email');
    $this->token = variable_get('pagseguro_token');
    $this->load();
  }

  private function getCredentials() {
    return new PagSeguroAccountCredentials($this->email, $this->token);
  }

  /**
   * Register a new Payment Request on PagSeguro
   * @param PagSeguroPaymentRequest $request
   * @return string
   */
  public function registerPaymentRequest(PagSeguroPaymentRequest $request) {
    $this->load(array('service/PagSeguroPaymentService'));
    return PagSeguroPaymentService::createCheckoutRequest($this->getCredentials(), $request);
  }

  /**
   * Create a new Payment Request object to be populated
   * @return PagSeguroPaymentRequest
   */
  public function createPaymentRequestObject() {
    $this->load(array(
      'domain/PagSeguroPaymentRequest',
      'service/PagSeguroPaymentService'
      )
    );
    return new PagSeguroPaymentRequest();
  }

  /**
   * 
   * @param type $notificationCode
   * @return type
   */
  public function processNotification($notificationCode, $notification_type) {

    $this->load(array(
      'domain/PagSeguroNotificationType',
      'service/PagSeguroNotificationService')
    );
    $notification_type = new PagSeguroNotificationType($notification_type);
    $str_type = $notification_type->getTypeFromValue();

    switch ($str_type) {

      case 'TRANSACTION':
        try {

          $result = PagSeguroNotificationService::checkTransaction($this->getCredentials(), $notificationCode);
          return $this::getResult($result);
        } catch (Exception $e) {
          watchdog('pagseguro', t($e->getMessage()));
        }
        break;

      default:
        watchdog('pagseguro', t('Unknown notification type [@type]', array('@type' => $notification_type->getValue())));
    }
  }

  /**
   * Simplify the search for a specific transaction by its code
   * 
   * @return PagSeguroTransaction object
   */
  public function getTransactionsByCode($code = NULL) {
    if (empty($code)) {
      watchdog('pagseguro', 'PagSeguroAPI->getTransactionsByCode($code) was called without a $code: <pre>' . print_r(debug_backtrace(), TRUE) . '</pre>');
      throw new Exception(t('Internal error on PagSeguro integration'));
    }

    try {

      $result = PagSeguroTransactionSearchService::searchByCode($this->getCredentials(), $code);

      return $this::getResult($result);
    } catch (PagSeguroServiceException $e) {
      die($e->getMessage());
    }
  }

  /**
   * Simplify the search for transactions ocurred in the current month
   * 
   * @return array
   */
  public function getTransactionsFromCurrentMonth() {
    $initial_date_timestamp = mktime(0, 0, 0, date('n'), 1, (int) date('y'));
    $initial_date = date('Y-m-d\TH:i', $initial_date_timestamp);
    $final_date = date('Y-m-d\TH:i', time());
    return $this->getTransactionsByTimeRange($initial_date, $final_date);
  }

  /**
   * Simplify the search for transactions ocurred in the last month
   * 
   * @return array
   */
  public function getTransactionsFromLastMonth() {
    $current_year = (int) date('y');
    $current_month = date('n') - 1;
    return $this->getTransactionsFromMonth($current_year, $current_month);
  }

  /**
   * Simplify the search for transactions ocurred in a specific month and year
   * 
   * @param int $year A two digit representation of a year, without leading zeros. Example: 99 or 3
   * @param int $month
   * @return type
   */
  public function getTransactionsFromMonth($year, $month) {
    $initial_date_timestamp = mktime(0, 0, 0, $month, 1, $year);
    $initial_date = date('Y-m-d\TH:i', $initial_date_timestamp);
    // check if it is the current month
    if (((int) date('y') == (int) $year) && (date('n') == $month)) {
      $final_date = date('Y-m-d\TH:i', time());
    }
    else {
      $final_date = mktime(23, 59, 59, $month, date('t', $initial_date), $year);
    }
    return $this->getTransactionsByTimeRange($initial_date, $final_date);
  }

  /**
   * Search for transactions ocurred in the specified time range
   * 
   * @param string $initial_date in the format "Y-m-d\TH:i"
   * @param string $final_date in the format "Y-m-d\TH:i"
   * @return array
   * @throws Exception
   */
  public function getTransactionsByTimeRange($initial_date = NULL, $final_date = NULL) {

    if (empty($initial_date) && empty($final_date)) {
      watchdog('pagseguro', 'There is something wrong with a function/method calling PagSeguro API');
      throw new Exception(t('Internal error on PagSeguro integration'));
    }

    try {

      $result = PagSeguroTransactionSearchService::searchByDate($this->getCredentials(), $this->page_number, $this->max_page_results, $initial_date, $final_date);

      return $this::getResult($result);
    } catch (PagSeguroServiceException $e) {
      die($e->getMessage());
    }
  }

  /**
   * Simplify PagSeguro integration, converting every return object type into 
   * an array of PagSeguroTransactionSummary items
   * 
   * @param $result
   * @return array
   */
  private function getResult($result) {

    switch (get_class($result)) {
      case 'PagSeguroTransaction':
        return $result;
        break;
      case 'PagSeguroTransactionSearchResult':
        $transactions = $result->getTransactions();
        if (is_array($transactions) && count($transactions) > 0) {
          return $transactions;
        }
        else {
          return array();
        }
        break;
    }
  }

  /**
   * Responsible to find and load PagSeguroLibrary.php file
   */
  public function load($extra_class = NULL) {
    $error = FALSE;
    $pagseguro_lib_url = 'https://pagseguro.uol.com.br/v2/guia-de-integracao/tutorial-da-biblioteca-pagseguro-em-php.html';
    $path = 'sites/all/libraries/pagseguro-php/source/PagSeguroLibrary';
    if (file_exists($path)) {
      require_once $path . '/PagSeguroLibrary.php';
      if (class_exists('PagSeguroLibrary')) {
        $PagSeguroLibrary = PagSeguroLibrary::init();

        if (!$this->isValidVersion($PagSeguroLibrary)) {
          $error = t('You need PagSeguro library version !minimal_version or later. Download it in !link', array('!link' => $pagseguro_lib_url, '!minimal_version' => PAGSEGURO_MINIMAL_VALID_VERSION));
        }
        if (!$error && !empty($extra_class)) {
          foreach ($extra_class as $class) {
            require_once $path . '/' . $class . '.class.php';
          }
        }
      }
      else {
        $error = t('PagSeguro library specified is not the correct one. Download it in !link', array('!link' => $pagseguro_lib_url));
      }
    }
    else {
      $error = t('PagSeguro library was not found on "sites/all/libraries/pagseguro-php". Download it in !link', array('!link' => $pagseguro_lib_url));
    }
    if ($error) {
      throw new Exception($error);
    }
  }

  /**
   * 
   * @param PagSeguroLibrary $PagSeguroLibrary
   */
  public function isValidVersion(PagSeguroLibrary $PagSeguroLibrary) {
    $current_version = $PagSeguroLibrary->getVersion();
    $current_version_arr = explode('.', $current_version);
    $current_version_arr_size = count($current_version);
    $minimal_version_arr = explode('.', PAGSEGURO_MINIMAL_VALID_VERSION);
    $minimal_version_arr_size = count($minimal_version_arr);

    $bigger_arr_size = $current_version_arr_size > $minimal_version_arr_size ? $current_version_arr_size : $minimal_version_arr_size;

    if ($current_version_arr_size != $minimal_version_arr_size) {
      if ($current_version_arr_size < $minimal_version_arr_size) {
        $diff = $minimal_version_arr_size - $current_version_arr_size;
        for ($i = 0; $i < $diff; $i++) {
          $current_version_arr[] = 0;
        }
      }
      else {
        $diff = $current_version_arr_size - $minimal_version_arr_size;
        for ($i = 0; $i < $diff; $i++) {
          $minimal_version_arr[] = 0;
        }
      }
    }

    for ($i = 0; $i <= $bigger_arr_size; $i++) {
      if (!isset($current_version[$i])) {
        $current_version[$i] = 0;
      }
      if (!isset($minimal_version_arr[$i])) {
        $minimal_version_arr[$i] = 0;
      }
      if ($current_version_arr[$i] < $minimal_version_arr[$i]) {
        return false;
      }
    }

    return true;
  }

}