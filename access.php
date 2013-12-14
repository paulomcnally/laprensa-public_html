<?php
require("../classes/app.class.php");

define ('ACCESS',true);
$smarty->caching = 0;
$uri = $_REQUEST["opt"];
if ( !empty($_POST['captcha_code']) ) $_POST['captcha_code'] = str_replace(' ','',trim($_POST['captcha_code']));

# Para el CAPTCHA
include_once('./securimage/securimage.php');

$tpl="access.tpl";
$usuario=new usuarioTable();
$usuario->readEnv();

if(isset($_SESSION["idusuario"]) && !empty($_SESSION["idusuario"])){
  header("Location: /magazine");
  #$smarty->assign($usuario->readRecord($_SESSION["idusuario"]));
}

# openid return_to...
require 'openid.php';
$openid = new LightOpenID('www.laprensa.com.ni');
if($openid->mode) {
    error_log('FIXME: openid here we go...');
    if($openid->mode == 'cancel') {
        echo 'User has canceled authentication!';
        error_log('FIXME: User has canceled authentication!');
    } else {
        error_log('FIXME: User ' . ($openid->validate() ? $openid->identity . ' has ' : 'has not ') . 'logged in.');
	error_log("Atributos ".$openid->identity);
        if ($openid->validate()) { 
            error_log('usuario validado');
            $usuario->request['openid'] = pg_escape_string($openid->identity);
            list($row) = $usuario->readDataFilter("usuario.openid = '" . $usuario->request['openid'] . "' AND usuario.activo");
            $_REQUEST['opt'] = ($row ? 'check' : 'addopenid');
            error_log('con request opt='.$_REQUEST['opt']);
        }
    }
}
#if(empty($usuario->request['openid'])){
#	unset( $usuario->request['openid']);
#}

