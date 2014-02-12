<?php
require('/var/www/html/laprensa/classes/app.class.php');
session_start();
include_once '/var/www/html/laprensa/public_html/securimage/securimage.php';
$securimage = new Securimage();
$encuesta = new encuestapicTable();
$idencuesta = (int)$_POST['idencuestapic'];
$estado = $encuesta->getVar("SELECT cerrada FROM encuestapic WHERE idencuestapic = " . $idencuesta);
if (empty($_POST['captcha_code'])) {
    error_log("Error CAPTCHA: Codigo vacio, no se introdujo ninguno.");
    echo -1;
} elseif ($securimage->check($_POST['captcha_code']) == false) {
    error_log("Error CAPTCHA: Codigo ".$_POST['captcha_code']." equivocado, los captcha no coinciden: " . $_SESSION['securimage_code_value']);
    echo 0;
} elseif ($estado == 't'){
    echo 3;
} else {
    if ($_POST['idopcionespic'] != 'undefined')   {
        $foto = new opcionespicTable();
        $foto->execSql("UPDATE opcionespic SET votos = votos + 1 WHERE idopcionespic = " . $_POST['idopcionespic']);
    }
    unset($foto);
}
?>
