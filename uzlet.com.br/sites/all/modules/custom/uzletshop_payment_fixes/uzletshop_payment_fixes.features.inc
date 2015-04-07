<?php
/**
 * @file
 * uzletshop_payment_fixes.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uzletshop_payment_fixes_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}
