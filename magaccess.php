<?php
require("../classes/app.class.php");
$smarty->caching = false;

define ('ACCESS',true);
$uri = $_REQUEST["opt"];
session_start();

# Para el CAPTCHA
include_once('./securimage/securimage.php');

$tpl="magaccess.tpl";
$usuarioperiodo=new usuarioperiodoTable();
$usuario = new usuarioTable;

if(isset($_SESSION["sus_magazine"])){
error_log("entrando aqui");
   include("../classes/header.inc.php");
   /*
   $idusuario = $usuario->getVar("SELECT idusuario from usuario where idusuario = (select max(idusuario) from usuario)");
   $update = $usuario->execSql("UPDATE usuario SET activo = true  where idusuario = " . $idusuario);
   $_SESSION["idusuario"] = $idusuario;
   */
   $user=$usuario->readRecord($_SESSION["idusuario"]);
   $smarty->assign("rowusuario",$user);
   $_SESSION["nombre"] = $user["nombre"];  
   $_SESSION["apellido"] = $user["apellido"];
   $_SESSION["idusuario"] = $user["idusuario"];
   
}else{

  if(!isset($_SESSION["idusuario"]) && empty($_SESSION["idusuario"])){
    header("Location: /entrar");
  }else{
    $rowsusuarioperiodo=$usuarioperiodo->readDataFilter("usuarioperiodo.idusuario=".$_SESSION["idusuario"]." AND usuarioperiodo.aprobado AND '".date("Y-m-d")."'::date between usuarioperiodo.creacion AND (usuarioperiodo.creacion + (usuarioperiodo.usuarioperiodo || ' month')::interval)");
    if(count($rowsusuarioperiodo)>0){
      header("Location: /magazine/");
    }else{
      include ('../classes/header.inc.php');
      $rowsusuarioperiodo=$usuarioperiodo->readDataFilter("usuarioperiodo.idusuario=".$_SESSION["idusuario"]." AND usuarioperiodo.solicitado AND '".date("Y-m-d")."'::date between usuarioperiodo.creacion AND (usuarioperiodo.creacion + (usuarioperiodo.usuarioperiodo || ' month')::interval)");
      if(count($rowsusuarioperiodo)>0){
        $smarty->assign("msg","Su solicitud ya ha sido enviada y sera procesada en las proximas 24 horas");
        $tpl="error.tpl";
        $smarty->display($tpl);
        exit();
      }
    }
    $usuario=new usuarioTable();
    $user=$usuario->readRecord($_SESSION["idusuario"]);
    $smarty->assign("rowusuario",$user);
  }
}

