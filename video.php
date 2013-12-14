<?php

define('VIDEOS',true);
require("../classes/app.class.php");
require ('../classes/paginador.class.php');
$idvideo = (int)$_REQUEST['idvideominoticia'];
$tpl = "minoticia/video.tpl";

# instanciamos las clases
$video1 = new videominoticiaTable;
$video = new coleccionvideoTable;
$noti = new minoticiaTable;

include("../classes/header-minoticia.inc.php");
include ('comentarmn.php');

if(!$smarty->is_cached($tpl, $cache_pattern . $idvideo)){
   $rows = $video->readDataSql("SELECT videominoticia.idvideominoticia,coleccionvideo.texto,coleccionvideo.idcoleccionvideo,videominoticia.archivovideo,videominoticia.videominoticia FROM coleccionvideo,galeriavideo, videominoticia WHERE videominoticia.idvideominoticia = coleccionvideo.idvideominoticia AND galeriavideo.activa IS TRUE AND coleccionvideo.idvideominoticia <> " . $idvideo);
   $smarty->assign("vids", $rows);
   $curr = $video1->readRecord($idvideo);
}

    // Votacion
    if($curr) {
      $stars = $video1->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM videominoticia WHERE idvideominoticia=".$curr["idvideominoticia"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
      $votos = $video1->getVar("SELECT (raiting_1+raiting_2+raiting_3+raiting_4+raiting_5) AS resultado FROM videominoticia WHERE idvideominoticia=".$curr["idvideominoticia"]);
    }
    if(is_float($stars)) $stars = round($stars,1);
    elseif(empty($stars)) $stars = 0;
    $curr["stars"]=$stars;
    $curr["votos"]=$votos;

    $comments = new comentariovideoTable;
    $comments->readEnv();
    $comments->order = 'creacion';
    $comments->readEnv();
    if($comments->request['idvideominoticia']) {
      $paginador=new paginador($comments,10,$_REQUEST["page"]);
      $comentarios=$paginador->getPageResult("SELECT * FROM comentariovideo WHERE estado='A' AND comentariovideo.idvideominoticia = ".$comments->request['idvideominoticia']." ORDER BY creacion DESC");
      $smarty->assign('pg',$paginador->PAGINA);
      $smarty->assign('inicio',$paginador->INICIO);
      $smarty->assign('pgs',$paginador->TOTAL);
      $smarty->assign('comentarios',$comentarios);
      unset($comentarios);
    }

$smarty->assign("current", $curr);
$smarty->assign("enportada",true);
$smarty->assign("mostrar_torre", 1);
$smarty->assign("seccionvideo", true);
$smarty->display($tpl, $cache_pattern . $idvideo);

if(!$smarty->is_cached('minoticia/ultimasnoticiasuser.inc.tpl',$cache_pattern . '|ultimasnoticias')){
   $nportada = $noti->readDataFilter("minoticia.ubicacion = 'L' OR minoticia.ubicacion = 'M' OR minoticia.ubicacion = 'S'");
   $smarty->assign("noticiasportada", $nportada);
}

$smarty->display('minoticia/ultimasnoticiasuser.inc.tpl',$cache_pattern . '|ultimasnoticias');
include("../classes/footer.inc.php");
?>
