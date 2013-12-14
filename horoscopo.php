<?php
 require_once '../classes/app.class.php';
 if($_REQUEST['idedicion']) {
   list($year,$mon,$day)=split('-',$_REQUEST['idedicion']);
   $idedicion = $year.'-'.$mon.'-'.$day;
 }
 
 $horoscopos = new horoscopoTable;
 $horoscopos->readEnv();
 $signos = new signoTable;
 $signos->readEnv();
 $smarty->caching=0;
 if($idedicion)
   $horoscopo = $horoscopos->readDataFilter("edicion.edicion='$idedicion' AND horoscopo.idsigno=".(int)$_REQUEST["idsigno"]."");
 $smarty->assign("rowhoroscopo",$horoscopo[0]);
 $smarty->display("horoscopo.tpl");
?>
