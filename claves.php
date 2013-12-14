<?php
require('../classes/app.class.php');

define('KEYWORDS',true);
$title = TITLE . '- Palabras Claves';
$clave_segura = preg_replace('/[^\da-z ]/i', '', $_REQUEST['clave']);
$title = 'LA PRENSA. Palabras Claves. ' . $clave_segura;
require('../classes/header.inc.php');
$tpl = 'claves.tpl';

if(!$smarty->is_cached($tpl,$cache_pattern)) {
  # Encuesta
  include_once ('./encuesta.inc.php');
  # Blogs de portada  - Columna derecha - wordpress LP
  include_once ('./blogs.inc.php');
  # Tags
  include_once ('./tags.inc.php');
  # End Common

  $timemark = strtotime($idedicion);
  $beginEdit = date("Y-m-d",mktime(0,0,0,date("m",$timemark),date("j",$timemark)-6));
  # Claves
  $noticia = new noticiaTable();
  $noticias = $noticia->readDataSql("SELECT noticia.idnoticia,noticia,resumen,texto,uri,edicion FROM noticia LEFT JOIN (SELECT idnoticia,lower(trim(regexp_split_to_table(trim(claves),','))) AS clave, count(*) AS total FROM noticia WHERE trim(claves) IS NOT NULL AND trim(claves) <> '' AND idedicion IN (SELECT idedicion FROM edicion WHERE edicion BETWEEN '$beginEdit' AND '$idedicion') GROUP BY idnoticia,clave ORDER BY clave,total DESC) AS tag USING (idnoticia) LEFT JOIN seccion USING (idseccion) LEFT JOIN edicion USING(idedicion) WHERE clave ILIKE '" . $noticia->database->escape($_REQUEST['clave']) . "'");
  $smarty->assign('noticias',$noticias);
}

$smarty->display($tpl,$cache_pattern);

include ('../classes/footer.inc.php');
