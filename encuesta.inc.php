<?php
# Encuestas
$encuesta = new encuestaTable();
$encuesta->limit = 1;
$surveys = $encuesta->readDataFilter("'$idedicion' BETWEEN fecha_ini::date AND fecha_fin::date");
$smarty->assign('encuestas',$surveys);
