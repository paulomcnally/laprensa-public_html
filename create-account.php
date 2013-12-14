<?php
session_start();
require("../classes/app.class.php");

$user = new usuarioTable;
$user->readEnv();
/*
$nombre = (string)$_REQUEST['nombre'];
$apellido = (string)$_REQUEST['apellido'];
$email = (string)$_REQUEST['email'];
$dir = (string)$_REQUEST['direccion'];
$depto = (string)$_REQUEST['departamento'];
$telefono = (int)$_REQUEST['telefono'];
$renovacion = $_REQUEST['renov'];
*/
unset($_SESSION['renovacion']);

if ($renovacion == 1) {
    $_SESSION['renovacion'] = 'true';
} elseif($renovacion == 0) { 
    $_SESSION['renovacion'] = 'false';
}

switch($_REQUEST['periodosus']){
case '2100.00': $periodo = 'Anual';
         break;
case '1150.00': $periodo = 'Semestral';
         break;
case '600.00': $periodo = 'Trimestral'; 
         break;
}
//$user->execSQL("INSERT INTO usuario (nombre, apellido, correo, direccion, departamento, telefono, suscriptor, periodosuscripcion) VALUES ('" . $nombre . "','" . $apellido . "', '" . $email . "','" . $dir . "', '" . $depto . "'," . $telefono . ", 't','" . $periodo . "')");
$user->request['periodosuscripcion'] = $periodo;
$user->request['suscriptor'] = true;
$user->request['usuario'] = -1;
$user->request['clave'] = -1;
$user->request['openid'] = -1;
$user->request['openidurl'] = -1;
error_log("FIXME $id /  " . $user->request['nombre'] );
$id = $user->addRecord();
$row = $user->readRecord($id);

if($row){
   $_SESSION["idusuario"] = $row["idusuario"];
   $_SESSION["apellido"] = $row["apellido"];
   $_SESSION["usuario"] = $row["usuario"];
   $_SESSION["nombre"] = $row["nombre"];
   $_SESSION["correo"] = $row["correo"];
   $_SESSION['periodosuscripcion'] = $row['periodosuscripcion'];
}
