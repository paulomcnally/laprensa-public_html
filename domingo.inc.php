<?php
# Domingo
$domingo = new domingoTable();
$a = (strtolower(strftime("%a")));
if($a=='dom') {
  list($dom) = $domingo->readDataFilter("edicion = '$idedicion'");
  $smarty->assign('domingo',$dom);
} else {
  $ldom = date("Ymd",strtotime('last sunday'));
  $ldom_g = date("Y-m-d",strtotime('last sunday'));
  @require_once '../classes/domingo.class.php';
  if(in_array($ldom,$domingoList)) {
    list($rdom) = $domingo->readDataFilter("edicion = '$ldom_g'");
  }
  $smarty->assign('rdomingo',$rdom);
}
?>
