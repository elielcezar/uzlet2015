<?php

// Plugin definition
$plugin = array(
  'title' => t('Bootstrap Pagina'),
  'category' => t('Columns: 2'),
  'icon' => 'bootstrap-pagina.png',
  'theme' => 'bootstrap-pagina',
  'css' => 'bootstrap-pagina.css',
  'regions' => array(
    'top' => t('Top'),
    'left' => t('Left side'),
    'right' => t('Right side'),
    'bottom' => t('Bottom')
  ),
);
