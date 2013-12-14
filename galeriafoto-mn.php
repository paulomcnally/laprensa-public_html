<?php
session_start();
define(SGALERIA,true);
require("../classes/app.class.php");
include ('comentarmn.php');
$idgaleria = (int)$_REQUEST['idgaleriaminoticia'];
$fotosgaleria = new galeriafotominoticiaTable();
$fotosgaleria->readEnv();
$galerias = new galeriaminoticiaTable();
$galerias->readEnv();
$fotomn = new fotominoticiaTable();
$fotomn->readEnv();

$tpl = "minoticia/galeriafotos.tpl";
include("../classes/header-minoticia.inc.php");
require ('../classes/paginador.class.php');

$smarty->cache_lifetime = 1800;

if(!$smarty->is_cached($tpl, $cache_pattern . $idgaleria)){
    $galery = $galerias->readRecord($idgaleria);
    $fotos = $fotosgaleria->readDataFilter("galeriafotominoticia.idgaleriaminoticia = " 
    . $galerias->request['idgaleriaminoticia']);    
    
    // Votacion
    if($galery) {
        $stars = $galerias->getVar("SELECT round((((raiting_1+(raiting_2*2)
        +(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2
        +raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM 
        galeriaminoticia WHERE idgaleriaminoticia=".$galery["idgaleriaminoticia"]
        ." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
        $votos = $galerias->getVar("SELECT (raiting_1+raiting_2+raiting_3+raiting_4+
        raiting_5) AS resultado FROM galeriaminoticia WHERE idgaleriaminoticia="
        .$galery["idgaleriaminoticia"]);
    }
    if(is_float($stars)) 
        $stars = round($stars,1);
    elseif(empty($stars)) 
        $stars = 0;
        $galery["stars"]=$stars;
        $galery["votos"]=$votos;

    $comments = new comentariogaleriaTable;
    $comments->readEnv();
    $comments->order = 'creacion';
    $comments->readEnv();
    
    if($comments->request['idgaleriaminoticia']) {
        $paginador=new paginador($comments,10,(int)$_REQUEST["page"]);
        $comentarios=$paginador->getPageResult("SELECT * FROM 
        comentariogaleria WHERE estado='A' AND comentariogaleria.idgaleriaminoticia = "
        .$comments->request['idgaleriaminoticia']." ORDER BY creacion DESC");
        $smarty->assign('pg',$paginador->PAGINA);
        $smarty->assign('inicio',$paginador->INICIO);
        $smarty->assign('pgs',$paginador->TOTAL);
        $smarty->assign('comentarios',$comentarios);
        unset($comentarios);
    }
    unset($comentario);
}

if(!$smarty->is_cached('minoticia/ultimasnoticiasuser.inc.tpl', $cache_pattern)){
    include_once ('./ultimasnoticiasuser.inc.php');
    $noticia = new minoticiaTable;
    $pagina = new paginaTable;
    $portada = $noticia->readDataFilter("ubicacion <> '' AND estado = 'A'");
    $smarty->assign("enunciadogaleria",$pagina->readRecord(8));
    $smarty->assign("noticiasportada", $portada);
    $smarty->assign("gal", $galery);
    $smarty->assign("galerias", $fotos);
}
    $smarty->display($tpl, $cache_pattern . $idgaleria);

    $smarty->display('minoticia/ultimasnoticiasuser.inc.tpl', $cache_pattern . 'ultimasnoticias');
include("../classes/footer.inc.php");
