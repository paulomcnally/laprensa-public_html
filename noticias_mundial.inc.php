<?php

$noticia = new noticiaTable;
$mundialnoticias = $noticia->readDataFilter("noticia.claves ILIKE '%mundial2014%' AND noticia.estado='A' AND edicion='$idedicion'");
for($i=0;$i<count($mundialnoticias);$i++) {
    setVideo($mundialnoticias,$i);
    if(empty($mundialnoticias[$i]['video']))
      setGallery($mundialnoticias,$i);
    if(empty($mundialnoticias[$i]['video'])&&empty($mundialnoticias[$i]['fotogaleria']))
      $mundialnoticias[$i]['imgs'] = getImgs($mundialnoticias[$i]['texto']);
    $mundialnoticias[$i]['stars'] = $noticia->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM noticia WHERE idnoticia=".$mundialnoticias[$i]["idnoticia"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
    $mundialnoticias[$i]['votos'] = $mundialnoticias[$i]['raiting_1']+$mundialnoticias[$i]['raiting_2']+$mundialnoticias[$i]['raiting_3']+$mundialnoticias[$i]['raiting_4']+$mundialnoticias[$i]['raiting_5'];
    $mundialnoticias[$i]['rels'] = $noticia->readDataSql("SELECT relacionado,enlace,tipo FROM relacionado WHERE idnoticia = " . $mundialnoticias[$i]['idnoticia']);
  }
  $smarty->assign('mundialnoticias', $mundialnoticias);
?>
