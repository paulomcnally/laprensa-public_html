<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../classes/app.class.php';

$mobile = get_smartphone_type();
$smarty->assign('mobile', $mobile);

if(PAGE===true) {
  $cache_pattern = 'pages';
  $idpagina = preg_replace('(\.(.*))','',$_REQUEST['uri']);
  $cache_pattern .= "|$idpagina";
  $smarty->cache_lifetime = 10800;	# 3hrs
} elseif(PORTADA===true) {
  $cache_pattern = $cache_prefix . '|portada-' . $is_mobile;
  #$smarty->cache_lifetime = 300;	# 5 mins
  if ( strtotime($idedicion) < strtotime(date("Y-m-d")) )
    $smarty->cache_lifetime = 7 * 24 * 60 * 60;       # 1 semana
  else
    $smarty->cache_lifetime = 600;	# 10 mins
} elseif(SECCION===true) {
  $cache_pattern = $cache_prefix . '|noticia';
  if ( strtotime($idedicion) < strtotime(date("Y-m-d")) )
    $smarty->cache_lifetime = 7 * 24 * 60 * 60;       # 1 semana
  else
    $smarty->cache_lifetime = 3600;	# 1 hr, 60 mins
  if ($idseccion === 'elecciones' && $iddepto) {
    $cache_pattern .= "|$idseccion-$iddepto";
  }elseif ($idseccion === 'departamentales' && $iddepto) {
    $cache_pattern .= "|$idseccion-$iddepto";
  } else {
    $idseccion = $_REQUEST['uri'] = preg_replace('(\.(.*))','',$_REQUEST['uri']);
    $cache_pattern .= "|$idseccion-portada-$page_number";
  }
} elseif(SUPLEMENTO===true) {
  $cache_pattern = $cache_prefix . '|suplemento';
  $smarty->cache_lifetime = 32400;	# 9 hr, 540 mins
  $idsuplemento = $_REQUEST['uri'] = preg_replace('(\.(.*))','',$_REQUEST['uri']);
  $cache_pattern .= "-$idsuplemento-portada";
} elseif(ACCESS===true) {
  $idaccess = preg_replace('(\.(.*))','',$uri);
  $cache_pattern = "access-$idaccess";
} elseif(KEYWORDS===true) {
  $smarty->cache_lifetime = 10800; # 3 Hrs
  $cache_pattern = "claves|" . preg_replace('(\.(.*))','',$_REQUEST['clave']);
} elseif(SEARCH===true) {
  $smarty->cache_lifetime = 10800; # 3 Hrs
  $cache_pattern = "search";
} elseif(ARTICULO===true) {
  $cache_pattern = $cache_prefix . '|suplemento';
  $smarty->cache_lifetime = 10800;	# 3 hrs, 180 mins
  $idarticulo = (int)$_REQUEST['idarticulo'];
  $idsuplemento = $_REQUEST['uri'] = preg_replace('(\.(.*))','',$_REQUEST['uri']);
  $cache_pattern .= "-$idsuplemento-$idarticulo";
} else {
  $cache_pattern = $cache_prefix . '|noticia';
  if ( strtotime($idedicion) < strtotime(date("Y-m-d")) )
    $smarty->cache_lifetime = 7 * 24 * 60 * 60;       # 1 semana
  else
    $smarty->cache_lifetime = 10800;	# 3 hrs, 180 mins
  $idnoticia = (int)$_REQUEST['idnoticia'];
  $idseccion = $_REQUEST['uri'] = preg_replace('(\.(.*))','',$_REQUEST['uri']);
  $cache_pattern .= "-$idseccion-$idnoticia-$is_mobile-$page_number";
  #list($anho, $mes, $dia, $noticia_o_portada, $seccion, $id, $nada, $cero) = preg_split('/\|/', $cache_pattern);
  #$cache_pattern_header = "$anho|$mes|$seccion";
}
if (!defined($cache_pattern_header)) $cache_pattern_header = $cache_pattern;
if(!$smarty->is_cached('header.tpl',$cache_pattern_header)) {
#error_log("HEADER: my cache pattern was $cache_prefix and now is: $cache_pattern_header");
  # Ultima actualización
  # hay algún ultima hora?, devolveme el ultimo
  $var = new Table('seccion');
  $last_upd = $var->getVar("SELECT hora FROM noticia WHERE idedicion IN (SELECT idedicion FROM edicion WHERE edicion = '$idedicion' LIMIT 1) AND estado = 'A' AND ultimahora IS TRUE ORDER BY hora DESC LIMIT 1");
  if(!$last_upd) {
    $last_upd = $var->getVar("SELECT creacion::time FROM noticia WHERE idedicion IN (SELECT idedicion FROM edicion WHERE edicion = '$idedicion' LIMIT 1) AND estado = 'A' ORDER BY creacion DESC LIMIT 1");
  }
  $smarty->assign('last_update',$last_upd);
  # Edicion
  $edicion = new edicionTable();
  # FIXME
  #list($row) = $edicion->readDataFilter("edicion = '$idedicion' AND estado = 'A'");
  list($row) = $edicion->readDataFilter("edicion = '$idedicion' AND 1=1");
  # Si la edicion no existe o no esta publicad
  $_SESSION['edicionactual'] = ((int)$_REQUEST['year']) . '-' . ((int)$_REQUEST['month']) . '-' . ((int)$_REQUEST['day']);;
  $smarty->assign('edicion',$row);
  # Si se definieron secciones para ese día
  if(!empty($row['menu'])) {
  } else {
      $Ed = ((int)$_REQUEST['year']) . '-' . ((int)$_REQUEST['month']) . '-' . ((int)$_REQUEST['day']);
      if ( $Ed == "0-0-0") {
          $Ed = date("Y-m-d");
      }
      $seccion = new seccionTable();
      // Evaluamos la edicion para que muestre el menu correspondiente
      if ( strtotime($Ed) <= strtotime("2011-08-22") ) {
          $rows = $seccion->readDataFilter("seccion.activo IS TRUE AND seccion.menu IS TRUE
          AND seccion.menu_v2 IS NOT TRUE AND seccion.idseccion <> 20 AND seccion.idseccion <> 6
          AND seccion.idseccion <> 3 AND seccion.idseccion <> 12 AND seccion.idseccion <> 11
          AND seccion.idseccion <> 5 AND seccion.idseccion <> 19 AND seccion.idseccion <> 43");
          $otrassecciones = $seccion->readDataFilter("seccion.activo IS TRUE AND seccion.menu IS TRUE
          AND seccion.menu_v2 IS NOT TRUE AND seccion.idseccion <> 1 AND seccion.idseccion <> 2 AND seccion.idseccion <> 7
          AND seccion.idseccion <> 10 AND seccion.idseccion <> 8 AND seccion.idseccion <> 9 AND seccion.idseccion <> 43");
          $cambio = false;
      } elseif(in_array($idedicion,$electionsdays)) {
          $rows = $seccion->readDataFilter("seccion.menu_v2 IS TRUE AND seccion.menu IS TRUE");
          $cambio = true;
      } else {
          //$rows = $seccion->readDataFilter("seccion.menu_v2 IS TRUE AND seccion.menu IS TRUE AND seccion.idseccion <> 51 AND seccion.idseccion <> 52");
          $rows = $seccion->readDataFilter("seccion.menu_v2 IS TRUE AND seccion.menu IS TRUE AND seccion.otras IS FALSE AND seccion.idseccion <> 51 AND seccion.idseccion <> 43");
          $otrassecciones = $seccion->readDataFilter("seccion.menu_v2 IS TRUE AND seccion.menu IS TRUE AND seccion.otras IS TRUE");
          $cambio = true;
      }
  }
  $smarty->assign("cambio", $cambio);
  $smarty->assign('otrassecciones',$otrassecciones);
  $smarty->assign('secciones',$rows);
  unset($row);
  unset($rows);
  if($idnoticia) {
    $table = new Table('noticia');
    $title = $table->getVar("SELECT noticia FROM noticia WHERE idnoticia = $idnoticia AND idedicion = (SELECT idedicion FROM edicion WHERE edicion = '$idedicion' LIMIT 1) AND idseccion = (SELECT idseccion FROM seccion WHERE uri = '" . $table->database->escape($_REQUEST['uri']) . "')");
    $smarty->assign("sec_noticia",true);
    if ( empty($title) ) {
      # esto solia registrarlo en badnews, ahora lanza 404
      header("Location: /404.html");
      exit;
    }
  } elseif($idseccion) {
    $table = new Table('seccion');
    $title = $table->getVar("SELECT seccion FROM seccion WHERE uri = '$idseccion'");
  } elseif($idpagina) {
    $table = new Table('seccion');
    $title = $table->getVar("SELECT pagina FROM pagina WHERE uri = '$idpagina'");
  }
  $smarty->assign('title',$title);
  # Ads
  if(ZONA_SUPLEMENTO===true) {
	 @include_once(ROOTDIR.'/zonas/all.php');
	 @include_once(ROOTDIR.'/zonas/suplemento.php');
	 $smarty->assign('uri', 'magazine');
	}

  if ($idseccion) {
    @include_once(ROOTDIR.'/zonas/'.$idseccion.'.php');
    $smarty->assign('uri',$idseccion);
  } elseif(PORTADA===true) {
    @include_once(ROOTDIR.'/zonas/portada.php');
    $smarty->assign('uri','portada');
  }
}

# Establece TTL para ser utilizado como refresh meta-tag en el HTML
$current_minutes = strftime("%M");
$ttl = ($current_minutes > 30) ? 60 - $current_minutes : 30 - $current_minutes;
$smarty->assign('TTL', $ttl*60+5); // 5 segundos despues del siguiente clear_cache del crond

if ( CACHE_DEBUG === true ) cacheLog($_SERVER['REQUEST_URI'] . ' => ' . $cache_pattern . ' - header.inc.php');
if ($idseccion == 'elecciones' || in_array($idedicion,$electionsdays))
  $smarty->display('header_elecciones.tpl',$cache_pattern_header);
elseif ($idseccion == 'elecciones-municipales-2012' || in_array($idedicion,$electionsdays))
  $smarty->display('header_elecciones_2012.tpl',$cache_pattern_header);
else
  $smarty->display('header.tpl',$cache_pattern_header);
