<?php
defined('SORTORDERS_PATH') or die('Hacking attempt!');

global $page, $template, $conf, $user, $tokens, $pwg_loaded_plugins;


# DO SOME STUFF HERE... or not !


$template->assign(array(
  // this is useful when having big blocks of text which must be translated
  // prefer separated HTML files over big lang.php files
  'INTRO_CONTENT' => load_language('intro.html', SORTORDERS_PATH, array('return'=>true)),
  'SORTORDERS_PATH' => SORTORDERS_PATH,
  'SORTORDERS_ABS_PATH' => realpath(SORTORDERS_PATH).'/',
  ));

$template->set_filename('sortorders_page', realpath(SORTORDERS_PATH . 'template/sortorders_page.tpl'));
$template->assign_var_from_handle('CONTENT', 'sortorders_page');