switch($_REQUEST["opt"]){
  case "check":
    if ($usuario->request['openidurl']) {
        if(!$openid->mode) {
            $openid->identity = $usuario->request['openidurl'];
            error_log('FIXME: Location: ' . $openid->authUrl());
            header('Location: ' . $openid->authUrl());
            exit();
        }
    } elseif ($usuario->request['openid']) {
      list($row) = $usuario->readDataFilter("usuario.openid = '" . $usuario->request['openid'] . "' AND usuario.activo");
    } else {
      list($row) = $usuario->readDataFilter("usuario.usuario = '" . $usuario->request['usuario'] . "' AND usuario.clave = '".$usuario->request['clave']."' AND usuario.activo");
    }
    if($row) {
      $_SESSION["idusuario"] = $row["idusuario"];
      $_SESSION["apellido"] = $row["apellido"];
      $_SESSION["usuario"] = $row["usuario"];
      $_SESSION["nombre"] = $row["nombre"];
      $_SESSION["correo"] = $row["correo"];
      if(isset($_REQUEST["refer"]) && !empty($_REQUEST["refer"]))
        header("Location: /".$_REQUEST["refer"]);
      else
        header("Location: /");
    } else {
      header("Location: /entrar?_e=1");
    }
    exit();
    break;
  case "addopenid_post":
      if (empty($usuario->request['nombre']) || empty($usuario->request['apellido'])) {
        $smarty->assign("msg","Error: No debe dejar los campos vac&iacute;os.");
      } else {
        $usuario->request['activo'] = '1';
        $usuario->addRecord();
        $smarty->assign("msg","Sus datos han sido agregados. Ahora tiene acceso a LA PRENSA .com.ni usando OpenID.<br />Si desea suscribirse a la revista Magazine usando su OpenID, haga clic <a href=\"/magaccess\">aqui</a>");
        $tpl="error.tpl";
        $_REQUEST["opt"]="add";
        list($row) = $usuario->readDataFilter("usuario.openid = '" . $usuario->request['openid'] . "' AND usuario.activo");
        $_SESSION["idusuario"] = $row["idusuario"];
        $_SESSION["apellido"] = $row["apellido"];
        $_SESSION["usuario"] = $row["usuario"];
        $_SESSION["nombre"] = $row["nombre"];
        $_SESSION["correo"] = $row["correo"];
      }
    break;
  case "addopenid":
      $smarty->assign('openid', $openid->identity);
    break;
  case "add":
    $securimage = new Securimage();
    if (empty($_POST['captcha_code'])) {
      error_log("Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
      $smarty->assign("msg","Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
      $_REQUEST["opt"]="viewform";
    } elseif ($securimage->check($_POST['captcha_code']) == false) {
      error_log("Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden.");
      $smarty->assign("msg","Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden.");
      $_REQUEST["opt"]="viewform";
    } elseif ( !checkEmail($_REQUEST['correo']) ) {
      error_log("Error EMAIL: Dirección de Correo Electronica no es válida");
      $smarty->assign("msg","Error EMAIL: Dirección de Correo Electronica no es válida");
      $_REQUEST["opt"]="viewform";
    } else {
      $_REQUEST['correo'] = trim($_REQUEST['correo']);
      $_REQUEST['usuario'] = trim($_REQUEST['usuario']);
      $usuario->readEnv();
      $rows=$usuario->readDataFilter("usuario.correo = '".$usuario->request["correo"]."' OR usuario.usuario = '".$usuario->request['usuario']."'");
      if(count($rows)>0) {
        $smarty->assign("msg","Error Registro: Ya existe una cuenta con informacion similar");
        $_REQUEST["opt"]="viewform";
      } else {
        $usuario->readEnv();
	if(empty($usuario->request['openid'])){
		unset( $usuario->request['openid']);
	}
	else{
		$new_openid= $usuario->request['openid'];
	}
        //#$usuario->addRecord();
	if(!isset($new_openid)){
		$usuario->readDataSQL("INSERT INTO usuario(nombre, apellido, correo, usuario, clave, openid) VALUES ('".$usuario->request['nombre']."','".$usuario->request['apellido']."','".$usuario->request['correo']."','".$usuario->request['usuario']."','".$usuario->request['clave']."',NULL)");
	}
	else{
		$usuario->readDataSQL("INSERT INTO usuario(nombre, apellido, correo, usuario, clave, openid, openidurl) VALUES ('".$usuario->request['nombre']."','".$usuario->request['apellido']."','".$usuario->request['correo']."','".$usuario->request['usuario']."','".$usuario->request['clave']."','".$new_openid."','".$usuario->request['openidurl']."')");
	}
        list($row) = $usuario->readDataFilter("usuario.correo = '" . $usuario->request['correo'] . "'");
        $to = $_REQUEST['correo'] . ', eenriquez@laprensa.com.ni, fabian.medina@laprensa.com.ni, mauricio.urroz@laprensa.com.ni, valeria.mayorga@laprensa.com.ni';
        $lista="";
        if($row['lista']) {
          $lista="Te has suscrito a la lista de correo de la prensa, en breve recibiras un correo de confirmacion.";
        }
        $strHTML = '
          <div style="text-align:left;font-size:11px;font-family:Arial, sans-serif">
          <br />
          <br />
          <h1 style="font-size:14px;color:#666;margin:0;padding:0;">Activacion de Cuenta</h1>
          <br />
          Estimado Sr./Sra.' . $row['nombre'] . ' ' . $row['apellido'] . ',
          <br />
          <br />
          Tu nueva cuenta asociada a la direccion *' . $row['correo'] . '* ha sido creada, sin embargo para poder ser usada es necesario que sea activada.
          <br />
          <br />
          Para activarla, por favor ir a <a href="' . URL . '/activar.php?_c=' . md5($row['idusuario']) . '&_cs=' . md5($row['correo']) . '&_l=' . urlencode($row['correo']) . '">' . URL . '/activar?_c=' . md5($row['idusuario']) . '&_cs=' . md5($row['correo']) . '&_l=' . urlencode($row['correo']) . '</a>
          <br />
          <br />
          Tu codigo de activacion es: ' . md5($row['idusuario']) . '
          <br />
          <br />
          Una vez que active la cuenta, usted podra acceder a nuestro sitio web sin ningun inconveniente. El código vence ' . date("d/m/Y H:i",(strtotime($row['creacion']) + (7 * 24 * 60 * 60))) . ', despues de vencerse, se eliminara la cuenta.
          <br />
          ' . $lista . '<br/><br/>
          Saludos,<br/>
          ' . URL . ' - 
          info@laprensa.com.ni<br/>
          </div>';
        $subject = 'Codigo de Activacion';
        $subject = preg_replace('/ú/','u',$subject);
        $subject = preg_replace('/&uacute;/','u',$subject);
        $headers = 'From: info@laprensa.com.ni' . "\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";

	$idusuario = $usuario->getVar("SELECT idusuario from usuario where usuario='".$usuario->request['usuario']."' limit 1");

	if(!empty($idusuario)){
		//if(isset($_REQUEST["magazinecheck"]) &&  $_REQUEST["magazinecheck"] == 'Yes'){
		   $update = $usuario->execSql("UPDATE usuario SET activo = true  where idusuario = " . $idusuario);
		   $_SESSION["idusuario"] = $idusuario;
		   $_SESSION['sus_magazine']=1;
		    header ("Location: /magaccess.php?opt=view");
		    exit();
		 /*}
		mail($to, $subject, $strHTML, $headers);
		$smarty->assign("msg","Sus datos han sido agregados. Se ha enviado un email a su cuenta de correo para activar su acceso a LA PRENSA .com.ni");
		$tpl="error.tpl";
		if(isset($_REQUEST['impresocheck']) && $_REQUEST['impresocheck'] == 'yes'){
		    $_SESSION['sus_impreso'] = 1;
		    header("Location: /suscripcionimpreso.php?opt=view");
		    exit();
		}*/

	}
	else{
		$smarty->assign("msg","No se han posdido registrar sus datos, intentelo mas tarde... gracias");
		$tpl="error.tpl";
	}
       }
      #unset($usuario);
    }    
    break;
  case "edit":
    $securimage = new Securimage();
    if (empty($_POST['captcha_code'])) {
      error_log("Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
      $smarty->assign("msg","Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
    } elseif ($securimage->check($_POST['captcha_code']) == false) {
      error_log("Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden.");
      $smarty->assign("msg","Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden.");
      $_REQUEST["opt"]="viewform";
    } else {
      $usuario->readEnv();
      $usuario->updateRecord();
      $smarty->assign("msg","Sus datos han sido modificados /  LA PRENSA .com.ni");
      $tpl="error.tpl";
    }
    break;
  case 'remind_passwd':
    $tpl = 'remind_passwd.tpl';
    if(!empty($_POST) && !(empty($_POST['usuario'])||empty($_POST['captcha_code']))) {
      include_once 'securimage/securimage.php';
      $securimage = new Securimage();
      if ($securimage->check($_POST['captcha_code']) == false) {
        $E_str = "Error CAPTCHA: Los captcha no coinciden.";
        error_log("Formulario Recordar Contraseña - $E_str");
        $smarty->assign('error_msg', $E_str);
      } else {
        # Valid if user exists
        $user->readEnv();
        $user->limit = 1;
        list($row) = $user->readDataFilter("usuario = '" . $user->request['usuario'] . "' OR correo = '" . $user->request['usuario'] . "'");
        if(isset($row)&&!empty($row['correo'])) {
          if ( !checkEmail($row['correo']) ) {
            error_log("Error EMAIL: Dirección de Correo Electronica no es válida");
            $smarty->assign("error_msg","Error EMAIL: Dirección de Correo Electronica no es válida");
          } else {
            $passwd = generatePassword();
            $strHTML = '<div style=\'font-size:12px;font-family:"Lucida Grande", Verdana, Arial, "Bitstream Vera Sans", sans-serif\'>Hola ' . $row['nombre'] . (!empty($row['apellido'])?' ' . $row['apellido']:'') . ',
            <br /><br />
            Alguien, probablemente tu, ha solicitado restablecer la contraseña:
            <br /><br />
            <b>Sitio Web:</b> '. URL .'<br /><b>Nombre de Usuario:</b> ' . $row['usuario'] . '<br/ ><b>Nueva Contraseña:</b> ' . $passwd . '<br /><br />Saludos Cordiales';
            $user->execSql("UPDATE usuario SET clave = md5('" . $passwd . "'),activo = true WHERE idusuario = " . $row['idusuario']);
            $to = $row['correo'];
            $subject = 'Restablecer Contraseña';
            $subject = preg_replace('/ú/','u',$subject);
            $subject = preg_replace('/&uacute;/','u',$subject);
            $headers = 'From: noreplay@laprensa.com.ni' . "\r\n";
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
            mail($to, $subject, $strHTML, $headers);
            $smarty->assign('redirect', URL . '/lostpasswd?action=sentreminder');
            $smarty->display('redirect.tpl');
            die();
          }
        } else {
          error_log("Error EMAIL: La dirección o usuario no existe en la base de datos");
        }
      }
    } elseif(!empty($_POST)) {
      $smarty->assign('error_msg','Todos los campos son requeridos');
    }
    break;
} 

include ('../classes/header.inc.php');
$smarty->cache_lifetime = 3600;	# 1 hr, 60 mins

if(!$smarty->is_cached($tpl,$cache_pattern)) {
  # Encuesta
  include_once ('./encuesta.inc.php');
  # Blogs
  include_once ('./blogs.inc.php');
}

$smarty->display($tpl,$cache_pattern);

include ('../classes/footer.inc.php');
