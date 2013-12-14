<?php
if($_POST['action'] == 'comment') {
  require_once '../classes/app.class.php';
  #session_start();
  include_once 'securimage/securimage.php';
  $securimage = new Securimage();
  if (empty($_POST['captcha_code'])) {
    error_log("Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
    echo -1;
  } elseif ($securimage->check($_POST['captcha_code']) == false) {
    error_log("Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden: " . $_SESSION['securimage_code_value'] . "SESSION:" . print_r($_SESSION,1));
    echo 0;
  } elseif ( !checkEmail($_REQUEST['email']) ) {
    error_log("Error EMAIL: Dirección de Correo Electronica no es válida");
    echo -2;
  } else {
    if (isset($_POST['idarticulo']) && $_POST['idarticulo'] != 'undefined')   {
      $comentario = new comentarioarticuloTable();
      if(meterAggressiveness($_REQUEST['comentario'])> 80) $_REQUEST['estado'] = 'B';
      else $_REQUEST['estado'] = 'P';
      //else $_REQUEST['estado'] = 'A';
      $_REQUEST['comentario'] = substr(strip_tags($_REQUEST['comentario']),0,500);
      $comentario->readEnv();
      $comentario->addRecord();
    } elseif (isset($_POST['idnota']) && $_POST['idnota'] != 'undefined')   {
      $comentario = new comentarionotaTable();
      if(meterAggressiveness($_REQUEST['comentarionota'])> 80) $_REQUEST['estado'] = 'B';
      else $_REQUEST['estado'] = 'P';
      //else $_REQUEST['estado'] = 'A';
      $_REQUEST['comentarionota'] = substr(strip_tags($_REQUEST['comentario']),0,500);
      $comentario->readEnv();
      $comentario->addRecord();
    } else {
      $comentario = new comentarioTable();
      if(meterAggressiveness($_REQUEST['comentario'])> 80) $_REQUEST['estado'] = 'B';
      else $_REQUEST['estado'] = 'P';
      //else $_REQUEST['estado'] = 'A';
      $_REQUEST['comentario'] = substr(strip_tags($_REQUEST['comentario']),0,500);
      $comentario->readEnv();
      $comentario->addRecord();
    }
    echo "Muchas gracias. Tu comentario ha sido enviado correctamente...";
    unset($comentario);
  }
}
