<?php
 # Magazine
 $magazine = new magazineTable();
 $rows= $magazine->readDataFilter("edicion = '$idedicion'");
 $smarty->assign('magazine',$rows);
?>
