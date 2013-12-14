<?
require('../classes/app.class.php');

$cache_pattern = $cache_prefix . '|noticia';
$smarty->cache_lifetime = 10800;	# 3 hrs, 180 mins
$idnoticia = (int)$_REQUEST['idnoticia'];
$idseccion = $_REQUEST['uri'] = preg_replace('(\.(.*))','',$_REQUEST['uri']);
$cache_pattern .= "|$idseccion|$idnoticia";

$tpl = 'envia.tpl';
if($idnoticia) {
  if(!$smarty->is_cached($tpl,$cache_pattern)) {
    $data = new noticiaTable();
    $data->readEnv();
    if ($data->request['idnoticia']) {
      $row = $data->readRecord();
      if($row) {
        $smarty->assign('row',$row);
      } else {
        header("Location: /"); 
        die();
      }
    }
  }
  $smarty->display($tpl,$cache_pattern);
} else {
  header("Location: /"); die();
}
?>
