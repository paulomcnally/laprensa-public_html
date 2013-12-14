<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../classes/app.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/../classes/thisedition.php';
$smarty->caching=0;
$data = new noticiaTable;
$data->order = 'ultimahora ASC, hora DESC, orden DESC,creacion DESC';
$data->readEnv();
//$data->limit = 5;
$seccionesw = new seccionTable;

if ($data->request['idseccion'])
  $rows = $data->readDataFilter("edicion = '".date("Y/m/d")."' AND noticia.idseccion= '".$data->request['idseccion']."'");
else
  $rows = $data->readDataFilter("noticia.idseccion NOT IN (10) AND (noticia.ubicacion='I' OR noticia.ubicacion='D' OR noticia.ultimahora IS true) AND noticia.estado='A' AND edicion='$idedicion'");
$smarty->assign('rows', $rows);
$smarty->assign('secccion',$seccionesw->selectMenu("SELECT idseccion,seccion FROM seccion WHERE seccion.activo IS TRUE AND seccion.menu IS TRUE ORDER BY seccion"));

$area=$_REQUEST["area"];
$width=substr($area,0,strpos($area,"X"));
$height=substr($area,strpos($area,"X")+1,strlen($area)-strpos($area,"X"));
$smarty->assign("width",$width);
$smarty->assign("height",$height);

$smarty->display('caja.tpl','misc');
?>
