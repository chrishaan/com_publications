<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function PublicationsBuildRoute(&$query){
$segments = array();
  if(isset($query['topic'])){
    $segments[] = $query['topic'];
    unset($query['topic']);
  } else {
	  $segments[] = '';
  }
  if(isset($query['type'])){
    $segments[] = $query['type'];
    unset($query['type']);
  } else {
	 $segments[] = '';
  }
    if(isset($query['year'])){
    $segments[] = $query['year'];
    unset($query['year']);
  } else {
	 $segments[] = '';
  }

  return $segments;
}
/*
 * Function to convert a SEF URL back to a system URL
 */
function PublicationsParseRoute($segments) {
  $vars = array();

  if(isset($segments[0])){
      $vars['topic'] = $segments[0];
  }
  if(isset($segments[1])){
      $vars['type'] = $segments[1];
  }
  if(isset($segments[2])){
      $vars['year'] = $segments[2];
  }
  return $vars;
}

?>