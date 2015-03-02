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
<div class="bootstrap clear-block panel-display" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  
  <?php if ($content['top']): ?>
  <div class="container top">
    <div class="row">    
      <div class="col-sm-12">
          <?php print $content['top']; ?>  
      </div>
    </div>
  </div>
  <?php endif; ?>

  <div class="container">
    
    <div class="panel-col-first panel-panel col-sm-3">
     <?php 
        if ($content['left']): print $content['left']; endif; 
      ?>
    </div> 
    
      <div class="panel-col-last panel-panel col-sm-9">
          <?php if  ($content['right']): print $content['right']; endif; ?>            
      </div>      
      
  
  </div>



  <?php if ($content['bottom']): ?>
  <div class="container rodape">
    <div class="row">
      <div class="col-sm-12">
      <?php print $content['bottom']; ?>
      </div> 
    </div> 
    </div>   
  <?php endif; ?>


</div>











