(function($) {
   $().ready(function() { 
   			/*--- menu ---------------------------------------------------------------------------*/   			
   			$('header ul.links').attr('id', 'topnav2');
   			$('header ul.links').attr('class','nav navbar-nav navbar-right');
   			$('#principal img').addClass('img-responsive');
   			$('header #block-menu-menu-admin-menu ul').attr('id', 'topnav3');
   			$('header ul.menu').attr('class','nav navbar-nav navbar-right');
   			
   			
   			
   			/*--- cesta ------------------------------------------------------------------------*/ 
   			$('header .navbar #block-commerce-cart-cart').click(function(){
   				$('header .navbar #block-commerce-cart-cart .cart-empty-block').toggle();
   				$('header .navbar #block-commerce-cart-cart .cart-contents').toggle();   				
   			})
   			/* exibe o conteudo da cesta no mouseover */
   			$('header .navbar #block-commerce-cart-cart').mouseenter(function(){
   				$('header .navbar #block-commerce-cart-cart .cart-empty-block').show();
   			});
   			$('header .navbar #block-commerce-cart-cart').mouseleave(function(){
   				$('header .navbar #block-commerce-cart-cart .cart-empty-block').hide();
   			});
   			$('header .navbar #block-commerce-cart-cart').mouseenter(function(){
   				$('header .navbar #block-commerce-cart-cart .cart-contents').show();
   			});
   			$('header .navbar #block-commerce-cart-cart').mouseleave(function(){
   				$('header .navbar #block-commerce-cart-cart .cart-contents').hide();
   			});
   			
   			/*--- home ------------------------------------------------------------------------------*/	

   			/* banners home */
			$('.front #carousel-depoimentos .item').unwrap();
			$('.front #carousel-depoimentos .item-1').addClass('active');


   			function scrollToElement(selector, time, verticalOffset) {
			    time = typeof(time) != 'undefined' ? time : 1000;
			    verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
			    element = $(selector);
			    offset = element.offset();
			    offsetTop = offset.top + verticalOffset;
			    $('html, body').animate({
			        scrollTop: offsetTop
			    }, time);
			}
			$('.menu-principal li.menu-1609').click(function(){
				scrollToElement('#principal .escolha-aparelho');
			});
			$('.front .carousel-inner .item img').click(function(){
				scrollToElement('#principal .escolha-aparelho');
			});
			$('.front #destaque .chamada .saiba-mais').click(function(){
				scrollToElement('#principal .escolha-aparelho');
			});
			$('.banner img').click(function(){
				scrollToElement('#principal .escolha-aparelho');
			});
			$('.venda-iphone span.venda').click(function(){				
				$('.menu-modelos.menu-smartphone').hide();
				$('.modelos-disponiveis-smartphone').hide();
				$('.menu-modelos.menu-iphone').fadeIn(400);
				scrollToElement('.menu-modelos.menu-iphone');
			});
			$('.venda-smartphone span.venda').click(function(){
				$('.menu-modelos.menu-iphone').hide();				
				$('.modelos-disponiveis-iphone').hide();
				$('.menu-modelos.menu-smartphone').fadeIn(400);
				scrollToElement('.menu-modelos.menu-smartphone');
			});
			$('.menu-iphone li').click(function() {
				$('.modelos-disponiveis .box').hide();
				$('.modelos-disponiveis-iphone').show();
				var modelo = $(this).attr('class');
				$('.modelos-disponiveis-iphone .'+modelo+'').delay(400).fadeIn(400);
				scrollToElement('.modelos-disponiveis-iphone', 1000);
			});
			$('.menu-smartphone li').click(function() {
				$('.modelos-disponiveis .box').hide();
				$('.modelos-disponiveis-smartphone').show();
				var modelo = $(this).attr('class');
				$('.modelos-disponiveis-smartphone .'+modelo+'').delay(400).fadeIn(400);
				scrollToElement('.modelos-disponiveis-smartphone', 1000);
			});



			/*--- pagina individual do produto ---------------------------------------------------------*/			
			/*$('.form-item-line-item-fields-field-operadora-und .form-item').live("click",function(){
				$('.field-name-field-outra-operadora input').val('');
				$('.field-name-field-outra-operadora').css('display','none');								
			});	
					
			$('.form-item-line-item-fields-field-operadora-und .form-item:nth-child(5)').live("click",function(){
				$('.field-name-field-outra-operadora').css('display','block');				
			});*/			
			$('.form-item-line-item-fields-field-operadora-und .form-item').click(function(){
				$('.field-name-field-outra-operadora input').val('');
				$('.field-name-field-outra-operadora').css('display','none');								
			});
			
			$('.form-item-line-item-fields-field-operadora-und .form-item:nth-child(5)').click(function(){
				$('.field-name-field-outra-operadora').css('display','block');
			});			
			
			/*--- checkout --------------------------------------------------------------------------------*/
			/* traducoes forcadas */
			$('.page-checkout .view-footer .component-title').replaceWith('<td class="component-title">Total da Venda</td>');			
			$('.page-checkout .form-item-commerce-fieldgroup-pane--group-info-conta-recebimento-field-observacoes-und-0-value').append('<span class="aviso">* A conta bancária informada deverá ser de propriedade do dono da conta no Uzlet.</span>');
			$('.page-checkout label[for="edit-commerce-fieldgroup-pane-group-forma-recebimento-field-forma-de-recebimento-und-paypal"]').empty();
			$('.page-checkout label[for="edit-commerce-fieldgroup-pane-group-forma-recebimento-field-forma-de-recebimento-und-pagseguro"]').empty();
			
			/* opcao de pagamento pelo pagseguro */
			$('#edit-commerce-fieldgroup-pane-group-forma-recebimento-field-forma-de-recebimento-und-pagseguro').click(function(){
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-email-do-pagseguro').show();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-email-paypal').hide();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-banco').hide();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-agencia').hide();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-conta-corrente').hide();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-observacoes').show()
			});
			/* opcao de pagamento pelo paypal */
			$('#edit-commerce-fieldgroup-pane-group-forma-recebimento-field-forma-de-recebimento-und-paypal').click(function(){
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-email-do-pagseguro').hide();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-email-paypal').show();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-banco').hide();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-agencia').hide();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-conta-corrente').hide();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-observacoes').show()
			});
			/* opcao de pagamento por conta corrente */
			$('#edit-commerce-fieldgroup-pane-group-forma-recebimento-field-forma-de-recebimento-und-contacorrente').click(function(){
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-email-do-pagseguro').hide();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-email-paypal').hide();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-banco').show();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-agencia').show();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-conta-corrente').show();
				$('.page-checkout #edit-commerce-fieldgroup-pane-group-forma-recebimento-field-observacoes').show()
			});
			
   			/*--- perfil do usuario ------------------------------------------------------------------------------*/			
			$( ".page-user-me-edit #edit-profile-main-field-cpf-und-0-value" ).attr( "disabled", true);  
			/*--- pagina de uma venda --------------------------------------------------------------------------*/
			/* traducoes forcadas */
			$('.page-vendas #principal .commerce-price-formatted-components td.component-title').replaceWith('<td class="component-title">Total da Venda</td>');
			$('.page-vendas #principal table th.views-field-field-observacoes').prepend('Observações');
			/*--- editar uma venda especifica -----------------------------------------------------*/
			$('.page-admin-commerce-orders-edit #edit-commerce-line-items-und-actions-line-item-add').val('Adicionar Produto')
			
			/*--- login --------------------------------------------------------------------------------*/
			$('.toboggan-unified').addClass('row')
   			$('.page-user #login-form').addClass('col-md-6 col-md-push-6').prepend('<h2>Eu já tenho uma conta</h2>');
   			$('.page-user #register-form').addClass('col-md-6 col-md-pull-6').prepend('<h2>Eu quero criar uma conta</h2>');;
   			$('#edit-profile-main-field-cpf-und-0-value').mask('999.999.999-99');
   			$('#edit-profile-main-field-telefone-und-0-value').mask('(99)9999-9999?99');
   			$('#edit-profile-main-field-cep-und-0-value').mask('99999-999');			
   			$('.page-user select#edit-profile-main-field-estado2-und option[value=\"_none\"]').text("Selecione um Estado"); 
   			
			
		
    });
})(jQuery);