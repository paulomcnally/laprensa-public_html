<?php
require('../classes/app.class.php');
require_once "XML/RSS.php";
require('../classes/thisedition.php');
define('SEARCH',true);
require('../classes/header.inc.php');
$tpl = 'busqueda.tpl';

if(!$smarty->is_cached($tpl,$cache_pattern)) {
  # Encuesta
  include_once ('./encuesta.inc.php');
  # Blogs de portada  - Columna derecha - wordpress LP
  include_once ('./blogs.inc.php');
  # Tags
  include_once ('./tags.inc.php');
  # End Common
  /*
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
  */
}
$smarty->display($tpl,$cache_pattern);

require('../classes/footer.inc.php');
?>
