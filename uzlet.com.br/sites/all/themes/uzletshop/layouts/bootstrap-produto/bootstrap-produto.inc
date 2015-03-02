<?php

// Plugin definition
$plugin = array(
  'title' => t('Bootstrap Produto'),
  'category' => t('Columns: 2'),
  'icon' => 'bootstrap-produto.png',
  'theme' => 'bootstrap-produto',
  'css' => 'bootstrap-produto.css',
  'regions' => array(    
    'foto-produto' => t('Foto do Produto'),
    'galeria-produtos' => t('Galeria'),
    'left' => t('Left side'),    
    'right' => t('Right side'),
    'bottom' => t('Bottom')
  ),
);
