<?php
require("../classes/app.class.php");

$user = new usuarioTable;
$user->readEnv();
/*
$id = (int)$_REQUEST['id'];
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
//$user->execSQL("UPDATE usuario SET direccion = '" . $dir . "', telefono = " . $telefono . ", departamento = '" . $depto . "', suscriptor = 't', periodosuscripcion = '" . $periodo . "'  WHERE idusuario = " . $id);
$user->request['periodosuscripcion'] = $periodo;
$user->request['suscriptor'] = true;
$user->request['usuario'] = -1;
$user->request['clave'] = -1;
$user->request['openid'] = -1;
$user->request['openidurl'] = -1;
error_log("FIXME $id /  " . $user->request['nombre'] );
$id = $user->updateRecord();
