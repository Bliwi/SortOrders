<?php
defined('SORTORDERS_PATH') or die('Hacking attempt!');

/**
 * admin plugins menu link
 */
function sortorders_admin_plugin_menu_links($menu)
{
  $menu[] = array(
    'NAME' => l10n('SortOrders'),
    'URL' => SORTORDERS_ADMIN,
    );

  return $menu;
}

/**
 * add a tab on photo properties page
 */
function sortorders_tabsheet_before_select($sheets, $id)
{
  if ($id == 'photo')
  {
    $sheets['sortorders'] = array(
      'caption' => l10n('SortOrders'),
      'url' => SORTORDERS_ADMIN.'-photo&amp;image_id='.$_GET['image_id'],
      );
  }

  return $sheets;
}

/**
 * add a prefilter to the Batch Downloader
 */
function sortorders_add_batch_manager_prefilters($prefilters)
{
  $prefilters[] = array(
    'ID' => 'sortorders',
    'NAME' => l10n('SortOrders'),
    );

  return $prefilters;
}

/**
 * perform added prefilter
 */
function sortorders_perform_batch_manager_prefilters($filter_sets, $prefilter)
{
  if ($prefilter == 'sortorders')
  {
    $query = '
SELECT id
  FROM '.IMAGES_TABLE.'
  ORDER BY RAND()
  LIMIT 20
;';
    $filter_sets[] = query2array($query, null, 'id');
  }

  return $filter_sets;
}

/**
 * add an action to the Batch Manager
 */
function sortorders_loc_end_element_set_global()
{
  global $template;

  /*
    CONTENT is optional
    for big contents it is advised to use a template file

    $template->set_filename('sortorders_batchmanager_action', realpath(SORTORDERS_PATH.'template/batchmanager_action.tpl'));
    $content = $template->parse('sortorders_batchmanager_action', true);
   */
  $template->append('element_set_global_plugins_actions', array(
    'ID' => 'sortorders',
    'NAME' => l10n('SortOrders'),
    'CONTENT' => '<label><input type="checkbox" name="check_sortorders"> '.l10n('Check me!').'</label>',
    ));
}

/**
 * perform added action
 */
function sortorders_element_set_global_action($action, $collection)
{
  global $page;

  if ($action == 'sortorders')
  {
    if (empty($_POST['check_sortorders']))
    {
      $page['warnings'][] = l10n('Nothing appened, but you didn\'t check the box!');
    }
    else
    {
      $page['infos'][] = l10n('Nothing appened, but you checked the box!');
    }
  }
}
