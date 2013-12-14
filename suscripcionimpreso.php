<?php
require("../classes/app.class.php");
$smarty->caching = false;

define ('SUSCRIPCION',true);
$uri = $_REQUEST["opt"];
session_start();

if (empty($_SESSION['idusuario']) || $_SESSION['idusuario'] === '') {
    $registrado = false; 
} else {
    $registrado = true;    
}

# Para el CAPTCHA
include_once('./securimage/securimage.php');

$tpl = "susimpreso.tpl";
include('../classes/header.inc.php');

$smarty->cache_lifetime = 3600;	# 1 hr, 60 mins

if (!$smarty->is_cached($tpl,$cache_pattern)) {
    # Encuesta
    include_once ('./encuesta.inc.php');
    # Blogs
    include_once ('./blogs.inc.php');
}

$username  = "aporrasr201";
$smarty->assign("user", $username);
$orderid   = (string)$_SESSION['idusuario'];
$smarty->assign("orderid", $orderid);
$nica_time = time();
$time      = (string)$nica_time;
$amount    = "30.00";
$smarty->assign("time", $time);
$key_id    = (string)70320993;
$key       = "BAh61foJLpKksJX1dAY6GIGiFEH8lXDz";
$smarty->assign("key",$key_id);
$cadena    = $orderid .'|'. $amount .'|'. $time .'|'. $key;
$hash      = md5($cadena); 
$smarty->assign("hash", $hash);
$smarty->assign("registrado", $registrado);

$smarty->display($tpl,$cache_pattern);

include ('../classes/footer.inc.php');
