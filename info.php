<?php
include ('../classes/app.class.php');

$idinfografia = (int)$_REQUEST['idinfografia'];
$cache_pattern = 'infografia';
$smarty->cache_lifetime = 28800;	# 8 hrs, 480 mins
$cache_pattern .= "|$idinfografia";

$tpl = 'info.tpl';
if($idinfografia) {
  if(!$smarty->is_cached($tpl,$cache_pattern)) {
    $info = new infografiaTable();
    $info->readEnv();
    $row = $info->readRecord();
    $smarty->assign('infografia',$row);
  }
} else {
  header("Location: /"); die();
}

$smarty->display($tpl,$cache_pattern);
?>
