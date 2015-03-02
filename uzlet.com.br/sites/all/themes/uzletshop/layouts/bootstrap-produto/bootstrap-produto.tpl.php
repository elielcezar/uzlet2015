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
  
  
  <div class="container">
    <div class="row">    
    


   
    <div class="panel-col-first panel-panel col-sm-6">

    
              <div class="inside">
                     <div class="foto-produto">
                      <?php print $content['foto-produto']; ?>
                     </div>         
                    <div id="gallery_01">               
                        <?php print $content['galeria-produtos']; ?>
                    </div>

                     <?php if ($content['left']): ?>
                        <?php print $content['left']; ?>
                      <?php endif; ?>
            </div>

   
  </div>
  
  
  

     

     <?php if ($content['right']): ?>
    <div class="panel-col-last panel-panel col-sm-6">
      <div class="inside"><?php print $content['right']; ?></div>
    </div>
  </div>
     <?php endif; ?>


  </div>


  <?php if ($content['bottom']): ?>
  <div class="container">
    <div class="row panel-col-bottom panel-panel">
      <div class="inside span12"><?php print $content['bottom']; ?></div>
    </div> 
    </div>   
  <?php endif; ?>
</div>











