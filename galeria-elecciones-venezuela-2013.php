<?php
session_start();
require '../classes/app.class.php';
define('GALERIA',true);

$cache_pattern = 'elecciones-2013-venezuela|galeria';
$tpl = 'elecciones-venezuela-2013/galeria.tpl';

if (!$smarty->is_cached($tpl, $cache_pattern)){
     $edicion = new edicionTable();
    list($row) = $edicion->readDataFilter("edicion = '$idedicion' AND 1=1");
    $_SESSION['edicionactual'] = ((int)$_REQUEST['year']) . '-' . ((int)$_REQUEST['month']) . '-' . ((int)$_REQUEST['day']);;
    $smarty->assign('edicion',$row);
 
     $coleccion = new coleccionTable();
     $galeria = $coleccion->readDataFilter("coleccion.idgaleria = 1876"); 
     $smarty->assign('galeria', $galeria);
}

$smarty->assign('title','Galer&iacute;a fotos');

$smarty->display($tpl, $cache_pattern);
?>
