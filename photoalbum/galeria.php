<?php
require_once('layout.php');
define('GALERIA', true);
$semana = str_replace("-", " ", $_REQUEST['semana']);
$smarty->assign('page_template', "gallery.html");


$opciones = new opcionespicTable();
$opciones->limit = 7;
$idencuesta = $encuesta->getVar("SELECT idencuestapic FROM encuestapic WHERE encuestapic.encuestapic = '$semana'");
$ganadoras = $opciones->readDataFilter("opcionespic.idencuestapic = " . $idencuesta);
$smarty->assign("album", $ganadoras);

$semanasclasificadas = $encuesta->readDataFilter("encuestapic.cerrada IS TRUE");
$smarty->assign('semanas', $semanasclasificadas);

$fotos = new opcionespicTable();
$fotos->order = 'votos DESC';
$fotos->limit = 4;
if ($id_active_poll){
    $mostvoted = $fotos->readDataFilter("opcionespic.idencuestapic = " . $id_active_poll);
    $smarty->assign('mostvoted', $mostvoted);
}

$smarty->display($tpl);
?>
