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
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex2-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse navbar-ex2-collapse">         
            <div class="menu-admin">
              <?php print render($page['menu_admin']); ?>     
            </div>
            </div>
        </nav> 
    </div>                                 
  </div><!-- menu admin -->   


  <div class="container-principal">
	
  <div class="container">

  <div id="principal"> 
      
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
            <?php if (($title)&&(!$is_front)): ?>
                <h1 class="title" id="page-title"><?php print $title; ?></h1>
            <?php endif; ?>

            <?php /*if ($breadcrumb): ?>
              <div id="breadcrumb"><?php print $breadcrumb; ?></div>
            <?php endif;*/?>
       
      
    
   
             <?php print render($page['content']); ?>


   
  
       
      </div><!-- principal -->
	</div> <!-- container -->
  </div> <!-- container -->

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
    </div> <!-- /#footer -->
    <div class="mais">
      <div class="container"> 
              Uzlet 2014 &copy; Todos os direitos reservados - Desenvolvido por <a href="http://agenciam2e.com.br" target="_blank">M2E Comunicação Digital</a>
          </div>
      </div>

      
</footer>    


<script src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/assets/js/jquery.js" type="text/javascript"></script>
<script src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/assets/js/bootstrap.min.js"></script>

<script src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/jquery.elevatezoom.js"></script>
<script src="<?php print $GLOBALS['base_path']; ?>sites/all/themes/uzletshop/fancybox/jquery.fancybox.js?v=2.1.5" type="text/javascript" ></script>

 <script type="text/javascript">

var janela = $(document).width();



  $(document).ready(function () {
    $("#zoom_03").elevateZoom({
      gallery:'gallery_01', 
      zoomType: 'inner',
      cursor: 'pointer', 
      galleryActiveClass: "active", 
      imageCrossfade: true,
      borderSize: 1    
    }); 



$("#zoom_03").bind("click", function(e) {  
  var ez =   $('#zoom_03').data('elevateZoom');
  ez.closeAll(); 
  $.fancybox(ez.getGalleryList());
  return false;
}); 

$('.zoomWrapper').removeAttr('style');

}); 

</script>
