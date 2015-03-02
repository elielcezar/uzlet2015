<?php


function uzletshop_textarea($element) {
  $element['element']['#resizable'] = false ;
  return theme_textarea($element) ;
}




function uzletshop_menu_tree(&$variables) {
 return '<ul class="nav nav-pills nav-stacked">' . $variables['tree'] . '</ul>';
}
function uzletshop_menu_tree__main_menu(&$variables) {
 return '<ul class="nav navbar-nav pull-right-md">' . $variables['tree'] . '</ul>';
}
function uzletshop_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';
  if ($element['#below']) {
   unset($element['#below']['#theme_wrappers']);
   $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
   $element['#attributes']['class'][] = "dropdown";
   $element['#title'] .= ' <span class="caret"></span>';
   $element['#attributes']['class'][] = 'dropdown';
   $element['#localized_options']['html'] = TRUE;
   $element['#localized_options']['attributes']['data-target'] = '#';
   $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle disabled';
   $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
  }
  $active_trail = array_search('active-trail',$element['#attributes']['class']);
  if($active_trail)
   $element['#attributes']['class'][$active_trail] = 'active';
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}
/*function uzlet2014_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
   $breadcrumb[] = drupal_get_title();
   $output = '<ol class="breadcrumb">';
   foreach($breadcrumb as $crumb) {
    if(end($breadcrumb) !== $crumb)
     $output .= "<li>$crumb</li>";
    else
     $output .= "<li class=\"active\">$crumb</li>";
   }
   $output .= '</ol>';
   return $output;
  }
}
function uzlet2014_status_messages($variables) {
 $display = $variables['display'];
 $output = '';
 $status_heading = array(
  'status' => t('Status message'),
  'error' => t('Error message'),
  'warning' => t('Warning message'),
 );
 foreach (drupal_get_messages($display) as $type => $messages) {
  $conv_type = convert_status($type);
  $output .= "<div class=\"alert $conv_type alert-dismissable\">\n";
  $output .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
  if (count($messages) > 1) {
   $output .= " <ul>\n";
   foreach ($messages as $message) {
    $output .= '  <li>' . $message . "</li>\n";
   }
   $output .= " </ul>\n";
  } else {
   $output .= $messages[0];
  }
   $output .= "</div>\n";
 }
 return $output;
}
function convert_status($type) {
 switch($type) {
  case 'status':
   return 'alert-success';
   break;
  case 'warning':
   return 'alert-warning';
   break;
  case 'error':
   return 'alert-danger';
   break;
  default:
   return 'alert-info';
   break;
 }
}
function uzlet2014_menu_local_tasks(&$variables) {
 $output = '';
 if (!empty($variables['primary'])) {
  $variables['primary']['#prefix'] = '<h2 class="sr-only">' . t('Primary tabs') . '</h2>';
  $variables['primary']['#prefix'] .= '<ul class="nav nav-tabs primary">';
  $variables['primary']['#suffix'] = '</ul>';
  $output .= drupal_render($variables['primary']);
 }
 if (!empty($variables['secondary'])) {
  $variables['secondary']['#prefix'] = '<h2 class="sr-only">' . t('Secondary tabs') . '</h2>';
  $variables['secondary']['#prefix'] .= '<ul class="nav nav-tabs secondary">';
  $variables['secondary']['#suffix'] = '</ul>';
  $output .= drupal_render($variables['secondary']);
 }
 return $output;
}
*/


?>