<?php
include_once ('../classes/app.class.php');

if(PORTADA===true) {
  $cache_pattern = $cache_prefix . '|portada';
  $smarty->cache_lifetime = 300;	# 5 mins
} else {
  $cache_pattern = $cache_prefix . '|noticia';
  $smarty->cache_lifetime = 10800;	# 3 hrs, 180 mins
  $idnoticia = (int)$_REQUEST['idnoticia'];
  $cache_pattern .= "|$idnoticia";
}
print_r("EDICION:".$idedicion);
if(!$smarty->is_cached('header.tpl',$cache_pattern)) {
    # Si se definieron secciones para ese día
    if(!empty($row['menu'])) {
    } else {
      $seccion = new seccionTable();
      $rows = $seccion->readDataFilter("seccion.activo IS TRUE AND seccion.menu IS TRUE");
    }
    $smarty->assign('secciones',$rows);
    unset($row);
    unset($rows);
}
$smarty->display('header.tpl',$cache_pattern);
?>
