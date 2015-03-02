<header>  
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
  <!-- NAVBAR-->
  <nav class="navbar navbar-default" role="navigation">
      
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">          
          <h1><a class="navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a></h1>          
      </div>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
      <div class="collapse navbar-collapse navbar-ex1-collapse">         
          <div class="menu-principal">
            <?php
              $menu = menu_navigation_links('main-menu');
              print theme('links__menu_main_page', array('links' => $menu));
            ?>
          </div>
      </div><!-- /.navbar-collapse -->             
      <?php print render($page['header']); ?>     
  </nav>
  </div> 
  </div>
  </div> 
</header>
<!-- PAGE-HEADER-->
  <section id="destaque"> 
    <div class="container">
        <div class="row"> 
          <div class="col-sm-12">  
            
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1"></li>              
            </ol>
            <!-- Wrapper for slides -->            
            <div class="carousel-inner">
              <div class="item item-1 active">                    
                    <?php print views_embed_view('banner_home_2', 'block_1'); ?>
              </div>
              <div class="item item-2">                
                <?php print views_embed_view('banner_home_1', 'block_1'); ?>
              </div>              
            </div><!-- carousel-inner -->
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div><!-- carousel -->
          </div>
      </div><!-- row -->
    </div><!-- container -->      
  </section>    
<div id="principal"> 
    <div class="container">        
            <?php if ($messages): ?>
                <div id="messages">
                  <div class="section clearfix">
                <?php print $messages; ?>
                </div></div> <!-- /.section, /#messages -->          
            <?php endif; ?>
            <?php if ($tabs): ?>
                <div class="tabs">
                <?php print render($tabs); ?>
                </div>
            <?php endif; ?> 
      
    </div><!-- container --> 
    
    <div class="container sub escolha-aparelho">
        <div class="row"> 
            <div class="col-sm-12">
                <!--h3>Que tipo de aparelho você possui?</h3-->
            </div>
            <!--div class="col-sm-4 ">
                <div class="venda-iphone box">                      
                    <div class="img-expo"><img src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzlet2014/images/iphone_expo.jpg"  /></div>
                    <span class="venda">Vender iPhone</span>
                    <strong>Iphones 4 em diante, <br />nacionais ou importados</strong>
                </div>  
            </div>
            <div class="col-sm-4">
                <div class="venda-smartphone box">
                    <div class="img-expo"><img src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzlet2014/images/smartphone_expo.jpg" /></div>
                    <span class="venda">Vender Smartphone</span>
                    <strong>Em qualquer estado de uso, <br />bloqueados ou não</strong>
                </div>  
            </div-->
            <div class="col-sm-8">
                <a href="http://shop.uzlet.com.br/"><img src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzlet2014/images/venda.jpg" style="img-responsive" /></a>
            </div>
            <div class="col-sm-4">
                <div class="compra-aparelhos box">
                    <div class="img-expo"><img src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzlet2014/images/smartphones.jpg" /></div>
                    <a class="compra" href="http://shop.uzlet.com.br/" target="_blank">Comprar Aparelhos</a>
                    <strong>Adquira um smartphone semi-novo revisado pela nossa equipe técnica.</strong>
                    <!--img class="faixa" src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzlet2014/images/embreve.png" /-->
                </div>  
            </div> <!--venda-smartphone-->
      </div><!-- row -->
    </div><!-- container --> 
    <div class="container">
      <div class="row">  
            <div class="col-sm-12">
                <div class="menu-modelos menu-iphone box">
                  <ul>                      
                    <li class="iphone4">iPhone 4</li>
                    <li class="iphone4s">iPhone 4S</li>
                    <li class="iphone5">iPhone 5</li>
                    <li class="iphone5c">iPhone 5C</li>
                    <li class="iphone5s">iPhone 5S</li>
                    </ul>                  
                </div>
            </div>
          <div class="col-sm-12">
            <div class="menu-modelos menu-smartphone box">
                <ul>                                                            
                <li class="lg">LG</li>
                <li class="motorola">Motorola</li>
                <li class="nokia">Nokia</li>
                <li class="samsung">Samsung</li>
                <li class="sony">Sony</li>
                <li class="htc">HTC</li>
                </ul>  
            </div>   
          </div>
      </div>
    </div><!-- container --> 
    <div class="modelos-disponiveis modelos-disponiveis-iphone">
      <div class="container sub">
        <div class="row">            
            <div class="col-sm-12">
                <div class="box iphone iphone4">
                  <?php print views_embed_view('iphone4', 'block_1'); ?>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="box iphone iphone4s">                      
                    <?php print views_embed_view('iphone4s', 'block_1'); ?>                         
                </div>
            </div>
            <div class="col-sm-12">
                <div class="box iphone iphone5">                     
                    <?php print views_embed_view('iphone5', 'block_1'); ?>                        
                </div>
            </div>
            <div class="col-sm-12">   
                <div class="box iphone iphone5c">                      
                    <?php print views_embed_view('iphone5c', 'block_1'); ?>                         
                </div>
            </div>
            <div class="col-sm-12">   
                <div class="box iphone iphone5s">                      
                    <?php print views_embed_view('iphone5s', 'block_1'); ?>                         
                </div>
            </div>           
        </div>
    </div>
  </div>   <!-- modelos disponiveis -->
  <div class="modelos-disponiveis modelos-disponiveis-smartphone">
      <div class="container sub">
        <div class="row">                       
            <div class="col-sm-12">
                <div class="box smartphone lg">
                    <?php print views_embed_view('lg', 'block_1'); ?>                         
                </div>
            </div>
             <div class="col-sm-12">
                <div class="box smartphone motorola">                      
                    <?php print views_embed_view('motorola', 'block_1'); ?>                         
                </div>
            </div>
            <div class="col-sm-12">
                <div class="box smartphone nokia">                      
                    <?php print views_embed_view('nokia', 'block_1'); ?>                         
                </div>
            </div>
            <div class="col-sm-12">
                <div class="box smartphone samsung">                      
                    <?php print views_embed_view('samsung', 'block_1'); ?>                         
                </div> 
            </div>
            <div class="col-sm-12">
                <div class="box smartphone sony">                      
                    <?php print views_embed_view('sony', 'block_1'); ?>
                </div> 
            </div>
             <div class="col-sm-12">
                <div class="box smartphone htc">                      
                    <?php print views_embed_view('htc', 'block_1'); ?>
                </div> 
            </div>
            
        </div>
    </div>
  </div>   <!-- modelos disponiveis -->
  <div class="container">
    <div class="row">                       
        <div class="col-sm-8">
                <div class="avaliacoes">                  
                      <h3>O Que Dizem Nossos Clientes</h3>
                       <div id="carousel-depoimentos" class="carousel slide" data-ride="carousel">                      
                          <!-- Wrapper for slides -->            
                          <?php print views_embed_view('depoimentos_home', 'block_1'); ?>
                         
                          <!-- Controls -->
                          <a class="left carousel-control" href="#carousel-depoimentos" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                          </a>
                          <a class="right carousel-control" href="#carousel-depoimentos" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                          </a>
                    </div><!-- carousel -->
                </div><!-- avaliacoes -->
          </div>
          <div class="col-sm-4">
            <div class="facebook-like-box">
              <div class="fb-like-box" data-href="https://www.facebook.com/pages/Uzlet/692936177456171?fref=ts" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true" data-width="auto"></div>  
          </div>
          </div>
      </div>
    </div>
