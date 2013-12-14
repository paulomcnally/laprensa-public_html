<?php
session_start();
require("../classes/app.class.php");
$smarty->caching = false;

$usuario = new usuarioTable();
$media = new mediaminoticiaTable();
$pagina = new paginaTable();
$pagina->readEnv();
$noti = new minoticiaTable;
$nportada = $noti->readDataFilter("minoticia.ubicacion = 'L' OR minoticia.ubicacion = 'M' OR minoticia.ubicacion = 'S'");
$smarty->assign("noticiasportada", $nportada);

$tpl = "minoticia/envioaudio.tpl";
$audioFormats = array('wav', 'mp3');
$audioFile = $_FILES['mediaminoticia']['name'];
$tamStream = $_FILES['mediaminoticia']['size'];
$limitStream = 1048576 * 12;
in_array(end(explode(".", $audioFile)),$audioFormats);

if(!isset($_SESION['idusuario']) && empty($_SESSION['idusuario'])){
  header("Location: /minoticia/entrar");
}

if(!empty($_SESSION['idusuario'])){
   $smarty->assign("creditousuario", $usuario->readRecord($_SESSION['idusuario'])); 
}

if(!empty($_POST)){
   if(empty($_POST["resumen"])){
      $smarty->assign("msg", "Error Descripcion: No introdujo una descripcion para su archivo de audio o entrevista:");
   }elseif(!isAllowedExtension($audioFile, $audioFormats)){
       $smarty->assign("msg", "El formato del archivo seleccionado parece no ser un formato valido o aun no ha seleccionado un audio. Seleccione un audio con formato permitido");
}elseif($tamStream > $limitStream){
       $smarty->assign("msg", "El tamaño del audio seleccionado excede lo maximo permitido. eleccione un audio de menor tamaño");
}else{
    $media->readEnv();
    $media->request['credito'] = $_REQUEST['user'] . '/' . $_REQUEST['lugaraudio'];
    $media->addRecord();
    $smarty->assign("enviada", true);
  }
}

include("../classes/header-minoticia.inc.php");
$smarty->caching=false;

$smarty->assign("terminoscondiciones", $pagina->readRecord("6"));
$smarty->display($tpl);

$smarty->assign('enportada', true);
#$smarty->display('minoticia/right-formbackup.tpl');
$smarty->display('minoticia/ultimasnoticiasuser.inc.tpl');
include("../classes/footer.inc.php");
