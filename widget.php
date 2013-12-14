<? header('Content-type: text/xml; charset=utf-8', true);
require('../classes/app.class.php');
$smarty->caching=0;
$ediciones = new edicionTable;
$data = new noticiaTable;
$data->readEnv();
$tpl = 'widget.tpl';

setlocale(LC_TIME, "en_US");
$ultima = $ediciones->getVar("SELECT edicion FROM edicion WHERE edicion.estado='A' ORDER BY edicion DESC LIMIT 1");
if ($data->request['idseccion'])
  $rows = $data->readDataFilter("edicion = '$ultima' AND noticia.idseccion= '".$data->request['idseccion']."'");
else 
  $rows = $data->readDataFilter("edicion = '$ultima'");

if(isset($_REQUEST["area"]) && !empty($_REQUEST["area"])){
 $area=$_REQUEST["area"];
 $width=substr($area,0,strpos("X"));
 $height=substr($area,strpos($area,"X"),strlen($area)-strpos($area,"X"));
 //$smarty->assign("width",$width);
 //$smarty->assign("height",$height);
}

$smarty->assign('rows', $rows);
$smarty->assign('url', URL);
$smarty->display($tpl);
?>
