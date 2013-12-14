<?php
require('../classes/app.class.php');

$tpl = 'rss.tpl';
$tpl_id = $_REQUEST['uri'];
if($tpl_id)
  $cache_pattern = "rss|$tpl_id";
else $cache_pattern = "rss|portada";

$smarty->cache_lifetime = 1800;	# 3 hrs, 180 mins
if(!$smarty->is_cached($tpl,$cache_pattern)) {
  $data = new noticiaTable;
  $data->readEnv();

  setlocale(LC_TIME, "en_US");
  include_once ('../classes/thisedition.php');
  if ($tpl_id)
    $rows = $data->readDataFilter("edicion = '$idedicion' AND seccion.uri ILIKE '".$data->database->escape($_REQUEST['uri'])."' AND noticia.estado = 'A'");
  else 
    $rows = $data->readDataFilter("edicion = '$idedicion' AND noticia.estado = 'A' AND seccion.uri NOT ILIKE 'la-prensa-en-video'");
  $smarty->assign('rows', $rows);
  $smarty->assign('url', URL);
}

header('Content-type: text/xml; charset=utf-8', true);
$smarty->display($tpl,$cache_pattern);
?>
