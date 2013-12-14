<?php
#include ('redireccion.php');
include ('../classes/app.class.php');

$is_mobile = is_mobile();

# fecha superior al dia de hoy?
/*if ( (strtotime($idedicion) > strtotime(date($latestedition))) && ($_SERVER['HTTP_X_FORWARDED_FOR'] != '190.212.136.182') ) {
  $nexturl = preg_replace('/-/', '/', $latestedition);
  error_log("FIXME: Latest edition: $latestedition < $idedicion Location: /$nexturl");
  header("Location: /$nexturl");
}*/

# Encabezado
define(PORTADA,true);
include ('../classes/header.inc.php');

# Instanciando Noticias si es necesario
if(!$smarty->is_cached('portada_destacado.tpl',$cache_pattern) || !$smarty->is_cached('portada_opinion_videos.tpl',$cache_pattern) || !$smarty->is_cached('portada_poradentro.tpl',$cache_pattern) || !$smarty->is_cached('portada_economia.tpl',$cache_pattern)) {
  $noticia = new noticiaTable;
  $noticia->order = 'ultimahora ASC, hora DESC, orden DESC,creacion DESC';
  $noticia->readEnv();
  @include_once(ROOTDIR.'/zonas/portada.php');
}

$today = date("m-d");
$cyear = date("Y");

