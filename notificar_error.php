<?php
require('../classes/app.class.php');
$smarty->caching=0;

session_start();
include_once 'securimage/securimage.php';
$securimage = new Securimage();

$data = new noticiaTable;
$data->readEnv();
if ($data->request['idnoticia']) {
  $row = $data->readRecord();
  if ($row) {
    $smarty->assign('row',$row);
    if (empty($_POST['captcha_code'])) {
      error_log("Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
      #echo -1;
    } elseif ($securimage->check($_POST['captcha_code']) == false) {
      error_log("Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden.");
      $smarty->assign('error',"* Codigo incorrecto, porfavor intentarlo nuevamente");
      echo 0;
    } else {
      $titulo = $row['titulo'];
      $texto = $row['texto'];
      $remitente = $_REQUEST['remitente'];
      $destinatarios = split(';',$_REQUEST['destinatario']);
      $comment = $_REQUEST['comentario'];
      list($anho, $mes, $dia) = split("-", $row['edicion']);
      $enlace = URL.'/envia?idnoticia='.$row['idnoticia'];
      $cuerpo = file_get_contents($enlace);
      $mensaje = utf8_decode($cuerpo);
      for($i=0;$i<count($destinatarios);$i++) {
        $to = trim($destinatarios[$i]);
        $body = "Remitente: $to\n\rComentario: $comment\n\r\n\r$separacion\r\n\n$titulo\r\n\nWeb: $enlace\n\r";
        $encoding = "MIME-Version: 1.0\r\nContent-Type: text/html;=charset=iso-8859-1\r\nContent-Transfer-Encoding: 8bit\r\n";
        mail($to, 'Recomendacion: Noticia La prensa', utf8_decode($mensaje), 'From: ' .$remitente . "\r\n" . 'Return-Path: ' . $remitente . "\r\n" . $encoding. "\r\n");         
        $smarty->assign('sent', true);
      }
    }
    $smarty->assign('destinatarios', $destinatarios);
  } else {
    header("Location: /"); 
    die();
  }
  $smarty->display('notificar_error.tpl');
}
?>
