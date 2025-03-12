<?php
defined('SORTORDERS_PATH') or die('Hacking attempt!');

function sortorders_ws_add_methods($arr)
{
  $service = &$arr[0];
  
  $service->addMethod(
    'pwg.categories.randomSortOrder',
    'ws_categories_randomSortOrder',
    array(),
    'Unset the random_seed session variable to generate a new random sort order.'
  );
}

function ws_categories_randomSortOrder($params)
{
  // Unset the random_seed session variable to generate a new random sort order
  if (isset($_SESSION['random_seed'])) {
    unset($_SESSION['random_seed']);
  }
  
  return array('status' => 'ok');
}
?>