if ( strtotime($idedicion) < strtotime(date("Y-m-d")) ) {
  $smarty->cache_lifetime = 7 * 24 * 60 * 60;	# 7 días
} else {
  # 1er Parte - Destacados - 10 mins
  $smarty->cache_lifetime = 600;	# 10 mins
}
if(!$smarty->is_cached('portada_destacado.tpl',$cache_pattern)) {
  $order = $noticia->order;
  $noticia->order = 'orden DESC, creacion DESC';
  $noticia->limit = 1;
//  if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//    list($amplia) = $noticia->readDataFilter("noticia.idseccion NOT IN (10) AND noticia.ubicacion IN ('2','2R','2W') AND noticia.estado='A' AND edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."'");
//  else 
    list($amplia) = $noticia->readDataFilter("noticia.idseccion NOT IN (10) AND noticia.ubicacion IN ('2','2R','2W') AND noticia.estado='A' AND edicion='$idedicion'");
  if($amplia) {
    $amplia['imgs'] = getImgs($amplia['texto']);
    $amplia['rels'] = $noticia->readDataSql("SELECT relacionado,enlace,tipo FROM relacionado WHERE idnoticia = " . $amplia['idnoticia']);
  }
  $smarty->assign('amplia',$amplia);
  $smarty->assign('is_mobile',$is_mobile);
  $noticia->limit = null;
  # Noticias Varias - Columna Izquierda - adding != 51 (elecciones) - javier
  $in_left = array();
//  if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//    $rows = $noticia->readDataFilter("noticia.idseccion NOT IN (10,51,56) AND noticia.ubicacion='I' AND noticia.estado='A' AND edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."'");
//  else
    $rows = $noticia->readDataFilter("noticia.idseccion NOT IN (10,51,56) AND noticia.ubicacion='I' AND noticia.estado='A' AND edicion='$idedicion'");
  if(!$rows) {
    $noticia->limit = 5;
//    if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//      $rows = $noticia->readDataFilter("noticia.idseccion NOT IN (10) AND noticia.texto LIKE '%<img%' AND noticia.estado='A' AND edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."' AND noticia.idseccion NOT IN (10) AND noticia.ubicacion NOT IN ('D','R')");
//    else
      $rows = $noticia->readDataFilter("noticia.idseccion NOT IN (10,56) AND noticia.texto LIKE '%<img%' AND noticia.estado='A' AND edicion='$idedicion' AND noticia.idseccion NOT IN (10,56) AND noticia.ubicacion NOT IN ('D','R')");
    $noticia->limit = null;
  }
  for($i=0;$i<count($rows);$i++) {
    setVideo($rows,$i);
    if(empty($rows[$i]['video']))
      setGallery($rows,$i);
    if(empty($rows[$i]['video'])&&empty($rows[$i]['fotogaleria']))
      $rows[$i]['imgs'] = getImgs($rows[$i]['texto']);
    $in_left[] = $rows[$i]['idnoticia'];
    $rows[$i]['stars'] = $noticia->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM noticia WHERE idnoticia=".$rows[$i]["idnoticia"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
    $rows[$i]['votos'] = $rows[$i]['raiting_1']+$rows[$i]['raiting_2']+$rows[$i]['raiting_3']+$rows[$i]['raiting_4']+$rows[$i]['raiting_5'];
    $rows[$i]['rels'] = $noticia->readDataSql("SELECT relacionado,enlace,tipo FROM relacionado WHERE idnoticia = " . $rows[$i]['idnoticia']);
  }
  //if ( $_SERVER['REMOTE_ADDR'] == '165.98.184.18' || $_SERVER['REMOTE_ADDR'] == '190.184.22.23' )
  //  print_r($rows);
  $smarty->assign('izquierda',$rows);
  unset($rows);
  # Noticias Varias - Columna Derecha
  $noticia->limit = null;
//  if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//    $rows = $noticia->readDataFilter("noticia.idseccion NOT IN (10,56) AND noticia.ubicacion='D' AND noticia.estado='A' AND edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."'");
//  else
    $rows = $noticia->readDataFilter("noticia.idseccion NOT IN (10,56) AND noticia.ubicacion='D' AND noticia.estado='A' AND edicion='$idedicion'");
  if(empty($rows)) {
//    if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//      $rows = $noticia->readDataFilter("noticia.texto LIKE '%<img%' AND edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."' AND noticia.estado='A'" . (!empty($in_left)?" AND noticia.idnoticia NOT IN (" . implode(',',$in_left) . ")":"") . " AND noticia.idseccion NOT IN (10,56) AND noticia.ubicacion NOT IN ('I','R')");
//    else
      $rows = $noticia->readDataFilter("noticia.texto LIKE '%<img%' AND edicion='$idedicion' AND noticia.estado='A'" . (!empty($in_left)?" AND noticia.idnoticia NOT IN (" . implode(',',$in_left) . ")":"") . " AND noticia.idseccion NOT IN (10,56) AND noticia.ubicacion NOT IN ('I','R')");
    $noticia->limit = null;
  }
  for($i=0;$i<count($rows);$i++) {
    setVideo($rows,$i);
    if(empty($rows[$i]['video']))
      setGallery($rows,$i);
    if(empty($rows[$i]['video'])&&empty($rows[$i]['fotogaleria']))
      $rows[$i]['imgs'] = getImgs($rows[$i]['texto']);
    $in_right[] = $rows[$i]['idnoticia'];
    $rows[$i]['stars'] = $noticia->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM noticia WHERE idnoticia=".$rows[$i]["idnoticia"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
    $rows[$i]['votos'] = $rows[$i]['raiting_1']+$rows[$i]['raiting_2']+$rows[$i]['raiting_3']+$rows[$i]['raiting_4']+$rows[$i]['raiting_5'];
    $rows[$i]['rels'] = $noticia->readDataSql("SELECT relacionado,enlace,tipo FROM relacionado WHERE idnoticia = " . $rows[$i]['idnoticia']);
  }
  $smarty->assign('cuentanotas',round((count($rows)/2)+1));
  $smarty->assign('derecha',$rows);
  unset($rows);
  
  # cajita - Columna Superior-Derecha Slide
//  if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//      if ( strtotime($idedicion) <= strtotime("2011-12-14") ) {
//          $rows = $noticia->readDataFilter("noticia.ubicacion = 'R' AND edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."' AND noticia.estado='A'");
//      } else {
//          $rows = $noticia->readDataFilter("noticia.idseccion = 52 AND edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."' AND noticia.estado='A'");
//      }
//  else
    if ( strtotime($idedicion) <= strtotime("2011-12-14") ) {
       $rows = $noticia->readDataFilter("noticia.ubicacion = 'R' AND edicion='$idedicion' AND noticia.estado='A'");
       $departamentales = false;
    } else {
       $rows = $noticia->readDataFilter("noticia.idseccion = 52 AND edicion = '$idedicion' AND noticia.estado='A'");
       $departamentales = true;
    }
  for($i=0;$i<count($rows);$i++) {
    setVideo($rows,$i);
    if(empty($rows[$i]['video']))
      setGallery($rows,$i);
    if(empty($rows[$i]['video'])&&empty($rows[$i]['fotogaleria']))
      $rows[$i]['imgs'] = getImgs($rows[$i]['texto']);
    $rows[$i]['stars'] = $noticia->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM noticia WHERE idnoticia=".$rows[$i]["idnoticia"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
    $rows[$i]['votos'] = $rows[$i]['raiting_1']+$rows[$i]['raiting_2']+$rows[$i]['raiting_3']+$rows[$i]['raiting_4']+$rows[$i]['raiting_5'];
    $rows[$i]['rels'] = $noticia->readDataSql("SELECT relacionado,enlace,tipo FROM relacionado WHERE idnoticia = " . $rows[$i]['idnoticia']);
  }
  $smarty->assign('departamentales', $departamentales);
  $smarty->assign('cajita',$rows);
  unset($rows);
 
  #para elecciones - candidatos biogragia - maribel
  $ppolitico = new ppoliticoTable;
  $ppolitico->readEnv();
  $ppolitico->order = "orden";
  $smarty->assign('candidatos',$ppolitico->readData());

  # tweet livestream

  $pagina = new paginaTable;
  $smarty->assign('tweet', $pagina->readRecord(10));

  # bambuser

  $smarty->assign('bamb',$pagina->readRecord(12));
  $smarty->assign('bambImg', $pagina->readRecord(15));

  # Notas minoticia
  
  $minoticia = new minoticiaTable;
  $enportadamn = $minoticia->readDataFilter("enportada IS TRUE AND estado = 'A'");
  for($i=0; $i<count($enportadamn); $i++){
      videoMN($enportadamn, $i);
      if(empty($enportadamn[$i]['video'])){
          $enportadamn[$i]['imgs'] = getImgs($enportadamn[$i]['texto']); 
      }
  }
  $smarty->assign("notas", $enportadamn); 

  $ojociudadano = new ojociudadanoTable;
  $ocd = $ojociudadano->readDataFilter("enportada IS TRUE AND estado = 'A'"); 
  for($o=0; $o<count($ocd);$o++){
      videoMN($ocd, $o);
      if(empty($ocd[$o]['video'])){
          $ocd[$o]['imgs'] = getImgs($ocd[$o]['texto']);
      }
  }  
  $smarty->assign("notas2", $ocd);
  
 
  # Especiales
  $notas = new notaTable();
  $notas->readEnv();
  $notas->order = 'idespecial DESC, orden DESC';
  $rows = $notas->readDataFilter("'$idedicion' BETWEEN desde::date AND hasta::date AND estado='A'");
  #$rows = $notas->readDataFilter("especial.desde >= '$idedicion' AND especial.hasta <= '$idedicion' AND especial.estado='A'");
  $smarty->assign('especiales',$rows);
  unset($rows);

  # Edicion
  if(!isset($edicion))  {
    $edicion = new edicionTable();
//    if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//      list($row) = $edicion->readDataFilter("edicion = '".$holidays[$today][2]."' AND estado = 'A'");
 //   else
      list($row) = $edicion->readDataFilter("edicion = '$idedicion' AND estado = 'A'");
    $smarty->assign('edicion',$row);
  }
  if(!$smarty->get_template_vars('banner_derecho_160_200'))  {
    @include_once(ROOTDIR.'/zonas/portada.php');
  }

  # Encuesta
  include_once ('./encuesta.inc.php');
  # Marcadores
  include_once ('./marcador.inc.php');
  # Blogs
  include_once ('./blogs.inc.php');
  # Tags
  include_once ('./tags.inc.php');
  # Domingo
  include_once ('./domingo.inc.php');
  //lee ultima edicion de suplemento
  $articulos = new edicionsuplementoTable();
  $rows = $articulos->readDataFilter("edicionsuplemento='$idedicion'");
  $smarty->assign('suplemento',$rows[0]);
  unset($rows);

  // suplemento comercial
  $supcomercial = new suplementocomercialTable();
  $rows = $supcomercial->readDataFilter("'$idedicion' BETWEEN fechainicio::date AND fechafin::date");
  $smarty->assign('supcomercial', $rows[0]);
  unset($rows);

  // suplemento animado

  $splm = new paginaTable();
  $smarty->assign("visibleanimado", $splm->readRecord(11));
  $smarty->assign('nota_elecciones',$splm->readRecord(16));
  $smarty->assign('subnota_elecciones',$splm->readRecord(17));

  # Noticias Más leidas
//  if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//    $masleida = $noticia->readDataSql("SELECT noticia.idnoticia, edicion, noticia, uri FROM noticia LEFT JOIN seccion USING(idseccion) LEFT JOIN edicion USING(idedicion) LEFT JOIN rating USING (idnoticia) WHERE idedicion IN (SELECT idedicion FROM edicion WHERE edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."' ORDER BY idedicion LIMIT 1) AND (leido IS NOT NULL OR leido <> 0) ORDER BY leido DESC LIMIT 10");
//  else
    $masleida = $noticia->readDataSql("SELECT noticia.idnoticia, edicion, noticia, uri FROM noticia LEFT JOIN seccion USING(idseccion) LEFT JOIN edicion USING(idedicion) LEFT JOIN rating USING (idnoticia) WHERE idedicion = (SELECT idedicion FROM edicion WHERE edicion = '$idedicion' ORDER BY idedicion LIMIT 1) AND (leido IS NOT NULL OR leido <> 0) ORDER BY leido DESC LIMIT 10");
  $smarty->assign('masleida',$masleida);
  unset($masleida);
  $noticia->order = $orden;
  # Videos, TV
  $noticia->order = 'creacion DESC';
  $noticia->limit = 9;
  //$rows = $noticia->readDataFilter("noticia.idedicion IN (SELECT idedicion FROM edicion WHERE edicion = '".$idedicion . "') AND noticia.idseccion = 19 AND noticia.estado = 'A'");
  $rows = $noticia->readDataFilter("noticia.idedicion IN (SELECT idedicion FROM edicion WHERE edicion <= '".$idedicion . "') AND noticia.idseccion = 19 AND noticia.estado = 'A'");
  #$rows = $noticia->readDataFilter("noticia.idseccion = 19 AND noticia.estado = 'A'");
  for($i=0;$i<count($rows);$i++) {
    if(preg_match('/youtube\.com\/v\/([\w\-]+)/', $rows[$i]['texto'], $matches)) {
    #if(preg_match('/youtube\.com\/v\/([^&]+)/ie', $rows[$i]['texto'], $matches)) {
    #if(preg_match('/youtube\.com\/v\/(.*)"/', $rows[$i]['texto'], $matches)) {
      $rows[$i]['preview'] = $matches[1];
    } elseif(preg_match('/' . str_replace('/',"\/",CLIPSURL) . '\/(.*)\'/', $rows[$i]['texto'], $matches)) {
      $rows[$i]['flowplayer'] = true;
      $rows[$i]['preview'] = $matches[1];
    } elseif(preg_match('/' . preg_quote(CLIPSURL,'/') . '\/(.*)\)(.*)?href=\"' . preg_quote(CLIPSURL,'/') . '\/(.*)\"\>/', $rows[$i]['texto'], $matches)) {
      $rows[$i]['flowplayer'] = true;
      $rows[$i]['preview'] = $matches[1];
      $rows[$i]['clip'] = $matches[3];
      $rows[$i]['cdn'] = $noticia->getVar("SELECT cdn FROM video WHERE archivo = '" . $noticia->database->escape($matches[3]) . "'");
    //  if($_SERVER['REMOTE_ADDR']=='165.98.184.18'||$_SERVER['REMOTE_ADDR']=='190.184.22.23')
    //    print_r($matches);
    } elseif(preg_match('/<object(.*)?>(.*)?<\/object>/is',$rows[$i]['texto'],$matches)) {
      $rows[$i]['embed'] = $matches[0];
      $rows[$i]['embed'] = preg_replace('/width\=\"([0-9]+)\"/is','width="250"',$rows[$i]['embed']);
      $rows[$i]['embed'] = preg_replace('/height\=\"([0-9]+)\"/is','height="180"',$rows[$i]['embed']);
    } elseif(preg_match('/<iframe (.*)*><\/iframe>/is',$rows[$i]['texto'],$matches)) {
      $rows[$i]['iframe'] = $matches[0];
      $rows[$i]['iframe'] = preg_replace('/width\=\"([0-9]+)\"/is','width="250"',$rows[$i]['iframe']);
      $rows[$i]['iframe'] = preg_replace('/width\=([0-9]+)/is','width=250',$rows[$i]['iframe']);
      $rows[$i]['iframe'] = preg_replace('/height\=\"([0-9]+)\"/is','height="141"',$rows[$i]['iframe']);
      $rows[$i]['iframe'] = preg_replace('/height\=([0-9]+)/is','height=141',$rows[$i]['iframe']);
      $rows[$i]['iframe'] = preg_replace('/>/',' frameborder="0" scrolling="no">',$rows[$i]['iframe']);
    }

    $rows[$i]['stars'] = $noticia->getVar("SELECT round((((raiting_1+(raiting_2*2)+(raiting_3*3)+(raiting_4*4)+(raiting_5*5))::float)/(raiting_1+raiting_2+raiting_3+raiting_4+raiting_5))::numeric,1) AS resultado FROM noticia WHERE idnoticia=".$rows[$i]["idnoticia"]." AND (raiting_1<>0 OR raiting_2<>0 OR raiting_3<>0 OR raiting_4<>0 OR raiting_5<>0);");
  }
  $smarty->assign('videos',$rows);
  unset($rows);
  
  # Noticias Electorales  
  # $notielectoral = new noticiaTable();
  $save = $noticia->limit;
  $noticia->limit = 4;
  $noticiaelectoral = $noticia->readDataFilter("noticia.estado = 'A' AND noticia.idseccion=51 AND ultimahora");
  $noticia->limit = $save;
  for($i=0;$i<count($noticiaelectoral);$i++)
    $noticiaelectoral[$i]['imgs'] = getImgs($noticiaelectoral[$i]['texto']);
  $smarty->assign("noticiaelectoral", $noticiaelectoral); 
 
  require_once('mapa.php'); 

  # Galeria de Portada - Elecciones - Temporal - por javier
  $fotos5 = $noticia->readDataSql("SELECT imagen,galeria,credito,coleccion.creacion AS edicion, coleccion.texto FROM coleccion JOIN galeria USING (idgaleria) JOIN imagen USING (idimagen) WHERE idgaleria = '386' ORDER BY coleccion.creacion DESC;");
  $smarty->assign('fotos5', $fotos5);

}
$smarty->display('portada_destacado.tpl',$cache_pattern);
# End 1er Parte

