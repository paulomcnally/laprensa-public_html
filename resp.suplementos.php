<?
require('../classes/app.class.php');
require('../classes/paginador.class.php');
require_once "XML/RSS.php";
include ('comentar.php');

include ('../classes/header.suplemento.inc.php');
$articulos = new articuloTable;
$articulos->readEnv();
$smarty->caching=0;
    #$idedicion = ((int)$_REQUEST['year'])."-".($_REQUEST['month'])."-".($_REQUEST['day']);
    $edicionsup = new edicionsuplementoTable;
    $edicionsup->readEnv();
    $suplemento = new suplementoTable;
    $suplemento->readEnv();
    if ($articulos->request['idarticulo']) {
      $row = $articulos->readRecord();
      #Votacion
        $stars = $articulos->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM articulo WHERE idarticulo=".$row["idarticulo"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
        $votos = $artculos->getVar("SELECT (raiting_1+raiting_2+raiting_3+raiting_4+raiting_5) AS resultado FROM noticia WHERE idnoticia=".$row["idarticulo"]);
        if(is_float($stars)) $stars = round($stars,1);
        elseif(empty($stars)) $stars = 0;
        $row["stars"]=$stars;
        $row["votos"]=$votos;
      #Fin_Votacion
      $smarty->assign('row', $row);
      $otrosart = $articulos->readDataFilter("articulo.idseccionsuplemento='". $row['idseccionsuplemento'] ."' AND edicionsuplemento='".$idedicion."'");
      $smarty->assign('otrosart', $otrosart);
      $tpl = 'suplementos/entrada.tpl';
      $rows = $articulos->readDataSQL("SELECT articulo.idarticulo, articulo.articulo, articulo.idseccionsuplemento,edicionsuplemento.edicionsuplemento, suplemento.suplemento, seccionsuplemento.seccionsuplemento, idedicionsuplemento FROM articulo JOIN seccionsuplemento USING(idseccionsuplemento) JOIN suplemento USING(idsuplemento) JOIN edicionsuplemento USING (idedicionsuplemento) WHERE edicionsuplemento='".$idedicion."' AND suplemento.uri='". $infosup[0]['uri']."'");
      $smarty->assign('todos', $rows);
    } elseif ($suplemento->request['uri']) {
      #lee articulos del suplemento
      $rows = $articulos->readDataSQL("SELECT articulo.idarticulo, articulo.articulo, articulo.texto, articulo.resumen,articulo.idseccionsuplemento,edicionsuplemento.edicionsuplemento, suplemento.suplemento, seccionsuplemento.seccionsuplemento, idedicionsuplemento FROM articulo JOIN seccionsuplemento USING(idseccionsuplemento) JOIN suplemento USING(idsuplemento) JOIN edicionsuplemento USING (idedicionsuplemento) WHERE edicionsuplemento='".$idedicion."' AND suplemento.uri='". $infosup[0]['uri']."' AND articulo.ubicacion='D'");
      $smarty->assign('derecha', $rows);
      unset($rows);
      $rows = $articulos->readDataSQL("SELECT articulo.idarticulo, articulo.articulo, articulo.texto, articulo.resumen,articulo.idseccionsuplemento,edicionsuplemento.edicionsuplemento, suplemento.suplemento, seccionsuplemento.seccionsuplemento, idedicionsuplemento FROM articulo JOIN seccionsuplemento USING(idseccionsuplemento) JOIN suplemento USING(idsuplemento) JOIN edicionsuplemento USING (idedicionsuplemento) WHERE edicionsuplemento='".$idedicion."' AND suplemento.uri='". $infosup[0]['uri']."' AND articulo.ubicacion='I'");
      for($i=0;$i<count($rows);$i++)
        $rows[$i]['imgs'] = getImgs($rows[$i]['texto']);
      $smarty->assign('izquierda', $rows);
      unset($rows);
      $todos = $articulos->readDataSQL("SELECT articulo.idarticulo, articulo.articulo, articulo.idseccionsuplemento,edicionsuplemento.edicionsuplemento, suplemento.suplemento, seccionsuplemento.seccionsuplemento, idedicionsuplemento FROM articulo JOIN seccionsuplemento USING(idseccionsuplemento) JOIN suplemento USING(idsuplemento) JOIN edicionsuplemento USING (idedicionsuplemento) WHERE edicionsuplemento='".$idedicion."' AND suplemento.uri='". $infosup[0]['uri']."'");
      $smarty->assign('todos', $todos);
      #informacion de la edicion
      $infoed = $edicionsup->readDataFilter("edicionsuplemento='".$idedicion."'");
      $smarty->assign('edicion',$infoed[0]);
      $tpl = 'suplementos/index.tpl';
      #$smarty->assign('secciones')
    }
$smarty->display($tpl);
include ('../classes/footer.suplemento.inc.php');
?>
