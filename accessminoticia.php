<?php
require("../classes/app.class.php");
define(LOGINMN,true);
define ('ACCESS',true);
$uri = $_REQUEST["opt"];
#session_start();
if ( !empty($_POST['captcha_code']) ) $_POST['captcha_code'] = str_replace(' ','',trim($_POST['captcha_code']));

# Para el CAPTCHA
include_once('./securimage/securimage.php');

$tpl="minoticia/access.tpl";
$usuario=new usuarioTable();

if(isset($_SESSION["idusuario"]) && !empty($_SESSION["idusuario"])){
  $smarty->assign($usuario->readRecord($_SESSION["idusuario"]));
}

switch($_REQUEST["opt"]){
  case "check":
    $usuario->readEnv();
    list($row) = $usuario->readDataFilter("usuario.usuario = '" . $usuario->request['usuario'] . "' AND usuario.clave = '".$usuario->request['clave']."' AND usuario.activo");
    if($row) {
      $_SESSION["idusuario"] = $row["idusuario"];
      $_SESSION["apellido"] = $row["apellido"];
      $_SESSION["usuario"] = $row["usuario"];
      $_SESSION["nombre"] = $row["nombre"];
      $_SESSION["correo"] = $row["correo"];
      header("Location: /minoticia/enviarnoticia");
    } else {
      header("Location: /minoticia/entrar?_e=1");
    }
    die();
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
      error_log("Error EMAIL: Direcci√≥n de Correo Electronica no es v√°lida");
      $smarty->assign("msg","Error EMAIL: Direcci√≥n de Correo Electronica no es v√°lida");
      $_REQUEST["opt"]="viewform";
    } else {
      $usuario=new usuarioTable();
      $_REQUEST['correo'] = trim($_REQUEST['correo']);
      $_REQUEST['usuario'] = trim($_REQUEST['usuario']);
      $usuario->readEnv();
      $rows=$usuario->readDataFilter("usuario.correo ilike '".$usuario->request["correo"]."' OR usuario.usuario ilike '".$usuario->request['usuario']."'");
      if(count($rows)>0) {
        $smarty->assign("msg","Error Registro: Ya existe una cuenta con informacion similar");
        $_REQUEST["opt"]="viewform";
      } else {
        $usuario->addRecord();
        list($row) = $usuario->readDataFilter("usuario.correo ILIKE '" . $usuario->request['correo'] . "'");
        $to = $_REQUEST['correo'];
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
          Una vez que active la cuenta, usted podra acceder a nuestro sitio web sin ningun inconveniente. El c√≥digo vence ' . date("d/m/Y H:i",(strtotime($row['creacion']) + (7 * 24 * 60 * 60))) . ', despues de vencerse, se eliminara la cuenta.
          <br />
          ' . $lista . '<br/><br/>
          Saludos,<br/>
          ' . URL . ' - 
          info@laprensa.com.ni<br/>
          </div>';
        $subject = 'Codigo de Activacion';
        $subject = preg_replace('/√∫/','u',$subject);
        $subject = preg_replace('/&uacute;/','u',$subject);
        $headers = 'From: info@laprensa.com.ni' . "\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
        mail($to, $subject, $strHTML, $headers);
        $smarty->assign("msg","Sus Datos han sido agregados. Se ha enviado un email a su cuenta de correo para activar su acceso a LA PRENSA .com.ni");
        $tpl="minoticia/errormn.tpl";
      }
      unset($usuario);
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
      $smarty->assign("msg","Sus Datos han sido modificados /  LA PRENSA .com.ni");
      $tpl="minoticia/errormn.tpl";
    }
    break;
  case 'remind_passwd':
    $tpl = 'minoticia/remind_passwd.tpl';
    if(!empty($_POST) && !(empty($_POST['usuario'])||empty($_POST['captcha_code']))) {
      include_once 'securimage/securimage.php';
      $securimage = new Securimage();
      if ($securimage->check($_POST['captcha_code']) == false) {
        $E_str = "Error CAPTCHA: Los captcha no coinciden.";
        error_log("Formulario Recordar Contrase√±a - $E_str");
        $smarty->assign('error_msg', $E_str);
      } else {
        # Valid if user exists
        $user = new usuarioTable();
        $user->readEnv();
        $user->limit = 1;
        list($row) = $user->readDataFilter("usuario = '" . $user->request['usuario'] . "' OR correo = '" . $user->request['usuario'] . "'");
        if(isset($row)&&!empty($row['correo'])) {
          if ( !checkEmail($row['correo']) ) {
            error_log("Error EMAIL: Direcci√≥n de Correo Electronica no es v√°lida");
            $smarty->assign("error_msg","Error EMAIL: Direcci√≥n de Correo Electronica no es v√°lida");
          } else {
            $passwd = generatePassword();
            $strHTML = '<div style=\'font-size:12px;font-family:"Lucida Grande", Verdana, Arial, "Bitstream Vera Sans", sans-serif\'>Hola ' . $row['nombre'] . (!empty($row['apellido'])?' ' . $row['apellido']:'') . ',
            <br /><br />
            Alguien, probablemente tu, ha solicitado restablecer la contrase√±a:
            <br /><br />
            <b>Sitio Web:</b> '. URL .'<br /><b>Nombre de Usuario:</b> ' . $row['usuario'] . '<br/ ><b>Nueva Contrase√±a:</b> ' . $passwd . '<br /><br />Saludos Cordiales';
            $user->execSql("UPDATE usuario SET clave = md5('" . $passwd . "'),activo = true WHERE idusuario = " . $row['idusuario']);
            $to = $row['correo'];
            $subject = 'Restablecer Contrase√±a';
            $subject = preg_replace('/ú/','u',$subject);
            $subject = preg_replace('/&uacute;/','u',$subject);
            $headers = 'From: noreplay@laprensa.com.ni' . "\r\n";
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
            mail($to, $subject, $strHTML, $headers);
            $smarty->assign('redirect', URL . '/minoticia/lostpasswd?action=sentreminder');
            $smarty->display('redirect.tpl');
            die();
          }
        } else {
          error_log("Error EMAIL: La direcci√≥n o usuario no existe en la base de datos");
        }
      }
    } elseif(!empty($_POST)) {
      $smarty->assign('error_msg','Todos los campos son requeridos');
    }
    break;
} 

include ('../classes/header-minoticia.inc.php');
$smarty->cache_lifetime = 3600;	# 1 hr, 60 mins

if(!$smarty->is_cached($tpl,$cache_pattern)) {
  $noticia = new minoticiaTable;
  $pagina = new paginaTable;
  $portada = $noticia->readDataFilter("estado = 'A'");
  $smarty->assign("noticiasportada", $portada);
  $smarty->assign("enunciadogaleria",$pagina->readRecord(8));
  include_once ('./ultimasnoticiasuser.inc.php');
}

$smarty->display($tpl,$cache_pattern);
$smarty->display('minoticia/ultimasnoticiasuser.inc.tpl', $cache_pattern);
include ('../classes/footer.inc.php');
?>
