<?php
require('../classes/app.class.php');
$smarty->caching=0;

if ( !defined('WEBMASTER_EMAILS') ) define('WEBMASTER_EMAILS','collado@laprensa.com.ni');
session_start();
include_once 'securimage/securimage.php';
$securimage = new Securimage();

$data = new minoticiaTable;
$data->readEnv();
if ($data->request['idminoticia']) {
  $row = $data->readRecord();
  if ($row) {
    $smarty->assign('row',$row);
    $tpl = 'minoticia/notificar.tpl';
    if(!empty($_POST)) {
      if (empty($_POST['captcha_code'])) {
        error_log("Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
        $smarty->assign('error',"* Codigo de verificación vacio");
      } elseif ($securimage->check($_POST['captcha_code']) == false) {
        error_log("Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden.");
        $smarty->assign('error',"* Codigo incorrecto, Por Favor intentarlo nuevamente");
      } elseif ( !checkEmail($_REQUEST['correo']) ) {
        error_log("Error EMAIL: Dirección de Correo Electronica (" . $_REQUEST['correo'] . ") no es válida");
        $smarty->assign("error","Error EMAIL: Dirección de Correo Electronica no es válida");
        $smarty->assign($_REQUEST);
      } else {
        list($anho, $mes, $dia) = split("-", $row['edicion']);
        $titulo = $row['noticia'];
        $texto = $row['texto'];
        $to = 'jorge.sequeira@laprensa.com.ni, juan.martinez@laprensa.com.ni';
        $remitente = $_REQUEST['correo'];
        $nombreremitente = $_REQUEST['nombre'];
        $comment = $_REQUEST['comentario'];
        $enlace = URL.'/minoticia/'.'/'.$row['idminoticia'];
        $body = "Mensaje procedente de: $nombreremitente\r\n\r\nNoticia: $titulo\r\n\r\nComentario: $comment\r\n\r\nError: $enlace";
        $encoding = "MIME-Version: 1.0\r\nContent-Type: text/plain;=charset=iso-8859-1\r\nContent-Transfer-Encoding: 8bit\r\n";
        mail($to,'Notificacion de error', $body, 'From: ' .$remitente . "\r\n" . 'Return-Path: ' . WEBMASTER_EMAILS . "\r\n" . $encoding. "\r\n","-f" . WEBMASTER_EMAILS);
        $smarty->assign('sent', true);
        error_log("notificar error a:".$to);
      }
    }
  } else {
    header("Location: /minoticia"); 
    die();
  }
  $smarty->display($tpl);
}
?>
