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

            <?php if (($title)&&(!$is_front)): ?>
                <h1 class="title" id="page-title"><?php print $title; ?></h1>
            <?php endif; ?>

        
      
    </div><!-- container -->

   
    <div class="container"><?php print render($page['content']); ?></div>
  
       
      
	</div> 	



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
                  <a href="http://uzlet.com.br">Home</a> <br /> 
                  <a href="http://uzlet.com.br/#principal">Receba Uma Oferta</a> <br /> 
                  <a href="http://uzlet.com.br/sobre-o-uzlet">Sobre o Uzlet</a> <br /> 
                  <a href="http://uzlet.com.br/perguntas-frequentes">Perguntas Frequentes</a> <br /> 
                  <a href="http://uzlet.com.br/contato">Contato<br /> </a>
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


