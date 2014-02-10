<?php
require('/var/www/html/laprensa/classes/app.class.php');

$cache_pattern = 'photoalbum_aventuras';
$tpl = 'photoalbum/base.html';

/*
 * Site meta info
 */
$site= array(
    "title"=>"PicAventura",
    "path"=>"/pic-aventura",
    "description"=>"PicAventura - Se trata de una dinámica que premiará la creatividad. Lo que tenés que hacer es subir en cualquiera de las cuentas las mejores “pics” de tus salidas, ¡ojo! que no necesariamente tengan buena resolución, pero que sí hayan hecho uso de la creatividad.",
    "keywords"=>"PicAventura, Concurso, La Prensa, Claro, pics, creatividad, salidas",
    "owner"=> array("name"=>"Aqui entre Nos","path"=>""),
    "owner"=> array("name"=>"Claro","path"=>""),
    "owner"=> array("name"=>"LaPrensa","path"=>"/"),
    "socialnetwork"=>array(
        "fb"=>"http://www.facebook.com/laprensanicaragua",
        "tw"=>"http://twitter.com/aentrenos",
        "ig"=>"http://instagram.com/aensuple"),
    "meta1"=>"",
    "meta2"=>""
);

$smarty->assign('site', $site);

$encuesta = new encuestapicTable();
$fotos = new opcionespicTable();
$id_active_poll = $encuesta->getVar("SELECT idencuestapic FROM encuestapic WHERE '$idedicion' BETWEEN fecha_inicio::date AND fecha_fin::date AND cerrada IS false");
if ($id_active_poll){
    $album = $fotos->readDataFilter("opcionespic.idencuestapic = " . $id_active_poll);
    $smarty->assign('album', $album);
}
$encuesta->order="fecha_fin ASC";
$semanasclasificadas = $encuesta->readDataFilter("encuestapic.cerrada IS TRUE");
$smarty->assign('semanas', $semanasclasificadas);

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

?>
