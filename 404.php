<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/../classes/app.class.php');

$tpl_id = '404';
$tpl = "$tpl_id.tpl";
$smarty->assign('cur_page','404');
define('PAGE',true);
$title = 'Error 404: Documento No Encontrado';
$smarty->assign('title',$title);
$_REQUEST['uri'] = '404';
require_once ROOTDIR . '/classes/header.inc.php';

if ( CACHE_DEBUG === true ) cacheLog($_SERVER['REQUEST_URI'] . ' => ' . $cache_pattern . ' - 404.php');
//error_log(implode('|',array_keys($_SERVER)) . ' => ' . implode('|',$_SERVER));

# no cache_pattern para un 404
if(!$smarty->is_cached($tpl)) {
  $page = new paginaTable();
  $smarty->assign('mensaje',$page->readRecord(5));
  # Encuesta
  include_once ('./encuesta.inc.php');
  # Blogs
  include_once ('./blogs.inc.php');
}

$smarty->display($tpl);
require_once ROOTDIR .'/classes/footer.inc.php';
