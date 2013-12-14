<?php
include ('../classes/app.class.php');

$tpl_id = (int)$_REQUEST['idgaleria'] =& $_REQUEST['id'];
$tpl = 'gallery.tpl';
if(!$smarty->is_cached($tpl,$tpl_id)) {
  $galeria = new coleccionTable();
  $galeria->readEnv();
  $rows = $galeria->readDataFilter("coleccion.idgaleria = " . $galeria->request['idgaleria']);
  $smarty->assign('fotos',$rows);
}
error_log('galeria: ' . $tpl_id);
$smarty->display($tpl,$tpl_id);