//include ('../classes/header.inc.php');
switch($_REQUEST["opt"]){
  case "add":
    $securimage = new Securimage();
    if (empty($_POST['captcha_code'])) {
      error_log("Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
      $smarty->assign("msg","Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
    } elseif ($securimage->check($_POST['captcha_code']) == false) {
      error_log("Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden.");
      $smarty->assign("msg","Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden.");
      $_REQUEST["opt"]="viewform";
    } else {
      $usuarioperiodo->order="usuarioperiodo.creacion DESC";
      $usuarioperiodo->readEnv();
      $usuarioperiodo->addRecord();
      list($row) = $usuarioperiodo->readDataSql("SELECT usuario.nombre,usuario.apellido,usuario.correo,usuarioperiodo.* FROM usuarioperiodo JOIN usuario USING(idusuario) WHERE usuarioperiodo.idusuario=" . $_SESSION['idusuario'] . " ORDER BY usuarioperiodo.creacion DESC");
      if(!empty($row['correo']) && !empty($row['nombre'])) {
        $to = str_replace(array("\r\n", "\n", "\r"),',',MAGAZINE_EMAILS);
      
      //  $to = 'ing-jmartinez@hotmail.es';
        $lista="";
        $strHTML = '
          <div style="text-align:left;font-size:11px;font-family:Arial, sans-serif">
          <br />
          <br />
          <h1 style="font-size:14px;color:#666;margin:0;padding:0;">Solicitud de suscripcion</h1>
          <br />
          El usuario.' . $row['nombre'] . ' ' . $row['apellido'] . ', desea suscribirse a magazine
          <br />
          Fecha de creacion: '.$row['creacion'].' , Periodo en meses: '.$row['usuarioperiodo'].'
          <br />
          Direccion de correo asociada al usuario *' . $row['correo'] . '* 
          <br />
          <br />
          <br />
          <br />
          Por favor contactar con el cliente y activar la suscripcion
          <br />
          Saludos,<br/>
          info@laprensa.com.ni<br/>
          </div>';
        $subject = 'Magazine - Nueva suscripcion';
        $subject = preg_replace('/ú/','u',$subject);
        $subject = preg_replace('/&uacute;/','u',$subject);
        $headers = 'From: info@laprensa.com.ni' . "\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
        mail($to, $subject, $strHTML, $headers);

        $to = $row['correo'];
        $strHTML = '
          <div style="text-align:left;font-size:11px;font-family:Arial, sans-serif">
          <br />
          <br />
          <h1 style="font-size:14px;color:#666;margin:0;padding:0;">Solicitud de suscripcion</h1>
          <br/>
          Se ha enviado un correo a nuestro personal para aprobar su solicitud
          <br />
          Datos de la suscripcion
          <br/>
          Nombres: ' . $row['nombre'] . ' ' . $row['apellido'] . ', desea suscribirse a magazine
          <br />
          Fecha de creacion: '.$row['creacion'].' , Periodo en meses: '.$row['usuarioperiodo'].'
          <br />
          Direccion de correo asociada al usuario *' . $row['correo'] . '*
          <br />
          <br />
          <br />
          <br />
          Una vez que su solicitud sea aprobada, ud podra acceder a la seccion de magazine sin restricciones
          mientras su suscripcion se encuentre en el rango establecido.
          <br />
          Saludos,<br/>
          ' . URL . ' -
          info@laprensa.com.ni<br/>
          </div>';
          $subject = 'Magazine - Nueva suscripcion';
          //$subject = preg_replace('/ú/','u',$subjecct));
          $subject = preg_replace('/&uacute;/','u',$subject);
          $headers = 'From: info@laprensa.com.ni' . "\r\n";
          $headers .= 'MIME-Version: 1.0' . "\r\n";
          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
          mail($to, $subject, $strHTML, $headers);        
          mail('maribel@guegue.net', $subject, $strHTML, $headers);        
      }
      $smarty->assign("msg","Sus Datos han sido agregados. Se ha enviado un email a su cuenta de correo indicando los detalles de sus suscripcion");
      $tpl="error.tpl";
      unset($usuario);
    }
    break;
} 

$smarty->cache_lifetime = 3600;	# 1 hr, 60 mins

if(!$smarty->is_cached($tpl,$cache_pattern)) {
  # Encuesta
  include_once ('./encuesta.inc.php');
  # Blogs
  include_once ('./blogs.inc.php');
  $dolar = new dolarTable;
  $dolar->readEnv();
  $cambio_actual = $dolar->getVar("SELECT oficial FROM dolar WHERE iddolar = (SELECT MAX(iddolar) FROM dolar)");
}



$username = "aporrasr201";
$smarty->assign("user", $username);
$orderid = (string)$_SESSION['idusuario'];
$smarty->assign("orderid", $orderid);
$nica_time = time();
$time = (string)$nica_time;
$amount = round(30 * $cambio_actual) . ".00";
$smarty->assign("amount",$amount);
$smarty->assign("time", $time);
$key_id = (string)70320993;
$key = "BAh61foJLpKksJX1dAY6GIGiFEH8lXDz";
$smarty->assign("key",$key_id);
$cadena = $orderid .'|'. $amount .'|'. $time .'|'. $key;
$hash = md5($cadena);
$smarty->assign("hash", $hash);

$credomatic_request= "username:".$username."|orderid:".$orderid."|keyid:".$key_id."|hash:".$hash."|time:".$time."|amount:".$amount ;
error_log("datos enviados: ".$credomatic_request);
//# echo $orderid . '<br/>' . $amount . '<br/>' . $hash . '<br/>' . $time;

$smarty->display($tpl,$cache_pattern);

