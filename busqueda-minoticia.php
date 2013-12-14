<?php
require("../classes/app.class.php");
$keyword = $_POST['buscar'];

$noticia = new noticiaTable;
$tpl = "minoticia/busqueda-minoticia.tpl";
include("../classes/header-minoticia.inc.php");

$sql = "SELECT minoticia FROM minoticia WHERE minoticia.minoticia ILIKE '%" . $keyword . "%' OR minoticia.texto ILIKE '%" . $keyword . "%'";
//$rows = $noticia->readDataSql($sql);
$news = $noticia->readData();
$smarty->cache_lifetime = 3600;

if(!$smarty->is_cached($tpl)) {
  include_once ('ultimasnoticiasuser.inc.php');
}

if($keyword == ''){
  $smarty->assign("keys","No especifico ning&uacute;n t&eacute;rmino de b&uacute;squeda");
}else{
  $smarty->assign("keys",$keyword);
  $smarty->assign("noticias", $news);
}

$smarty->clear_cache($tpl);
$smarty->display($tpl);

include ("../classes/footer.inc.php");
?>
