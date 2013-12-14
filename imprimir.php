<?php
require('../classes/app.class.php');
require('../classes/badnews.class.php');

$idnoticia = (int)$_REQUEST['idnoticia'];
# genera 404
if ( !empty($avoid) && array_key_exists($idnoticia,$avoid) ) {
  include('../classes/404.inc.php');
  include('./404.php');
  die();
}

$cache_pattern = $cache_prefix . '|noticia';
$smarty->cache_lifetime = 10800;	# 3 hrs, 180 mins
$idseccion = $_REQUEST['uri'] = preg_replace('(\.(.*))','',$_REQUEST['uri']);
$cache_pattern .= "|$idseccion|$idnoticia";

$tpl = 'imprimir.tpl';
if($idnoticia) {
  if(!$smarty->is_cached($tpl,$cache_pattern)) {
    $data = new noticiaTable();
    $data->readEnv();
    if ($data->request['idnoticia']) {
      $row = $data->readRecord();
      if($row) {
        $smarty->assign('row',$row);
      } else {
        $avoid[$idnoticia] = mktime();
        $strArr = array2string($avoid,'avoid');
        $filename = dirname(__FILE__) . '/../classes/badnews.class.php';
        writeFile($filename,$strArr);
        header("Location: /"); 
        die();
      }
    }
  }
} else {
  header("Location: /"); die();
}

$smarty->display($tpl,$cache_pattern);
