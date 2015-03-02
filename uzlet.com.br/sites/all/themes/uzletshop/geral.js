(function($) {
   $().ready(function() { 

   			/*--- busca ---------------------------------------------------------------------------*/
   			$('header #block-views-exp-search-page-page form label').text('Digite o modelo que você procura');


   			/*--- home ------------------------------------------------------------------------------*/	
   			/* banners home */
   			$('.front .view-banners-destaque-home .item').unwrap();
			$('.front .view-banners-destaque-home .item-1').addClass('active');
			

			$('.front #carousel-depoimentos .item').unwrap();
			$('.front #carousel-depoimentos .item-1').addClass('active');
			

			/*-- listagem de produtos -----------------------------------------------------------------*/
			$('label[for="edit-range-from"]').replaceWith('De R$');
			$('label[for="edit-range-to"]').replaceWith('Até R$');


			/*--- pagina de produto -----------------------------------------------------------------------*/
			//$('.note-type-smartphone .form-button-disabled').attr('value','teste');
			$('.node-type-smartphone .form-button-disabled').attr('value','Produto Esgotado');


			/*--- pagina do carrinho ------------------------------------------------------------------------*/
			$('.page-cart #edit-actions').prepend('<a class="botao" href="http://shop.uzlet.com.br/smartphones?sort=title&order=asc">Continuar Comprando</a>');

			
			/*--- checkout --------------------------------------------------------------------------------*/

			/* traducoes forcadas */
			$('.page-checkout #commerce-shipping-service-ajax-wrapper .fieldset-legend').replaceWith('Opções de Envio');
			$('.page-checkout #principal').append('<img src="http://shop.uzlet.com.br/sites/all/themes/uzletshop/images/loading.gif" style="display: none;" />');
			$('.page-checkout #principal span.button-operator').replaceWith('ou');
			$('.page-checkout #principal .terms-of-service .messages.error').html('Você precisa aceitar os termos e condições de uso');

			/* preenchimento automatico dos campso de endereco */
			$('.page-checkout #addressfield-wrapper .name-block').attr('value','-');
			$('.page-checkout #addressfield-wrapper .thoroughfare ').attr('value','-');
			$('.page-checkout #addressfield-wrapper .locality').attr('value','-');
			$('.page-checkout #addressfield-wrapper .state').val('SP');

			/* oculta os campos desnecessarios */
			$('.page-checkout .name-block').hide();
			$('.page-checkout .form-item-customer-profile-shipping-commerce-customer-address-und-0-thoroughfare').hide();
			$('.page-checkout .form-item-customer-profile-shipping-commerce-customer-address-und-0-premise').hide();			
			$('.page-checkout .form-item-customer-profile-shipping-commerce-customer-address-und-10-dependent-locality').hide();
			$('.page-checkout .form-item-customer-profile-shipping-commerce-customer-address-und-0-dependent-locality').hide();
			$('.page-checkout .form-item-customer-profile-shipping-commerce-customer-address-und-10-locality').hide();
			$('.page-checkout .form-item-customer-profile-shipping-commerce-customer-address-und-0-locality').hide();
			$('.page-checkout .form-item-customer-profile-shipping-commerce-customer-address-und-10-administrative-area').hide();
			$('.page-checkout .form-item-customer-profile-shipping-commerce-customer-address-und-0-administrative-area').hide();
			$('.page-checkout .form-type-textfield form-item-customer-profile-shipping-commerce-customer-address-und-0-locality').hide();

			
			/* redireciona para o site de pagamento (Pagseguro/Paypal) */
			$('.page-checkout-payment #principal h1 , .page-checkout-payment #principal .content').hide();
			$('.page-checkout-payment #principal').append('<h3>Aguarde, você será redirecionado para realizar o pagamento.</h3><br/><br/><br/><img src="http://shop.uzlet.com.br/sites/all/themes/uzletshop/images/loading.gif" />');
			$('.page-checkout-payment #principal form').submit();

			
   			/*--- perfil do usuario ------------------------------------------------------------------------------*/			
			$( ".page-user-me-edit #edit-profile-main-field-cpf-und-0-value" ).attr( "disabled", true);  
			
			/*--- pagina de uma venda --------------------------------------------------------------------------*/
			/* traducoes forcadas */
			$('.page-vendas #principal .commerce-price-formatted-components td.component-title').replaceWith('<td class="component-title">Total</td>');
			
			
			/*--- editar uma venda especifica -----------------------------------------------------*/
			$('.page-admin-commerce-orders-edit #edit-commerce-line-items-und-actions-line-item-add').val('Adicionar Produto');
			$('.page-admin-commerce-orders-edit .form-item-status optgroup[label="Pendente"]').attr('label','-');			
			
			/*--- login --------------------------------------------------------------------------------*/
			$('.toboggan-unified').addClass('row')
   			$('.page-user #login-form').addClass('col-md-6 col-md-push-6').prepend('<h2>Eu já tenho uma conta</h2>');
   			$('.page-user #register-form').addClass('col-md-6 col-md-pull-6').prepend('<h2>Eu quero criar uma conta</h2>');;
   			$('#edit-profile-main-field-cpf-und-0-value').mask('999.999.999-99');
   			$('#edit-profile-main-field-telefone-und-0-value').mask('(99)9999-9999?99');
   			$('#edit-profile-main-field-cep-und-0-value').mask('99999-999');			
   			$('.page-user select#edit-profile-main-field-estado2-und option[value=\"_none\"]').text("Selecione um Estado"); 

   			/*--- pagina com todas as vendas -----------------------------------------------------------------*/
   			/* remove a palavra (Pendente) da lista de status */
   			$('.vendas-geral #edit-status-2 option').text(function(_, text) {
			    return text.replace(/\(.*?\)/, '');
			});
   			
			
		
    });
})(jQuery);