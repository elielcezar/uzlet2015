(function() {
  (function($) {
    Drupal.behaviors.MoipCT = {
      attach: function(context, settings) {
        $("#edit-commerce-payment-payment-method.form-radios input", context).change(function() {
          if ($(this).val() === "moip_ct|commerce_payment_moip_ct") {
            $("#edit-buttons input.checkout-continue").hide();
            $("#edit-buttons").addClass("moip-ct");
          } else {
            $("#moip-ct-js-form").hide();
            $("#edit-buttons input.checkout-continue").show();
            $("#edit-buttons").removeClass("moip-ct");
          }
        });
        $(".payment-way.creditcard .number input", context).blur(function() {
          var card;
          if (moip.creditCard.isValid($(this).val())) {
            card = moip.creditCard.cardType($(this).val());
            $(".payment-way.creditcard .number .help").empty().removeClass().addClass("help").addClass("payment-icon-creditcard-" + card.brand.toLowerCase()).css("width", "60px").css("height", "35px").css("margin", "0 0 -15px");
          } else {
            $(".payment-way.creditcard .number .help").removeClass().addClass("help").removeAttr("style");
          }
        });
        $(".payment-way.creditcard .securitycode input", context).keyup(function() {
          var securitycode;
          securitycode = $(this).val();
          if (securitycode.length > 4) {
            $(this).val(securitycode.substring(0, securitycode.length - 1));
          }
        });
        $("#edit-commerce-payment-payment-details-moip-ct-payment-way .form-radio", context).change(function() {
          var moip_ct_button;
          $("#moip-ct-messages").empty().hide();
          $("#moip-ct-buttons").show();
          $("#moip-ct-js-form .payment-way").hide();
          $("#moip-ct-js-form .payment-way." + this.value).show();
          if (this.value === "creditcard") {
            $("#moip-ct-submit").text(Drupal.t("Pay with credit card"));
          } else if (this.value === "bankbillet") {
            $("#moip-ct-submit").text(Drupal.t("Pay with bank billet"));
          } else if (this.value === "banktransfer") {
            $("#moip-ct-submit").text(Drupal.t("Pay with bank transfer"));
          }
          moip_ct_button = $("#moip-ct-buttons").clone();
          $("#moip-ct-buttons").remove();
          $("#edit-buttons .fieldset-wrapper").prepend(moip_ct_button);
        });
      }
    };
    $("#edit-commerce-payment-payment-details-moip-ct").ready(function() {
      $("#edit-buttons input.checkout-continue").hide();
      $("#edit-buttons").addClass("moip-ct");
    });
    Drupal.Moip = {};
    Drupal.Moip.CT = {};
    Drupal.Moip.CT.send = function(order_id) {
      var error, txt;
      try {
        $("#edit-commerce-payment-payment-method.form-radios input:not(:checked)").attr("disabled", "disabled");
        Drupal.Moip.CT.paymentway = $("#edit-commerce-payment-payment-details-moip-ct-payment-way .form-radio:checked").val();
        $("#edit-commerce-payment-payment-details-moip-ct-payment-way .form-radio:not(:checked)").parents(".form-item.form-type-radio").hide();
        $("#moip-ct-buttons").hide();
        switch (Drupal.Moip.CT.paymentway) {
          case "creditcard":
            Drupal.Moip.CT.sendCreditCard();
            break;
          case "bankbillet":
            Drupal.Moip.CT.sendBankBillet();
            break;
          case "banktransfer":
            Drupal.Moip.CT.sendBankTransfer();
        }
      } catch (_error) {
        error = _error;
        txt = "Sorry, we have an undefined error in the system. <br/>";
        txt += "Our team was notified and we will fix it asap.";
        if (typeof jdog_error === "function") {
          jdog_error("moip_js_error", Drupal.t(error.message));
        }
        Drupal.Moip.CT.UI.errorAlert(Drupal.t(txt));
      }
    };
    Drupal.Moip.CT.sendCreditCard = function() {
      var birthday, card, cpf, expiration_date, expiration_date_split, name, number, paymentwayoption, phone, security_code, settings;
      $("#moip-ct-js-form > :not(.ajax-progress-throbber)").hide();
      $("#moip-ct-js-form .ajax-progress-throbber").show();
      phone = $("#moip-user-phone").val();
      name = $(".payment-way.creditcard .name input").val();
      if (!(name != null ? name.length : void 0)) {
        Drupal.Moip.CT.UI.sendCreditCardErrorAlert(Drupal.t('The "name" field is required.'));
        return false;
      }
      birthday = $(".payment-way.creditcard .birthday input").val();
      if (!(birthday != null ? birthday.length : void 0)) {
        Drupal.Moip.CT.UI.sendCreditCardErrorAlert(Drupal.t('The "birthday" field is required.'));
        return false;
      }
      cpf = $(".payment-way.creditcard .cpf input").val();
      if (!(cpf != null ? cpf.length : void 0)) {
        Drupal.Moip.CT.UI.sendCreditCardErrorAlert(Drupal.t('The "cpf" field is required.'));
        return false;
      }
      number = $(".payment-way.creditcard .number input").val();
      if (!(number != null ? number.length : void 0)) {
        Drupal.Moip.CT.UI.sendCreditCardErrorAlert(Drupal.t('The "number" field is required.'));
        return false;
      }
      if (!moip.creditCard.isValid(number)) {
        Drupal.Moip.CT.UI.sendCreditCardErrorAlert(Drupal.t("The informed card number is invalid. Please verify."));
        return false;
      }
      security_code = $(".payment-way.creditcard .securitycode input").val();
      if (!(security_code != null ? security_code.length : void 0)) {
        Drupal.Moip.CT.UI.sendCreditCardErrorAlert(Drupal.t('The "security code" field is required.'));
        return false;
      }
      if (!moip.creditCard.isSecurityCodeValid(number, security_code)) {
        Drupal.Moip.CT.UI.sendCreditCardErrorAlert(Drupal.t("The informed security code is invalid. Please verify."));
        return false;
      }
      expiration_date = $(".payment-way.creditcard .expirationdate input").val();
      if (!(expiration_date != null ? expiration_date.length : void 0)) {
        Drupal.Moip.CT.UI.sendCreditCardErrorAlert(Drupal.t('The "expiration date" field is required.'));
        return false;
      }
      if (!(expiration_date.length === 7 && expiration_date.charAt(2) === '/')) {
        Drupal.Moip.CT.UI.sendCreditCardErrorAlert(Drupal.t('The "expiration date" should be informed in the format "mm/yyyy".'));
        return false;
      }
      expiration_date_split = expiration_date.split("/");
      if (!moip.creditCard.isExpiryDateValid(expiration_date_split[0], expiration_date_split[1])) {
        Drupal.Moip.CT.UI.sendCreditCardErrorAlert(Drupal.t('The "expiration date" informed is invalid.'));
        return false;
      }
      card = moip.creditCard.cardType(number);
      paymentwayoption = void 0;
      switch (card.brand) {
        case "AMEX":
          paymentwayoption = "AmericanExpress";
          break;
        case "DINERS":
          paymentwayoption = "Diners";
          break;
        case "HIPERCARD":
          paymentwayoption = "Hipercard";
          break;
        case "MASTERCARD":
          paymentwayoption = "Mastercard";
          break;
        case "VISA":
          paymentwayoption = "Visa";
      }
      $(".moip-ct-paymentwayoption").val(paymentwayoption);
      settings = {
        Forma: "CartaoCredito",
        Instituicao: paymentwayoption,
        Parcelas: "1",
        Recebimento: "AVista",
        CartaoCredito: {
          Numero: number,
          Expiracao: expiration_date,
          CodigoSeguranca: security_code,
          Portador: {
            Nome: name,
            DataNascimento: birthday,
            Telefone: phone,
            Identidade: cpf
          }
        }
      };
      MoipWidget(settings);
    };
    Drupal.Moip.CT.sendBankBillet = function() {
      var settings;
      settings = {
        Forma: "BoletoBancario"
      };
      MoipWidget(settings);
    };
    Drupal.Moip.CT.sendBankTransfer = function() {
      var option, settings;
      option = $(".payment-way.banktransfer input:checked").val();
      if (option == null) {
        Drupal.Moip.CT.UI.errorAlert(Drupal.t("You need to specify the bank."));
        $("#edit-commerce-payment-payment-details-moip-ct-payment-way .form-type-radio").show();
      } else {
        $(".payment-way.banktransfer input:not(:checked)").parents(".field-wrapper").hide();
        $(".moip-ct-paymentwayoption").val(option);
        settings = {
          Forma: "DebitoBancario",
          Instituicao: option
        };
        MoipWidget(settings);
      }
    };
    Drupal.Moip.CT.sendSuccesfull = function(data) {
      Drupal.Moip.CT.answer = JSON.stringify(data);
      if (data.Status === "Cancelado") {
        Drupal.Moip.CT.UI.sendCreditCardErrorAlert(eval("Drupal.Moip.Error.CreditCardErrorMap.e" + data.Classificacao.Codigo));
      } else {
        switch (Drupal.Moip.CT.paymentway) {
          case "creditcard":
            Drupal.Moip.CT.submitCheckoutForm();
            break;
          case "bankbillet":
            Drupal.Moip.CT.UI.externalPaymentUrlAlert("bankbillet", data.url);
            break;
          case "banktransfer":
            Drupal.Moip.CT.UI.externalPaymentUrlAlert("banktransfer", data.url);
        }
      }
    };
    Drupal.Moip.CT.submitCheckoutForm = function() {
      if (Drupal.Moip.CT.answer.length === 0) {
        if (typeof jdog_error === "function") {
          jdog_error("moip_js_error", Drupal.t('The Moip "Answer" came empty'));
        }
      } else {
        $(".moip-ct-answer").val(Drupal.Moip.CT.answer);
        $("#moip-ct-js-form").remove();
        $(".moip-ct-answer").parents("form").submit();
      }
    };
    Drupal.Moip.CT.sendFailed = function(data) {
      var errorArr, error_map, messages;
      error_map = {
        c900: "Forma de pagamento inválida",
        c901: "Informe a instituição de pagamento",
        c902: "Informe a quantidade de parcelas (valor entre 1 e 12)",
        c903: "Tipo de recebimento inválido",
        c904: "Número de cartão ou Cofre deve ser informado",
        c905: "Informe o número do cartão ou número do cartão é inválido",
        c906: "Informe a data de expiração do cartão (no formato MM/AA)",
        c907: "Informe o código de segurança do cartão ou o código é inválido",
        c908: "Informe os dados do portador do cartão",
        c909: "Informe o nome do portador como está no cartão",
        c910: "Informe a data de nascimento do portador (no formato DD/MM/AAAA)",
        c911: "Informe o telefone do portador ou o telefone é inválido",
        c912: "Informe o CPF do portador",
        c913: "Informe o cofre a ser utilizado",
        c914: "Informe o token da Instrução",
        c124: "O valor da parcela deve ser superior a R$5,00",
        c236: "Este pagamento já foi realizado"
      };
      errorArr = $.makeArray(data);
      messages = "";
      $.each(errorArr, function(index, value) {
        var msg;
        msg = eval("error_map.c" + value.Codigo);
        if (msg) {
          messages += msg + "<br />";
        }
      });
      if (messages.length === 0) {
        $.each(errorArr, function(index, value) {
          messages += value.Mensagem + "<br />";
        });
      }
      Drupal.Moip.CT.UI.sendCreditCardErrorAlert(messages);
    };
    Drupal.Moip.CT.UI = {};
    Drupal.Moip.CT.UI.messageAlert = function(message) {
      $("#moip-ct-messages").empty();
      $("#moip-ct-messages").removeClass();
      $("#moip-ct-messages").append(message);
      $("#moip-ct-messages").show({
        effect: "highlight"
      });
    };
    Drupal.Moip.CT.UI.errorAlert = function(message) {
      Drupal.Moip.CT.UI.messageAlert(message);
      $("#moip-ct-messages").addClass("error");
      $("#moip-ct-buttons").show();
    };
    Drupal.Moip.CT.UI.infoAlert = function(message) {
      Drupal.Moip.CT.UI.messageAlert(message);
      $("#moip-ct-messages").addClass("info");
    };
    Drupal.Moip.CT.UI.sendCreditCardErrorAlert = function(message) {
      Drupal.Moip.CT.UI.errorAlert(message);
      $("#moip-ct-buttons").show();
      $(".form-item-commerce-payment-payment-details-moip-ct-payment-way").show();
      $("#moip-ct-js-form .payment-way.creditcard").show();
      $("#moip-ct-js-form .ajax-progress-throbber").hide();
    };
    Drupal.Moip.CT.UI.externalPaymentUrlAlert = function(paymentway, url) {
      var args, message;
      args = {
        "!link": url
      };
      switch (paymentway) {
        case "bankbillet":
          message = Drupal.t('<p>To complete your payment, <a data-href="!link">click here</a> to open your billet in another browser window.</p><p>You will be redirected automatically after this.</p>', args);
          break;
        case "banktransfer":
          message = Drupal.t('<p>To complete your payment, <a data-href="!link">click here</a> to open your internet banking in another browser window.</p><p>You will be redirected automatically after this.</p>', args);
      }
      Drupal.Moip.CT.UI.infoAlert(message);
      $("#moip-ct-messages a").click(function() {
        window.open($(this).data("href"));
        Drupal.Moip.CT.submitCheckoutForm();
      });
    };
    Drupal.Moip.Error = {};
    Drupal.Moip.Error.CreditCardErrorMap = {
      e1: "Os dados informados foram considerados inválidos pelo banco. Verifique se digitou algo errado e tente novamente.",
      e2: "Houve uma falha de comunicação com a operadora/banco do seu cartão. Você pode tentar novamente ou tentar em outro momento.",
      e3: "O pagamento não foi autorizado pela operadora/banco do seu cartão. Favor entrar em contato com ela para esclarecer o problema e tentar novamente em seguida.",
      e4: "A validade do seu cartão expirou. Caso deseje, você pode escolher outra forma de pagamento.",
      e5: "O pagamento não foi autorizado pela operadora/banco do seu cartão. Caso deseje, você pode escolher outra forma de pagamento.",
      e6: "Esse pagamento já foi realizado. Favor entrar em contato conosco para verificarmos junto ao sistema.",
      e7: "O pagamento não foi autorizado. Para mais informações, entre em contato com nosso atendimento.",
      e8: "O pagamento não pode ser processado. Favor tentar novamente. Caso o erro persista, entre em contato com nosso atendimento.",
      e11: "Houve uma falha de comunicação com a operador/banco do seu cartão. Favor tentar novamente.",
      e12: "O pagamento não foi autorizado para este cartão. Favor entrar em contato com a operadora/banco para mais esclarecimentos.",
      e13: "O pagamento não foi autorizado. Favor entrar em contato com nosso atendimento.",
      e14: "O pagamento não foi autorizado. Favor entrar em contato com a operador/banco do seu cartão para maiores detalhes."
    };
  })(jQuery);

}).call(this);
