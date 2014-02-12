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
    "meta"=> array("description"=>"PicAventura - Se trata de una dinámica que premiará la creatividad. Lo que tenés que hacer es subir en cualquiera de las cuentas las mejores “pics” de tus salidas, ¡ojo! que no necesariamente tengan buena resolución, pero que sí hayan hecho uso de la creatividad.",
    "keywords"=>"PicAventura, Concurso, La Prensa, Claro, pics, creatividad, salidas"),
    "owner1"=> array("name"=>"Aqui entre Nos","path"=>"http://es-es.facebook.com/AENelsuple"),
    "owner2"=> array("name"=>"Claro","path"=>"http://www.claro.com.ni/"),
    "owner3"=> array("name"=>"LaPrensa","path"=>"/"),
    "socialnetwork"=>array(
        "fb"=>"http://www.facebook.com/laprensanicaragua",
        "tw"=>"http://www.twitter.com/aentrenos",
        "ig"=>"http://www.instagram.com/aensuple"),
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
