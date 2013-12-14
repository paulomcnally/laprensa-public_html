<?php
require('../classes/app.class.php');
$noticiacomen = new noticiaTable();
$noticiacomen->readEnv();
$comentarios = $noticiacomen->readDataSQL("SELECT count(idcomentario) AS comentarios,idnoticia, noticia.noticia, edicion.edicion FROM comentario JOIN noticia USING(idnoticia) JOIN edicion USING (idedicion) WHERE edicion='$idedicion' AND comentario.estado = 'A' GROUP BY comentario.idnoticia, edicion, noticia ORDER BY comentarios DESC LIMIT 10");
print_r($comentarios);
?>
