<?php
require('../classes/app.class.php');

$cache_pattern = $cache_prefix . '|minoticia';
$smarty->cache_lifetime = 10800;	# 3 hrs, 180 mins
$idnoticia = (int)$_REQUEST['idminoticia'];
$idseccion = $_REQUEST['uri'] = preg_replace('(\.(.*))','',$_REQUEST['uri']);
$cache_pattern .= "|$idseccion|$idnoticia";

$tpl = 'minoticia/imprimir.tpl';
if($idnoticia) {
  if(!$smarty->is_cached($tpl,$cache_pattern)) {
    $data = new minoticiaTable();
    $data->readEnv();
    if ($data->request['idminoticia']) {
      $row = $data->readRecord();
      if($row) {
        $smarty->assign('row',$row);
      } else {
        header("Location: /minoticia"); 
        die();
      }
    }
  }
} else {
  header("Location: /minoticia"); die();
}

$smarty->display($tpl,$cache_pattern);