</div><!-- principal -->
<section class="sobre">
    <div class="container"> 
      <div class="row">   
        <div class="col-sm-12">
          <div class="como-funciona" id="como-funciona">
              <?php print views_embed_view('como_funciona', 'default'); ?>   
          </div>                      
        </div>    
      </div>
    </div><!-- container -->
</section> <!-- sobre -->
<!-- FOOTER-->
<footer>  
    <div class="container"> 
          <div class="row">
            <div class="col-sm-3 ">
                <img src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzlet2014/images/uzlet_rodape.png" />
            </div>
            <div class="col-sm-9">
              <?php //print render($page['footer']); ?>      
              <div class="links-extras">
                <span>
                  <a href="http://uzlet.com.br">Home</a> 
                  <a href="http://uzlet.com.br/#principal">Receba Uma Oferta</a>
                  <a href="http://uzlet.com.br/sobre-o-uzlet">Sobre o Uzlet</a>
                  <a href="http://uzlet.com.br/perguntas-frequentes">Perguntas Frequentes</a> 
                  <a href="http://uzlet.com.br/contato">Contato</a>
                </span>
              </div><!-- links extras -->                       
            </div>
          </div><!-- row -->
          <div class="mais">
              Uzlet 2014 &copy; Todos os direitos reservados - Desenvolvido por <a href="http://agenciam2e.com.br" target="_blank">M2E Comunicação Digital</a>
          </div>
    </div> <!-- /#footer -->
</footer>  
<script src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzlet2014/assets/js/jquery.js" type="text/javascript"></script>
<script src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzlet2014/assets/js/bootstrap.min.js"></script>
