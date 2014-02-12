<?php
require_once('layout.php');

$tpl_id = (int)$_REQUEST['id'];

$smarty->assign('page_template', "pic.html");

$encuesta = new encuestapicTable();
/*
 * Photo detail
 */
$pic_instance = new opcionespicTable();
$pic = $pic_instance->readRecord($tpl_id);
$smarty->assign('pic', $pic); 
/*
 * Top voted photos
 */

$id_active_poll = $encuesta->getVar("SELECT idencuestapic FROM encuestapic WHERE '$idedicion' BETWEEN fecha_inicio::date AND fecha_fin::date AND cerrada IS false");
$fotos = new opcionespicTable();
$fotos->order = 'votos DESC';
$fotos->limit = 4;
if ($id_active_poll){
    $mostvoted = $fotos->readDataFilter("opcionespic.idencuestapic = " . $id_active_poll);
    $smarty->assign('mostvoted', $mostvoted);
}

$semanasclasificadas = $encuesta->readDataFilter("encuestapic.cerrada IS TRUE");
$smarty->assign('semanas', $semanasclasificadas);

$smarty->display($tpl);
?>
