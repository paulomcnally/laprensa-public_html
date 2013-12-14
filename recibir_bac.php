<?php
session_start();
require("../classes/app.class.php");
$smarty->caching = false;
include("../classes/header.inc.php");

//#$response = $_REQUEST['response'];

$response = (int)$_REQUEST['response'];
$success = false;

error_log("userid: ".$_SESSION['idusuario']);
error_log(print_r($_GET,1));

$usuarioperiodo=new usuarioperiodoTable();

$key = "BAh61foJLpKksJX1dAY6GIGiFEH8lXDz";

switch ($response){
case 1: $mensaje="La trasaccci&oacute;n ha sido exitosa!!";

	//validando que el hash sea correcto
	$hash=md5($_REQUEST['orderid']."|".$_REQUEST['amount']."|".$_REQUEST['response']."|".$_REQUEST['transactionid']."|".$_REQUEST['avsresponse']."|".$_REQUEST['cvvresponse']."|".$_REQUEST['time']."|".$key);
	if ($hash === $_REQUEST['hash']){
		$success = true;
	}
	else{
		$mensaje="La autenticidad de la respuesta no ha podido ser verificada";
		$num_error = 3;
	}
        error_log ("Hash- ". $hash);
        error_log ($mensaje);
        break;
case 2: $mensaje="La transacci&oacute;n ha sido denega";
        $num_error = 2;
        error_log ($mensaje);
        break;
case 3: $mensaje="Error en datos de la transacci&oacute;n o error en el sistema";
        $num_error = 3;
        error_log ($mensaje);
        break;
}
if($response===1 && $success ||  $response===5){
//if($response===1 && $success){
   $usuarioperiodo->readEnv();
   $usuarioperiodo->request['idusuario'] = $_SESSION['idusuario'];
   $usuarioperiodo->request['solicitado'] = 't';
   $usuarioperiodo->request['aprobado'] = 't';
   $usuarioperiodo->request['transactionid'] = $_REQUEST['transactionid'];
   $usuarioperiodo->request['ordenid'] = $_REQUEST['ordenid'];
   $usuarioperiodo->request['usuarioperiodo'] = '12';
   $usuarioperiodo->addRecord();
   //$update = $usuario->execSql("UPDATE usuarioperiodo SET aprobado = 't'  where idusuario = " . $_SESSION["idusuario"]);
   $usuarioperiodo->order="usuarioperiodo.creacion DESC";
   $usuarioperiodo->readEnv();
      list($row) = $usuarioperiodo->readDataSql("SELECT usuario.nombre,usuario.apellido,usuario.correo,usuarioperiodo.* FROM usuarioperiodo JOIN usuario USING(idusuario) WHERE usuarioperiodo.idusuario=" . $_SESSION['idusuario'] . " ORDER BY usuarioperiodo.creacion DESC");
      if(!empty($row['correo']) && !empty($row['nombre'])) {
        //  $to = 'ing-jmartinez@hotmail.es';
        $to = $row['correo'];
        #$to .= str_replace(array("\r\n", "\n", "\r"),',',MAGAZINE_EMAILS);
        $lista="";
        $strHTML = '
          <div style="text-align:left;font-size:11px;font-family:Arial, sans-serif">
          <br />
          <br />
          <h1 style="font-size:14px;color:#666;margin:0;padding:0;">Confirmacion de Suscripcion de MAGAZINE</h1>
          <br />
          El usuario.' . $row['nombre'] . ' ' . $row['apellido'] . ', ha realizado el pago en linea de la revista Magazine
          <br />
          Fecha de creacion: '.$row['creacion'].' , Periodo en meses: '.$row['usuarioperiodo'].'
          <br />
          Direccion de correo asociada al usuario *' . $row['correo'] . '*
          <br />
          Numbre de usuario asociado a la cuenta *' . $row['usuario'] . '*
          <br />
          <br />
          <br />
          Por favor Guardar estos correos para que sean de soporte de la suscripcion a MAGAZINE ONLINE
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
        $lp_soporte = str_replace(array("\r\n", "\n", "\r"),',',MAGAZINE_EMAILS);
        mail($lp_soporte, $subject, $strHTML, $headers);

        $to2 = $row['correo'];
	#$to2.=",juancarlos@guegue.net andres@guegue.net";
        #$to2 .= str_replace(array("\r\n", "\n", "\r"),',',MAGAZINE_EMAILS);
        $strHTML = '
   <div style="text-align:left;font-size:11px;font-family:Arial, sans-serif">
          <br />
          <br />
          <h1 style="font-size:14px;color:#666;margin:0;padding:0;">Confirmacion de Suscripcion en Linea de Magazine</h1>
          <br/>
          Se ha enviado un correo a nuestro personal para guardar un respaldo de la transaccion realizada, No se guarda datos de la tarjeta!
          <br />
          <h3>Datos de la suscripcion</h3>
          <br/>
          Nombres: ' . $row['nombre'] . ' ' . $row['apellido'] . ',  
          <br />
          Fecha de creacion: '.$row['creacion'].' , Periodo en meses: '.$row['usuarioperiodo'].'
          <br />
          Direccion de correo asociada al usuario *' . $row['correo'] . '*
          <br />
          Numero de Orden: ' . $_REQUEST['orderid'] .',  
          <br />
          Numero de transaccion: ' . $_REQUEST['transactionid'] .',  
          <br />
          <br />
          <br />
          Estimado usuario ya puede hacer uso de su cuenta de Magazine.
          <br />
          Saludos,<br/>
          ' . URL . ' -
          info@laprensa.com.ni<br/>
          </div>';
          $subject = 'Magazine - Nueva suscripcion Online';
          //$subject = preg_replace('/ú/','u',$subjecct));
          $subject = preg_replace('/&uacute;/','u',$subject);
          $headers = 'From: info@laprensa.com.ni' . "\r\n";
          $headers .= 'MIME-Version: 1.0' . "\r\n";
          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
          mail($to2, $subject, $strHTML, $headers);
          $lp_soporte_nueva = str_replace(array("\r\n", "\n", "\r"),',',MAGAZINE_EMAILS);
          mail($lp_soporte_nueva, $subject, $strHTML, $headers);
      }else{
      echo "No hay nada que hacer";
	}
      $smarty->assign("msg","Sus Datos han sido agregados. Se ha enviado un email a su cuenta de correo indicando los detalles de sus suscripcion");
      $tpl="error.tpl";
      unset($usuario);
}

$smarty->assign('n_error', $num_error);
$smarty->assign('mensaje',$mensaje);
$smarty->display("recibir_bac.tpl");

include ('../classes/footer.inc.php');

?>


