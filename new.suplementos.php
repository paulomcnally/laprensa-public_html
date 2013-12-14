<?
require('../classes/app.class.php');

$tpl = 'suplementos/index.tpl';

if($_REQUEST['idarticulo']) {
  define ('ARTICULO',true);
  include ('../classes/header.inc.php');

  include ('comentar.php');
  if(!$smarty->is_cached($tpl,$cache_pattern)) {
    require('../classes/paginador.class.php');
    # Edicion del suplemento
    $edicionsup = new edicionsuplementoTable();
    $edicionsup->readEnv();
    list($row) = $edicionsup->readDataFilter("edicionsuplemento = '$idedicion'");
    $smarty->assign('edicion',$row);
    unset($row);
    $suplementos = new suplementoTable;
    $suplementos->readEnv();
    #leer ultimos suplementos
    $listsuplementos = $suplementos->readDataSQL("SELECT suplemento,uri,ultima FROM suplemento, (SELECT idsuplemento,MAX(edicionsuplemento) AS ultima FROM edicionsuplemento GROUP BY idsuplemento) AS ultimaedicion WHERE suplemento.idsuplemento=ultimaedicion.idsuplemento AND ultima < CURRENT_DATE ORDER BY ultima DESC");
    $smarty->assign('suplementos',$listsuplementos);

    //lee informacion del suplemento
    if ($suplementos->request['uri']) {
      $infosup = $suplementos->readDataFilter("suplemento.uri='". $suplementos->request['uri'] ."'");
      $smarty->assign('infosup',$infosup[0]);
    }

    $articulos = new articuloTable;
    $articulos->readEnv();
    if ($articulos->request['idarticulo']) {
      $row = $articulos->readRecord();
      # Votacion
      $stars = $articulos->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM articulo WHERE idarticulo=".$row["idarticulo"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
      $votos = $row['raiting_1']+$row['raiting_2']+$row['raiting_3']+$row['raiting_4']+$row['raiting_5'];
      if(is_float($stars)) $stars = round($stars,1);
      elseif(empty($stars)) $stars = 0;
      $row["stars"]=$stars;
      $row["votos"]=$votos;
      # Fin_Votacion
      $smarty->assign('row', $row);
      # Comentarios
      $comments = new comentarioarticuloTable;
      $comments->readEnv();
      $comments->order = 'creacion';
      $comments->readEnv();
      $paginador=new paginador($comments,10,$_REQUEST["page"]);
      // Utiliza el readDataSql pero con LIMIT y OFFSET
      $comentarios=$paginador->getPageResult("SELECT * FROM comentarioarticulo WHERE  comentarioarticulo.estado='A' AND comentarioarticulo.idarticulo = ".$articulos->request['idarticulo']." ORDER BY creacion DESC");
      $smarty->assign('pg',$paginador->PAGINA);
      $smarty->assign('inicio',$paginador->INICIO);
      $smarty->assign('pgs',$paginador->TOTAL);
      $smarty->assign('comentarios',$comentarios);
      unset($comentarios);
      unset($comentario);
      # Fin_comentarios
      # articulos columna derecha
      $otrosart = $articulos->readDataFilter("articulo.idseccionsuplemento='". $row['idseccionsuplemento'] ."' AND edicionsuplemento='".$idedicion."'");
      $smarty->assign('otrosart', $otrosart);
      # $tpl = 'suplementos/entrada.tpl';
      $rows = $articulos->readDataSQL("SELECT articulo.idarticulo, articulo.articulo, articulo.idseccionsuplemento,edicionsuplemento.edicionsuplemento, suplemento.suplemento, seccionsuplemento.seccionsuplemento, idedicionsuplemento FROM articulo JOIN seccionsuplemento USING(idseccionsuplemento) JOIN suplemento USING(idsuplemento) JOIN edicionsuplemento USING (idedicionsuplemento) WHERE edicionsuplemento='".$idedicion."' AND suplemento.uri='". $infosup[0]['uri']."'");
      $smarty->assign('todos', $rows);
    }
  }
} elseif ($_REQUEST['uri']) {
  define ('SUPLEMENTO',true);
  include ('../classes/header.inc.php');

  if(!$smarty->is_cached($tpl,$cache_pattern)) {
    # Edicion del suplemento
    $edicionsup = new edicionsuplementoTable();
    $edicionsup->readEnv();
    list($row) = $edicionsup->readDataFilter("edicionsuplemento = '$idedicion'");
    $smarty->assign('edicion',$row);
    unset($row);
    $suplementos = new suplementoTable;
    $suplementos->readEnv();
    #leer ultimos suplementos
    $listsuplementos = $suplementos->readDataSQL("SELECT suplemento,uri,ultima FROM suplemento, (SELECT idsuplemento,MAX(edicionsuplemento) AS ultima FROM edicionsuplemento GROUP BY idsuplemento) AS ultimaedicion WHERE suplemento.idsuplemento=ultimaedicion.idsuplemento AND ultima < CURRENT_DATE ORDER BY ultima DESC");
    $smarty->assign('suplementos',$listsuplementos);
    //lee informacion del suplemento
    if ($suplementos->request['uri']) {
      $infosup = $suplementos->readDataFilter("suplemento.uri='". $suplementos->request['uri'] ."'");
      $smarty->assign('infosup',$infosup[0]);
    }

    $articulos = new articuloTable;
    $articulos->readEnv();

    # lee articulos del suplemento
    $rows = $articulos->readDataSQL("SELECT articulo.idarticulo, articulo.articulo, articulo.texto, articulo.resumen,articulo.raiting_1,articulo.raiting_2,articulo.raiting_3,articulo.raiting_4,articulo.raiting_5,articulo.idseccionsuplemento,edicionsuplemento.edicionsuplemento, suplemento.suplemento, seccionsuplemento.seccionsuplemento, idedicionsuplemento FROM articulo JOIN seccionsuplemento USING(idseccionsuplemento) JOIN suplemento USING(idsuplemento) JOIN edicionsuplemento USING (idedicionsuplemento) WHERE edicionsuplemento='".$idedicion."' AND suplemento.uri='". $infosup[0]['uri']."' AND articulo.ubicacion='D' AND estado='A'");
    for($i=0;$i<count($rows);$i++) {
      $rows[$i]['stars'] = $articulos->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM articulo WHERE idarticulo=".$rows[$i]["idarticulo"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
      $rows[$i]['votos'] = $rows[$i]['raiting_1']+$rows[$i]['raiting_2']+$rows[$i]['raiting_3']+$rows[$i]['raiting_4']+$rows[$i]['raiting_5'];
    }
    $smarty->assign('derecha', $rows);
    unset($rows);
    $rows = $articulos->readDataSQL("SELECT articulo.idarticulo, articulo.articulo, articulo.texto, articulo.resumen,articulo.raiting_1,articulo.raiting_2,articulo.raiting_3,articulo.raiting_4,articulo.raiting_5,articulo.idseccionsuplemento,edicionsuplemento.edicionsuplemento, suplemento.suplemento, seccionsuplemento.seccionsuplemento, idedicionsuplemento FROM articulo JOIN seccionsuplemento USING(idseccionsuplemento) JOIN suplemento USING(idsuplemento) JOIN edicionsuplemento USING (idedicionsuplemento) WHERE edicionsuplemento='".$idedicion."' AND suplemento.uri='". $infosup[0]['uri']."' AND articulo.ubicacion='I' AND estado='A'");
    for($i=0;$i<count($rows);$i++) {
      $rows[$i]['imgs'] = getImgs($rows[$i]['texto']);
      $rows[$i]['stars'] = $articulos->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM articulo WHERE idarticulo=".$rows[$i]["idarticulo"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
      $rows[$i]['votos'] = $rows[$i]['raiting_1']+$rows[$i]['raiting_2']+$rows[$i]['raiting_3']+$rows[$i]['raiting_4']+$rows[$i]['raiting_5'];
    }
    $smarty->assign('izquierda', $rows);
    unset($rows);
    $todos = $articulos->readDataSQL("SELECT articulo.idarticulo, articulo.articulo, articulo.idseccionsuplemento,edicionsuplemento.edicionsuplemento, suplemento.suplemento, seccionsuplemento.seccionsuplemento, idedicionsuplemento FROM articulo JOIN seccionsuplemento USING(idseccionsuplemento) JOIN suplemento USING(idsuplemento) JOIN edicionsuplemento USING (idedicionsuplemento) WHERE edicionsuplemento='".$idedicion."' AND suplemento.uri='". $infosup[0]['uri']."'");
    $smarty->assign('todos', $todos);
  }
}

$smarty->display($tpl,$cache_pattern);

include ('../classes/footer.inc.php');
?>
