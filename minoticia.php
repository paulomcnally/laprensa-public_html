<?php
define(PORTADAMN,true);
include("../classes/app.class.php");
include("../classes/header-minoticia.inc.php");

$smarty->cache_lifetime = 3600;

if(!$smarty->is_cached('minoticia/portada_noticias.tpl',$cache_pattern) || 
   !$smarty->is_cached('minoticia/right-minoticia.tpl', $cache_pattern) || 
   !$smarty->is_cached('minoticia/bl_ojociudadano.tpl',$cache_pattern)) {
       $noticia = new minoticiaTable;  
       $noticia->readEnv();
       @include_once(ROOTDIR.'/zonas/minoticia.php');
}

// Noticias de la portada

if(!$smarty->is_cached('portada_noticias.tpl', $cache_pattern)){
    // Noticias Varias - superior (JQUERY)
    $rows = $noticia->readDataFilter("minoticia.ubicacion='S' 
    AND minoticia.estado='A'");
        if(!$rows) {
            $noticia->limit = 2;
            $rows = $noticia->readDataFilter("minoticia.texto LIKE '%<img%' AND minoticia.estado='A' AND minoticia.ubicacion <> 'M' AND minoticia.ubicacion <> 'L' AND minoticia.ubicacion <> ''");
            $noticia->limit = null;
        }
    
    for($i=0;$i<count($rows);$i++) {
        videoMN($rows,$i);
        if(empty($rows[$i]['video']))
        setGallery($rows,$i);
        if(empty($rows[$i]['video']) && 
        empty($rows[$i]['fotogaleria']))
            $rows[$i]['imgs'] = getImgs($rows[$i]['texto']);
            $in_left[] = $rows[$i]['idminoticia'];
            $rows[$i]['stars'] = $noticia->getVar("SELECT 
            round((((raiting_1+(raiting_2*2)+(raiting_3*3)+
            (raiting_4*4)+(raiting_5*5))::float)/(raiting_1+
            raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) 
            AS resultado FROM minoticia WHERE idminoticia=".$rows[$i]["idminoticia"].
            " AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 
            OR raiting_5<>0);");
            $rows[$i]['votos'] = $rows[$i]['raiting_1']+$rows[$i]['raiting_2']+
            $rows[$i]['raiting_3']+$rows[$i]['raiting_4']+$rows[$i]['raiting_5'];
    }
    $smarty->assign('izquierda',$rows);
    unset($rows);
      
    // Noticias barra izquierda
    $noticia->readEnv();
    $filas = $noticia->readDataFilter("minoticia.ubicacion = 'L' 
    AND minoticia.estado = 'A'");

    for($i=0;$i<count($filas);$i++) {
        videoMN($filas,$i);
        if(empty($filas[$i]['video']))
            $filas[$i]['imgs'] = getImgs($filas[$i]['texto']);
            $in_right[] = $filas[$i]['idminoticia'];
            $filas[$i]['stars'] = $noticia->getVar("SELECT 
            round((((raiting_1+(raiting_2*2)+(raiting_3*3)
            +(raiting_4*4)+(raiting_5*5))::float)/(raiting_1
            +raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) 
            AS resultado FROM minoticia WHERE idminoticia=".$filas[$i]["idminoticia"]
            ." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 
            OR raiting_4<>0 OR raiting_5<>0);");
            $filas[$i]['votos'] = $filas[$i]['raiting_1']+$filas[$i]['raiting_2']
            +$filas[$i]['raiting_3']+$filas[$i]['raiting_4']+$filas[$i]['raiting_5'];
    }
    $smarty->assign('news_izq',$filas);
    unset($filas);

    // Noticias de la mitad
    $filas = $noticia->readDataFilter("minoticia.ubicacion = 'M' AND minoticia.estado='A'");
    for($i=0;$i<count($filas);$i++) {
        videoMN($filas,$i);
        if(empty($filas[$i]['video']))
            $filas[$i]['imgs'] = getImgs($filas[$i]['texto']);
            $filas[$i]['stars'] = $noticia->getVar("SELECT 
            round((((raiting_1+(raiting_2*2)+(raiting_3*3)+
            (raiting_4*4)+(raiting_5*5))::float)/(raiting_1+
            raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) 
            AS resultado FROM minoticia WHERE idminoticia=".$filas[$i]["idminoticia"]
            ." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 
            OR raiting_4<>0 OR raiting_5<>0);");
            $filas[$i]['votos'] = $filas[$i]['raiting_1']+
            $filas[$i]['raiting_2']+$filas[$i]['raiting_3']+
            $filas[$i]['raiting_4']+$filas[$i]['raiting_5'];
    }
    $smarty->assign('noticiasmitad',$filas);
    unset($filas);
   
    // Mas Noticias
    $masnoticias = $noticia->readDataFilter("minoticia.ubicacion IS NULL 
    AND minoticia.estado='A'");
    for($i=0; $i<count($masnoticias); $i++){
        setVideo($masnoticias,$i);
        if(empty($masnoticias[$i]['video']))
            $masnoticias[$i]['imgs'] = getImgs($masnoticias[$i]['texto']);
            $masnoticias[$i]['stars'] = $noticia->getVar("SELECT 
            round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+
            (raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4
            +raiting_5))::numeric,1) AS resultado FROM minoticia WHERE 
            minoticia.idminoticia=".$masnoticias[$i]["idminoticia"]." 
            AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 
            OR raiting_4<>0 OR raiting_5<>0);");
            $masnoticias[$i]['votos'] = $masnoticias[$i]['raiting_1']
            +$masnoticias[$i]['raiting_2']+$masnoticias[$i]['raiting_3']
            +$masnoticias[$i]['raiting_4']+$masnoticias[$i]['raiting_5'];
   }
   $smarty->assign('masnoticias',$masnoticias);
   unset($masnoticias);

  // Mas comentadas
    $comentadas = $noticia->readDataSql("SELECT count(idcomentariominoticia)
    AS comentarios,idminoticia, minoticia.minoticia FROM comentariominoticia
    JOIN minoticia USING(idminoticia) WHERE comentariominoticia.estado = 'A' 
    GROUP BY comentariominoticia.idminoticia, minoticia.minoticia 
    ORDER BY comentarios DESC LIMIT 10");
    $smarty->assign('mascomentadas', $comentadas); 
}
 
if(!$smarty->get_template_vars('sidebar_300_250') ||
   !$smarty->get_template_vars('banner_inferior_728_90')){
    @include_once(ROOTDIR.'/zonas/minoticia.php');
}
      
$smarty->display('minoticia/portada_noticias.tpl', $cache_pattern);
        
// sidebar
$pagina = new paginaTable;
$ojo = new ojociudadanoTable;
$ojo->order="creacion DESC";
$video = new videominoticiaTable;
$smarty->cache_lifetime = 3600;
 
if(!$smarty->is_cached('right-minoticia.tpl',$cache_pattern)){
    $galeria = new galeriaminoticiaTable;
    $coleccion = new galeriafotominoticiaTable;
    $coleccion->readEnv();
    $galerias = $galeria->readData();
    $fotos = array();

    for($i=0; $i<count($galerias); $i++){
        list($fotos[$i]['fotogaleria']) = $coleccion->readDataFilter("galeriafotominoticia.idgaleriaminoticia = "
        . $galerias[$i]['idgaleriaminoticia'] . " AND galeriaminoticia.estado = 'A'");
    } 
   
    $smarty->assign("galeria", $fotos);
    
    $rows = $ojo->readDataFilter("estado = 'A'");
    for($i=0;$i<count($rows);$i++) {
        $rows[$i]['imgs'] = getImgs($rows[$i]['texto']);
    }
    
    //$videos = $video->readDataFilter("videominoticia.estado = 'A'"); 
    $videos = $video->readDataSql("SELECT coleccionvideo.texto,coleccionvideo.idcoleccionvideo,videominoticia.archivovideo,videominoticia.idvideominoticia,videominoticia.videominoticia FROM coleccionvideo,galeriavideo, videominoticia WHERE galeriavideo.idgaleriavideo = coleccionvideo.idgaleriavideo AND videominoticia.idvideominoticia = coleccionvideo.idvideominoticia AND galeriavideo.idgaleriavideo = coleccionvideo.idgaleriavideo AND galeriavideo.activa IS TRUE"); 
    $smarty->assign("vids", $videos);
    $smarty->assign("ojociudadano", $rows);
    $smarty->assign("mostrar_torre", 1);
    $smarty->assign("enunciadogaleria",$pagina->readRecord(8)); 
}
    
$smarty->display('minoticia/right-minoticia.tpl', $cache_pattern);
include_once("../classes/footer.inc.php");
?>