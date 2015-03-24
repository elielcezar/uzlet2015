<?php
/**
 * @file
 * uzlet_payment_fixes.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uzlet_payment_fixes_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}
