<?php
require('../classes/app.class.php');
@require_once '../classes/domingo.class.php';

$smarty->caching = 0;

if(in_array($_REQUEST['iddomingo'],$domingoList)) {
  $_GET['large'] = (bool)$_GET['large'];
  $file = PIXDIR . "/" . date("Y/m",(int)substr($_GET['filename'],0,strpos($_GET['filename'],'_'))) . "/" . ($_GET['large']?"1275x1394":"448x490") . "_" . $_GET['filename'];
  error_log("FILE"  . $file);
  if(file_exists($file)) {
    header('Content-Type: image/jpeg');
    @readfile($file);
    die();
  } else {
    include('../classes/404.inc.php');
    include('./404.php');
    die();
  }
} else {
  include('../classes/404.inc.php');
  include('./404.php');
  die();
}
?>
