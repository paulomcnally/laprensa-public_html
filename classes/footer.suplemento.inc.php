<?php
include_once ('../classes/app.class.php');

$smarty->caching=0;
if(!$smarty->is_cached('footer.tpl',$cache_pattern)) {
  # Edicion
  $edicion = new edicionsuplementoTable();
  list($row) = $edicion->readDataFilter("edicionsuplemento = '$idedicion'");
  # Si la edicion no existe o no esta publicada
  if(!$row) {
  }
  $smarty->assign('edicion',$row);
  # Si se definieron secciones para ese día
  unset($row);
}
$smarty->display('footer.tpl',$cache_pattern);
?>
