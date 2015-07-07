<?php
defined('SORTORDERS_PATH') or die('Hacking attempt!');

function get_choosen_sort_orders($order)
{
  global $conf, $page, $lang;

  array_push($order, array(l10n('Random'), 'RAND()', true)); 
  return $order; 
}
