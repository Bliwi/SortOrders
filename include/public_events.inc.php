<?php
defined('SORTORDERS_PATH') or die('Hacking attempt!');

function get_choosen_sort_orders($orders)
{
  global $conf, $page;
<<<<<<< HEAD
  if (!isset($_SESSION['random_seed'])) {
    $_SESSION['random_seed'] = mt_rand();
  }
  array_push($orders, array(l10n('Random'), 'RAND(' . $_SESSION['random_seed'] . ')', true)); 
=======

  array_push($orders, array(l10n('Random'), 'RAND()', true)); 
>>>>>>> 106a5689079a91f7a413e8a9ad4694b7aa72ad45
  
  $to_remove = array();
  foreach($conf['sortorders']['disabled'] as $disabled)
    foreach($orders as $order)
      if(str_replace(' ', '_', $order[1]) == $disabled)
        array_push($to_remove, $order[1]);

  return array_filter($orders, function($v) use($to_remove) {return !in_array($v[1], $to_remove);}); 
}
<<<<<<< HEAD

function sortorders_add_button()
{
  global $template;

  $template->assign('SORTORDERS_PATH', SORTORDERS_PATH);
  $template->set_filename('randomize_button', realpath(SORTORDERS_PATH.'template/randomize_button.tpl'));
  $button = $template->parse('randomize_button', true);
  
  $template->add_index_button($button, BUTTONS_RANK_NEUTRAL);
}
=======
>>>>>>> 106a5689079a91f7a413e8a9ad4694b7aa72ad45
