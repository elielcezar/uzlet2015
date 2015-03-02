<header>  
  

      <!-- NAVBAR-->
      <div id="topo">
      
          <div class="container">
              <div class="row">
                  <div class="col-sm-3">
                      <h1><a class="navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a></h1>          
                  </div>
                  <div class="col-sm-9">
                      
                        <div class="col-sm-12">
                            <?php print render($page['header']); ?> 
                        </div>
                     
                        <div class="col-sm-12">                          
                           <div id="menu-principal">                                  
                                  <nav class="navbar navbar-default" role="navigation">
                                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                          <span class="sr-only">Toggle navigation</span>
                                          <span class="icon-bar"></span>
                                          <span class="icon-bar"></span>
                                          <span class="icon-bar"></span>
                                  </button>
                                  <div class="collapse navbar-collapse navbar-ex1-collapse">         
                                      <div class="menu-principal">
                                        <?php print render($page['menu']); ?>     
                                      </div>
                                      </div>
                                  </nav>                                  
                            </div><!-- menu principal -->

                            <div class="carrinho">                
                                <?php print render($page['carrinho']); ?>     
                           </div>
                      </div>
                    

              </div>
          </div>
      
    </div>

  

</header>
<!-- PAGE-HEADER-->

<div id="menu-admin"> 
  <div class="container">                                 
        <nav class="navbar navbar-default" role="navigation">       
        
            <div class="menu-admin">
              <?php print render($page['menu_admin']); ?>     
            </div>
          
        </nav> 
    </div>                                 
  </div><!-- menu admin -->   

<div class="container-principal">  
<div class="container">  

    <div id="principal">

            <!-- PAGE-HEADER-->
            <section id="destaque"> 

              <div class="row"> 
                   <div class="col-sm-8"> 
                      <img src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/images/banner-facilidades.png" class="img-responsive banner-facilidades" />
                   </div>
                   <div class="col-sm-4"> 
                      <a class="botao" href="http://uzlet.com.br">Quero Vender Meu Celular</a>
                   </div>
              </div><!-- row -->   


              
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
                          <?php print views_embed_view('banners_destaque_home', 'block_1'); ?>
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

            </section> 



    
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


            <div class="menu-modelos box">
              <div class="col-sm-12">
                  <div class="row">
                <h3>Qual modelo você procura?</h3>
                <ul>                                                            
                <li class="iphone"><a href="marcas-smartphones/iphone"><img src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/images/ico_iphone.jpg" class="img-responsive" /></a></li>
                <li class="lg"><a href="marcas-smartphones/lg"><img src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/images/ico_smartphonelg.jpg" class="img-responsive" /></a></li>
                <li class="motorola"><a href="marcas-smartphones/motorola"><img src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/images/ico_smartphonemotorola.jpg" class="img-responsive" /></a></li>
                <li class="nokia"><a href="marcas-smartphones/nokia"><img src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/images/ico_smartphonenokia.jpg" class="img-responsive" /></a></li>
                <li class="samsung"><a href="marcas-smartphones/samsung"><img src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/images/ico_smartphonesamsung.jpg" class="img-responsive" /></a></li>
                <li class="htc"><a href="marcas-smartphones/htc"><img src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/images/ico_smartphonehtc.jpg" class="img-responsive" /></a></li>
                <li class="sony"><a href="marcas-smartphones/sony"><img src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/images/ico_smartphonesony.jpg" class="img-responsive" /></a></li>
                
                </ul>  
              </div>
                </div>
            </div><!-- modelos -->

            

              <div class="aparelhos">

                <div class="col-sm-12">
                  <div class="row">
                    <h3>Novidades</h3>
                  <?php print views_embed_view('aparelhos_home', 'block_1'); ?>
                </div>
                </div>

              </div><!-- aparelhos -->


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



           
      
    
    </div><!-- container -->     
  </div><!-- container -->     
</div><!-- principal -->

<!-- FOOTER-->
<footer>  
    <div class="container"> 
          <div class="row">
            <div class="col-sm-3 ">
                <img src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/images/uzlet_rodape.png" />
            </div>
            <div class="col-sm-9">
              <?php //print render($page['footer']); ?>      
              <div class="links-extras">
                <span>
                  <a href="http://shop.uzlet.com.br">Home</a> <br />
                  <a href="http://shop.uzlet.com.br/smartphones">Smartphones</a> <br />
                  <a href="http://shop.uzlet.com.br/sobre-o-uzlet-shop">Sobre o Uzlet Shop</a> <br />
                  <a href="http://shop.uzlet.com.br/certificado-uzlet-de-garantia">Garantia</a> <br />                  
                  <a href="http://shop.uzlet.com.br/contato">Contato<br /> </a>
                </span>
              </div><!-- links extras -->
              <div class="facebook-like">                  
                  <div class="fb-like" data-href="https://www.facebook.com/pages/Uzlet/692936177456171?ref=ts&amp;fref=ts" data-width="450" data-layout="standard" data-action="like" data-colorscheme="dark" data-show-faces="false" data-share="true"></div>
              </div><!-- facebook -->              
            </div>
          </div><!-- row -->
          <div class="mais">
              Uzlet 2014 &copy; Todos os direitos reservados - Desenvolvido por <a href="http://agenciam2e.com.br" target="_blank">M2E Comunicação Digital</a>
          </div>
    </div> <!-- /#footer -->
</footer>   
<script src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/assets/js/jquery.js" type="text/javascript"></script>
<script src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/assets/js/bootstrap.min.js"></script>


