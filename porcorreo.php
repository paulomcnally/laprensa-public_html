<?
header("Content-type: text/html; charset=iso-8859-1");
function mailencode($arreglo) {
  foreach($arreglo as $key=>$val)
    foreach($val as $k=>$v) {
      $v = strip_tags($v);
      if (strpos($k, 'image') === false && strpos($k, 'foto') === false)
        $v = utf8_decode($v);
        $arreglo[$key][$k] = htmlentities($v,ENT_NOQUOTES);
    }
  return $arreglo;
}

require('../classes/app.class.php');
require('../classes/thisedition.php');
$smarty->caching=0;
$noticia = new noticiaTable;
$noticia->readEnv();
$noticia->order = "idseccion, orden";
$secciones = new seccionTable;
$tpl = 'porcorreo.tpl';

$rows = $noticia->readDataFilter("edicion='$idedicion'");
$rows = mailencode($rows);
$smarty->assign('rows',$rows);
$smarty->assign('url', URL);

$smarty->display($tpl);
?>
