<?php
include ('../classes/app.class.php');
require_once "XML/RSS.php";

# Encabezado
$idedicion = date("Y-m-d");
include ('../classes/header.inc.php');

# 1er Parte - Destacados - 5 mins
$smarty->cache_lifetime = 300;	# 5 mins
if(!$smarty->is_cached('buscador.tpl')) {
  # Edicion
  if(!isset($edicion))  {
    $edicion = new edicionTable();
    list($row) = $edicion->readDataFilter("edicion = '$idedicion' AND estado = 'A'");
    $smarty->assign('edicion',$row);
    unset($row);
  }
  # Encuestas
  $encuesta = new encuestaTable();
  $encuesta->limit = 1;
  $surveys = $encuesta->readDataFilter("'$idedicion' BETWEEN fecha_ini::date AND fecha_fin::date");
  $smarty->assign('encuestas',$surveys);
  # Blogs de portada  - Columna derecha - wordpress LP
  $rss =& new XML_RSS("http://www.laprensa.com.ni/blog/feed");
  $rss->parse();
  $i = 0;
  foreach ($rss->getItems() as $item) {
    $i++;
    $der_blogs[] =  array('link'=>$item['link'], 'title'=>$item['title'], 'description'=>$item['description'], 'url'=>getImgs($item['content:encoded'],true),'autor'=>$item['dc:creator'],'fecha'=>$item['pubdate']);
    if ($i>=3) break;
  }
  $smarty->assign('der_blogs', $der_blogs);
  # Fin Blogs
  # Tags
  include_once ('../classes/tags.inc.php');
}
$smarty->display('buscador.tpl');
# End 1er Parte

# Pie de Página
include ('../classes/footer.inc.php');
?>
