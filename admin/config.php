<?php
defined('SORTORDERS_PATH') or die('Hacking attempt!');

// +-----------------------------------------------------------------------+
// | Configuration tab                                                     |
// +-----------------------------------------------------------------------+

// save config
if (isset($_POST['save_config']))
{
  $conf['sortorders'] = array(
    'option1' => intval($_POST['option1']),
    'option2' => isset($_POST['option2']),
    'option3' => $_POST['option3'],
    );

  conf_update_param('sortorders', $conf['sortorders']);
  $page['infos'][] = l10n('Information data registered in database');
}
 
$sort_orders = get_category_preferred_image_orders();

// SQL order command as id, is there a better way?
$template->assign('sort_ids', array_column($sort_orders, 1)); 
$template->assign('sort_names', array_column($sort_orders, 0));
$template->assign('disabled', $conf['sortorders']);

// define template file
$template->set_filename('sortorders_content', realpath(SORTORDERS_PATH . 'admin/template/config.tpl'));
