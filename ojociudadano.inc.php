<?php
$ojo = new ojociudadanoTable();
$ojo->order="creacion";

$rows = $ojo->readDataFilter("estado = 'A'");

for($i=0;$i<count($rows);$i++) {
    $rows[$i]['imgs'] = getImgs($rows[$i]['texto']);
}

$smarty->assign("ojociudadano", $rows);
?>
