<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/../classes/app.class.php';
$smarty->caching = 2;
define(PORTADAMINOTICIA, true);
$cache_prefix = 'minoticia';

if(PAGE===true) {
  $cache_pattern = 'pages';
  $idpagina = preg_replace('(\.(.*))','',$_REQUEST['uri']);
  $cache_pattern .= "|$idpagina";
  $smarty->cache_lifetime = 10800;      # 3 horas
}elseif(LOGINMN===true){
   $idlogin = preg_replace('(\.(.*))','',$uri);
   $cache_pattern = $cache_prefix . "|login|$idlogin";
} elseif(PORTADAMN===true) {
  $cache_pattern = $cache_prefix . '|portada';
  $smarty->cache_lifetime = 3600;   
} elseif(NOTICIA===true) {
  $cache_pattern = $cache_prefix . '|minoticia|';
    $smarty->cache_lifetime = 3600;  
}elseif(VIDEOS===true){
    $cache_pattern = $cache_prefix . '|videos|'; #3 horas
    $smarty->cache_lifetime = 3600;
}elseif(SGALERIA===true){
   $idgaleriaminoticia = $_REQUEST['idgaleriaminoticia'];
   $cache_pattern = $cache_prefix . '|galeriasminoticia|';
   $smarty->cache_lifetime = 600; #1 dia
}elseif(OCD==true){
  $idojociudadano = $_REQUEST['idojociudadano'];
  $cache_pattern = $cache_prefix . '|ojociudadano|';
  $smarty->cache_lifetime = 600;  
} elseif(SEARCH===true) {
  $smarty->cache_lifetime = 10800;
  $cache_pattern = "search";
} else {
  $cache_pattern = $cache_prefix . '|minoticia';
  $smarty->cache_lifetime = 600; 
  $idnoticia = (int)$_REQUEST['idminoticia'];
  $cache_pattern .= "$idnoticia";
}
if(!$smarty->is_cached('minoticia/header.tpl',$cache_pattern)) {
  $edicion = new edicionTable();
  list($row) = $edicion->readDataFilter("edicion = '$idedicion' AND 1=1");
  $smarty->assign('edicion',$row);
  if(!empty($row['menu'])) {
  } else {
      $Ed = ((int)$_REQUEST['year']) . '-' . ((int)$_REQUEST['month']) . '-' . ((int)$_REQUEST['day']);
      if ( $Ed == "0-0-0") {
          $Ed = date("Y-m-d");
      }
      $seccion = new seccionTable();
      // Evaluamos la edicion para que muestre el menu correspondiente
      if ( strtotime($Ed) <= strtotime("2011-02-22") ){
          $rows = $seccion->readDataFilter("seccion.activo IS TRUE AND seccion.menu IS TRUE
          AND seccion.menu_v2 IS NOT TRUE AND seccion.idseccion <> 20 AND seccion.idseccion <> 9 AND seccion.idseccion <> 6
          AND seccion.idseccion <> 3 AND seccion.idseccion <> 12 AND seccion.idseccion <> 11
          AND seccion.idseccion <> 5");
          $secciones = $seccion->readDataFilter("seccion.activo IS TRUE AND seccion.menu IS TRUE
          AND seccion.menu_v2 IS NOT TRUE AND seccion.idseccion <> 1 AND seccion.idseccion <> 2 AND seccion.idseccion <> 7
          AND seccion.idseccion <> 10 AND seccion.idseccion <> 8");
          $cambio = false;
      } elseif(in_array($idedicion,$electionsdays)) {
          $rows = $seccion->readDataFilter("seccion.menu_v2 IS TRUE AND seccion.menu IS TRUE");
          $cambio = true;
      } else {
          $rows = $seccion->readDataFilter("seccion.menu_v2 IS TRUE AND seccion.menu IS TRUE AND seccion.otras IS FALSE AND seccion.idseccion <> 51");
          $otrassecciones = $seccion->readDataFilter("seccion.menu_v2 IS TRUE AND seccion.menu IS TRUE AND seccion.otras IS TRUE");    
          $cambio = true;
      }
  }
  $smarty->assign("cambio", $cambio);
  $smarty->assign('otrassecciones',$otrassecciones);
  $smarty->assign('secciones',$rows);
  unset($row);
  unset($rows);
  $idnoticia = $_REQUEST['idminoticia'];
  if($idnoticia) {
    $table = new Table('minoticia');
    $title = $table->getVar("SELECT minoticia FROM minoticia WHERE idminoticia = $idnoticia");
  } elseif ($idojociudadano) {
      $table = new Table('ojociudadano');
      $title = 'Ojo ciudadano - ' . $table->getVar("SELECT ojociudadano FROM ojociudadano WHERE idojociudadano = $idojociudadano");
  } elseif($idgaleriaminoticia) {
    $table = new Table('galeriaminoticia');
    $title = 'Galerias - ' . $table->getVar("SELECT galeriaminoticia FROM galeriaminoticia WHERE idgaleriaminoticia = $idgaleriaminoticia");
  } elseif($idpagina) {
    $table = new Table('seccion');
    $title = $table->getVar("SELECT pagina FROM pagina WHERE uri = '$idpagina'");
  }
  $smarty->assign('title',$title);
  # Banners google
  if(PORTADAMINOTICIA===true) {
    @include_once(ROOTDIR.'/zonas/minoticia.php');
    $smarty->assign('uri','portada');
  }
}
if(CACHE_DEBUG === true) cacheLog($_SERVER['REQUEST_URI'] . ' => ' . $cache_pattern . ' - minoticia-header.inc.php');
$smarty->display('minoticia/header.tpl',$cache_pattern);
