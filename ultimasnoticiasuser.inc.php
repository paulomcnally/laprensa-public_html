<?php
#ultimas noticias de los lectores

$smarty->cache_lifetime = 3600;

/*if(OCD){
  $ojociudadano = new ojociudadanoTable();
  $masojo = $ojociudadano->readDataSql("SELECT * FROM ojociudadano WHERE idojociudadano <> " . $_REQUEST['idojociudadano']);
  $smarty->assign("masciudadania", $masojo);
}*/

include('portadavideos.php');

$noticias = new minoticiaTable();
$noticias->limit = 5;
$noticias->order="idminoticia DESC";
$noticiasdestacadas = $noticias->readDataFilter("minoticia.estado='A' AND  ubicacion IS NULL");

$smarty->assign("noticiasdest", $noticiasdestacadas);
?>
