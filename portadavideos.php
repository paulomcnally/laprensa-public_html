<?php
$video = new coleccionvideoTable();
$video->limit=1;
$rows = $video->readDataSql("SELECT coleccionvideo.texto,coleccionvideo.idcoleccionvideo,videominoticia.archivovideo,videominoticia.idvideominoticia,videominoticia.videominoticia FROM coleccionvideo,galeriavideo, videominoticia WHERE galeriavideo.idgaleriavideo = coleccionvideo.idgaleriavideo AND videominoticia.idvideominoticia = coleccionvideo.idvideominoticia AND galeriavideo.idgaleriavideo = coleccionvideo.idgaleriavideo AND galeriavideo.activa IS TRUE");

$smarty->assign("vids", $rows);
?>
