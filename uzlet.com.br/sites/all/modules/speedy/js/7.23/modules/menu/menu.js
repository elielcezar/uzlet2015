(function($){Drupal.behaviors.menuFieldsetSummaries={attach:function(context){$("fieldset.menu-link-form",context).drupalSetSummary(function(context){if($(".form-item-menu-enabled input",context).is(":checked")){return Drupal.checkPlain($(".form-item-menu-link-title input",context).val())}else{return Drupal.t("Not in menu")}})}};Drupal.behaviors.menuLinkAutomaticTitle={attach:function(context){$("fieldset.menu-link-form",context).each(function(){var $checkbox=$(".form-item-menu-enabled input",this);var $link_title=$(".form-item-menu-link-title input",context);var $title=$(this).closest("form").find(".form-item-title input");if(!($checkbox.length&&$link_title.length&&$title.length)){return}if($checkbox.is(":checked")&&$link_title.val().length){$link_title.data("menuLinkAutomaticTitleOveridden",true)}$link_title.keyup(function(){$link_title.data("menuLinkAutomaticTitleOveridden",true)});$checkbox.change(function(){if($checkbox.is(":checked")){if(!$link_title.data("menuLinkAutomaticTitleOveridden")){$link_title.val($title.val())}}else{$link_title.val("");$link_title.removeData("menuLinkAutomaticTitleOveridden")}$checkbox.closest("fieldset.vertical-tabs-pane").trigger("summaryUpdated");$checkbox.trigger("formUpdated")});$title.keyup(function(){if(!$link_title.data("menuLinkAutomaticTitleOveridden")&&$checkbox.is(":checked")){$link_title.val($title.val());$link_title.val($title.val()).trigger("formUpdated")}})})}}})(jQuery);
