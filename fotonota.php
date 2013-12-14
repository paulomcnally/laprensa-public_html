<?php
require('../classes/app.class.php');
$smarty->caching=0;
$data = new fotonotaTable;
$secnota = new seccionTable;
$secnota->readEnv();
$data->readEnv();
$data->order = 'idseccion';

$secc = $data->readData();
$smarty->assign('secnota',$secc);

#$idedicion = '2009-10-29';
if ($data->request['idfotonota']) {
  $row = $data->readRecord();
  $smarty->assign('row',$row);
} 
if ($secnota->request['uri']) {
  $rows = $data->readDataFilter("edicion = '$idedicion' AND uri='".$secnota->request['uri']."'");
  $smarty->assign('rows',$rows);
} else {
  $rows = $data->readDataFilter("edicion = '$idedicion'");
  $smarty->assign('rows',$rows);
}
require_once "XML/RSS.php";
#require('../classes/thisedition.php');
require('../classes/header.inc.php');

  # Edicion
  if(!isset($edicion))  {
    $edicion = new edicionTable();
    list($row) = $edicion->readDataFilter("edicion = '$idedicion' AND estado = 'A'");
    $smarty->assign('edicion',$row);
    unset($row);
  }
  # Encuestas
  include ('./encuesta.inc.php');
  # Blogs
  include ('./blogs.inc.php');
  # Fin Blogs
  $smarty->display("fotonota.tpl");
include ('../classes/footer.inc.php');
?>
