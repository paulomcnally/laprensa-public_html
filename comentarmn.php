<?php
if($_POST['action'] == 'comment') {
  require_once '../classes/app.class.php';
  include_once 'securimage/securimage.php';
  $securimage = new Securimage();
  if (empty($_POST['captcha_code'])) {
    error_log("Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
    echo -1;
  } elseif ($securimage->check($_POST['captcha_code']) == false) {
    error_log("Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden: " . $_SESSION['securimage_code_value']);
    echo 0;
  }else{
   switch($_POST['tipocomentario']){
    case 'minoticia':
       $cminoticia = new comentariominoticiaTable();
      # if(meterAggressiveness($_REQUEST["comentariominoticia"]) > 80) $_REQUEST['estado'] = 'B';
      # else $_REQUEST['estado'] = 'A';
       $_REQUEST['comentariominoticia'] = substr(strip_tags($_REQUEST['comentariominoticia']),0,500) ;
       $cminoticia->readEnv();
       $cminoticia->request['comentariominoticia'] = $_REQUEST['comentariominoticia'];
       $cminoticia->request['estado'] = $_REQUEST['estado'] = 'P';
       $cminoticia->addRecord();
       echo "Muchas gracias. Tu comentario ha sido enviado.";
       unset($cminoticia);
       break;
    case 'galeria':
       $cminoticia = new comentariogaleriaTable();
      # if(meterAggressiveness($_REQUEST["comentariominoticia"]) > 80) $_REQUEST['estado'] = 'B';
      # else $_REQUEST['estado'] = 'A';
       $_REQUEST['comentariogaleria'] = substr(strip_tags($_REQUEST['comentariogaleria']),0,500) ;
       $cminoticia->readEnv();
       $cminoticia->request['comentariogaleria'] = $_REQUEST['comentariogaleria'];
       $cminoticia->request['estado'] = $_REQUEST['estado'] = 'P';
       $cminoticia->addRecord();
       echo "Muchas gracias. Tu comentario ha sido enviado.";
       unset($cminoticia); 
       break;  
     case 'ojociudadano':
       $cminoticia = new comentarioojociudadanoTable();
      # if(meterAggressiveness($_REQUEST["comentariominoticia"]) > 80) $_REQUEST['estado'] = 'B';
      # else $_REQUEST['estado'] = 'A';
       $_REQUEST['comentarioojociudadano'] = substr(strip_tags($_REQUEST['comentarioojociudadano']),0,500) ;
       $cminoticia->readEnv();
       $cminoticia->request['comentarioojociudadano'] = $_REQUEST['comentarioojociudadano'];
       $cminoticia->request['estado'] = $_REQUEST['estado'] = 'P';
       $cminoticia->addRecord();
       echo "Muchas gracias. Tu comentario ha sido enviado.";
       unset($cminoticia);
       break;  
          
    }
  }
}
