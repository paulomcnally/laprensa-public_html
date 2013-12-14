<?php
session_start();
include('../classes/app.class.php');
include_once 'securimage/securimage.php';
$tpl = 'minoticia/comentariomn.tpl';
$securimage = new Securimage();
$tabla = $_POST['tipocomentario'];

$comentario = new comentariominoticiaTable;
$comentario->readEnv();

include('../classes/header-minoticia.inc.php');

if($_POST['action'] == 'comment') {
  if($_REQUEST['comentariominoticia']){
    $smarty->assign("error", "Introduzca su comentario");
    }elseif(empty($_POST['captcha_code'])) {
      error_log("Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
      echo -1;
    }elseif($securimage->check($_POST['captcha_code']) == false) {
      error_log("Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden.");
      echo 0;   
  }else{
     switch($tabla){
       case 'noticia':
            $comment = substr(strip_tags($_REQUEST['comentariominoticia']),0,500); 
            $comentario->request['comentariominoticia'] = $comment;
            $comentario->addRecord();
            $smarty->assign("mensaje","Se ha enviado el comentario de esta noticia. Muchas Gracias"); break;
     }
  }
}

$smarty->display($tpl);
include('../classes/footer.inc.php');

?>
