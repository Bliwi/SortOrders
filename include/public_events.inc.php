<?php
defined('SORTORDERS_PATH') or die('Hacking attempt!');

function get_choosen_sort_orders($orders)
{
  global $conf, $page;
  if (!isset($_SESSION['random_seed'])) {
    $_SESSION['random_seed'] = mt_rand();
  }
  array_push($orders, array(l10n('Random'), 'RAND(' . $_SESSION['random_seed'] . ')', true)); 
  
  $to_remove = array();
  foreach($conf['sortorders']['disabled'] as $disabled)
    foreach($orders as $order)
      if(str_replace(' ', '_', $order[1]) == $disabled)
        array_push($to_remove, $order[1]);

  return array_filter($orders, function($v) use($to_remove) {return !in_array($v[1], $to_remove);}); 
}

function sortorders_add_button()
{
  global $template;

  $template->assign('SORTORDERS_PATH', SORTORDERS_PATH);
  $template->set_filename('randomize_button', realpath(SORTORDERS_PATH.'template/randomize_button.tpl'));
  $button = $template->parse('randomize_button', true);
  
  $template->add_index_button($button, BUTTONS_RANK_NEUTRAL);
}