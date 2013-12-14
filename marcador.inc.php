<?php
# Marcador
$marcador = new marcadorTable();
#$marcador->limit = 1;
$marcadores = $marcador->readDataFilter("'$idedicion'=fecha::date AND marcador.activo IS TRUE");
$smarty->assign('marcadores',$marcadores);


$marcador = new marcadorTable();
$marcador->readEnv();
$row_marcador= $marcador->getVar("SELECT count(idmarcador) FROM marcador  WHERE '$idedicion'=fecha::date AND marcador.activo IS TRUE");


#print_r($row_marcador);