# 2da Parte - Noticias de Negocios y economía
if ( strtotime($idedicion) < strtotime(date("Y-m-d")) ) {
  $smarty->cache_lifetime = 7 * 24 * 60 * 60;	# 1 día
} else {
$smarty->cache_lifetime = 10800;	# 3 hrs, 180 mins, 10800
}
if(!$smarty->is_cached('portada_economia.tpl',$cache_pattern)) {
  $order = $noticia->order;
  $noticia->order = 'orden DESC, creacion DESC';
  $noticia->order = 'orden DESC';

  if (strtotime($idedicion) >= strtotime('2011-08-21')) {
    $id_econ = 32;
  } else {
    $id_econ = 8;
  }

//  if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//    $negocios_1 = $noticia->readDataFilter("noticia.idseccion=$id_econ AND (noticia.ultimahora <> 't' OR noticia.ultimahora IS NULL) AND noticia.estado='A' AND edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."' AND noticia.texto LIKE '%<img%'");
//  else
    $negocios_1 = $noticia->readDataFilter("noticia.idseccion=$id_econ AND (noticia.ultimahora <> 't' OR noticia.ultimahora IS NULL) AND noticia.estado='A' AND edicion='$idedicion' AND noticia.texto LIKE '%<img%'");
//  if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//    $negocios_2 = $noticia->readDataFilter("noticia.idseccion=$id_econ AND (noticia.ultimahora <> 't' OR noticia.ultimahora IS NULL) AND noticia.estado='A' AND edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."' AND noticia.texto NOT LIKE '%<img%'");
//  else
    $negocios_2 = $noticia->readDataFilter("noticia.idseccion=$id_econ AND (noticia.ultimahora <> 't' OR noticia.ultimahora IS NULL) AND noticia.estado='A' AND edicion='$idedicion' AND noticia.texto NOT LIKE '%<img%'");
  if($negocios_1&&$negocios_2)
    $negocios = array_merge($negocios_1,$negocios_2);
  elseif($negocios_1)
    $negocios = &$negocios_1;
  else $negocios = &$negocios_2;
  for($j=0;$j<count($negocios);$j++){
    setVideo($negocios,$j);
    if(empty($negocios[$j]['video'])){
        $negocios[$j]['imgs'] = getImgs($negocios[$j]['texto']);
    }
  }
  if (is_array($negocios))
    list($negocios1, $negocios2) = array_chunk($negocios, 2);
  $smarty->assign('negocios',$negocios);
  $smarty->assign('negocios1',$negocios1);
  $smarty->assign('negocios2',$negocios2);

  # Cambio oficial para nicaragua
  $dolares = new dolarTable();
  $cambio = $dolares->readDataFilter("dolar.iddolar='$idedicion'");
  $smarty->assign('cambio',$cambio[0]);

  # Cambio oficial en C.A
  $dolaresca = new dolarpaisTable;
  $cambioca = $dolaresca->readDataFilter("edicion='$idedicion'");
  $smarty->assign('cambioca',$cambioca);
  $noticia->order = $orden;
   
  # Productos
  $producto = new productoTable();
  $productos = $producto->readDataFilter("idproducto IN (SELECT DISTINCT idproducto FROM comportamiento)");
  //$productos = $producto->readData();
  $items = 0;
  for($i=0;$i<count($productos);$i++) {
    $productos[$i]['comportamiento'] = $producto->readDataSql("SELECT comportamiento,fecha FROM comportamiento WHERE idproducto = " . $productos[$i]['idproducto'] . " ORDER BY fecha DESC LIMIT 3;");
    if ( count($productos[$i]['comportamiento']) > 1 ) $items++;
    $productos[$i]['ultimo'] = $producto->getVar("SELECT fecha FROM comportamiento WHERE idproducto = " . $productos[$i]['idproducto'] . " ORDER BY fecha DESC LIMIT 1");
    $productos[$i]['precio'] = $producto->getVar("SELECT comportamiento FROM comportamiento WHERE idproducto = " . $productos[$i]['idproducto'] . " ORDER BY fecha DESC LIMIT 1");
    $productos[$i]['prev'] = $producto->getVar("SELECT comportamiento FROM comportamiento WHERE idproducto = " . $productos[$i]['idproducto'] . " AND idcomportamiento <> (SELECT idcomportamiento FROM comportamiento WHERE idproducto = " . $productos[$i]['idproducto'] . " ORDER BY fecha DESC LIMIT 1) ORDER BY fecha DESC LIMIT 1");
  }
  $smarty->assign('items',$items);
  $smarty->assign('productos',$productos);
}
$smarty->display('portada_economia.tpl',$cache_pattern);
# End 2da Parte

