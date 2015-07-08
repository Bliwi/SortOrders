<?php
defined('SORTORDERS_PATH') or die('Hacking attempt!');

// +-----------------------------------------------------------------------+
// | Configuration tab                                                     |
// +-----------------------------------------------------------------------+

$sort_orders = get_category_preferred_image_orders();
$page['infos'][] = l10n(implode(array_column($sort_orders, 0)));
array_shift($sort_orders); // remove standard sort order
$sort_ids = str_replace(' ', '_', array_column($sort_orders, 1));
$sort_names = array_column($sort_orders, 0);

// save config
if (isset($_POST['save_config']))
{	
  $disabled = array();
  foreach($sort_ids as $id)
    if(!isset($_POST[$id]))
      array_push($disabled, $id);
  $conf['sortorders'] = array('disabled' => $disabled);
  conf_update_param('sortorders', $conf['sortorders']);
  $page['infos'][] = l10n('Information data registered in database');
}

// SQL order command as id, is there a better way?
$template->assign('sort_ids', $sort_ids); 
$template->assign('sort_names', $sort_names);
$template->assign('sortorders', $conf['sortorders']);

// define template file
$template->set_filename('sortorders_content', realpath(SORTORDERS_PATH . 'admin/template/config.tpl'));
