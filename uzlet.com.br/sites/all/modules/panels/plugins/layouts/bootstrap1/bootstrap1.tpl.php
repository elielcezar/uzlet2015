<?php
/**
 * @file
 * Template for a 2 column panel layout.
 *
 * This template provides a two column panel display layout, with
 * additional areas for the top and the bottom.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['top']: Content in the top row.
 *   - $content['left']: Content in the left column.
 *   - $content['right']: Content in the right column.
 *   - $content['bottom']: Content in the bottom row.
 */
?>
<div class="bootstrap panel-display panel-1col clear-block" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <div class="panel-panel panel-col row-fluid">
  	
    

  	 <?php if ($content['titulo']): ?>
  <section class="titulo">
  <div class="container">
    <div class="row-fluid">
      <div class="inside span12"><?php print $content['titulo']; ?></div>
    </div> 
    </div><!-- container --> 
    </section>  
  <?php endif; ?>


  <section class="conteudo">
  
    <div class="row-fluid">
      <div class="inside span12"> <?php print $content['middle']; ?></div>
    </div> 
    
    </section>  
 
   

   

  </div>
</div>
