<?php
session_start();
require("../classes/app.class.php");
include("../classes/header.inc.php");

$response = $_REQUEST['response'];
$usuario=new usuarioTable();

if($_SESSION['renovacion'] === 'true'){
    $mensaje_renovacion = 'Renovacion de suscripci&oacute;n';    
} else {
    $mensaje_renovacion = 'Nueva suscripci&oacute;n'; 
}
error_log("userid: ".$_SESSION['idusuario']);
error_log(print_r($_GET,1));

switch ($response){
case 1: $mensaje="La trasaccci&oacute;n ha sido exitosa!!";
      list($row) = $usuario->readDataSql("SELECT * FROM usuario  WHERE usuario.idusuario=" . $_SESSION['idusuario'] . " ORDER BY usuario.creacion DESC");
      if(!empty($row['correo']) && !empty($row['nombre'])) {
        $to = 'collado@laprensa.com.ni, valeria.mayorga@laprensa.com.ni, juan.martinez@laprensa.com.ni, silvio.vega@laprensa.com.ni';
        $lista="";
        $strHTML = '
          <div style="text-align:left;font-size:11px;font-family:Arial, sans-serif">
          <br />
          <br />
          <h1 style="font-size:14px;color:#666;margin:0;padding:0;">Confirmaci&oacute;n de Suscripci&oacute;n al Impreso</h1>
          <br />
          El usuario.' . $row['nombre'] . ' ' . $row['apellido'] . ', ha realizado el pago en linea de Suscripci&oacute;n al Impreso
          <br />
	  Departamento: ' . $row['departamento'] .' ' .' <br />
	  Tel&eacute;fono: ' . $row['telefono'].' ' .' <br />
	  Direcci&oacute;n: ' . $row['direccion'].' '.'<br />
	  ' . $mensaje_renovacion.' '.'<br /> 
          Fecha de creacion: '.$row['creacion'].' , Periodo de la suscripcion: '.$row['periodosuscripcion'].'
          <br />
          Direccion de correo asociada al usuario *' . $row['correo'] . '*
          <br />
          <br />
          <br />
          <br />
          Por favor Guardar estos correos como soporte de la suscripcion al Impreso
          <br />
          Saludos,<br/>
          info@laprensa.com.ni<br/>
          </div>';
        $subject = 'Suscripcion Nueva al Impreso';
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
          <h1 style="font-size:14px;color:#666;margin:0;padding:0;">Confirmaci&oacute;n de Suscripci&oacute;n al Impreso</h1>
          <br/>
          Se ha enviado un correo a nuestro personal para guardar un respaldo de la transaccion realizada, No se guarda datos de la tarjeta!
          <br />
          <h3>Datos de la suscripcion</h3>
          <br/>
          Nombres: ' . $row['nombre'] . ' ' . $row['apellido'] . ',  
          <br />
          Fecha de creacion: '.$row['creacion'].' , Periodo de la suscripcion: '.$row['periodosuscripcion'].'
          <br />
          Departamento: ' . $row['departamento'] .' ' .' <br />
          Tel&eacute;fono: ' . $row['telefono'].' ' .' <br />
          Direcci&oacute;n: ' . $row['direccion'].' '.'<br />
          ' . $mensaje_renovacion.' '.'<br />
	  Direccion de correo asociada al usuario *' . $row['correo'] . '*
          <br />
          <br />
          <br />
          <br />
          <br />
          Saludos,<br/>
          ' . URL . ' -
          info@laprensa.com.ni<br/>
          </div>';
          $subject = 'Suscripcion Nueva al Impreso';
          $subject = preg_replace('/&uacute;/','u',$subject);
          $headers = 'From: info@laprensa.com.ni' . "\r\n";
          $headers .= 'MIME-Version: 1.0' . "\r\n";
          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
          mail($to, $subject, $strHTML, $headers);
      }else{
      echo "No hay nada que hacer";
	}
      $smarty->assign("msg","Sus Datos han sido agregados. Se ha enviado un email a su cuenta de correo indicando los detalles de sus suscripcion");
      $tpl="error.tpl";
      unset($usuario);
        break;

case 2: $mensaje="La transacci&oacute;n ha sido denega";
        $num_error = 2;
        #$id = $usuario->getVar("SELECT MAX(idusuario) from usuario");
        #$usuario->execSQL("DELETE FROM usuario WHERE idusuario = " . $id);
        $_SESSION = array(); 
        break;
case 3: $mensaje="Error en datos de la transacci&oacute;n o error en el sistema";
        #$id = $usuario->getVar("SELECT MAX(idusuario) from usuario");
        #$usuario->execSQL("DELETE FROM usuario WHERE idusuario = " . $id);
        $_SESSION = array();
        $num_error = 3;
 break;

}

$smarty->assign('n_error', $num_error);
$smarty->assign('mensaje',$mensaje);
$smarty->display("recibir_suscripcion.tpl");
include ('../classes/footer.inc.php');
?>
