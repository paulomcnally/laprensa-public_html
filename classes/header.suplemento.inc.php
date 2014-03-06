<?php
include_once ('../classes/app.class.php');
$idarticulo = (int)$_REQUEST['idarticulo'];

$smarty->caching=0;
if(!$smarty->is_cached('header.tpl',$cache_pattern)) {
  # Edicion
  $edicion = new edicionsuplementoTable();
  list($row) = $edicion->readDataFilter("edicionsuplemento = '$idedicion'");
  # Si la edicion no existe o no esta publicad
  if(!$row) {
  }
  $smarty->assign('edicion',$row);
  unset($row);
  $sups = new suplementoTable;
  $sups->readEnv();
  if ($sups->request['uri']) {
    $infosup = $sups->readDataFilter("suplemento.uri='". $sups->request['uri'] ."'");
    $smarty->assign('infosup',$infosup[0]);
  }
  $rows = $sups->readDataSQL("SELECT suplemento,uri,ultima FROM suplemento, (SELECT idsuplemento,MAX(edicionsuplemento) AS ultima FROM edicionsuplemento GROUP BY idsuplemento) AS ultimaedicion WHERE suplemento.idsuplemento=ultimaedicion.idsuplemento AND ultima < CURRENT_DATE ORDER BY ultima DESC");
  $smarty->assign('suplementos',$rows);
  if($idarticulo) {
    $table = new Table('articulo');
    $title = $table->getVar("SELECT articulo FROM articulo WHERE idarticulo = $idarticulo");
  }
  $smarty->assign('title',$title);
# Ads
  if(ZONA_SUPLEMENTO===true) {
         @include_once(ROOTDIR.'/zonas/suplemento.php');
         $smarty->assign('uri', 'magazine');
        }


}
$smarty->display('header.tpl',$cache_pattern);
?>
