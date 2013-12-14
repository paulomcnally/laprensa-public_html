<?php
$galerias = new galeriaminoticiaTable();
$galerias->readEnv();
$fotosgaleria = new galeriafotominoticiaTable();
$fotosgaleria->readEnv();
//$res = $galerias->readData();
$res = $galerias->readDataFilter("galeriaminoticia.estado = 'A'");
/*for($i=0; $i<count($res); $i++){
  $res[$i]['foto'] = $fotosgaleria->readDataFilter("galeriaminoticia.idgaleriaminoticia = " . $res[$i]['idgaleriaminoticia'] . " AND galeriaminoticia.estado = 'A'");
}*/

include('ojociudadano.inc.php');
$smarty->assign("galerias", $res);
?>
