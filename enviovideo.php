<?php
session_start();
define("UPLOADUSER",true);
define("TINYMCE", true);
require("../classes/app.class.php");
$titulo = (string)stripslashes($_REQUEST['videominoticia']);
$lugar = (string)stripslashes($_REQUEST['lugartoma']);
$descripcion = (string)stripslashes($_REQUEST['descripcion']) . "Video enviado por el lector: " . $_REQUEST['usuariosend'];
$nvideo = (string)($_REQUEST['nvideo']);

$video = new videominoticiaTable();
$pagina = new paginaTable();
$pagina->readEnv();
$tpl = "minoticia/enviovideo.tpl";

if(!isset($_SESION['idusuario']) && empty($_SESSION['idusuario'])){
  header("Location: /minoticia/entrar");
}

if(!empty($_POST)){
     if(empty($_POST["descripcion"])){
       $smarty->assign("msg", "No introdujo una descripcion para su video:");
}else{
    $video->readEnv();
    $video->execSql("INSERT INTO videominoticia (archivovideo, videominoticia, texto) values ('" . $nvideo . "','" . $titulo . "','" . $descripcion . "')");
    $smarty->assign("enviada", true);
  }
}

include("../classes/header-minoticia.inc.php");
$smarty->caching=false;
include_once ('./ultimasnoticiasuser.inc.php');

$noti = new minoticiaTable;
$nportada = $noti->readDataFilter("minoticia.ubicacion = 'L' OR minoticia.ubicacion = 'M' OR minoticia.ubicacion = 'S'");
$smarty->assign("noticiasportada", $nportada);
$smarty->assign("terminoscondiciones", $pagina->readRecord("6"));
$smarty->display($tpl);
$smarty->assign('enportada', true);
$smarty->display('minoticia/ultimasnoticiasuser.inc.tpl');
include("../classes/footer.inc.php");
?>
