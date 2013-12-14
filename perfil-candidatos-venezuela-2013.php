<?php
session_start();
require '../classes/app.class.php';

$idperfil = (string)$_REQUEST['idcandidato'];
define('CANDIDATOS',true);
$cache_pattern = "elecciones-2013-venezuela|perfiles|$idperfil";
$tpl = 'elecciones-venezuela-2013/perfil.tpl';

if (!$smarty->is_cached($tpl, $cache_pattern)){
    $edicion = new edicionTable();
    list($row) = $edicion->readDataFilter("edicion = '$idedicion' AND 1=1");
    $_SESSION['edicionactual'] = ((int)$_REQUEST['year']) . '-' . ((int)$_REQUEST['month']) . '-' . ((int)$_REQUEST['day']);;
    $smarty->assign('edicion',$row);

    $candidato = new ppoliticoTable();
    $perfil = $candidato->readDataFilter("ppolitico.idppolitico = '$idperfil'");
    $smarty->assign('perfil', $perfil[0]); 
    $smarty->assign('title', 'Perfil ' . $perfil[0]['presidente']);
}
$smarty->display($tpl, $cache_pattern);
?>
