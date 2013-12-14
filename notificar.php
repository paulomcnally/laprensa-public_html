<?php
$ref = $_SERVER['HTTP_REFERER'];
if (!preg_match('/^http:\/\/www.laprensa\.com\.ni/',$ref))
  exit();
else
  ini_set('memory_limit','64M');
require('../classes/app.class.php');

$smarty->caching=2;

# 1er Parte - Destacados - 5 mins
$smarty->cache_lifetime = 3 * 60 * 60;  # 3 hrs
$cache_pattern = $cache_prefix . '|noticia';
$idseccion = $_REQUEST['uri'] = preg_replace('(\.(.*))','',$_REQUEST['uri']);
$idnoticia = (int)$_REQUEST['idnoticia'];
$cache_pattern .= "|$idseccion|$idnoticia";

$tpl = 'notificar.tpl';
if ( !defined('WEBMASTER_EMAILS') ) define('WEBMASTER_EMAILS','collado@laprensa.com.ni');
session_start();
include_once 'securimage/securimage.php';
$securimage = new Securimage();

if(!empty($_POST)) {
  if (empty($_POST['captcha_code'])) {
    error_log("Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
    $smarty->assign('error',"* Codigo de verificación vacio");
    $smarty->assign($_REQUEST);
    $cache_pattern .= "|notificar|error";
  } elseif ($securimage->check($_POST['captcha_code']) == false) {
    error_log("Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden.");
    $smarty->assign('error',"* Codigo incorrecto, Por Favor intentarlo nuevamente");
    $smarty->assign($_REQUEST);
    $cache_pattern .= "|notificar|error";
  } elseif ( !checkEmail($_REQUEST['correo']) ) {
    error_log("Error EMAIL: Dirección de Correo Electronica (" . $_REQUEST['correo'] . ") no es válida");
    $smarty->assign("error","Error EMAIL: Dirección de Correo Electronica no es válida");
    $smarty->assign($_REQUEST);
    $cache_pattern .= "|notificar|error";
  } elseif (empty($_REQUEST['comentario'])) {
    error_log("Error COMENTARIO: La caja de texto de la Descripción del Error no puede ser vacia");
    $smarty->assign("error","Error COMENTARIO: La caja de texto de la Descripción del Error no puede ser vacia");
    $smarty->assign($_REQUEST);
    $cache_pattern .= "|notificar|error";
  } else {
    if ( empty($news[$idnoticia]) ) {
      include('../classes/404.inc.php');
      include('./404.php');
      die();
    } else {
      $row = $news[$idnoticia];
      list($anho, $mes, $dia) = split("-", $row['edicion']);
      $titulo = $row['noticia'];
      #$to = 'jorge.sequeira@laprensa.com.ni';
      $to = 'javier@guegue.net';
      $remitente = $_REQUEST['correo'];
      $nombreremitente = $_REQUEST['nombre'];
      $comment = $_REQUEST['comentario'];
      $enlace = URL.'/'.$anho.'/'.$mes.'/'.$dia.'/'.$row['uri'].'/'.$row['idnoticia'];
      $body = "Mensaje procedente de: $nombreremitente\r\n\r\nNoticia: $titulo\r\n\r\nComentario: $comment\r\n\r\nError: $enlace";
      $encoding = "MIME-Version: 1.0\r\nContent-Type: text/plain;=charset=iso-8859-1\r\nContent-Transfer-Encoding: 8bit\r\n";
      mail($to,'Notificacion de error', $body, 'From: ' .$remitente . "\r\n" . 'Return-Path: ' . WEBMASTER_EMAILS . "\r\n" . $encoding. "\r\n","-f" . WEBMASTER_EMAILS);
      $smarty->assign('sent', true);
      $cache_pattern .= "|notificar|enviado";
      error_log("notificar error a:".$to);
    }
  }
} else {
  $cache_pattern .= "|notificar|normal";
}

if(!$smarty->is_cached($tpl,$cache_pattern)) {
  $data = new noticiaTable;
  $data->readEnv();
  if ($data->request['idnoticia']) {
    if( empty($news[$data->request['idnoticia']]) ) 
      $row =& createNewsDesc($data->request['idnoticia']);
    else $row = $news[$data->request['idnoticia']];
    if ( empty($row) ) {
      $avoid[$data->request['idnoticia']] = mktime();
      $strArr = array2string($avoid,'avoid');
      $filename = dirname(__FILE__) . '/../classes/badnews.class.php';
      writeFile($filename,$strArr);
      include '../classes/404.inc.php';
      include('./404.php');
      die();
    }
  }
  $smarty->assign('row',$row);
}
$smarty->display($tpl,$cache_pattern);
