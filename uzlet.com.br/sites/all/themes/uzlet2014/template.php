<?php


function uzlet2014_textarea($element) {
  $element['element']['#resizable'] = false ;
  return theme_textarea($element) ;
}


?>