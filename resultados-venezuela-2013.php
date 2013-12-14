<?php
session_start();
require '../classes/app.class.php';

define('RESULTADOS',true);
define('ESPECIAL_HOME',false);
$cache_pattern = 'elecciones-2013-venezuela|resultados';
$tpl = 'elecciones-venezuela-2013/results.tpl';

if (!$smarty->is_cached($tpl, $cache_pattern)){
    $edicion = new edicionTable();
    list($row) = $edicion->readDataFilter("edicion = '$idedicion' AND 1=1");
    $_SESSION['edicionactual'] = ((int)$_REQUEST['year']) . '-' . ((int)$_REQUEST['month']) . '-' . ((int)$_REQUEST['day']);;
    $smarty->assign('edicion',$row);

    $candidato = new ppoliticoTable();
    $candidatos = $candidato->readDataFilter("ppolitico.orden >= 14");
    $smarty->assign('candidatos', $candidatos);
}

$smarty->assign('title', 'Resultados votaciones');

$smarty->display($tpl, $cache_pattern);
?>
