<?php
require('../classes/app.class.php');
require('../classes/header.inc.php');

$data = new ppoliticoTable;
$data->readEnv();

if ($data->request['idppolitico']) {
  $row = $data->readRecord();
  $smarty->assign('row',$row);
} else {
  $rows = $data->readData();
  $smarty->assign('rows',$rows);
}
   
    # Encuesta
    include_once ('./encuesta.inc.php');
    # Blogs
    include_once ('./blogs.inc.php');
    # Tags
    include_once ('./tags.inc.php');
  
$smarty->display("candidato.tpl", $data->request['idppolitico']);

require('../classes/footer.inc.php');
