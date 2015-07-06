<?php
defined('SORTORDERS_PATH') or die('Hacking attempt!');

// +-----------------------------------------------------------------------+
// | Home tab                                                              |
// +-----------------------------------------------------------------------+

// send variables to template
$template->assign(array(
  'sortorders' => $conf['sortorders'],
  'INTRO_CONTENT' => load_language('intro.html', SORTORDERS_PATH, array('return'=>true)),
  ));

// define template file
$template->set_filename('sortorders_content', realpath(SORTORDERS_PATH . 'admin/template/home.tpl'));
