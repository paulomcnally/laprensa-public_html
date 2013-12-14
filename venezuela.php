<?php
require('../classes/app.class.php');
define('VENEZUELA',true);

$tpl = "elecciones-venezuela-2013/venezuela.tpl";
$smarty->assign('title', 'Venezuela');

$smarty->display($tpl);
?>
