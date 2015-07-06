<?php
/*
Plugin Name: sortorders
Version: 2.7.0
Description: This is not a plugin. It's a sortorders for future plugins.
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=543
Author: Mistic
Author URI: http://www.strangeplanet.fr
*/

/**
 * This is the main file of the plugin, called by Piwigo in "include/common.inc.php" line 137.
 * At this point of the code, Piwigo is not completely initialized, so nothing should be done directly
 * except define constants and event handlers (see http://piwigo.org/doc/doku.php?id=dev:plugins)
 */

defined('PHPWG_ROOT_PATH') or die('Hacking attempt!');


// +-----------------------------------------------------------------------+
// | Define plugin constants                                               |
// +-----------------------------------------------------------------------+
global $prefixeTable;

define('SORTORDERS_ID',      basename(dirname(__FILE__)));
define('SORTORDERS_PATH' ,   PHPWG_PLUGINS_PATH . SORTORDERS_ID . '/');
define('SORTORDERS_TABLE',   $prefixeTable . 'sortorders');
define('SORTORDERS_ADMIN',   get_root_url() . 'admin.php?page=plugin-' . SORTORDERS_ID);
define('SORTORDERS_PUBLIC',  get_absolute_root_url() . make_index_url(array('section' => 'sortorders')) . '/');
define('SORTORDERS_DIR',     PHPWG_ROOT_PATH . PWG_LOCAL_DIR . 'sortorders/');


// +-----------------------------------------------------------------------+
// | Add event handlers                                                    |
// +-----------------------------------------------------------------------+
// init the plugin
add_event_handler('init', 'sortorders_init');

/*
 * this is the common way to define event functions: create a new function for each event you want to handle
 */
if (defined('IN_ADMIN'))
{
  // file containing all admin handlers functions
  $admin_file = SORTORDERS_PATH . 'include/admin_events.inc.php';

  // admin plugins menu link
  add_event_handler('get_admin_plugin_menu_links', 'sortorders_admin_plugin_menu_links',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $admin_file);

  // new tab on photo page
  add_event_handler('tabsheet_before_select', 'sortorders_tabsheet_before_select',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $admin_file);

  // new prefiler in Batch Manager
  add_event_handler('get_batch_manager_prefilters', 'sortorders_add_batch_manager_prefilters',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $admin_file);
  add_event_handler('perform_batch_manager_prefilters', 'sortorders_perform_batch_manager_prefilters',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $admin_file);

  // new action in Batch Manager
  add_event_handler('loc_end_element_set_global', 'sortorders_loc_end_element_set_global',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $admin_file);
  add_event_handler('element_set_global_action', 'sortorders_element_set_global_action',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $admin_file);
}
else
{
  // file containing all public handlers functions
  $public_file = SORTORDERS_PATH . 'include/public_events.inc.php';

  // add a public section
  add_event_handler('loc_end_section_init', 'sortorders_loc_end_section_init',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $public_file);
  add_event_handler('loc_end_index', 'sortorders_loc_end_page',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $public_file);

  // add button on album and photos pages
  add_event_handler('loc_end_index', 'sortorders_add_button',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $public_file);
  add_event_handler('loc_end_picture', 'sortorders_add_button',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $public_file);

  // prefilter on photo page
  add_event_handler('loc_end_picture', 'sortorders_loc_end_picture',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $public_file);
}

// file containing API function
$ws_file = SORTORDERS_PATH . 'include/ws_functions.inc.php';

// add API function
add_event_handler('ws_add_methods', 'sortorders_ws_add_methods',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $ws_file);


/*
 * event functions can also be wrapped in a class
 */

// file containing the class for menu handlers functions
$menu_file = SORTORDERS_PATH . 'include/menu_events.class.php';

// add item to existing menu (EVENT_HANDLER_PRIORITY_NEUTRAL+10 is for compatibility with Advanced Menu Manager plugin)
add_event_handler('blockmanager_apply', array('SortOrdersMenu', 'blockmanager_apply1'),
  EVENT_HANDLER_PRIORITY_NEUTRAL+10, $menu_file);

// add a new menu block (the declaration must be done every time, in order to be able to manage the menu block in "Menus" screen and Advanced Menu Manager)
add_event_handler('blockmanager_register_blocks', array('SortOrdersMenu', 'blockmanager_register_blocks'),
  EVENT_HANDLER_PRIORITY_NEUTRAL, $menu_file);
add_event_handler('blockmanager_apply', array('SortOrdersMenu', 'blockmanager_apply2'),
  EVENT_HANDLER_PRIORITY_NEUTRAL, $menu_file);

// NOTE: blockmanager_apply1() and blockmanager_apply2() can (must) be merged


/**
 * plugin initialization
 *   - check for upgrades
 *   - unserialize configuration
 *   - load language
 */
function sortorders_init()
{
  global $conf;

  // load plugin language file
  load_language('plugin.lang', SORTORDERS_PATH);

  // prepare plugin configuration
  $conf['sortorders'] = safe_unserialize($conf['sortorders']);
}
