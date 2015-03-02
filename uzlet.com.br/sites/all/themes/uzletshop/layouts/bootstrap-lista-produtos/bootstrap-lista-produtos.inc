<?php

// Plugin definition
$plugin = array(
  'title' => t('Bootstrap Lista Produtos'),
  'category' => t('Columns: 2'),
  'icon' => 'bootstrap-lista-produtos.png',
  'theme' => 'bootstrap-lista-produtos',
  'css' => 'bootstrap-lista-produtos.css',
  'regions' => array(        
    'top' => t('Top'),
    'left' => t('Left side'),    
    'right' => t('Right side'),
    'bottom' => t('Bottom')
  ),
);
