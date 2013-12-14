<?php
require("../classes/app.class.php");

if ($_REQUEST['_c'] && $_REQUEST['_cs']) {
   $usuario=new usuarioTable();
   list($row) = $usuario->readDataFilter("md5(usuario.idusuario::text) = '" . $usuario->database->escape($_REQUEST['_c']) ."' AND md5(usuario.correo) = '" . $usuario->database->escape($_REQUEST['_cs']) . "'");
   if($row) {
     $smarty->assign('cliente',$row);
     if($row['activo']=='t') {
       $smarty->assign('verify',true);
     } else {
       $usuario->database->query("UPDATE usuario SET activo = true WHERE md5(idusuario::text) = '" . $usuario->database->escape($_REQUEST['_c']) . "'");
       $tpl = 'activar.tpl';
     }
     header("Location: /access.php?opt=auth");
     exit;
   }  else {
     $tpl="error.tpl";
     $smarty->assign("msg","Error : El codigo de activacion es invalido");
   }
}  else {
   $tpl="error.tpl";
   $smarty->assign("msg","Error : El codigo de activacion es invalido");
}

include ('../classes/header.inc.php');

# Encuesta
include_once ('./encuesta.inc.php');
# Blogs
include_once ('./blogs.inc.php');

$smarty->display($tpl);
include ('../classes/footer.inc.php');
