(function() {
  (function($) {
    // As we are putting all the panes at the same checkout page, the
    // submitCheckoutForm method from moip module because it expects the
    // payment method pane to be in a different checkout page.
    if (Drupal.Moip &&
        Drupal.Moip.CT &&
        Drupal.Moip.CT.submitCheckoutForm) {
      Drupal.Moip.CT.submitCheckoutForm = function() {
        if (Drupal.Moip.CT.answer.length === 0) {
          if (typeof jdog_error === "function") {
            jdog_error("moip_js_error", Drupal.t('The Moip "Answer" came empty'));
          }
        } else {
          $(".moip-ct-answer").val(Drupal.Moip.CT.answer);
          $("#moip-ct-js-form").remove();
          $("#edit-buttons input.checkout-continue").click();
        }
      };
    };
  })(jQuery);
}).call(this);
