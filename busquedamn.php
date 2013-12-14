<?php
require("../classes/app.class.php");
define('LOGIN', true);
$minoticia = new minoticiaTable();

$keyword = stripslashes($_REQUEST['buscar']);

$res = $minoticia->readDataFilter("minoticia ILIKE '%" . $keyword . "%' OR texto ILIKE '%" . $keyword . "%' AND estado = 'A'");

$smarty->assign("res", $res);

include("../classes/header-minoticia.inc.php");

$smarty->assign("keywords", $keyword);
$smarty->display("minoticia/busquedamn.tpl");

$smarty->display("minoticia/ultimasnoticiasuser.inc.tpl");
include("../classes/footer.inc.php");
?>
