<?php
defined('SORTORDERS_PATH') or die('Hacking attempt!');

/*
 * There is two ways to use class methods as event handlers:
 *
 * >  add_event_handler('blockmanager_apply', array('SortOrdersMenu', 'blockmanager_apply'));
 *      in this case the method 'blockmanager_apply' must be a static method of the class 'SortOrdersMenu'
 *
 * >  $myObj = new SortOrdersMenu();
 * >  add_event_handler('blockmanager_apply', array(&$myObj, 'blockmanager_apply'));
 *      in this case the method 'blockmanager_apply' must be a public method of the object '$myObj'
 */

class SortOrdersMenu
{
  /**
   * add link in existing menu
   */
  static function blockmanager_apply1($menu_ref_arr)
  {
    $menu = &$menu_ref_arr[0];

    if (($block = $menu->get_block('mbMenu')) != null)
    {
      $block->data[] = array(
        'URL' => SORTORDERS_PUBLIC,
        'TITLE' => l10n('SortOrders'),
        'NAME' => l10n('SortOrders'),
        );
    }
  }

  /**
   * add a new menu block
   */
  static function blockmanager_register_blocks($menu_ref_arr)
  {
    $menu = &$menu_ref_arr[0];

    if ($menu->get_id() == 'menubar')
    {
      // identifier, title, owner
      $menu->register_block(new RegisteredBlock('mbSortOrders', l10n('SortOrders'), 'SortOrders'));
    }
  }

  /**
   * fill the added menu block
   */
  static function blockmanager_apply2($menu_ref_arr)
  {
    $menu = &$menu_ref_arr[0];

    if (($block = $menu->get_block('mbSortOrders')) != null)
    {
      $block->set_title(l10n('SortOrders'));

      $block->data['link1'] =
        array(
          'URL' => get_absolute_root_url(),
          'TITLE' => l10n('First link'),
          'NAME' => l10n('Link 1'),
          'REL'=> 'rel="nofollow"',
        );

      $block->data['link2'] =
        array(
          'URL' => SORTORDERS_PUBLIC,
          'TITLE' => l10n('Second link'),
          'NAME' => l10n('Link 2'),
        );

      $block->template = realpath(SORTORDERS_PATH . 'template/menubar_sortorders.tpl');
    }
  }
}
