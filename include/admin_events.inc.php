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
