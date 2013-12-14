<?php
session_start();
require '../classes/app.class.php';
require ('../classes/paginador.class.php');

define('ESPECIAL_HOME',true);
$cache_pattern = 'elecciones-2013-venezuela|portada';
$tpl = 'elecciones-venezuela-2013/home.tpl';

if (!$smarty->is_cached($tpl, $cache_pattern)){
    $edicion = new edicionTable();
    list($row) = $edicion->readDataFilter("edicion = '$idedicion' AND 1=1");
    $_SESSION['edicionactual'] = ((int)$_REQUEST['year']) . '-' . ((int)$_REQUEST['month']) . '-' . ((int)$_REQUEST['day']);;
    $smarty->assign('edicion',$row);

    $noticia = new noticiaTable();
    $paginador = new paginador($noticia,5,$_REQUEST["page"]); 
    $notas = $paginador->getPageResult("SELECT * FROM noticia WHERE noticia.idseccion = 57 ORDER BY noticia.creacion DESC");
    //$smarty->assign('notas', $rows);
    for($i=0;$i<count($notas);$i++) {
        setVideo($notas,$i);
      if(empty($notas[$i]['video']))
        setGallery($notas,$i);
      if(empty($notas[$i]['video'])&&empty($notas[$i]['fotogaleria']))
        $notas[$i]['imgs'] = getImgs($notas[$i]['texto']);
        $notas[$i]['rels'] = $noticia->readDataSql("SELECT relacionado,enlace,tipo FROM relacionado WHERE idnoticia = " . $notas[$i]['idnoticia']);
    }
    $smarty->assign('pg',$paginador->PAGINA);
    $smarty->assign('inicio',$paginador->INICIO);
    $smarty->assign('pgs',$paginador->TOTAL);
    $smarty->assign('notas',$notas);
    unset($notas);
    
    #videos
     $video = new videoTable();
     $video->limit=4;
     $video->order = "creacion DESC";
     $videos = $video->readDataFilter("video.claves ILIKE '%elecciones venezuela 2013%'");     
     $smarty->assign('clips', $videos);
     
     #resultados
     $candidato = new ppoliticoTable();
     $candidatos = $candidato->readDataFilter("ppolitico.orden >= 14");
     $smarty->assign('candidatos', $candidatos);
}

$smarty->display($tpl, $cache_pattern);
?>
