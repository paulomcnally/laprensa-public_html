<?php
require_once('layout.php');


$encuesta = new encuestapicTable();
$fotos = new opcionespicTable();

$id_active_poll = $encuesta->getVar("SELECT idencuestapic FROM encuestapic WHERE '$idedicion' BETWEEN fecha_inicio::date AND fecha_fin::date AND cerrada IS false");
if ($id_active_poll){
    $album = $fotos->readDataFilter("opcionespic.idencuestapic = " . $id_active_poll);
}
echo json_encode($album);
?>
