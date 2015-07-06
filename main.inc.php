<?php
/*
Plugin Name: sortorders
Version: 1.0.0
Description: Select which sort orders that should be avalible, also adds a random sort order.
Plugin URI:
Author: Per Sandström
Author URI:
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
}
else
{
  // file containing all public handlers functions
  $public_file = SORTORDERS_PATH . 'include/public_events.inc.php';

  // add category prefered image orders
  add_event_handler('get_category_preferred_image_orders', 'get_choosen_sort_orders',
	  EVENT_HANDLER_PRIORITY_NEUTRAL, $public_file);
}

// file containing API function
$ws_file = SORTORDERS_PATH . 'include/ws_functions.inc.php';

// add API function
add_event_handler('ws_add_methods', 'sortorders_ws_add_methods',
    EVENT_HANDLER_PRIORITY_NEUTRAL, $ws_file);


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