# 3ra Parte - Por adentro
if ( strtotime($idedicion) < strtotime(date("Y-m-d")) ) {
  $smarty->cache_lifetime = 7 * 24 * 60 * 60;	# 1 día
} else {
$smarty->cache_lifetime = 10800;        # 3 hrs, 180 mins
}
if(!$smarty->is_cached('portada_poradentro.tpl',$cache_pattern)) {
  $poradentropt = new poradentroTable();
  $poradentropt->order = 'idporadentro DESC';
  $poradentro = $poradentropt->readDataFilter("estado='A'");
  $smarty->assign('poradentro',$poradentro);
}
$smarty->display('portada_poradentro.tpl',$cache_pattern);
# End 3ra Parte

# 4ta Parte - Columna del Día, Caricatura
if ( strtotime($idedicion) < strtotime(date("Y-m-d")) ) {
  $smarty->cache_lifetime = 7 * 24 * 60 * 60;	# 1 día
} else {
$smarty->cache_lifetime = 3600;		# 1 hr, 60 mins
}
if(!$smarty->is_cached('portada_opinion_videos.tpl',$cache_pattern)) {
  # Caricatura(s) del dia
  $noticia->order = 'idseccion';
  $caricaturas = new caricaturaTable;
  $caricaturas->order = 'edicion DESC, orden';
  $pdia=date("Y-m-d",strtotime ("last ".date("l").""));
  //$caricatura = $caricaturas->readDataFilter("edicion='$idedicion'");
  $caricatura = $caricaturas->readDataFilter("estado = 'A' AND caricatura.creacion::date BETWEEN '$pdia' AND '".date("Y-m-d")."'");
  $smarty->assign('caricaturas',$caricatura);
  # Mas noticias - RSS - Secciones
  # Nacionales,Politica,Revista,Internacionales,Sucesos,Deportes,Departamentos,Opinion
  if ($cambio) {
     $secciones = array(27,28,29,30,31,32,33,34);
  } else {
     $secciones = array(1,2,3,5,6,7,9,10);
  }
  $masnoticias = array();
  for($i=0;$i<count($secciones);$i++) {
    $masnoticias[$i]['seccion'] = $noticia->readDataSQL("SELECT seccion,uri FROM seccion WHERE idseccion = " . $secciones[$i]);
//    if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//      $masnoticias[$i]['noticias'] = $noticia->readDataFilter("noticia.ubicacion IS NULL AND edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."' AND noticia.estado='A' AND noticia.idseccion = " . $secciones[$i]);
//    else
      $masnoticias[$i]['noticias'] = $noticia->readDataFilter("noticia.ubicacion IS NULL AND edicion='$idedicion' AND noticia.estado='A' AND noticia.idseccion = " . $secciones[$i]);
  }
  $smarty->assign('masnoticias',$masnoticias);
  
  // Filtro para mostrar los las ultimas ediciones de los suplementos
  // Nosotras, Aqui entre nos, Literaria

  #Columna del dia
//  if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//    $columnadia = $noticia->readDataFilter("noticia.ubicacion='C' AND edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."' AND noticia.estado = 'A'");
//  else
    $columnadia = $noticia->readDataFilter("noticia.ubicacion='C' AND edicion='$idedicion' AND noticia.estado = 'A'");
  for($i=0;$i<count($columnadia);$i++) 
    $columnadia[$i]['imgs'] = getImgs($columnadia[$i]['texto']);
  $smarty->assign('columnadia',$columnadia[0]);
  #Hablemos del idioma
  //$hablemos = $noticia->readDataFilter("noticia.ubicacion='H' AND noticia.estado = 'A' ORDER BY creacion DESC'");
  $order = $noticia->order;
  $noticia->order = 'creacion DESC';
  $ed = new edicionTable;
  $ed->readEnv();
  $numedicionnota = $noticia->getVar("SELECT idedicion FROM noticia WHERE idnoticia = (SELECT max(idnoticia) FROM noticia WHERE ubicacion = 'H')");
  $edicionnota = $ed->getVar("SELECT edicion FROM edicion WHERE idedicion = " . $numedicionnota);
  $smarty->assign("ednota", $edicionnota);
  $hablemos = $noticia->readDataFilter("noticia.ubicacion='H' AND edicion <= '$idedicion'");
  $noticia->order = $order;
  for($i=0;$i<count($hablemos);$i++) 
    $hablemos[$i]['imgs'] = getImgs($hablemos[$i]['texto']);
  $smarty->assign('hablemos',$hablemos[0]);
  #Cartas al director
//  if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//    $cartas = $noticia->readDataFilter("noticia.ubicacion='A' AND edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."' AND noticia.estado = 'A'");
//  else
    $cartas = $noticia->readDataFilter("noticia.ubicacion='A' AND edicion='$idedicion' AND noticia.estado = 'A'");
  $smarty->assign('cartas',$cartas[0]);
  #Editorial
//  if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//    $editorial = $noticia->readDataFilter("noticia.ubicacion='E' AND edicion BETWEEN '".$holidays[$today][0]."' AND '".$holidays[$today][1]."' AND noticia.estado = 'A'");
//  else
    $editorial = $noticia->readDataFilter("noticia.ubicacion='E' AND edicion='$idedicion' AND noticia.estado = 'A'");
  $smarty->assign('editorial',$editorial[0]);
  if(!isset($edicion))  {
    $edicion = new edicionTable();
//    if ( $idedicion=="$cyear-$today"  && array_key_exists($today,$holidays) )
//      list($row) = $edicion->readDataFilter("edicion = '".$holidays[$today][2]."' AND estado = 'A'");
//    else
      list($row) = $edicion->readDataFilter("edicion = '$idedicion' AND estado = 'A'");
    $smarty->assign('edicion',$row);
    unset($row);
  }
}
$smarty->display('portada_opinion_videos.tpl',$cache_pattern);

if ( strtotime($idedicion) < strtotime(date("Y-m-d")) ) {
  $smarty->cache_lifetime = 7 * 24 * 60 * 60;	# 1 día
} else {
$smarty->cache_lifetime = 10800;        # 3 hrs, 180 mins
}
if(!$smarty->is_cached('portada_cartelera_horoscopo.tpl',$cache_pattern)) {
  #Cartelera de cine
  $cartelera = new carteleraTable;
  $cartelera->limit = 1;
  $peliculas = $cartelera->readDataFilter("'$idedicion' BETWEEN fecha_ini::date AND fecha_fin::date AND estado='A'");
  $smarty->assign('cartelera',$peliculas);
  $horoscopos = new horoscopoTable;
  $horoscopos->readEnv();
  $signos = new signoTable;
  $signos->readEnv();
  $horoscopo = $horoscopos->readDataFilter("edicion='$idedicion'");
  $smarty->assign('horoscopo',$horoscopo);
  $smarty->assign('signos',$signos->readData());
}
$smarty->display('portada_cartelera_horoscopo.tpl',$cache_pattern);
if ($_SESSION['idusuario'])
  error_log ("sesiones". $_SESSION['idusuario']);

# Pie de Página
include ('../classes/footer.inc.php');
?>
