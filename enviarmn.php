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
    $tpl = 'minoticia/enviar.tpl';
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
        $titulo = $row['minoticia'];
        $texto = $row['texto'];
        $nombreremitente = $_REQUEST['nombre'];
        $remitente = $_REQUEST['nombre'] . " <".$_REQUEST['correo'].">";
        $destinatarios = split(';',$_REQUEST['destino']);
        $valid = true;
        for($i=0;$i<count($destinatarios);$i++) {
          $destinatarios[$i] = trim($destinatarios[$i]);
          if ( !checkEmail($destinatarios[$i]) ) {
            error_log("Error EMAIL: Dirección de Correo Electronica no es válida -> " . $destinatarios[$i]);
            if ( $valid ) $valid = false;
          }
        }
        if ( $valid ) {
          $comment = $_REQUEST['comentario'];
          $enlace = URL.'/minoticia/enviamn?idminoticia='.$row['idminoticia'];
          $mensaje = file_get_contents($enlace);
          #$mensaje = utf8_decode($cuerpo);
          for($i=0;$i<count($destinatarios);$i++) {
            $to = trim($destinatarios[$i]);
            $body = "$nombreremitente te ha enviado la siguiente noticia.\r\n\r\n\r\nSus comentarios son los siguientes: $comment\n\r\n\r";
            $encoding = "MIME-Version: 1.0\r\nContent-Type: text/html;=charset=iso-8859-1\r\nContent-Transfer-Encoding: 8bit\r\n";
            mail($to, 'Recomendacion: Noticia La Prensa', $body.utf8_decode($mensaje), 'From: ' .$remitente . "\r\n");
          }
          $smarty->assign('sent', true);
          if ( $_POST['send2mecopy'] )
            mail($remitente, 'Recomendacion: Noticia La Prensa', $body.utf8_decode($mensaje), 'From: ' .$remitente . "\r\n");
          // comentado para pruebas
         //  . 'Return-Path: ' . WEBMASTER_EMAILS . "\r\n" . $encoding. "\r\n",'-f' . WEBMASTER_EMAILS  
          $smarty->assign('destinatarios',$destinatarios);
          $smarty->assign('comment', $comment);
        } else {
          $smarty->assign('error','Error EMAIL: Alguna de las direcciones de los destinatarios no son validas por favor chequee');
          $smarty->assign('sent',false);
        }
      }
    }
  } else {
    header("Location: /minoticia"); 
    die();
  }
  $smarty->display($tpl);
}
?>
