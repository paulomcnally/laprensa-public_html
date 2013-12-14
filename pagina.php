<?php
define('PAGE',true);
require('../classes/app.class.php');
#require('../classes/badpages.class.php');


$_REQUEST['uri'] = $_SERVER['REQUEST_URI'];
$tpl_id = $_REQUEST['uri'] = preg_replace('(\.(.*))','',$_REQUEST['uri']);
$tpl_id = substr($tpl_id,1);
if ( !empty($avoid) && array_key_exists($tpl_id,$avoid) ) {
  include('../classes/404.inc.php');
  include('./404.php');
  die();
}

$data = new Table('seccion');
# Genera 404
$exist = $data->getVar("SELECT idpagina FROM pagina WHERE uri = '". $data->database->escape($tpl_id )  ."'");

if (!$exist) {
  error_log("FIXME pagina no existe? " . $_SERVER['REQUEST_URI']);
  #$avoid[$tpl_id] = mktime();
  #$strArr = array2string($avoid,'avoid');
  #$filename = dirname(__FILE__) . '/../classes/badpages.class.php';
  #writeFile($filename,$strArr);
  include('../classes/404.inc.php');
  include('./404.php');
  die();
}
unset($data);

require('../classes/header.inc.php');

if(!$smarty->is_cached('pagina.tpl',$cache_pattern)) {
  $data = new paginaTable;
  $data->readEnv();
  list($row) = $data->readDataFilter("uri = '". $data->database->escape($tpl_id )  ."'");
  $smarty->assign('row',$row);
  unset($row);
  # Edicion
  if(!isset($edicion))  {
    $edicion = new edicionTable();
    list($row) = $edicion->readDataFilter("edicion = '$idedicion' AND estado = 'A'");
    $smarty->assign('edicion',$row);
    unset($row);
  }
  # Encuestas
  include ('./encuesta.inc.php');
  # Blogs
  include ('./blogs.inc.php');
}

$smarty->display("pagina.tpl",$cache_pattern);

include ('../classes/footer.inc.php');
?>
