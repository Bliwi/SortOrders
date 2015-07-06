<?php
defined('SORTORDERS_PATH') or die('Hacking attempt!');

/**
 * detect current section
 */
function sortorders_loc_end_section_init()
{
  global $tokens, $page, $conf;

  if ($tokens[0] == 'sortorders')
  {
    $page['section'] = 'sortorders';

    // section_title is for breadcrumb, title is for page <title>
    $page['section_title'] = '<a href="'.get_absolute_root_url().'">'.l10n('Home').'</a>'.$conf['level_separator'].'<a href="'.SORTORDERS_PUBLIC.'">'.l10n('SortOrders').'</a>';
    $page['title'] = l10n('SortOrders');

    $page['body_id'] = 'theSortOrdersPage';
    $page['is_external'] = true; // inform Piwigo that you are on a new page
  }
}

/**
 * include public page
 */
function sortorders_loc_end_page()
{
  global $page, $template;

  if (isset($page['section']) and $page['section']=='sortorders')
  {
    include(SORTORDERS_PATH . 'include/sortorders_page.inc.php');
  }
}

/*
 * button on album and photos pages
 */
function sortorders_add_button()
{
  global $template;

  $template->assign('SORTORDERS_PATH', SORTORDERS_PATH);
  $template->set_filename('sortorders_button', realpath(SORTORDERS_PATH.'template/my_button.tpl'));
  $button = $template->parse('sortorders_button', true);

  if (script_basename()=='index')
  {
    $template->add_index_button($button, BUTTONS_RANK_NEUTRAL);
  }
  else
  {
    $template->add_picture_button($button, BUTTONS_RANK_NEUTRAL);
  }
}

/**
 * add a prefilter on photo page
 */
function sortorders_loc_end_picture()
{
  global $template;

  $template->set_prefilter('picture', 'sortorders_picture_prefilter');
}

function sortorders_picture_prefilter($content)
{
  $search = '{if $display_info.author and isset($INFO_AUTHOR)}';
  $replace = '
<div id="SortOrders" class="imageInfo">
  <dt>{\'SortOrders\'|@translate}</dt>
  <dd style="color:orange;">{\'Piwigo rocks\'|@translate}</dd>
</div>
';

  return str_replace($search, $replace.$search, $content);
}
