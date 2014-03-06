<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../classes/app.class.php';

$smarty->cache_lifetime = 21600;	# 6 hrs, 360 mins

if(PORTADA===true && ($_REQUEST['Year']&&$_REQUEST['Month'])) {
  $cache_pattern = 'calendar|' . $_REQUEST['Year'] . '-' . $_REQUEST['Month'];
}
$cache_pattern_footer = $cache_pattern;
if(!$smarty->is_cached('footer.tpl',$cache_pattern_footer)) {
  # Texto de footer
  $textofooter = new paginaTable();
  $smarty->assign('suscribirse',$textofooter->readRecord(22));
  $smarty->assign('club',$textofooter->readRecord(32));
  # Edicion
  $edicion = new edicionTable();
  list($row) = $edicion->readDataFilter("edicion = '$idedicion' AND estado = 'A'");
  # Si la edicion no existe o no esta publicada
  if(!$row) {
  }
  $smarty->assign('edicion',$row);
  # Archivo
  //if($_SERVER['REMOTE_ADDR']=='190.184.22.23') {
  if(PORTADA===true) {
    if ($_REQUEST['Year']&&$_REQUEST['Month']) {
      $year = (int)$_REQUEST['Year'];
      $month = (int)$_REQUEST['Month'];
    } else {
      $year = (int)($_REQUEST['year']?$_REQUEST['year']:date("Y"));
      $month = (int)($_REQUEST['month']?$_REQUEST['month']:date("m"));
    }
    $rows = $edicion->readDataSQL("SELECT edicion FROM edicion WHERE edicion.estado = 'A' AND date_part('month',edicion) = $month AND date_part('year',edicion) = $year");
    $start = $edicion->getVar("SELECT edicion FROM edicion WHERE edicion.estado = 'A' ORDER BY edicion ASC LIMIT 1");
    $end = $edicion->getVar("SELECT edicion FROM edicion WHERE edicion.estado = 'A' ORDER BY edicion DESC LIMIT 1");
    for($i=0;$i<count($rows);$i++) {
      $selectedDays[] = $rows[$i]['edicion'];
    }
    $smarty->assign('start',$start);
    $smarty->assign('end',$end);
    $smarty->assign('selectedDays',$selectedDays);
  }
  # Si se definieron secciones para ese día
  if(!empty($row['menu'])) {
  } else {
    $Ed = ((int)$_REQUEST['year']) . '-' . ((int)$_REQUEST['month']) . '-' . ((int)$_REQUEST['day']);
      if ( $Ed == "0-0-0") {
          $Ed = date("Y-m-d");
      }
      $seccion = new seccionTable();
      // Evaluamos la edicion para que muestre el menu correspondiente
      if ( strtotime($Ed) <= strtotime("2011-08-22") ){
          $rows = $seccion->readDataFilter("seccion.activo IS TRUE AND seccion.menu IS TRUE
          AND seccion.menu_v2 IS NOT TRUE AND seccion.idseccion <> 20 AND seccion.idseccion <> 9 AND seccion.idseccion <> 6
          AND seccion.idseccion <> 3 AND seccion.idseccion <> 12 AND seccion.idseccion <> 11
          AND seccion.idseccion <> 5");
          $secciones = $seccion->readDataFilter("seccion.activo IS TRUE AND seccion.menu IS TRUE
          AND seccion.menu_v2 IS NOT TRUE AND seccion.idseccion <> 1 AND seccion.idseccion <> 2 AND seccion.idseccion <> 7
          AND seccion.idseccion <> 10 AND seccion.idseccion <> 8");
          $cambio = false;
      }else{
          //$rows = $seccion->readDataFilter("seccion.menu_v2 IS TRUE AND seccion.menu IS TRUE");
          $rows = $seccion->readDataFilter("seccion.menu_v2 IS TRUE AND seccion.menu IS TRUE");
          /*$secciones = $seccion->readDataFilter("seccion.activo IS TRUE AND seccion.menu IS TRUE
          AND seccion.idseccion <> 1 AND seccion.idseccion <> 2 AND seccion.idseccion <> 7
          AND seccion.idseccion <> 10 AND seccion.idseccion <> 8"); */
          $cambio = true;
      }
  }
  $smarty->assign("cambio", $cambio);
  $smarty->assign('otrassecciones',$secciones);
  $smarty->assign('secciones',$rows);
  unset($row);
  unset($rows);
  # Ads
  if ($idseccion) {
    @include_once(ROOTDIR.'/zonas/'.$idseccion.'.php');
    $smarty->assign('uri',$idseccion);
  } elseif(PORTADA===true) {
    @include_once(ROOTDIR.'/zonas/portada.php');
    $smarty->assign('uri','portada');
  }
}

$smarty->display('footer.tpl',$cache_pattern_footer);
